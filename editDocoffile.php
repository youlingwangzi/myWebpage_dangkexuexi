<?php 
if($_SESSION['ISLOGIN']){
	if($_POST['submitUser']){
		if(1){
		$sql = "update doc_of_file set title='".$_POST['title']."',author='".$_POST['author']."',date='".$_POST['date']."',content='".$_POST['content']."',path='".$_POST['path']."' where id=".$_POST['userId'].";";
		mysql_query($sql);
		echo $sql;
		echo "<h1>用户信息已更新</h1>";
		}else{
			echo "<h1>请确保各项填写正确</h1>";
		}
		?>
		<a href="mainAdmin.php?fid=2&mid=3"><table><tr><td><img src="back.png" width="40px"> </img></td><td>返回上一级</td></tr></table></a>
		<?php
	}
	else{
		if($_SESSION['USERAUTHORITY']){
			echo "<h1>编辑档案文件</h1>";
			$sql = "select * from doc_of_file where id=".$_POST['userId'].";";
			//echo $sql;
			$query = mysql_query($sql);
			$row = mysql_fetch_array($query)
			?>
			
			<form action = "mainAdmin.php?fid=2&mid=13" method = "post">
			<table>
			
			<tr>
			<input type="hidden" name="userId" value="<?php echo $_POST['userId']?>">
			<td>文件标题：</td>
			<td><input type = "text" name = "title" style="width:200px" value="<?php echo $row['title']?>"></td>
			</tr>
			<tr>
			<td>上传者：</td>
			<td><input type = "text" name = "author" style="width:200px" value="<?php echo $row['author']?>"></td>
			</tr>
			<tr>
			<td>更新时间：</td>
			<td><input type = "text" name = "date" style="width:200px" value="<?php echo $row['date']?>"></td>
			</tr>
			<tr>
			<td>内容：</td>
			<td><input type = "text" name = "content" style="width:200px" value="<?php echo $row['content']?>"></td>
			</tr>
            
			<tr>
			<td></td>
			<td><input type = "submit" name = "submitUser" value = "保存"></td>
			</tr>
			
			</table>
			</form>
			<?php
		}else{
			echo "<h1>对不起你不是管理员。</h1>";
			echo "<p>请联系系统管理员。</p>";
			echo "<a href='mainAdmin.php?fid=2&mid=3'><table><tr><td><img src='back.png' width='40px'> </img></td><td>返回上一级</td></tr></table></a>" ;
		}
	}
}else{
	echo header("Location:index.php");
	echo "<p>请以管理员身份登陆添加。</p>";
}
?>