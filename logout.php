<?php 
 include('inc/user.php');
 include('inc/settings.php');
 use userlib\User;
 $user = new User();
 use webSettings\Settings;
 $settings = new Settings();
 $site_config = $settings->get_settng_for_user();


 $logout_check = $user->logout();

 if($logout_check){
	header("Location:".$site_config->admin_url."login.php");
	
 }else{
	header("Location:".$site_config->admin_url."dashboard");
 }