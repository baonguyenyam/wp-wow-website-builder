jQuery(document).ready(function($){
    'use strict';

    $(document).on('click', '.wow-posts-addon-loadmore-btn', function(e){
        e.preventDefault();
        var selector = $(this);
        var paged = selector.attr('data-paged');
        var page_id = $('body').attr('class').match(/\wow-body-single-(\d+)\b/)[1];
        var addon_id = selector.closest('.wow-builder-addon').attr('data-addon-id');

        $.ajax({
            url: wow_posts_addon.ajax_url,
            type: 'POST',
            data: {
                action: 'wow_posts_addon_load_more',
                'paged': paged,
                'page_id': page_id,
                'addon_id': addon_id,
            },
            beforeSend: function(){
                $('.wow-posts-addon-content').append('<div class="wow-post-grid-spinner"><div class="wow-post-grid-spin"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>');
            },
            success: function(data){
                var target = selector.closest('.wow-posts-addon').find('.wow-posts-addon-content');
                $('.wow-posts-addon-pagination').remove();
                target.append(data);
            },
            error: function(jqXHR, String ){
                //
            },
            complete: function(){
                $('.wow-post-grid-spinner').remove();
            }
        });

    });


    $(document).on('click', '.wow-posts-paginate-link', function(e){

        e.preventDefault();
        var selector = $(this);
        var paged = selector.attr('data-paged');
        var page_id = $('body').attr('class').match(/\wow-body-single-(\d+)\b/)[1];
        var addon_id = selector.closest('.wow-builder-addon').attr('data-addon-id');

        if (paged < 1){
            paged = 1;
        }

        $.ajax({
            url: wow_posts_addon.ajax_url,
            type: 'POST',
            data: {
                action: 'wow_posts_addon_load_more',
                'paged': paged,
                'page_id': page_id,
                'addon_id': addon_id,
            },
            beforeSend: function(){
                $('.wow-posts-addon-content').append('<div class="wow-post-grid-spinner"><div class="wow-post-grid-spin"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>');
            },
            success: function(data){
                var target = selector.closest('.wow-addon');
                $('.wow-posts-addon-pagination').remove();
                target.html(data);
            },
            error: function(jqXHR, String ){
                //
            },
            complete: function(){
                $('.wow-post-grid-spinner').remove();
            }
        });

    })



});