<tr><td id = "userCenter">
<?php
if(!$_SESSION['ISLOGIN']){
	reader("Location:index.html");
}
else{
	if($_SESSION['USERAUTHORITY']){
		echo "<h3>尊敬的超级管理员：<br/>".$_SESSION['USERNAME']."欢迎你！</h3></br>";
		?>
		<table>
		<tr><td class = "addArticleButton"><a href = "mainAdmin.php?fid=3">■个人资料修改</a></td></tr>
		<tr>
		</table>
		<?php
	}
	else{
		echo "<h3>".$_SESSION['USERNAME']."同学，你好！<br/>欢迎你！</h3>";
		?>
		<table>
		<tr><td class = "addArticleButton"><td class = "addArticleButton"><a href = "mainAdmin.php?fid=3">■个人资料修改</a></td></tr>
		</table>
		<?php
	}
}
?>
</td></tr>