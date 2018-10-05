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

    _.each($('.fileupload'), function (fileupload, key) {

        fileupload = $(fileupload);

        //Support multiple widgets on the same page
        fileupload.each(function () {
            $(this).fileupload({
                dropZone: $(this)
            });
        });

        if (fileupload.length) {

            /**
             *
             * Get all configuration values coming from blade component
             *
             */

            // Overrides toplevel fileupload config values like 'url', 'dataType' so on.
            let conf = _(fileupload.data()).pickBy(function (value, key) {
                    return _.startsWith(key, "config");
                }).mapKeys(function (value, key) {
                    return _.lowerFirst(key.substring(6, key.length));
                }).value();

            // Get all data attibutes that start with form, e.g. form-user-id="1"
            let formData = _(fileupload.data()).pickBy(function (value, key) {
                return _.startsWith(key, "form");
            }).map(function (value, key) {
                return {
                    'name': _.lowerFirst(key.substring(4, key.length)),
                    'value': value
                }
            }).value();

            // Additional parameters that may help configure this plugin
            let data = _(fileupload.data()).pickBy(function (value, key) {
                return !_.startsWith(key, "form") && !_.startsWith(key, "config");
            }).value();

            let ajaxSetupData = {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            };
            $.ajaxSetup(ajaxSetupData);


            /**
             * Create upload plugin config defaults and override it with values coming from blade component.
             *
             * NOTE: Only form data is currently handled slight
             *
             */

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
                autoUpload: false,
                //Singles END
                formData: _.concat(formData, [{
                    name: '_method',
                    value: 'POST'
                }])
            }, conf);

            // By default this plugin and its GUI is made for multiple file uploads, overriding values so that it
            // works like single file upload
            if (data['isSingle']) {
                var uploadConf = _.merge(uploadConf, {
                    //singleFileUploads: true,
                    //TODO: Make use of this option to limit number of files to be uploaded, currently we are
                    // managing that on server side handler. Which replaces old image with new one.
                    //maxNumberOfFiles:1,
                    autoUpload: true
                });
            }

            // Append or Override _method parameter to form data passed to component
            formData = _.concat(formData, [{
                //This is mandatory too when file upload form is used inside laravel form that uses hidden '_method' input
                // FIXME: Not sure if this will work for all versions
                name: '_method',
                value: 'POST'
            }]);

            // Force formData to new one, no matter what was its value before.
            uploadConf = _.merge(uploadConf, {
                'formData': formData
            });

            // Initialize the jQuery File Upload widget:
            fileupload.fileupload(uploadConf);

            /**
             * Run initial ajax request, to load existing files
             */

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

            /**
             * Register handlers to update image previews old/existing and fresh uploads. Based on single or multiple.
             */

            // Image preview handled differently for multiple and single file uploads, existing image(s) and fresh upload(s)
            if (data['isSingle']) {
                let previewElem = $('#' + fileupload.data('singlePreviewId'));

                fileupload.bind('fileuploaddone', function (e, data) {
                    previewElem.attr('src', data.result.files[0].url);
                });

                request.done(function (result) {
                    previewElem.attr('src', result.files[0].url);
                });
            } else {
                request.done(function (result) {
                    $(this).fileupload('option', 'done')
                        .call(this, $.Event('done'), {result: result});
                });
            }
        }
    });
});
