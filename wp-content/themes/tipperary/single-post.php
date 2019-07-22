<?php get_header(); ?>

<?php get_template_part( 'template-parts/page-header' ); ?>

<main class="post-single">
  <?php
    echo '<div class="language-switcher">';
      dynamic_sidebar('sidebar-widgets');
    echo '</div>';
  ?>
<div class="post-single__wrapper">
  <div class="post-single__meta">
    <div class="post-single__meta-author">
    <?php
      $author_id = $post->post_author;
      ?>
      <figure>
      <?php echo get_avatar( get_the_author_email(), '30' ); ?>
      </figure>
      <span><?php the_author_meta( 'user_nicename' , $author_id ); ?> </span>
    </div>
    <div class="post-single__meta-date">
      <i class="material-icons">date_range</i>
      <span><?php echo get_the_date( 'F d, Y', $post->ID ); ?></span>
    </div>
  </div>
  <div class="post-single__content">
  <?php the_content(); ?>
    <?php echo do_shortcode('[social]'); ?>
  </div>
</div>

</main>
<?php get_footer(); ?>
