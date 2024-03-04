<?php
/**
 * Functions to present the plugin user interface
 *
 * @since		1.0
 */

/**
 * Displays general information on the plugin.
 * @since 1.0
 */
 function notionmonkey_info_page( ) {
?>
	<div class='wrap'>
		<h2>
			🐵 Contact Form 7 to Notion
		</h2>
		<h4>A free plugin by Notion Monkey</h4>
		<div style='display: flex; align-items: start; gap: 15px;' class="card">
			<div>
				<h2 class="title">What is Notion Monkey?</h2>
				<div class="inside">
					<p>
						Notion Monkey is a free service that connects your forms to Notion. It handles the 
						difficult work for you in a secure, scalable service so all you have to do to connect
						your forms to Notion is an account.
					</p>
					<p>
						Connecting your forms to Notion requires a free Notion account.
					</p>
					<p>
						<a href="https://dashboard.notionmonkey.io?ref=wordpress" class="button" target='_blank'>Get Started</a> &nbsp;
						<a href="https://notionmonkey.io" target='_blank'>Learn More...</a>
					</p>
				</div>
			</div>
			<img src="<?php echo plugin_dir_url(__FILE__) ?>/../../monkey.png" width="150" style="float: right" />
		</div>
		<div class="card">
			<h2 class="title">Why this plugin?</h2>
				<div class="inside">
					<p>
						As we looked at the options for connecting CF7 to Notion, they all 
						seemed too complicated and risky, storing sensitive Notion Credentials in your WordPress database. We built this to be:
					</p>
					<ul>
						<li>✅ <strong>Simple.</strong> It shouldn't take 10 steps to send your form data to Notion.</li>
						<li>✅ <strong>Secure.</strong> By handling the connection in Notion Monkey's cloud and not on the WordPress host, you protect your Notion credentials from hackers and malicious plugins.</li>
						<li>✅ <strong>No Adware.</strong> The plugin shouldn't be constantly bugging you to upgrade.</li>
					</ul>
				</div>	
		</div>
		<div class="card">
			<h2 class="title">Video guide</h2>
			<iframe width="100%" height="315" src="https://www.youtube.com/embed/jdjexcjAhaU" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		</div>
	</div>
<?php
}

/**
* Displays the editor panel for the form.
* 
* This editor panel should appear as a tab the Contact Form 7 interface.
* @since 1.0
*/
function notionmonkey__editor_panel_notion( $post ) {
	$form_id = sanitize_text_field( $_GET['post'] );
	$form_data = get_post_meta( $form_id, 'notion-monkey-settings' );
?>
	<style>
		.sm-form a {
			text-decoration: none;
		}
	</style>
	<div class="wrap sm-form">
		<h2>Connect to Notion</h2>
			<fieldset style="display: flex; flex-direction: column; gap: 15px; margin-top: 15px;" class="inside">
				<div style="display: flex; align-items: center; gap: 10px;">
					<label>
						Form Action URL
					</label>
					<input 
						type="text"
						name="notionmonkey[form-action]" 
						id="notionmonkey-form-action" 
						style="flex: 1"
						placeholder="https://..."
						value="<?php echo ( isset( $form_data[0]['form-action'] ) ) ? esc_attr( $form_data[0]['form-action'] ) : ''; ?>"
					/>
					<a href="#" class='sm-link' onClick="document.getElementById('notionmonkey-form-action').value = ''; disableSMLinks();" style="text-decoration: none;">
						<span class="dashicons dashicons-trash"></span>
						Disable
					</a>
					<a href="#" class='sm-link' id="notion-monkey-settings" target="_blank">
						<span class="dashicons dashicons-admin-generic"></span>
						Settings
					</a>
				</div>
				<div style="display: flex; align-items: center; gap: 10px;">
					<a href="https://dashboard.notionmonkey.io" target="_blank">
						Get my form action URL 
						<span class="dashicons dashicons-external"></span>
					</a>
					<a href="https://docs.notionmonkey.io">
						<span class="dashicons dashicons-editor-help"></span>
						Help
					</a>	
				</div>
			</fieldset>
			<script>
			const parseSMURL = (url) => {
				const [protocol, _, host, form, formId] = url.split('/');
				if(form === 'form' && formId) {
					return formId;
				}
				return false;
			}
			const enableSMLinks = (formId) => {
				if(!formId) return disableSMLinks();
				document.getElementById('notion-monkey-settings').href = `https://dashboard.notionmonkey.io/edit/${formId}`;
				document.querySelectorAll('.sm-link').forEach(el => el.setAttribute('style', 'visibility: visibile'));
			}
			const disableSMLinks = () => {
				document.querySelectorAll('.sm-link').forEach(el => el.setAttribute('style', 'visibility: hidden'));
			}
			document.getElementById('notionmonkey-form-action').onkeyup = (event) => {
				console.log('On change', event);
				const value = event.target.value;
				const formId = parseSMURL(value);
				if(formId) {
					enableSMLinks(formId);
				} else {
					disableSMLinks();
				}
			}
			<?php if(isset( $form_data[0]['form-action'] )): ?>
				enableSMLinks(parseSMURL('<?php echo esc_attr($form_data[0]['form-action']); ?>'));
			<?php endif; ?>
		</script>
	</div>
<?php 
}
?>