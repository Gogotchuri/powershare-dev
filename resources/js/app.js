/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./campaigns');


$(document).ready(function () {
    $('.datatables').DataTable({
        stateSave: true,
    });

    //Campaign Table in on management screens
    let campaignTable = $('table#campaignTable');

    campaignTable.DataTable().state.clear().destroy();
    campaignTable.DataTable({
        order: [[3, 'desc']],
    });

    $(document).ready(function () {
        $("#light-slider").lightSlider({
            gallery: true,
            item: 1,
            loop: true,
            slideMargin: 0,
            thumbItem: 9,

            onBeforeStart: function (el) {
            },
            onSliderLoad: function (el) {
            },
            onBeforeSlide: function (el) {
            },
            onAfterSlide: function (el) {
            },
            onBeforeNextSlide: function (el) {
            },
            onBeforePrevSlide: function (el) {
            }
        });
        $("#light-slider-wrapper").removeClass('d-none');
    });

    $(".open-metamask").on('click', function (ev) {
        if (typeof web3 === 'undefined') {
            $('.metamask-warning').text('You need to install MetaMask to use this feature.  https://metamask.io');
            $('.metamask-warning').show();
            // return renderMessage('You need to install MetaMask to use this feature.  https://metamask.io')
        } else if (!web3.eth.accounts.length) {
            $('.metamask-warning').text('You need to be logged in to MetaMask to use this feature.');
            $('.metamask-warning').show();
            // return renderMessage('You need to be logged in to use this feature.)
        } else {
            var user_address = web3.eth.accounts[0];
            var balance = $('.ether-amount').val();
            console.log(balance);

            web3.eth.sendTransaction({
                to: $(".open-metamask").attr('value'),
                from: user_address,
                value: web3.toWei(balance, 'ether')
            }, function (err, transactionHash) {
                if (err) {
                    $('.metamask-warning').text('Oh no! ' + err.message);
                    $('.metamask-warning').show();
                } else {
                    $('.metamask-success').show();
                }
            })
        }
    });


    (function ($, window, undefined) {
        "use strict";

        $(document).ready(function () {
            // Dropzone Example
            if (typeof Dropzone != 'undefined') {

                if ($("#fileupload").length) {

                    let dz_element = $("#fileupload");

                    var dz = new Dropzone("#fileupload", {

                            //TODO: Make maxFiles work with exising files loaded from server
                            maxFiles: 3,
                            url: dz_element.data('url'),
                            addRemoveLinks: true,
                            //Handle existing images
                            init: function () {
                                let thisDropzone = this;

                                $.get(thisDropzone.options.url, function (data) {
                                    if (data == null) {
                                        return;
                                    }

                                    $.each(data, function (key, value) {
                                        var mockFile = {
                                            name: value.name,
                                            size: value.size,
                                            id: value.id,
                                            thumbnail_url: value.thumbnail_url
                                        };
                                        thisDropzone.emit("addedfile", mockFile);
                                        thisDropzone.options.thumbnail.call(thisDropzone, mockFile, value.thumbnail_url);
                                        // Make sure that there is no progress bar, etc...
                                        thisDropzone.emit("complete", mockFile);
                                    });
                                });
                            }
                        }),
                        dze_info = $("#dze_info"),
                        status = {
                            uploaded: 0,
                            errors: 0
                        };
                    var $f = $('<tr><td class="name"></td><td class="size"></td><td class="type"></td><td class="status"></td></tr>');
                    dz.on("success", function (file, responseText) {

                        if (responseText.data !== null) {
                            file.id = responseText.data.id;
                        }

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

                            console.error('Your File Uploaded Not Successfully!!', 'Error Alert', {
                                timeOut: 5000
                            });
                        })
                        .on('removedfile', function (file) {

                            // Case when file exists on ui and not on server
                            if (!file.id) {
                                return;
                            }

                            //Remove file from server
                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                url: dz.options.url,
                                type: 'DELETE',
                                data: {
                                    'file_id': file.id,
                                },
                                complete: function (response) {

                                    if (response.status !== 200 || response.responseJSON.status !== 'OK') {
                                        dz.emit("addedfile", file);
                                        dz.options.thumbnail.call(dz, file, file.thumbnail_url);
                                        dz.emit("complete", file);
                                    }
                                }
                            });
                        })
                        .on('sending', function (file, xhr, formData) {
                            formData.append('_token', dz_element.data('token'));
                        });

                    $('.dropzone-img').each(function () {
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

    //FIXME: DO we still need fllowing code cause we moved terms on separate page`
    // Registration form
    let terms = $('#registerForm .terms');
    terms.collapse({
        toggle: false
    });

    let mainInputs = $('#registerForm .main-inputs input');

    let filledAny = mainInputs.is(function (i, elem) {
        return elem.value;
    });

    if (filledAny) {
        terms.collapse('show');
    }

    mainInputs.keypress(function (e) {
        terms.collapse('show');
    });

    mainInputs.change(function (e) {
        terms.collapse('show');
    });


    let mainMenu = $('.mobile-menu-items');
    let toggleButton = $('.mobile-menu-toggle');

    if (mainMenu.length && toggleButton.length) {
        toggleButton.on('click', function (e) {
            e.preventDefault();

            mainMenu.removeClass('hidden');
            console.log('Show main mobile menu')
        });

        function hideMenu(e) {
            if (!toggleButton.is(e.target) && toggleButton.has(e.target).length === 0 && !mainMenu.is(e.target) // if the target of the click isn't the container...
                && mainMenu.has(e.target).length === 0) // ... nor a descendant of the container
            {
                mainMenu.addClass('hidden');
            }
        }

        $(document).on('click', hideMenu);
        $(document).on('touchend', hideMenu);
    }

    // Old or new Platform choice popup

    if (!sessionStorage.notFirstVisit) {

        sessionStorage.notFirstVisit = true;

        let oldNewModal = $('#oldNewModal');

        if (oldNewModal.length) {

            if (!localStorage.chooseWebsite) {
                oldNewModal.modal('show');
            }

            $('.old-new-choice-button').click(function (e) {

                if (oldNewModal.find('.chooseWebsiteTick').is(":checked")) {
                    //Set cookie if ticked
                    localStorage.chooseWebsite = true;
                }

                // Prevent default if any
                e.preventDefault();

                oldNewModal.modal('hide');

                let targetUrl = $(e.target).data('targetUrl');

                // Get hostname from targetUrl
                let a = document.createElement("a");
                a.href = targetUrl;

                // If we are already on target url do not redirect
                if (a.hostname !== window.location.hostname) {
                    window.location.href = targetUrl;
                }
            });
        }
    }

    (function ($, window, undefined) {

        // Old or new Platform choice popup
        let socialShareModal = $('#socialShareModal');
        let shareButton = $('#shareButton');

        if (socialShareModal.length && shareButton.length) {

            socialShareModal.on('click', function () {
                socialShareModal.modal('hide');
            });

            shareButton.on('click', function () {
                socialShareModal.modal('show');
            });
        }
    })(jQuery, window);

    // Ethereum address validation.

    campaignEditForm = $('#campaignEditForm');
    if (campaignEditForm.length) {

        var sha3 = require('crypto-js/sha3');

        //NOTE: Following two methods are copied from go-ethereum repository

        /**
         * Checks if the given string is an address
         *
         * @method isAddress
         * @param {String} address the given HEX adress
         * @return {Boolean}
         */
        var isAddress = function (address) {
            if (!/^(0x)?[0-9a-f]{40}$/i.test(address)) {
                // check if it has the basic requirements of an address
                return false;
            } else if (/^(0x)?[0-9a-f]{40}$/.test(address) || /^(0x)?[0-9A-F]{40}$/.test(address)) {
                // If it's all small caps or all all caps, return true
                return true;
            } else {
                // Otherwise check each case
                return isChecksumAddress(address);
            }
        };

        /**
         * Checks if the given string is a checksummed address
         *
         * @method isChecksumAddress
         * @param {String} address the given HEX adress
         * @return {Boolean}
         */
        var isChecksumAddress = function (address) {
            // Check each case
            address = address.replace('0x', '');
            var addressHash = sha3(address.toLowerCase());
            for (var i = 0; i < 40; i++) {
                // the nth letter should be uppercase if the nth digit of casemap is 1
                if ((parseInt(addressHash[i], 16) > 7 && address[i].toUpperCase() !== address[i]) || (parseInt(addressHash[i], 16) <= 7 && address[i].toLowerCase() !== address[i])) {
                    return false;
                }
            }
            return true;
        };

        let validate = function (input) {
            if (isAddress(input.val())) {
                input.removeClass('is-invalid');
                input.parent().find('.eth-address-invalid').css('display', 'none');
            } else {
                input.addClass('is-invalid');
                input.parent().find('.eth-address-invalid').css('display', 'block');
            }
        };

        let ethereum_address_input = $(campaignEditForm.find('#ethereum_address'));

        //Explicitly used for this input will append to laravel's feedback element
        ethereum_address_input.parent().append(
            '<span class="invalid-feedback eth-address-invalid" role="alert">\n' +
            '    <strong>Invalid address</strong>\n' +
            '</span>');

        ethereum_address_input.on('input', function () {
            validate(ethereum_address_input);
        });
    }

    // Add special class tto mobile hamburger when scroll down.
    let mobileNav = $('#mobileNav');

    if (mobileNav.length) {

        $(window).bind('scroll', function () {
            if ($(window).scrollTop() > 40) {
                mobileNav.find('.mobile-menu-controls').addClass('sticky');
            } else {
                mobileNav.find('.mobile-menu-controls').removeClass('sticky');
            }
        });
    }

    //FIXME: Probably this can be implemented in css

    let updateInfiniteScrollWraperHeight = function () {
        let height = $('.infinite-scroll .campaign-col').height();
        $('.campaigns-list-wrapper').height(height * 2);
    };

    $(window).resize(function () {
        updateInfiniteScrollWraperHeight();
    });
    window.addEventListener('load', () => updateInfiniteScrollWraperHeight());
});
