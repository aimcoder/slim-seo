<?php
namespace SlimSEO\MetaTags;

class Robots {
	public function __construct() {
		add_action( 'wp_head', [ $this, 'output' ] );
	}

	public function output() {
		$robots = $this->get_robots();
		if ( $robots ) {
			echo '<meta name="robots" content="', esc_attr( implode( ',', $robots ) ), '">', "\n";
		}
	}

	public function get_robots() {
		if ( is_singular() ) {
			return $this->get_singular_robots();
		}

		return '';
	}

	private function get_singular_robots() {
		$robots = [];
		$post   = get_queried_object();

		$seo_settings = get_post_meta( $post->ID, 'slim_seo', true );
		if ( ! empty( $seo_settings['noindex'] ) ) {
			$robots[] = 'noindex';
		}

		return $robots;
	}
}
