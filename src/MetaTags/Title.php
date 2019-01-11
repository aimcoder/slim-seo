<?php
namespace SlimSEO\MetaTags;

class Title {
	public function __construct() {
		add_action( 'after_setup_theme', [ $this, 'add_title_tag_support' ] );
		add_filter( 'pre_get_document_title', [ $this, 'get_document_title' ] );
	}

	public function add_title_tag_support() {
		add_theme_support( 'title-tag' );
	}

	public function get_title() {
		return wp_get_document_title();
	}

	public function get_document_title( $title ) {
		return $this->get_custom_title() ?: $title;
	}

	private function get_custom_title() {
		$title = '';
		if ( is_singular() ) {
			$title = $this->get_singular_title();
		}
		return $title;
	}

	private function get_singular_title() {
		$seo_settings = get_post_meta( get_the_ID(), 'slim_seo', true );
		return isset( $seo_settings['meta_title'] ) ? $seo_settings['meta_title'] : '';
	}
}
