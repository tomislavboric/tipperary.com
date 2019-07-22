<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
            
  <header class="article-header"> 
    <h1 class="entry-title single-title" itemprop="headline"><?php the_title(); ?></h1>
    <?php// get_template_part( 'parts/content', 'byline' ); ?>
    </header>
          
    <section class="entry-content" itemprop="articleBody">
      <?php
      if ( has_post_thumbnail() ) :
      $post_id = get_the_ID();
      $thumbnail = get_the_post_thumbnail_url ( $post_id, 'blog-size');
    endif;
    ?>
    <figure>
      <img src="<?php echo $thumbnail; ?>" alt="">
    </figure>
    <?php //the_post_thumbnail('blog-size'); ?>
    <?php the_content(); ?>
  </section>
            
  <footer class="article-footer">
    <?php wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'jointswp' ), 'after'  => '</div>' ) ); ?>
    <p class="tags"><?php the_tags('<span class="tags-title">' . __( 'Tags:', 'jointswp' ) . '</span> ', ', ', ''); ?></p>  
  </footer>
            
  <?php comments_template(); ?> 
                          
</article>