<?php
function olsen_light_wrap_archive_widget_post_counts_in_span( $output ) {
	$output = preg_replace_callback( '#(<li>.*?<a.*?>.*?</a>.*)&nbsp;(\(.*?\))(.*?</li>)#', 'olsen_light_replace_archive_widget_post_counts_in_span', $output );

	return $output;
}

function olsen_light_replace_archive_widget_post_counts_in_span( $matches ) {
	return sprintf( '%s<span class="ci-count">%s</span>%s',
		$matches[1],
		$matches[2],
		$matches[3]
	);
}

function olsen_light_wrap_category_widget_post_counts_in_span( $output, $args ) {
	if ( ! isset( $args['show_count'] ) || $args['show_count'] == 0 ) {
		return $output;
	}
	$output = preg_replace_callback( '#(<a.*?>\s*)(\(.*?\))#', 'olsen_light_replace_category_widget_post_counts_in_span', $output );

	return $output;
}

function olsen_light_replace_category_widget_post_counts_in_span( $matches ) {
	return sprintf( '%s<span class="ci-count">%s</span>',
		$matches[1],
		$matches[2]
	);
}


/**
 * Returns the appropriate page(d) query variable to use in custom loops (needed for pagination).
 *
 * @uses get_query_var()
 *
 * @param int $default_return The default page number to return, if no query vars are set.
 * @return int The appropriate paged value if found, else 0.
 */
function olsen_light_get_page_var( $default_return = 0 ) {
	$paged = get_query_var( 'paged', false );
	$page  = get_query_var( 'page', false );

	if ( $paged === false && $page === false ) {
		return $default_return;
	}

	return max( $paged, $page );
}

/**
 * Returns just the URL of an image attachment.
 *
 * @param int $image_id The Attachment ID of the desired image.
 * @param string $size The size of the image to return.
 * @return bool|string False on failure, image URL on success.
 */
function olsen_light_get_image_src( $image_id, $size = 'full' ) {
	$img_attr = wp_get_attachment_image_src( intval( $image_id ), $size );
	if ( ! empty( $img_attr[0] ) ) {
		return $img_attr[0];
	}
}

if ( ! function_exists( 'ci_get_related_posts' ) ):
/**
 * Returns a set of related posts, or the arguments needed for such a query.
 *
 * @uses wp_parse_args()
 * @uses get_post_type()
 * @uses get_post()
 * @uses get_object_taxonomies()
 * @uses get_the_terms()
 * @uses wp_list_pluck()
 *
 * @param int $post_id A post ID to get related posts for.
 * @param int $related_count The number of related posts to return.
 * @param array $args Array of arguments to change the default behavior.
 * @return object|array A WP_Query object with the results, or an array with the query arguments.
 */
function ci_get_related_posts( $post_id, $related_count, $args = array() ) {
	$args = wp_parse_args( (array) $args, array(
		'orderby' => 'rand',
		'return'  => 'query', // Valid values are: 'query' (WP_Query object), 'array' (the arguments array)
	) );

	$post_type = get_post_type( $post_id );
	$post      = get_post( $post_id );

	$term_list  = array();
	$query_args = array();
	$tax_query  = array();
	$taxonomies = get_object_taxonomies( $post, 'names' );

	foreach ( $taxonomies as $taxonomy ) {
		$terms = get_the_terms( $post_id, $taxonomy );
		if ( is_array( $terms ) and count( $terms ) > 0 ) {
			$term_list = wp_list_pluck( $terms, 'slug' );
			$term_list = array_values( $term_list );
			if ( ! empty( $term_list ) ) {
				$tax_query['tax_query'][] = array(
					'taxonomy' => $taxonomy,
					'field'    => 'slug',
					'terms'    => $term_list
				);
			}
		}
	}

	if ( count( $taxonomies ) > 1 ) {
		$tax_query['tax_query']['relation'] = 'OR';
	}

	$query_args = array(
		'post_type'      => $post_type,
		'posts_per_page' => $related_count,
		'post_status'    => 'publish',
		'post__not_in'   => array( $post_id ),
		'orderby'        => $args['orderby']
	);

	if ( $args['return'] == 'query' ) {
		return new WP_Query( array_merge( $query_args, $tax_query ) );
	} else {
		return array_merge( $query_args, $tax_query );
	}
}
endif;

if ( ! function_exists( 'olsen_light_inflect' ) ):
	/**
	 * Returns a string depending on the value of $num.
	 *
	 * When $num equals zero, string $none is returned.
	 * When $num equals one, string $one is returned.
	 * When $num is any other number, string $many is returned.
	 *
	 * @access public
	 *
	 * @param int $num
	 * @param string $none
	 * @param string $one
	 * @param string $many
	 *
	 * @return string
	 */
	function olsen_light_inflect( $num, $none, $one, $many ) {
		if ( $num == 0 ) {
			return $none;
		} elseif ( $num == 1 ) {
			return $one;
		} else {
			return $many;
		}
	}
endif;

if ( ! function_exists( 'olsen_light_e_inflect' ) ):
	/**
	 * Echoes a string depending on the value of $num.
	 *
	 * When $num equals zero, string $none is echoed.
	 * When $num equals one, string $one is echoed.
	 * When $num is any other number, string $many is echoed.
	 *
	 * @access public
	 *
	 * @param int $num
	 * @param string $none
	 * @param string $one
	 * @param string $many
	 *
	 * @return void
	 */
	function olsen_light_e_inflect( $num, $none, $one, $many ) {
		echo olsen_light_inflect( $num, $none, $one, $many );
	}
endif;

/**
 * Determine whether a plugin is active.
 *
 * @param string $plugin The path to the plugin file, relative to the plugins directory.
 * @return bool True if plugin is active, false otherwise.
 */
function olsen_light_can_use_plugin( $plugin ) {
	if ( ! function_exists( 'is_plugin_active' ) ) {
		require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	}

	return is_plugin_active( $plugin );
}

// Make sure this function is defined, even if the plugin is disabled.
if ( ! function_exists( 'olsen_light_documentation_url' ) ) {
	/**
	 * Returns the URL to the theme's documentation page.
	 *
	 * @return string
	 */
	function olsen_light_documentation_url() {
		$url = 'https://www.cssigniter.com/docs/olsen-light/';

		return apply_filters( 'olsen_light_documentation_url', $url );
	}
}

if ( ! function_exists( 'olsen_light_get_social_networks') ) {
	function olsen_light_get_social_networks() {
		return array(
			array(
				'name'  => 'facebook',
				'label' => esc_html__( 'Facebook', 'olsen-light' ),
				'icon'  => 'olsen-icons-facebook',
			),
			array(
				'name'  => 'twitter',
				'label' => esc_html__( 'Twitter', 'olsen-light' ),
				'icon'  => 'olsen-icons-twitter',
			),
			array(
				'name'  => 'pinterest',
				'label' => esc_html__( 'Pinterest', 'olsen-light' ),
				'icon'  => 'olsen-icons-pinterest',
			),
			array(
				'name'  => 'instagram',
				'label' => esc_html__( 'Instagram', 'olsen-light' ),
				'icon'  => 'olsen-icons-instagram',
			),
			array(
				'name'  => 'linkedin',
				'label' => esc_html__( 'LinkedIn', 'olsen-light' ),
				'icon'  => 'olsen-icons-linkedin',
			),
			array(
				'name'  => 'tumblr',
				'label' => esc_html__( 'Tumblr', 'olsen-light' ),
				'icon'  => 'olsen-icons-tumblr',
			),
			array(
				'name'  => 'flickr',
				'label' => esc_html__( 'Flickr', 'olsen-light' ),
				'icon'  => 'olsen-icons-flickr',
			),
			array(
				'name'  => 'bloglovin',
				'label' => esc_html__( 'Bloglovin', 'olsen-light' ),
				'icon'  => 'olsen-icons-heart',
			),
			array(
				'name'  => 'youtube',
				'label' => esc_html__( 'YouTube', 'olsen-light' ),
				'icon'  => 'olsen-icons-youtube-play',
			),
			array(
				'name'  => 'vimeo',
				'label' => esc_html__( 'Vimeo', 'olsen-light' ),
				'icon'  => 'olsen-icons-vimeo',
			),
			array(
				'name'  => 'dribbble',
				'label' => esc_html__( 'Dribbble', 'olsen-light' ),
				'icon'  => 'olsen-icons-dribbble',
			),
			array(
				'name'  => 'wordpress',
				'label' => esc_html__( 'WordPress', 'olsen-light' ),
				'icon'  => 'olsen-icons-wordpress',
			),
			array(
				'name'  => '500px',
				'label' => esc_html__( '500px', 'olsen-light' ),
				'icon'  => 'olsen-icons-500px',
			),
			array(
				'name'  => 'soundcloud',
				'label' => esc_html__( 'Soundcloud', 'olsen-light' ),
				'icon'  => 'olsen-icons-soundcloud',
			),
			array(
				'name'  => 'spotify',
				'label' => esc_html__( 'Spotify', 'olsen-light' ),
				'icon'  => 'olsen-icons-spotify',
			),
			array(
				'name'  => 'vine',
				'label' => esc_html__( 'Vine', 'olsen-light' ),
				'icon'  => 'olsen-icons-vine',
			),
			array(
				'name'  => 'tripadvisor',
				'label' => esc_html__( 'Trip Advisor', 'olsen-light' ),
				'icon'  => 'olsen-icons-tripadvisor',
			),
			array(
				'name'  => 'telegram',
				'label' => esc_html__( 'Telegram', 'olsen-light' ),
				'icon'  => 'olsen-icons-telegram',
			),
			array(
				'name'  => 'tiktok',
				'label' => esc_html__( 'TikTok', 'olsen-light' ),
				'icon'  => 'olsen-icons-tiktok',
			),
		);
	}
}

if ( ! function_exists( 'olsen_light_pagination' ) ):
	/**
	 * Echoes pagination links if applicable. Output depends on pagination method selected from the customizer.
	 *
	 * @param array $args An array of arguments to change default behavior.
	 * @param object|bool $query A WP_Query object to paginate. Defaults to boolean false and uses the global $wp_query
	 *
	 * @return void
	 */
	function olsen_light_pagination( $args = array(), $query = false ) {
		$args = wp_parse_args( $args, apply_filters( 'olsen_light_pagination_default_args', array(
			'container_id'        => 'paging',
			'container_class'     => 'group',
			'prev_text'           => esc_html__( 'Previous page', 'olsen-light' ),
			'next_text'           => esc_html__( 'Next page', 'olsen-light' ),
			'paginate_links_args' => array()
		) ) );

		if ( 'object' != gettype( $query ) || 'WP_Query' != get_class( $query ) ) {
			global $wp_query;
			$query = $wp_query;
		}

		// Set things up for paginate_links()
		$unreal_pagenum = 999999999;
		$permastruct    = get_option( 'permalink_structure' );

		$paginate_links_args = wp_parse_args( $args['paginate_links_args'], array(
			'base'    => str_replace( $unreal_pagenum, '%#%', esc_url( get_pagenum_link( $unreal_pagenum ) ) ),
			'format'  => empty( $permastruct ) ? '&page=%#%' : 'page/%#%/',
			'total'   => $query->max_num_pages,
			'current' => max( 1, get_query_var( 'paged' ), get_query_var( 'page' ) ),
		) );

		$method = get_theme_mod( 'pagination_method', 'numbers' );

		if ( $query->max_num_pages > 1 ) {
			?>
			<div
			<?php echo empty( $args['container_id'] ) ? '' : 'id="' . esc_attr( $args['container_id'] ) . '"'; ?>
			<?php echo empty( $args['container_class'] ) ? '' : 'class="' . esc_attr( $args['container_class'] ) . '"'; ?>
			><?php

			switch ( $method ) {
				case 'text':
					previous_posts_link( $args['prev_text'] );
					next_posts_link( $args['next_text'], $query->max_num_pages );
					break;
				case 'numbers':
				default:
					echo paginate_links( $paginate_links_args );
					break;
			}

			?></div><?php
		}

	}
endif;
