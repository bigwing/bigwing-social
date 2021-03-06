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
	
	// Fill Color
	$wp_customize->add_setting( 
		'bw_social[fill_color]',
		array(
			'type'    => 'option',
			'default' => 'gray'
		)	
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'bw_social[fill_color]',
		array(
			'label'   => __( 'Fill Color', 'bigwing-social' ),
			'section' => 'bw-social',
			'setting' => 'bw_social[fill_color]',
			'type'    => 'select',
			'choices' => array(
				'brand'   => __( 'Brand Colors', 'bigwing-social' ),
				'gray'    => _x( 'Gray', 'color', 'bigwing-social' ),
				'white'   => _x( 'White', 'color', 'bigwing-social' ), 
				'black'   => _x( 'Black', 'color', 'bigwing-social' ),
				'custom'  => __( 'Custom Color', 'bigwing-social' )
			),
		)
	) );
	
	// Fill Color Custom
	$wp_customize->add_setting( 
		'bw_social[fill_color_custom]',
		array(
			'type'    => 'option',
			'default' => '#767676'
		)	
	);
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'bw_social[fill_color_custom]',
		array(
			'label'   => __( 'Fill Color Custom', 'bigwing-social' ),
			'section' => 'bw-social',
			'setting' => 'bw_social[fill_color_custom]',
		)
	) );
}