<?php
    global $post;

    $post_vars = auxpfo_get_portfolio_config( $post, array( 'request_from' => 'single' ) );
    extract( $post_vars );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $post_class ); ?> role="article" >

        <?php
        $entry_main = '<div class="entry-main">';
        if( $has_attach ) {
            $entry_main .= '<div class="entry-media ' . $media_parent_class  . '">' . $the_media . '</div>';
        }
        if ( $the_content = auxin_get_the_content() ) {
            $entry_main .= '<div class="entry-content clearfix">' . $the_content . '</div>';
        }
        $entry_main .= '</div>';

        // print media on top if side position is right, left, bottom
        if( 'top' !== $side_pos ){
            echo $entry_main;
        }
        ?>
        <!-- end of entry main -->

        <?php if( $show_side ) { ?>
        <!-- start - Portfolio info -->

        <?php if( $sticky_sidebar ) {
            // 45 is the space between site header and the side area
            $sticky_header_height = ( auxin_get_option('site_header_top_sticky') ? auxin_get_option('site_header_container_scaled_height') : 0 ) + 45;
        ?>
        <div class="entry-side aux-sticky-position" data-use-transform="true" data-sticky-margin="<?php echo $sticky_header_height; ?>" data-boundaries="true">
        <?php } else { ?>
        <div class="entry-side">
        <?php } ?>
            <div class="entry-overview-container">
                <?php
                // get overview context
                $_overview = auxin_get_post_meta( $post->ID, '_overview', '' );

                if( $_overview || $show_actions ) {
                    if( $_overview ){
                        echo '<div class="entry-side-overview">' . do_shortcode( $_overview ) . '</div>';
                    }
                    if( $show_actions ) { ?>
                    <div class="entry-actions">
                    <?php
                    if( function_exists( 'wp_ulike' ) && $show_like_btn ){
                        echo aunin_wp_ulike_plugin_btn( array( 'theme_class' => 'wpulike-heart' ) );
                    }
                    if( $show_share_btn ) { ?>
                         <div class="aux-single-portfolio-share">
                             <div class="aux-tooltip-socials aux-tooltip-dark aux-socials aux-icon-left aux-medium">
                                 <span class="aux-icon auxicon-share"></span>
                                 <span class="aux-text"><?php _e( 'Share', 'auxin-portfolio' ); ?></span>
                             </div>
                         </div>
                    <?php
                    }
                    ?>
                    </div>
                <?php }
                } ?>
            </div>

                <?php

                if( $display_cat ) {
                    // get portfolio categories
                    $tax_name = 'portfolio-cat';
                    $cat_terms = wp_get_post_terms( $post->ID, $tax_name );
                    if( empty( $cat_terms ) ) {
                        $display_cat = false;
                    }
                }

                if( $display_tag ) {
                    // get portfolio tags
                    $tax_name_tag = 'portfolio-tag';
                    $tag_terms = wp_get_post_terms( $post->ID, $tax_name_tag );
                    if( empty( $tag_terms ) ) {
                        $display_tag = false;
                    }
                }

                $lunch_btn_url = auxin_get_post_meta( $post->ID, '_lunch_button_url', '' );
                if( !empty( $lunch_btn_url ) ) {
                    $display_lunch = true;
                } else { $display_lunch = false; }

                // print the portfolio metadata
                $metafields = json_decode( auxin_get_option( 'portfolio_metadata_list_1' ), true );

                if (is_array( $metafields ) && !array_filter($metafields) ) {
                        $display_metafields = true;
                } else { $display_metafields = false; }

                if( $display_metafields || $display_cat || $display_tag || $display_lunch ){ // start of displaying condition
                    echo '<div class="entry-meta-data-container">';
                    echo '<div class="entry-meta-data"><dl>';
                    if( $display_cat ){
                        if ( count($cat_terms) == 1 ) {
                            echo "<dt>Category</dt>";
                        } else { echo "<dt>Categories</dt>"; }

                        echo '<dd><span class="entry-tax">';
                        foreach( $cat_terms as $term ){
                             echo '<a href="'. get_term_link( $term->slug, $tax_name ) .'" title="'.__("View all posts in ", 'auxin-portfolio'). $term->name .'" rel="category" >'. $term->name .'</a>';
                        }
                        echo '</span></dd>';
                    }

                    if( $display_tag ) {
                        if ( count($tag_terms) == 1 ) {
                            echo "<dt>Tag</dt>";
                        } else { echo "<dt>Tags</dt>"; }

                        echo '<dd><span class="entry-tax">';
                        foreach( $tag_terms as $term ){
                             echo '<a href="'. get_term_link( $term->slug, $tax_name_tag ) .'" title="'.__("View all posts in ", 'auxin-portfolio'). $term->name .'" rel="category" >'. $term->name .'</a>';
                        }
                        echo '</span></dd>';
                    }

                    foreach ( $metafields as $metadata_info ) {
                        if( ! empty( $metadata_info['id'] ) && $meta_value = auxin_get_post_meta( $post->ID, '_auxin_meta_' . $metadata_info['id'] ) ){
                            echo "<dt>{$metadata_info['value']}</dt>";
                            echo "<dd>{$meta_value}</dd>";
                        }
                    }

                    echo '</dl></div>';


                if( $display_lunch ) {
                ?>
                <a href="<?php echo $lunch_btn_url; ?>" class="aux-button aux-cta-button aux-black aux-medium aux-curve">
                    <span class="aux-overlay"></span>
                    <span class="aux-text"><?php echo auxin_get_option( 'portfolio_metadata_launch_label' ); ?></span>
                </a>
                <?php }
                } // End of displaying condition
                ?>
            </div>
        </div>
        <!-- end - Portfolio info -->
        <?php }

        // print media on bottom if side position is top
        if( 'top' == $side_pos ){
            echo $entry_main;
        }

        // clear the floated elements at the end of content
        echo '<div class="clear"></div>';

        // create pagination for page content
        wp_link_pages( array( 'before' => '<div class="page-links"><span>' . __( 'Pages:', THEME_DOMAIN) .'</span>', 'after' => '</div>' ) );

        ?>

</article> <!-- end article -->

