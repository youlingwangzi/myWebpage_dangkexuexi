<?php 
error_reporting(0);
if($_SESSION['ISLOGIN']){
	if(isset($_POST['sub'])){
		if(1){
			echo "<h1>继续添加文件</h1>";
			require("fileupload.php");
			$sql = "insert into doc_of_file(author, title, date, content, path) values('".$_SESSION['USERNAME']."','".$_POST['title']."','".date("Y-m-d")."','".$_POST['content']."','".$path."');";
			//echo $sql;
			mysql_query($sql);
		}else{
			echo "<h1>请确保各项填写正确</h1>";
		}
		?>
	<?php
	}
	else{
		if($_SESSION['USERAUTHORITY']){
			echo "<h1>添加文件</h1>";
			require("fileupload.php");
		}else{
			echo "<h1>对不起你不是管理员，不能添加用户。</h1>";
			echo "<p>请联系系统管理员添加。</p>";
		}
	}
}else{
	echo "<h1>对不起你没有登录，不能添加用户。</h1>";
	echo "<p>请以管理员身份登陆添加。</p>";
}
?>