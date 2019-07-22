<section class="box-list">
  <div class="grid-container">

    <?php if( have_rows('box_list') ): ?>

      <div class="grid-x grid-margin-x grid-margin-y small-up-2 medium-up-4">

        <?php while( have_rows('box_list') ): the_row(); 

          // vars
          $title = get_sub_field('title');
          $icon = get_sub_field('icon');
          $link = get_sub_field('link');

          ?>

          <div class="cell box-list__box">

            <?php if( $link ): ?>
              <a href="<?php echo $link; ?>">
            <?php endif; ?>  
              
              <div class="box-list__box-link">
                <div class="box-list__content">
                  <img class="box-list__image" src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt']; ?>">
                  <h3 class="box-list__title"><?php echo $title; ?></h3>
                </div>
              </div>

            <?php if( $link ): ?>
              </a>
            <?php endif; ?>

          </div>

        <?php endwhile; ?>

      </div>

    <?php endif; ?>

  </div>
</section>
