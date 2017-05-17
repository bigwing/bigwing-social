<?php
add_action( 'customize_register', 'bwsocial_customize_register', 10, 1 );
function bwsocial_customize_register( $wp_customize ) {
	
	$wp_customize->add_section(
		'bw-social',
		array(
			'title' => __( 'Social', 'bigwing-social' )
		)
	);
	
	// Icon Size
	$wp_customize->add_setting( 
		'bw_social[icon_size]',
		array(
			'type'    => 'option',
			'default' => '24'
		)	
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'bw_social[icon_size]',
		array(
			'label'   => __( 'Icon Size', 'bigwing-social' ),
			'section' => 'bw-social',
			'setting' => 'bw_social[icon_size]',
			'type'    => 'select',
			'choices' => array(
				'18' => '18px',
				'24' => '24px',
				'36' => '36px', 
				'48' => '48px'
			),
		)
	) );
}