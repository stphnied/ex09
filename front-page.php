<?php
    /**
     * The template for displaying all pages
     *
     * This is the template that displays all pages by default.
     * Please note that this is the WordPress construct of pages
     * and that other 'pages' on your WordPress site may use a
     * different template.
     *
     * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
     *
     * @package underscores
     */

    get_header();
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

            <?php
                while ( have_posts() ) :
                    the_post();

                    get_template_part( 'template-parts/content', 'page' );
                    // echo get_the_title();

                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;

                endwhile; // End of the loop
            ?>
            <section>
            <?php
                // !!!!!!!!!! NOUVELLES
                echo '<h2>' . category_description( get_category_by_slug( 'nouvelle' ) ) . '</h2>';
                // $args = array(
                //     "category_name" => "conference",
                //     "posts_per_page" => "4"
                //     // "orderby" => "date",
                //     // "order" => "DESC"
                // );
                
                // The Query
                $args1 = array(
                    'category_name' => 'conference'
                );
                $query1 = new WP_Query($args1);
                extraire_conferences($query1);
                
                // The Loop
                while ($query1->have_posts()) {
                    $query1->the_post();
                    echo '<div class="conference">';
                    the_post_thumbnail('thumbnail');
                    echo '<span><h2>' . get_the_title() . " - " . get_the_date() . '</h2>';
                    echo '<p>' . substr(get_the_excerpt(), 0, 200) . '</p></span></div>';
                }
                
                wp_reset_postdata();
            ?>
            </section>
            <section>
            <?php
                // !!!!!!!!!! CONFÉRENCES
                echo '<h2>' . category_description( get_category_by_slug ( 'conference' ) ) . '</h2>';
                /* The 2nd Query (without global var) */
                $args2 = array(
                    'category_name' => 'nouvelle'
                );
                $query2 = new WP_Query( $args2 );
                extraire_nouvelles($query2);
                
                echo '<div class="evenement">';
                // The 2nd Loop
                while ( $query2->have_posts() ) {
                    $query2->the_post();
                    echo '<div><li>' . get_the_title( $query2->post->ID ) . '</li>';
                    the_post_thumbnail('thumbnail');
                    echo '</div>';
                }
                echo '</div>';

                wp_reset_postdata();
                get_template_part('category-evenement.php');
            ?>
            </section>

		</main><!-- #main -->
	</span><!-- #primary -->

<?php
get_sidebar();
get_footer();