<?php
  $box_list_with_icons = get_field('box_list_with_icons');
?>
<section class="box-list-icon">
  <div class="grid-container">
    <div class="grid-x grid-padding-x grid-padding-y small-up-2 medium-up-2 large-up-3">

      <?php
      if( $box_list_with_icons ) {
        foreach ( $box_list_with_icons as $box_list ) {
        $box_icon = $box_list['icon'];
        ?>
        <div class="cell box-list-icon__box">
          <a href="<?php echo $box_list['link']; ?>" class="box-list-icon__box-link">
            <figure class="box-list-icon__box-figure">
              <img src="<?php echo $box_icon['sizes']['thumbnail']; ?>" class="box-list-icon__box-icon" alt="<?php echo $box_list['text']; ?>" width="<?php echo $box_icon['sizes']['thumbnail-width']; ?>" height="<?php echo $box_icon['sizes']['thumbnail-height']; ?>" />
            </figure>
            <h5 class="box-list-icon__box-title"><?php echo $box_list['text']; ?></h5>
          </a>
        </div>

      <?php
        }
      }
      ?>

    </div>
  </div>
</section>
