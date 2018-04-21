<?php get_header();?>

<div class="site-content clearfix">
	
	<div class="main-column">
		<?php if(have_posts()) : 
			while(have_posts()) : the_post();
				
				get_template_part( 'content' , get_post_format() );
			
			endwhile;

			echo paginate_links();

			// previous_posts_link( );
			// next_posts_link();
		?>
		<?php 
			else :
			
				echo('No Content Found');
			
			endif; 
		?>
	</div>

	<?php get_sidebar(); ?>

</div>

<?php get_footer();?>
