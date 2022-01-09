<?php
add_action( 'after_setup_theme', 'olsen_light_setup_helpers_post_meta' );
function olsen_light_setup_helpers_post_meta() {
	add_image_size( 'ci_featgal_small_thumb', 100, 100, true );

}

add_action( 'admin_enqueue_scripts', 'olsen_light_admin_register_post_meta_scripts' );
function olsen_light_admin_register_post_meta_scripts( $hook ) {
	$theme = wp_get_theme();

	wp_register_style( 'olsen-light-post-meta', get_template_directory_uri() . '/inc/post-meta/assets/post-meta.css', array(), $theme->get( 'Version' ) );
	wp_register_script( 'olsen-light-post-meta', get_template_directory_uri() . '/inc/post-meta/assets/post-meta.js', array(
		'media-editor',
		'jquery',
		'jquery-ui-sortable'
	), $theme->get( 'Version' ) );

	$settings = array(
		'ajaxurl'             => admin_url( 'admin-ajax.php' ),
		'tSelectFile'         => esc_html__( 'Select file', 'olsen-light' ),
		'tSelectFiles'        => esc_html__( 'Select files', 'olsen-light' ),
		'tUseThisFile'        => esc_html__( 'Use this file', 'olsen-light' ),
		'tUseTheseFiles'      => esc_html__( 'Use these files', 'olsen-light' ),
		'tUpdateGallery'      => esc_html__( 'Update gallery', 'olsen-light' ),
		'tLoading'            => esc_html__( 'Loading...', 'olsen-light' ),
		'tPreviewUnavailable' => esc_html__( 'Gallery preview not available.', 'olsen-light' ),
		'tRemoveImage'        => esc_html__( 'Remove image', 'olsen-light' ),
		'tRemoveFromGallery'  => esc_html__( 'Remove from gallery', 'olsen-light' ),
	);
	wp_localize_script( 'olsen-light-post-meta', 'olsen_light_PostMeta', $settings );
}
