<?php
/*
Plugin Name: WorldOfChat WordPress Plugin
Plugin URI: http://www.wocchat.com
Description: A simple and easy way to add World of chats instant chat messenger, and facebook like buttons into all your wordpress blog pages and posts!
Author: WorldOfChat
Author URI: http://www.wocchat.com
Version: 1.0px
*/

add_action('admin_menu', 'woc_add_adminpage');
function woc_add_adminpage() {
    add_submenu_page('options-general.php','WOC Settings', 'WOC Settings', 8, __FILE__,'woc_settings_page');
}

function woc_settings_page(){
    if($_POST['woc_form_submitted'] == 'true'){
        if($_POST['woc_credit'] == 1){woc_manage_option('woc_credit',$_POST['woc_credit']);}else{woc_manage_option('woc_credit','0');}
        if($_POST['woc_sitewide'] == 1){woc_manage_option('woc_sitewide',$_POST['woc_sitewide']);}else{woc_manage_option('woc_sitewide','0');}
        if($_POST['woc_sitewide_turned_off'] == 1){woc_manage_option('woc_sitewide_turned_off',$_POST['woc_sitewide_turned_off']);}else{woc_manage_option('woc_sitewide_turned_off','0');}
        
        echo "<br/><div class='updated'><h3>WorldOfChat Plugin Settings Updated</h3></div>";
    }    
    if(get_option('woc_credit') == 1){$checked = 'checked="checked"';}else{$checked = '';}
    if(get_option('woc_sitewide') == 1){$checked_sitewide = 'checked="checked"';}else{$checked_sitewide = '';}
    if(get_option('woc_sitewide_turned_off') == 1){$checked_sitewide_turned_off = 'checked="checked"';}else{$checked_sitewide_turned_off = '';}
    
    echo "<div class=\"add-form\"><form method='post' enctype='multipart/form-data'>";
    echo "<div style='margin: 25px 15px;'>
    <table class='widefat post' cellspacing='0' border='0' style='width: 60%;margin-top: 5px;'>
	<thead>
	<tr>
	<th colspan='2' align='center' style='text-align: center;'><h2>WorldOfChat Plugin Settings</h2></th>
	</tr>
	</thead>
	<tbody>";
    echo "<tr>
	<td align='right' style='width: 40%;border-right: 1px solid #E7E7E7;'>Activate Messenger Sitewide</td>
	<td align='left' style='width: 60%;border-bottom: 1px solid #E7E7E7;'><input type='checkbox' $checked_sitewide name='woc_sitewide' value='1'></td>
	</tr>";
    echo "<!-- <tr>
	<td align='right' style='width: 40%;border-right: 1px solid #E7E7E7;'>Turn off chat bar sitewide</td>
	<td align='left' style='width: 60%;border-bottom: 1px solid #E7E7E7;'><input type='checkbox' $checked_sitewide_turned_off name='woc_sitewide_turned_off' value='1'> <em style='font-size:11px'>[this will overwrite all other settings]</em> </td>
	</tr> -->";
	echo "<tr>
	<td align='right' style='width: 40%;border-right: 1px solid #E7E7E7;'>Put Credit in Footer</td>
	<td align='left' style='width: 60%;border-bottom: 1px solid #E7E7E7;'><input type='checkbox' $checked name='woc_credit' value='1'></td>
	</tr>";
	echo "<tr>
	<td align='right' style='width: 40%;border-right: 1px solid #E7E7E7;'>&nbsp;</td>
	<td align='left' style='width: 60%;'><input type='submit' class='button-primary' name='woc_form_update' value='Save Settings' /></td>
	</tr>";
	
	echo "</tbody>";
    echo "</table></div>";
	echo "<input type='hidden' name='woc_form_submitted' value='true' /></form></div>";
}
function woc_manage_footer_copywright() {
    if(get_option('woc_credit') == 1){
        echo '<span style="float:right;">Messenger by <a href="http://www.wocchat.com">Wocchat.com</a></span>';
    }
}
add_action('wp_footer', 'woc_manage_footer_copywright');
function woc_manage_sitewide_turned_off() {
    if(get_option('woc_sitewide_turned_off') == 1){
      //  echo '<span style="float:right;">Messenger by <a href="http://www.wocchat.com">Wocchat.com</a></span>';
    }
}
add_action('wp_footer', 'woc_manage_sitewide_turned_off');
function woc_manage_sitewide_turned_on() {
    if(get_option('woc_sitewide') == 1){
        echo '<!-- For 123 Web Messenger Code Begin -->
<script language="javascript" src="http://www.worldofchat.co.uk/wmchat/js/config.js"></script>
<script language="javascript" src="http://www.wocchat.com/webmessenger_get_user_info.php"></script>
<script language="javascript" src="http://www.worldofchat.co.uk/wmchat/js/123webmessenger_fb.js"></script>
<!-- For 123 Web Messenger Code End -->';
    }
}
add_action('wp_footer', 'woc_manage_sitewide_turned_on');
function woc_manage_option($option_name, $value) {
    if ( get_option( $option_name ) !== false ) {
        update_option( $option_name, $value );
    } else {
        $deprecated = null;
        $autoload = 'no';
        add_option( $option_name, $value, $deprecated, $autoload );
    }
}

add_shortcode( 'wocchat', 'woc_param_func');
function woc_param_func($att, $content) {
        return $content.'<!-- For 123 Web Messenger Code Begin -->
<script language="javascript" src="http://www.worldofchat.co.uk/wmchat/js/config.js"></script>
<script language="javascript" src="http://www.wocchat.com/webmessenger_get_user_info.php"></script>
<script language="javascript" src="http://www.worldofchat.co.uk/wmchat/js/123webmessenger_fb.js"></script>
<!-- For 123 Web Messenger Code End -->';
}

?>