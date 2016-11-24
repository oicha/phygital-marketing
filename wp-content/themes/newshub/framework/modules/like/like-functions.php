<?php

if ( ! function_exists('newshub_mikado_like') ) {
	/**
	 * Returns NewsHubMikadoLike instance
	 *
	 * @return NewsHubMikadoLike
	 */
	function newshub_mikado_like() {
		return NewsHubMikadoLike::get_instance();
	}

}

function newshub_mikado_get_like() {

	echo wp_kses(newshub_mikado_like()->add_like(), array(
		'span' => array(
			'class' => true,
			'aria-hidden' => true,
			'style' => true,
			'id' => true
		),
		'a' => array(
			'href' => true,
			'class' => true,
			'id' => true,
			'title' => true,
			'style' => true
		)
	));
}

if ( ! function_exists('newshub_mikado_like_latest_posts') ) {
	/**
	 * Add like to latest post
	 *
	 * @return string
	 */
	function newshub_mikado_like_latest_posts() {
		return newshub_mikado_like()->add_like();
	}

}

if ( ! function_exists('newshub_mikado_like_portfolio_list') ) {
	/**
	 * Add like to portfolio project
	 *
	 * @param $portfolio_project_id
	 * @return string
	 */
	function newshub_mikado_like_portfolio_list($portfolio_project_id) {
		return newshub_mikado_like()->add_like_portfolio_list($portfolio_project_id);
	}

}