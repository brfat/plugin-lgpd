<?php
/*
Plugin Name: GDPR Compliance para WordPress
Plugin URI: https://github.com/brfat/plugin-lgpd
Description: Criação de Plugin para GDPR Compliance.
Version: 1.0
Author: Bruno José

*/

/*
GDPR Compliance is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
GDPR Compliance is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with GDPR Compliance. If not, see https://github.com/brfat/plugin-lgpd.
*/

if ( ! defined( 'ABSPATH' ) ) exit; 


//Adicionando CSS e JS no plugin GDPR Compliance
function register_styles() {

        wp_enqueue_style( 'style-lgpd',  plugin_dir_url( __FILE__ ) . 'css/style.css' );

        wp_enqueue_script('script-lgpd', plugin_dir_url( __FILE__ ) . 'js/main.js' );
 }
add_action( 'wp_enqueue_scripts', 'register_styles' );


    //Adicionando os campos no Customizer API
    function function_gdpr($wp_customize) {


        $wp_customize->add_section(
            'campos_de_texto',
            array(
            'title'       => 'GDPR Compliance para WordPress',
            'description' => 'Altere o conteudo dos termos GDPR Compliance aqui',
            'priority'    => 201,
        )
        );

        // Adicionando configuração do Textarea
        $wp_customize->add_setting(
            'campo1',
        array(
            'default'   => '', 
            'transport' => 'refresh',
        )
        );

        $wp_customize->add_control(new WP_Customize_Control(
            $wp_customize,
            "campo1", 
        array(
            "label"    => "Label do campo 1", 
            "section"  => "campos_de_texto",
            "settings" => "campo1",
            "type"     => "textarea",         )
        ));


        // Adicionando configuração da cor da fonte
        $wp_customize->add_setting(
            'campo5', 
        array(
            'default'   => '', 
            'transport' => 'refresh', 
        )
        );
        
        $wp_customize->add_control(new WP_Customize_Color_Control(
            $wp_customize,
            'campo5',
            array(
            'label' => 'Selecione a cor da fonte',
            'section' => 'campos_de_texto',
        )
        ));


         // Adicionando configuração do background
        $wp_customize->add_setting(
            'campo6', 
        array(
            'default'   => '', 
            'transport' => 'refresh', 
        )
        ); 
        $wp_customize->add_control(new WP_Customize_Color_Control(
            $wp_customize,
            'campo6',
            array(
            'label' => 'Selecione o background da seção LGPD',
            'section' => 'campos_de_texto',
        )
        ));
    }

    // Registrando a nossa função lgpd
    add_action('customize_register', 'function_gdpr');


    
   //Conteudo LGPD
    function content_gdpr() {
        $content = get_theme_mod(campo1);

        if ( empty ($content)) {
            return '<div class="content-gdpr">We use cookies to provide our services and for analytics and marketing. 
            To find out more about our use of cookies, please see our Privacy Policy. By continuing to browse our website, 
            you agree to our use of cookies.</div>';
        }

        else {
            return '<div class="content-gdpr" style="color:' . get_theme_mod(campo5) . ';background:'. get_theme_mod(campo6) . ';justify-content: center;">' . get_theme_mod(campo1) . '<a class="hide-content" href="#">Aceito</a></div>';
        }
    }

    add_action('the_content', 'content_gdpr');
