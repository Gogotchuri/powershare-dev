
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

$(document).ready(function() {
    $('.datatables').DataTable({
        stateSave: true,
    });

    $(document).ready(function() {
        $("#light-slider").lightSlider({
            gallery: true,
            item: 1,
            loop: true,
            slideMargin: 0,
            thumbItem: 9,

            onBeforeStart: function (el) {},
            onSliderLoad: function (el) {},
            onBeforeSlide: function (el) {},
            onAfterSlide: function (el) {},
            onBeforeNextSlide: function (el) {},
            onBeforePrevSlide: function (el) {}
        });
        $("#light-slider-wrapper").removeClass('d-none');
    });

    if (typeof Dropzone != 'undefined') {
        Dropzone.options.fileupload = {
            accept: function (file, done) {
                if (file.type != "application/vnd.ms-excel" && file.type != "image/jpeg, image/png, image/jpg") {
                    done("Error! Files of this type are not accepted");
                } else {
                    done();
                }
            }
        }
        Dropzone.options.fileupload = {
            acceptedFiles: "image/jpeg, image/png, image/jpg"
        }
    }

    (function ($, window, undefined) {
        "use strict";

        $(document).ready(function () {
            // Dropzone Example
            if (typeof Dropzone != 'undefined') {
                if ($("#fileupload").length) {
                    var dz = new Dropzone("#fileupload", {
                            addRemoveLinks: true
                        }),
                        dze_info = $("#dze_info"),
                        status = {
                            uploaded: 0,
                            errors: 0
                        };
                    var $f = $('<tr><td class="name"></td><td class="size"></td><td class="type"></td><td class="status"></td></tr>');
                    dz.on("success", function (file, responseText) {

                        var _$f = $f.clone();

                        _$f.addClass('success');

                        _$f.find('.name').html(file.name);
                        if (file.size < 1024) {
                            _$f.find('.size').html(parseInt(file.size) + ' KB');
                        } else {
                            _$f.find('.size').html(parseInt(file.size / 1024, 10) + ' KB');
                        }
                        _$f.find('.type').html(file.type);
                        _$f.find('.status').html('Uploaded <i class="entypo-check"></i>');

                        dze_info.find('tbody').append(_$f);

                        status.uploaded++;

                        dze_info.find('tfoot td').html('<span class="label label-success">' + status.uploaded + ' uploaded</span> <span class="label label-danger">' + status.errors + ' not uploaded</span>');

                    })
                        .on('error', function (file) {
                            var _$f = $f.clone();

                            dze_info.removeClass('hidden');

                            _$f.addClass('danger');

                            _$f.find('.name').html(file.name);
                            _$f.find('.size').html(parseInt(file.size / 1024, 10) + ' KB');
                            _$f.find('.type').html(file.type);
                            _$f.find('.status').html('Uploaded <i class="entypo-cancel"></i>');

                            dze_info.find('tbody').append(_$f);

                            status.errors++;

                            dze_info.find('tfoot td').html('<span class="label label-success">' + status.uploaded + ' uploaded</span> <span class="label label-danger">' + status.errors + ' not uploaded</span>');

                            toastr.error('Your File Uploaded Not Successfully!!', 'Error Alert', {
                                timeOut: 5000
                            });
                        });

                    $('.dropzone-img').each(function() {
                        var file = {
                            name: $(this).attr('alt'),
                            size: null,
                        };
                        dz.options.addedfile.call(dz, file);
                        dz.options.thumbnail.call(dz, file, $(this).attr('src'));
                        dz.emit('complete', file);
                    })
                }
            }
        });
    })(jQuery, window);

});