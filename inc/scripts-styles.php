<?php
add_action( 'wp_enqueue_scripts', 'olsen_light_enqueue_scripts' );
function olsen_light_enqueue_scripts() {
	$suffix = olsen_light_scripts_styles_suffix();
	/*
	 * Styles
	 */
	$theme = wp_get_theme();

	$font_url = '';
	/* translators: If there are characters in your language that are not supported by Lora and Lato, translate this to 'off'. Do not translate into your own language. */
	$font_url = add_query_arg(
		array(
			'family'  => urlencode( 'Lora:400,700,400italic,700italic|Lato:400,400italic,700,700italic' ),
			'display' => 'swap',
		),
		'https://fonts.googleapis.com/css'
	);

	wp_register_style( 'olsen-light-google-font', esc_url_raw( $font_url ) );

	wp_register_style( 'olsen-icons', get_template_directory_uri() . "/vendor/olsen-icons/css/olsen-icons{$suffix}.css", array(), $theme->get( 'Version' ) );
	wp_register_style( 'tiny-slider', get_template_directory_uri() . "/vendor/tiny-slider/tiny-slider{$suffix}.css", array(), '2.9.3' );
	wp_register_style( 'simple-lightbox', get_template_directory_uri() . "/vendor/simple-lightbox/simple-lightbox{$suffix}.css", array(), '2.7.0' );

	wp_register_style(
		'olsen-light-dependencies',
		false,
		array(
			'olsen-light-google-font',
			'olsen-icons',
		),
		$theme->get( 'Version' )
	);

	$main_dependencies = array(
		'olsen-light-dependencies',
	);

	if ( ( 1 === get_theme_mod( 'home_slider_show', 1 ) && is_home() ) || ( class_exists( 'Wpzoom_Instagram_Widget' ) && is_active_sidebar( 'footer-widgets' ) ) ) {
		array_push( $main_dependencies, 'tiny-slider' );
	}

	if ( is_singular() ) {
		array_push( $main_dependencies, 'simple-lightbox' );
	}

	if ( is_child_theme() ) {
		wp_enqueue_style(
			'olsen-light-style-child',
			get_stylesheet_directory_uri() . '/style.css',
			array(
				$main_dependencies,
			),
			$theme->get( 'Version' )
		);
	}

	wp_enqueue_style( 'olsen-light-style', get_stylesheet_uri(), $main_dependencies, $theme->get( 'Version' ) );

	/*
	 * Scripts
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_register_script( 'simple-lightbox', get_template_directory_uri() . "/vendor/simple-lightbox/simple-lightbox{$suffix}.js", array(), '2.7.0', true );
	wp_register_script( 'simple-lightbox-init', get_template_directory_uri() . "/js/simple-lightbox-init{$suffix}.js", array( 'simple-lightbox' ), $theme->get( 'Version' ), true );

	wp_register_script( 'tiny-slider', get_template_directory_uri() . "/vendor/tiny-slider/tiny-slider{$suffix}.js", array(), '2.9.3', true );
	wp_register_script( 'tiny-slider-init', get_template_directory_uri() . "/js/tiny-slider-init{$suffix}.js", array( 'tiny-slider' ), $theme->get( 'Version' ), true );

	wp_register_script( 'search-init', get_template_directory_uri() . "/js/search-init{$suffix}.js", array(), $theme->get( 'Version' ), true );
	wp_register_script( 'instagram-init', get_template_directory_uri() . "/js/instagram-init{$suffix}.js", array( 'tiny-slider' ), $theme->get( 'Version' ), true );

	/*
	 * Enqueue
	 */
	wp_enqueue_script(
		'olsen-light-front-scripts',
		get_template_directory_uri() . "/js/scripts{$suffix}.js",
		array(),
		$theme->get( 'Version' ),
		true
	);

	if ( 1 === get_theme_mod( 'home_slider_show', 1 ) && is_home() ) {
		wp_enqueue_script( 'tiny-slider-init' );
	}

	if ( 1 === get_theme_mod( 'header_searchform', 0 ) ) {
		wp_enqueue_script( 'search-init' );
	}

	if ( class_exists( 'Wpzoom_Instagram_Widget' ) && is_active_sidebar( 'footer-widgets' ) ) {
		wp_enqueue_script( 'instagram-init' );
	}

	if ( is_singular() ) {
		wp_enqueue_script( 'simple-lightbox-init' );
	}

}

add_action( 'admin_enqueue_scripts', 'olsen_light_admin_enqueue_scripts' );
function olsen_light_admin_enqueue_scripts( $hook ) {
	$theme = wp_get_theme();

	/*
	 * Styles
	 */

	/*
	 * Scripts
	 */

	/*
	 * Enqueue
	 */
	if ( in_array( $hook, array( 'post.php', 'post-new.php' ) ) ) {
		wp_enqueue_media();
		wp_enqueue_style( 'olsen-light-post-meta' );
		wp_enqueue_script( 'olsen-light-post-meta' );
	}

	if ( in_array( $hook, array( 'profile.php', 'user-edit.php' ) ) ) {
		wp_enqueue_media();
		wp_enqueue_style( 'olsen-light-post-meta' );
		wp_enqueue_script( 'olsen-light-post-meta' );
	}

	if ( in_array( $hook, array( 'widgets.php', 'customize.php' ) ) ) {
		wp_enqueue_media();
		wp_enqueue_style( 'olsen-light-post-meta' );
		wp_enqueue_script( 'olsen-light-post-meta' );
	}

}

add_filter( 'style_loader_tag', 'olsen_light_preload_google_font', 10, 2 );
function olsen_light_preload_google_font( $html, $handle ) {
	if ( 'olsen-light-google-font' === $handle ) {
		return str_replace(
			"rel='stylesheet'",
			"rel='preload' as='style' onload=\"this.rel='stylesheet'\"",
			$html
		);
	}
	return $html;
}
