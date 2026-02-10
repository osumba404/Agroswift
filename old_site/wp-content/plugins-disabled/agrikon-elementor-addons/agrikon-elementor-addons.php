<?php
/**
* Plugin Name: Agrikon Elementor Addons
* Description: Premium & Advanced Essential Elements for Elementor
* Plugin URI:  http://themeforest.net/user/Ninetheme
* Version:     1.0.6
* Author:      Ninetheme
* Author URI:  https://ninetheme.com/
* Elementor tested up to: 3.1.3
*/

/*
* Exit if accessed directly.
*/

if ( ! defined( 'ABSPATH' ) ) exit;
define( 'AGRIKON_PLUGIN_VERSION', '1.0.6' );
define( 'AGRIKON_PLUGIN_FILE', __FILE__ );
define( 'AGRIKON_PLUGIN_BASENAME', plugin_basename(__FILE__) );
define( 'AGRIKON_PLUGIN_PATH', plugin_dir_path(__FILE__) );
define( 'AGRIKON_PLUGIN_URL', plugins_url('/', __FILE__) );

final class Agrikon_Elementor_Addons
{

    /**
    * Plugin Version
    *
    * @since 1.0
    *
    * @var string The plugin version.
    */
    const VERSION = '1.0.6';

    /**
    * Minimum Elementor Version
    *
    * @since 1.0
    *
    * @var string Minimum Elementor version required to run the plugin.
    */
    const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

    /**
    * Minimum PHP Version
    *
    * @since 1.0
    *
    * @var string Minimum PHP version required to run the plugin.
    */
    const MINIMUM_PHP_VERSION = '5.6';

    /**
    * Instance
    *
    * @since 1.0
    *
    * @access private
    * @static
    *
    * @var Agrikon_Elementor_Addons The single instance of the class.
    */
    private static $_instance = null;

    /**
    * Instance
    *
    * Ensures only one instance of the class is loaded or can be loaded.
    *
    * @since 1.0
    *
    * @access public
    * @static
    *
    * @return Agrikon_Elementor_Addons An instance of the class.
    */
    public static function instance()
    {

        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
    * Constructor
    *
    * @since 1.0
    *
    * @access public
    */
    public function __construct()
    {
        add_action( 'init', [ $this, 'i18n' ] );
        add_action( 'plugins_loaded', [ $this, 'init' ] );
    }

    /**
    * Load Textdomain
    *
    * Load plugin localization files.
    *
    * Fired by `init` action hook.
    *
    * @since 1.0
    *
    * @access public
    */
    public function i18n()
    {
        load_plugin_textdomain( 'agrikon' );
    }

    /**
    * Initialize the plugin
    *
    * Load the plugin only after Elementor (and other plugins) are loaded.
    * Checks for basic plugin requirements, if one check fail don't continue,
    * if all check have passed load the files required to run the plugin.
    *
    * Fired by `plugins_loaded` action hook.
    *
    * @since 1.0
    *
    * @access public
    */
    public function init()
    {
        // Check if Elementor is installed and activated
        if ( ! did_action( 'elementor/loaded' ) ) {
            add_action( 'admin_notices', [ $this, 'agrikon_admin_notice_missing_main_plugin' ] );
            return;
        }
        // Check for required Elementor version
        if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
            add_action( 'admin_notices', [ $this, 'agrikon_admin_notice_minimum_elementor_version' ] );
            return;
        }
        // Check for required PHP version
        if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
            add_action( 'admin_notices', [ $this, 'agrikon_admin_notice_minimum_php_version' ] );
            return;
        }
        // register template name for the elementor saved templates
        add_filter( 'elementor/editor/localize_settings', [ $this,'agrikon_register_template'],10,2 );
        add_filter( 'elementor/icons_manager/additional_tabs', [ $this,'agrikon_add_custom_icons_tab'],10,2 );
        add_filter( 'elementor/icons_manager/additional_tabs', [ $this,'agrikon_add_custom_icons2_tab'],10,2 );

        /* Custom plugin helper functions */
        require_once( AGRIKON_PLUGIN_PATH . '/classes/class-helpers-functions.php' );
        /* Elementor section parallax */
        require_once( AGRIKON_PLUGIN_PATH . '/classes/class-custom-elementor-section.php' );
        /* Add custom controls to default widgets */
        require_once( AGRIKON_PLUGIN_PATH . '/classes/class-customizing-default-widgets.php' );
        /* Add custom controls to page settings */
        require_once( AGRIKON_PLUGIN_PATH . '/classes/class-customizing-page-settings.php' );
        /* includes/shortcodes/elementor */
        if ( ! get_option( 'disable_agrikon_list_shortcodes' ) == 1 ) {
            require_once( AGRIKON_PLUGIN_PATH . '/classes/class-list-shortcodes.php' );
        }
        if ( ! get_option( 'disable_agrikon_wc_brands' ) == 1 ) {
            require_once( AGRIKON_PLUGIN_PATH . '/widgets/woocommerce/brands/brands.php' );
            require_once( AGRIKON_PLUGIN_PATH . '/widgets/woocommerce/ajax-search/class-ajax-search.php' );
        }
        /* Admin template */
        require_once( AGRIKON_PLUGIN_PATH . '/templates/admin/admin.php' );
        // Categories registered
        add_action( 'elementor/elements/categories_registered', [ $this, 'agrikon_add_widget_category' ] );
        // Widgets registered
        add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
        add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_single_widgets' ] );
        // Register Widget Styles
        add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'widget_styles' ] );
        // Register Widget Scripts
        add_action( 'elementor/frontend/after_enqueue_scripts', [ $this, 'widget_scripts' ] );

        add_action('elementor/editor/after_enqueue_scripts', [ $this, 'admin_custom_scripts' ]);
        // Register Widget Scripts
        add_action( 'wp_print_styles', [ $this, 'dequeue_style' ], 100 );
        add_action( 'wp_print_scripts', [ $this, 'dequeue_scripts' ], 100 );

    }

    public function dequeue_style() {
        if ( is_page() && !is_page_template() ) {
            wp_dequeue_style( 'agrikon-framework-style' );
        }
    }

    public function dequeue_scripts() {
        if( is_page_template( 'default' ) ){
            wp_dequeue_script( 'swiper' );
        }
    }

    public function agrikon_register_template( $localized_settings, $config )
    {
        $localized_settings = [
            'i18n' => [
                'my_templates' => esc_html__( 'Agrikon Templates', 'agrikon' )
            ]
        ];
        return $localized_settings;
    }


    public function admin_custom_scripts()
    {
        // Plugin custom css
        wp_enqueue_style( 'agrikon-custom-editor', AGRIKON_PLUGIN_URL. 'assets/front/css/plugin-editor.css' );
    }

    public function widget_styles()
    {
        // Plugin custom css
        $rtl = is_rtl() ? '-rtl' : '';
        wp_enqueue_style( 'agrikon-custom', AGRIKON_PLUGIN_URL. 'assets/front/css/custom'.$rtl.'.css' );
        if ( class_exists( 'WooCommerce' ) ) {
            wp_enqueue_style( 'agrikon-plugin-woo', AGRIKON_PLUGIN_URL. 'widgets/woocommerce/css/style'.$rtl.'.css' );
        }
    }

    public function widget_scripts()
    {
        wp_enqueue_script( 'jarallax');
        wp_enqueue_script( 'particles');
        wp_enqueue_style( 'vegas');
        wp_enqueue_script( 'vegas');
        // custom-scripts
        wp_enqueue_script( 'agrikon-addons-custom-scripts', AGRIKON_PLUGIN_URL. 'assets/front/js/custom-scripts.js', [ 'jquery' ], AGRIKON_PLUGIN_VERSION, true );
    }

    /**
    * Admin notice
    *
    * Warning when the site doesn't have Elementor installed or activated.
    *
    * @since 1.0
    *
    * @access public
    */
    public function agrikon_admin_notice_missing_main_plugin()
    {
        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }
        $message = sprintf(
            /* translators: 1: Plugin name 2: Elementor */
            esc_html__( '%1$s requires %2$s to be installed and activated.', 'agrikon' ),
            '<strong>' . esc_html__( 'Agrikon Elementor Addons', 'agrikon' ) . '</strong>',
            '<strong>' . esc_html__( 'Elementor', 'agrikon' ) . '</strong>'
        );
        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
    }

    /**
    * Admin notice
    *
    * Warning when the site doesn't have a minimum required Elementor version.
    *
    * @since 1.0
    *
    * @access public
    */
    public function agrikon_admin_notice_minimum_elementor_version()
    {
        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }
        $message = sprintf(
            /* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
            esc_html__( '%1$s requires %2$s version %3$s or greater.', 'agrikon' ),
            '<strong>' . esc_html__( 'Agrikon Elementor Addons', 'agrikon' ) . '</strong>',
            '<strong>' . esc_html__( 'Elementor', 'agrikon' ) . '</strong>',
             self::MINIMUM_ELEMENTOR_VERSION
        );
        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
    }

    /**
    * Admin notice
    *
    * Warning when the site doesn't have a minimum required PHP version.
    *
    * @since 1.0
    *
    * @access public
    */
    public function agrikon_admin_notice_minimum_php_version()
    {
        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }
        $message = sprintf(
            /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
            esc_html__( '%1$s requires %2$s version %3$s or greater.', 'agrikon' ),
            '<strong>' . esc_html__( 'Agrikon Elementor Addons', 'agrikon' ) . '</strong>',
            '<strong>' . esc_html__( 'PHP', 'agrikon' ) . '</strong>',
             self::MINIMUM_PHP_VERSION
        );
        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
    }

    /**
    * Register Widgets Category
    *
    */
    public function agrikon_add_widget_category( $elements_manager )
    {
        $elements_manager->add_category( 'agrikon', [ 'title' => esc_html__( 'Agrikon Addons', 'agrikon' ) ] );
        $elements_manager->add_category( 'agrikon-cpt', [ 'title' => esc_html__( 'Agrikon CPT', 'agrikon' ) ] );
        $elements_manager->add_category( 'agrikon-post', [ 'title' => esc_html__( 'Agrikon Post', 'agrikon' ) ] );
        $elements_manager->add_category( 'agrikon-woo', [ 'title' => esc_html__( 'Agrikon WooCommerce', 'agrikon' ) ] );
    }

    public function agrikon_widgets_list()
    {
        $list = array(
            array( 'name' => 'posts-base', 'class' => 'Agrikon_Posts_Base' ),
            array( 'name' => 'services-item', 'class' => 'Agrikon_Services_Item' ),
            array( 'name' => 'features-item', 'class' => 'Agrikon_Features_Item' ),
            array( 'name' => 'home-slider', 'class' => 'Agrikon_Home_Slider' ),
            array( 'name' => 'about-two', 'class' => 'Agrikon_About_Two' ),
            array( 'name' => 'bubble-image', 'class' => 'Agrikon_Bubble_Image' ),
            array( 'name' => 'cta-one', 'class' => 'Agrikon_Cta_One' ),
            array( 'name' => 'popup-video', 'class' => 'Agrikon_Popup_Video' ),
            array( 'name' => 'blog-special', 'class' => 'Agrikon_Blog_Special' ),
            array( 'name' => 'testimonials-slider', 'class' => 'Agrikon_Testimonials' ),
            array( 'name' => 'team-slider', 'class' => 'Agrikon_Team_Slider' ),
            array( 'name' => 'odometer', 'class' => 'Agrikon_Odometer' ),
            array( 'name' => 'countdown', 'class' => 'Agrikon_Countdown' ),
            array( 'name' => 'post-types-list', 'class' => 'Agrikon_Post_Types_List' ),
            array( 'name' => 'funfact-item', 'class' => 'Agrikon_Funfact_Item' ),
            array( 'name' => 'sidebar-widgets', 'class' => 'Agrikon_Sidebar_Widgets' ),
            array( 'name' => 'circle-progressbar', 'subfolder' => 'circle-progressbar', 'class' => 'Agrikon_Circle_Progressbar' ),
            array( 'name' => 'header-menu', 'class' => 'Agrikon_Header_Menu' ),
            array( 'name' => 'mega-menu', 'subfolder' => 'mega-menu', 'class' => 'Agrikon_Mega_Menu' ),
            array( 'name' => 'shape-overlays-menu', 'subfolder' => 'shape-overlays-menu', 'class' => 'Agrikon_Shape_Overlays_Menu' ),
            array( 'name' => 'page-hero', 'class' => 'Agrikon_Page_Hero' ),
            array( 'name' => 'breadcrumbs', 'class' => 'Agrikon_Breadcrumbs' ),
            array( 'name' => 'vegas-slider', 'class' => 'Agrikon_Vegas_Slider' ),
            array( 'name' => 'vegas-template', 'class' => 'Agrikon_Vegas_Template' ),
            array( 'name' => 'projects-slider', 'class' => 'Agrikon_Projects_Slider' ),
            array( 'name' => 'projects-gallery', 'class' => 'Agrikon_Projects_Gallery' ),
            array( 'name' => 'justified-gallery', 'class' => 'Agrikon_Justified_Gallery' ),
            array( 'name' => 'testimonials-two', 'class' => 'Agrikon_Testimonials_Two' ),
            array( 'name' => 'button', 'class' => 'Agrikon_Button' ),
            array( 'name' => 'button2', 'subfolder' => 'button2', 'class' => 'Agrikon_Button2' ),
            array( 'name' => 'animated-headline', 'class' => 'Agrikon_Animated_Headline' ),
            array( 'name' => 'brands-board', 'class' => 'Agrikon_Brands_Board' ),
            array( 'name' => 'team-member', 'class' => 'Agrikon_Team_Member' ),
            array( 'name' => 'contact-form-7', 'class' => 'Agrikon_Contact_Form_7' ),
            array( 'name' => 'google-map', 'class' => 'Agrikon_Map' ),
            array( 'name' => 'onepage', 'class' => 'Agrikon_Onepage' ),
            array( 'name' => 'advanced-pricing', 'class' => 'Agrikon_Advanced_Pricing' ),
            array( 'name' => 'svg-animation', 'subfolder' => 'vivus', 'class' => 'Agrikon_Svg_Animation' ),
            array( 'name' => 'flip-card', 'class' => 'Agrikon_Flip_Card' ),
            array( 'name' => 'crossroads-slideshow', 'subfolder' => 'crossroads-slideshow', 'class' => 'Agrikon_Crossroads_Slideshow' ),
            array( 'name' => 'page-flip-layout', 'subfolder' => 'page-flip-layout', 'class' => 'Agrikon_Page_Flip_Layout' ),
            array( 'name' => 'interactive-slider', 'subfolder' => 'interactive-link', 'class' => 'Agrikon_Interactive_Link_Slider' ),
            array( 'name' => 'block-revealers', 'subfolder' => 'block-revealers', 'class' => 'Agrikon_Block_Revealers' ),
            array( 'name' => 'two-block-slider', 'subfolder' => 'two-block-slider', 'class' => 'Agrikon_Two_Block_Slider' ),
            array( 'name' => 'svg-pattern', 'subfolder' => 'svg-pattern', 'class' => 'Agrikon_Svg_Pattern' ),
            array( 'name' => 'caption-hover-effects', 'subfolder' => 'caption-hover', 'class' => 'Agrikon_Caption_Hover_Effects' ),
            array( 'name' => 'image-before-after', 'subfolder' => 'image-before-after', 'class' => 'Agrikon_Image_Before_After' ),
            array( 'name' => 'animated-text-background', 'class' => 'Agrikon_Animated_Text_Background' ),
            array( 'name' => 'blog-grid', 'subfolder' => 'blog', 'class' => 'Agrikon_Blog_Grid' ),
            array( 'name' => 'blog-masonry', 'subfolder' => 'blog', 'class' => 'Agrikon_Blog_Masonry' ),
            array( 'name' => 'blog-slider', 'subfolder' => 'blog', 'class' => 'Agrikon_Blog_Slider' ),
            array( 'name' => 'woo-category-grid', 'subfolder' => 'woocommerce', 'class' => 'Agrikon_Woo_Category_Grid' ),
            array( 'name' => 'woo-category-slider', 'subfolder' => 'woocommerce', 'class' => 'Agrikon_Woo_Category_Slider' ),
            array( 'name' => 'woo-product-item', 'subfolder' => 'woocommerce', 'class' => 'Agrikon_Woo_Product_Item' ),
            array( 'name' => 'woo-grid', 'subfolder' => 'woocommerce', 'class' => 'Agrikon_Woo_Grid' ),
            array( 'name' => 'woo-grid-two', 'subfolder' => 'woocommerce', 'class' => 'Agrikon_Woo_Grid_Two' ),
            array( 'name' => 'woo-flash-deals', 'subfolder' => 'woocommerce', 'class' => 'Agrikon_Woo_Flash_Deals' ),
            array( 'name' => 'woo-slider', 'subfolder' => 'woocommerce', 'class' => 'Agrikon_Woo_Slider' ),
            array( 'name' => 'woo-gallery', 'subfolder' => 'woocommerce', 'class' => 'Agrikon_Woo_Gallery' ),
            array( 'name' => 'woo-mini-cart', 'subfolder' => 'woocommerce', 'class' => 'Agrikon_Woo_Minicart' ),
            array( 'name' => 'woo-mini-slider', 'subfolder' => 'woocommerce', 'class' => 'Agrikon_Woo_Mini_Slider' ),
            array( 'name' => 'woo-ajax-search', 'subfolder' => 'woocommerce', 'class' => 'Agrikon_Woo_Ajax_Search' ),
        );
        return $list;
    }

    /**
    * Init Widgets
    */
    public function init_widgets()
    {
        $widgets = $this->agrikon_widgets_list();

        if ( ! empty( $widgets ) ) {

            foreach ( $widgets as $widget ) {

                $option = 'disable_'.str_replace( '-', '_', $widget['name'] );
                $path = AGRIKON_PLUGIN_PATH . '/widgets/';
                $file = $widget['name'] . '.php';
                $file = isset( $widget['subfolder'] ) != '' ? $path.$widget['subfolder'] . '/' . $widget['name']. '.php' : $path.$file;
                $class = 'Elementor\\'.$widget['class'];

                if ( ! get_option( $option ) == 1 ) {

                    if ( file_exists( $file ) ) {
                        require_once( $file );
                        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new $class() );
                    }
                }
            }
        }
    }


    /**
    * Register Single Post Widgets
    */
    public function agrikon_single_widgets_list()
    {
        $list = array(
            array( 'post-type' => 'projects', 'name' => 'project-next', 'class' => 'Agrikon_Project_Next' ),
            array( 'post-type' => 'projects', 'name' => 'project-prev', 'class' => 'Agrikon_Project_Prev' ),
            array( 'post-type' => 'projects', 'name' => 'project-meta', 'class' => 'Agrikon_Project_Meta' ),
            array( 'post-type' => 'post', 'name' => 'post-data', 'class' => 'Agrikon_Post_Data' ),
        );
        return $list;
    }

    /**
    * Init Single Post Widgets
    */
    public function init_single_widgets()
    {
        $widgets = $this->agrikon_single_widgets_list();
        global $post;
        $agrikon_post_type = false;

        if ( ! empty( $widgets ) && !is_404() && !is_archive() ) {

            $agrikon_post_type = get_post_type( $post->ID );

            $count = 0;

            foreach ( $widgets as $widget ) {

                if ( $agrikon_post_type == $widgets[$count]['post-type'] ) {

                    $option = 'disable_'.str_replace( '-', '_', $widget['name'] );
                    $path = AGRIKON_PLUGIN_PATH . '/widgets/';
                    $file = $widget['name'] . '.php';
                    $file = isset( $widget['subfolder'] ) != '' ? $path.$widget['subfolder'] . '/' . $widget['name']. '.php' : $path.$file;
                    $class = 'Elementor\\'.$widget['class'];

                    if ( ! get_option( $option ) == 1 ) {

                        if ( file_exists( $file ) ) {

                            require_once( $file );
                            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new $class() );
                        }
                    }
                }
                $count++;
            }
        }
    }

    /*
    * List Icons
    */

    public function agrikon_add_custom_icons_tab($tabs = array())
    {
        $new_icons = array(
            'agrikon-icon-email',
            'agrikon-icon-clock',
            'agrikon-icon-shopping-cart',
            'agrikon-icon-phone-call',
            'agrikon-icon-magnifying-glass',
            'agrikon-icon-left-arrow',
            'agrikon-icon-right-arrow',
            'agrikon-icon-farmer',
            'agrikon-icon-agriculture',
            'agrikon-icon-agriculture-1',
            'agrikon-icon-agriculture-2',
            'agrikon-icon-tractor',
            'agrikon-icon-tractor-1',
            'agrikon-icon-organic-food',
            'agrikon-icon-vegetable',
            'agrikon-icon-dairy',
            'agrikon-icon-farm',
            'agrikon-icon-pin',
            'agrikon-icon-telephone',
            'agrikon-icon-investment',
            'agrikon-icon-planting',
            'agrikon-icon-customer',
            'agrikon-icon-tick'
        );

        $tabs['agrikon-custom-icons'] = array(
            'name'          => 'agrikon-custom-icons',
            'label'         => esc_html__( 'Agrikon Icons', 'agrikon' ),
            'labelIcon'     => 'agrikon-icon-farmer',
            'prefix'        => 'agrikon-icon ',
            'displayPrefix' => 'flaticon',
            'url'           => get_template_directory_uri() . '/css/plugins/agrikon-icons.css',
            'icons'         => $new_icons,
            'ver'           => '1.0.0',
        );

        return $tabs;
    }

    public function agrikon_add_custom_icons2_tab($tabs = array())
    {
        $new_icons = array(
            'is-apple',
            'is-arrow-down',
            'is-arrow-down2',
            'is-arrow-right',
            'is-arrow-right2',
            'is-arrow-up',
            'is-arrow-up2',
            'is-back',
            'is-avatar',
            'is-bag',
            'is-box',
            'is-calendar',
            'is-cart',
            'is-charity',
            'is-close',
            'is-comment',
            'is-delete',
            'is-document',
            'is-dribbble',
            'is-exchange',
            'is-grid',
            'is-heart',
            'is-internet',
            'is-list',
            'is-menu',
            'is-next',
            'is-quality',
            'is-search',
            'is-send',
            'is-star-outline',
            'is-star',
            'is-support',
            'is-tripadvisor',
            'is-behance',
            'is-digg',
            'is-facebook',
            'is-filter',
            'is-gift',
            'is-github',
            'is-google-plus',
            'is-google-plus2',
            'is-instagram',
            'is-itunes',
            'is-linkedin',
            'is-myspace',
            'is-odnoklassniki',
            'is-pinterest',
            'is-reddit',
            'is-rss',
            'is-skype',
            'is-snapchat',
            'is-soundcloud',
            'is-spotify',
            'is-twitter',
            'is-vimeo',
            'is-vine',
            'is-watch',
            'is-whatsapp',
            'is-wordpress',
            'is-youtube'
        );

        $tabs['agrikon-custom-icons2'] = array(
            'name'          => 'agrikon-custom-icons2',
            'label'         => esc_html__( 'Agrikon Icons Extra', 'agrikon' ),
            'labelIcon'     => 'icons is-star-outline',
            'prefix'        => 'icons ',
            'displayPrefix' => 'flaticon',
            'url'           => get_template_directory_uri() . '/css/plugins/agrikon-icons2.css',
            'icons'         => $new_icons,
            'ver'           => '1.0.0',
        );

        return $tabs;
    }

}
Agrikon_Elementor_Addons::instance();
