<?php

class WPPUTM_Post {

	private $_utm_params;

	public function __construct() {
		$this->_utm_params = array('utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term');
		add_filter( 'the_content', array( $this, 'wpputm_content_template' ), 20, 1 );
	}

	public function wpputm_content_template( $content ) {
		if ( is_singular('page') ) {
			return $content;
		}
		
		global $post, $multipage, $page;

		foreach ( $this->_utm_params as $up ) {
			if ( isset( $_GET[ $up ] ) ) {
				return $content;
			}
		}

		$multipage = 0;
		$page = 1;

		return wpautop( $post->post_content );
	}
}