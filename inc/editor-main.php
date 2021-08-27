<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $wp_version;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title><?php echo __( 'WOW Page Builder', 'wow-pagebuilder' ) . ' | ' . get_the_title(); ?></title>
	<?php wp_head(); ?>
	<script>
        var ajaxurl = '<?php echo admin_url( 'admin-ajax.php', 'relative' ); ?>';
    </script>
    <script type="text/javascript">
        function onLoadHandler(){
            if( typeof  document.getElementById('wppbMainIframeLoadingWrap') != 'undefined' ){
                document.getElementById('wppbMainIframeLoadingWrap').style.display='none';
            }
            if( typeof document.getElementById('wow-builder-view') != 'undefined' ){
                var wow_iframe = document.getElementById('wow-builder-view');
                var innerDoc = wow_iframe.contentDocument || wow_iframe.contentWindow.document;
                var head = innerDoc.getElementsByTagName('body')[0];
                var script = innerDoc.createElement('script');
                script.innerText = "jQuery('body').bind('DOMSubtreeModified', function () {jQuery('.wow-builder-addon img').each(function () { var getsrc = jQuery(this).attr('src'); if(getsrc.substring(0, 4) !== 'http'){ jQuery(this).attr('src', '<?php echo plugin_dir_url(__DIR__) ?>' + getsrc); } }) });";
                script.innerText += "jQuery('body').bind('DOMNodeInserted DOMNodeInsertedIntoDocument', function () {setTimeout(() => { jQuery('style[id^=\"wow-\"]').each(function () { var getsrc = jQuery(this).html(); var image_url = /url\\(lib\\/pages\\/(.*?).(jpg|jpeg|png|gif)/i; var message = getsrc.replace(image_url,'url(<?php echo plugin_dir_url(__DIR__) ?>lib/pages/$1.$2'); jQuery(this).text(message); }); }, 3000); });";
                script.type = 'text/javascript';
                head.appendChild(script);
            }
        }
    </script>
</head>
<body class=" wp-version-<?php echo str_replace( '.', '-', $wp_version ); ?> wow-frontend-active">
    <div class="wow-iframe-loading-wrap" id="wppbMainIframeLoadingWrap" >
        <img src="<?php echo WOW_DIR_URL.'assets/img/loading-md.svg'; ?>" alt="loading"/>
    </div>
    <div id="wow-page-builder">
        <?php $load_iframe_url = add_query_arg( array('load_for' => 'wow_editor_iframe') , get_the_permalink(get_the_ID())); ?>
        <iframe width="100%" height="400" id="wow-builder-view" data-page-id="<?php echo get_the_ID(); ?>" name="wow-builder-view" src="<?php echo $load_iframe_url; ?>" onload="onLoadHandler();"></iframe>
        <div id="wow-builder-page-tools" class="wow-builder-page-tools"></div>
    </div>
    <?php
        wp_footer();
        do_action( 'admin_print_footer_scripts' );
    ?>
    <script>
        function WOW_watching() {
            jQuery('.sectionWarpper .blocks-draggable-img > img').each(function () {
                var getsrc = jQuery(this).attr('src');
                if(getsrc.substring(0, 4) !== 'http'){
                    jQuery(this).attr('src', '<?php echo plugin_dir_url(__DIR__) ?>' + getsrc);
                }
            })
            jQuery('.wow-builder-modal .wow-default-template-image > img').each(function () {
                var getsrc = jQuery(this).attr('src');
                if(getsrc.substring(0, 4) !== 'http'){
                    jQuery(this).attr('src', '<?php echo plugin_dir_url(__DIR__) ?>' + getsrc);
                }
            })
            jQuery('.wow-builder-addon img').each(function () {
                var getsrc = jQuery(this).attr('src');
                if(getsrc.substring(0, 4) !== 'http'){
                    jQuery(this).attr('src', '<?php echo plugin_dir_url(__DIR__) ?>' + getsrc);
                }
            })
        }
    jQuery('body').bind('DOMSubtreeModified', function () {
        WOW_watching()
    });
    </script>
</body>
</html>
