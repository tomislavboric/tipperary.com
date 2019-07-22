<?php if( have_rows('logos') ): ?>
  <section class="partners">
    <div class="grid-container">

      <div class="grid-x grid-padding-x grid-padding-y align-center align-middle small-up-2 mobile-up-3 large-up-5">

        <?php while( have_rows('logos') ): the_row(); 

            // vars
          $logo = get_sub_field('logo');
          $link = get_sub_field('link');

          ?>

          <div class="partners__logo cell">

            <?php if( $link ): ?>
              <a class="partners__link" href="<?php echo $link; ?>">
            <?php endif; ?>

              <figure class="partners__figure">
                <img class="partners__image" src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt'] ?>" />
              </figure>
            <?php if( $link ): ?>
              </a>
            <?php endif; ?>

            <?php echo $content; ?>

          </div>

        <?php endwhile; ?>
      </div>

    </div>
  </section>
<?php endif; ?>
