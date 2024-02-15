<?php
/**
 * Functions to handle form events
 *
 * @since		1.0
 */

/**
* Saves the plugin settings for the form
* @since 1.0
*/
function save_sheetmonkey_settings( $post ) {
	$default = array(
			"form-action" => "",			
	);
	$sheet_data = isset( $_POST['sheetmonkey'] ) ? $_POST['sheetmonkey'] : $default;
	update_post_meta( $post->id(), 'sheet-monkey-settings', array(
		"form-action" => sanitize_text_field($sheet_data['form-action'])
	));
}

/**
* Handles the submission for configured forms and 
* sends it to the Sheet Monkey API
* @since 1.0
*/

/**
* Handles the submission for configured forms and 
* sends it to the Sheet Monkey API
* @since 1.0
*/
function sheetmonkey_save_to_google_sheets( $form ) {
	$submission = WPCF7_Submission::get_instance();
	$form_id = $form->id();
	$form_data = get_post_meta( $form_id, 'sheet-monkey-settings' );
	$form_action = $form_data[0]['form-action'];

	if(!isset($form_action) || strlen($form_action) == 0) {
		return;
	}

	if ( $form ) {
		//The data you want to send via POST
		$fields = $submission->get_posted_data();
		$files = $submission->uploaded_files();
		if(!empty($files)) {
			$boundary = md5(time());
			$payload = "";
			foreach($fields as $field_name => $value) {
				if(array_key_exists($field_name, $files)) {
					continue;
				}
				$payload .= '--' . $boundary . "\r\n";
				$payload .= 'Content-Disposition: form-data; name="' . $field_name . "\"\r\n\r\n";
				$payload .= $value . "\r\n";
			}
			foreach($files as $field_name => $file_path) {
				$payload .= '--' . $boundary . "\r\n";
				$payload .= 'Content-Disposition: form-data; name="' . $field_name . '"; filename="' . basename($file_path[0]) . '"' . "\r\n";
				$payload .= 'Content-Type: ' . mime_content_type($file_path[0]) . "\r\n";
				$payload .= 'Content-Transfer-Encoding: binary' . "\r\n\r\n";
				$payload .= file_get_contents($file_path[0]) . "\r\n";
				$payload .= '--' . $boundary . '--'; 
				$payload .= "\r\n\r\n";
			}
			$options = array(
				"body" => $payload,
				"headers" => array(
					"Content-Type" => "multipart/form-data; boundary=" . $boundary,
					"Content-Length" => strlen($payload)
				),
			);
			wp_safe_remote_post( $form_action, $options );
		} else {
		
			$options = array(
				"body" => $fields,
			);
	
			wp_safe_remote_post( $form_action, $options );	
		}
	}
}

?>