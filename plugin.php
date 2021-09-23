<?php
/**
 * Plugin Name: Contact Form 7 to Google Sheets
 * Plugin URI: https://github.com/levinunnink/wordpress-forms-to-google-sheets
 * Description: A <strong>simple</strong>, <strong>secure</strong> way to connect Contact Form 7 data to Google Sheets. Connect in one step. No codes required.
 * Author: Sheet Monkey
 * Author URI: https://sheetmonkey.io
 * Version: 1.0
 * License: GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */


// Include utility functions
require_once('lib/handler.php');
require_once('lib/interface.php');

/**
* Create/Register menu items for the plugin.
* @since 1.0
*/
function sheetmonkey_register_menu_pages() {
	add_submenu_page( 'wpcf7', 'Google Sheets 🐵',  'Google Sheets 🐵', 'edit_posts', 'sheetmonkey-config', 'sheetmonkey_info_page' );
}

/**
* Adds an editor panel to the CF7 contact form interface
* @since 1.0
*/
function sheetmonkey_editor_panels( $panels ) {
	if ( current_user_can( 'wpcf7_edit_contact_form' ) ) {
		 $panels['sheet_monkey'] = array(
				'title' => __( 'Google Sheets 🐵', 'contact-form-7' ),
				'callback' => 'sheetmonkey__editor_panel_google_sheet'
		 );
	}
	return $panels;
}

/**
* Registers filters and actions
* @since 1.0
*/
add_filter( 'wpcf7_editor_panels', 'sheetmonkey_editor_panels' );
add_action( 'wpcf7_after_save', 'save_sheetmonkey_settings' );
add_action( 'wpcf7_mail_sent', 'sheetmonkey_save_to_google_sheets' );
add_action( 'admin_menu', 'sheetmonkey_register_menu_pages' );
