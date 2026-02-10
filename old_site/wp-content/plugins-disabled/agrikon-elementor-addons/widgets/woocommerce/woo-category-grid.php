<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;  // If this file is called directly, abort.

class Agrikon_Woo_Category_Grid extends Widget_Base {
    use Agrikon_Helper;
    public function get_name() {
        return 'agrikon-woo-category-grid';
    }
    public function get_title() {
        return 'WC Category (N)';
    }
    public function get_icon() {
        return 'eicon-gallery-grid';
    }
    public function get_categories() {
        return [ 'agrikon-woo' ];
    }
    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
        wp_register_style( 'agrikon-woo', AGRIKON_PLUGIN_URL. 'widgets/woocommerce/css/style.css');
    }
    public function get_style_depends() {
        return [ 'agrikon-woo' ];
    }
    // Registering Controls
    protected function register_controls() {
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'products_slider_items_settings',
            [
                'label' => esc_html__('Products Categories', 'agrikon'),
            ]
        );
        $this->add_control( 'post_per_page',
            [
                'label' => esc_html__( 'Per Page', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 1000,
                'default' => 10,
                'condition' => [ 'type' => 'woo' ]
            ]
        );
        $this->add_control( 'order',
            [
                'label' => esc_html__( 'Select Order', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'ASC' => esc_html__( 'Ascending', 'agrikon' ),
                    'DESC' => esc_html__( 'Descending', 'agrikon' )
                ],
                'default' => 'ASC',
                'condition' => [ 'type' => 'woo' ]
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'thumbnail'
            ]
        );
        $this->add_control( 'orderby',
            [
                'label' => esc_html__( 'Order By', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'id' => esc_html__( 'Post ID', 'agrikon' ),
                    'menu_order' => esc_html__( 'Menu Order', 'agrikon' ),
                    'rand' => esc_html__( 'Random', 'agrikon' ),
                    'date' => esc_html__( 'Date', 'agrikon' ),
                    'title' => esc_html__( 'Title', 'agrikon' ),
                ],
                'default' => 'id',
                'condition' => [ 'type' => 'woo' ]
            ]
        );
        $this->add_control( 'category_exclude',
            [
                'label' => esc_html__( 'Exclude Category', 'agrikon' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->agrikon_cpt_taxonomies('product_cat'),
                'description' => 'Select Category(s) to Exclude',
                'separator' => 'after',
                'condition' => [ 'type' => 'woo' ]
            ]
        );
        $this->add_control( 'col_xl',
            [
                'label' => esc_html__( 'Column X-LARGE Device', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 12,
                'default' => 2,
            ]
        );
        $this->add_control( 'col_lg',
            [
                'label' => esc_html__( 'Column LARGE Device', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 12,
                'default' => 3,
            ]
        );
        $this->add_control( 'col_md',
            [
                'label' => esc_html__( 'Column MEDIUM Device', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 12,
                'default' => 4,
            ]
        );
        $this->add_control( 'col_sm',
            [
                'label' => esc_html__( 'Column SMALL Device', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 12,
                'default' => 6,
            ]
        );
        $this->add_control( 'tag',
            [
                'label' => esc_html__( 'Title Tag', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'h3',
                'options' => [
                    'h1' => esc_html__( 'H1', 'agrikon' ),
                    'h2' => esc_html__( 'H2', 'agrikon' ),
                    'h3' => esc_html__( 'H3', 'agrikon' ),
                    'h4' => esc_html__( 'H4', 'agrikon' ),
                    'h5' => esc_html__( 'H5', 'agrikon' ),
                    'h6' => esc_html__( 'H6', 'agrikon' ),
                    'div' => esc_html__( 'div', 'agrikon' ),
                    'p' => esc_html__( 'p', 'agrikon' ),
                ],
            ]
        );
        $this->add_control( 'hidethumb',
            [
                'label' => esc_html__( 'Hide Thumbnail', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'hidecat',
            [
                'label' => esc_html__( 'Hide Category Name', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'hidecount',
            [
                'label' => esc_html__( 'Hide Category Count', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'hidelabel',
            [
                'label' => esc_html__( 'Hide Category Count', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'cat_singular',
            [
                'label' => esc_html__( 'Category Text Singular', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Product',
                'pleaceholder' => esc_html__( 'Enter title here', 'agrikon' ),
                'condition' => [ 'hidelabel!' => 'yes' ]
            ]
        );
        $this->add_control( 'cat_plural',
            [
                'label' => esc_html__( 'Category Text Plural', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Products',
                'pleaceholder' => esc_html__( 'Enter title here', 'agrikon' ),
                'condition' => [ 'hidelabel!' => 'yes' ]
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'style_section',
            [
                'label' => esc_html__( 'Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'box_heading',
            [
                'label' => esc_html__( 'BOX', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'box_border',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selector' => '{{WRAPPER}} .service-two__card',
            ]
        );
        $this->add_responsive_control( 'box_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .service-two__card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->add_control( 'box_bgcolor',
            [
                'label' => esc_html__( 'Background Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .service-two__card' => 'background-color: {{VALUE}};']
            ]
        );
        $this->add_control( 'box_hvrbgcolor',
            [
                'label' => esc_html__( 'Hover Background Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .service-two__card' => 'background-color: {{VALUE}};']
            ]
        );
        $this->add_control( 'box_bscolor',
            [
                'label' => esc_html__( 'Hover Boxshadow Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .service-two__card' => '-webkit-box-shadow: 0 4px 0 0 {{VALUE}};box-shadow: 0 4px 0 0 {{VALUE}};']
            ]
        );
        $this->add_control( 'image_heading',
            [
                'label' => esc_html__( 'IMAGE', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'image_border',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selector' => '{{WRAPPER}} .service-two__card-image > img',
            ]
        );
        $this->add_responsive_control( 'image_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .service-two__card-image > img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->add_control( 'count_heading',
            [
                'label' => esc_html__( 'COUNT', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'icon_size',
            [
                'label' => esc_html__( 'Size', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .service-two__card-icon' => 'width: {{SIZE}}px;height: {{SIZE}}px;' ],
            ]
        );
        $this->add_control( 'count_bgcolor',
            [
                'label' => esc_html__( 'Background Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .service-two__card .service-two__card-icon' => 'background-color: {{VALUE}};']
            ]
        );
        $this->add_control( 'count_hvrbgcolor',
            [
                'label' => esc_html__( 'Hover Background Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .service-two__card:hover .service-two__card-icon' => 'background-color: {{VALUE}};']
            ]
        );
        $this->add_control( 'count_color',
            [
                'label' => esc_html__( 'Number Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .service-two__card-icon .grid-cate--count' => 'color: {{VALUE}};']
            ]
        );
        $this->add_control( 'count_hvrcolor',
            [
                'label' => esc_html__( 'Hover Number Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .service-two__card:hover .grid-cate--count' => 'color: {{VALUE}};']
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'count_typo',
                'label' => esc_html__( 'Number Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .service-two__card-icon .grid-cate--count'
            ]
        );
        $this->add_control( 'label_color',
            [
                'label' => esc_html__( 'Label Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .grid-cate--label' => 'color: {{VALUE}};']
            ]
        );
        $this->add_control( 'label_hvrcolor',
            [
                'label' => esc_html__( 'Hover Label Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .service-two__card:hover .grid-cate--label' => 'color: {{VALUE}};']
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'label_typo',
                'label' => esc_html__( 'Label Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .section-woo-grid--categories .service-two__card-icon .grid-cate--count'
            ]
        );
        $this->add_control( 'cat_heading',
            [
                'label' => esc_html__( 'CATEGORY', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'cat_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .service-two__card-content .title' => 'color: {{VALUE}};']
            ]
        );
        $this->add_control( 'cat_hvrcolor',
            [
                'label' => esc_html__( 'Hover Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .service-two__card:hover .service-two__card-content .title' => 'color: {{VALUE}};']
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'cat_typo',
                'label' => esc_html__( 'Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .service-two__card-content .title'
            ]
        );
        $this->add_control( 'cat_bg',
            [
                'label' => esc_html__( 'Background', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .service-two__card-content' => 'background-color:{{VALUE}};' ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'cat_border',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selector' => '{{WRAPPER}} ..service-two__card-content',
            ]
        );
        $this->add_responsive_control( 'cat_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .service-two__card-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }

    protected function render() {
        $settings  = $this->get_settings_for_display();
        $elementid = $this->get_id();
        $colxl = $settings['col_xl'] ? $settings['col_xl'] : 2;
        $collg = $settings['col_lg'] ? $settings['col_lg'] : 3;
        $colmd = $settings['col_md'] ? $settings['col_md'] : 4;
        $colsm = $settings['col_sm'] ? $settings['col_sm'] : 6;

        $size = $settings['thumbnail_size'] ? $settings['thumbnail_size'] : 'full';
        if ( 'custom' == $size ) {
            $sizew = $settings['thumbnail_custom_dimension']['width'];
            $sizeh = $settings['thumbnail_custom_dimension']['height'];
            $size = [ $sizew, $sizeh ];
        }

        if ( class_exists( 'WooCommerce' ) ) {
            echo '<div class="section-woo-grid--categories">';
                echo '<div class="row">';
                    $cats = get_terms(
                        array(
                            'taxonomy' => 'product_cat',
                            'order' => $settings['order'],
                            'orderby' => $settings['orderby'],
                            'exclude' => $settings['category_exclude']
                        )
                    );
                    foreach ($cats as $cat) {
                        $imgid = get_term_meta($cat->term_id, 'thumbnail_id', true );
                        $imgsrc = wp_get_attachment_url( $imgid );
                        echo '<div class="col-12 col-sm-'.$colsm.' col-md-'.$colmd.' col-lg-'.$collg.' col-xl-'.$colxl.'">';
                            echo '<div class="service-two__card">';
                                echo '<a class="grid-cat--item" href="'.esc_url( get_term_link( $cat ) ).'" title="'.$cat->name.'">';
                                    if ( $imgsrc && 'yes' != $settings['hidethumb'] ) {
                                        echo '<div class="service-two__card-image">';
                                            echo wp_get_attachment_image( $imgid, $size, false, ['class'=>'grid-cate--img s-img'] );
                                        echo '</div>';
                                    }
                                    if ( 'yes' != $settings['hidecount'] || 'yes' != $settings['hidecat'] ) {
                                        echo '<div class="service-two__card-content">';
                                            if ( 'yes' != $settings['hidecount'] ) {
                                                echo '<div class="service-two__card-icon">';
                                                    if ( $cat->count > 1 ) {
                                                        echo '<span class="grid-cate--count">'.$cat->count.'</span>';
                                                    }
                                                echo '</div>';
                                                if ( 'yes' != $settings['hidelabel'] ) {
                                                    $label = $cat->count > 1 ? $settings['cat_plural'] : $settings['cat_singular'];
                                                    echo '<span class="grid-cate--label">'.$label.'</span>';
                                                }
                                            }
                                            if ( 'yes' != $settings['hidecat'] ) {
                                                echo '<'.$settings['tag'].' class="title">'.$cat->name.'</'.$settings['tag'].'>';
                                            }
                                        echo '</div>';
                                    }
                                echo '</a>';
                            echo '</div>';
                        echo '</div>';
                        }
                echo '</div>';
            echo '</div>';
        }
    }
}
