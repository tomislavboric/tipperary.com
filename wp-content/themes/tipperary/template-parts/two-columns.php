<?php

// vars
$first_column = get_field( 'first_column' );
$second_column  = get_field( 'second_column' );
?>
<section class="two-columns main-container">
  <div class="main-grid">
    <div class="grid-x grid-margin-x text-center">

      <div class="cell medium-12 large-12">
        <?php echo $first_column; ?>
      </div>

      <div class="cell medium-12 large-12">
        <?php echo $second_column; ?>
      </div>

    </div>
  </div>
</section>
