<?php

    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if (! class_exists('Redux' )) {
        return;
    }

    // This is your option name where all the Redux data is stored.
    $agrikon_pre = "agrikon";

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $agrikon_theme = wp_get_theme(); // For use with some settings. Not necessary.

    $agrikon_options_args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name' => $agrikon_pre,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name' => $agrikon_theme->get('Name' ),
        // Name that appears at the top of your panel
        'display_version' => $agrikon_theme->get('Version' ),
        // Version that appears at the top of your panel
        'menu_type' => 'submenu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu' => false,
        // Show the sections below the admin menu item or not
        'menu_title' => esc_html__( 'Theme Options', 'agrikon' ),
        'page_title' => esc_html__( 'Theme Options', 'agrikon' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key' => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography' => false,
        // Use a asynchronous font on the front end or font string
        'admin_bar' => false,
        // Show the panel pages on the admin bar
        'admin_bar_icon' => 'dashicons-admin-generic',
        // Choose an icon for the admin bar menu
        'admin_bar_priority' => 50,
        // Choose an priority for the admin bar menu
        'global_variable' => 'agrikon',
        // Set a different name for your global variable other than the agrikon_pre
        'dev_mode' => false,
        // Show the time the page took to load, etc
        'update_notice' => false,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer' => true,
        // Enable basic customizer support

        // OPTIONAL -> Give you extra features
        'page_priority' => 99,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent' => apply_filters( 'ninetheme_parent_slug', 'themes.php' ),
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions' => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon' => '',
        // Specify a custom URL to an icon
        'last_tab' => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon' => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug' => '',
        // Page slug used to denote the panel, will be based off page title then menu title then agrikon_pre if not provided
        'save_defaults' => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show' => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark' => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export' => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time' => 60 * MINUTE_IN_SECONDS,
        'output' => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag' => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database' => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn' => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
        'hints' => array(
            'icon' => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color' => 'lightgray',
            'icon_size' => 'normal',
            'tip_style' => array(
                'color' => 'dark',
                'shadow' => true,
                'rounded' => false,
                'style' => '',
            ),
            'tip_position' => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect' => array(
                'show' => array(
                    'effect' => 'slide',
                    'duration' => '500',
                    'event' => 'mouseover',
                ),
                'hide' => array(
                    'effect' => 'slide',
                    'duration' => '500',
                    'event' => 'click mouseleave',
                ),
            ),
        )
    );

    // ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
    $agrikon_options_args['admin_bar_links'][] = array(
        'id' => 'ninetheme-agrikon-docs',
        'href' => 'http://demo-ninetheme.com/agrikon/doc.html',
        'title' => esc_html__( 'agrikon Documentation', 'agrikon' ),
    );
    $agrikon_options_args['admin_bar_links'][] = array(
        'id' => 'ninetheme-support',
        'href' => 'https://9theme.ticksy.com/',
        'title' => esc_html__( 'Support', 'agrikon' ),
    );
    $agrikon_options_args['admin_bar_links'][] = array(
        'id' => 'ninetheme-portfolio',
        'href' => 'https://themeforest.net/user/ninetheme/portfolio',
        'title' => esc_html__( 'NineTheme Portfolio', 'agrikon' ),
    );

    // Add content after the form.
    $agrikon_options_args['footer_text'] = esc_html__( 'If you need help please read docs and open a ticket on our support center.', 'agrikon' );

    Redux::setArgs($agrikon_pre, $agrikon_options_args);

    /* END ARGUMENTS */

    /* START SECTIONS */


    /*************************************************
    ## MAIN SETTING SECTION
    *************************************************/
    Redux::setSection($agrikon_pre, array(
        'title' => esc_html__( 'Main Setting', 'agrikon' ),
        'id' => 'basic',
        'desc' => esc_html__( 'These are main settings for general theme!', 'agrikon' ),
        'icon' => 'el el-cog',
    ));
    //BREADCRUMBS SETTINGS SUBSECTION
    Redux::setSection($agrikon_pre, array(
        'title' => esc_html__( 'Theme Root Color', 'agrikon' ),
        'id' => 'themecolorsubsection',
        'icon' => 'el el-brush',
        'subsection' => true,
        'fields' => array(
            array(
                'title' => esc_html__( 'Theme Base Color', 'agrikon' ),
                'subtitle' => esc_html__( 'Add theme root base color.', 'agrikon' ),
                'id' => 'theme_clr1',
                'type' => 'color',
                'default' => ''
            ),
            array(
                'title' => esc_html__( 'Theme Primary Color', 'agrikon' ),
                'subtitle' => esc_html__( 'Add theme root primary color.', 'agrikon' ),
                'id' => 'theme_clr2',
                'type' => 'color',
                'default' => ''
            ),
            array(
                'title' => esc_html__( 'Theme Black Color', 'agrikon' ),
                'subtitle' => esc_html__( 'Add theme root black color.', 'agrikon' ),
                'id' => 'theme_clr3',
                'type' => 'color',
                'default' => ''
            ),
            array(
                'title' => esc_html__( 'Theme Black Color 2', 'agrikon' ),
                'subtitle' => esc_html__( 'Add theme root black color.', 'agrikon' ),
                'id' => 'theme_clr4',
                'type' => 'color',
                'default' => ''
            ),
        )
    ));
    //BREADCRUMBS SETTINGS SUBSECTION
    Redux::setSection($agrikon_pre, array(
        'title' => esc_html__( 'Breadcrumbs', 'agrikon' ),
        'id' => 'themebreadsubsection',
        'icon' => 'el el-brush',
        'subsection' => true,
        'fields' => array(
            array(
                'title' => esc_html__( 'Breadcrumbs', 'agrikon' ),
                'subtitle' => esc_html__( 'If enabled, adds breadcrumbs navigation to bottom of page title.', 'agrikon' ),
                'id' => 'breadcrumbs_visibility',
                'type' => 'switch',
                'default' => true
            ),
            array(
                'title' => esc_html__( 'Breadcrumbs Typography', 'agrikon' ),
                'id' => 'breadcrumbs_typo',
                'type' => 'typography',
                'font-backup' => false,
                'letter-spacing' => true,
                'text-transform' => true,
                'all_styles' => true,
                'output' => array( '.thm-breadcrumb, .thm-breadcrumb li a' ),
                'required' => array( 'breadcrumbs_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Breadcrumbs Current Color', 'agrikon' ),
                'id' => 'breadcrumbs_current',
                'type' => 'color',
                'default' => '',
                'output' => array( '.thm-breadcrumb li.breadcrumb_active' ),
                'required' => array( 'breadcrumbs_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Breadcrumbs Separator Color', 'agrikon' ),
                'id' => 'breadcrumbs_icon',
                'type' => 'color',
                'default' => '',
                'output' => array( '.thm-breadcrumb .breadcrumb_link_seperator' ),
                'required' => array( 'breadcrumbs_visibility', '=', '1' )
            )
        )
    ));
    //PRELOADER SETTINGS SUBSECTION
    Redux::setSection($agrikon_pre, array(
        'title' => esc_html__( 'Preloader', 'agrikon' ),
        'id' => 'themepreloadersubsection',
        'icon' => 'el el-brush',
        'subsection' => true,
        'fields' => array(
            array(
                'title' => esc_html__( 'Preloader', 'agrikon' ),
                'subtitle' => esc_html__( 'If enabled, adds preloader.', 'agrikon' ),
                'id' => 'preloader_visibility',
                'type' => 'switch',
                'default' => true
            ),
            array(
                'title' => esc_html__( 'Preloader Type', 'agrikon' ),
                'subtitle' => esc_html__( 'Select your preloader type.', 'agrikon' ),
                'id' => 'pre_type',
                'type' => 'select',
                'customizer' => true,
                'options' => array(
                    'default' => esc_html__( 'Default', 'agrikon' ),
                    '01' => esc_html__( 'Type 1', 'agrikon' ),
                    '02' => esc_html__( 'Type 2', 'agrikon' ),
                    '03' => esc_html__( 'Type 3', 'agrikon' ),
                    '04' => esc_html__( 'Type 4', 'agrikon' ),
                    '05' => esc_html__( 'Type 5', 'agrikon' ),
                    '06' => esc_html__( 'Type 6', 'agrikon' ),
                    '07' => esc_html__( 'Type 7', 'agrikon' ),
                    '08' => esc_html__( 'Type 8', 'agrikon' ),
                    '09' => esc_html__( 'Type 9', 'agrikon' ),
                    '10' => esc_html__( 'Type 10', 'agrikon' ),
                    '11' => esc_html__( 'Type 11', 'agrikon' ),
                    '12' => esc_html__( 'Type 12', 'agrikon' ),
                ),
                'default' => '01',
            ),
            array(
                'title' => esc_html__( 'Preloader Image', 'agrikon' ),
                'subtitle' => esc_html__( 'Upload your Logo. If left blank theme will use site default logo.', 'agrikon' ),
                'id' => 'pre_img',
                'type' => 'media',
                'url' => true,
                'customizer' => true,
                'required' => array(
                    array( 'preloader_visibility', '=', '1' ),
                    array( 'pre_type', '=', 'default' ),
                )
            ),
            array(
                'title' => esc_html__( 'Background Color', 'agrikon' ),
                'subtitle' => esc_html__( 'Add preloader background color.', 'agrikon' ),
                'id' => 'pre_bg',
                'type' => 'color',
                'default' => '',
                'required' => array( 'preloader_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Spin Color', 'agrikon' ),
                'subtitle' => esc_html__( 'Add preloader spin color.', 'agrikon' ),
                'id' => 'pre_spin',
                'type' => 'color',
                'default' => '',
                'required' => array( 'preloader_visibility', '=', '1' )
            )
    )));
    //MAIN THEME TYPOGRAPHY SUBSECTION
    Redux::setSection($agrikon_pre, array(
    'title' => esc_html__( 'Typograhy General', 'agrikon' ),
    'id' => 'themetypographysection',
    'icon' => 'el el-fontsize',
    'subsection' => true,
    'fields' => array(
        array(
            'title' => esc_html__( 'Use Elementor Style Kit', 'agrikon' ),
            'subtitle' => esc_html__( 'This option applies styles created with Elementor to pages not created with Elementor.', 'agrikon' ),
            'id' => 'use_elementor_style_kit',
            'type' => 'switch',
            'default' => false
        ),
        array(
            'title' => esc_html__( 'H1 Headings', 'agrikon' ),
            'subtitle' => esc_html__("Choose Size and Style for h1", 'agrikon' ),
            'id' => 'font_h1',
            'type' => 'typography',
            'font-backup' => false,
            'letter-spacing' => true,
            'text-transform' => true,
            'all_styles' => true,
            'output' => array( 'h1' ),
            'required' => array( 'use_elementor_style_kit', '!=', '1' )
        ),
        array(
            'title' => esc_html__( 'H2 Headings', 'agrikon' ),
            'subtitle' => esc_html__("Choose Size and Style for h2", 'agrikon' ),
            'id' => 'font_h2',
            'type' => 'typography',
            'font-backup' => false,
            'letter-spacing' => true,
            'text-transform' => true,
            'all_styles' => true,
            'output' => array( 'h2' ),
            'required' => array( 'use_elementor_style_kit', '!=', '1' )
        ),
        array(
            'title' => esc_html__( 'H3 Headings', 'agrikon' ),
            'subtitle' => esc_html__("Choose Size and Style for h3", 'agrikon' ),
            'id' => 'font_h3',
            'type' => 'typography',
            'font-backup' => false,
            'letter-spacing' => true,
            'text-transform' => true,
            'all_styles' => true,
            'output' => array( 'h3' ),
            'required' => array( 'use_elementor_style_kit', '!=', '1' )
        ),
        array(
            'title' => esc_html__( 'H4 Headings', 'agrikon' ),
            'subtitle' => esc_html__("Choose Size and Style for h4", 'agrikon' ),
            'id' => 'font_h4',
            'type' => 'typography',
            'font-backup' => false,
            'letter-spacing' => true,
            'text-transform' => true,
            'all_styles' => true,
            'output' => array( 'h4' ),
            'required' => array( 'use_elementor_style_kit', '!=', '1' )
        ),
        array(
            'title' => esc_html__( 'H5 Headings', 'agrikon' ),
            'subtitle' => esc_html__("Choose Size and Style for h5", 'agrikon' ),
            'id' => 'font_h5',
            'type' => 'typography',
            'font-backup' => false,
            'letter-spacing' => true,
            'text-transform' => true,
            'all_styles' => true,
            'output' => array( 'h5' ),
            'required' => array( 'use_elementor_style_kit', '!=', '1' )
        ),
        array(
            'title' => esc_html__( 'H6 Headings', 'agrikon' ),
            'subtitle' => esc_html__("Choose Size and Style for h6", 'agrikon' ),
            'id' => 'font_h6',
            'type' => 'typography',
            'font-backup' => false,
            'letter-spacing' => true,
            'text-transform' => true,
            'all_styles' => true,
            'output' => array( 'h6' ),
            'units' => 'px',
            'required' => array( 'use_elementor_style_kit', '!=', '1' )
        ),
        array(
            'id' =>'info_body_font',
            'type' => 'info',
            'customizer' => false,
            'desc' => esc_html__( 'Body Font Options', 'agrikon' ),
            'required' => array( 'use_elementor_style_kit', '!=', '1' )
        ),
        array(
            'title' => esc_html__( 'Body', 'agrikon' ),
            'subtitle' => esc_html__("Choose Size and Style for Body", 'agrikon' ),
            'id' => 'font_body',
            'type' => 'typography',
            'font-backup' => false,
            'letter-spacing' => true,
            'text-transform' => true,
            'all_styles' => true,
            'output' => array( 'body' ),
            'required' => array( 'use_elementor_style_kit', '!=', '1' )
        ),
        array(
            'title' => esc_html__( 'Paragraph', 'agrikon' ),
            'subtitle' => esc_html__("Choose Size and Style for paragraph", 'agrikon' ),
            'id' => 'font_p',
            'type' => 'typography',
            'font-backup' => false,
            'letter-spacing' => true,
            'text-transform' => true,
            'all_styles' => true,
            'output' => array( 'p, body.has-paragraph-style p' ),
            'required' => array( 'use_elementor_style_kit', '!=', '1' )
        )
    )));
    //BACKTOTOP BUTTON SUBSECTION
    Redux::setSection($agrikon_pre, array(
    'title' => esc_html__( 'Back-to-top Button', 'agrikon' ),
    'id' => 'backtotop',
    'icon' => 'el el-brush',
    'subsection' => true,
    'fields' => array(
        array(
            'title' => esc_html__( 'Back-to-top', 'agrikon' ),
            'subtitle' => esc_html__( 'Switch On-off', 'agrikon' ),
            'desc' => esc_html__( 'If enabled, adds back to top.', 'agrikon' ),
            'id' => 'backtotop_visibility',
            'type' => 'switch',
            'default' => true
        ),
        array(
            'title' => esc_html__( 'Bottom Offset', 'agrikon' ),
            'subtitle' => esc_html__( 'Set custom bottom offset for the back-to-top button', 'agrikon' ),
            'id' => 'backtotop_top_offset',
            'type' => 'spacing',
            'output' => array('.scroll-to-top'),
            'mode' => 'absolute',
            'units' => array('px'),
            'all' => false,
            'top' => false,
            'right' => true,
            'bottom' => true,
            'left' => false,
            'default' => array(
                'right' => '30',
                'bottom' => '30',
                'units' => 'px'
            ),
            'required' => array( 'backtotop_visibility', '=', '1' )
        ),
        array(
            'title' => esc_html__( 'Background Color', 'agrikon' ),
            'id' => 'backtotop_bg',
            'type' => 'color',
            'mode' => 'background-color',
            'validate' => 'color',
            'output' => array('.scroll-to-top'),
            'required' => array( 'backtotop_visibility', '=', '1' )
        ),
        array(
            'title' => esc_html__( 'Hover Background Color', 'agrikon' ),
            'id' => 'backtotop_hvrbg',
            'type' => 'color',
            'mode' => 'background-color',
            'validate' => 'color',
            'output' => array('.scroll-to-top:hover'),
            'required' => array( 'backtotop_visibility', '=', '1' )
        ),
        array(
            'title' => esc_html__( 'Arrow Color', 'agrikon' ),
            'id' => 'backtotop_icon',
            'type' => 'color',
            'default' =>  '',
            'validate' => 'color',
            'output' => array('.scroll-to-top'),
            'required' => array( 'backtotop_visibility', '=', '1' )
        ),
        array(
            'title' => esc_html__( 'Hover Arrow Color', 'agrikon' ),
            'id' => 'backtotop_hvricon',
            'type' => 'color',
            'default' =>  '',
            'validate' => 'color',
            'output' => array('.scroll-to-top:hover'),
            'required' => array( 'backtotop_visibility', '=', '1' )
        ),
    )));

    // THEME PAGINATION SUBSECTION
    Redux::setSection($agrikon_pre, array(
    'title' => esc_html__( 'Pagination', 'agrikon' ),
    'desc' => esc_html__( 'These are main settings for general theme!', 'agrikon' ),
    'id' => 'pagination',
    'subsection' => true,
    'icon' => 'el el-link',
    'fields' => array(
        array(
            'title' => esc_html__( 'Pagination', 'agrikon' ),
            'subtitle' => esc_html__( 'Switch On-off', 'agrikon' ),
            'desc' => esc_html__( 'If enabled, adds pagination.', 'agrikon' ),
            'id' => 'pagination_visibility',
            'type' => 'switch',
            'default' => true
        ),
        array(
            'title' => esc_html__( 'Pagination Type', 'agrikon' ),
            'subtitle' => esc_html__( 'Select type.', 'agrikon' ),
            'id' => 'pag_type',
            'type' => 'select',
            'customizer' => true,
            'options' => array(
                'default' => esc_html__( 'Default', 'agrikon' ),
                'outline' => esc_html__( 'Outline', 'agrikon' )
            ),
            'default' => 'default',
            'required' => array( 'pagination_visibility', '=', '1' )
        ),
        array(
            'title' => esc_html__( 'Pagination size', 'agrikon' ),
            'subtitle' => esc_html__( 'Select size.', 'agrikon' ),
            'id' => 'pag_size',
            'type' => 'select',
            'customizer' => true,
            'options' => array(
                'small' => esc_html__( 'small', 'agrikon' ),
                'medium' => esc_html__( 'medium', 'agrikon' ),
                'large' => esc_html__( 'large', 'agrikon' )
            ),
            'default' => 'medium',
            'required' => array( 'pagination_visibility', '=', '1' )
        ),
        array(
            'title' => esc_html__( 'Pagination group', 'agrikon' ),
            'subtitle' => esc_html__( 'Select group.', 'agrikon' ),
            'id' => 'pag_group',
            'type' => 'select',
            'customizer' => true,
            'options' => array(
                'yes' => esc_html__( 'Yes', 'agrikon' ),
                'no' => esc_html__( 'No', 'agrikon' )
            ),
            'default' => 'no',
            'required' => array( 'pagination_visibility', '=', '1' )
        ),
        array(
            'title' => esc_html__( 'Pagination corner', 'agrikon' ),
            'subtitle' => esc_html__( 'Select corner type.', 'agrikon' ),
            'id' => 'pag_corner',
            'type' => 'select',
            'customizer' => true,
            'options' => array(
                'square' => esc_html__( 'square', 'agrikon' ),
                'rounded' => esc_html__( 'rounded', 'agrikon' ),
                'circle' => esc_html__( 'circle', 'agrikon' )
            ),
            'default' => 'square',
            'required' => array( 'pagination_visibility', '=', '1' )
        ),
        array(
            'title' => esc_html__( 'Pagination align', 'agrikon' ),
            'subtitle' => esc_html__( 'Select align.', 'agrikon' ),
            'id' => 'pag_align',
            'type' => 'select',
            'customizer' => true,
            'options' => array(
                'left' => esc_html__( 'left', 'agrikon' ),
                'right' => esc_html__( 'right', 'agrikon' ),
                'center' => esc_html__( 'center', 'agrikon' )
            ),
            'default' => 'center',
            'required' => array( 'pagination_visibility', '=', '1' )
        ),
        array(
            'title' => esc_html__( 'Pagination default/outline color', 'agrikon' ),
            'id' => 'pag_clr',
            'type' => 'color',
            'mode' => 'color',
            'validate' => 'color',
            'required' => array( 'pagination_visibility', '=', '1' )
        ),
        array(
            'title' => esc_html__( 'Active and Hover pagination color', 'agrikon' ),
            'id' => 'pag_hvrclr',
            'type' => 'color',
            'mode' => 'color',
            'validate' => 'color',
            'required' => array( 'pagination_visibility', '=', '1' )
        ),
        array(
            'title' => esc_html__( 'Pagination number color', 'agrikon' ),
            'id' => 'pag_nclr',
            'type' => 'color',
            'mode' => 'color',
            'validate' => 'color',
            'required' => array( 'pagination_visibility', '=', '1' )
        ),
        array(
            'title' => esc_html__( 'Active and Hover pagination number color', 'agrikon' ),
            'id' => 'pag_hvrnclr',
            'type' => 'color',
            'mode' => 'color',
            'validate' => 'color',
            'required' => array( 'pagination_visibility', '=', '1' )
        )
    )));
    //BREADCRUMBS SETTINGS SUBSECTION
    Redux::setSection($agrikon_pre, array(
        'title' => esc_html__( 'Theme Form', 'agrikon' ),
        'id' => 'themesearchformsubsection',
        'icon' => 'el el-brush',
        'subsection' => true,
        'fields' => array(
            array(
                'title' => esc_html__( 'Header Search Form Input Placeholder', 'agrikon' ),
                'id' => 'searchform_placeholder1',
                'type' => 'text',
                'default' => 'Search...',
            ),
            array(
                'title' => esc_html__( 'Sidebar Search Form Input Placeholder', 'agrikon' ),
                'id' => 'searchform_placeholder2',
                'type' => 'text',
                'default' => 'Search for...',
            ),
            array(
                'title' => esc_html__( 'Password Form Input Placeholder', 'agrikon' ),
                'id' => 'searchform_placeholder3',
                'type' => 'text',
                'default' => 'Enter Password',
            ),
        )
    ));
    //RIPPED IMAGE SETTINGS SUBSECTION
    Redux::setSection($agrikon_pre, array(
        'title' => esc_html__( 'Theme Ripped Image', 'agrikon' ),
        'id' => 'themerippedimagesubsection',
        'icon' => 'el el-brush',
        'subsection' => true,
        'fields' => array(
            array(
                'title' => esc_html__( 'Ripped Image', 'agrikon' ),
                'subtitle' => esc_html__( 'Switch On-off', 'agrikon' ),
                'desc' => esc_html__( 'This option removes the ripped image from all templates', 'agrikon' ),
                'id' => 'theme_all_ripped_visibility',
                'type' => 'switch',
                'default' => true
            ),
        )
    ));
    /*************************************************
    ## LOGO SECTION
    *************************************************/
    Redux::setSection($agrikon_pre, array(
        'title' => esc_html__( 'Logo', 'agrikon' ),
        'desc' => esc_html__( 'These are main settings for general theme!', 'agrikon' ),
        'id' => 'logosection',
        'icon' => 'el el-star-empty',
        'fields' => array(
            array(
                'title' => esc_html__( 'Logo Switch', 'agrikon' ),
                'subtitle' => esc_html__( 'You can select logo on or off.', 'agrikon' ),
                'id' => 'logo_visibility',
                'type' => 'switch',
                'default' => true
            ),
            array(
                'title' => esc_html__( 'Logo Type', 'agrikon' ),
                'subtitle' => esc_html__( 'Select your logo type.', 'agrikon' ),
                'id' => 'logo_type',
                'type' => 'select',
                'customizer' => true,
                'options' => array(
                    'img' => esc_html__( 'Image Logo', 'agrikon' ),
                    'sitename' => esc_html__( 'Site Name', 'agrikon' ),
                    'customtext' => esc_html__( 'Custom HTML', 'agrikon' )
                ),
                'default' => 'sitename',
                'required' => array( 'logo_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Custom text for logo', 'agrikon' ),
                'desc' => esc_html__( 'Text entered here will be used as logo', 'agrikon' ),
                'id' => 'text_logo',
                'type' => 'editor',
                'args'   => array(
                    'teeny' => false,
                    'textarea_rows' => 10
                ),
                'required' => array(
                    array( 'logo_visibility', '=', '1' ),
                    array( 'logo_type', '=', 'customtext' )
                ),
            ),
            array(
                'title' => esc_html__( 'Sitename or Custom Text Logo Font', 'agrikon' ),
                'desc' => esc_html__("Choose size and style your sitename, if you don't use an image logo.", 'agrikon' ),
                'id' =>'logo_style',
                'type' => 'typography',
                'output' => array('.nt-logo .header-text-logo' ),
                'required' => array(
                    array( 'logo_visibility', '=', '1' ),
                    array( 'logo_type', '!=', 'img' )
                )
            ),
            array(
                'title' => esc_html__( 'Hover Logo Color', 'agrikon' ),
                'desc' => esc_html__( 'Set your own hover color for the text logo.', 'agrikon' ),
                'id' => 'text_logo_hvr',
                'type' => 'color',
                'validate' => 'color',
                'output' => array( '.nt-logo .header-text-logo:hover' ),
                'required' => array(
                    array( 'logo_visibility', '=', '1' ),
                    array( 'logo_type', '!=', 'img' )
                )
            ),
            array(
                'title' => esc_html__( 'Logo image', 'agrikon' ),
                'subtitle' => esc_html__( 'Upload your Logo. If left blank theme will use site default logo.', 'agrikon' ),
                'id' => 'img_logo',
                'type' => 'media',
                'url' => true,
                'customizer' => true,
                'required' => array(
                    array( 'logo_visibility', '=', '1' ),
                    array( 'logo_type', '=', 'img' ),
                    array( 'logo_type', '!=', '' )
                )
            ),
            array(
                'title' => esc_html__( 'Mobile Menu Logo image', 'agrikon' ),
                'subtitle' => esc_html__( 'Upload your Logo. If left blank theme will use site default logo.', 'agrikon' ),
                'id' => 'mob_img_logo',
                'type' => 'media',
                'url' => true,
                'customizer' => true,
                'required' => array(
                    array( 'logo_visibility', '=', '1' ),
                    array( 'logo_type', '=', 'img' ),
                    array( 'logo_type', '!=', '' )
                )
            ),
            array(
                'title' => esc_html__( 'Logo Dimensions', 'agrikon' ),
                'subtitle' => esc_html__( 'Set the logo width and height of the image.', 'agrikon' ),
                'id' => 'img_logo_dimensions',
                'type' => 'dimensions',
                'customizer' => true,
                'output' => array('.nt-logo img' ),
                'required' => array(
                    array( 'logo_visibility', '=', '1' ),
                    array( 'logo_type', '=', 'img' ),
                    array( 'logo_type', '!=', '' )
                )
            ),
            array(
                'title' => esc_html__( 'Mobile Logo Dimensions', 'agrikon' ),
                'subtitle' => esc_html__( 'Set the logo width and height of the image.', 'agrikon' ),
                'id' => 'mob_img_logo_dimensions',
                'type' => 'dimensions',
                'customizer' => true,
                'output' => array('.nt-logo img.mobile-logo' ),
                'required' => array(
                    array( 'logo_visibility', '=', '1' ),
                    array( 'logo_type', '=', 'img' ),
                    array( 'logo_type', '!=', '' )
                )
            ),
            array(
                'title' => esc_html__( 'Logo Padding', 'agrikon' ),
                'id' => 'text_logo_pad',
                'type' => 'spacing',
                'mode' => 'padding',
                'all' => false,
                'units' => array( 'em', 'px', '%' ),
                'units_extended' => 'true',
                'output' => array( '.nt-logo' ),
                'default' => array(
                    'margin-top' => '',
                    'margin-right' => '',
                    'margin-bottom' => '',
                    'margin-left' => ''
                ),
                'required' => array( 'logo_visibility', '=', '1' ),
            ),
    )));

    /*************************************************
    ## HEADER & NAV SECTION
    *************************************************/
    Redux::setSection($agrikon_pre, array(
        'title' => esc_html__( 'Header', 'agrikon' ),
        'id' => 'headersection',
        'icon' => 'fa fa-bars',
    ));
    //HEADER MENU
    Redux::setSection($agrikon_pre, array(
        'title' => esc_html__( 'General', 'agrikon' ),
        'id' => 'headernavgeneralsection',
        'subsection' => true,
        'icon' => 'fa fa-cog',
        'fields' => array(
            array(
                'title' => esc_html__( 'Header Display', 'agrikon' ),
                'subtitle' => esc_html__( 'You can enable or disable the site navigation.', 'agrikon' ),
                'id' => 'header_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off'
            ),
            array(
                'title' => esc_html__( 'Header Template', 'agrikon' ),
                'subtitle' => esc_html__( 'Select your header template.', 'agrikon' ),
                'id' => 'header_template',
                'type' => 'select',
                'customizer' => true,
                'options' => array(
                    'default' => esc_html__( 'Deafult Site Header', 'agrikon' ),
                    'elementor' => esc_html__( 'Elementor Templates', 'agrikon' ),
                ),
                'default' => 'default',
                'required' => array( 'header_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Elementor Templates', 'agrikon' ),
                'subtitle' => esc_html__( 'Select a template from elementor templates.', 'agrikon' ),
                'id' => 'header_elementor_templates',
                'type' => 'select',
                'customizer' => true,
                'options' => agrikon_get_elementorTemplates(),
                'required' => array(
                    array( 'header_visibility', '=', '1' ),
                    array( 'header_template', '=', 'elementor' )
                )
            ),
            array(
                'title' => esc_html__( 'Sticky Header Display', 'agrikon' ),
                'id' => 'header_sticky_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off',
                'required' => array(
                    array( 'header_visibility', '=', '1' ),
                    array( 'header_template', '=', 'default' )
                )
            ),
            array(
                'title' => esc_html__( 'Header Search Display', 'agrikon' ),
                'subtitle' => esc_html__( 'You can enable or disable the site navigation search form.', 'agrikon' ),
                'id' => 'header_search_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off',
                'required' => array(
                    array( 'header_visibility', '=', '1' ),
                    array( 'header_template', '=', 'default' )
                )
            ),
            array(
                'title' => esc_html__( 'Header Search Type', 'agrikon' ),
                'subtitle' => esc_html__( 'Select your header search type.', 'agrikon' ),
                'id' => 'header_search_type',
                'type' => 'select',
                'customizer' => true,
                'options' => array(
                    'default' => esc_html__( 'Post', 'agrikon' ),
                    'product' => esc_html__( 'Product', 'agrikon' ),
                ),
                'default' => 'default',
                'required' => array(
                    array( 'header_visibility', '=', '1' ),
                    array( 'header_template', '=', 'default' ),
                    array( 'header_search_visibility', '=', '1' )
                )
            ),
            array(
                'title' => esc_html__( 'Header Cart Icon Display', 'agrikon' ),
                'subtitle' => esc_html__( 'You can enable or disable the site header cart icon.', 'agrikon' ),
                'id' => 'header_cart_visibility',
                'type' => 'switch',
                'default' => 0,
                'on' => 'On',
                'off' => 'Off',
                'required' => array(
                    array( 'header_visibility', '=', '1' ),
                    array( 'header_template', '=', 'default' )
                )
            ),
            array(
                'title' => esc_html__( 'Header Cart Trigger Type', 'agrikon' ),
                'id' => 'header_cart_trigger',
                'type' => 'select',
                'customizer' => true,
                'options' => array(
                    'cart' => esc_html__( 'Cart', 'agrikon' ),
                    'popup' => esc_html__( 'Popup', 'agrikon' ),
                ),
                'default' => 'cart',
                'required' => array(
                    array( 'header_visibility', '=', '1' ),
                    array( 'header_template', '=', 'default' ),
                    array( 'header_cart_visibility', '=', '1' )
                )
            ),
            array(
                'title' => esc_html__( 'Header Lang Select Display', 'agrikon' ),
                'subtitle' => esc_html__( 'You can enable or disable the site header language area.', 'agrikon' ),
                'id' => 'header_lang_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off',
            ),
            array(
                'title' => esc_html__( 'Header Contact Button', 'agrikon' ),
                'id' => 'header_contact_button',
                'type' => 'textarea',
                'validate' => 'html',
                'default' => '<a href="tel:92-666-888-0000" class="main-header__info-phone">
<i class="agrikon-icon-phone-call"></i>
<span class="main-header__info-phone-content">
<span class="main-header__info-phone-text">Call Anytime</span>
<span class="main-header__info-phone-title">92 666 888 0000</span>
</span>
</a>',
                'required' => array(
                    array( 'header_visibility', '=', '1' ),
                    array( 'header_template', '=', 'default' ),
                )
            ),
            // DEFAULT HEADER OPTIONS
            array(
                'id' => 'defaultmenu_start',
                'type' => 'section',
                'title' => esc_html__('Header Customize Options', 'agrikon'),
                'indent' => true,
                'required' => array(
                    array( 'header_visibility', '=', '1' ),
                    array( 'header_template', '=', 'default' )
                )
            ),
            array(
                'title' => esc_html__( 'Reverse Header', 'agrikon' ),
                'subtitle' => esc_html__( 'You can align to logo from left to right.', 'agrikon' ),
                'id' => 'header_menu_reverse',
                'type' => 'switch',
                'default' => 0,
                'on' => 'On',
                'off' => 'Off',
                'required' => array(
                    array( 'header_visibility', '=', '1' ),
                    array( 'header_template', '=', 'default' )
                )
            ),
            array(
                'title' => esc_html__( 'Header Layout Type', 'agrikon' ),
                'id' => 'header_container_type',
                'type' => 'select',
                'customizer' => true,
                'options' => array(
                    'container' => esc_html__( 'Container', 'agrikon' ),
                    'container-fluid' => esc_html__( 'Container Fluid', 'agrikon' ),
                ),
                'default' => 'container',
            ),
            array(
                'title' => esc_html__( 'Header Color Type', 'agrikon' ),
                'id' => 'header_color_type',
                'type' => 'select',
                'customizer' => true,
                'options' => array(
                    '1' => esc_html__( 'Solid', 'agrikon' ),
                    '2' => esc_html__( 'Transparent', 'agrikon' ),
                ),
                'default' => '1',
            ),
            array(
                'title' => esc_html__( 'Header Background Color', 'agrikon' ),
                'id' => 'header_bg',
                'type' => 'color_rgba',
                'mode' => 'background-color',
                'output' => array( '.main-menu' ),
                'required' => array( 'header_color_type', '=', '1' ),
            ),
            array(
                'title' => esc_html__( 'Bottom Ripped Image Display', 'agrikon' ),
                'id' => 'header_image_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off',
                'required' => array( 'header_color_type', '=', '1' ),
            ),
            array(
                'title' => esc_html__( 'Menu Item Font and Color', 'agrikon' ),
                'subtitle' => esc_html__('Choose Size and Style for primary menu', 'agrikon' ),
                'id' => 'nav_a_typo',
                'type' => 'typography',
                'font-backup' => false,
                'letter-spacing' => true,
                'text-transform' => true,
                'all_styles' => true,
                'output' => array( '.main-menu .main-menu__list > li > a, .stricky-header .main-menu__list > li > a' ),
            ),
            array(
                'title' => esc_html__( 'Menu Item Color ( Hover and Active )', 'agrikon' ),
                'desc' => esc_html__( 'Set your own hover color for the navigation menu item.', 'agrikon' ),
                'id' => 'nav_hvr_a',
                'type' => 'color',
                'validate' => 'color',
                'output' => array( '.main-menu .main-menu__list > li.current > a, .main-menu .main-menu__list > li:hover > a, .stricky-header .main-menu__list > li.current > a, .stricky-header .main-menu__list > li:hover > a' ),
            ),
            array(
                'title' => esc_html__( 'Sticky Header Background Color', 'agrikon' ),
                'id' => 'nav_top_sticky_bg',
                'type' => 'color_rgba',
                'mode' => 'background-color',
                'output' => array( '.stricky-header' ),
                'required' => array( 'header_sticky_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Search Overlay Background Color', 'agrikon' ),
                'id' => 'header_search_bg',
                'type' => 'color_rgba',
                'mode' => 'background-color',
                'output' => array( '.search-popup__overlay' ),
                'required' => array(
                    array( 'header_visibility', '=', '1' ),
                    array( 'header_search_visibility', '=', '1' )
                )
            ),
            //information on-off
            array(
                'id' =>'info_nav0',
                'type' => 'info',
                'style' => 'success',
                'title' => esc_html__( 'Success!', 'agrikon' ),
                'icon' => 'el el-info-circle',
                'customizer' => false,
                'desc' => sprintf(esc_html__( '%s is disabled on the site. Please activate to view options.', 'agrikon' ), '<b>Header</b>' ),
                'required' => array( 'header_visibility', '=', '0' )
            )
    )));
    //HEADER MENU
    Redux::setSection($agrikon_pre, array(
        'title' => esc_html__( 'Header Topbar', 'agrikon' ),
        'id' => 'headertopbarsubsection',
        'subsection' => true,
        'icon' => 'fa fa-cog',
        'fields' => array(
            array(
                'title' => esc_html__( 'Topbar Display', 'agrikon' ),
                'subtitle' => esc_html__( 'You can enable or disable the site navigation.', 'agrikon' ),
                'id' => 'header_topbar_visibility',
                'type' => 'switch',
                'default' => 0,
                'on' => 'On',
                'off' => 'Off',
                'required' => array( 'header_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Topbar Template', 'agrikon' ),
                'subtitle' => esc_html__( 'Select your header template.', 'agrikon' ),
                'id' => 'header_topbar_template',
                'type' => 'select',
                'customizer' => true,
                'options' => array(
                    'default' => esc_html__( 'Deafult', 'agrikon' ),
                    'elementor' => esc_html__( 'Elementor Templates', 'agrikon' ),
                ),
                'default' => 'default',
                'required' => array( 'header_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Topbar Layout Type', 'agrikon' ),
                'id' => 'header_topbar_container_type',
                'type' => 'select',
                'customizer' => true,
                'options' => array(
                    'container' => esc_html__( 'Container', 'agrikon' ),
                    'container-fluid' => esc_html__( 'Container Fluid', 'agrikon' ),
                ),
                'default' => 'container',
                'required' => array(
                    array( 'header_visibility', '=', '1' ),
                    array( 'header_topbar_template', '=', 'default' ),
                    array( 'header_topbar_visibility', '=', '1' ),
                )
            ),
            array(
                'title' => esc_html__( 'Social Icons', 'agrikon' ),
                'id' => 'header_topbar_left',
                'type' => 'textarea',
                'validate' => 'html',
                'default' => '<a href="#" class="fab fa-facebook-square"></a>
<a href="#" class="fab fa-twitter"></a>
<a href="#" class="fab fa-pinterest-p"></a>
<a href="#" class="fab fa-instagram"></a>',
                'required' => array(
                    array( 'header_visibility', '=', '1' ),
                    array( 'header_topbar_template', '=', 'default' ),
                    array( 'header_topbar_visibility', '=', '1' ),
                )
            ),
            array(
                'title' => esc_html__( 'Left Text', 'agrikon' ),
                'subtitle' => esc_html__( 'HTML allowed (wp_kses)', 'agrikon' ),
                'id' => 'header_topbar_text',
                'type' => 'text',
                'validate' => 'html',
                'default' => 'Welcome to Agriculture WordPress Theme',
                'required' => array(
                    array( 'header_visibility', '=', '1' ),
                    array( 'header_topbar_template', '=', 'default' ),
                    array( 'header_topbar_visibility', '=', '1' ),
                )
            ),
            array(
                'title' => esc_html__( 'Right Section', 'agrikon' ),
                'id' => 'header_topbar_right',
                'type' => 'textarea',
                'validate' => 'html',
                'default' => '<a href="#"><i class="agrikon-icon-email"></i>needhelp@company.com</a>
<a href="#"><i class="agrikon-icon-clock"></i>Mon - Sat 8:00 - 6:30, Sunday - CLOSED</a>',
                'required' => array(
                    array( 'header_visibility', '=', '1' ),
                    array( 'header_topbar_template', '=', 'default' ),
                    array( 'header_topbar_visibility', '=', '1' ),
                )
            ),
            array(
                'title' => esc_html__( 'Background Color', 'agrikon' ),
                'id' => 'header_topbar_bg',
                'type' => 'color_rgba',
                'mode' => 'background-color',
                'output' => array( '.topbar, .main-header__two .topbar' ),
                'required' => array(
                    array( 'header_visibility', '=', '1' ),
                    array( 'header_topbar_visibility', '=', '1' )
                )
            ),
            array(
                'title' => esc_html__( 'Text Color', 'agrikon' ),
                'id' => 'header_topbar_txtclr',
                'type' => 'color',
                'output' => array( '.topbar__left p' ),
                'required' => array(
                    array( 'header_visibility', '=', '1' ),
                    array( 'header_topbar_visibility', '=', '1' )
                )
            ),
            array(
                'title' => esc_html__( 'Social Color', 'agrikon' ),
                'id' => 'header_topbar_socclr',
                'type' => 'color',
                'output' => array( '.topbar__social a, .main-header__two .topbar__social a' ),
                'required' => array(
                    array( 'header_visibility', '=', '1' ),
                    array( 'header_topbar_visibility', '=', '1' )
                )
            ),
            array(
                'title' => esc_html__( 'Hover Social Color', 'agrikon' ),
                'id' => 'header_topbar_hvrsocclr',
                'type' => 'color',
                'output' => array( '.topbar__social a:hover, .main-header__two .topbar__social a:hover' ),
                'required' => array(
                    array( 'header_visibility', '=', '1' ),
                    array( 'header_topbar_visibility', '=', '1' )
                )
            ),
            array(
                'title' => esc_html__( 'Link Color', 'agrikon' ),
                'id' => 'header_topbar_linkclr',
                'type' => 'color',
                'output' => array( '.topbar__right > a, .main-header__two .topbar__right > a' ),
                'required' => array(
                    array( 'header_visibility', '=', '1' ),
                    array( 'header_topbar_visibility', '=', '1' )
                )
            ),
            array(
                'title' => esc_html__( 'Hover Link Color', 'agrikon' ),
                'id' => 'header_topbar_hvrlinkclr',
                'type' => 'color',
                'output' => array( '.topbar__right > a:hover, .topbar__right > a:hover i, .main-header__two .topbar__right > a:hover, .main-header__two .topbar__right > a:hover i' ),
                'required' => array(
                    array( 'header_visibility', '=', '1' ),
                    array( 'header_topbar_visibility', '=', '1' )
                )
            ),
    )));
    /*************************************************
    ## SIDEBARS SECTION
    *************************************************/
    Redux::setSection($agrikon_pre, array(
        'title' => esc_html__( 'Sidebars', 'agrikon' ),
        'id' => 'sidebarssection',
        'icon' => 'fa fa-th-list',
    ));
    // SIDEBAR LAYOUT SUBSECTION
    Redux::setSection($agrikon_pre, array(
        'title' => esc_html__( 'Sidebars Layout', 'agrikon' ),
        'desc' => esc_html__( 'You can change the below default layout type.', 'agrikon' ),
        'id' => 'sidebarslayoutsection',
        'subsection' => true,
        'icon' => 'el el-cogs',
        'fields' => array(
            array(
                'title' => esc_html__( 'Sidebar type', 'agrikon' ),
                'subtitle' => esc_html__( 'Select sidebar type.', 'agrikon' ),
                'id' => 'sidebar_type',
                'type' => 'select',
                'customizer' => true,
                'options' => array(
                    '' => esc_html__( 'Select type', 'agrikon' ),
                    'default' => esc_html__( 'default', 'agrikon' ),
                    'bordered' => esc_html__( 'bordered', 'agrikon' )
                ),
                'default' => 'default',
            ),
            array(
                'title' => esc_html__( 'Default Page Layout', 'agrikon' ),
                'subtitle' => esc_html__( 'Choose the blog index page layout.', 'agrikon' ),
                'id' => 'page_layout',
                'type' => 'image_select',
                'options' => array(
                    'left-sidebar' => array(
                        'alt' => 'Left Sidebar',
                        'img' => get_template_directory_uri() . '/inc/core/theme-options/img/2cl.png'
                    ),
                    'full-width' => array(
                        'alt' => 'Full Width',
                        'img' => get_template_directory_uri() . '/inc/core/theme-options/img/1col.png'
                    ),
                    'right-sidebar' => array(
                        'alt' => 'Right Sidebar',
                        'img' => get_template_directory_uri() . '/inc/core/theme-options/img/2cr.png'
                    )
                ),
                'default' => 'right-sidebar'
            ),
            array(
                'title' => esc_html__( 'Blog Page Layout', 'agrikon' ),
                'subtitle' => esc_html__( 'Choose the blog index page layout.', 'agrikon' ),
                'id' => 'index_layout',
                'type' => 'image_select',
                'options' => array(
                    'left-sidebar' => array(
                        'alt' => 'Left Sidebar',
                        'img' => get_template_directory_uri() . '/inc/core/theme-options/img/2cl.png'
                    ),
                    'full-width' => array(
                        'alt' => 'Full Width',
                        'img' => get_template_directory_uri() . '/inc/core/theme-options/img/1col.png'
                    ),
                    'right-sidebar' => array(
                        'alt' => 'Right Sidebar',
                        'img' => get_template_directory_uri() . '/inc/core/theme-options/img/2cr.png'
                    )
                ),
                'default' => 'right-sidebar'
            ),
            array(
                'title' => esc_html__( 'Single Page Layout', 'agrikon' ),
                'subtitle' => esc_html__( 'Choose the single post page layout.', 'agrikon' ),
                'id' => 'single_layout',
                'type' => 'image_select',
                'options' => array(
                    'left-sidebar' => array(
                        'alt' => 'Left Sidebar',
                        'img' => get_template_directory_uri() . '/inc/core/theme-options/img/2cl.png'
                    ),
                    'full-width' => array(
                        'alt' => 'Full Width',
                        'img' => get_template_directory_uri() . '/inc/core/theme-options/img/1col.png'
                    ),
                    'right-sidebar' => array(
                        'alt' => 'Right Sidebar',
                        'img' => get_template_directory_uri() . '/inc/core/theme-options/img/2cr.png'
                    )
                ),
                'default' => 'full-width'
            ),
            array(
                'title' => esc_html__( 'Search Page Layout', 'agrikon' ),
                'subtitle' => esc_html__( 'Choose the search page layout.', 'agrikon' ),
                'id' => 'search_layout',
                'type' => 'image_select',
                'options' => array(
                    'left-sidebar' => array(
                        'alt' => 'Left Sidebar',
                        'img' => get_template_directory_uri() . '/inc/core/theme-options/img/2cl.png'
                    ),
                    'full-width' => array(
                        'alt' => 'Full Width',
                        'img' => get_template_directory_uri() . '/inc/core/theme-options/img/1col.png'
                    ),
                    'right-sidebar' => array(
                        'alt' => 'Right Sidebar',
                        'img' => get_template_directory_uri() . '/inc/core/theme-options/img/2cr.png'
                    )
                ),
                'default' => 'full-width'
            ),
            array(
                'title' => esc_html__( 'Archive Page Layout', 'agrikon' ),
                'subtitle' => esc_html__( 'Choose the archive page layout.', 'agrikon' ),
                'id' => 'archive_layout',
                'type' => 'image_select',
                'options' => array(
                    'left-sidebar' => array(
                        'alt' => 'Left Sidebar',
                        'img' => get_template_directory_uri() . '/inc/core/theme-options/img/2cl.png'
                    ),
                    'full-width' => array(
                        'alt' => 'Full Width',
                        'img' => get_template_directory_uri() . '/inc/core/theme-options/img/1col.png'
                    ),
                    'right-sidebar' => array(
                        'alt' => 'Right Sidebar',
                        'img' => get_template_directory_uri() . '/inc/core/theme-options/img/2cr.png'
                    )
                ),
                'default' => 'full-width'
            )
    )));
    // SIDEBAR COLORS SUBSECTION
    Redux::setSection($agrikon_pre, array(
        'title' => esc_html__( 'Sidebar Customize', 'agrikon' ),
        'desc' => esc_html__( 'These are main settings for general theme!', 'agrikon' ),
        'id' => 'sidebarsgenaralsection',
        'subsection' => true,
        'icon' => 'el el-brush',
        'fields' => array(
            array(
                'title' => esc_html__( 'Sidebar Background', 'agrikon' ),
                'id' => 'sdbr_bg',
                'type' => 'color',
                'validate' => 'color',
                'mode' => 'background',
                'output' => array( '.nt-sidebar' )
            ),
            array(
                'id' => 'sdbr_brd',
                'type' => 'border',
                'title' => esc_html__( 'Sidebar Border', 'agrikon' ),
                'output' => array( '.nt-sidebar' ),
                'all' => false
            ),
            array(
                'title' => esc_html__( 'Sidebar Padding', 'agrikon' ),
                'id' => 'sdbr_pad',
                'type' => 'spacing',
                'mode' => 'padding',
                'all' => false,
                'units' => array( 'em', 'px', '%' ),
                'units_extended' => 'true',
                'output' => array( '.nt-sidebar' ),
                'default' => array(
                    'margin-top' => '',
                    'margin-right' => '',
                    'margin-bottom' => '',
                    'margin-left' => ''
                )
            ),
            array(
                'title' => esc_html__( 'Sidebar Margin', 'agrikon' ),
                'id' => 'sdbr_mar',
                'type' => 'spacing',
                'mode' => 'margin',
                'all' => false,
                'units' => array( 'em', 'px', '%' ),
                'units_extended' => 'true',
                'output' => array( '.nt-sidebar' ),
                'default' => array(
                    'margin-top' => '',
                    'margin-right' => '',
                    'margin-bottom' => '',
                    'margin-left' => ''
                )
            ),
    )));
    // SIDEBAR WIDGET COLORS SUBSECTION
    Redux::setSection($agrikon_pre, array(
        'title' => esc_html__( 'Widget Customize', 'agrikon' ),
        'desc' => esc_html__( 'These are main settings for general theme!', 'agrikon' ),
        'id' => 'sidebarwidgetsection',
        'subsection' => true,
        'icon' => 'el el-brush',
        'fields' => array(
            array(
                'title' => esc_html__( 'Sidebar Widgets Background Color', 'agrikon' ),
                'id' => 'sdbr_w_bg',
                'type' => 'color',
                'validate' => 'color',
                'mode' => 'background',
                'output' => array( '.nt-sidebar .nt-sidebar-inner-widget' )
            ),
            array(
                'title' => esc_html__( 'Widgets Border', 'agrikon' ),
                'id' => 'sdbr_w_brd',
                'type' => 'border',
                'output' => array( '.nt-sidebar .nt-sidebar-inner-widget' ),
                'all' => false
            ),
            array(
                'title' => esc_html__( 'Widget Title Color', 'agrikon' ),
                'desc' => esc_html__( 'Set your own colors for the widgets.', 'agrikon' ),
                'id' => 'sdbr_wt',
                'type' => 'color',
                'validate' => 'color',
                'output' => array( '#nt-sidebar .widget-title' )
            ),
            array(
                'title' => esc_html__( 'Widget Text Color', 'agrikon' ),
                'desc' => esc_html__( 'Set your own colors for the widgets.', 'agrikon' ),
                'id' => 'sdbr_wp',
                'type' => 'color',
                'validate' => 'color',
                'output' => array( '.nt-sidebar .nt-sidebar-inner-widget, .nt-sidebar .nt-sidebar-inner-widget p' )
            ),
            array(
                'title' => esc_html__( 'Widget Link Color', 'agrikon' ),
                'desc' => esc_html__( 'Set your own colors for the widgets.', 'agrikon' ),
                'id' => 'sdbr_a',
                'type' => 'color',
                'validate' => 'color',
                'output' => array( '.nt-sidebar .nt-sidebar-inner-widget a' )
            ),
            array(
                'title' => esc_html__( 'Widget Hover Link Color', 'agrikon' ),
                'desc' => esc_html__( 'Set your own hover colors for the widgets.', 'agrikon' ),
                'id' => 'sdbr_hvr_a',
                'type' => 'color',
                'validate' => 'color',
                'output' => array( '.nt-sidebar .nt-sidebar-inner-widget a:hover' )
            ),
            array(
                'title' => esc_html__( 'Widget Padding', 'agrikon' ),
                'id' => 'sdbr_w_pad',
                'type' => 'spacing',
                'mode' => 'padding',
                'all' => false,
                'units' => array( 'em', 'px', '%' ),
                'units_extended' => 'true',
                'output' => array( '.nt-sidebar .nt-sidebar-inner-widget' ),
                'default' => array(
                    'margin-top' => '',
                    'margin-right' => '',
                    'margin-bottom' => '',
                    'margin-left' => ''
                )
            ),
            array(
                'title' => esc_html__( 'Widget Margin', 'agrikon' ),
                'id' => 'sdbr_w_mar',
                'type' => 'spacing',
                'mode' => 'margin',
                'all' => false,
                'units' => array( 'em', 'px', '%' ),
                'units_extended' => 'true',
                'output' => array( '.nt-sidebar .nt-sidebar-inner-widget' ),
                'default' => array(
                    'margin-top' => '',
                    'margin-right' => '',
                    'margin-bottom' => '',
                    'margin-left' => ''
                )
            )
    )));
    /*************************************************
    ## DEFAULT PAGE SECTION
    *************************************************/
    Redux::setSection($agrikon_pre, array(
        'title' => esc_html__( 'Default Page', 'agrikon' ),
        'id' => 'defaultpagesection',
        'icon' => 'el el-home',
    ));
    // BLOG HERO SUBSECTION
    Redux::setSection($agrikon_pre, array(
        'title' => esc_html__( 'Page Hero', 'agrikon' ),
        'desc' => esc_html__( 'These are default page hero text settings!', 'agrikon' ),
        'id' => 'pageherosubsection',
        'subsection' => true,
        'icon' => 'el el-brush',
        'fields' => array(
            array(
                'title' => esc_html__( 'Page Hero Display', 'agrikon' ),
                'subtitle' => esc_html__( 'You can enable or disable the site default page hero section with switch option.', 'agrikon' ),
                'id' => 'page_hero_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off'
            ),
            array(
                'title' => esc_html__( 'Page Hero Background', 'agrikon' ),
                'id' => 'page_hero_bg',
                'type' => 'background',
                'preview' => true,
                'preview_media' => true,
                'output' => array( '#nt-page-container .page-header__bg' ),
                'required' => array( 'blog_hero_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Page Title Typography', 'agrikon' ),
                'id' => 'page_title_typo',
                'type' => 'typography',
                'font-backup' => false,
                'letter-spacing' => true,
                'text-transform' => true,
                'all_styles' => true,
                'output' => array( '#nt-page-container .nt-hero-title' ),
                'required' => array( 'blog_hero_visibility', '=', '1' ),
            ),
    )));
    /*************************************************
    ## BLOG PAGE SECTION
    *************************************************/
    Redux::setSection($agrikon_pre, array(
        'title' => esc_html__( 'Blog Page', 'agrikon' ),
        'id' => 'blogsection',
        'icon' => 'el el-home',
    ));
    // BLOG HERO SUBSECTION
    Redux::setSection($agrikon_pre, array(
        'title' => esc_html__( 'Blog Hero', 'agrikon' ),
        'desc' => esc_html__( 'These are blog index page hero text settings!', 'agrikon' ),
        'id' => 'blogherosubsection',
        'subsection' => true,
        'icon' => 'el el-brush',
        'fields' => array(
            array(
                'title' => esc_html__( 'Blog Hero Display', 'agrikon' ),
                'subtitle' => esc_html__( 'You can enable or disable the site blog index page hero section with switch option.', 'agrikon' ),
                'id' => 'blog_hero_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off'
            ),
            array(
                'title' => esc_html__( 'Blog Hero Background', 'agrikon' ),
                'id' => 'blog_hero_bg',
                'type' => 'background',
                'preview' => true,
                'preview_media' => true,
                'output' => array( '#nt-index .page-header__bg' ),
                'required' => array( 'blog_hero_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Blog Title', 'agrikon' ),
                'subtitle' => esc_html__( 'Add your blog index page title here.', 'agrikon' ),
                'id' => 'blog_title',
                'type' => 'text',
                'default' => 'BLOG',
                'required' => array( 'blog_hero_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Blog Title Typography', 'agrikon' ),
                'id' => 'blog_title_typo',
                'type' => 'typography',
                'font-backup' => false,
                'letter-spacing' => true,
                'text-transform' => true,
                'all_styles' => true,
                'output' => array( '#nt-index .nt-hero-title' ),
                'required' => array( 'blog_hero_visibility', '=', '1' ),
            ),
    )));
    // BLOG LAYOUT AND POST COLUMN STYLE
    Redux::setSection($agrikon_pre, array(
        'title' => esc_html__( 'Blog Content', 'agrikon' ),
        'id' => 'blogcontentsubsection',
        'subsection' => true,
        'icon' => 'el el-brush',
        'fields' => array(
            array(
                'title' => esc_html__( 'Blog Page Type', 'agrikon' ),
                'subtitle' => esc_html__( 'Select blog page layout type.', 'agrikon' ),
                'id' => 'index_type',
                'type' => 'select',
                'customizer' => true,
                'options' => array(
                    '' => esc_html__( 'Select type', 'agrikon' ),
                    'default' => esc_html__( 'default', 'agrikon' ),
                    'grid' => esc_html__( 'grid', 'agrikon' ),
                ),
                'default' => 'default'
            ),
            array(
                'title' => esc_html__( 'Blog page container width type', 'agrikon' ),
                'subtitle' => esc_html__( 'Select blog page container width type.', 'agrikon' ),
                'id' => 'index_container_type',
                'type' => 'select',
                'customizer' => true,
                'options' => array(
                    '' => esc_html__( 'Select type', 'agrikon' ),
                    'boxed' => esc_html__( 'Default Boxed', 'agrikon' ),
                    'fluid' => esc_html__( 'Fluid', 'agrikon' ),
                ),
                'default' => 'boxed'
            ),
            array(
                'title' => esc_html__( 'Blog page post column width', 'agrikon' ),
                'subtitle' => esc_html__( 'Select a column number.', 'agrikon' ),
                'id' => 'index_post_column',
                'type' => 'select',
                'customizer' => true,
                'options' => array(
                    '' => esc_html__( 'Select type', 'agrikon' ),
                    'col-lg-6' => esc_html__( '2 column', 'agrikon' ),
                    'col-lg-4' => esc_html__( '3 column', 'agrikon' )
                ),
                'default' => 'col-lg-6',
                'required' => array( 'index_type', '=', 'grid' )
            ),
            array(
                'title' => esc_html__( 'Post Title Display', 'agrikon' ),
                'subtitle' => esc_html__( 'You can enable or disable the site blog index page post title with switch option.', 'agrikon' ),
                'id' => 'post_title_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off'
            ),
            array(
                'title' => esc_html__( 'Post Author Display', 'agrikon' ),
                'subtitle' => esc_html__( 'You can enable or disable the site blog index page post author with switch option.', 'agrikon' ),
                'id' => 'post_author_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off'
            ),
            array(
                'title' => esc_html__( 'Post Author Display', 'agrikon' ),
                'subtitle' => esc_html__( 'You can enable or disable the site blog index page post author with switch option.', 'agrikon' ),
                'id' => 'post_comments_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off'
            ),
            array(
                'title' => esc_html__( 'Post Date Display', 'agrikon' ),
                'subtitle' => esc_html__( 'You can enable or disable the site blog index page post date with switch option.', 'agrikon' ),
                'id' => 'post_date_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off',
            ),
            array(
                'title' => esc_html__( 'Blog Post Date Display', 'agrikon' ),
                'subtitle' => esc_html__( 'You can enable or disable the site blog index page post date with switch option.', 'agrikon' ),
                'id' => 'post_author_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off',
            ),
            array(
                'title' => esc_html__( 'Blog Post Excerpt Display', 'agrikon' ),
                'subtitle' => esc_html__( 'You can enable or disable the site blog index page post meta with switch option.', 'agrikon' ),
                'id' => 'post_excerpt_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off'
            ),
            array(
                'title' => esc_html__( 'Post Excerpt Size (max word count)', 'agrikon' ),
                'subtitle' => esc_html__( 'You can control blog post excerpt size with this option.', 'agrikon' ),
                'id' => 'excerptsz',
                'type' => 'slider',
                'default' => 30,
                'min' => 0,
                'step' => 1,
                'max' => 100,
                'display_value' => 'text',
                'required' => array( 'post_excerpt_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Blog Post Button Display', 'agrikon' ),
                'subtitle' => esc_html__( 'You can enable or disable the site blog index page post read more button wityh switch option.', 'agrikon' ),
                'id' => 'post_button_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off'
            ),
            array(
                'title' => esc_html__( 'Blog Post Button Title', 'agrikon' ),
                'subtitle' => esc_html__( 'Add your blog post read more button title here.', 'agrikon' ),
                'id' => 'post_button_title',
                'type' => 'text',
                'default' => esc_html__( 'Read More', 'agrikon' ),
                'required' => array( 'post_button_visibility', '=', '1' )
            )
    )));

    /*************************************************
    ## SINGLE PAGE SECTION
    *************************************************/
    Redux::setSection($agrikon_pre, array(
        'title' => esc_html__( 'Single Page', 'agrikon' ),
        'id' => 'singlesection',
        'icon' => 'el el-home-alt',
    ));
    // SINGLE HERO SUBSECTION
    Redux::setSection($agrikon_pre, array(
        'title' => esc_html__( 'Single Hero', 'agrikon' ),
        'desc' => esc_html__( 'These are single page hero section settings!', 'agrikon' ),
        'id' => 'singleherosubsection',
        'subsection' => true,
        'icon' => 'el el-brush',
        'fields' => array(
            array(
                'title' => esc_html__( 'Single Hero Display', 'agrikon' ),
                'subtitle' => esc_html__( 'You can enable or disable the site single page hero section with switch option.', 'agrikon' ),
                'id' => 'single_hero_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off',
            ),
            array(
                'title' => esc_html__( 'Use Elementor Template For Single Hero?', 'agrikon' ),
                'subtitle' => esc_html__( 'Please open this option, If you want to use elementor template instead of the default single hero section.', 'agrikon' ),
                'id' => 'use_elementor_for_single_hero',
                'type' => 'switch',
                'default' => 0,
                'on' => 'On',
                'off' => 'Off',
            ),
            array(
                'title' => esc_html__( 'Elementor Templates', 'agrikon' ),
                'subtitle' => esc_html__( 'Select a template from elementor templates.', 'agrikon' ),
                'id' => 'single_hero_elementor_templates',
                'type' => 'select',
                'customizer' => true,
                'options' => agrikon_get_elementorTemplates(),
                'required' => array(
                    array( 'single_hero_visibility', '=', '1' ),
                    array( 'use_elementor_for_single_hero', '=', '1' )
                )
            ),
            array(
                'title' => esc_html__( 'Single Hero Background', 'agrikon' ),
                'id' => 'single_hero_bg',
                'type' => 'background',
                'output' => array( '#nt-single .page-header__bg' ),
                'required' => array(
                    array( 'single_hero_visibility', '=', '1' ),
                    array( 'use_elementor_for_single_hero', '=', '0' )
                )
            ),
            array(
                'title' => esc_html__( 'Single Title Typography', 'agrikon' ),
                'id' => 'single_title_typo',
                'type' => 'typography',
                'font-backup' => false,
                'letter-spacing' => true,
                'text-transform' => true,
                'all_styles' => true,
                'output' => array( '#nt-single .page-header .page-title' ),
                'units' => 'px',
                'required' => array(
                    array( 'single_hero_visibility', '=', '1' ),
                    array( 'use_elementor_for_single_hero', '=', '0' )
                )
            ),
    )));
    // SINGLE CONTENT SUBSECTION
    Redux::setSection($agrikon_pre, array(
        'title' => esc_html__( 'Single Content', 'agrikon' ),
        'id' => 'singlecontentsubsection',
        'subsection' => true,
        'icon' => 'el el-brush',
        'fields' => array(
            array(
                'title' => esc_html__( 'Author Name Display', 'agrikon' ),
                'subtitle' => esc_html__( 'You can enable or disable the site single page post date with switch option.', 'agrikon' ),
                'id' => 'single_postmeta_author_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off'
            ),
            array(
                'title' => esc_html__( 'Comments Number Display', 'agrikon' ),
                'subtitle' => esc_html__( 'You can enable or disable the site single page post comments number with switch option.', 'agrikon' ),
                'id' => 'single_postmeta_comments_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off'
            ),
            array(
                'title' => esc_html__( 'Date Display', 'agrikon' ),
                'subtitle' => esc_html__( 'You can enable or disable the site single page post date number with switch option.', 'agrikon' ),
                'id' => 'single_postmeta_date_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off'
            ),
            array(
                'title' => esc_html__( 'Post Tags Display', 'agrikon' ),
                'subtitle' => esc_html__( 'You can enable or disable the site single page post meta tags with switch option.', 'agrikon' ),
                'id' => 'single_postmeta_tags_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off'
            ),
            array(
                'title' => esc_html__( 'Authorbox Display', 'agrikon' ),
                'subtitle' => esc_html__( 'You can enable or disable the site single page post authorbox with switch option.', 'agrikon' ),
                'id' => 'single_post_author_box_visibility',
                'type' => 'switch',
                'default' => 0,
                'on' => 'On',
                'off' => 'Off'
            ),
            array(
                'title' => esc_html__( 'Post Pagination Display', 'agrikon' ),
                'subtitle' => esc_html__( 'You can enable or disable the site single page post next and prev pagination with switch option.', 'agrikon' ),
                'id' => 'single_navigation_visibility',
                'type' => 'switch',
                'default' => 0,
                'on' => 'On',
                'off' => 'Off'
            ),
            array(
                'title' => esc_html__( 'Related Post Display', 'agrikon' ),
                'subtitle' => esc_html__( 'You can enable or disable the site single page related post with switch option.', 'agrikon' ),
                'id' => 'single_related_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off'
            ),
            array(
                'id' => 'related_section_heading_start',
                'type' => 'section',
                'title' => esc_html__('Related Section Heading', 'agrikon'),
                'indent' => true
            ),
            array(
                'title' => esc_html__( 'Related Section Subtitle', 'agrikon' ),
                'subtitle' => esc_html__( 'Add your single page related post section subtitle here.', 'agrikon' ),
                'id' => 'related_subtitle',
                'type' => 'text',
                'default' => esc_html__( 'Awesome Work', 'agrikon' ),
                'required' => array( 'single_related_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Subtitle Tag', 'agrikon' ),
                'id' => 'related_subtitle_tag',
                'type' => 'select',
                'customizer' => true,
                'options' => array(
                    '' => esc_html__( 'Select type', 'agrikon' ),
                    'h1' => esc_html__( 'H1', 'agrikon' ),
                    'h2' => esc_html__( 'H2', 'agrikon' ),
                    'h3' => esc_html__( 'H3', 'agrikon' ),
                    'h4' => esc_html__( 'H4', 'agrikon' ),
                    'h5' => esc_html__( 'H5', 'agrikon' ),
                    'h6' => esc_html__( 'H6', 'agrikon' ),
                    'p' => esc_html__( 'p', 'agrikon' ),
                    'div' => esc_html__( 'div', 'agrikon' ),
                    'span' => esc_html__( 'span', 'agrikon' ),
                ),
                'default' => 'p',
                'required' => array(
                    array( 'single_related_visibility', '=', '1' ),
                    array( 'related_subtitle', '!=', '' )
                ),
            ),
            array(
                'title' => esc_html__( 'Subtitle Typography', 'agrikon' ),
                'id' => 'related_subtitle_typo',
                'type' => 'typography',
                'font-backup' => false,
                'letter-spacing' => true,
                'text-transform' => true,
                'all_styles' => true,
                'output' => array( '.nt-related-post .section-head .subtitle' ),
                'required' => array(
                    array( 'single_related_visibility', '=', '1' ),
                    array( 'related_subtitle', '!=', '' )
                ),
            ),
            array(
                'title' => esc_html__( 'Related Section Title', 'agrikon' ),
                'subtitle' => esc_html__( 'Add your single page related post section title here.', 'agrikon' ),
                'id' => 'related_title',
                'type' => 'text',
                'default' => esc_html__( 'Related Post', 'agrikon' ),
                'required' => array( 'single_related_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Title Tag', 'agrikon' ),
                'id' => 'related_title_tag',
                'type' => 'select',
                'customizer' => true,
                'options' => array(
                    '' => esc_html__( 'Select type', 'agrikon' ),
                    'h1' => esc_html__( 'H1', 'agrikon' ),
                    'h2' => esc_html__( 'H2', 'agrikon' ),
                    'h3' => esc_html__( 'H3', 'agrikon' ),
                    'h4' => esc_html__( 'H4', 'agrikon' ),
                    'h5' => esc_html__( 'H5', 'agrikon' ),
                    'h6' => esc_html__( 'H6', 'agrikon' ),
                    'p' => esc_html__( 'p', 'agrikon' ),
                    'div' => esc_html__( 'div', 'agrikon' ),
                    'span' => esc_html__( 'span', 'agrikon' ),
                ),
                'default' => 'h3',
                'required' => array(
                    array( 'single_related_visibility', '=', '1' ),
                    array( 'related_title', '!=', '' )
                ),
            ),
            array(
                'title' => esc_html__( 'Title Typography', 'agrikon' ),
                'id' => 'related_title_typo',
                'type' => 'typography',
                'font-backup' => false,
                'letter-spacing' => true,
                'text-transform' => true,
                'all_styles' => true,
                'output' => array( '.nt-related-post .section-head .title' ),
                'required' => array(
                    array( 'single_related_visibility', '=', '1' ),
                    array( 'related_title', '!=', '' )
                ),
            ),
            array(
                'id' => 'related_section_heading_end',
                'type' => 'section',
                'indent' => false
            ),
            array(
                'id' => 'related_section_posts_start',
                'type' => 'section',
                'title' => esc_html__('Related Post Options', 'agrikon'),
                'indent' => true
            ),
            array(
                'title' => esc_html__( 'Posts Perpage', 'agrikon' ),
                'subtitle' => esc_html__( 'You can control related post count with this option.', 'agrikon' ),
                'id' => 'related_perpage',
                'type' => 'slider',
                'default' => 3,
                'min' => 1,
                'step' => 1,
                'max' => 24,
                'display_value' => 'text',
                'required' => array( 'single_related_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Post Image Size', 'agrikon' ),
                'id' => 'related_imgsize',
                'type' => 'select',
                'data' => 'image_sizes',
                'required' => array( 'single_related_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Custom Post Image Size', 'agrikon' ),
                'id' => 'related_custom_imgsize',
                'type' => 'dimensions',
                'units' => false,
                'required' => array(
                    array( 'single_related_visibility', '=', '1' ),
                    array( 'related_imgsize', '=', '' )
                ),
            ),
            array(
                'title' => esc_html__( 'Post Excerpt Display', 'agrikon' ),
                'id' => 'related_excerpt_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off',
                'required' => array( 'single_related_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Post Excerpt Limit', 'agrikon' ),
                'subtitle' => esc_html__( 'You can control related post excerpt word limit.', 'agrikon' ),
                'id' => 'related_excerpt_limit',
                'type' => 'slider',
                'default' => 30,
                'min' => 0,
                'step' => 1,
                'max' => 100,
                'display_value' => 'text',
                'required' => array(
                    array( 'single_related_visibility', '=', '1' ),
                    array( 'related_excerpt_visibility', '=', '1' ),
                )
            ),
            array(
                'title' => esc_html__( 'Post Button Title', 'agrikon' ),
                'id' => 'related_btntitle',
                'type' => 'text',
                'default' => esc_html__( 'Read More', 'agrikon' ),
                'required' => array( 'single_related_visibility', '=', '1' )
            ),
            array(
                'id' => 'related_section_posts_end',
                'type' => 'section',
                'indent' => false
            ),
            array(
                'id' => 'related_section_slider_start',
                'type' => 'section',
                'title' => esc_html__('Related Slider Options', 'agrikon'),
                'indent' => true
            ),
            array(
                'title' => esc_html__( 'Perview ( Min 1200px )', 'agrikon' ),
                'subtitle' => esc_html__( 'You can control related post slider item count for big device with this option.', 'agrikon' ),
                'id' => 'related_perview',
                'type' => 'slider',
                'default' => 5,
                'min' => 1,
                'step' => 1,
                'max' => 10,
                'display_value' => 'text',
                'required' => array( 'single_related_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Slider Perview ( Min 992px )', 'agrikon' ),
                'subtitle' => esc_html__( 'You can control related post slider item count for big device with this option.', 'agrikon' ),
                'id' => 'related_mdperview',
                'type' => 'slider',
                'default' => 3,
                'min' => 1,
                'step' => 1,
                'max' => 10,
                'display_value' => 'text',
                'required' => array( 'single_related_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Perview ( Min 768px )', 'agrikon' ),
                'subtitle' => esc_html__( 'You can control related post slider item count for big device with this option.', 'agrikon' ),
                'id' => 'related_smperview',
                'type' => 'slider',
                'default' => 3,
                'min' => 1,
                'step' => 1,
                'max' => 10,
                'display_value' => 'text',
                'required' => array( 'single_related_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Perview ( Min 480px )', 'agrikon' ),
                'subtitle' => esc_html__( 'You can control related post slider item count for big device with this option.', 'agrikon' ),
                'id' => 'related_xsperview',
                'type' => 'slider',
                'default' => 2,
                'min' => 1,
                'step' => 1,
                'max' => 10,
                'display_value' => 'text',
                'required' => array( 'single_related_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Speed', 'agrikon' ),
                'subtitle' => esc_html__( 'You can control related post slider item gap.', 'agrikon' ),
                'id' => 'related_speed',
                'type' => 'slider',
                'default' => 1000,
                'min' => 100,
                'step' => 1,
                'max' => 10000,
                'display_value' => 'text',
                'required' => array( 'single_related_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Gap', 'agrikon' ),
                'subtitle' => esc_html__( 'You can control related post slider item gap.', 'agrikon' ),
                'id' => 'related_gap',
                'type' => 'slider',
                'default' => 30,
                'min' => 0,
                'step' => 1,
                'max' => 100,
                'display_value' => 'text',
                'required' => array( 'single_related_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Centered', 'agrikon' ),
                'id' => 'related_centered',
                'type' => 'switch',
                'default' => 0,
                'on' => 'On',
                'off' => 'Off',
                'required' => array( 'single_related_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Autoplay', 'agrikon' ),
                'id' => 'related_autoplay',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off',
                'required' => array( 'single_related_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Loop', 'agrikon' ),
                'id' => 'related_loop',
                'type' => 'switch',
                'default' => 0,
                'on' => 'On',
                'off' => 'Off',
                'required' => array( 'single_related_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Mousewheel', 'agrikon' ),
                'id' => 'related_mousewheel',
                'type' => 'switch',
                'default' => 0,
                'on' => 'On',
                'off' => 'Off',
                'required' => array( 'single_related_visibility', '=', '1' )
            ),
            array(
                'id' => 'related_section_slider_end',
                'type' => 'section',
                'indent' => false
            ),
    )));
    /*************************************************
    ## ARCHIVE PAGE SECTION
    *************************************************/
    Redux::setSection($agrikon_pre, array(
        'title' => esc_html__( 'Archive Page', 'agrikon' ),
        'id' => 'archivesection',
        'icon' => 'el el-folder-open',
    ));
    // ARCHIVE PAGE SECTION
    Redux::setSection($agrikon_pre, array(
        'title' => esc_html__( 'Archive Hero', 'agrikon' ),
        'desc' => esc_html__( 'These are archive page hero settings!', 'agrikon' ),
        'id' => 'archiveherosubsection',
        'subsection' => true,
        'icon' => 'el el-brush',
        'fields' => array(
            array(
                'title' => esc_html__( 'Archive Hero Display', 'agrikon' ),
                'subtitle' => esc_html__( 'You can enable or disable the site archive page hero section with switch option.', 'agrikon' ),
                'id' => 'archive_hero_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off',
            ),
            array(
                'title' => esc_html__( 'Archive Hero Background', 'agrikon' ),
                'id' => 'archive_hero_bg',
                'type' => 'background',
                'output' => array( '#nt-archive .page-header__bg' ),
                'required' => array( 'archive_hero_visibility', '=', '1' ),
            ),
            array(
                'title' => esc_html__( 'Custom Archive Title', 'agrikon' ),
                'subtitle' => esc_html__( 'Add your custom archive page title here.', 'agrikon' ),
                'id' => 'archive_title',
                'type' => 'text',
                'default' =>'',
                'required' => array( 'archive_hero_visibility', '=', '1' ),
            ),
            array(
                'title' => esc_html__( 'Archive Title Typography', 'agrikon' ),
                'id' => 'archive_title_typo',
                'type' => 'typography',
                'font-backup' => false,
                'letter-spacing' => true,
                'text-transform' => true,
                'all_styles' => true,
                'output' => array( '#nt-archive .nt-hero-title' ),
                'required' => array( 'archive_hero_visibility', '=', '1' ),
            ),
    )));
    /*************************************************
    ## 404 PAGE SECTION
    *************************************************/
    Redux::setSection($agrikon_pre, array(
        'title' => esc_html__( '404 Page', 'agrikon' ),
        'id' => 'errorsection',
        'icon' => 'el el-error',
        'fields' => array(
            array(
                'title' => esc_html__( '404 Type', 'agrikon' ),
                'subtitle' => esc_html__( 'Select your 404 page type.', 'agrikon' ),
                'id' => 'error_page_type',
                'type' => 'select',
                'customizer' => true,
                'options' => array(
                    'default' => esc_html__( 'Deafult', 'agrikon' ),
                    'elementor' => esc_html__( 'Elementor Templates', 'agrikon' ),
                ),
                'default' => 'default'
            ),
            array(
                'title' => esc_html__( 'Elementor Templates', 'agrikon' ),
                'subtitle' => esc_html__( 'Select a template from elementor templates.', 'agrikon' ),
                'id' => 'error_page_elementor_templates',
                'type' => 'select',
                'customizer' => true,
                'options' => agrikon_get_elementorTemplates(),
                'required' => array( 'error_page_type', '=', 'elementor' )
            ),
            array(
                'title' => esc_html__( '404 Header Display', 'agrikon' ),
                'subtitle' => esc_html__( 'You can enable or disable the site 404 page header with switch option.', 'agrikon' ),
                'id' => 'error_header_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off',
                'required' => array( 'error_page_type', '=', 'elementor' )
            ),
            array(
                'title' => esc_html__( '404 Footer Display', 'agrikon' ),
                'subtitle' => esc_html__( 'You can enable or disable the site 404 page footer with switch option.', 'agrikon' ),
                'id' => 'error_footer_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off',
                'required' => array( 'error_page_type', '=', 'elementor' )
            ),
            array(
                'title' => esc_html__( '404 Hero Display', 'agrikon' ),
                'subtitle' => esc_html__( 'You can enable or disable the site 404 page hero section with switch option.', 'agrikon' ),
                'id' => 'error_hero_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off',
                'required' => array( 'error_page_type', '=', 'default' )
            ),
            array(
                'title' => esc_html__( '404 Hero Background', 'agrikon' ),
                'id' => 'error_hero_bg',
                'type' => 'background',
                'output' => array( '#nt-archive .page-header__bg' ),
                'required' => array(
                    array( 'error_page_type', '=', 'default' ),
                    array( 'error_hero_visibility', '=', '1' )
                )
            ),
            array(
                'title' => esc_html__( 'Custom 404 Title', 'agrikon' ),
                'subtitle' => esc_html__( 'Add your custom 404 page title here.', 'agrikon' ),
                'id' => 'error_title',
                'type' => 'text',
                'default' =>'',
                'required' => array(
                    array( 'error_page_type', '=', 'default' ),
                    array( 'error_hero_visibility', '=', '1' )
                )
            ),
            array(
                'title' => esc_html__( '404 Title Typography', 'agrikon' ),
                'id' => 'error_title_typo',
                'type' => 'typography',
                'font-backup' => false,
                'letter-spacing' => true,
                'text-transform' => true,
                'all_styles' => true,
                'output' => array( '#nt-archive .nt-hero-title' ),
                'required' => array(
                    array( 'error_page_type', '=', 'default' ),
                    array( 'error_hero_visibility', '=', '1' )
                )
            ),
            array(
                'title' => esc_html__( 'Content Description Display', 'agrikon' ),
                'subtitle' => esc_html__( 'You can enable or disable the site 404 page content description with switch option.', 'agrikon' ),
                'id' => 'error_content_desc_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off',
                'required' => array( 'error_page_type', '=', 'default' )
            ),
            array(
                'title' => esc_html__( 'Content Description', 'agrikon' ),
                'subtitle' => esc_html__( 'Add your 404 page content description here.', 'agrikon' ),
                'id' => 'error_content_desc',
                'type' => 'textarea',
                'default' => 'Sorry, but the page you are looking for does not exist or has been removed',
                'required' => array(
                    array( 'error_page_type', '=', 'default' ),
                    array( 'error_content_desc_visibility', '=', '1' ),
                )
            ),
            array(
                'title' =>esc_html__( 'Description Typography', 'agrikon' ),
                'id' => 'error_page_content_desc_typo',
                'type' => 'typography',
                'font-backup' => false,
                'letter-spacing' => true,
                'text-transform' => true,
                'all_styles' => true,
                'output' => array( '#nt-404 .content-text' ),
                'required' => array(
                    array( 'error_page_type', '=', 'default' ),
                    array( 'error_content_desc_visibility', '=', '1' ),
                )
            ),
            array(
                'title' => esc_html__( 'Button Display', 'agrikon' ),
                'subtitle' => esc_html__( 'You can enable or disable the site 404 page content back to home button with switch option.', 'agrikon' ),
                'id' => 'error_content_btn_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off',
                'required' => array( 'error_page_type', '=', 'default' )
            ),
            array(
                'title' => esc_html__( 'Button Title', 'agrikon' ),
                'subtitle' => esc_html__( 'Add your 404 page content back to home button title here.', 'agrikon' ),
                'id' => 'error_content_btn_title',
                'type' => 'text',
                'default' => 'Go to home page',
                'required' => array(
                    array( 'error_page_type', '=', 'default' ),
                    array( 'error_content_btn_visibility', '=', '1' ),
                )
            ),
            array(
                'title' => esc_html__( 'Search Form Display', 'agrikon' ),
                'subtitle' => esc_html__( 'You can enable or disable the site 404 page content search form with switch option.', 'agrikon' ),
                'id' => 'error_content_form_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off',
                'required' => array( 'error_page_type', '=', 'default' )
            ),
    )));
    /*************************************************
    ## SEARCH PAGE SECTION
    *************************************************/
    Redux::setSection($agrikon_pre, array(
        'title' => esc_html__( 'Search Page', 'agrikon' ),
        'id' => 'searchsection',
        'icon' => 'el el-search',
    ));
    //SEARCH PAGE SECTION
    Redux::setSection($agrikon_pre, array(
        'title' => esc_html__( 'Search Hero', 'agrikon' ),
        'id' => 'searchherosubsection',
        'desc' => esc_html__( 'These are main settings for general theme!', 'agrikon' ),
        'icon' => 'el el-brush',
        'subsection' => true,
        'fields' => array(
            array(
                'title' => esc_html__( 'Search Hero Display', 'agrikon' ),
                'subtitle' => esc_html__( 'You can enable or disable the site search page hero section with switch option.', 'agrikon' ),
                'id' => 'search_hero_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off'
            ),
            array(
                'title' => esc_html__( 'Search Hero Background', 'agrikon' ),
                'id' =>'search_hero_bg',
                'type' => 'background',
                'output' => array( '#nt-search .page-header__bg' ),
                'required' => array( 'search_hero_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Search Title', 'agrikon' ),
                'subtitle' => esc_html__( 'Add your search page title here.', 'agrikon' ),
                'id' => 'search_title',
                'type' => 'text',
                'default' => esc_html__( 'Search results for :', 'agrikon' ),
                'required' => array( 'search_hero_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Search Title Typography', 'agrikon' ),
                'id' => 'search_title_typo',
                'type' => 'typography',
                'font-backup' => false,
                'letter-spacing' => true,
                'text-transform' => true,
                'all_styles' => true,
                'output' => array( '#nt-search .nt-hero-title' ),
                'required' => array( 'search_hero_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Search Site Title', 'agrikon' ),
                'subtitle' => esc_html__( 'Add your search page site title here.', 'agrikon' ),
                'id' => 'search_site_title',
                'type' => 'textarea',
                'default' => get_bloginfo('name' ),
                'required' => array( 'search_hero_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Search Site Title Typography', 'agrikon' ),
                'id' => 'search_site_title_typo',
                'type' => 'typography',
                'font-backup' => false,
                'letter-spacing' => true,
                'text-transform' => true,
                'all_styles' => true,
                'output' => array( '#nt-search .nt-hero-desc' ),
                'required' => array( 'search_hero_visibility', '=', '1' )
            )
    )));
    //FOOTER SECTION
    Redux::setSection($agrikon_pre, array(
        'title' => esc_html__( 'Footer', 'agrikon' ),
        'desc' => esc_html__( 'These are main settings for general theme!', 'agrikon' ),
        'id' => 'footersection',
        'icon' => 'el el-photo',
        'fields' => array(
            array(
                'title' => esc_html__( 'Footer Section Display', 'agrikon' ),
                'subtitle' => esc_html__( 'You can enable or disable the site footer copyright and footer widget area on the site with switch option.', 'agrikon' ),
                'id' => 'footer_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off'
            ),
            array(
                'title' => esc_html__( 'Footer Type', 'agrikon' ),
                'subtitle' => esc_html__( 'Select your footer type.', 'agrikon' ),
                'id' => 'footer_type',
                'type' => 'select',
                'customizer' => true,
                'options' => array(
                    'default' => esc_html__( 'Deafult Site Footer', 'agrikon' ),
                    'elementor' => esc_html__( 'Elementor Templates', 'agrikon' ),
                ),
                'default' => 'default',
                'required' => array( 'footer_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Elementor Templates', 'agrikon' ),
                'subtitle' => esc_html__( 'Select a template from elementor templates.', 'agrikon' ),
                'id' => 'footer_elementor_templates',
                'type' => 'select',
                'customizer' => true,
                'options' => agrikon_get_elementorTemplates(),
                'required' => array(
                    array( 'footer_visibility', '=', '1' ),
                    array( 'footer_type', '=', 'elementor' )
                )
            ),
            array(
                'title' => esc_html__( 'Copyright Left Section Display', 'agrikon' ),
                'subtitle' => esc_html__( 'You can enable or disable the site footer left section on the site with switch option.', 'agrikon' ),
                'id' => 'footer_copyright_left_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off',
                'required' => array(
                    array( 'footer_visibility', '=', '1' ),
                    array( 'footer_type', '=', 'default' )
                )
            ),
            array(
                'title' => esc_html__( 'Copyright Left Text', 'agrikon' ),
                'subtitle' => esc_html__( 'HTML allowed (wp_kses)', 'agrikon' ),
                'desc' => esc_html__( 'Enter your site copyright left text here.', 'agrikon' ),
                'id' => 'footer_copyright_left',
                'type' => 'textarea',
                'validate' => 'html',
                'default' => sprintf( '<p>&copy; %1$s, <a class="theme" href="%2$s">%3$s</a> Template. %4$s <a class="dev" href="https://ninetheme.com/contact/">%5$s</a></p>',
                    date( 'Y' ),
                    esc_url( home_url( '/' ) ),
                    get_bloginfo( 'name' ),
                    esc_html__( 'Made with passion by', 'agrikon' ),
                    esc_html__( 'Ninetheme.', 'agrikon' )
                ),
                'required' => array(
                    array( 'footer_visibility', '=', '1' ),
                    array( 'footer_copyright_left_visibility', '=', '1' ),
                    array( 'footer_type', '=', 'default' )
                )
            ),
            array(
                'title' => esc_html__( 'Text Alignment', 'agrikon' ),
                'id' => 'footer_copyright_left_align',
                'type' => 'select',
                'default' => 'text-left',
                'customizer' => true,
                'options' => array(
                    '' => esc_html__( 'Select a option', 'agrikon' ),
                    'text-left' => esc_html__( 'left', 'agrikon' ),
                    'text-center' => esc_html__( 'center', 'agrikon' ),
                    'text-right' => esc_html__( 'right', 'agrikon' ),
                ),
                'required' => array(
                    array( 'footer_visibility', '=', '1' ),
                    array( 'footer_copyright_left_visibility', '=', '1' ),
                    array( 'footer_copyright_right_visibility', '=', '0' ),
                    array( 'footer_type', '=', 'default' )
                )
            ),
            array(
                'title' => esc_html__( 'Copyright Right Section Display', 'agrikon' ),
                'subtitle' => esc_html__( 'You can enable or disable the site footer left section on the site with switch option.', 'agrikon' ),
                'id' => 'footer_copyright_right_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off',
                'required' => array(
                    array( 'footer_visibility', '=', '1' ),
                    array( 'footer_type', '=', 'default' )
                )
            ),
            array(
                'title' => esc_html__( 'Copyright Right Text', 'agrikon' ),
                'subtitle' => esc_html__( 'HTML allowed (wp_kses)', 'agrikon' ),
                'desc' => esc_html__( 'Enter your site copyright right text here.', 'agrikon' ),
                'id' => 'footer_copyright_right',
                'type' => 'textarea',
                'validate' => 'html',
                'default' => esc_html__( 'All rights reserved by', 'agrikon' ),
                'required' => array(
                    array( 'footer_visibility', '=', '1' ),
                    array( 'footer_copyright_right_visibility', '=', '1' ),
                    array( 'footer_type', '=', 'default' )
                )
            ),
            array(
                'title' => esc_html__( 'Text Alignment', 'agrikon' ),
                'id' => 'footer_copyright_right_align',
                'type' => 'select',
                'default' => 'text-right',
                'customizer' => true,
                'options' => array(
                    '' => esc_html__( 'Select a option', 'agrikon' ),
                    'text-left' => esc_html__( 'left', 'agrikon' ),
                    'text-center' => esc_html__( 'center', 'agrikon' ),
                    'text-right' => esc_html__( 'right', 'agrikon' ),
                ),
                'required' => array(
                    array( 'footer_visibility', '=', '1' ),
                    array( 'footer_copyright_left_visibility', '=', '0' ),
                    array( 'footer_copyright_right_visibility', '=', '1' ),
                    array( 'footer_type', '=', 'default' )
                )
            ),
            //information on-off
            array(
                'id' =>'info_f0',
                'type' => 'info',
                'style' => 'success',
                'title' => esc_html__( 'Success!', 'agrikon' ),
                'icon' => 'el el-info-circle',
                'customizer' => false,
                'desc' => sprintf(esc_html__( '%s section is disabled on the site.Please activate to view subsection options.', 'agrikon' ), '<b>Site Main Footer</b>' ),
                'required' => array( 'footer_visibility', '=', '0' )
            )
    )));
    //FOOTER SECTION
    Redux::setSection($agrikon_pre, array(
        'title' => esc_html__( 'Footer Style', 'agrikon' ),
        'desc' => esc_html__( 'These are main settings for general theme!', 'agrikon' ),
        'id' => 'footerstylesubsection',
        'icon' => 'el el-photo',
        'subsection' => true,
        'fields' => array(
            array(
                'id' =>'footer_color_customize',
                'type' => 'info',
                'icon' => 'el el-brush',
                'customizer' => false,
                'desc' => sprintf(esc_html__( '%s', 'agrikon' ), '<h2>Footer Color Customize</h2>' ),
                'required' => array(
                    array( 'footer_visibility', '=', '1' ),
                    array( 'footer_type', '=', 'default' )
                )
            ),
            array(
                'title' => esc_html__( 'Footer Padding', 'agrikon' ),
                'subtitle' => esc_html__( 'You can set the top spacing of the site main footer.', 'agrikon' ),
                'id' => 'footer_pad',
                'type' => 'spacing',
                'output' => array('#nt-footer.footer-sm' ),
                'mode' => 'padding',
                'units' => array('em', 'px' ),
                'units_extended' => 'false',
                'default' => array(
                    'padding-top' => '',
                    'padding-right' => '',
                    'padding-bottom' => '',
                    'padding-left' => '',
                    'units' => 'px'
                ),
                'required' => array(
                    array( 'footer_visibility', '=', '1' ),
                    array( 'footer_type', '=', 'default' )
                )
            ),
            array(
                'title' => esc_html__( 'Footer Background Color', 'agrikon' ),
                'desc' => esc_html__( 'Set your own colors for the footer.', 'agrikon' ),
                'id' => 'footer_bg_clr',
                'type' => 'color',
                'validate' => 'color',
                'mode' => 'background-color',
                'output' => array( '#nt-footer.footer-sm' ),
                'required' => array(
                    array( 'footer_visibility', '=', '1' ),
                    array( 'footer_type', '=', 'default' )
                )
            ),
            array(
                'title' => esc_html__( 'Copyright Text Color', 'agrikon' ),
                'desc' => esc_html__( 'Set your own colors for the copyright.', 'agrikon' ),
                'id' => 'footer_copy_clr',
                'type' => 'color',
                'validate' => 'color',
                'transparent' => false,
                'output' => array( '#nt-footer.footer-sm, #nt-footer.footer-sm p' ),
                'required' => array(
                    array( 'footer_visibility', '=', '1' ),
                    array( 'footer_type', '=', 'default' )
                )
            ),
            array(
                'title' => esc_html__( 'Link Color', 'agrikon' ),
                'desc' => esc_html__( 'Set your own colors for the copyright.', 'agrikon' ),
                'id' => 'footer_link_clr',
                'type' => 'color',
                'validate' => 'color',
                'transparent' => false,
                'output' => array( '#nt-footer.footer-sm a' ),
                'required' => array(
                    array( 'footer_visibility', '=', '1' ),
                    array( 'footer_type', '=', 'default' )
                )
            ),
            array(
                'title' => esc_html__( 'Link Color ( Hover )', 'agrikon' ),
                'desc' => esc_html__( 'Set your own colors for the copyright.', 'agrikon' ),
                'id' => 'footer_link_hvr_clr',
                'type' => 'color',
                'validate' => 'color',
                'transparent' => false,
                'output' => array( '#nt-footer.footer-sm a:hover' ),
                'required' => array(
                    array( 'footer_visibility', '=', '1' ),
                    array( 'footer_type', '=', 'default' )
                )
            ),
            //information on-off
            array(
                'id' =>'info_fc0',
                'type' => 'info',
                'style' => 'success',
                'title' => esc_html__( 'Success!', 'agrikon' ),
                'icon' => 'el el-info-circle',
                'customizer' => false,
                'desc' => sprintf(esc_html__( '%s section is disabled on the site.Please activate to view subsection options.', 'agrikon' ), '<b>Site Main Footer</b>' ),
                'required' => array( 'footer_visibility', '=', '0' )
            )
    )));

    Redux::setSection($agrikon_pre, array(
        'id' => 'inportexport_settings',
        'title' => esc_html__( 'Import / Export', 'agrikon' ),
        'desc' => esc_html__( 'Import and Export your Theme Options from text or URL.', 'agrikon' ),
        'icon' => 'fa fa-download',
        'fields' => array(
            array(
                'id' => 'opt-import-export',
                'type' => 'import_export',
                'title' => '',
                'customizer' => false,
                'subtitle' => '',
                'full_width' => true
            )
    )));
    Redux::setSection($agrikon_pre, array(
    'id' => 'nt_support_settings',
    'title' => esc_html__( 'Support', 'agrikon' ),
    'icon' => 'el el-idea',
    'fields' => array(
        array(
            'id' => 'doc',
            'type' => 'raw',
            'markdown' => true,
            'class' => 'theme_support',
            'content' => '<div class="support-section">
            <h5>'.esc_html__( 'WE RECOMMEND YOU READ IT BEFORE YOU START', 'agrikon' ).'</h5>
            <h2><i class="el el-website"></i> '.esc_html__( 'DOCUMENTATION', 'agrikon' ).'</h2>
            <a target="_blank" class="button" href="https://ninetheme.com/docs/agrikon/">'.esc_html__( 'READ MORE', 'agrikon' ).'</a>
            </div>'
        ),
        array(
            'id' => 'support',
            'type' => 'raw',
            'markdown' => true,
            'class' => 'theme_support',
            'content' => '<div class="support-section">
            <h5>'.esc_html__( 'DO YOU NEED HELP?', 'agrikon' ).'</h5>
            <h2><i class="el el-adult"></i> '.esc_html__( 'SUPPORT CENTER', 'agrikon' ).'</h2>
            <a target="_blank" class="button" href="https://ninetheme.com/contact/">'.esc_html__( 'GET SUPPORT', 'agrikon' ).'</a>
            </div>'
        ),
        array(
            'id' => 'portfolio',
            'type' => 'raw',
            'markdown' => true,
            'class' => 'theme_support',
            'content' => '<div class="support-section">
            <h5>'.esc_html__( 'SEE MORE THE NINETHEME WORDPRESS THEMES', 'agrikon' ).'</h5>
            <h2><i class="el el-picture"></i> '.esc_html__( 'NINETHEME PORTFOLIO', 'agrikon' ).'</h2>
            <a target="_blank" class="button" href="https://ninetheme.com/themes/">'.esc_html__( 'SEE MORE', 'agrikon' ).'</a>
            </div>'
        ),
        array(
            'id' => 'like',
            'type' => 'raw',
            'markdown' => true,
            'class' => 'theme_support',
            'content' => '<div class="support-section">
            <h5>'.esc_html__( 'WOULD YOU LIKE TO REWARD OUR EFFORT?', 'agrikon' ).'</h5>
            <h2><i class="el el-thumbs-up"></i> '.esc_html__( 'PLEASE RATE US!', 'agrikon' ).'</h2>
            <a target="_blank" class="button" href="https://themeforest.net/downloads/">'.esc_html__( 'GET STARS', 'agrikon' ).'</a>
            </div>'
        )
    )));
    /*
     * <--- END SECTIONS
     */


    /** Action hook examples **/

    function agrikon_remove_demo()
    {
        // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
        if (class_exists('ReduxFrameworkPlugin' )) {
            // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
            remove_action('admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ));
        }
    }
    //include get_template_directory() . '/inc/core/theme-options/redux-extensions/loader.php';
    function agrikon_newIconFont() {
        // Uncomment this to remove elusive icon from the panel completely
        // wp_deregister_style( 'redux-elusive-icon' );
        // wp_deregister_style( 'redux-elusive-icon-ie7' );
        wp_register_style(
            'redux-font-awesome',
            '//stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',
            array(),
            time(),
            'all'
        );
        wp_enqueue_style( 'redux-font-awesome' );
    }
    add_action( 'redux/page/agrikon/enqueue', 'agrikon_newIconFont' );
