<?php 
/**
 * @package rms
 * @author Makanaokeakua Edwards | Hakoni Software Development<makridevelopment@gmail.com>
 * @license Proprietary
 */
 declare(strict_types=1);

 namespace RMS\Settings;

 use RMS\Classes\Abstracts\Base;

 class Cors extends Base {
	public function init() {
		add_filter( 'graphql_response_headers_to_send', function( $headers ) {
			$http_origin     = get_http_origin();
			$allowed_origins = [
				HEADLESS_FRONTEND_URL,
			];
		
			// If the request is coming from an allowed origin (HEADLESS_FRONTEND_URL), tell the browser it can accept the response.
			if ( in_array( $http_origin, $allowed_origins, true ) ) {
				$headers['Access-Control-Allow-Origin'] = $http_origin;
			}
		
			// Tells browsers to expose the response to frontend JavaScript code when the request credentials mode is "include".
			$headers['Access-Control-Allow-Credentials'] = 'true';
			
			return $headers;
		}, 20 );
	}
 }