<?php
/*
Author: Ryan Duff
Author URI: http://ryanduff.net
Description: Administrative options for WP-ContactForm
*/

load_plugin_textdomain('wpcf',$path = 'wp-content/plugins/wp-contact-form');
$location = get_option('siteurl') . '/wp-admin/admin.php?page=wp-contact-form/options-contactform.php'; // Form Action URI

/*Lets add some default options if they don't exist*/
add_option('wpcf_email', __('you@example.com', 'wpcf'));
add_option('wpcf_subject', __('Contact Form Results', 'wpcf'));
add_option('wpcf_success_msg', __('Thanks for your comments!', 'wpcf'));
add_option('wpcf_error_msg', __('Please fill in the required fields.', 'wpcf'));
add_option('wpcf_show_quicktag', TRUE);

/*check form submission and update options*/
if (isset ($_POST['stage']) && ( 'process' == $_POST['stage']) )
{
update_option('wpcf_email', $_POST['wpcf_email']);
update_option('wpcf_subject', $_POST['wpcf_subject']);
update_option('wpcf_success_msg', $_POST['wpcf_success_msg']);
update_option('wpcf_error_msg', $_POST['wpcf_error_msg']);

if(isset($_POST['wpcf_show_quicktag'])) // If wpcf_show_quicktag is checked
	{update_option('wpcf_show_quicktag', true);}
	else {update_option('wpcf_show_quicktag', false);}

}

/*Get options for form fields*/
$wpcf_email = stripslashes(get_option('wpcf_email'));
$wpcf_subject = stripslashes(get_option('wpcf_subject'));
$wpcf_success_msg = stripslashes(get_option('wpcf_success_msg'));
$wpcf_error_msg = stripslashes(get_option('wpcf_error_msg'));
$wpcf_show_quicktag = get_option('wpcf_show_quicktag');
?>

<div class="wrap">
  <h2><?php _e('Contact Form Options', 'wpcf') ?></h2>
  <form name="form1" method="post" action="<?php echo $location ?>&amp;updated=true">
	<input type="hidden" name="stage" value="process" />
    <table width="100%" cellspacing="2" cellpadding="5" class="editform">
      <tr valign="top">
        <th scope="row"><?php _e('E-mail Address:', 'wpcf') ?></th>
        <td><input name="wpcf_email" type="text" id="wpcf_email" value="<?php echo $wpcf_email; ?>" size="40" />
        <br />
<?php _e('This address is where the email will be sent to.', 'wpcf') ?></td>
      </tr>
      <tr valign="top">
        <th scope="row"><?php _e('Subject:', 'wpcf') ?></th>
        <td><input name="wpcf_subject" type="text" id="wpcf_subject" value="<?php echo $wpcf_subject; ?>" size="50" />
        <br />
<?php _e('This will be the subject of the email.', 'wpcf') ?></td>
      </tr>
     </table>

	<fieldset class="options">
		<legend><?php _e('Messages', 'wpcf') ?></legend>
		<table width="100%" cellspacing="2" cellpadding="5" class="editform">
		  <tr valign="top">
			<th scope="row"><?php _e('Success Message:', 'wpcf') ?></th>
			<td><textarea name="wpcf_success_msg" id="wpcf_success_msg" style="width: 80%;" rows="4" cols="50"><?php echo $wpcf_success_msg; ?></textarea>
			<br />
	<?php _e('When the form is sucessfully submitted, this is the message the user will see.', 'wpcf') ?></td>
		  </tr>
		  <tr valign="top">
			<th scope="row"><?php _e('Error Message:', 'wpcf') ?></th>
			<td><textarea name="wpcf_error_msg" id="wpcf_error_msg" style="width: 80%;" rows="4" cols="50"><?php echo $wpcf_error_msg; ?></textarea>
			<br />
	<?php _e('If the user skips a required field, this is the message he will see.', 'wpcf') ?> <br />
	<?php _e('You can apply CSS to this text by wrapping it in <code>&lt;p style="[your CSS here]"&gt; &lt;/p&gt;</code>.', 'wpcf') ?><br />
	<?php _e('ie. <code>&lt;p style="color:red;"&gt;Please fill in the required fields.&lt;/p&gt;</code>.', 'wpcf') ?></td>
		  </tr>
		</table>

	</fieldset>

	<fieldset class="options">
		<legend><?php _e('Advanced', 'wpcf') ?></legend>

	    <table width="100%" cellpadding="5" class="editform">
	      <tr valign="top">
	        <th width="30%" scope="row" style="text-align: left"><?php _e('Show \'Contact Form\' Quicktag', 'wpcf') ?></th>
	        <td>
	        	<input name="wpcf_show_quicktag" type="checkbox" id="wpcf_show_quicktag" value="wpcf_show_quicktag"
	        	<?php if($wpcf_show_quicktag == TRUE) {?> checked="checked" <?php } ?> />
			</td>
	      </tr>
	     </table>

	</fieldset>

    <p class="submit">
      <input type="submit" name="Submit" value="<?php _e('Update Options', 'wpcf') ?> &raquo;" />
    </p>
  </form>
</div>