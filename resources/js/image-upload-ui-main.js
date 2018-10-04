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

    let fileupload = $('#fileupload');

    if(fileupload.length) {
        let ajaxSetupData = {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        };

        $.ajaxSetup(ajaxSetupData);

        // Overrides toplevel fileupload config values like 'url', 'dataType' so on.
        let data = _(fileupload.data()).pickBy(function (value, key) {
            return _.startsWith(key, "config");
        }).mapKeys(function(value, key) {
            return _.lowerFirst(key.substring(6, key.length));
        }).value();

        // Get all data attibutes that start with form, e.g. form-user-id="1"
        let formData = _(fileupload.data()).pickBy(function (value, key) {
            return _.startsWith(key, "form");
        }).map(function(value, key) {
            return {
                'name' : _.lowerFirst(key.substring(4, key.length)),
                'value' : value
            }
        }).value();

        var uploadConf = _.merge({
            // Uncomment the following to send cross-domain cookies:
            //xhrFields: {withCredentials: true},
            paramName: 'featured_images[]',
            //This does not help to override _method input on laravel HTML form
            //type: 'POST',
            dataType: 'json',
            singleFileUploads: false,
            //TODO: Make use of this option to limit number of files to be uploaded, currently we are
            // managing that on server side handler. Which replaces old image with new one.
            //maxNumberOfFiles:1,
            autoUpload: true,
            //Singles END
            formData: _.concat(formData, [{
                name: '_method',
                value: 'POST'
            }])
        }, data);

        // Append or Override _method parameter to form data passed to component
        formData = _.concat(formData, [{
            //This is mandatory too when file upload form is used inside laravel form that uses hidden '_method' input
            // FIXME: Not sure if this will work for all versions
            name: '_method',
            value: 'POST'
        }]);

        // Force formData to new one, no matter what was its value before.
        uploadConf = _.merge(uploadConf, {
            'formData' : formData
        });

        // Initialize the jQuery File Upload widget:
        fileupload.fileupload(uploadConf);

        let isSingle = true;

        // Load existing files:
        fileupload.addClass('fileupload-processing');
        let request = $.ajax({
            // Uncomment the following to send cross-domain cookies:
            //xhrFields: {withCredentials: true},
            url: fileupload.fileupload('option', 'url'),
            dataType: 'json',
            context: fileupload[0]
        }).always(function () {
            $(this).removeClass('fileupload-processing');
        });

        if(isSingle) {
            request.done(function (result) {
                fileupload.find('.present').attr('src', result.files[0].url);
            });
        } else {
            request.done(function (result) {
                $(this).fileupload('option', 'done')
                    .call(this, $.Event('done'), {result: result});
            });
        }

        /*.done(function (result) {
            $(this).fileupload('option', 'done')
                .call(this, $.Event('done'), {result: result});
        })*/;
    }
});
