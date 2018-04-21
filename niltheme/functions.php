<?php 
	function nilTheme_resource(){
		wp_enqueue_style('style', get_stylesheet_uri());
	}

	add_action('wp_enqueue_scripts' , 'nilTheme_resource');

	

	// Top Mos Ancestor
	function get_top_most_ancestor_id(){

		global $post;
		if ($post->post_parent) {
			$ancestors = array_reverse(get_post_ancestors( $post->ID ));
			return $ancestors[0];
		}

		return $post->ID;
	}

	/* Cheking Page Has Children or Not */
	function has_children(){

		global $post;

		$pages = get_pages( 'child_of=' . $post->ID );

		return count($pages);
	}

	//Customize Excerpt Word Limit
	function change_excerpt_limit(){
		return 25;
	}

	add_filter( 'excerpt_length', 'change_excerpt_limit');

	//Verious Setups for This Theme
	function nilsTheme_setup(){

		/*Navigation menu location registration*/
		register_nav_menus( array(
			'primary' => __('Primary Menu'),
			'footer' => __('Footer Menu'),
		) );

		//Add Featured Image Support
		add_theme_support('post-thumbnails');
		add_image_size( 'small-thumbnail', 180, 120, true );
		add_image_size( 'banner-image', 920, 220, array('left', 'top') );

		//Add Post Format Support
		add_theme_support( 'post-formats' , array('aside' , 'gallery' , 'link') );
	}

	add_action('after_setup_theme', 'nilsTheme_setup');

	//Add Widget Location
	function siteWidgetsInit(){
		
		register_sidebar( array(
					'name' => 'Sidebar',
					'id' => 'sidebar1',
					'before_widget' => '<div class="widget-item">',
					'after_widget' => '</div>',
					'before_title' => '<h4 class="widget-item-title">',
					'after_title' => '</h4>'
		) );

		register_sidebar( array(
			'name' => 'Footer Area 1',
			'id' => 'footer1',
			'before_widget' => '<div class="widget-item">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="widget-item-title">',
			'after_title' => '</h4>'
		) );

		

		register_sidebar( array(
			'name' => 'Footer Area 2',
			'id' => 'footer2',
			'before_widget' => '<div class="widget-item">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="widget-item-title">',
			'after_title' => '</h4>'
		) );

		register_sidebar( array(
			'name' => 'Footer Area 3',
			'id' => 'footer3',
			'before_widget' => '<div class="widget-item">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="widget-item-title">',
			'after_title' => '</h4>'
		) );

		register_sidebar( array(
			'name' => 'Footer Area 4',
			'id' => 'footer4',
			'before_widget' => '<div class="widget-item">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="widget-item-title">',
			'after_title' => '</h4>'
		) );

	}

	add_action( 'widgets_init', 'siteWidgetsInit' );

	//Customize Appearance Options
	function nilTheme_customize_register($wp_customize){

		$wp_customize->add_setting( 'ntheme_link_color', array(
			'default' => '#E72E31',
			'transport' => 'refresh',
		) );

		$wp_customize->add_setting( 'ntheme_btn_color', array(
			'default' => '#E72E31',
			'transport' => 'refresh',
		) );

		$wp_customize->add_setting( 'ntheme_sidebar_color', array(
			'default' => '#ffff00',
			'transport' => 'refresh',
		) );

		$wp_customize->add_setting( 'ntheme_body_color', array(
			'default' => '#FDF8EE',
			'transport' => 'refresh',
		) );

		$wp_customize->add_section( 'ntheme_standard_colors', array(
			'title' => __('Standard Colors', 'Niltheme'),
			'priority' => 30,
		) );

		$wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize, 'ntheme_link_color_control', array(
			'label' => __('Link Color', 'Niltheme'),
			'section' => 'ntheme_standard_colors',
			'settings' => 'ntheme_link_color',
		) ) );

		$wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize, 'ntheme_btn_color_control', array(
			'label' => __('Button Color', 'Niltheme'),
			'section' => 'ntheme_standard_colors',
			'settings' => 'ntheme_btn_color',
		) ) );

		$wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize, 'ntheme_sidebar_color_control', array(
			'label' => __('Sidebar Color', 'Niltheme'),
			'section' => 'ntheme_standard_colors',
			'settings' => 'ntheme_sidebar_color',
		) ) );

		$wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize, 'ntheme_body_color_control', array(
			'label' => __('Body Color', 'Niltheme'),
			'section' => 'ntheme_standard_colors',
			'settings' => 'ntheme_body_color',
		) ) );


	}

	add_action( 'customize_register', 'nilTheme_customize_register' );

	//Customize CSS on live color change
	function nilTheme_live_css_change() { ?>

		<style type="text/css">
			
			a:link,
			a:visited{
				color: <?php echo get_theme_mod( 'ntheme_link_color' ); ?>;
			}

			.site-header nav ul li.current-menu-item a:link,
			.site-header nav ul li.current-menu-item a:visited,
			.site-header nav ul li.current-page-ancestor a:link,
			.site-header nav ul li.current-page-ancestor a:visited{
				background-color: <?php echo get_theme_mod( 'ntheme_link_color' ); ?>;
			}

			#searchsubmit{
				background: <?php echo get_theme_mod( 'ntheme_btn_color' ); ?> ;
			}

			.btn-a:link,
			.btn-a:visited{
				background-color: <?php echo get_theme_mod( 'ntheme_btn_color' ); ?> ;
			}

			.secondary-column{
				background-color: <?php echo get_theme_mod( 'ntheme_sidebar_color' ); ?> ;
			}

			body{
				background-color: <?php echo get_theme_mod( 'ntheme_body_color' ); ?>
			}

		</style>

	<?php }

	add_action( 'wp_head', 'nilTheme_live_css_change' );

	//Footer Calout Section Customization in Admin
	function nilTheme_footer_callout($wp_customize){

		$wp_customize->add_section('ntheme_footer_callout_section', array(
			'title' => 'Footer Callout'
		));

		$wp_customize->add_setting('ntheme_footer_callout_display', array(
			'default' => 'No',
		));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'nilTheme_footer_callout_display_control', array(
				'label' => 'Display this section?',
				'section' => 'ntheme_footer_callout_section',
				'settings' => 'ntheme_footer_callout_display',
				'type' => 'select',
				'choices' => array('No' => 'No', 'Yes' => 'Yes')
		)));

		$wp_customize->add_setting('ntheme_footer_callout_headline', array(
			'default' => 'Example Headline Text',
		));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'nilTheme_footer_callout_headline_control', array(
				'label' => 'Headline Text',
				'section' => 'ntheme_footer_callout_section',
				'settings' => 'ntheme_footer_callout_headline'
		)));

		$wp_customize->add_setting('ntheme_footer_callout_text', array(
			'default' => 'Lorem Ipsum Text for Testing',
		));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'nilTheme_footer_callout_text_control', array(
				'label' => 'Content Body',
				'section' => 'ntheme_footer_callout_section',
				'settings' => 'ntheme_footer_callout_text',
				'type' => 'textarea'
		)));

		$wp_customize->add_setting('ntheme_footer_callout_link');

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'nilTheme_footer_callout_link_control', array(
				'label' => 'Page Link',
				'section' => 'ntheme_footer_callout_section',
				'settings' => 'ntheme_footer_callout_link',
				'type' => 'dropdown-pages'
		)));

		$wp_customize->add_setting('ntheme_footer_callout_img');

		$wp_customize->add_control(new WP_Customize_Cropped_Image_Control($wp_customize, 'nilTheme_footer_callout_img_control', array(
				'label' => 'Select Image',
				'section' => 'ntheme_footer_callout_section',
				'settings' => 'ntheme_footer_callout_img',
				'width' => 750,
				'height' => 500
		)));

	}

	add_action('customize_register', 'nilTheme_footer_callout');