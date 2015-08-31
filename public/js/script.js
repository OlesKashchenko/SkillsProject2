"use strict";

var Main =
{
    // номера деклараций для поиска
    ordersIds: [],

    /*
    Инициализировать необходимые компоненты
     */
    init: function()
    {
        if (jQuery('.search_text').length > 0) {
            setTimeout(function() {
                Main.searchSavedOrders();
            }, 500);
        }
    }, // end init

    /*
    Получить ранее просмотренные номер
     */
    searchSavedOrders: function()
    {
        jQuery.ajax({
            type:       "GET",
            url:        '/get-saved-delivery-info',
            dataType:   'json',
            success:    function(response) {
                if (response.status && response.ttn) {
                    jQuery('#order-id').val(response.ttn);
                }
            }
        });
    }, // end searchSavedOrders

    /*
    Произвести поиск номеров
     */
    searchOrder: function()
    {
        var idOrderInput    = jQuery('#order-id'),
            idOrder         = idOrderInput.val().trim(),
            findButton      = jQuery('#find-btn');

        if (!idOrder) {
            alert('Необходимо ввести номер накладной!');
            return false;
        }

        var dirtyValues = idOrder.split(' ');
        for (var i = 0; i < dirtyValues.length; i++) {
            if (dirtyValues[i]) {
                Main.ordersIds.push(dirtyValues[i]);
            }
        }
        Main.ordersIds = jQuery.unique(Main.ordersIds);

        findButton.prop('disabled', true);
        findButton.addClass('act');

        idOrderInput.val('');

        jQuery('#results-container').html('');
        jQuery('.home_content').addClass('act');
        jQuery('.temp').hide();

        Main.getPreparedSearch();
        Main.getSearchResult();
    }, // end searchOrder

    /*
     Произвести подготовку блоков к подгрузке
     */
    getPreparedSearch: function()
    {
        var findButton = jQuery('#find-btn');

        findButton.prop('disabled', true);
        findButton.addClass('act');

        jQuery.ajax({
            type:       "POST",
            url:        '/get-prepared-search',
            data:       { ids: Main.ordersIds },
            dataType:   'json',
            success:    function(response) {
                if (response.status) {
                    jQuery('#results-container').append(response['html']);
                }
            }
        });
    }, // end getPreparedSearch

    /*
    Произвести поиск по конкретному номеру
     */
    getSearchResult: function()
    {
        var findButton = jQuery('#find-btn');

        $.each(Main.ordersIds, function(index, value) {
            jQuery.ajax({
                type:       "POST",
                url:        '/get-delivery-info',
                data:       { id: value },
                dataType:   'json',
                success:    function(response) {
                    if (response.status) {
                        jQuery('#results-container #results-table-' + value).replaceWith(response['html']);
                    }
                }
            });
        });

        findButton.prop('disabled', false);
        findButton.removeClass('act');

        /*
        jQuery.ajax({
            type:       "POST",
            url:        '/get-delivery-info',
            data:       { id: Main.ordersIds[0] },
            dataType:   'json',
            success:    function(response) {
                findButton.prop('disabled', false);
                findButton.removeClass('act');

                if (response.status) {
                    jQuery('#results-container #results-table-' + Main.ordersIds[0]).replaceWith(response['html']);

                    Main.ordersIds.splice(
                        jQuery.inArray(Main.ordersIds[0], Main.ordersIds),
                        1
                    );

                    if (Main.ordersIds.length > 0) {
                        Main.getSearchResult();
                    }
                }
            }
        });
        */
    }, // end sendRequest

    preloader_0: function() {
        jQuery('#proghress_bar_loader .current').animate({
            'width' : '100%'
        },1500, function() {
            jQuery('#proghress_bar_loader .current').css({
                'width' : '-0',
            });
            Main.preloader_0();    
        });    
    },
    
    preloader: function() {
        jQuery('.new_preloader').animate({
            'width' : '100%'
        },1500, function() {
            jQuery('.new_preloader').css({
                'width' : '0%',
            });
            Main.preloader();    
        });    
    },

    preloader_2: function() {
        jQuery('.block_row').animate({
            'width' : '100%'
        },1500, function() {
            jQuery('.block_row').css({
                'width' : '0%',
            });
            Main.preloader_2();    
        });    
    }
};

jQuery(document).ready(function() {
    Main.init();
});
