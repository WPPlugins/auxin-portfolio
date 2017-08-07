<?php
/**
 * General WordPress Hooks
 *
 * 
 * @package    Auxin
 * @license    LICENSE.txt
 * @author     
 * @link       http://averta.net/phlox/
 * @copyright  (c) 2010-2017 
 */



/**
 * Outputs theme options for portfolio
 *
 * 
 * @package    Auxin
 * @license    LICENSE.txt
 * @author     
 * @link       http://averta.net/phlox/
 * @copyright  (c) 2010-2017 
 */
function auxin_define_portfolio_theme_options( $fields_sections_list ){

    $options  = $fields_sections_list['fields'  ];
    $sections = $fields_sections_list['sections'];

    /* ---------------------------------------------------------------------------------------------------
        Portfolio Section
    --------------------------------------------------------------------------------------------------- */

    // Portfolio section ==================================================================

    $sections[] = array(
        'id'          => 'portfolio-section',
        'parent'      => '', // section parent's id
        'title'       => __( 'Portfolio', 'auxin-portfolio'),
        'description' => __( 'Portfolio Setting', 'auxin-portfolio'),
        'icon'        => 'axicon-doc'
    );

    // Sub section - Portfolio Single Page -------------------------------

    $sections[] = array(
        'id'          => 'portfolio-section-single',
        'parent'      => 'portfolio-section', // section parent's id
        'title'       => __( 'Single Portfolio', 'auxin-portfolio'),
        'description' => __( 'Single Portfolio Setting', 'auxin-portfolio')
    );


    $options[] = array(
        'title'       => __('Single Portfolio Style', 'auxin-portfolio'),
        'description' => __('Specifies position of sidebar on single portfolio.', 'auxin-portfolio'),
        'id'          => 'portfolio_single_side_pos',
        'section'     => 'portfolio-section-single',
        'dependency'  => array(),
        'choices'     => array(
            'right'   => array(
                'label'     => __('Right', 'auxin-portfolio'),
                'image'     => AUX_URL . 'images/visual-select/portfolio-single-classic.svg'
            ),
            'left'    => array(
                'label'     => __('Left', 'auxin-portfolio'),
                'image'     => AUX_URL . 'images/visual-select/portfolio-single-classic-left-algin.svg'
            ),
            'bottom'  => array(
                'label'     => __('Bottom', 'auxin-portfolio'),
                'image'     => AUX_URL . 'images/visual-select/portfolio-single-wide.svg'
            )
        ),
        'default'     => 'right',
        'type'        => 'radio-image',
        'post_js'     => '$(".single-portfolio main.aux-single .aux-primary .type-portfolio").alterClass( "aux-side-*", "aux-side-" + to );',
    );

    $options[] =    array(
        'title'       => __('Sticky Side Area', 'auxin-portfolio'),
        'description' => __( 'Enable it to stick the side area on page while scrolling..'),
        'id'          => 'portfolio_single_stcky_sidebar',
        'section'     => 'portfolio-section-single',
        'dependency'  => array(
            array(
                 'id'      => 'portfolio_single_side_pos',
                 'value'   => array('right', 'left'),
                 'operator'=> ''
            )
        ),
        'transport'   => 'refresh',
        'default'     => '0',
        'type'        => 'switch'
    );

    $options[] = array(
        'title'       => __('Single portfolio Sidebar Position', 'auxin-portfolio'),
        'description' => __('Specifies position of sidebar on single portfolio.', 'auxin-portfolio'),
        'id'          => 'portfolio_single_sidebar_position',
        'section'     => 'portfolio-section-single',
        'dependency'  => array(),
        'post_js'     => '$(".single-portfolio main.aux-single").alterClass( "*-sidebar", to );',
        'choices'     => array(
            'no-sidebar'            => array(
                'label'             => __('No Sidebar', 'auxin-portfolio'),
                'css_class'         => 'axiAdminIcon-sidebar-none'
            ),
            'right-sidebar'         => array(
                'label'             => __('Right Sidebar', 'auxin-portfolio'),
                'css_class'         => 'axiAdminIcon-sidebar-right'
            ),
            'left-sidebar'          => array(
                'label'             => __('Left Sidebar' , 'auxin-portfolio'),
                'css_class'         => 'axiAdminIcon-sidebar-left'
            ),
            'left2-sidebar'         => array(
                'label'             => __('Left Left Sidebar' , 'auxin-portfolio'),
                'css_class'         => 'axiAdminIcon-sidebar-left-left'
            ),
            'right2-sidebar'        => array(
                'label'             => __('Right Right Sidebar' , 'auxin-portfolio'),
                'css_class'         => 'axiAdminIcon-sidebar-right-right'
            ),
            'left-right-sidebar'    => array(
                'label'             => __('Left Right Sidebar' , 'auxin-portfolio'),
                'css_class'         => 'axiAdminIcon-sidebar-left-right'
            ),
            'right-left-sidebar'    => array(
                'label'             => __('Right Left Sidebar' , 'auxin-portfolio'),
                'css_class'         => 'axiAdminIcon-sidebar-left-right'
            )
        ),
        'default'   => 'right-sidebar',
        'type'      => 'radio-image'
    );

    $options[] =    array(
        'title'       => __('Single portfolio Sidebar Style', 'auxin-portfolio'),
        'description' => 'Specifies style of sidebar on single portfolio.',
        'id'          => 'portfolio_single_sidebar_decoration',
        'section'     => 'portfolio-section-single',
        'dependency'  => array(
            array(
                 'id'      => 'portfolio_single_sidebar_position',
                 'value'   => 'no-sidebar',
                 'operator'=> '!='
            )
        ),
        'transport'   => 'postMessage',
        'post_js'     => '$(".single-portfolio main.aux-single").alterClass( "aux-sidebar-style-*", "aux-sidebar-style-" + to );',
        'choices'     => array(
            'simple'        => array(
                'label'     => __( 'Simple' , 'auxin-portfolio'),
                'image'     => AUX_URL . 'images/visual-select/sidebar-style-1.svg'
            ),
            'border'        => array(
                'label'     => __( 'Bordered Sidebar' , 'auxin-portfolio'),
                'image'     => AUX_URL . 'images/visual-select/sidebar-style-2.svg'
            ),
            'overlap'       => array(
                'label'     => __( 'Overlap Background' , 'auxin-portfolio'),
                'image'     => AUX_URL . 'images/visual-select/sidebar-style-3.svg'
            )
        ),
        'type'       => 'radio-image',
        'default'    => 'border'
    );

    // @TODO: we should add this in future
    // $options[] = array(
    //     'title'       => __('Content Style', 'auxin-portfolio'),
    //     'description' => __('You can reduce the width of text lines and increase the readability of context in single portfolio of portfolio (does not affect the width of media).', 'auxin-portfolio'),
    //     'id'          => 'portfolio_single_content_style',
    //     'section'     => 'portfolio-section-single',
    //     'dependency'  => array(),
    //     'choices'     => array(
    //         'simple'  => array(
    //             'label'  => __( 'Default' , 'auxin-portfolio'),
    //             'image' => AUX_URL . 'images/visual-select/content-normal.svg'
    //         ),
    //         'narrow' => array(
    //             'label'  => __( 'Narrow Content' , 'auxin-portfolio'),
    //             'image' => AUX_URL . 'images/visual-select/content-less.svg'
    //         )
    //     ),
    //     'transport' => 'postMessage',
    //     'post_js'   => '$(".single-portfolio .aux-primary .hentry").toggleClass( "aux-narrow-context", "narrow" == to );',
    //     'default'   => 'simple',
    //     'type'      => 'radio-image'
    // );

    $options[] = array(
        'title'       => __( 'Display Next & Previous portfolios', 'auxin-portfolio' ),
        'description' => __( 'Enable it to display links to next and previous portfolios on single portfolio page.' ),
        'id'          => 'show_portfolio_single_next_prev_nav',
        'section'     => 'portfolio-section-single',
        'dependency'  => '',
        'transport'   => 'refresh',
        // 'post_js'     => '$(".single .aux-next-prev-posts").toggle( to );',
        'default'     => '1',
        'type'        => 'switch'
    );

    $options[] =    array(
        'title'       => __('Skin for Next & Previous Links', 'auxin-portfolio'),
        'description' => __('Specifies the skin for next and previous navigation block.', 'auxin-portfolio'),
        'id'          => 'portfolio_single_next_prev_nav_skin',
        'section'     => 'portfolio-section-single',
        'dependency'  => array(
            array(
                 'id'      => 'show_portfolio_single_next_prev_nav',
                 'value'   => array('1'),
                 'operator'=> ''
            )
        ),
        'transport'   => 'refresh',
        'choices'     => array(
            'minimal'       => array(
                'label'     => __('Minimal (default)', 'auxin-portfolio'),
                'image'     => AUX_URL . 'images/visual-select/post-navigation-1.svg'
            ),
            'thumb-arrow'   => array(
                'label'     => __('Thumbnail with Arrow', 'auxin-portfolio'),
                'image'     => AUX_URL . 'images/visual-select/post-navigation-2.svg'
            ),
            'thumb-no-arrow'        => array(
                'label'             => __('Thumbnail without Arrow', 'auxin-portfolio'),
                'image'             => AUX_URL . 'images/visual-select/post-navigation-3.svg'
            ),
            'boxed-image'           => array(
                'label'             => __('Navigation with Light Background', 'auxin-portfolio'),
                'image'             => AUX_URL . 'images/visual-select/post-navigation-4.svg'
            ),
            'boxed-image-dark'      => array(
                'label'             => __('Navigation with Dark Background', 'auxin-portfolio'),
                'image'             => AUX_URL . 'images/visual-select/post-navigation-5.svg'
            ),
            'thumb-arrow-sticky'    => array(
                'label'             => __('Sticky Thumbnail with Arrow', 'auxin-portfolio'),
                'image'             => AUX_URL . 'images/visual-select/post-navigation-6.svg'
            )
        ),
        'type'       => 'radio-image',
        'default'    => 'minimal'
    );

    $options[] =    array(
        'title'       => __('Display Single Portfolio Categories', 'auxin-portfolio'),
        'description' => __( 'Enable it to display category section in single portfolio.'),
        'id'          => 'portfolio_single_display_category',
        'section'     => 'portfolio-section-single',
        'dependency'  => '',
        'transport'   => 'refresh',
        'default'     => '0',
        'type'        => 'switch'
    );

    $options[] =    array(
        'title'       => __('Display Single Portfolio Tags', 'auxin-portfolio'),
        'description' => __( 'Enable it to display Tag section in single portfolio.'),
        'id'          => 'portfolio_single_display_tag',
        'section'     => 'portfolio-section-single',
        'dependency'  => '',
        'transport'   => 'refresh',
        'default'     => '0',
        'type'        => 'switch'
    );


    // Sub section - related portfolios section -------------------------------

    $sections[] = array(
        'id'          => 'portfolio-section-single-related',
        'parent'      => 'portfolio-section', // section parent's id
        'title'       => __( 'Related Portfolios', 'auxin-portfolio'),
        'description' => __( 'Setting for Related Portfolios Section in Single Page', 'auxin-portfolio')
    );


    $options[] = array(
        'title'       => __( 'Display Related Portfolios', 'auxin-portfolio' ),
        'description' => __( 'Enable it to display related portfolios section on single portfolio page.' ),
        'id'          => 'show_portfolio_related_posts',
        'section'     => 'portfolio-section-single-related',
        'dependency'  => '',
        'transport'   => 'postMessage',
        'post_js'     => '$(".single-portfolio .aux-widget-related-posts").toggle( to );',
        'default'     => '1',
        'type'        => 'switch'
    );

    $options[] = array(
        'title'       => __('Label of Related Section', 'auxin-portfolio'),
        'description' => __('Specifies the label of related items section.', 'auxin-portfolio'),
        'id'          => 'portfolio_related_posts_label',
        'section'     => 'portfolio-section-single-related',
        'dependency'  => array(
            array(
                 'id'      => 'show_portfolio_related_posts',
                 'value'   => array('1'),
                 'operator'=> ''
            )
        ),
        'transport'   => 'postMessage',
        'post_js'     => '$(".single-portfolio .aux-widget-related-posts > .widget-title").html( to );',
        'default'     => __( 'Related Projects/Works', 'auxin-portfolio' ),
        'type'        => 'text'
    );

    $options[] =    array(
        'title'       => __('Related Items Type', 'auxin-portfolio'),
        'description' => __('Specifies the appearance type for related portfolio element.', 'auxin-portfolio'),
        'id'          => 'portfolio_related_posts_preview_mode',
        'section'     => 'portfolio-section-single-related',
        'dependency'  => array(
            array(
                 'id'      => 'show_portfolio_related_posts',
                 'value'   => array('1'),
                 'operator'=> ''
            )
        ),
        'transport'   => 'refresh',
        'choices'     => array(
            'grid'      => 'Grid',
            'carousel'  => 'Carousel'
        ),
        'type'        => 'select',
        'default'     => 'grid'
    );

    $options[] =    array(
        'title'       => __('Number of Columns', 'auxin-portfolio'),
        'description' => '',
        'id'          => 'portfolio_related_posts_column_number',
        'section'     => 'portfolio-section-single-related',
        'dependency'  => array(
            array(
                 'id'      => 'show_portfolio_related_posts',
                 'value'   => array('1'),
                 'operator'=> ''
            )
        ),
        'transport'   => 'refresh',
        'type'        => 'select',
        'choices'     => array(
                    '1'  => '1', '2' => '2', '3' => '3',
        ),
        'default'     => '3'
    );

    $options[] =    array(
        'title'       => __('Align Center', 'auxin-portfolio'),
        'description' => __( 'Enable it to make related portfolios section text center.'),
        'id'          => 'portfolio_related_posts_align_center',
        'section'     => 'portfolio-section-single-related',
        'dependency'  => array(
            array(
                 'id'      => 'show_portfolio_related_posts',
                 'value'   => array('1'),
                 'operator'=> ''
            )
        ),
        'transport'   => 'postMessage',
        'post_js'     => '$(".single-portfolio .aux-widget-related-posts").toggleClass( "aux-text-align-center", to );',
        'default'     => '0',
        'type'        => 'switch'
    );

    $options[] =    array(
        'title'       => __('Full Width Related Section', 'auxin-portfolio'),
        'description' => __( 'Enable it to make related portfolios section full width.' ),
        'id'          => 'portfolio_related_posts_full_width',
        'section'     => 'portfolio-section-single-related',
        'dependency'  => array(
            array(
                 'id'      => 'show_portfolio_related_posts',
                 'value'   => array('1'),
                 'operator'=> ''
            )
        ),
        'transport'   => 'postMessage',
        'post_js'     => '$(".single-portfolio .aux-widget-related-posts").closest(".container").toggleClass( "aux-fold", ! to );',
        'default'     => '0',
        'type'        => 'switch'
    );

    $options[] =    array(
        'title'       => __('Snap Related Items', 'auxin-portfolio'),
        'description' => __( 'Enable it to remove space between related portfolio items.' ),
        'id'          => 'portfolio_related_posts_snap_items',
        'section'     => 'portfolio-section-single-related',
        'dependency'  => array(
            array(
                 'id'      => 'show_portfolio_related_posts',
                 'value'   => array('1'),
                 'operator'=> ''
            )
        ),
        'transport'   => 'refresh',
        // 'post_js'     => '$(".single-portfolio .aux-widget-related-posts > .aux-row").toggleClass( "aux-no-gutter", to );',
        'default'     => '0',
        'type'        => 'switch'
    );

    $options[] =    array(
        'title'       => __('Display Portfolio Categories', 'auxin-portfolio'),
        'description' => __( 'Enable it to display the categories of each portfolio item in related portfolios section.'),
        'id'          => 'portfolio_related_posts_display_taxonomies',
        'section'     => 'portfolio-section-single-related',
        'dependency'  => array(
            array(
                 'id'      => 'show_portfolio_related_posts',
                 'value'   => array('1'),
                 'operator'=> ''
            )
        ),
        'transport'   => 'refresh',
        // 'post_js'     => '$(".single-portfolio .aux-widget-related-posts .entry-tax").toggle( to );',
        'default'     => '0',
        'type'        => 'switch'
    );


    /*$options[] = array( 'title'     => __('View All button link', 'auxin-portfolio'),
                        'description'   => __('Specifies a link for "view all" button to portfolio listing page (the button that comes at the end of latest from portfolio element ) ', 'auxin-portfolio'),
                        'id'        => 'portfolio_view_all_btn_link',
                        'section'   => 'portfolio-section-single',
                        'dependency'=> array(),
                        'default'   => home_url(),
                        'type'      => 'text' );*/



    // Sub section - portfolio Archive Page -------------------------------

    $sections[] = array(
        'id'          => 'portfolio-section-archive',
        'parent'      => 'portfolio-section', // section parent's id
        'title'       => __( 'Portfolio Page', 'auxin-portfolio'),
        'description' => __( 'Setting for portfolio Archive Page', 'auxin-portfolio')
    );


    $options[] = array(
        'title'       => __('Portfolio Template', 'auxin-portfolio'),
        'description' => __('Choose your portfolio template.', 'auxin-portfolio'),
        'id'          => 'portfolio_index_template_type',
        'section'     => 'portfolio-section-archive',
        'dependency'  => array(),
        'transport'   => 'refresh',
        'choices'     => array(
             // default template
            'grid-1'        => array(
                'label'     => __('Grid' , 'auxin-portfolio'),
                'image'     => AUX_URL . 'images/visual-select/portfolio-grid.svg'
            ),
            'masonry-1'     => array(
                'label'     => __('Masonry' , 'auxin-portfolio'),
                'image'     => AUX_URL . 'images/visual-select/portfolio-masonry.svg'
            ),
            'tiles-1'       => array(
                'label'     => __('Tiles' , 'auxin-portfolio'),
                'image'     => AUX_URL . 'images/visual-select/blog-layout-11.svg'
            ),
            'land-1'        => array(
                'label'     => __('Land', 'auxin-portfolio'),
                'image'     => AUX_URL . 'images/visual-select/blog-layout-10.svg'
            )
        ),
        'type'         => 'radio-image',
        'default'      => 'grid-1'
    );

     $options[] = array(
        'title'       => __('Image Aspect Ratio', 'auxin-portfolio'),
        'description' => '',
        'id'          => 'portfolio_image_aspect_ratio',
        'section'     => 'portfolio-section-archive',
        'dependency'  => array(
            array(
                'id'      => 'portfolio_index_template_type',
                'value'   => array('grid-1'),
                'operator'=> '=='
            )
        ),
        'type'        => 'select',
        'choices'     => array(
            '0.75'          => __('Horizontal 4:3' , 'auxin-portfolio'),
            '0.56'          => __('Horizontal 16:9', 'auxin-portfolio'),
            '1.00'          => __('Square 1:1'     , 'auxin-portfolio'),
            '1.33'          => __('Vertical 3:4'   , 'auxin-portfolio')
        ),
        'transport'   => 'refresh',
        'default'     => '0.56',
    );

    $options[] = array(
        'title'       => __('Portfolio Hover Type', 'auxin-portfolio'),
        'description' => __('Specifies the portfolio item type.', 'auxin-portfolio'),
        'id'          => 'portfolio_archive_grid_item_type',
        'section'     => 'portfolio-section-archive',
        'dependency'  => array(
                array(
                    'id'      => 'portfolio_index_template_type',
                    'value'   => array('grid-1', 'masonry-1'),
                    'operator'=> '=='
                )
        ),
        'type'        => 'select',
        'choices'     => array(
            'classic'                => __('Classic', 'auxin-portfolio' ),
            'classic-lightbox'       => __('Classic with lightbox style 1', 'auxin-portfolio' ),
            'classic-lightbox-boxed' => __('Classic with lightbox style 2', 'auxin-portfolio' ),
            'overlay'                => __('Overlay title style 1', 'auxin-portfolio' ),
            'overlay-boxed'          => __('Overlay title style 2', 'auxin-portfolio' ),
            'overlay-lightbox'       => __('Overlay title with lightbox style 1', 'auxin-portfolio' ),
            'overlay-lightbox-boxed' => __('Overlay title with lightbox style 2', 'auxin-portfolio' ),
        ),
        'transport'   => 'refresh',
        'default'     => 'classic',
    );

    $options[] = array(
        'title'       => __('Tile Portfolio Item Type', 'auxin-portfolio'),
        'description' => __('Specifies the portfolio item type.', 'auxin-portfolio'),
        'id'          => 'portfolio_archive_tile_item_type',
        'section'     => 'portfolio-section-archive',
        'dependency'  => array(
            array(
               'id'      => 'portfolio_index_template_type',
               'value'   => array('tiles-1'),
               'operator'=> '=='
            )
        ),
        'type'        => 'select',
        'choices'                    => array(
            'overlay'                => __('Overlay title style 1', 'auxin-portfolio' ),
            'overlay-boxed'          =>  __('Overlay title style 2', 'auxin-portfolio' ),
            'overlay-lightbox'       =>  __('Overlay title with lightbox style 1', 'auxin-portfolio' ),
            'overlay-lightbox-boxed' =>  __('Overlay title with lightbox style 2', 'auxin-portfolio' ),
        ),
        'transport'   => 'refresh',
        'default'     => 'overlay',
    );

    $options[] = array(
        'title'       => __('Space', 'auxin-portfolio'),
        'description' => __('Specifies space between items in pixels.', 'auxin-portfolio'),
        'id'          => 'portfolio_archive_grid_space',
        'section'     => 'portfolio-section-archive',
        'dependency'  => array(
                array(
                    'id'      => 'portfolio_index_template_type',
                    'value'   => array('grid-1', 'masonry-1'),
                    'operator'=> '=='
                )
        ),
        'transport'   => 'refresh',
        'default'     => '30',
        'type'        => 'text'
    );



    $options[] = array(
        'title'       => __('Number of Columns', 'auxin-portfolio'),
        'description' => '',
        'id'          => 'portfolio_archive_column_number',
        'section'     => 'portfolio-section-archive',
        'dependency'  => array(
            array(
                'id'      => 'portfolio_index_template_type',
                'value'   => array('grid-1', 'masonry-1'),
                'operator'=> '=='
            )
        ),
        'type'        => 'select',
        'choices'     => array(
                    '1'  => '1', '2' => '2', '3' => '3',
                    '4'  => '4', '5' => '5', '6' => '6'
                ),
        'transport'   => 'refresh',
        'default'     => '4',
    );

    $options[] = array(
        'title'       => __('Number of Columns in Tablet', 'auxin-portfolio'),
        'description' => '',
        'id'          => 'portfolio_archive_column_number_tablet',
        'section'     => 'portfolio-section-archive',
        'dependency'  => array(
            array(
                'id'      => 'portfolio_index_template_type',
                'value'   => array('grid-1', 'masonry-1'),
                'operator'=> '=='
            )
        ),
        'type'        => 'select',
        'choices'     => array(
            'inherit' => 'Inherited from larger',
            '1'  => '1', '2' => '2', '3' => '3',
            '4'  => '4', '5' => '5', '6' => '6'
        ),
        'transport'   => 'refresh',
        'default'     => 'inherit',
    );

    $options[] = array(
        'title'       => __('Number of Columns in Mobile', 'auxin-portfolio'),
        'description' => '',
        'id'          => 'portfolio_archive_column_number_mobile',
        'section'     => 'portfolio-section-archive',
        'dependency'  => array(
            array(
                'id'      => 'portfolio_index_template_type',
                'value'   => array('grid-1', 'masonry-1'),
                'operator'=> '=='
            )
        ),
        'type'        => 'select',
        'choices'     => array(
                    '1' => '1' , '2' => '2', '3' => '3'
                ),
        'transport'   => 'refresh',
        'default'     => '1',
    );

if ( auxin_is_plugin_active( 'wp-ulike/wp-ulike.php')){
        $options[] = array(
            'title'       => __('Display Like Button', 'auxin-portfolio'),
            'description' => sprintf(__('Enable it to display %s like button%s on portfolio portfolios. Please note WP Ulike plugin needs to be activaited to use this option.', 'auxin-portfolio'), '<strong>', '</strong>'),
            'id'          => 'show_portfolio_archive_like_button',
            'section'     => 'portfolio-section-archive',
            'dependency'  => array(
                array(
                    'id'      => 'portfolio_index_template_type',
                    'value'   => array('tiles-1'),
                    'operator'=> '!='
            )
        ),
            'transport'   => 'refresh',
            'default'     => '1',
            'type'        => 'switch'
        );
    }

    $options[] = array(
        'title'       => __('Portfolio Sidebar Position', 'auxin-portfolio'),
        'description' => __('Specifies the position of sidebar on portfolio page.', 'auxin-portfolio'),
        'id'          => 'portfolio_index_sidebar_position',
        'section'     => 'portfolio-section-archive',
        'dependency'  => array(),
        'choices'     => array(
            'no-sidebar'            => array(
                'label'             => __('No Sidebar', 'auxin-portfolio'),
                'css_class'         => 'axiAdminIcon-sidebar-none'
            ),
            'right-sidebar'         => array(
                'label'             => __('Right Sidebar', 'auxin-portfolio'),
                'css_class'         => 'axiAdminIcon-sidebar-right'
            ),
            'left-sidebar'          => array(
                'label'             => __('Left Sidebar' , 'auxin-portfolio'),
                'css_class'         => 'axiAdminIcon-sidebar-left'
            ),
            'left2-sidebar'         => array(
                'label'             => __('Left Left Sidebar' , 'auxin-portfolio'),
                'css_class'         => 'axiAdminIcon-sidebar-left-left'
            ),
            'right2-sidebar'        => array(
                'label'             => __('Right Right Sidebar' , 'auxin-portfolio'),
                'css_class'         => 'axiAdminIcon-sidebar-right-right'
            ),
            'left-right-sidebar'    => array(
                'label'             => __('Left Right Sidebar' , 'auxin-portfolio'),
                'css_class'         => 'axiAdminIcon-sidebar-left-right'
            ),
            'right-left-sidebar'    => array(
                'label'             => __('Right Left Sidebar' , 'auxin-portfolio'),
                'css_class'         => 'axiAdminIcon-sidebar-left-right'
            )
        ),
        'dependency'  => array(),
        'post_js'     => '$(".blog .aux-archive, main.aux-home").alterClass( "*-sidebar", to );',
        'type'        => 'radio-image',
        'transport'   => 'refresh',
        'default'     => 'no-siderbar'
    );

    $options[] = array(
        'title'       => __('Portfolio Sidebar Style', 'auxin-portfolio'),
        'description' => __('Specifies the style of sidebar on portfolio page.', 'auxin-portfolio'),
        'id'          => 'portfolio_index_sidebar_decoration',
        'section'     => 'portfolio-section-archive',
        'dependency'  => array(
            array(
                 'id'      => 'portfolio_index_sidebar_position',
                 'value'   => 'no-sidebar',
                 'operator'=> '!='
            )
        ),
        'transport'   => 'postMessage',
        'post_js'     => '$(".aux-archive").alterClass( "aux-sidebar-style-*", "aux-sidebar-style-" + to );',
        'choices'     => array(
            'simple'        => array(
                'label'     => __('Simple' , 'auxin-portfolio'),
                'image'     => AUX_URL . 'images/visual-select/sidebar-style-1.svg'
            ),
            'border'        => array(
                'label'     => __('Bordered Sidebar' , 'auxin-portfolio'),
                'image'     => AUX_URL . 'images/visual-select/sidebar-style-2.svg'
            ),
            'overlap'       => array(
                'label'     => __('Overlap Background' , 'auxin-portfolio'),
                'image'     => AUX_URL . 'images/visual-select/sidebar-style-3.svg'
            )
        ),
        'type'       => 'radio-image',
        'default'    => 'border'
    );

     $options[] = array(
        'title'       => __('Number of Portfolios Per Page', 'auxin-portfolio'),
        'description' => __('Specifies the number of portfolios items to show on each page.', 'auxin-portfolio'),
        'id'          => 'portfolio_archive_items_perpage',
        'section'     => 'portfolio-section-archive',
        'dependency'  => array(),
        'transport'   => 'refresh',
        'default'     => '12',
        'type'        => 'text'
    );


    // Sub section - Portfolio Taxonomy Page -------------------------------

    $sections[] = array(
        'id'          => 'portfolio-section-taxonomy',
        'parent'      => 'portfolio-section', // section parent's id
        'title'       => __( 'Portfolio Category & tag', 'auxin-portfolio'),
        'description' => __( 'Portfolio Category & tag page Setting', 'auxin-portfolio')
    );

    $options[] = array(
        'title'       => __('Taxonomy Page Template', 'auxin-portfolio'),
        'description' => 'Choose your category & tag page template.',
        'id'          => 'portfolio_taxonomy_template_type',
        'section'     => 'portfolio-section-taxonomy',
        'dependency'  => array(),
        'transport'   => 'refresh',
       'choices'     => array(
             // default template
            'grid-1'             => array(
                'label'     => __('Grid' , 'auxin-portfolio'),
                'image'     => AUX_URL . 'images/visual-select/portfolio-grid.svg'
            ),
            'masonry-1'             => array(
                'label'     => __('Masonry' , 'auxin-portfolio'),
                'image'     => AUX_URL . 'images/visual-select/portfolio-masonry.svg'
            ),
            'tiles-1'             => array(
                'label'     => __('Tiles' , 'auxin-portfolio'),
                'image'     => AUX_URL . 'images/visual-select/blog-layout-11.svg'
            ),
            'land-1'       => array(
                'label'     => __('Land', 'auxin-portfolio'),
                'image'     => AUX_URL . 'images/visual-select/blog-layout-10.svg'
            )
        ),
        'type'          => 'radio-image',
        'default'       => 'grid-1'
    );

    $options[] = array(
        'title'       => __('Image Aspect Ratio', 'auxin-portfolio'),
        'description' => '',
        'id'          => 'portfolio_taxonomy_image_aspect_ratio',
        'section'     => 'portfolio-section-taxonomy',
        'dependency'  => array(
            array(
                'id'      => 'portfolio_taxonomy_template_type',
                'value'   => array('grid-1'),
                'operator'=> '=='
            )
        ),
        'type'        => 'select',
        'choices'     => array(
            '0.75'          => __('Horizontal 4:3' , 'auxin-portfolio'),
            '0.56'          => __('Horizontal 16:9', 'auxin-portfolio'),
            '1.00'          => __('Square 1:1'     , 'auxin-portfolio'),
            '1.33'          => __('Vertical 3:4'   , 'auxin-portfolio')
        ),
        'transport'   => 'refresh',
        'default'     => '0.56',
    );

     $options[] = array(
        'title'       => __('Portfolio Hover Type', 'auxin-portfolio'),
        'description' => __('Specifies the portfolio item type.', 'auxin-portfolio'),
        'id'          => 'portfolio_taxonomy_grid_item_type',
        'section'     => 'portfolio-section-taxonomy',
        'dependency'  => array(
                array(
                    'id'      => 'portfolio_taxonomy_template_type',
                    'value'   => array('grid-1', 'masonry-1'),
                    'operator'=> '=='
                )
        ),
        'type'        => 'select',
        'choices'     => array(
            'classic'                => __('Classic', 'auxin-portfolio' ),
            'classic-lightbox'       => __('Classic with lightbox style 1', 'auxin-portfolio' ),
            'classic-lightbox-boxed' => __('Classic with lightbox style 2', 'auxin-portfolio' ),
            'overlay'                => __('Overlay title style 1', 'auxin-portfolio' ),
            'overlay-boxed'          => __('Overlay title style 2', 'auxin-portfolio' ),
            'overlay-lightbox'       => __('Overlay title with lightbox style 1', 'auxin-portfolio' ),
            'overlay-lightbox-boxed' => __('Overlay title with lightbox style 2', 'auxin-portfolio' ),
        ),
        'transport'   => 'refresh',
        'default'     => 'classic',
    );

     $options[] = array(
        'title'       => __('Tile Portfolio Item Type', 'auxin-portfolio'),
        'description' => __('Specifies the portfolio item type.', 'auxin-portfolio'),
        'id'          => 'portfolio_taxonomy_tile_item_type',
        'section'     => 'portfolio-section-taxonomy',
        'dependency'  => array(
            array(
               'id'      => 'portfolio_taxonomy_template_type',
               'value'   => array('tiles-1'),
               'operator'=> '=='
            )
        ),
        'type'        => 'select',
        'choices'                    => array(
            'overlay'                => __('Overlay title style 1', 'auxin-portfolio' ),
            'overlay-boxed'          =>  __('Overlay title style 2', 'auxin-portfolio' ),
            'overlay-lightbox'       =>  __('Overlay title with lightbox style 1', 'auxin-portfolio' ),
            'overlay-lightbox-boxed' =>  __('Overlay title with lightbox style 2', 'auxin-portfolio' ),
        ),
        'transport'   => 'refresh',
        'default'     => 'overlay',
    );

    $options[] = array(
        'title'       => __('Space', 'auxin-portfolio'),
        'description' => __('Specifies space between items in pixels.', 'auxin-portfolio'),
        'id'          => 'portfolio_taxonomy_grid_space',
        'section'     => 'portfolio-section-taxonomy',
        'dependency'  => array(
                array(
                    'id'      => 'portfolio_taxonomy_template_type',
                    'value'   => array('grid-1', 'masonry-1'),
                    'operator'=> '=='
                )
        ),
        'transport'   => 'refresh',
        'default'     => '30',
        'type'        => 'text'
    );

     $options[] = array(
        'title'       => __('Number of Columns', 'auxin-portfolio'),
        'description' => '',
        'id'          => 'portfolio_taxonomy_column_number',
        'section'     => 'portfolio-section-taxonomy',
        'dependency'  => array(
            array(
                'id'      => 'portfolio_taxonomy_template_type',
                'value'   => array('grid-1', 'masonry-1'),
                'operator'=> '=='
            )
        ),
        'type'        => 'select',
        'choices'     => array(
                    '1'  => '1', '2' => '2', '3' => '3',
                    '4'  => '4', '5' => '5', '6' => '6'
                ),
        'transport'   => 'refresh',
        'default'     => '4',
    );

      $options[] = array(
        'title'       => __('Number of Columns in Tablet', 'auxin-portfolio'),
        'description' => '',
        'id'          => 'portfolio_taxonomy_column_number_tablet',
        'section'     => 'portfolio-section-taxonomy',
        'dependency'  => array(
            array(
                'id'      => 'portfolio_taxonomy_template_type',
                'value'   => array('grid-1', 'masonry-1'),
                'operator'=> '=='
            )
        ),
        'type'        => 'select',
        'choices'     => array(
            'inherit' => 'Inherited from larger',
            '1'  => '1', '2' => '2', '3' => '3',
            '4'  => '4', '5' => '5', '6' => '6'
        ),
        'transport'   => 'refresh',
        'default'     => 'inherit',
    );

    $options[] = array(
        'title'       => __('Number of Columns in Mobile', 'auxin-portfolio'),
        'description' => '',
        'id'          => 'portfolio_taxonomy_column_number_mobile',
        'section'     => 'portfolio-section-taxonomy',
        'dependency'  => array(
            array(
                'id'      => 'portfolio_taxonomy_template_type',
                'value'   => array('grid-1', 'masonry-1'),
                'operator'=> '=='
            )
        ),
        'type'        => 'select',
        'choices'     => array(
                    '1' => '1' , '2' => '2', '3' => '3'
                ),
        'transport'   => 'refresh',
        'default'     => '1',
    );

    if ( auxin_is_plugin_active( 'wp-ulike/wp-ulike.php')){
        $options[] = array(
            'title'       => __('Display Like Button', 'auxin-portfolio'),
            'description' => sprintf(__('Enable it to display %s like button%s on portfolio portfolios. Please note WP Ulike plugin needs to be activaited to use this option.', 'auxin-portfolio'), '<strong>', '</strong>'),
            'id'          => 'show_portfolio_taxonomy_like_button',
            'section'     => 'portfolio-section-taxonomy',
            'dependency'  => array(
                array(
                    'id'      => 'portfolio_taxonomy_template_type',
                    'value'   => array('tiles-1'),
                    'operator'=> '!='
                ),
                // @TODO: relation on this dependency is not working
                // array(
                //     'id'      => 'portfolio_taxonomy_grid_item_type',
                //     'value'   => array('classic', 'classic-lightbox', 'classic-lightbox-boxed'),
                //     'operator'=> '=='
                // ),
                // 'relation'=> 'and'

        ),
            'transport'   => 'refresh',
            'default'     => '1',
            'type'        => 'switch'
        );
    }

    $options[] = array(
        'title'       => __('Taxonomy Page Sidebar Position', 'auxin-portfolio'),
        'description' => 'Specifies the position of sidebar on category & tag page.',
        'id'          => 'portfolio_taxonomy_sidebar_position',
        'section'     => 'portfolio-section-taxonomy',
        'dependency'  => array(),
        'post_js'     => '$(".archive.tag main, .archive.tax-portfolio-cat main").alterClass( "*-sidebar", to );',
        'choices'     => array(
            'no-sidebar' => array(
                'label'  => __('No Sidebar', 'auxin-portfolio'),
                'css_class' => 'axiAdminIcon-sidebar-none'
            ),
            'right-sidebar' => array(
                'label'  => __('Right Sidebar', 'auxin-portfolio'),
                'css_class' => 'axiAdminIcon-sidebar-right'
            ),
            'left-sidebar' => array(
                'label'  => __('Left Sidebar' , 'auxin-portfolio'),
                'css_class' => 'axiAdminIcon-sidebar-left'
            ),
            'left2-sidebar' => array(
                'label'  => __('Left Left Sidebar' , 'auxin-portfolio'),
                'css_class' => 'axiAdminIcon-sidebar-left-left'
            ),
            'right2-sidebar' => array(
                'label'  => __('Right Right Sidebar' , 'auxin-portfolio'),
                'css_class' => 'axiAdminIcon-sidebar-right-right'
            ),
            'left-right-sidebar' => array(
                'label'  => __('Left Right Sidebar' , 'auxin-portfolio'),
                'css_class' => 'axiAdminIcon-sidebar-left-right'
            ),
            'right-left-sidebar' => array(
                'label'  => __('Right Left Sidebar' , 'auxin-portfolio'),
                'css_class' => 'axiAdminIcon-sidebar-left-right'
            )
        ),
        'type'          => 'radio-image',
        'default'       => 'right-siderbar'
    );

    $options[] = array(
        'title'       => __('Sidebar Style', 'auxin-portfolio'),
        'description' => __('Specifies the style of sidebar on category & tag page.', 'auxin-portfolio'),
        'id'          => 'portfolio_taxonomy_archive_sidebar_decoration',
        'section'     => 'portfolio-section-taxonomy',
        'dependency'  => array(
            array(
                 'id'      => 'portfolio_taxonomy_sidebar_position',
                 'value'   => 'no-sidebar',
                 'operator'=> '!='
            )
        ),
        'post_js'    => '$(".archive.tag main, .archive.tax-portfolio-cat main").alterClass( "aux-sidebar-style-*", "aux-sidebar-style-" + to );',
        'choices'    => array(
            'simple' => array(
                'label'  => __('Simple' , 'auxin-portfolio'),
                'image' => AUX_URL . 'images/visual-select/sidebar-style-1.svg'
            ),
            'border' => array(
                'label'  => __('Bordered Sidebar' , 'auxin-portfolio'),
                'image' => AUX_URL . 'images/visual-select/sidebar-style-2.svg'
            ),
            'overlap' => array(
                'label'  => __('Overlap Background' , 'auxin-portfolio'),
                'image' => AUX_URL . 'images/visual-select/sidebar-style-3.svg'
            )
        ),
        'type'          => 'radio-image',
        'default'       => 'border'
    );

    $options[] = array(
        'title'       => __('Taxonomy content length', 'auxin-portfolio'),
        'description' => sprintf(__('Whether to display%1$ssummary%2$sor%1$sfull%2$scontent for each portfolio on category & tag page.', 'auxin-portfolio'), '<code>', '</code>'),
        'id'          => 'portfolio_taxonomy_archive_content_on_listing',
        'section'     => 'portfolio-section-taxonomy',
        'dependency'  => array(),
        'transport'   => 'refresh',
        'choices'     => array(
            'full'    => array(
                'label' =>__('Full text', 'auxin-portfolio'),
                'css_class' => 'axiAdminIcon-blog-content-length-2'
            ),
            'excerpt'    => array(
                'label' => __('Summary'  , 'auxin-portfolio'),
                'css_class' => 'axiAdminIcon-blog-content-length-1'
            )
        ),
        'default'     => 'full',
        'type'        => 'radio-image'
    );

    //  @TODO: Right now we don't use this options but we should do
    $options[] = array(
        'title'       => __('Summery length', 'auxin-portfolio'),
        'description' => __('Specifies summary character length on category & tag page.', 'auxin-portfolio'),
        'id'          => 'portfolio_taxonomy_archive_on_listing_length',
        'section'     => 'portfolio-section-taxonomy',
        'dependency'  => array(
            array(
                 'id'      => 'post_taxonomy_archive_content_on_listing',
                 'value'   => array('excerpt'),
                 'operator'=> ''
            )
        ),
        'transport' => 'refresh',
        'default'   => '255',
        'type'      => 'text'
    );

    // -------------------------------------------------------------------------

    $sections[] = array(
        'id'          => 'portfolio-section-metadata',
        'parent'      => 'portfolio-section', // section parent's id
        'title'       => __( 'Portfolio MetaData', 'auxin-portfolio'),
        'description' => __( 'Portfolio MetaData Setting', 'auxin-portfolio')
    );

    $options[] = array(
        'title'       => __('Label for Launch Project Button', 'auxin-portfolio'),
        'description' => __('Specify a label for launch project button.', 'auxin-portfolio'),
        'id'          => 'portfolio_metadata_launch_label',
        'section'     => 'portfolio-section-metadata',
        'dependency'  => array(),
        'transport'   => 'postMessage',
        'post_js'     => '$(".single-portfolio .entry-meta-data-container .aux-cta-button").html( to );',
        'default'     => __( 'Launch Project', 'auxin-portfolio' )
    );

    $options[] = array(
        'title'       => __('Portfolio MetaDatas', 'auxin-portfolio'),
        'description' => __('Specify the number of fields and the label of each one for portfolio metadatas', 'auxin-portfolio'),
        'id'          => 'portfolio_metadata_list_1',
        'section'     => 'portfolio-section-metadata',
        'dependency'  => array(),
        'transport'   => 'post_js',
        'choices'     => array(
            'url'               => __( 'Project URL', 'auxin-portfolio' ),
            'client'            => __( 'Client', 'auxin-portfolio' ),
            'release_date'      => __( 'Release Date', 'auxin-portfolio' ),
            'author'            => __( 'Author', 'auxin-portfolio' ),
            'aux_custom_meta1'  => __( 'Custom Field 1', 'auxin-portfolio' ),
            'aux_custom_meta2'  => __( 'Custom Field 2', 'auxin-portfolio' ),
            'aux_custom_meta3'  => __( 'Custom Field 3', 'auxin-portfolio' ),
            'aux_custom_meta4'  => __( 'Custom Field 4', 'auxin-portfolio' ),
            'aux_custom_meta5'  => __( 'Custom Field 5', 'auxin-portfolio' ),
            'aux_custom_meta6'  => __( 'Custom Field 6', 'auxin-portfolio' ),
            'aux_custom_meta7'  => __( 'Custom Field 7', 'auxin-portfolio' ),
            'aux_custom_meta8'  => __( 'Custom Field 8', 'auxin-portfolio' ),
            'aux_custom_meta9'  => __( 'Custom Field 9', 'auxin-portfolio' ),
            'aux_custom_meta10' => __( 'Custom Field 10', 'auxin-portfolio' ),
            'aux_custom_meta11' => __( 'Custom Field 11', 'auxin-portfolio' ),
            'aux_custom_meta12' => __( 'Custom Field 12', 'auxin-portfolio' )
        ),
        'type'          => 'sortable-input',
        'default'       => '[{"id":"url", "label":"Project URL", "value":"Project URL"},{"id":"client", "label":"Client", "value":"Client"},{"id":"release_date", "label":"Release Date", "value":"Release Date"}]'
    );

    return array( 'fields' => $options, 'sections' => $sections );
}

add_filter( 'auxin_defined_option_fields_sections', 'auxin_define_portfolio_theme_options', 13, 1 );



/**
 * Embed the
 *
 * @return [type] [description]
 */
function auxpfo_init_portfolio_post_type_and_metafields(){

    // abort if phlox theme is not enabled
    if( ! defined('AUXIN_VERSION') ){
        return;
    }

    $post_type      = 'portfolio';
    $all_post_types = auxin_get_possible_post_types(true);

    // check if the post type is allowed
    if( ! empty( $all_post_types[ $post_type ] ) && $all_post_types[ $post_type ] ){

        // Initiate the post type
        include AUXPFO_INC_DIR   . '/classes/class-auxpfo-post-type-portfolio.php';

        $portfolio_instance = new Auxpfo_Post_Type_Portfolio();
        $portfolio_instance->register();

        if( is_admin() ){
            $metabox_args['post_type']     = $post_type;
            $metabox_args['hub_id']        = 'axi_meta_hub_portfolio';
            $metabox_args['hub_title']     = __('Portfolio Options', 'auxin-portfolio' );
            $metabox_args['to_post_types'] = array( $post_type );

            auxin_maybe_render_metabox_hub_for_post_type( $metabox_args );
        }
    }

}
add_action( 'init', 'auxpfo_init_portfolio_post_type_and_metafields' );




/**
 * Adds a mian css class indicator to body tag
 *
 * @param  array $classes  List of body css classes
 * @return array           The modified list of body css classes
 */
/*
function auxpfo_body_class( $classes ) {
    return $classes;
}
add_filter( 'body_class', 'auxpfo_body_class' );
*/


/*-----------------------------------------------------------------------------------*/
/*  Add SiteOrigin class prefix and custom field classes path
/*-----------------------------------------------------------------------------------*/

// if ( auxin_is_plugin_active( 'so-widgets-bundle/so-widgets-bundle.php') ) {

// }
