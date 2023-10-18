define(
    [
        'ko',
        'jquery',
        'uiComponent',
        'mage/url'
    ],
    function (ko, $, Component, url) {
        'use strict';

        return Component.extend({
            defaults: {
                template: 'Pixafy_PONumber/checkout/number'
            },
            isRequired: function () {
                return window.checkoutConfig.is_po_required;
            },
            initObservable: function () {
                this.po = ko.observable();

                this.updatePo = function (data, event) {
                       var linkUrls = url.build('po_number/checkout/save');
                       $.ajax({
                           showLoader: true,
                           url: linkUrls,
                           data: {po_number: this.po},
                           type: "POST",
                           dataType: 'json'
                       }).done(function (data) {
                           console.log('success');
                       });
                }
                return this;
            }
        });
    }
);

