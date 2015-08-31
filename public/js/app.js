'use strict';

var App = 
{
    init: function()
    {
        var orderSearch = jQuery('#order-id'),
            dropdownToggle = jQuery('.dropdown-toggle'),

            loginInput = jQuery('input[name=login_page_email]'),
            passwordInput = jQuery('input[name=login_page_password]');

        if (orderSearch.length > 0) {
            orderSearch.keyup(function(event) {
                if (event.keyCode == 13) {
                    $('#find-btn').click();
                    orderSearch.val('');
                    orderSearch.blur();
                }
            });
        }

        if (dropdownToggle.length > 0) {
            dropdownToggle.dropdown();
        }

        if (loginInput.length > 0) {
            loginInput.keyup(function(event) {
                if (event.keyCode == 13) {
                    jQuery('#login_button').click();
                }
            });
        }

        if (passwordInput.length > 0) {
            passwordInput.keyup(function(event) {
                if (event.keyCode == 13) {
                    jQuery('#login_button').click();
                }
            });
        }
    },

    removeTTN: function(id)
    {
        var orderIds = jQuery('#order-id'),
            regExp = new RegExp(id, 'g');

        jQuery.ajax({
            type: "POST",
            url: '/remove-ttn',
            data: {id: id},
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    jQuery('#results-table-' + id).remove();

                    orderIds.val(orderIds.val().replace(regExp, '').trim());
                }
            }
        });
    }
};

jQuery(document).ready(function() {
    App.init();
});