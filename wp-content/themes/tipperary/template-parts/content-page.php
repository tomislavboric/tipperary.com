<?php
/**
 * The default template for displaying page content
 *
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

?>

<article>
	<?php /*
	<header>
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header>
	*/ ?>
	<div class="entry-content">
		<?php the_content(); ?>

		<?php
		// Tabs
		if( have_rows('tabs_content') ):
			$counter = 1;
			$counter2 = 1;
			?>

			<ul class="tabs" data-tabs id="example-tabs">

				<?php while( have_rows('tabs_content') ): the_row();

				// vars
					$tab_title = get_sub_field('tab_title');
				$count = $counter++; //count( get_field('tabs_content') );

				?>

				<li class="tabs-title <?php if ( $count == 1 ) { echo 'is-active'; } ?>"><a href="#panel<?php echo $count; ?>" aria-selected="true"><?php echo $tab_title; ?></a></li>

			<?php endwhile; ?>

		</ul>

		<div class="tabs-content" data-tabs-content="example-tabs">

			<?php while( have_rows('tabs_content') ): the_row();

				// vars
				$tab_content = get_sub_field('tab_content');
				$tabs_gallery = get_sub_field('tabs_gallery');
				$count2 = $counter2++; //count( get_field('tabs_content') );

				?>

				<div class="tabs-panel <?php if ( $count2 == 1 ) { echo 'is-active'; } ?>" id="panel<?php echo $count2; ?>">
					<div class="grid-x grid-padding-x">

						<div class="cell large-6">
							<?php echo $tab_content; ?>
						</div>

						<div class="cell auto">
							<?php

							$images = get_sub_field('tabs_gallery');

							if( $images ): ?>
								<div id="tab_slider-<?php echo rand(0, 100) ?>" class="tabs-slider__slider" data-slider="tab_slider-<?php echo rand(0, 100) ?>">
									<?php foreach( $images as $image ): ?>
										<figure class="tabs-slider__image shadow">
											<img class="tabs-slider__image-img" src="<?php echo $image['sizes']['sign-up-image']; ?>" alt="<?php echo $image['alt']; ?>" />
										</figure>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
						</div>

					</div>
				</div>

			<?php endwhile; ?>

		</div>

	<?php endif; ?>

	<?php

			// get iframe HTML
	$iframe = get_field('video_link');


			// use preg_match to find iframe src
	preg_match('/src="(.+?)"/', $iframe, $matches);
	$src = $matches[1];


			// add extra params to iframe src
	$params = array(
		'controls'    => 0,
		'hd'        => 1,
		'autohide'    => 1
	);

	$new_src = add_query_arg($params, $src);

	$iframe = str_replace($src, $new_src, $iframe);


			// add extra attributes to iframe html
	$attributes = 'frameborder="0"';

	$iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $iframe);

	?>

	<div class="responsive-embed widescreen">
		<!--<iframe width="560" height="315" src="https://www.youtube.com/embed/WUgvvPRH7Oc" frameborder="0" allowfullscreen></iframe>-->
		<?php echo $iframe; ?>
	</div>

	<?php //edit_post_link( __( '(Edit)', 'foundationpress' ), '<span class="edit-link">', '</span>' ); ?>
</div>
<footer>
	<?php
	wp_link_pages(
		array(
			'before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'foundationpress' ),
			'after'  => '</p></nav>',
		)
	);
	?>
	<?php $tag = get_the_tags(); if ( $tag ) { ?><p><?php the_tags(); ?></p><?php } ?>
</footer>
</article>
