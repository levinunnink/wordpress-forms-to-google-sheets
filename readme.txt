=== Sheet Monkey's Contact Form 7 to Google Sheets ===
Contributors: levismmall
Tags: sheets, spreadsheets, google sheets, google spreadsheets,  cf7, contact form 7, data, form, form data
Requires at least: 3.6
Tested up to: 6.4.3
Stable tag: 1.0.1
Requires PHP: 7.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

The simple and secure way to connect Contact Form 7 to Google Sheets.

== Description ==

Sheet Monkey is the easiest and most secure way to connect any form to Google Sheets and with this plugin it now works for Contact Form 7. As we looked at the options for connecting CF7 to Google Sheets, they all seemed too complicated and risky, storing sensitive Google Credentials in your WordPress database.

We built this to be:

- *Simple*: It shouldn't take multiple steps to send your form data to Sheets. 
- *Secure*: By handling the connection in Sheet Monkey's cloud and not on the WordPress host, you protect your Google credentials from hackers and malicious plugins. 
- *No Adware:* The plugin shouldn't be constantly bugging you to upgrade.

To connect your form to Google Sheets, you just need to configure a form in Sheet Monkey and copy the  Sheet Monkey form URL to your form config screen in WordPress.

== Tour Video ==

How to connect your Contact Form 7 with Google Sheets.

<iframe width="560" height="315" src="https://www.youtube.com/embed/jdjexcjAhaU" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

== Frequently Asked Questions ==

= Do I have to match my form fields to sheet headers? =

This plugin will automatically create headers based on your form field names and map the data to those fields. If you're not sure how this works, [read this guide.](https://docs.sheetmonkey.io/#three-rules-of-sheet-monkey)

= Is this plugin free? =

Yes. It requires a free Sheet Monkey account. Sheet Monkey has paid accounts for forms with high volumes of monthly traffic.

= Does this plugin store API keys or Client Credentials? =

No. All API keys and client credentials are securely stored in Sheet Monkey's cloud. This means that even if your WordPress site is compormised, you don't have to worry about anyone getting access to your Google account data.

= How do I connect my forms? =

Create a new connection in the [Sheet Monkey dashboard](https://dashboard.sheetmonkey.io) and copy the "Form URL" value into the Contact Form 7 config panel. No other steps are needed.

= Can this plugin send my contact form data to any other services? =

Yes. It can also [send your data to a Notion](https://sheetmonkey.io/notion.html) using Sheet Monkey.

= Can I upload files to Google Sheets? =

Unfortunately, right now this feature isn't supported.

== Screenshots ==

1. Copy the form action from the Sheet Monkey dashboard
2. Paste the URL into the Contact Form 7 panel
3. The form data will automatically be stored in Google Sheets

== Changelog ==

= 1.0.1 =
* Fixed bug where uploaded files would not be correctly sent to Google Sheets.

= 1.0 =
* Initial release.
