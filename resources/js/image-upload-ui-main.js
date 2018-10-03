/*
 * jQuery File Upload Plugin JS Example
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * https://opensource.org/licenses/MIT
 */

/* global $, window */

$(function () {
    'use strict';

    // FIXME: Following script is very page specific.
    let ajaxSetupData = {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    };

    // FIXME: This is just a temporary solution to, send additional parameter on
    // fileupload-ui initial GET image list request
    if(campaignId) {
        ajaxSetupData.data = {
            campaignId : campaignId
        };
    }

    $.ajaxSetup(ajaxSetupData);

    // Initialize the jQuery File Upload widget:
    $('#fileupload').fileupload({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: uploadRoute,//'/image/upload',
        paramName: 'featured_images[]',
        singleFileUploads:false
        //FIXME: This does not work for initial fileupload-ui GET image list request
        // but probably it shhould not for loading existing images
        /*formData: [{
            'campaignId': campaignId
        }]*/
        //autoUpload: true
    });

    // Get image ids to
    $('#fileupload').bind('fileuploaddone', function (e, data) {
        var form = $('#campaignEditForm');

        form.remove('.imageIds');

        var imageIdHolder = $('<span/>').addClass('imageIds');

        for(let index in data.result.files) {

            let file = data.result.files[index];

            imageIdHolder.append($('<input />').attr('type', 'hidden')
                .attr('name', "image_ids[]").attr('value', file.id));
        }

        form.append(imageIdHolder);

        console.log('fileuploaddone data.result', data.result);
    });

    // Enable iframe cross-domain access via redirect option:
    $('#fileupload').fileupload(
        'option',
        'redirect',
        window.location.href.replace(
            /\/[^\/]*$/,
            '/cors/result.html?%s'
        )
    );

    if (window.location.hostname === 'blueimp.github.io') {
        // Demo settings:
        $('#fileupload').fileupload('option', {
            url: '//jquery-file-upload.appspot.com/',
            // Enable image resizing, except for Android and Opera,
            // which actually support image resizing, but fail to
            // send Blob objects via XHR requests:
            disableImageResize: /Android(?!.*Chrome)|Opera/
                .test(window.navigator.userAgent),
            maxFileSize: 999000,
            acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i
        });
        // Upload server status check for browsers with CORS support:
        if ($.support.cors) {
            $.ajax({
                url: '//jquery-file-upload.appspot.com/',
                type: 'HEAD'
            }).fail(function () {
                $('<div class="alert alert-danger"/>')
                    .text('Upload server currently unavailable - ' +
                        new Date())
                    .appendTo('#fileupload');
            });
        }
    } else {
        // Load existing files:
        $('#fileupload').addClass('fileupload-processing');
        $.ajax({
            // Uncomment the following to send cross-domain cookies:
            //xhrFields: {withCredentials: true},
            url: $('#fileupload').fileupload('option', 'url'),
            dataType: 'json',
            context: $('#fileupload')[0]
        }).always(function () {
            $(this).removeClass('fileupload-processing');
        }).done(function (result) {
            $(this).fileupload('option', 'done')
                .call(this, $.Event('done'), {result: result});
        });
    }

});
