<?php

/**
 * Class Tribe__Events__Filterbar__Filters__Venue
 */
class Tribe__Events__Filterbar__Filters__Venue extends Tribe__Events__Filterbar__Filter {
	public $type = 'checkbox';

	public function get_admin_form() {
		$title = $this->get_title_field();
		$type = $this->get_multichoice_type_field();
		return $title.$type;
	}

	protected function get_values() {
		/** @var wpdb $wpdb */
		global $wpdb;

		// get venue IDs associated with published posts
		$venue_ids =
			$wpdb->get_col(
				$wpdb->prepare(
					"SELECT DISTINCT m.meta_value 
					FROM {$wpdb->postmeta} m 
					INNER JOIN {$wpdb->posts} p 
					ON p.ID=m.post_id 
					WHERE p.post_type=%s 
					AND p.post_status='publish' 
					AND m.meta_key='_EventVenueID' 
					AND m.meta_value > 0
					",
					Tribe__Events__Main::POSTTYPE
			)
		);
		$venue_ids = array_filter( $venue_ids );
		if ( empty( $venue_ids ) ) {
			return array();
		}

		/**
		 * Filter Total Venues in Filter Bar
		 * Use this with caution, this will load venues on the front-end, may be slow
		 * The base limit is 200 for safety reasons
		 *
		 *
		 * @parm int  200 posts per page limit
		 * @parm array $venue_ids   ids of venues attached to events
		 */
		$limit = apply_filters( 'tribe_eventsfilter_bar_venues_limit', 200, $venue_ids );

		$venues = get_posts( array(
			'post_type' => Tribe__Events__Main::VENUE_POST_TYPE,
			'posts_per_page' => $limit,
			'suppress_filters' => false,
			'post__in' => $venue_ids,
			'post_status' => 'publish',
			'orderby' => 'title',
			'order' => 'ASC',
		) );

		$venues_array = array();
		foreach ( $venues as $venue ) {
			$venues_array[] = array(
				'name' => $venue->post_title,
				'value' => $venue->ID,
			);
		}

		return $venues_array;
	}

	protected function setup_join_clause() {
		global $wpdb;
		$this->joinClause =
			"LEFT JOIN {$wpdb->postmeta} 
			AS venue_filter 
			ON ({$wpdb->posts}.ID = venue_filter.post_id 
			AND venue_filter.meta_key = '_EventVenueID')
			";
	}

	protected function setup_where_clause() {
		if ( is_array( $this->currentValue ) ) {
			$venue_ids = implode( ',', array_map( 'intval', $this->currentValue ) );
		} else {
			$venue_ids = esc_attr( $this->currentValue );
		}

		$this->whereClause = " AND venue_filter.meta_value IN ($venue_ids) ";
	}
}
