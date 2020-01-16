<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package opstore
 */



    $meta = get_post_meta(get_the_ID(),'ultra_page_footer',true);
    $footer_layout = get_post_meta(get_the_ID(),'ultra_page_footer',true);
    $template_id = get_post_meta(get_the_ID(),'ultra_page_custom_footer',true);
    
    if($footer_layout == 'default' || $footer_layout == ''){
        $footer_layout = get_theme_mod('opstore_footer_layout','default');
        $template_id = get_theme_mod('opstore_custom_footer');
    }

    if($footer_layout!='hide'){
        if($footer_layout == 'custom' && $template_id!='' && defined('ELEMENTOR_VERSION')){
            echo '<div class="opstore-custom-footer">';
            echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $template_id );
            echo '</div>';
        }else{
        	?>
    	    <footer id="opstore-footer">
    	    	<?php do_action('opstore_footer'); ?>
    		</footer>
    		<!--footer-->
        	<?php
        }
    }
    ?>
	<a href="#" class="scrollup"><i class="fa fa-angle-up"></i></a>	   
</div>  <!-- end #primary -->

<?php 
do_action( 'opstore_after_body_output' );
?>
<div class="full-search-container">
    <a href="javascript:void(0)" class="closebtn" ><span class="lnr lnr-cross"></span></a>
    <?php echo get_search_form();?>
</div>    

<?php
wp_footer();
?>
</body>

</html>
