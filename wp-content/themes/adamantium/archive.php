<?php
/**
 * @package WordPress
 * @subpackage Adamantium - Starter Kit
 * @author Alan Gabriel Dawidowicz - www.alandawi.com.ar
 */
?>

<?php get_header(); ?>

	<?php if (is_category()) { ?>
	    <h1 class="archive-title h2">
		    <span>Posts Categorized:</span> <?php single_cat_title(); ?>
    	</h1>
    
    <?php } elseif (is_tag()) { ?> 
	    <h1 class="archive-title h2">
		    <span>Posts Tagged:</span> <?php single_tag_title(); ?>
	    </h1>
    
    <?php } elseif (is_author()) { 
    	global $post;
    	$author_id = $post->post_author;
    ?>
	    <h1 class="archive-title h2">
	    	<span>Posts By:</span> <?php echo get_the_author_meta('display_name', $author_id); ?>
	    </h1>
    <?php } elseif (is_day()) { ?>
	    <h1 class="archive-title h2">
			<span>Daily Archives:</span> <?php the_time('l, F j, Y'); ?>
	    </h1>

	<?php } elseif (is_month()) { ?>
	    <h1 class="archive-title h2">
	    	<span>Monthly Archives:</span> <?php the_time('F Y'); ?>
        </h1>

    <?php } elseif (is_year()) { ?>
        <h1 class="archive-title h2">
    	    <span>Yearly Archives:</span> <?php the_time('Y'); ?>
        </h1>
    <?php } ?>

	<?php get_template_part( 'loop', 'index' ); ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>