<?php 
 include('user.php');
 use userlib\User;
 $user = new User();


 if(isset($_POST['login'])){
 	$username = $_POST['username'];
 	$pass = $_POST['password'];
 	$login_check = $user->login($username,$pass);

 	if($login_check){
 		header("Location:../dashboard/");
 	}else{
 		header("Location:../login.php");
 	}
 }else{
 	header("Location:../error-404.html");
 }


//  $login_check = $user->logout();
// $user->check_logged_in(false);
//  if($login_check){
//  	echo "<pre>";
//  	print_r($login_check);
//  }else{
//  	echo "dishum;";
//  }
 
?>