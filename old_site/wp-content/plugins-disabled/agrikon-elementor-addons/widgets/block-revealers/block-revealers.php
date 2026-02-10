<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Agrikon_Block_Revealers extends Widget_Base {

    use Agrikon_Helper;

    public function get_name() {
        return 'agrikon-block-revealers';
    }
    public function get_title() {
        return 'Reveals Effects (N)';
    }
    public function get_icon() {
        return 'eicon-slider-push';
    }
    public function get_categories() {
        return [ 'agrikon' ];
    }
    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
        
        wp_register_style( 'agrikon-block-revealers', AGRIKON_PLUGIN_URL. 'widgets/block-revealers/style.css');
        wp_register_style( 'agrikon-simplebar', AGRIKON_PLUGIN_URL. 'widgets/block-revealers/simplebar.css');
        wp_register_script( 'simplebar', AGRIKON_PLUGIN_URL. 'widgets/block-revealers/simplebar.min.js', [ 'jquery' ], '1.0.0', true );
        wp_register_script( 'anime', AGRIKON_PLUGIN_URL. 'widgets/block-revealers/anime.min.js', '', '1.0.0', true );
        wp_register_script( 'scroll-monitor', AGRIKON_PLUGIN_URL. 'widgets/block-revealers/scrollMonitor.js','', '1.0.0', true );
        wp_register_script( 'agrikon-block-revealers', AGRIKON_PLUGIN_URL. 'widgets/block-revealers/script.js', [ 'elementor-frontend' ], '1.0.0', true );
        wp_register_script( 'agrikon-block-revealers-settings', AGRIKON_PLUGIN_URL. 'widgets/block-revealers/script-settings.js', [ 'elementor-frontend' ], '1.0.0', true );

    }
    public function get_style_depends() {
        return [ 'agrikon-block-revealers', 'agrikon-simplebar' ];
    }
    public function get_script_depends() {
        return [ 'anime', 'scroll-monitor', 'agrikon-block-revealers', 'agrikon-block-revealers-settings', 'simplebar' ];
    }
    
    // Registering Controls
    protected function register_controls() {
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('agrikon_revealers_settings',
            [
                'label' => esc_html__( 'General Reveals Effects', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'content_type',
            [
                'label' => esc_html__( 'Type', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'content',
                'options' => [
                    'content' => esc_html__( 'Content', 'agrikon' ),
                    'modal' => esc_html__( 'Modal', 'agrikon' ),
                    'split' => esc_html__( 'Split', 'agrikon' ),
                ]
            ]
        );
        $this->add_control( 'cover_color',
            [
                'label' => esc_html__( 'Cover Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control( 'cover_width',
            [
				'label' => esc_html__( 'Cover Area Width ( % )', 'agrikon' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 50,
				],
				'condition' => [ 'content_type' => 'split' ],
				'selectors' => [ 
				    '{{WRAPPER}} .block-revealer__content' => 'max-width: calc( 100% - {{SIZE}}% );',
				    '{{WRAPPER}} .admin .block-revealer__element' => 'transform: scaleX(calc( {{SIZE}} / 100 ) )!important;',
				    '{{WRAPPER}} .dual__half' => 'max-width: calc( 100% - {{SIZE}}% );',
				    '{{WRAPPER}} .media__toolbar' => 'max-width: {{SIZE}}%;',
				    '{{WRAPPER}} .dual__content' => 'width: {{SIZE}}%;max-width: {{SIZE}}%;',
				],
            ]
        );
        $this->add_control( 'split_type',
            [
                'label' => esc_html__( 'Split Image Position', 'agrikon' ),
                'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'agrikon' ),
						'icon' => 'eicon-h-align-left'
					],
					'right' => [
						'title' => __( 'Right', 'agrikon' ),
						'icon' => 'eicon-h-align-right'
					]
				],
				'default' => 'right',
				'toggle' => true,
				'separator' => 'before',
				'condition' => [ 'content_type' => 'split' ],
            ]
        );
        $this->add_responsive_control( 'cover_height',
            [
				'label' => esc_html__( 'Cover Area Min Height ( px )', 'agrikon' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 500,
				],
                'conditions' => [
    				'relation' => 'and',
    				'terms' => [
    					[
    						'name' => 'content_type',
    						'operator' => '==',
    						'value' => 'split'
    					],
    					[
    						'name' => 'split_type',
    						'operator' => '==',
    						'value' => 'right'
    					]
    				]
    			],
				'selectors' => [ '{{WRAPPER}} .reveals-split.split-right .dual__content' => 'height: {{SIZE}}px;min-height: {{SIZE}}px;' ],
            ]
        );
        $this->add_control( 'direction',
            [
                'label' => esc_html__( 'Direction', 'agrikon' ),
                'type' => Controls_Manager::CHOOSE,
				'options' => [
					'rl' => [
						'title' => __( 'Left to Right', 'agrikon' ),
						'icon' => 'eicon-h-align-left'
					],
					'lr' => [
						'title' => __( 'Right to Left', 'agrikon' ),
						'icon' => 'eicon-h-align-right'
					]
				],
				'default' => 'lr',
				'toggle' => true,
				'separator' => 'before',
				'condition' => [ 'content_type' => 'content' ],
            ]
        );
        $this->add_control( 'delay',
            [
				'label' => esc_html__( 'Delay', 'agrikon' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 2000,
				'step' => 100,
				'default' => '',
				'condition' => [ 'content_type!' => 'split' ],
            ]
        );
        $this->add_control( 'duration',
            [
				'label' => esc_html__( 'Duration', 'agrikon' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 2000,
				'step' => 100,
				'default' => 400,
				'condition' => [ 'content_type!' => 'content' ],
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        
        /*****   START CONTROLS SECTION   ******/
        $this->content_type_controls();
        /*****   END CONTROLS SECTION   ******/
        
        
        /*****   START CONTROLS SECTION   ******/
        $this->modal_type_controls();
        /*****   END CONTROLS SECTION   ******/
        
        /*****   START CONTROLS SECTION   ******/
        $this->split_type_controls();
        /*****   END CONTROLS SECTION   ******/
        
    }
    
    
    /*****   START CONTROLS FUNCTION   ******/
    public function content_type_controls() {
        
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'revealers_content_type_controls',
            [
                'label'=> esc_html__( 'Content Options', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [ 'content_type' => 'content' ],
            ]
        );
        $this->add_control( 'content',
            [
                'label' => esc_html__( 'Content Type', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'text',
                'options' => [
                    'text' => esc_html__( 'Text', 'agrikon' ),
                    'image' => esc_html__( 'Image', 'agrikon' ),
                ]
            ]
        );
        $this->add_control( 'image',
            [
                'label' => esc_html__( 'Image', 'agrikon' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [ 'url' => '' ],
                'separator' => 'before',
                'condition' => [ 'content' => 'image' ],
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'full',
                'condition' => [ 'content' => 'image' ],
            ]
        );
        $this->add_control( 'revealers_content_type_image_display',
            [
                'label' => esc_html__( 'Display Type', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__( 'Block', 'agrikon' ),
                    'inline-block' => esc_html__( 'Inline', 'agrikon' ),
                ],
                'selectors' => [ '{{WRAPPER}} .content_image-wrap' => 'display: {{VALUE}};' ],
                'separator' => 'before',
            ]
        );
        $this->add_control( 'title',
            [
                'label' => esc_html__( 'Text', 'agrikon' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Self-imposed limitations',
                'separator' => 'before',
                'condition' => [ 'content' => 'text' ],
            ]
        );
        
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'revealers_content_type_image_style_section',
            [
                'label'=> esc_html__( 'Image Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'conditions' => [
    				'relation' => 'and',
    				'terms' => [
    					[
    						'name' => 'content_type',
    						'operator' => '==',
    						'value' => 'content'
    					],
    					[
    						'name' => 'content',
    						'operator' => '==',
    						'value' => 'image'
    					]
    				]
    			]
            ]
        );

        $this->agrikon_style_border( 'revealers_content_type_image_border','{{WRAPPER}} .content_image-wrap');
        $this->agrikon_style_padding( 'revealers_content_type_image_padding','{{WRAPPER}} .content_image-wrap');
        $this->agrikon_style_margin( 'revealers_content_type_image_margin','{{WRAPPER}} .content_image-wrap');
        
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'revealers_content_type_text_style_section',
            [
                'label'=> esc_html__( 'Text Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'conditions' => [
    				'relation' => 'and',
    				'terms' => [
    					[
    						'name' => 'content_type',
    						'operator' => '==',
    						'value' => 'content'
    					],
    					[
    						'name' => 'content',
    						'operator' => '==',
    						'value' => 'text'
    					]
    				]
    			]
            ]
        );
        $this->add_control( 'revealers_content_type_text_display',
            [
                'label' => esc_html__( 'Display Type', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'text',
                'options' => [
                    'block' => esc_html__( 'Block', 'agrikon' ),
                    'inline-block' => esc_html__( 'Inline', 'agrikon' ),
                ],
                'selectors' => [ '{{WRAPPER}} .content_title' => 'display: {{VALUE}};' ],
                'separator' => 'after',
            ]
        );
        $this->agrikon_style_typo( 'revealers_content_type_text_typo','{{WRAPPER}} .content_title');
        $this->agrikon_style_color( 'revealers_content_type_text_color','{{WRAPPER}} .content_title');
        $this->agrikon_style_text_alignment( 'revealers_content_type_text_alignment','{{WRAPPER}} .agrikon-reveals');
        $this->agrikon_style_border( 'revealers_text_border','{{WRAPPER}} .content_title');
        $this->agrikon_style_padding( 'revealers_text_padding','{{WRAPPER}} .content_title');
        $this->agrikon_style_margin( 'revealers_text_margin','{{WRAPPER}} .content_title');
        
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        
    }
    /*****   END CONTROLS FUNCTION   ******/
    
    /*****   START CONTROLS FUNCTION   ******/
    public function modal_type_controls() {
        
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'revealers_modal_type_open_controls',
            [
                'label'=> esc_html__( 'Modal Open Options', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [ 'content_type' => 'modal' ],
            ]
        );
        $this->add_control( 'modal_open_type',
            [
                'label' => esc_html__( 'Open HTML Type', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'button',
                'options' => [
                    'image' => esc_html__( 'Image', 'agrikon' ),
                    'icon' => esc_html__( 'Icon', 'agrikon' ),
                    'button' => esc_html__( 'Button', 'agrikon' ),
                ]
            ]
        );
        $this->add_control( 'modal_open_image',
            [
                'label' => esc_html__( 'Image', 'agrikon' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [ 'url' => AGRIKON_PLUGIN_URL . 'assets/front/img/team-member-1.jpg' ],
                'separator' => 'before',
                'condition' => [ 'modal_open_type' => 'image' ],
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail3',
                'default' => 'full',
                'condition' => [ 'modal_open_type' => 'image' ],
            ]
        );
        $this->add_control( 'open_btn_title',
            [
                'label' => esc_html__( 'Open Button Title', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Open Modal',
                'condition' => [ 'modal_open_type' => 'button' ],
            ]
        );
		$this->add_control( 'modal_open_icon',
			[
				'label' => esc_html__( 'Icon', 'agrikon' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
				'condition' => [ 'modal_open_type' => 'icon' ],
			]
		);
        $this->add_responsive_control( 'modal_open_icon_size',
            [
				'label' => esc_html__( 'Icon Size', 'agrikon' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 30
				],
				'selectors' => [ '{{WRAPPER}} .modal--open-icon' => 'font-size: {{SIZE}}px;' ],
				'condition' => [ 'modal_open_type' => 'icon' ]
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'revealers_modal_type_controls',
            [
                'label'=> esc_html__( 'Modal Options', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [ 'content_type' => 'modal' ],
            ]
        );
        $this->add_responsive_control( 'modal_height',
            [
				'label' => esc_html__( 'Modal Max Height ( px )', 'agrikon' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 30,
						'max' => 750,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 500,
				],
				'selectors' => [ '{{WRAPPER}} .modal__inner' => 'height: {{SIZE}}px;max-height: {{SIZE}}px;overflow:hidden;overflow-y: auto;' ],
            ]
        );
        $this->add_responsive_control( 'modal_width',
            [
				'label' => esc_html__( 'Modal Max Width ( % )', 'agrikon' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'selectors' => [ '{{WRAPPER}} .revealers-modal' => 'width: {{SIZE}}%;max-width: {{SIZE}}%;' ],
            ]
        );
        $this->add_control( 'direction_in',
            [
                'label' => esc_html__( 'Cover Direction In', 'agrikon' ),
                'type' => Controls_Manager::CHOOSE,
				'options' => [
					'lr' => [
						'title' => __( 'Left to Right', 'agrikon' ),
						'icon' => 'eicon-h-align-right'
					],
					'rl' => [
						'title' => __( 'Right to Left', 'agrikon' ),
						'icon' => 'eicon-h-align-left'
					],
					'tb' => [
						'title' => __( 'Top to Bottom', 'agrikon' ),
						'icon' => 'eicon-v-align-bottom'
					],
					'bt' => [
						'title' => __( 'Bottom to Top', 'agrikon' ),
						'icon' => 'eicon-v-align-top'
					]
				],
				'default' => 'bt',
				'toggle' => false,
				'separator' => 'before',
            ]
        );
        $this->add_control( 'direction_out',
            [
                'label' => esc_html__( 'Cover Direction Out', 'agrikon' ),
                'type' => Controls_Manager::CHOOSE,
				'options' => [
					'lr' => [
						'title' => __( 'Left to Right', 'agrikon' ),
						'icon' => 'eicon-h-align-right'
					],
					'rl' => [
						'title' => __( 'Right to Left', 'agrikon' ),
						'icon' => 'eicon-h-align-left'
					],
					'tb' => [
						'title' => __( 'Top to Bottom', 'agrikon' ),
						'icon' => 'eicon-v-align-bottom'
					],
					'bt' => [
						'title' => __( 'Bottom to Top', 'agrikon' ),
						'icon' => 'eicon-v-align-top'
					]
				],
				'default' => 'tb',
				'toggle' => false,
				'separator' => 'before'
            ]
        );
        $this->add_control( 'overlay_color',
            [
                'label' => esc_html__( 'Lightbox Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'separator' => 'before',
                'selectors' => [ '{{WRAPPER}} .overlay' => 'background-color: {{VALUE}};' ]
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'revealers_modal_type_content_controls',
            [
                'label'=> esc_html__( 'Modal Content', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [ 'content_type' => 'modal' ],
            ]
        );
        $this->add_control( 'modal_content_type',
            [
                'label' => esc_html__('Content Type', 'agrikon'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'content' => esc_html__('Content', 'agrikon'),
                    'template' => esc_html__('Saved Templates', 'agrikon'),
                ],
                'default' => 'content',
            ]
        );
        $this->add_control( 'primary_templates',
            [
                'label' => esc_html__('Choose Template', 'agrikon'),
                'type' => Controls_Manager::SELECT2,
                'options' => $this->agrikon_get_elementor_templates(),
                'condition' => [ 'modal_content_type' => 'template' ],
                'separator' => 'before',
            ]
        );
        $this->add_control( 'custom_modal_content',
            [
                'label' => esc_html__('Content', 'agrikon'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => '<h3>Delete all my data</h3><p>If you decide to delete all your data, we will retain no backup and everything will be lost forever.</p>',
                'dynamic' => ['active' => true],
                'condition' => [ 'modal_content_type' => 'content' ],
                'separator' => 'before',
            ]
        );
        $this->add_control( 'modal_content_flex_v_alignment',
            [
                'label' => esc_html__( 'Content Vertical Alignment', 'agrikon' ),
                'type' => Controls_Manager::CHOOSE,
                'selectors' => ['{{WRAPPER}} .revealers-modal.block-revealer .modal__inner.modal-inner-type-content .os-content' => 'justify-content:{{VALUE}};'],
				'options' => [
					'flex-start' => [
						'title' => __( 'Top', 'agrikon' ),
						'icon' => 'eicon-v-align-top'
					],
					'center' => [
						'title' => __( 'Center', 'agrikon' ),
						'icon' => 'fa fa-arrows-v'
					],
					'flex-end' => [
						'title' => __( 'Bottom', 'agrikon' ),
						'icon' => 'eicon-v-align-bottom'
					]
				],
				'default' => 'center',
				'toggle' => true,
				'separator' => 'before',
				'condition' => [ 'modal_content_type' => 'content' ],
            ]
        );
        $this->add_control( 'modal_content_flex_h_alignment',
            [
                'label' => esc_html__( 'Content Horizontal Alignment', 'agrikon' ),
                'type' => Controls_Manager::CHOOSE,
                'selectors' => ['{{WRAPPER}} .revealers-modal.block-revealer .modal__inner.modal-inner-type-content .os-content' => 'align-items:{{VALUE}};'],
				'options' => [
					'flex-start' => [
						'title' => __( 'Left', 'agrikon' ),
						'icon' => 'eicon-h-align-left'
					],
					'center' => [
						'title' => __( 'Center', 'agrikon' ),
						'icon' => 'eicon-h-align-center'
					],
					'flex-end' => [
						'title' => __( 'Right', 'agrikon' ),
						'icon' => 'eicon-h-align-right'
					]
				],
				'default' => 'center',
				'toggle' => true,
				'separator' => 'before',
				'condition' => [ 'modal_content_type' => 'content' ],
            ]
        );
        $this->add_control( 'revealers_modal_text_heading_color',
            [
                'label' => esc_html__( 'Content Heading Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'separator' => 'before',
                'selectors' => [ '{{WRAPPER}} .modal__inner h1, {{WRAPPER}} .modal__inner h2, {{WRAPPER}} .modal__inner h3, {{WRAPPER}} .modal__inner h4, {{WRAPPER}} .modal__inner h5, {{WRAPPER}} .modal__inner h6' => 'color: {{VALUE}};' ],
                'condition' => [ 'modal_content_type' => 'content' ],
            ]
        );
        $this->add_control( 'revealers_modal_text_color',
            [
                'label' => esc_html__( 'Text Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'separator' => 'before',
                'selectors' => [ '{{WRAPPER}} .modal__inner' => 'color: {{VALUE}};' ],
                'condition' => [ 'modal_content_type' => 'content' ],
            ]
        );
        $this->add_control( 'revealers_modal_text_link_color',
            [
                'label' => esc_html__( 'Content Link Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'separator' => 'before',
                'selectors' => [ '{{WRAPPER}} .modal__inner a' => 'color: {{VALUE}};' ],
                'condition' => [ 'modal_content_type' => 'content' ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'revealers_modal_text_typo',
                'label' => esc_html__( 'Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .modal__inner',
                'condition' => [ 'modal_content_type' => 'content' ]
            ]
        );
        $this->add_control( 'scrollbar_type',
            [
                'label' => esc_html__('Overflow Scrollbar Theme', 'agrikon'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'os-theme-dark' => esc_html__('theme-dark', 'agrikon'),
                    'os-theme-light' => esc_html__('theme-light', 'agrikon'),
                    'os-theme-minimal-dark' => esc_html__('minimal-dark', 'agrikon'),
                    'os-theme-minimal-light' => esc_html__('minimal-light', 'agrikon'),
                    'os-theme-thin-dark' => esc_html__('thin-dark', 'agrikon'),
                    'os-theme-thin-light' => esc_html__('thin-light', 'agrikon'),
                    'os-theme-thick-dark' => esc_html__('thick-dark', 'agrikon'),
                    'os-theme-thick-light' => esc_html__('thick-light', 'agrikon'),
                    'os-theme-round-dark' => esc_html__('round-dark', 'agrikon'),
                    'os-theme-round-light' => esc_html__('round-light', 'agrikon'),
                    'os-theme-block-dark' => esc_html__('block-dark', 'agrikon'),
                    'os-theme-block-light' => esc_html__('block-light', 'agrikon'),
                ],
                'default' => 'os-theme-thick-light',
                'separator' => 'before',
            ]
        );
        $this->add_control( 'scrollbar_color',
            [
                'label' => esc_html__( 'Scrollbar Handle Custom Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .os-theme-dark > .os-scrollbar > .os-scrollbar-track > .os-scrollbar-handle,
                {{WRAPPER}} .os-theme-light > .os-scrollbar > .os-scrollbar-track > .os-scrollbar-handle,
                {{WRAPPER}} .os-theme-dark > .os-scrollbar:hover > .os-scrollbar-track > .os-scrollbar-handle,
                {{WRAPPER}} .os-theme-light > .os-scrollbar:hover > .os-scrollbar-track > .os-scrollbar-handle,
                {{WRAPPER}} .os-theme-dark > .os-scrollbar > .os-scrollbar-track > .os-scrollbar-handle.active,
                {{WRAPPER}} .os-theme-light > .os-scrollbar > .os-scrollbar-track > .os-scrollbar-handle.active,
                {{WRAPPER}} .os-theme-minimal-dark > .os-scrollbar > .os-scrollbar-track > .os-scrollbar-handle:before,
                {{WRAPPER}} .os-theme-minimal-light > .os-scrollbar > .os-scrollbar-track > .os-scrollbar-handle:before,
                {{WRAPPER}} .os-theme-thin-dark > .os-scrollbar > .os-scrollbar-track > .os-scrollbar-handle:before,
                {{WRAPPER}} .os-theme-thin-light > .os-scrollbar > .os-scrollbar-track > .os-scrollbar-handle:before,
                {{WRAPPER}} .os-theme-thick-dark > .os-scrollbar > .os-scrollbar-track > .os-scrollbar-handle,
                {{WRAPPER}} .os-theme-thick-light > .os-scrollbar > .os-scrollbar-track > .os-scrollbar-handle,
                {{WRAPPER}} .os-theme-round-light > .os-scrollbar > .os-scrollbar-track > .os-scrollbar-handle:before,
                {{WRAPPER}} .os-theme-round-dark > .os-scrollbar > .os-scrollbar-track > .os-scrollbar-handle:before' => 'background: {{VALUE}};' ],
            ]
        );
        $this->add_control( 'hide_content_close_btn',
            [
                'label' => esc_html__( 'Disable Content Close Button', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'close_btn_title',
            [
                'label' => esc_html__( 'Close Button Title', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Cancel',
                'condition' => [ 'hide_content_close_btn!' => 'yes' ],
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        
        
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'revealers_modal_style_section',
            [
                'label'=> esc_html__( 'Modal Box Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [ 'content_type' => 'modal' ],
            ]
        );
        $this->agrikon_style_background( 'revealers_modal_background','{{WRAPPER}} .modal__inner',array('classic', 'gradient') );
        $this->agrikon_style_border( 'revealers_modal_border','{{WRAPPER}} .modal__inner');
        $this->agrikon_style_padding( 'revealers_modal_padding','{{WRAPPER}} .modal__inner', $allow='all');

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'revealers_modal_btns_style_section',
            [
                'label'=> esc_html__( 'Modal Buttons Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [ 'content_type' => 'modal' ],
            ]
        );
        $this->start_controls_tabs( 'revealers_modal_btns_tabs');
        $this->start_controls_tab( 'revealers_modal_btns_normal_tab',
            [ 'label'  => esc_html__( 'Normal', 'agrikon' ) ]
        );
        $this->agrikon_style_border( 'revealers_modal_btns_border','{{WRAPPER}} .agrikon--modal-open, {{WRAPPER}} .btn--modal-close');
        $this->agrikon_style_background( 'revealers_modal_btns_background','{{WRAPPER}} .agrikon--modal-open, {{WRAPPER}} .btn--modal-close',array('classic','gradient') );
        $this->agrikon_style_padding( 'revealers_modal_btns_padding','{{WRAPPER}} .agrikon--modal-open, {{WRAPPER}} .btn--modal-close');
        $this->agrikon_style_margin( 'revealers_modal_btns_margin','{{WRAPPER}} .agrikon--modal-open, {{WRAPPER}} .btn--modal-close');
        $this->end_controls_tab();

        $this->start_controls_tab( 'revealers_modal_btns_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'agrikon' ) ]
        );
        $this->agrikon_style_border( 'revealers_modal_btns_hvrborder','{{WRAPPER}} .agrikon--modal-open:hover, {{WRAPPER}} .btn--modal-close:hover');
        $this->agrikon_style_background( 'revealers_modal_btns_hvrbackground','{{WRAPPER}} .agrikon--modal-open:hover, {{WRAPPER}} .btn--modal-close:hover',array('classic','gradient') );
        $this->agrikon_style_padding( 'revealers_modal_btns_hvrpadding','{{WRAPPER}} .agrikon--modal-open:hover, {{WRAPPER}} .btn--modal-close:hover');
        $this->agrikon_style_margin( 'revealers_modal_btns_hvrmargin','{{WRAPPER}} .agrikon--modal-open:hover, {{WRAPPER}} .btn--modal-close:hover');
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        
    }
    /*****   END CONTROLS FUNCTION   ******/
    
    
    
    /*****   START CONTROLS FUNCTION   ******/
    public function split_type_controls() {

        $this->start_controls_section( 'revealers_split_type_controls',
            [
                'label'=> esc_html__( 'Split Image', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [ 'content_type' => 'split' ],
            ]
        );
        $this->add_control( 'split_image',
            [
                'label' => esc_html__( 'Image', 'agrikon' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [ 'url' => AGRIKON_PLUGIN_URL . 'assets/front/img/team-member-1.jpg' ],
                'condition' => [ 'split_type' => 'left' ]
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail2',
                'default' => 'full',
                'condition' => [ 'split_type' => 'left' ]
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'split_bg_image',
                'label' => esc_html__( 'Split Background Image', 'agrikon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .dual__half',
                'condition' => [ 'split_type' => 'right' ]
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'revealers_split_content_controls_section',
            [
                'label'=> esc_html__( 'Split Content', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [ 'content_type' => 'split' ],
            ]
        );
        $this->add_control( 'split_content',
            [
                'label' => esc_html__('Split Content', 'agrikon'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => 'Study hard what interests you the most in the most undisciplined, irreverent and original manner possible.<span class="author">― Richard Feynman</span>',
                'dynamic' => ['active' => true],
            ]
        );
        
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'revealers_split_style_section',
            [
                'label'=> esc_html__( 'Split Box Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [ 'content_type' => 'split' ],
            ]
        );

        $this->agrikon_style_background( 'revealers_split_box_background','{{WRAPPER}} .agrikon-reveals',array('classic', 'gradient') );
        $this->agrikon_style_border( 'revealers_split_box_border','{{WRAPPER}} .agrikon-reveals');
        $this->agrikon_style_padding( 'revealers_split_box_padding','{{WRAPPER}} .agrikon-reveals');
        $this->agrikon_style_margin( 'revealers_split_box_margin','{{WRAPPER}} .agrikon-reveals');

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        
        
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'revealers_split_text_style_section',
            [
                'label'=> esc_html__( 'Split Text Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [ 'content_type' => 'split' ],
            ]
        );
        $this->agrikon_style_typo( 'revealers_split_text_typo','{{WRAPPER}} .dual__content, {{WRAPPER}} .media__toolbar');
        $this->agrikon_style_color( 'revealers_split_text_color','{{WRAPPER}} .dual__content, {{WRAPPER}} .media__toolbar');
        $this->agrikon_style_text_alignment( 'revealers_split_text_alignment','{{WRAPPER}} .dual__content, {{WRAPPER}} .media__toolbar');

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'revealers_split_image_style_section',
            [
                'label'=> esc_html__( 'Split Image Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [ 'content_type' => 'split' ],
            ]
        );
        $this->agrikon_style_border( 'revealers_split_image_border','{{WRAPPER}} .dual__half, {{WRAPPER}} .media__inner');
        $this->agrikon_style_padding( 'revealers_split_image_padding','{{WRAPPER}} .dual__half, {{WRAPPER}} .media__inner');
        $this->agrikon_style_margin( 'revealers_split_image_margin','{{WRAPPER}} .dual__half, {{WRAPPER}} .media__inner');

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        
    }
    
    

    protected function render() {
        $settings   = $this->get_settings_for_display();
        $id         = $this->get_id();
        
        $image      = $this->get_settings( 'image' );
        $image_url  = Group_Control_Image_Size::get_attachment_image_src( $image['id'], 'thumbnail', $settings );
        $imageurl   = empty( $image_url ) ? $image['url'] : $image_url;
        $imagealt   = esc_attr(get_post_meta($image['id'], '_wp_attachment_image_alt', true));
        $imagealt   = $imagealt ? $imagealt : basename ( get_attached_file( $image['id'] ) );
        
        $image2      = $this->get_settings( 'split_image' );
        $image_url2  = Group_Control_Image_Size::get_attachment_image_src( $image2['id'], 'thumbnail2', $settings );
        $imageurl2   = empty( $image_url2 ) ? $image2['url'] : $image_url2;
        $imagealt2   = esc_attr(get_post_meta($image2['id'], '_wp_attachment_image_alt', true));
        $imagealt2   = $imagealt2 ? $imagealt2 : basename ( get_attached_file( $image2['id'] ) );
        
        $image3      = $this->get_settings( 'modal_open_image' );
        $image_url3  = Group_Control_Image_Size::get_attachment_image_src( $image3['id'], 'thumbnail3', $settings );
        $imageurl3   = empty( $image_url3 ) ? $image3['url'] : $image_url3;
        $imagealt3   = esc_attr(get_post_meta($image3['id'], '_wp_attachment_image_alt', true));
        $imagealt3   = $imagealt3 ? $imagealt3 : basename ( get_attached_file( $image3['id'] ) );

    	
    	$type        = $settings['content_type'];
    	$cover_color = $settings['cover_color'];
    	$direction   = $settings['direction'] ? $settings['direction'] : 'lr';
    	$m_direction = $settings['direction_in'];
    	$directionin = 'modal' == $type ? $m_direction : $direction;
    	$directionout= $settings['direction_out'];
    	$delay       = $settings['delay'] && 0 != $settings['delay'] ? ',"delay":'.$settings['delay'].'' : '';
    	$duration    = $settings['duration'] && 0 != $settings['duration'] ? ',"duration":'.$settings['duration'].'' : '';
    	$split_type  = 'split' == $type && $settings['split_type'] ? ',"splittype":"'.$settings['split_type'].'"' : '';
    	$cover       = 'split' == $type && $settings['cover_width'] ? ',"cover":'.$settings['cover_width']['size'] .'' : '';
    	$scrollbar   = $settings['scrollbar_type'];

        $admin = Plugin::$instance->editor->is_edit_mode() ? ' admin' : '';
        $splittype  = 'split' == $type && $settings['split_type'] ? ' split-'.$settings['split_type'] : '';
		echo '<div class="agrikon-reveals reveals-'.$type.$admin.$splittype.'" data-reveals-settings=\'{"type":"'.$type.'","bgcolor":"'.$cover_color.'","directionin":"'.$directionin.'","directionout":"'.$directionout.'","scrollbar":"'.$scrollbar.'"'.$delay.$duration.$split_type.$cover.'}\'>';
		
    		if ( 'content' == $type ) {
        		
        		if ( 'image' == $settings['content'] ) {
        		    
        			echo '<div id="rev-'.$id.'" class="agrikon-reveal-item content_image-wrap">';
        				echo '<img class="content_image" src="'.$imageurl.'" alt="'.$imagealt.'">';
        			echo '</div>';
        			
        		}
        		
        		if ( 'text' == $settings['content'] ) {
        		    
        			echo '<h2 class="content_title agrikon-reveal-item" id="rev-'.$id.'">';
        				echo '<div class="content__title__inner">'.$settings['title'].'</div>';
        			echo '</h2>';
        			
        		}
    		}
    		
            if ( 'modal' == $type ) {
                
                if ( 'image' == $settings['modal_open_type'] ) {
                    
                    echo '<img class="content_image agrikon--modal-open" src="'.$imageurl3.'" alt="'.$imagealt3.'">';
                    
                }
                
                if ( 'icon' == $settings['modal_open_type'] && $settings['modal_open_icon']['value'] ) {
                    echo '<div class="agrikon--modal-open modal--open-icon btn--modal-'.$id.'">'; 
                        Icons_Manager::render_icon( $settings['modal_open_icon'], [ 'aria-hidden' => 'true' ] );
                    echo '</div>';
                    
                }
                
                if ( 'button' == $settings['modal_open_type'] && $settings['open_btn_title'] ) {
                    
                    echo '<div class="btn btn--default agrikon--modal-open btn--modal-'.$id.'">'.$settings['open_btn_title'].'</div>';
                    
                }

                
    			echo '<div class="revealers-modal" id="modal-'.$id.'">';
    			    
    				echo '<div class="modal__inner modal-inner-type-'.$settings['modal_content_type'].'">';
    				
                        if ('template' == $settings['modal_content_type']) {
                            
                            if (!empty($settings['primary_templates'])) {
                                
                                $template_id = $settings['primary_templates'];
                                $agrikon_frontend = new Frontend;
                                $css = Plugin::$instance->editor->is_edit_mode() ? true : false;
                                echo $agrikon_frontend->get_builder_content_for_display( $template_id, true );
                                
                            }
                            
                        } else {
                            
                            echo do_shortcode($settings['custom_modal_content']);
                            
                        }
                        
                        $close = $settings['close_btn_title'] ? $settings['close_btn_title'] : 'X';
                        
                        if ( 'yes' != $settings['hide_content_close_btn'] ) {
                            
        					echo '<button class="btn btn--default btn--modal-close">'.$close.'</button>';
        					
                        }
                        
    				echo '</div>';
    				
    			echo '</div>';
    			
    			echo '<div class="overlay"><div class="btn--modal-close-top"><i class="fa fa-times" aria-hidden="true"></i></div></div>';

            }
    		
            if ( 'split' == $type ) {
                
    			if ( 'left' == $settings['split_type'] ) {
    			    
    				echo '<div class="media" id="media-'.$id.'">';
    				
    					echo '<div id="dual-'.$id.'" class="media__inner"><img class="media__image" src="'.$imageurl2.'" alt="'.$imagealt2.'"></div>';
    					
    					echo '<div class="media__toolbar">';
        					echo '<div class="media__toolbar_content">';
        					
        						echo do_shortcode($settings['split_content']);
        						
        					echo '</div>';
    					echo '</div>';
    				echo '</div>';
    				
    			} else {
    			    
        			echo '<div class="dual-content-wrapper">';
        				echo '<div class="dual dual-'.$id.'">';
        					echo '<div class="dual__inner" id="dual-'.$id.'">';
        						echo '<div class="dual__half"></div>';
        					echo '</div>';
        					echo '<div class="dual__content"  id="content-'.$id.'">';
        					
        						echo do_shortcode($settings['split_content']);
        						
        					echo '</div>';
        				echo '</div>';
        			echo '</div>';
    			
    			}
				
            }
            
		echo '</div>';

    }
}