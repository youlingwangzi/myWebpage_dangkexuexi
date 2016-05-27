<?php 
if($_SESSION['ISLOGIN']){
	if($_POST['submitUser']){
		if(1){
		$sql = "update file_stay set stu_id='".$_POST['stu_id']."', name='".$_POST['name']."', iden_id='".$_POST['iden_id']."', depart='".$_POST['depart']."', education_level='".$_POST['education_level']."', file_content='".$_POST['file_content']."', reason='".$_POST['reason']."', object='".$_POST['object']."', phone_num='".$_POST['phone_num']."', gra_year='".$_POST['gra_year']."' where id=".$_POST['userId'].";";
		mysql_query($sql);
		echo $sql;
		echo "<h1>遗留档案信息已更新</h1>";
		}else{
			echo "<h1>请确保各项填写正确</h1>";
		}
		?>
		<a href="mainAdmin.php?fid=2&mid=2"><table><tr><td><img src="back.png" width="40px"> </img></td><td>返回上一级</td></tr></table></a>
		<?php
	}
	else{
		if($_SESSION['USERAUTHORITY']){
			echo "<h1>编辑遗留档案</h1>";
			$sql = "select * from file_stay where id=".$_POST['userId'].";";
			echo $sql;
			$query = mysql_query($sql);
			$row = mysql_fetch_array($query)
			?>
			
			<form action = "mainAdmin.php?fid=2&mid=8" method = "post">
			<table>
			
			<tr>
			<input type="hidden" name="userId" value="<?php echo $_POST['userId']?>">
			<td>学号：</td>
			<td><input type = "text" name = "stu_id" style="width:200px" value="<?php echo $row['stu_id']?>"></td>
			</tr>
			<tr>
			<td>姓名：</td>
			<td><input type = "text" name = "name" style="width:200px" value="<?php echo $row['name']?>"></td>
			</tr>
			<tr>
			<td>身份证号：</td>
			<td><input type = "text" name = "iden_id" style="width:200px" value="<?php echo $row['iden_id']?>"></td>
			</tr>
			<tr>
			<td>院系：</td>
			<td><input type = "text" name = "depart" style="width:200px" value="<?php echo $row['depart']?>"></td>
			</tr>
			<tr>
			<td>学历层次：</td>
			<td><input type = "text" name = "education_level" style="width:200px" value="<?php echo $row['education_level']?>"></td>
			</tr>
			<tr>
			<td>档案内容：</td>
			<td><input type = "text" name = "file_content" style="width:200px" value="<?php echo $row['file_content']?>"></td>
			</tr>
            <tr>
			<td>留校原因：</td>
			<td><input type = "text" name = "reason" style="width:500px" value="<?php echo $row['reason']?>"></td>
			</tr>
			<tr>
			<td>专业：</td>
			<td><input type = "text" name = "object" style="width:500px" value="<?php echo $row['object']?>"></td>
			</tr>
          
            <tr>
			<td>手机号码：</td>
			<td><input type = "text" name = "phone_num" style="width:200px" value="<?php echo $row['phone_num']?>"></td>
			</tr>	
            
             <tr>
			<td>毕业年份：</td>
			<td><input type = "text" name = "gra_year" style="width:200px" value="<?php echo $row['gra_year']?>"></td>
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
			echo "<a href='mainAdmin.php?fid=2&mid=2'><table><tr><td><img src='back.png' width='40px'> </img></td><td>返回上一级</td></tr></table></a>" ;
		}
	}
}else{
	echo header("Location:index.php");
	echo "<p>请以管理员身份登陆添加。</p>";
}
?>