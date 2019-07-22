<?php
/**
 * The default template for displaying page content
 *
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */
?>

<section class="grid-x grid-margin-x mobile-up-2 align-middle">

	<div class="content-contact__content cell">
		<a class="content-contact__link" href="<?php echo $listing_website; ?>">
			<span class="content-contact__icon">
				<i class="material-icons notranslate">language</i>
			</span>
			<h3 class="content-contact__link-title"><?php echo $listing_website; ?></h3>
		</a>
	</div>

	<div class="content-contact__content cell">
		<a class="content-contact__link" href="mailto:<?php echo $listing_contact_email; ?>">
			<span class="content-contact__icon">
				<i class="material-icons notranslate">local_post_office</i>
			</span>
			<h3 class="content-contact__link-title"><?php echo $listing_contact_email; ?></h3>
		</a>
	</div>

	<div class="content-contact__content cell">
		<a class="content-contact__link" href="tel:<?php echo $listing_telephone; ?>" class="content-contact__link cell">
			<span class="content-contact__icon">
				<i class="material-icons notranslate">phone</i>
			</span>
			<h3 class="content-contact__link-title"><?php echo $listing_telephone; ?></h3>
		</a>
	</div>

	<div class="content-contact__content cell">
		<a class="content-contact__link cell">
			<span class="content-contact__icon">
				<i class="material-icons notranslate">location_on</i>
			</span>
			<h3 class="content-contact__link-title"><?php echo $listing_address; ?></h3>
		</a>
	</div>



</section>
