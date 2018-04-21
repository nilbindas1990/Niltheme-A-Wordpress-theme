<?php if (is_single()) { ?>
	<article class="post">
<?php } else{ ?>
	<article class="post <?php if(has_post_thumbnail()){ ?>has-thumbnail <?php } ?>">
		<!--Post Thumbnail-->
		<div class="post-thumbnail">	
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('small-thumbnail'); ?></a>
		</div>
<?php } ?>
		<?php if (has_children() OR $post->post_parent > 0) { ?>
			<nav class="site-nav children-links clearfix">
				<span class="parent-link">
					<a href="<?php echo get_the_permalink(get_top_most_ancestor_id()); ?>">
						<?php echo get_the_title(get_top_most_ancestor_id()); ?>
					</a>
				</span>
				<ul>
					<?php
						$args = $arrayName = array(
						'child_of' => get_top_most_ancestor_id(),
						'title_li' => '' 
						);  
					?>
					<?php wp_list_pages($args); ?>
				</ul>
			</nav>
		<?php } ?>
		<h2><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>
		<p class="post-info"><?php the_time('jS F Y g:i a'); ?> | by 
		<a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a> | 
		<?php 

			$catagories = get_the_category();
			$separator = ", ";
			$output = '';

			if ($catagories) {

			foreach ($catagories as $cat) {

			$output .= '<a href = " '.get_category_link( $cat -> term_id ).'  ">'. $cat->cat_name .'</a>' . $separator;
			}

			echo trim($output, $separator);

			}

		?>
		</p>

		<?php if (is_search() OR is_archive()) { ?>
			<p>
			<?php echo get_the_excerpt();?>
			<a href="<?php the_permalink(); ?>">Read More&raquo;</a>
			</p>
		<?php } else{

			if ($post->post_excerpt) { ?>
				<p>
				<?php echo get_the_excerpt();?>
				<a href="<?php the_permalink(); ?>">Read More&raquo;</a>
				</p>
			<?php } else{
				if (is_single()) {
				the_post_thumbnail( 'banner-image' );
				}
				the_content();
			}

		} ?>
		<?php if(is_single( )) { ?>
			<div class="about-author clearfix">
				<div class="about-author-image">
					<?php echo get_avatar( get_the_author_meta( 'ID' ), 512 ) ?>
					<p><?php echo get_the_author_meta('nickname') ?></p>
				</div>

				<?php 
					$otherPosts = new WP_Query(array(
						'author' => get_the_author_meta( 'ID' ),
						'posts_per_page' => 2,
						'post__not_in' => array(get_the_ID())
					)); 
				?>

				<div class="about-author-text">
					<h3>About the Author</h3>
					<?php echo wpautop( get_the_author_meta( 'description' ) ); ?>
					<?php if($otherPosts->have_posts()) { ?>
						<div class="other-posts-by">
							<h4>Other posts by: <?php echo get_the_author_meta('nickname') ?></h4>
							<ul>
								<?php while($otherPosts->have_posts()) {
									$otherPosts->the_post(); ?>
									<li><a href="<?php the_permalink() ?>"><?php the_title() ?></a></li>
								<?php } ?>
								
							</ul>
						</div>
						<?php } wp_reset_postdata(); ?>
						<?php if(count_user_posts( get_the_author_meta('ID')) > 2) { ?>
							<a class="btn-a" href="<?php  echo get_author_posts_url( get_the_author_meta('ID')) ?>">
								View all posts by: <?php echo get_the_author_meta('nickname') ?>
							</a>
						<?php } ?>
				</div>
			</div>
		<?php } ?>
	</article>