<?php
    /**
     * The template for displaying archive pages
     *
     * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
     *
     * @package underscore
     */
    get_header();
?>

<?php      
    echo "<h2>" . category_description(get_category_by_slug('evenement')) . "</h2>"; 
?>
		
<section class="grid-container">
    <?php
        while ( have_posts() ) :
            the_post();

            $jour = (int)get_the_date('j');
            $mois = (int)get_the_date('m');
            $mois = $mois % 3 + 1;

            $gridArea = $jour . '/' . $mois . '/' . ($jour+1) . '/' . ($mois+1);

            echo '<h2  style="grid-area:'. $gridArea . '">' . get_the_title() . $gridArea . get_the_date(' j / m / Y') . '</h2>';
        endwhile;
    ?>
</section>
<?php