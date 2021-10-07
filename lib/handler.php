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
	$form_action = array(
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
function sheetmonkey_save_to_google_sheets( $form ) {
	$submission = WPCF7_Submission::get_instance();
	if ( $form ) {
		//The data you want to send via POST
		$fields = $submission->get_posted_data();
		$form_id = $form->id();
		$form_data = get_post_meta( $form_id, 'sheet-monkey-settings' );
		$form_action = $form_data[0]['form-action'];
		if(!isset($form_action) || strlen($form_action) == 0) {
			return;
		}

		$options = array(
			"body" => $fields,
		);

		wp_safe_remote_post( $form_action, $options );
	}
}

?>