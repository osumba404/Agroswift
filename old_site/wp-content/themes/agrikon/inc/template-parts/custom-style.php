<?php

/*
** theme options panel and metabox settings
** will change some parts of theme via custom style
*/

function agrikon_custom_css()
{

  // stop on admin pages
    if (is_admin()) {
        return false;
    }

    // Redux global
    global $agrikon;

    /* CSS to output */
    $theCSS = '';

    /*************************************************
    ## Elementor SETTINGS
    *************************************************/

    if ('1' == agrikon_settings('use_elementor_style_kit')) {
        $theCSS .= '[class*=" elementor-kit-"] p.elementor-heading-title{
              line-height: inherit;
            }
        ';
    }

    /*************************************************
    ## PRELOADER SETTINGS
    *************************************************/

    if ('0' != agrikon_settings('preloader_visibility')) {
        $pretype = agrikon_settings('pre_type', 'default');
        $prebg = agrikon_settings('pre_bg', '#fff');
        $prebg = $prebg ? $prebg : '#f1f1f1';
        $spinclr = agrikon_settings('pre_spin', '#000');
        $spinclr = $spinclr ? $spinclr : '#000';
        if ( 'default' == $pretype ) {
            $theCSS .= 'body.dark .pace, body.light .pace { background-color: '. esc_attr( $spinclr ) .';}';
            $theCSS .= '#preloader:after, #preloader:before{ background-color:'. esc_attr( $prebg ) .';}';
        }

        $theCSS .= 'div#nt-preloader {background-color: '. esc_attr($prebg) .';overflow: hidden;background-repeat: no-repeat;background-position: center center;height: 100%;left: 0;position: fixed;top: 0;width: 100%;z-index: 9999999;}';
        $spin_rgb = agrikon_hex2rgb($spinclr);

        if ('01' == $pretype) {
            $theCSS .= '.loader01 {width: 56px;height: 56px;border: 8px solid '. $spinclr .';border-right-color: transparent;border-radius: 50%;position: relative;animation: loader-rotate 1s linear infinite;top: 50%;margin: -28px auto 0; }.loader01::after {content: "";width: 8px;height: 8px;background: '. $spinclr .';border-radius: 50%;position: absolute;top: -1px;left: 33px; }@keyframes loader-rotate {0% {transform: rotate(0); }100% {transform: rotate(360deg); } }';
        }
        if ('02' == $pretype) {
            $theCSS .= '.loader02 {width: 56px;height: 56px;border: 8px solid rgba('. $spin_rgb .', 0.25);border-top-color: '. $spinclr .';border-radius: 50%;position: relative;animation: loader-rotate 1s linear infinite;top: 50%;margin: -28px auto 0; }@keyframes loader-rotate {0% {transform: rotate(0); }100% {transform: rotate(360deg); } }';
        }
        if ('03' == $pretype) {
            $theCSS .= '.loader03 {width: 56px;height: 56px;border: 8px solid transparent;border-top-color: '. $spinclr .';border-bottom-color: '. $spinclr .';border-radius: 50%;position: relative;animation: loader-rotate 1s linear infinite;top: 50%;margin: -28px auto 0; }@keyframes loader-rotate {0% {transform: rotate(0); }100% {transform: rotate(360deg); } }';
        }
        if ('04' == $pretype) {
            $theCSS .= '.loader04 {width: 56px;height: 56px;border: 2px solid rgba('. $spin_rgb .', 0.5);border-radius: 50%;position: relative;animation: loader-rotate 1s ease-in-out infinite;top: 50%;margin: -28px auto 0; }.loader04::after {content: "";width: 10px;height: 10px;border-radius: 50%;background: '. $spinclr .';position: absolute;top: -6px;left: 50%;margin-left: -5px; }@keyframes loader-rotate {0% {transform: rotate(0); }100% {transform: rotate(360deg); } }';
        }
        if ('05' == $pretype) {
            $theCSS .= '.loader05 {width: 56px;height: 56px;border: 4px solid '. $spinclr .';border-radius: 50%;position: relative;animation: loader-scale 1s ease-out infinite;top: 50%;margin: -28px auto 0; }@keyframes loader-scale {0% {transform: scale(0);opacity: 0; }50% {opacity: 1; }100% {transform: scale(1);opacity: 0; } }';
        }
        if ('06' == $pretype) {
            $theCSS .= '.loader06 {width: 56px;height: 56px;border: 4px solid transparent;border-radius: 50%;position: relative;top: 50%;margin: -28px auto 0; }.loader06::before {content: "";border: 4px solid rgba('. $spin_rgb .', 0.5);border-radius: 50%;width: 67.2px;height: 67.2px;position: absolute;top: -9.6px;left: -9.6px;animation: loader-scale 1s ease-out infinite;animation-delay: 1s;opacity: 0; }.loader06::after {content: "";border: 4px solid '. $spinclr .';border-radius: 50%;width: 56px;height: 56px;position: absolute;top: -4px;left: -4px;animation: loader-scale 1s ease-out infinite;animation-delay: 0.5s; }@keyframes loader-scale {0% {transform: scale(0);opacity: 0; }50% {opacity: 1; }100% {transform: scale(1);opacity: 0; } }';
        }
        if ('07' == $pretype) {
            $theCSS .= '.loader07 {width: 16px;height: 16px;border-radius: 50%;position: relative;animation: loader-circles 1s linear infinite;top: 50%;margin: -8px auto 0; }@keyframes loader-circles {0% {box-shadow: 0 -27px 0 0 rgba('. $spin_rgb .', 0.05), 19px -19px 0 0 rgba('. $spin_rgb .', 0.1), 27px 0 0 0 rgba('. $spin_rgb .', 0.2), 19px 19px 0 0 rgba('. $spin_rgb .', 0.3), 0 27px 0 0 rgba('. $spin_rgb .', 0.4), -19px 19px 0 0 rgba('. $spin_rgb .', 0.6), -27px 0 0 0 rgba('. $spin_rgb .', 0.8), -19px -19px 0 0 '. $spinclr .'; }12.5% {box-shadow: 0 -27px 0 0 '. $spinclr .', 19px -19px 0 0 rgba('. $spin_rgb .', 0.05), 27px 0 0 0 rgba('. $spin_rgb .', 0.1), 19px 19px 0 0 rgba('. $spin_rgb .', 0.2), 0 27px 0 0 rgba('. $spin_rgb .', 0.3), -19px 19px 0 0 rgba('. $spin_rgb .', 0.4), -27px 0 0 0 rgba('. $spin_rgb .', 0.6), -19px -19px 0 0 rgba('. $spin_rgb .', 0.8); }25% {box-shadow: 0 -27px 0 0 rgba('. $spin_rgb .', 0.8), 19px -19px 0 0 '. $spinclr .', 27px 0 0 0 rgba('. $spin_rgb .', 0.05), 19px 19px 0 0 rgba('. $spin_rgb .', 0.1), 0 27px 0 0 rgba('. $spin_rgb .', 0.2), -19px 19px 0 0 rgba('. $spin_rgb .', 0.3), -27px 0 0 0 rgba('. $spin_rgb .', 0.4), -19px -19px 0 0 rgba('. $spin_rgb .', 0.6); }37.5% {box-shadow: 0 -27px 0 0 rgba('. $spin_rgb .', 0.6), 19px -19px 0 0 rgba('. $spin_rgb .', 0.8), 27px 0 0 0 '. $spinclr .', 19px 19px 0 0 rgba('. $spin_rgb .', 0.05), 0 27px 0 0 rgba('. $spin_rgb .', 0.1), -19px 19px 0 0 rgba('. $spin_rgb .', 0.2), -27px 0 0 0 rgba('. $spin_rgb .', 0.3), -19px -19px 0 0 rgba('. $spin_rgb .', 0.4); }50% {box-shadow: 0 -27px 0 0 rgba('. $spin_rgb .', 0.4), 19px -19px 0 0 rgba('. $spin_rgb .', 0.6), 27px 0 0 0 rgba('. $spin_rgb .', 0.8), 19px 19px 0 0 '. $spinclr .', 0 27px 0 0 rgba('. $spin_rgb .', 0.05), -19px 19px 0 0 rgba('. $spin_rgb .', 0.1), -27px 0 0 0 rgba('. $spin_rgb .', 0.2), -19px -19px 0 0 rgba('. $spin_rgb .', 0.3); }62.5% {box-shadow: 0 -27px 0 0 rgba('. $spin_rgb .', 0.3), 19px -19px 0 0 rgba('. $spin_rgb .', 0.4), 27px 0 0 0 rgba('. $spin_rgb .', 0.6), 19px 19px 0 0 rgba('. $spin_rgb .', 0.8), 0 27px 0 0 '. $spinclr .', -19px 19px 0 0 rgba('. $spin_rgb .', 0.05), -27px 0 0 0 rgba('. $spin_rgb .', 0.1), -19px -19px 0 0 rgba('. $spin_rgb .', 0.2); }75% {box-shadow: 0 -27px 0 0 rgba('. $spin_rgb .', 0.2), 19px -19px 0 0 rgba('. $spin_rgb .', 0.3), 27px 0 0 0 rgba('. $spin_rgb .', 0.4), 19px 19px 0 0 rgba('. $spin_rgb .', 0.6), 0 27px 0 0 rgba('. $spin_rgb .', 0.8), -19px 19px 0 0 '. $spinclr .', -27px 0 0 0 rgba('. $spin_rgb .', 0.05), -19px -19px 0 0 rgba('. $spin_rgb .', 0.1); }87.5% {box-shadow: 0 -27px 0 0 rgba('. $spin_rgb .', 0.1), 19px -19px 0 0 rgba('. $spin_rgb .', 0.2), 27px 0 0 0 rgba('. $spin_rgb .', 0.3), 19px 19px 0 0 rgba('. $spin_rgb .', 0.4), 0 27px 0 0 rgba('. $spin_rgb .', 0.6), -19px 19px 0 0 rgba('. $spin_rgb .', 0.8), -27px 0 0 0 '. $spinclr .', -19px -19px 0 0 rgba('. $spin_rgb .', 0.05); }100% {box-shadow: 0 -27px 0 0 rgba('. $spin_rgb .', 0.05), 19px -19px 0 0 rgba('. $spin_rgb .', 0.1), 27px 0 0 0 rgba('. $spin_rgb .', 0.2), 19px 19px 0 0 rgba('. $spin_rgb .', 0.3), 0 27px 0 0 rgba('. $spin_rgb .', 0.4), -19px 19px 0 0 rgba('. $spin_rgb .', 0.6), -27px 0 0 0 rgba('. $spin_rgb .', 0.8), -19px -19px 0 0 '. $spinclr .'; } }';
        }
        if ('08' == $pretype) {
            $theCSS .= '.loader08 {width: 20px;height: 20px;position: relative;animation: loader08 1s ease infinite;top: 50%;margin: -46px auto 0; }@keyframes loader08 {0%, 100% {box-shadow: -13px 20px 0 '. $spinclr .', 13px 20px 0 rgba('. $spin_rgb .', 0.2), 13px 46px 0 rgba('. $spin_rgb .', 0.2), -13px 46px 0 rgba('. $spin_rgb .', 0.2); }25% {box-shadow: -13px 20px 0 rgba('. $spin_rgb .', 0.2), 13px 20px 0 '. $spinclr .', 13px 46px 0 rgba('. $spin_rgb .', 0.2), -13px 46px 0 rgba('. $spin_rgb .', 0.2); }50% {box-shadow: -13px 20px 0 rgba('. $spin_rgb .', 0.2), 13px 20px 0 rgba('. $spin_rgb .', 0.2), 13px 46px 0 '. $spinclr .', -13px 46px 0 rgba('. $spin_rgb .', 0.2); }75% {box-shadow: -13px 20px 0 rgba('. $spin_rgb .', 0.2), 13px 20px 0 rgba('. $spin_rgb .', 0.2), 13px 46px 0 rgba('. $spin_rgb .', 0.2), -13px 46px 0 '. $spinclr .'; } }';
        }
        if ('09' == $pretype) {
            $theCSS .= '.loader09 {width: 10px;height: 48px;background: '. $spinclr .';position: relative;animation: loader09 1s ease-in-out infinite;animation-delay: 0.4s;top: 50%;margin: -28px auto 0; }.loader09::after, .loader09::before {content:  "";position: absolute;width: 10px;height: 48px;background: '. $spinclr .';animation: loader09 1s ease-in-out infinite; }.loader09::before {right: 18px;animation-delay: 0.2s; }.loader09::after {left: 18px;animation-delay: 0.6s; }@keyframes loader09 {0%, 100% {box-shadow: 0 0 0 '. $spinclr .', 0 0 0 '. $spinclr .'; }50% {box-shadow: 0 -8px 0 '. $spinclr .', 0 8px 0 '. $spinclr .'; } }';
        }
        if ('10' == $pretype) {
            $theCSS .= '.loader10 {width: 28px;height: 28px;border-radius: 50%;position: relative;animation: loader10 0.9s ease alternate infinite;animation-delay: 0.36s;top: 50%;margin: -42px auto 0; }.loader10::after, .loader10::before {content: "";position: absolute;width: 28px;height: 28px;border-radius: 50%;animation: loader10 0.9s ease alternate infinite; }.loader10::before {left: -40px;animation-delay: 0.18s; }.loader10::after {right: -40px;animation-delay: 0.54s; }@keyframes loader10 {0% {box-shadow: 0 28px 0 -28px '. $spinclr .'; }100% {box-shadow: 0 28px 0 '. $spinclr .'; } }';
        }
        if ('11' == $pretype) {
            $theCSS .= '.loader11 {width: 20px;height: 20px;border-radius: 50%;box-shadow: 0 40px 0 '. $spinclr .';position: relative;animation: loader11 0.8s ease-in-out alternate infinite;animation-delay: 0.32s;top: 50%;margin: -50px auto 0; }.loader11::after, .loader11::before {content:  "";position: absolute;width: 20px;height: 20px;border-radius: 50%;box-shadow: 0 40px 0 '. $spinclr .';animation: loader11 0.8s ease-in-out alternate infinite; }.loader11::before {left: -30px;animation-delay: 0.48s;}.loader11::after {right: -30px;animation-delay: 0.16s; }@keyframes loader11 {0% {box-shadow: 0 40px 0 '. $spinclr .'; }100% {box-shadow: 0 20px 0 '. $spinclr .'; } }';
        }
        if ('12' == $pretype) {
            $theCSS .= '.loader12 {width: 20px;height: 20px;border-radius: 50%;position: relative;animation: loader12 1s linear alternate infinite;top: 50%;margin: -50px auto 0; }@keyframes loader12 {0% {box-shadow: -60px 40px 0 2px '. $spinclr .', -30px 40px 0 0 rgba('. $spin_rgb .', 0.2), 0 40px 0 0 rgba('. $spin_rgb .', 0.2), 30px 40px 0 0 rgba('. $spin_rgb .', 0.2), 60px 40px 0 0 rgba('. $spin_rgb .', 0.2); }25% {box-shadow: -60px 40px 0 0 rgba('. $spin_rgb .', 0.2), -30px 40px 0 2px '. $spinclr .', 0 40px 0 0 rgba('. $spin_rgb .', 0.2), 30px 40px 0 0 rgba('. $spin_rgb .', 0.2), 60px 40px 0 0 rgba('. $spin_rgb .', 0.2); }50% {box-shadow: -60px 40px 0 0 rgba('. $spin_rgb .', 0.2), -30px 40px 0 0 rgba('. $spin_rgb .', 0.2), 0 40px 0 2px '. $spinclr .', 30px 40px 0 0 rgba('. $spin_rgb .', 0.2), 60px 40px 0 0 rgba('. $spin_rgb .', 0.2); }75% {box-shadow: -60px 40px 0 0 rgba('. $spin_rgb .', 0.2), -30px 40px 0 0 rgba('. $spin_rgb .', 0.2), 0 40px 0 0 rgba('. $spin_rgb .', 0.2), 30px 40px 0 2px '. $spinclr .', 60px 40px 0 0 rgba('. $spin_rgb .', 0.2); }100% {box-shadow: -60px 40px 0 0 rgba('. $spin_rgb .', 0.2), -30px 40px 0 0 rgba('. $spin_rgb .', 0.2), 0 40px 0 0 rgba('. $spin_rgb .', 0.2), 30px 40px 0 0 rgba('. $spin_rgb .', 0.2), 60px 40px 0 2px '. $spinclr .'; } }';
        }
    }


    $theCSS .= '.lazyloading {
      background-image: url('.get_template_directory_uri().'/images/loader.gif'.');
    }';

    $header_rippedimg = agrikon_settings( 'header_image_visibility', '1' );
    $all_rippedimg = agrikon_settings( 'theme_all_ripped_visibility', '1' );

    if( '0' == $header_rippedimg ){
        $theCSS .= '.main-menu::after {
            content: none!important;
        }';
    }
    
    if( '0' == $all_rippedimg ){
        $theCSS .= '.main-menu::after,
        .page-header::after,
        .bottom-footer::before,
        .nt-section-ripped-top::before,
        .nt-section-ripped-bottom::after{
            content: none!important;
        }';
    }

    $root_clr1 = agrikon_settings( 'theme_clr1' );
    $root_clr2 = agrikon_settings( 'theme_clr2' );
    $root_clr3 = agrikon_settings( 'theme_clr3' );
    $root_clr4 = agrikon_settings( 'theme_clr4' );

    if( $root_clr1 || $root_clr2 || $root_clr3 || $root_clr4 ) {
        $theCSS .= ':root {';
            $theCSS .= $root_clr1 ? '--thm-base: '.$root_clr1.';' : '';
            $theCSS .= $root_clr1 ? '--thm-base-rgb: '.agrikon_hex2rgb($root_clr1).';' : '';
            $theCSS .= $root_clr2 ? '--thm-primary: '.$root_clr2.';' : '';
            $theCSS .= $root_clr2 ? '--thm-primary-rgb: '.agrikon_hex2rgb($root_clr2).';' : '';
            $theCSS .= $root_clr3 ? '--thm-black: '.$root_clr3.';' : '';
            $theCSS .= $root_clr3 ? '--thm-black-rgb: '.agrikon_hex2rgb($root_clr3).';' : '';
            $theCSS .= $root_clr4 ? '--thm-black2: '.$root_clr4.';' : '';
            $theCSS .= $root_clr4 ? '--thm-black2-rgb: '.agrikon_hex2rgb($root_clr4).';' : '';
        $theCSS .= '}';
        
        $theCSS .= '.elementor-kit-1 {';
            $theCSS .= $root_clr1 ? '--e-global-color-d1d488c: '.$root_clr1.'!important;' : '';
            $theCSS .= $root_clr2 ? '--e-global-color-b0c891c: '.$root_clr2.'!important;' : '';
            $theCSS .= $root_clr3 ? '--e-global-color-344f31b: '.$root_clr3.'!important;' : '';
            $theCSS .= $root_clr4 ? '--e-global-color-5043a58: '.$root_clr4.'!important;' : '';
        $theCSS .= '}';
    }

    // use page/post ID for page settings
    $page_id = get_the_ID();

    /*************************************************
    ## THEME PAGINATION
    *************************************************/
    // pagination color
    $pag_clr = agrikon_settings('pag_clr');
    // pagination active and hover color
    $pag_hvrclr = agrikon_settings( 'pag_hvrclr' );
    // pagination number color
    $pag_nclr = agrikon_settings( 'pag_nclr' );
    // pagination active and hover color
    $pag_hvrnclr = agrikon_settings( 'pag_hvrnclr' );

    // pagination color
    if ( $pag_clr ) {
        $theCSS .= '
        .nt-pagination.-style-outline .nt-pagination-item .nt-pagination-link { border-color: '. esc_attr( $pag_clr ) .'; }
        .nt-pagination.-style-default .nt-pagination-link { background-color: '. esc_attr( $pag_clr ) .';
        }';
    }
    // pagination active and hover color
    if ($pag_hvrclr) {
        $theCSS .= '
        .nt-pagination.-style-outline .nt-pagination-item.active .nt-pagination-link,
        .nt-pagination.-style-outline .nt-pagination-item .nt-pagination-link:hover { border-color: '. esc_attr( $pag_hvrclr ) .'; }
        .nt-pagination.-style-default .nt-pagination-item.active .nt-pagination-link,
        .nt-pagination.-style-default .nt-pagination-item .nt-pagination-link:hover { background-color: '. esc_attr( $pag_hvrclr ) .';
        }';
    }
    // pagination number color
    if ( $pag_nclr ) {
        $theCSS .= '
        .nt-pagination.-style-outline .nt-pagination-item .nt-pagination-link,
        .nt-pagination.-style-default .nt-pagination-link { color: '. esc_attr( $pag_nclr ) .';
        }';
    }
    // pagination active and hover color
    if ( $pag_hvrnclr ) {
        $theCSS .= '
        .nt-pagination.-style-outline .nt-pagination-item.active .nt-pagination-link,
        .nt-pagination.-style-outline .nt-pagination-item .nt-pagination-link:hover,
        .nt-pagination.-style-default .nt-pagination-item.active .nt-pagination-link,
        .nt-pagination.-style-default .nt-pagination-item .nt-pagination-link:hover { color: '. esc_attr( $pag_hvrnclr ) .';
        }';
    }


    /*************************************************
    ## PAGE METABOX SETTINGS
    *************************************************/

    if ( is_page() && class_exists( 'ACF' ) && function_exists( 'get_field' ) ) {

        $h_all = get_field('agrikon_page_hero_customize');
        if ( !empty( $h_all["agrikon_page_hero_text_customize"] ) ) {
            $page_title_clr = $h_all["agrikon_page_hero_text_customize"]["agrikon_page_title_color"];
            if ( $page_title_clr ) {
                $theCSS .= '.page-'.$page_id.' .headline_title { color: '.$page_title_clr.'; }';
            }

            $page_subtitle_clr = $h_all["agrikon_page_hero_text_customize"]["agrikon_page_subtitle_color"];
            if ( $page_subtitle_clr ) {
                $theCSS .= '.page-'.$page_id.' .headline_summary { color: '.$page_subtitle_clr.'; }';
            }

            $hero_bg_clr = $h_all["agrikon_page_hero_background_customize"]["agrikon_page_hero_bg_color"];
            if ( $hero_bg_clr ) {
                 $theCSS .= '.page-'.$page_id.' { background-color: '.$hero_bg_clr.'; }';
            }
        }
    } // end if is_page

    /* Add CSS to style.css */
    wp_register_style('agrikon-custom-style', false);
    wp_enqueue_style('agrikon-custom-style');
    wp_add_inline_style('agrikon-custom-style', $theCSS);
}

add_action('wp_enqueue_scripts', 'agrikon_custom_css');


// customization on admin pages
function agrikon_admin_custom_css()
{
    if (! is_admin()) {
        return false;
    }

    /* CSS to output */
    $theCSS = '';

    $theCSS .= '
    #setting-error-tgmpa, #setting-error-agrikon {
        display: block !important;
    }
    .updated.vc_license-activation-notice {
        display:none;
    }
    .redux_field_th {
        color: #191919;
        font-weight: 700;
    }
    .redux-main .description {
        display: block;
        font-weight: normal;
    }
    #redux-header .rAds {
        opacity: 0 !important;
        display: none !important;
        visibility : hidden;
    }
    .redux-main .wp-picker-container .wp-color-result-text {
        line-height: 28px;
    }
    .redux-container .redux-main .input-append .add-on, .redux-container .redux-main .input-prepend .add-on {
        line-height: 22px;
    }
  	#customize-controls img {
  		max-width: 75%;
  	}
    .agrikon_gallery_mtb li {
        position: relative;
        display: inline-block;
        width: 80px;
        height: 80px;
        padding: 5px;
        border:1px solid transparent;
    }
    .agrikon_gallery_mtb li:hover {
        border-color: #ddd;
    }
    .agrikon_gallery_mtb li span{
        height: 80px;
        width: 80px;
        position: relative;
        display: inline-block;
        background-position: center;
        background-size: cover;
    }
    a.agrikon_gallery_remove{
        font-size: 14px;
        position: absolute;
        right: 5px;
        top: 5px;
        display: none;
        text-decoration: none;
        width: 15px;
        height: 15px;
        line-height: 15px;
        background: #f00;
        border-radius: 2px;
        color: #fff;
        text-align: center;
    }
    .agrikon_gallery_mtb li:hover > a.agrikon_gallery_remove{
        display: block;
    }
    ';
    // end $theCSS

    /* Add CSS to style.css */
    wp_register_style('agrikon-admin-custom-style', false);
    wp_enqueue_style('agrikon-admin-custom-style');
    wp_add_inline_style('agrikon-admin-custom-style', $theCSS);
}
add_action('admin_enqueue_scripts', 'agrikon_admin_custom_css');
