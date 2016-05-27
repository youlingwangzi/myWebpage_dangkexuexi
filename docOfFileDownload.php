<?php 
if($_SESSION['ISLOGIN']){
	if($_SESSION['USERAUTHORITY']){
		$sql = "select * FROM doc_of_file WHERE id=".$_POST['userId'].";";
		mysql_query($sql);
		
		//echo $sql;
		echo "<h1>记录已删除</h1>";
		?>
		<a href="mainAdmin.php?fid=2&mid=3"><table><tr><td><img src="back.png" width="40px"> </img></td><td>返回上一级</td></tr></table></a>
		<?php
	}else{
		echo "<h1>对不起你不是管理员。</h1>";
		echo "<p>请联系系统管理员。</p>";
		echo "<a href='mainAdmin.php?fid=2&mid=3'><table><tr><td><img src='back.png' width='40px'> </img></td><td>返回上一级</td></tr></table></a>" ;
	}
}else{
	echo header("Location:index.php");
	echo "<p>请以管理员身份登陆添加。</p>";
}
?>