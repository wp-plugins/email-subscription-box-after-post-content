<?php

/*
Plugin Name: Email Subscription Box After Post Content
Plugin URI: http://cre8tivenerd.com/2010/07/email-subscription-box-after-post-content-wordpress-plugin/
Description: This plugin will help you to insert email subscription box after post content
Version: 1.1
Author: Kannan Sanjeevan
Author URI: http://www.cre8tivenerd.com
License: GPL
*/


add_option("c8n_rss" , "http://feeds.feedburner.com/FEEDID"  , "RSS Feed Link" , "yes" );
add_option("c8n_email" , "http://feedburner.google.com/fb/a/mailverify?uri=FEEDID", "Email Subscribe Link" , "yes" );
add_option("c8n_feedid" , "FEEDID"  , "Feed ID" , "yes" );
add_action("admin_menu" , 'admin_panel_c8n');
add_action("the_content" , 'email_content_c8n');
add_action('wp_head', 'email_content_style_c8n');

function email_content_style_c8n(){
		
        $EmailStyleCss = "<link rel='stylesheet' href='" . get_bloginfo('wpurl') . "/wp-content/plugins/email-subscription-box-after-post-content/emailS.css' />";
       
       echo $EmailStyleCss;

}
   	


function admin_panel_c8n(){
	
add_options_page("Email Subscription Box After Post Content Options" , "Email Subscription Box After Post Content" , "administrator" , "email-subscribe" , "email_subscribe");

}

function email_subscribe(){
	
	$email_subscribe = "<div id='ES_form'><h2>Email Subscription Box After Post Content - Details </h2>" . "</br>" ;
	$email_subscribe .= "<form method='post' action='options.php'>" . wp_nonce_field('update-options');
	$email_subscribe .= "<p>RSS : <input type='text' size='100' name= 'c8n_rss' id='rss' value= '" . get_option(c8n_rss) . "' /></p>" . "<br/>" ;
	$email_subscribe .= "<p>EMAIL : <input type='text' size='100' name= 'c8n_email' id='email' value= '" . get_option(c8n_email) . "' /></p>" . "<br/>" ;
	$email_subscribe .= "<p>FEED ID : <input type='text' size='30' name= 'c8n_feedid' id='feedid' value= '" . get_option(c8n_feedid) . "' /></p>" . "<br/>" ;
	$email_subscribe .= "<input type='submit' value='Update Settings' /><input type='hidden' name='action' value='update' /><input type='hidden' name='page_options' value='c8n_rss,c8n_email,c8n_feedid' /></form></div>"; 
	
	echo $email_subscribe;
}

function email_content_c8n($content){
	
	$email_box_content = "<div class='fform'><a href=" . get_option('c8n_rss') . " target='_blank'><div class='emsb-rss'></div></a>
			<form action='http://feedburner.google.com/fb/a/mailverify' method='post' target='popupwindow' onsubmit='window.open(" . get_option('c8n_email') . ", 'popupwindow', 'scrollbars=yes,width=550,height=520');return true' class='emsb'><p class='txt' style='font-size:16px;'>Enter Your Mail Address</p><p><input type='text' size='32' style='height:23px;' name='email'/></p><input type='hidden' value=" . get_option('c8n_feedid') . " name='uri'/><input type='hidden' name='loc' value='en_US'/><p><input type='submit' value='.' class='btn' /></p></form></div>";
			
			
	if(!is_single()){
		return $content;
	}else{
    	return $content . $email_box_content;
	}
}
?>