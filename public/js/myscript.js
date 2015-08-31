var SmallLoader = {
    class: '.loader_small_gif',
    
    show: function(){
        jQuery(SmallLoader.class).show()    
    },
    hide: function(){
        jQuery(SmallLoader.class).hide()    
    }
}

var ShowResult = {
    init: function(el){
        var fullBlock = el.closest('.result_block').find('.short_text_container');

        if (jQuery(el).html() == jQuery(el).data('label-hide')) {
            jQuery(el).html(jQuery(el).data('label-show'));
        } else {
            jQuery(el).html(jQuery(el).data('label-hide'));
        }

        el.closest('.result_block').find('.short_text_container').slideToggle();      
    }
}


$(function() {
    
    // menu login && reg
    $('.data_menu_container a').click(function() {
        var id = $(this).attr('data-id');
        var obj = $(this);
        
        obj.addClass('pressed');
        
        setTimeout(function() {
            obj.removeClass('pressed');    
        },500);
        
        if (obj.hasClass('user_history')) {
            $('.cabinet .data_body').hide();
        } else {
            $('.cabinet .data_body').show();    
        }
        
        if ( id == 'tab_2' ) {
            // fixme:
            obj.closest('.data_block').addClass('reg_colum');
        } else {
            obj.closest('.data_block').removeClass('reg_colum');
        }
        
        $('.data_menu_container a').removeClass('act');
            obj.addClass('act');
        
        $('.tabs_table').hide();
        $('#'+id).show();    
    });
    
    
    
    /*$('.button.info').on('click',function() {
        var obj = $(this);
        console.log('1')
        obj.addClass('act');
        obj.closest('.result_block').find('.short_text_container').slideToggle(function() {
            obj.removeClass('act');    
        });    
    });*/
    
    $('.tabs_table').on('click','button',function() {
        var obj = $(this);
        
        obj.addClass('pressed');
        
         setTimeout(function() {
            obj.removeClass('pressed');    
        },500);    
    });
    
    $('.remove_history').click(function() {
        var obj = $(this);
        
        obj.addClass('pressed');
        
         setTimeout(function() {
            obj.removeClass('pressed');    
        },500);    
    });
    
    $('.menu a').click(function(e) {
        e.preventDefault();
        var obj = $(this);
        
        obj.addClass('act pressed');
        
         setTimeout(function() {
            obj.removeClass('act pressed');
            location.href = obj.attr('href');    
        },500);    
    });


})

$(document).ready(function(){
    //soc
    setTimeout(function(){
        $('#uLogin1af0029f').css('height','42px'); 
        $( '[data-uloginbutton = facebook]' ).parent().css({
             'width' : 'auto',
             'height' : 'auto'
         });
         
        //fb
        $('<span>/</span>').insertAfter($( '[data-uloginbutton = facebook]' )).css({
            'position' : 'relative',
            'bottom': '18px',
            'marginRight' : '10px'
        });
        $( '[data-uloginbutton = facebook]' ).css({
            'width' : '95px',
            'height' : '42px',
            'background' : 'url(images/soc_sprite_2.png) no-repeat 0 0',
            'marginRight' : '2px',
            'float' : 'none',
            'display' : 'inline-block'
        });
        
        $( '[data-uloginbutton = facebook]' ).hover(function(){
            $(this).css({
                'backgroundPosition' : '0 -47px',
                'opacity' : '1'
            });
        },function(){
            $(this).css({
                'backgroundPosition' : '0 0'
            });    
        });
        
        //vk
        $('<span>/</span>').insertAfter($( '[data-uloginbutton = vkontakte]' )).css({
            'position' : 'relative',
            'bottom': '18px',
            'marginRight' : '10px'
        });
        $( '[data-uloginbutton = vkontakte]' ).css({
            'width' : '105px',
            'height' : '42px',
            'background' : 'url(images/soc_sprite_2.png) no-repeat -116px 0',
            'marginRight' : '2px',
            'float' : 'none',
            'display' : 'inline-block'
        });
        
        $( '[data-uloginbutton = vkontakte]' ).hover(function(){
            $(this).css({
                'backgroundPosition' : '-116px -47px',
                'opacity' : '1'
            });
        },function(){
            $(this).css({
                'backgroundPosition' : '-116px 0'
            });    
        });
        
        //gp
        $( '[data-uloginbutton = googleplus]' ).css({
            'width' : '77px',
            'height' : '42px',
            'background' : 'url(images/soc_sprite_2.png) no-repeat -243px 0',
            'marginRight' : '2px',
            'float' : 'none',
            'display' : 'inline-block'
        });
        
        $( '[data-uloginbutton = googleplus]' ).hover(function(){
            $(this).css({
                'backgroundPosition' : '-243px -47px',
                'opacity' : '1'
            });
        },function(){
            $(this).css({
                'backgroundPosition' : '-243px 0'
            });    
        });
            
    },1)
    
      
    
});