<?php
/**
 * Plugin Name: Notion Monkey's Contact Form 7 to Notion
 * Plugin URI: https://github.com/levinunnink/wordpress-forms-to-google-sheets
 * Description: A <strong>simple</strong>, <strong>secure</strong> way to connect Contact Form 7 data to Google Sheets. Connect in one step. No code required.
 * Author: Notion Monkey
 * Author URI: https://notionmonkey.io
 * Version: 1.0.0
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
	add_submenu_page( 'wpcf7', 'Notion 🐵',  'Notion 🐵', 'edit_posts', 'notionmonkey-config', 'notionmonkey_info_page' );
}

/**
* Adds an editor panel to the CF7 contact form interface
* @since 1.0
*/
function sheetmonkey_editor_panels( $panels ) {
	if ( current_user_can( 'wpcf7_edit_contact_form' ) ) {
		 $panels['notion_monkey'] = array(
				'title' => __( 'Notion 🐵', 'contact-form-7' ),
				'callback' => 'notionmonkey__editor_panel_notion'
		 );
	}
	return $panels;
}

/**
* Registers filters and actions
* @since 1.0
*/
add_filter( 'wpcf7_editor_panels', 'notionmonkey_editor_panels' );
add_action( 'wpcf7_after_save', 'save_notionmonkey_settings' );
add_action( 'wpcf7_mail_sent', 'notionmonkey_save_to_notion' );
add_action( 'admin_menu', 'notionmonkey_register_menu_pages' );
