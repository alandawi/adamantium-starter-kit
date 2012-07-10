<?php
/**
 * @package WordPress
 * @subpackage Adamantium - Starter Kit
 * @author Alan Gabriel Dawidowicz - www.alandawi.com.ar
 */
?>

<?php get_header(); ?>

	<h1>
		<?php if ( is_day() ) : /* if the daily archive is loaded */ ?>
			<?php printf( __( 'Daily Archives: <span>%s</span>' ), get_the_date() ); ?>
		<?php elseif ( is_month() ) : /* if the montly archive is loaded */ ?>
			<?php printf( __( 'Monthly Archives: <span>%s</span>' ), get_the_date('F Y') ); ?>
		<?php elseif ( is_year() ) : /* if the yearly archive is loaded */ ?>
			<?php printf( __( 'Yearly Archives: <span>%s</span>' ), get_the_date('Y') ); ?>
		<?php else : /* if anything else is loaded, ex. if the tags or categories template is missing this page will load */ ?>
			Blog Archives
		<?php endif; ?>
	</h1>


	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		
		<!-- post -->

	<?php endwhile; ?>
		
		<!-- post navigation -->
		<?php if (function_exists('adamantium_page_navi')) { ?>			
			<?php adamantium_page_navi(); // use the page navi function ?>			
		<?php } ?>

	<?php else: ?>
		
		<!-- no posts found -->

	<?php endif; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>