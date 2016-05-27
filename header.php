<?php
session_start();
error_reporting(0);
require("config.php");
$db = mysql_connect($dbhost,$dbuser,$dbpassword);
mysql_query("set names 'utf8' ");
mysql_query("set character_set_client=utf8");
mysql_query("set character_set_results=utf8");
mysql_select_db($dbdatabase, $db);

if($_GET['logout']){
	session_unset();
	session_destroy();
}
?>

<!DOCTYPE HTML>

<html>

<head>
<title><?php echo $config_blogname;?></title>
<link rel = "stylesheet" href = "stylesheet.css" type = "text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script language = "javascript" src="jquery-1.11.3.min.js">
</script>
<script language = "javascript">
$(document).ready(function(){
	
	$(".login_button").hover(function(){
		$('.user_bar').fadeIn(200);
	}
	);
	$(".user_bar").hover(function(){
	},
	function(){
		$('.user_bar').fadeOut(200);
	}
	);
});
</script>

</head>
<body>
<div id = "header">
<table align = "center">
	<tr><td align = "center" width = "60px"><img src = "专业徽标3.png"></td><td><h1><?php printf("%s", $config_blogname);?></h1></td></tr>
</table>
</div>
<div id = "menu">
<table>
<tr>
<td class = "no1">
<p>欢迎使用<?php printf("%s", $config_blogname);?>！</p>
</td>
<td class = "no2">
<div class = "main_menu">
<?php
if($_SESSION['ISLOGIN']){
	?>
	<a class = "login_button">〓</a>
	<?php
	echo $_SESSION['USERNAME']."，欢迎你！";
	?>
	<div class = "user_bar">
	<a class = "login_button">〓</a>
	<?php
	echo $_SESSION['USERNAME']."，欢迎你！";
	?>
	<br/><br/><a class = chapter_menu  href = "mainAdmin.php?fid=3">个人资料修改■</a><br/>
	<br/><br/><a class = "login_button" href = "index.php?logout=1">注销●</a>
	</div>
	<?php
}
else{
	header("Location: index.php");
}
?>

</div>
</td>
</tr>
</table>
</div>
<div id = "container">