<?php
/*
class-scc-follow-base-cache-engine.php

Description: This class is a data cache engine whitch get and cache data using wp-cron at regular intervals
Author: Daisuke Maruyama
Author URI: http://marubon.info/
License: GPL2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.txt
*/

/*
Copyright (C) 2014 - 2016 Daisuke Maruyama

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

class SCC_Follow_Base_Cache_Engine extends SCC_Follow_Cache_Engine {

	/**
	 * Prefix of cache ID
	 */
	const DEF_TRANSIENT_PREFIX = 'scc_follow_count_';

	/**
	 * Cron name to schedule cache processing
	 */
	const DEF_PRIME_CRON = 'scc_follow_basecache_prime';

	/**
	 * Cron name to execute cache processing
	 */
	const DEF_EXECUTE_CRON = 'scc_follow_basecache_exec';

	/**
	 * Schedule name for cache processing
	 */
	const DEF_EVENT_SCHEDULE = 'follow_base_cache_event';

	/**
	 * Schedule description for cache processing
	 */
	const DEF_EVENT_DESCRIPTION = '[SCC] Follow Base Cache Interval';

	/**
	 * Interval cheking and caching target data
	 */
	private $check_interval = 600;

    /**
	 * Offset suffix
	 */
	private $offset_suffix = 'follow_base_cache_offset';

	/**
	 * Initialization
	 *
	 * @since 0.1.1
	 */
	public function initialize( $options = array() ) {
		SCC_Common_Util::log( '[' . __METHOD__ . '] (line='. __LINE__ . ')' );

		$this->cache_prefix = self::DEF_TRANSIENT_PREFIX;
		$this->prime_cron = self::DEF_PRIME_CRON;
		$this->execute_cron = self::DEF_EXECUTE_CRON;
		$this->event_schedule = self::DEF_EVENT_SCHEDULE;
		$this->event_description = self::DEF_EVENT_DESCRIPTION;

		$this->load_ratio = 0.5;

		if ( isset( $options['delegate'] ) ) $this->delegate = $options['delegate'];
		if ( isset( $options['crawler'] ) ) $this->crawler = $options['crawler'];
		if ( isset( $options['target_sns'] ) ) $this->target_sns = $options['target_sns'];
		if ( isset( $options['check_interval'] ) ) $this->check_interval = $options['check_interval'];
		if ( isset( $options['cache_prefix'] ) ) $this->cache_prefix = $options['cache_prefix'];
		if ( isset( $options['prime_cron'] ) ) $this->prime_cron = $options['prime_cron'];
		if ( isset( $options['execute_cron'] ) ) $this->execute_cron = $options['execute_cron'];
		if ( isset( $options['event_schedule'] ) ) $this->event_schedule = $options['event_schedule'];
		if ( isset( $options['event_description'] ) ) $this->event_description = $options['event_description'];
		if ( isset( $options['scheme_migration_mode'] ) ) $this->scheme_migration_mode = $options['scheme_migration_mode'];
		if ( isset( $options['scheme_migration_exclude_keys'] ) ) $this->scheme_migration_exclude_keys = $options['scheme_migration_exclude_keys'];
		if ( isset( $options['cache_retry'] ) ) $this->cache_retry = $options['cache_retry'];
		if ( isset( $options['retry_limit'] ) ) $this->retry_limit = $options['retry_limit'];

		add_filter( 'cron_schedules', array( $this, 'schedule_check_interval' ) );
		add_action( $this->prime_cron, array( $this, 'prime_cache' ) );
		add_action( $this->execute_cron, array( $this, 'execute_cache' ), 10, 1 );
	}

	/**
	 * Register event schedule for this engine
	 *
	 * @since 0.1.0
	 */
	public function schedule_check_interval( $schedules ) {
		SCC_Common_Util::log( '[' . __METHOD__ . '] (line='. __LINE__ . ')' );

		$schedules[$this->event_schedule] = array(
			'interval' => $this->check_interval,
			'display' => $this->event_description
			);

		return $schedules;
	}

	/**
	 * Schedule data retrieval and cache processing
	 *
	 * @since 0.4.0
	 */
	public function prime_cache() {
		SCC_Common_Util::log( '[' . __METHOD__ . '] (line='. __LINE__ . ')' );

		$next_exec_time = (int) current_time( 'timestamp', 1 ) + $this->check_interval;

		SCC_Common_Util::log( '[' . __METHOD__ . '] check_interval: ' . $this->check_interval );
		SCC_Common_Util::log( '[' . __METHOD__ . '] next_exec_time: ' . $next_exec_time );

		wp_schedule_single_event( $next_exec_time, $this->execute_cron, array( SCC_Common_Util::short_hash( $next_exec_time ) ) );
	}

	/**
	 * Get and cache data of each published post and page
	 *
	 * @since 0.1.0
	 */
	public function execute_cache( $hash ) {
		SCC_Common_Util::log( '[' . __METHOD__ . '] (line='. __LINE__ . ')' );

		SCC_Common_Util::log( '[' . __METHOD__ . '] check_interval: ' . $this->check_interval );

		$cache_expiration = $this->get_cache_expiration();

		SCC_Common_Util::log( '[' . __METHOD__ . '] cache_expiration: ' . $cache_expiration );

		$transient_id = $this->get_cache_key( 'follow' );

		$options = array(
			'cache_key' => $transient_id,
			'target_sns' => $this->target_sns,
			'cache_expiration' => $cache_expiration
			);

		// Primary cache
		$this->cache( $options );

		// Secondary cache
		$this->delegate_order( SCC_Order::ORDER_DO_SECOND_CACHE, $options );
	}

	/**
	 * Get and cache data for a given post
	 *
	 * @since 0.4.0
	 */
	public function direct_cache( $second_sync = false ) {
		SCC_Common_Util::log( '[' . __METHOD__ . '] (line='. __LINE__ . ')' );

		$cache_expiration = $this->get_cache_expiration();

		SCC_Common_Util::log( '[' . __METHOD__ . '] cache_expiration: ' . $cache_expiration );

		$transient_id = $this->get_cache_key( 'follow' );

		$options = array(
			'cache_key' => $transient_id,
			'target_sns' => $this->target_sns,
			'cache_expiration' => $cache_expiration
			);

		// Primary cache
		$result = $this->cache( $options );

		if ( $second_sync ) {
			// Secondary cache
			$this->delegate_order( SCC_Order::ORDER_DO_SECOND_CACHE, $options );
		}

		return $result;
	}

	/**
	 * Get cache expiration based on current number of total post and page
	 *
	 * @since 0.4.0
	 */
	protected function get_cache_expiration() {
		SCC_Common_Util::log( '[' . __METHOD__ . '] (line='. __LINE__ . ')' );

		return 3 * $this->check_interval;
	}

	/**
	 * Initialize meta key for ranking
	 *
	 * @since 0.3.0
	 */
	public function initialize_cache() {
		SCC_Common_Util::log( '[' . __METHOD__ . '] (line='. __LINE__ . ')' );
	}

	/**
	 * Clear meta key for ranking
	 *
	 * @since 0.3.0
	 */
	public function clear_cache() {
		SCC_Common_Util::log( '[' . __METHOD__ . '] (line='. __LINE__ . ')' );

		$transient_id = $this->get_cache_key( 'follow' );

		delete_transient( $transient_id );
	}

}

?>
