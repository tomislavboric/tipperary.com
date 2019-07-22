<?php
// Don't load directly
defined( 'WPINC' ) or die;

/**
 * Event Submission Form Taxonomy Block
 * Renders the taxonomy field in the submission form.
 *
 * Override this template in your own theme by creating a file at
 * [your-theme]/tribe-events/community/modules/taxonomy.php
 *
 * @since  3.1
 * @version 4.5
 *
 */

$selected_terms = array();
$taxonomy_obj   = get_taxonomy( $taxonomy );
$ajax_args = array(
	'taxonomy' => $taxonomy,
);

$taxonomy_label = $taxonomy_obj->label;

// If we already have Event on the actual Taxonomy Label
if ( false === strpos( $taxonomy_obj->label, tribe_get_event_label_singular() ) ) {
	$taxonomy_label = sprintf( '%s %s', tribe_get_event_label_singular(), $taxonomy_obj->label );
}

// Check we have terms
$has_terms = count( get_terms( $taxonomy, array( 'hide_empty' => false, 'number' => 1, 'fields' => 'ids' ) ) ) < 1;

// Setup selected tags
$value = ! empty( $_POST['tax_input'][ $taxonomy ] ) ? explode( ',', esc_attr( trim( $_POST['tax_input'][ $taxonomy ] ) ) ) : array();

// if no tags from $_POST then look for saved tags
if ( empty( $value ) ) {
	$terms = wp_get_post_terms( get_the_ID(), $taxonomy );
	$value = wp_list_pluck( $terms, 'term_id' );
}

foreach ( $value as $term_id ) {
	$term = get_term( $term_id, $taxonomy );
	$selected_terms[] = array(
		'id'   => $term->term_id,
		'text' => $term->name,
	);
}

if ( is_array( $value ) ) {
	$value = implode( ',', $value );
}

if ( $has_terms ) {
	return;
}

// This will be used for the placeholder attribute of the taxonomy selection.
$taxonomy_placeholder = __( 'terms', 'tribe-events-community' );

// Default taxonomies labels have word "Event", which is redundant for the placeholder attribute.
// That is removed here, along with any extra spaces around the remaining text.
if ( ! empty( $taxonomy_label ) ) {
	$taxonomy_placeholder = str_replace( tribe_get_event_label_singular(), '', $taxonomy_label );
	$taxonomy_placeholder = strtolower( trim( $taxonomy_placeholder ) );
}

?>
<div class="tribe-section tribe-section-taxonomy">
	<div class="tribe-section-header">
		<h3><?php echo esc_html( $taxonomy_label ); ?></h3>
	</div>

	<?php
	/**
	 * Allow developers to hook and add content to the beginning of this section
	 * @param string $taxonomy_slug
	 */
	do_action( 'tribe_events_community_section_before_taxonomy', $taxonomy );
	?>

	<div class="tribe-section-content">
		<div class="tribe-section-content-field">
			<input
				class="tribe-dropdown"
				data-options="<?php echo esc_attr( json_encode( $selected_terms ) ); ?>"
				data-source="search_terms"
				data-source-args="<?php echo esc_attr( json_encode( $ajax_args ) ); ?>"
				name="tax_input[<?php echo esc_attr( $taxonomy ); ?>]"
				multiple
				data-dropdown-css-width="false"
				data-allow-html
				placeholder="<?php echo esc_attr( sprintf( __( 'Search from existing %s', 'tribe-events-community' ), $taxonomy_placeholder ) ); ?>"
				type="hidden"
				value="<?php echo esc_attr( $value ); ?>"
			>
		</div>
	</div>

	<?php
	/**
	 * Allow developers to hook and add content to the end of this section
	 * @param string $taxonomy_slug
	 */
	do_action( 'tribe_events_community_section_after_taxonomy', $taxonomy );
	?>
</div>
