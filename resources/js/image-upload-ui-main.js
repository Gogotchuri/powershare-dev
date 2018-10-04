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

    // FIXME: Following script is very page specific.
    let ajaxSetupData = {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    };

    $.ajaxSetup(ajaxSetupData);

    let data = _(fileupload.data()).pickBy(function (value, key) {
        return !_.startsWith(key, "form");
    }).value();

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
        url: uploadRoute,//'/image/upload',
        paramName: 'featured_images[]',
        //This does not help to override _method input on laravel HTML form
        //type: 'POST',
        dataType: 'json',
        singleFileUploads: false,
        //This is mandatory too when file upload form is used inside laravel form that uses hidden '_method' input
        // FIXME: Not sure if this will work for all versions
        formData: _.concat(formData, [{
            name: '_method',
            value: 'POST'
        }])
        // autoUpload: true
    }, data);

    formData = _.concat(formData, [{
        name: '_method',
        value: 'POST'
    }]);

    uploadConf = _.merge(uploadConf, {
        'formData' : formData
    });

    console.log(uploadConf);

    // Initialize the jQuery File Upload widget:
    fileupload.fileupload(uploadConf);

    // Load existing files:
    fileupload.addClass('fileupload-processing');
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
