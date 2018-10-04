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
    if (campaignId) {
        ajaxSetupData.data = {
            campaignId: campaignId
        };
    }

    $.ajaxSetup(ajaxSetupData);

    // Initialize the jQuery File Upload widget:
    $('#fileupload').fileupload({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: uploadRoute,//'/image/upload',
        paramName: 'featured_images[]',
        //This does not help to override _method input on laravel HTML form
        //type: 'POST',
        dataType: 'json',
        singleFileUploads:false,
        //This is mandatory too when file upload form is used inside laravel form that uses hidden '_method' input
        // FIXME: Not sure if this will work for all versions
        formData: [{
            name: '_method',
            value: 'POST'
        }]
        // autoUpload: true
    });

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
        console.log('fileupload reload', result);
        $(this).fileupload('option', 'done')
            .call(this, $.Event('done'), {result: result});
    });
});
