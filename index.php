<?php
session_start();
error_reporting(0);
require("config.php");
$db = mysql_connect($dbhost,$dbuser,$dbpassword);
mysql_query("set names 'utf8' ");
mysql_query("set character_set_client=utf8");
mysql_query("set character_set_results=utf8");
mysql_select_db($dbdatabase, $db);
if($_POST['submit']){
	if($_POST['code_num'] != $_SESSION['helloweba_num'])
		header("Location: index.php?error=1");
	else{
		$sql = "select * from logins where username = '".$_POST['username']."'and password = '".$_POST['password']."';";
		$result = mysql_query($sql);
		$numrows = mysql_num_rows($result);
		if($numrows == 1){
			$row = mysql_fetch_assoc($result);
			$_SESSION['USERNAME'] = $row['username'];
			$_SESSION['USERID'] = $row['id'];
			$_SESSION['USERAUTHORITY'] = $row['isSuperAdmin'];
			$_SESSION['LAST_ARTICLE'] = $row['last_article'];	
			$sql = "select * from article where id = '".$_SESSION['LAST_ARTICLE']."';";
			$result = mysql_query($sql);
			$row2 = mysql_fetch_assoc($result);
			$_SESSION['LAST_ARTICLE_CAT_ID'] = $row2['cat_id'];
			$_SESSION['ISLOGIN'] = 1;
			header("Location: index.php");
		}
		else{
			header("Location: index.php?error=2");
		}
	}
}
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

</head>
<body>

</td>
</tr>
</table>
</div>
<link rel="stylesheet" href="jQuery.isc/jQuery.isc.css" type="text/css" media="screen" charset="utf-8">
<script src="jQuery.isc/jquery-image-scale-carousel.js" type="text/javascript" charset="utf-8"></script>
<script>
var carousel_images = [
	"aboutUsPhoto/0.jpg",
	"aboutUsPhoto/2.jpg",
	"aboutUsPhoto/7.jpg",
	"aboutUsPhoto/9.jpg",
	"aboutUsPhoto/11.jpg",
	"aboutUsPhoto/13.jpg",
	"aboutUsPhoto/14.jpg",
	"aboutUsPhoto/17.jpg",
	"aboutUsPhoto/4.jpg"
];
$(window).load(function(){
	$("#photo_container_home").isc({
		imgArray:carousel_images,
		autoplay:true,
	    autoplayTimer:5000
	});
});
</script>
<div id = "container_main_page">
<div id="photo_container_home">
<div id = "login_home_body">

<div id = "header_main_page">
<table align = "center">
	<tr><td align = "center" width = 60><img src = "专业徽标3.png"></td><td><h1><?php printf("%s", $config_blogname);?></h1></td></tr>
</table>
</div>
<div id = "header_main_page2">
<table align = "center">
	<tr></td><td><h1><?php printf("%s", $config_blogname);?></h1></td></tr>
</table>
</div>

<div class = "login_home">
<table align = "center">
<tr>
<td align = "center">
<?php
if(!$_SESSION['ISLOGIN']){
	?>
	<h3>你还没有登录</h3>
	<form action = "index.php?i=5" method = "post">
	<table>
	<tr><td class = "no2" style="width:80px">用户名：</td><td class = "no2"colspan="2">
	<input type = "text" name = "username" style="width:169px">
	</td></tr>
	<tr><td class = "no2" style="width:80px">密码：</td><td class = "no2"colspan="2"><input type = "password" name = "password" style="width:169px" ></td></tr>
	<tr><td class = "no2" style="width:80px">验证码：</td><td class = "no2"><input type="text" class="input" name="code_num" style="width:105px"/><td> <a href = "index.php"><img src="code_num.php" id="getcode_num" align="absmiddle" onclick="src='code_num.php';" /></a></td></tr>
	<tr><td></td><td colspan="2">
	<?php
		if($_GET['error'] == 1) 
			echo "<p class = importPart> 验证码错误！</p>";
		else if($_GET['error'] == 2) 
			echo "<p class = importPart> 用户名或密码错误！</p>";
	?></td></tr>
	<tr>
	<td><!--a class = "cat" href = "register.php">注册</a!--></td><td class = "no2"><input type = "submit" name = "submit" value = "登录"></td>
	</tr>
	</table>
	</form>
	<?php
}
else{
	
	$_SESSION['sql-user']="select * from logins";
	$_SESSION['sql-file']="select * from file_doc";
	$_SESSION['sql-file_stay']="select * from file_stay";
	$_SESSION['sql-docoffile']="select * from doc_of_file";

	header("Location:http://127.0.0.1/file_admin_sys/mainAdmin.php");
}
?>
</td>
</tr>
</table>
</div>
</div>
</div>

</div>

<!--div id = "footer2">
</div!-->
<div id = "footer">
<h1>&copy;<?php echo $config_author;?></h1>
</div>
</body>

</html>