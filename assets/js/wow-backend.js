jQuery(document).ready(function($){

    if (wow_admin_ajax.current_editor === 'wow_builder_activated'){
        jQuery("body").addClass("active-wow-editor");
    }else{
        jQuery("body").addClass("inactive-wow-editor");
    }

    jQuery('.edit-with-wow-builder').click(function (e) {
        e.preventDefault();
        var $that =  $(this);
        var post_id = jQuery('.wppagebuilder-edit-button').attr("data-postid");
        $.post(  wow_admin_ajax.ajax_url, {action: 'wow_switch_editor', post_id : post_id, wow_nonce : wow_admin_ajax.wow_nonce }, function( data ) {
        });
        location.href = $that.attr('href');
    });

    $('.use-default-editor').click(function (e) {
        e.preventDefault();
        var post_id = jQuery('.wppagebuilder-edit-button').attr("data-postid");
        jQuery.ajax({
            url : wow_admin_ajax.ajax_url,
            type : 'post',
            data : {
                action: 'wow_switch_default',
                post_id : post_id,
                wow_nonce : wow_admin_ajax.wow_nonce
            },
            success : function( response ) {
                //
            }
        });
        window.location.reload();
    });

    $(document).on('click', '#wow_clear_cache_btn', function(e){
        e.preventDefault();

        var $that = $(this);

        jQuery.ajax({
            url : wow_admin_ajax.ajax_url,
            type : 'post',
            data : {
                action: 'wow_clear_cache',
                wow_nonce : wow_admin_ajax.wow_nonce
            },
            beforeSend: function(){
                $that.addClass('updating-message');
            },
            success : function( response ) {
                $that.closest('label').find('.response-text').html('<span style="color: #228b22;">WOW Page Builder cache has been cleared.</span>');
            },
            complete: function(){
                $that.removeClass('updating-message');
            }
        });
    });

    /**
     * Gutenberg compatibility
     */

    let wppbGutenbergCompatibility = {
        init : function(){
            let self = this;
            setTimeout(
                function(){
                    self.addWPPBBtn();
                    self.addSwitchTemplate();
                },
                1
            );

        },
        toolbarSelector: $('.edit-post-header-toolbar'),
        addWPPBBtn: function(){
            let isBtnExists = this.toolbarSelector.find('#wow-edit-with-btn-in-gutenberg-toolbar').length;
            let btnHtmlWrap = $('#wow-edit-with-btn-in-gutenberg-toolbar');
            if (!isBtnExists && btnHtmlWrap.length) {
                $('.edit-post-header__toolbar').append(btnHtmlWrap.html());
            }
        },
        addSwitchTemplate: function(){
            var hasSwitchTemplate = $('#wow-pagebuilder-to-gutenberg-switch-mode').length;
            if (hasSwitchTemplate){
                $('.editor-block-list__layout').after($('#wow-pagebuilder-to-gutenberg-switch-mode').html());
            }
        }
    };
    wppbGutenbergCompatibility.init();


    $(document).on('click', '.wow-back-to-gutenberg', function(e){
        e.preventDefault();

        var $that = $(this);

        $that.hide();
        $('.edit-with-wow-builder').show();
        $('body').removeClass('currently-activated-editor-wow_builder_activated');

        var post_id = $('#post_ID').val();
        $.ajax({
            url : wow_admin_ajax.ajax_url,
            type : 'post',
            data : {
                action: 'wow_switch_default',
                post_id : post_id,
                wow_nonce : wow_admin_ajax.wow_nonce,
                last_editor : 'gutenberg',
            },
        });
    });
});


//wow_clear_cache_btn