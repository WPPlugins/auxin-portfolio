<?php
/**
 *
 * 
 * @package    Auxin
 * @license    LICENSE.txt
 * @author     
 * @link       http://averta.net/phlox/
 * @copyright  (c) 2010-2017 
 */


/**
 * Get template part.
 *
 * @param mixed $slug
 * @param string $name (default: '')
 */
function auxpfo_get_template_part( $slug, $name = '' ) {
    auxin_get_template_part( $slug, $name, AUXPFO()->template_path() );
}


/**
 * Whether a plugin is active or not
 *
 * @param  string $plugin_basename  plugin directory name and mail file address
 * @return bool                     True if plugin is active and FALSE otherwise
 */
if( ! function_exists( 'auxin_is_plugin_active' ) ){
    function auxin_is_plugin_active( $plugin_basename ){
        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        return is_plugin_active( $plugin_basename );
    }
}


/**
 * Generates and returns markup for like button base on features of wp_unlike plugin
 *
 * @param  array   $args            The list of setting for this element
 * @return string                   The markup for like button
 */
if( ! function_exists( 'aunin_wp_ulike_plugin_btn' ) ){

    function aunin_wp_ulike_plugin_btn( $args ){

        if( ! function_exists('wp_ulike') ){
            return;
        }

        global $post,$wp_ulike_class,$wp_user_IP;

        $get_like  = get_post_meta( $post->ID, '_liked', true );

        $defaults = array(
            'post_id'     => $post->ID,
            'get_like'    => empty( $get_like ) ? 0 : $get_like,
            'user_id'     => $wp_ulike_class->get_reutrn_id(),
            'theme_class' => wp_ulike_get_setting('wp_ulike_posts', 'theme')
        );

        $parsed_args = wp_parse_args( $args, $defaults );
        extract( $parsed_args );


        $only_registered_users = wp_ulike_get_setting( 'wp_ulike_posts', 'only_registered_users');

        if( 1 != $only_registered_users || ( 1 == $only_registered_users && is_user_logged_in() ) ){

            $data = array(
                "id"        => $post_id,                //Post ID
                "user_id"   => $user_id,          //User ID (if the user is guest, we save ip as user_id with "ip2long" function)
                "user_ip"   => $wp_user_IP,             //User IP
                "get_like"  => $get_like,               //Number Of Likes
                "method"    => 'likeThis',              //JavaScript method
                "setting"   => 'wp_ulike_posts',        //Setting Key
                "type"      => 'post',                  //Function type (post/process)
                "table"     => 'ulike',                 //posts table
                "column"    => 'post_id',               //ulike table column name
                "key"       => '_liked',                //meta key
                "cookie"    => 'liked-'                 //Cookie Name
            );

            // call wp_get_ulike function from class-ulike calss
            $counter        = $wp_ulike_class->wp_get_ulike( $data );

            $wp_ulike       = '<div id="wp-ulike-'.$post_id.'" class="wpulike '.$theme_class.'">';
            $wp_ulike       .= '<div class="counter">'.$counter.'</div>';
            $wp_ulike       .= '</div>';
            $wp_ulike       .= $wp_ulike_class->get_liked_users( $post_id,'ulike','post_id','wp_ulike_posts' );

            return $wp_ulike;
        }

    }

}




if ( ! function_exists('auxpfo_get_portfolio_config') ) {

    function auxpfo_get_portfolio_config( $post, $settings ) {
        global $aux_content_width;

        $defaults = array(
            'request_from'       => 'archive',
            'content_width'      => '',
            'upscale_image'      => true,
            'preloadable_image'  => false,
            'media_size'         => '', // large, medium, thumbnail
            'aspect_ratio'       => 1,
            'add_image_hw'       => true, // whether to add with and height attrs to image
            'image_sizes'        => array(),
            'srcset_sizes'       => array(),
            'crop'               => true
        );

        $settings = wp_parse_args( $settings, $defaults );
        extract( $settings );

        if ( empty( $media_width ) ) {
            $media_width = $aux_content_width;
        }

        $args = array(
            'show_share_btn'    => true,
            'show_like_btn'     => true,
            'show_actions'      => true,
            'show_side'         => true,
            'show_title'        => true,
            'the_media'         => '',
            'the_attach'        => '',
            'has_attach'        => false,
            'post_class'        => '',
            'media_parent_class'=> '',
            'media_class'       => '',
            'sticky_sidebar'    => false,
            'display_cat'       => true
        );

        if( empty( $post ) ){
            return $args;
        }


        // get the post media layout
        if( 'default' == $media_layout = auxin_get_post_meta( $post->ID, '_media_layout', 'default' ) ){
            $media_layout = auxin_get_option( 'portfolio_single_media_layout' );
        }

        // get side position
        if( 'default' == $side_pos = auxin_get_post_meta( $post->ID, '_side_info_pos', 'default' ) ){
            // $side_pos = is_rtl() ? 'left' : 'right';
            $side_pos = auxin_get_option( 'portfolio_single_side_pos', 'right' );
        }

        // get display_cat
        if( 'default' == $display_cat = auxin_get_post_meta( $post->ID, '_side_info_dicplay_cat', 'default' ) ){
            $display_cat = auxin_get_option( 'portfolio_single_display_category', true );
        }
        $args['display_cat'] = ( $display_cat == "yes" || $display_cat === true )? true: false;

         // get display_tag
        if( 'default' == $display_tag = auxin_get_post_meta( $post->ID, '_side_info_dicplay_tag', 'default' ) ){
            $display_tag = auxin_get_option( 'portfolio_single_display_tag', true );
        }
        $args['display_tag'] = ($display_tag == "yes" || $display_tag === true )? true: false;

        if ( 'bottom' != $side_pos ) {
            if( 'default' == $sticky_sidebar = auxin_get_post_meta( $post->ID, '_sticky_sidebar', 'default' ) ){
                $sticky_sidebar = auxin_get_option( 'portfolio_single_stcky_sidebar', false );
            }
            // sticky sidebar
            $args['sticky_sidebar'] = ($sticky_sidebar == "yes" || $display_tag === true )? true: false;
        }

        // specify the side position
        $args['post_class']  .= 'aux-side-' . $side_pos;
        $args['side_pos']     = $side_pos;

        switch ( $media_layout ) {
            case 'classic':
                $args['media_parent_class'] = 'aux-stack';
                $args['media_class']        = 'aux-media-frame aux-media-image';
                break;

            case 'grid':
                $args['post_class']        .= ' portfolio-grid';
                $args['media_parent_class'] = 'aux-portolio-grid gallery-columns-2';
                $args['media_class']        = 'aux-portolio-grid-column';
                break;

            case 'masonry':
            case 'land':
            case 'tile':
            default:

                break;
        }

        if( ! empty( $media_size ) ){
            if( is_array( $media_size ) ){
                $media_size['width']  = ! empty( $media_size['width' ] ) ? $media_size['width' ] : '';
                $media_size['height'] = ! empty( $media_size['height'] ) ? $media_size['height'] : '';

                $size = array( 'width' => $media_size['width'], 'height' => $media_size['height'] );
            } else {
                $size = auxin_wp_get_image_size( $media_size );
                $size = array( 'width' => $size['width'], 'height' => $size['height'] );
            }
        } else {
            $size = array( 'width' => $media_width, 'height' => $media_width * $aspect_ratio );
        }


        if ( 'archive' == $request_from ) {
            $args['has_attach'] = has_post_thumbnail( $post->ID );

            if ( $args['has_attach'] ) {
                $args['the_attach'] = auxin_get_the_post_responsive_thumbnail(
                    $post->ID,
                    array(
                        'size'         => $size,
                        'crop'         => $crop,
                        'preloadable'  => $preloadable_image,
                        'add_hw'       => $add_image_hw,
                        'image_sizes'  => $image_sizes,
                        'srcset_sizes' => $srcset_sizes,
                        'upscale'      => $upscale_image
                    )
                );
            }

            $args['the_media'] = '<div class="aux-media-frame aux-media-image">'.
                            '<a href="'.get_permalink( $post->ID ).'">'.
                                $args['the_attach'].
                            '</a>'.
                         '</div>';
        } else {
            $args['has_attach'] = ! auxin_get_post_meta( $post->ID, '_no_feature_image_in_single', 0 );

            if( $args['has_attach'] ){
                $args['the_media']  = get_the_post_thumbnail( $post->ID, 'large' );
                $args['has_attach'] = ! empty( $args['the_media'] );
            }
        }

        // Don't display post title if title bar is enable to prevent duplicated title in single page
        if( 'archive' !== $request_from && auxin_get_post_meta( $post->ID, 'aux_title_bar_show', 0 ) ) {
           $args['show_title'] = false;
        }

        // action buttons
        $args['show_share_btn'] = ( auxin_get_option( 'show_portfolio_single_share', true ) );
        $args['show_like_btn' ] = ( auxin_get_option( 'show_portfolio_single_like', true ) );
        $args['show_actions'  ] = ( auxin_get_option( 'show_portfolio_single_share_like_section', true ) );
        if( !$args['show_share_btn']  && !$args['show_like_btn'] ) {
            $args['show_actions'  ] = false;
        }

        return $args;
    }

}
