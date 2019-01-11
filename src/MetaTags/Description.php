<?php
namespace SlimSEO\MetaTags;

class Description {
	public function __construct() {
		add_action( 'wp_head', [ $this, 'output' ] );
	}

	public function output() {
		$description = $this->get_description();
		if ( $description ) {
			echo '<meta name="description" content="', esc_attr( $description ), '">', "\n";
		}
	}

	public function get_description() {
		if ( is_front_page() ) {
			return $this->get_home_description();
		}
		if ( is_tax() || is_category() || is_tag() ) {
			return $this->get_term_description();
		}
		if ( is_home() || is_singular() ) {
			return $this->get_singular_description();
		}

		return '';
	}

	private function get_home_description() {
		return is_page() ? $this->get_singular_description() : get_bloginfo( 'description' );
	}

	/**
	 * Get description from post excerpt and fallback to post content.
	 * Recommended length for meta description is 300 characters (~ 60 words).
	 *
	 * @return string
	 */
	private function get_singular_description() {
		$post = get_queried_object();

		$seo_settings = get_post_meta( $post->ID, 'slim_seo', true );
		if ( isset( $seo_settings['meta_description'] ) ) {
			return $seo_settings['meta_description'];
		}

		return $post->post_excerpt ? $post->post_excerpt : wp_trim_words( $post->post_content, 60 );
	}

	private function get_term_description() {
		return get_queried_object()->description;
	}
}
