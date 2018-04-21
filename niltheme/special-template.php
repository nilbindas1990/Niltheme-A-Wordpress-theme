<?php 

/*
Template Name: Special Layout
*/
get_header();

if(have_posts()) : ?>

<?php while(have_posts()) : the_post();?>
<article class="post page">
	<h2><?php the_title();?></h2>

	<div class="info-box">
		<h4>Disclaimer Title</h4>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse congue faucibus libero, ac dapibus lacus varius et. Mauris congue tristique vulputate. Ut ut massa justo. Aliquam iaculis eget orci a porttitor. Suspendisse potenti.</p>
	</div>
	<?php the_content();?>
</article>
	<?php endwhile;?>

<?php 
	else :
		echo('No Content Found');
	endif;
get_footer();
?>
