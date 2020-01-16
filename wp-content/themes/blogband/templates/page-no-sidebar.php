<?php 
/**
 * The template for displaying pages
 *
 * @version    0.0.23
 * @package    blogband
 * @author     Zidithemes
 * @copyright  Copyright (C) 2020 zidithemes.tumblr.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * TEMPLATE NAME: Page No Sidebar 
 * 
 */
?>
<?php get_header(); ?>


<main id="main" class="site-main" role="main">

	<header class="page-header">
		
	</header>

	<div  id="content" class="page-content">

		<div class="flowid blogband-page-no-sidebar ">

		    <div class="mg-auto wid-90 mobwid-90">
		        
		        <div class="inner dsply-fl fl-wrap">
		            
		            <div class="wid-100 blog-2-col-inner">
		            	
		                <div class=" dsply-fl fl-wrap">
		                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>	

		                	
		                	
		                	<div class="items wid-100 mobwid-100">
		                            <div class="items-inner dsply-fl fl-wrap  mn-dz">
		                                <div class="img-box ov-fl-hd wid-100 relative">
		                                	
		                                	<h2 class="mg-bt-20 text-center">
	                                        	<?php the_title(); ?>
	                                        </h2>
		                                    <div class="details-box ">
		                                        <div class="details-box-inner">
		                                            <p><?php the_content(); ?></p>
		                                            
		                                        </div>
		                                    </div>
		                                </div>
		                            </div>
		                    </div>
				            <div class="blogband_link_pages">
					            <?php wp_link_pages(); ?>
					        </div>
		                    <?php endwhile; else : ?>
								<h2><?php esc_html__('No posts Found!', 'blogband'); ?></h2>
		                    <?php endif; ?>
		                    <!-- SIDEBAR -->
		                </div>
		                
		            </div>

		        </div>
		    </div>
		</div>


	</div>

</main>


<?php get_footer(); ?>