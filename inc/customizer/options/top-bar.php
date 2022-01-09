<?php
$wpc->add_section( 'top-bar', array(
	'title'       => _x( 'Top Bar Options', 'customizer section title', 'olsen-light' ),
	'description' => wp_kses(
		sprintf(
		/* translators: %s is a URL */
			__( 'To show/hide the top bar set/unset the menu in the <strong>Top Bar</strong> menu location. Check out the <a href="%s" target="_blank">documentation</a> for more info.', 'olsen-light' ),
			olsen_light_documentation_url() . '#-customizing-the-appearance'
		),
		olsen_light_get_allowed_tags( 'guide' )
	),
	'priority'    => 1,
) );

$wpc->add_setting( 'topbar_socials', array(
	'default'           => 1,
	'sanitize_callback' => 'olsen_light_sanitize_checkbox',
) );
$wpc->add_control( 'topbar_socials', array(
	'type'    => 'checkbox',
	'section' => 'top-bar',
	'label'   => __( 'Show social icons.', 'olsen-light' ),
) );
