<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>

<?php get_template_part( 'template-parts/page-header' ); ?>

<div class="main-container">
	<div class="main-grid">
		<main class="main-content">
        <div class="location-listings__sorting-container grid-x grid-padding-x align-spaced">
          <div class="cell auto">
            <?php
              echo do_shortcode('[facetwp counts="true"]');
            ?>
          </div>
          <div class="cell large-4">
            <?php
              echo do_shortcode('[facetwp facet="categories_blog"]');
            ?>
          </div>
        </div>
        <?php
          echo facetwp_display( 'template', 'blog_listing' );
          echo do_shortcode('[facetwp pager="true"]');
        ?>

		</main>
		<?php //get_sidebar(); ?>

	</div>
</div>
<?php get_footer();
