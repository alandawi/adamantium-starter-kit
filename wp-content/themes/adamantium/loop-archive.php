<?php 
/**
 * @package WordPress
 * @subpackage Adamantium - Starter Kit
 * @author Alan Gabriel Dawidowicz - www.alandawi.com.ar
 */
?>

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