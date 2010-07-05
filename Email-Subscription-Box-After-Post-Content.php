<?php
/*
Plugin Name: Email Subscription Box After Post Content
Plugin URI: http://www.cre8tivenerd.com
Description: This plugin will help you to insert email subscription box after post content
Version: 1.0
Author: Kannan Sanjeevan
Author URI: http://www.cre8tivenerd.com
License: GPL
*/
add_option("rss","","Enter the RSS Link","yes");
add_option("email","","Enter the EMAIL Link","yes");
add_option("fid","","Enter Feed ID","yes");
add_action("admin_menu",'adoptions');
add_action("the_content",'email_sub_post');
function adoptions() {
add_options_page('Email Subscription Box After Post Content Menu','Email Subscription Box After Post Content','administrator','email-sub','email_sub');

}
?>
<?php
function email_sub_post($content){

if( is_single() )
{
echo $content;
?>
<style type="text/css">
.fform{
background:url('<?php echo get_bloginfo('url'); ?>/wp-content/plugins/email-subscription-box-after-post-content/images/bg.png') no-repeat;
height:200px;
width:500px;
}
.btn{
background:url('<?php echo get_bloginfo('url'); ?>/wp-content/plugins/email-subscription-box-after-post-content/images/subscribe-bt.png') no-repeat;
height:36px;
width:135px;
border:none;
outline:none;
position:relative;
top:-35px;
}
.emsb{
float:left;
text-align:left;
position:relative;
left:20px;
top:60px;
}
.txt{
font-family:"Trebucant MS",Arial;
font-weight:bold;
text-align:left;

}

.emsb-rss{
float:right;
background:url('<?php echo get_bloginfo('url'); ?>/wp-content/plugins/email-subscription-box-after-post-content/images/rss.png') no-repeat;
width:89px;
height:92px;
position:relative;
top:66px;
right:38px;

}
</style>
<div class="fform">
<a href="<?php echo get_option('rss'); ?>" target="_blank"><div class="emsb-rss"></div></a>
<form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('<?php echo get_option('email'); ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true" class="emsb">
<p class="txt" style="font-size:16px;">Enter Your Mail Address</p>
<p><input type="text" size="32" style="height:23px;" name="email"/></p>
<input type="hidden" value="<?php echo get_option('fid'); ?>" name="uri"/>
<input type="hidden" name="loc" value="en_US"/>
<p><input type="submit" value="." class="btn" /></p>
</form>
</div> 
<?php
}
else
{
echo $content;
}
}
?>
<?php 
function email_sub() {
?>
<h2>Email Subscription Box After Post</h2><br><form method="post"  action="options.php"><?php wp_nonce_field('update-options'); ?>
<p>RSS : <input type="text" size="60" name="rss" id="rss" value="<?php echo get_option('rss'); ?>" /> <span style="color:#cccccc;"> Ex: <i>http://feeds.feedburner.com/FEEDNAME</i></span></p><br><p>Email : <input type="text" size="60" name="email" id="email" value="<?php echo get_option('email'); ?>" /><span style="color:#cccccc;"> Ex: <i>http://feedburner.google.com/fb/a/mailverify?uri=FEEDNAME</i></span></p><br><p>Feed ID : <input type="text" value="<?php echo get_option('fid'); ?>" name="fid" id="fid" size="60" /><span style="color:#cccccc;"> Ex: <i>FEEDNAME</i></span></p><input type="submit" value="<?php _e('Update Settings')?>" /><input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="rss,email,fid" />
</form>
<br>


<?php
}
?>