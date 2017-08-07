<?php
/**
 * The Template for displaying all single portfolio
 *
 * 
 * @package    Auxin
 * @license    LICENSE.txt
 * @author     
 * @link       http://averta.net/phlox/
 * @copyright  (c) 2010-2017 
*/
$is_pass_protected = post_password_required();

get_header(); ?>
<?php //include 'slider.php'; ?>

    <main id="main" <?php auxin_content_main_class(); ?> >
        <div class="aux-wrapper">
            <div class="container aux-fold">

                <div id="primary" class="aux-primary" >
                    <div class="content" role="main"  >

                        <?php if ( have_posts() && ! $is_pass_protected ) : ?>

                            <?php auxpfo_get_template_part( 'theme-parts/single', get_post_type() ); ?>

                            <?php comments_template( '/comments.php', true ); ?>

                        <?php elseif( $is_pass_protected ) : ?>

                            <?php echo get_the_password_form(); ?>

                        <?php else : ?>

                            <?php auxpfo_get_template_part( 'theme-parts/content', 'none' ); ?>

                        <?php endif; ?>

                    </div><!-- end content -->

                    <?php
                        // get next/prev portfolio button
                        if( 'default' == $display_next_pre = auxin_get_post_meta( $post->ID, '_show_next_prev_nav', 'default' ) ){
                            $display_next_pre = auxin_get_option( 'show_portfolio_single_next_prev_nav', false );
                        }
                        $display_next_pre = auxin_is_true( $display_next_pre )? true: false;
                           
                        if( $display_next_pre ) {
                            if( 'default' == $next_prev_skin = auxin_get_post_meta( $post->ID, '_next_prev_nav_skin', 'default' ) ){
                                $next_prev_skin = auxin_get_option( 'portfolio_single_next_prev_nav_skin', false );
                            }
                            auxin_single_page_navigation( array(
                                'prev_text'      => __( 'Previous Portfolio', 'auxin-portfolio' ),
                                'next_text'      => __( 'Next Portfolio'    , 'auxin-portfolio' ),
                                'taxonomy'       => 'portfolio-cat',
                                'skin'           => $next_prev_skin // minimal, thumb-no-arrow, thumb-arrow, boxed-image
                            ));
                        }
                    ?>

                </div><!-- end primary -->


                <?php get_sidebar(); ?>


            </div><!-- end container -->

        <?php 
            // get display_related option
            if( 'default' == $display_related = auxin_get_post_meta( $post->ID, '_display_related', 'default' ) ) {
                $display_related = auxin_get_option( 'show_portfolio_related_posts', true );
            }
            $display_related = auxin_is_true( $display_related )? true: false;
            if( $display_related ) {

                // get title_label option
                if( 'default' == $related_title_label = auxin_get_post_meta( $post->ID, '_related_posts_label', 'default' ) ) {
                    $related_title_label = auxin_get_option( 'portfolio_related_posts_label', __( 'Related Projects', 'auxin-portfolio' ) );
                }

                // get desktop_cnum option
                if( 'default' == $desktop_cnum = auxin_get_post_meta( $post->ID, '_related_posts_column_number', 'default' ) ) {
                    $desktop_cnum = auxin_get_option( 'portfolio_related_posts_column_number', true );
                }

                // get preview_mode option
                if( 'default' == $preview_mode = auxin_get_post_meta( $post->ID, '_related_posts_preview_mode', 'default' ) ) {
                    $preview_mode = auxin_get_option( 'portfolio_related_posts_preview_mode', true );
                }

                // get alignment option
                if( 'default' == $extra_classes = auxin_get_post_meta( $post->ID, '_related_posts_align_center', 'default' ) ) {
                    $extra_classes = auxin_get_option( 'portfolio_related_posts_align_center', true );
                }
                $extra_classes = ( $extra_classes == "yes" || $extra_classes === true )? true: false;

                // get display_categories option
                if( 'default' == $display_categories = auxin_get_post_meta( $post->ID, '_related_posts_display_taxonomies', 'default' ) ) {
                    $display_categories = auxin_get_option( 'portfolio_related_posts_display_taxonomies', true );
                }
                $display_categories = auxin_is_true( $display_categories )? true: false;
               
              
                // set arguments
                $defaults = array(
                    'title'                       => $related_title_label,
                    'desktop_cnum'                => $desktop_cnum,
                    'preview_mode'                => $preview_mode,
                    'extra_classes'               => ( $extra_classes ) ? 'aux-text-align-center': '',
                    'display_categories'          => $display_categories
                );
                echo auxpfo_get_portfolio_related_posts( $defaults ); 
            }
        ?>
        </div><!-- end wrapper -->
    </main><!-- end main -->

<?php get_sidebar('footer'); ?>
<?php get_footer(); ?>
