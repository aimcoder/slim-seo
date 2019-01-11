<?php
namespace SlimSEO;

class MetaBox {
	public function __construct() {
		add_filter( 'rwmb_meta_boxes', [ $this, 'register_meta_boxes' ] );
	}

	public function register_meta_boxes( $meta_boxes ) {
		$meta_boxes[] = [
			'title'      => esc_html__( 'SEO', 'slim-seo' ),
			'id'         => 'slim-seo',
			'post_types' => get_post_types( [ 'public' => true ] ),
			'fields'     => [
				[
					'id'     => 'slim_seo',
					'type'   => 'group',
					'fields' => [
						[
							'name' => esc_html__( 'Meta Title', 'slim-seo' ),
							'id'   => 'meta_title',
							'type' => 'text',
						],
						[
							'name' => esc_html__( 'Meta Description', 'slim-seo' ),
							'id'   => 'meta_description',
							'type' => 'textarea',
						],
						[
							'name' => esc_html__( 'Hide From Search Results', 'slim-seo' ),
							'id'   => 'noindex',
							'type' => 'switch',
						],
					],
				],
			],
		];

		return $meta_boxes;
	}
}
