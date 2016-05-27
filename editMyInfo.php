<?php 
if($_SESSION['ISLOGIN']){
	if($_POST['submitUser']){
		if(1){
		$sql = "update logins set username='".$_POST['username']."',real_name='".$_POST['real_name']."',e_mail='".$_POST['e_mail']."',department='".$_POST['department']."',phone_number='".$_POST['phone_number']."',isSuperAdmin=".$_POST['isSuperAdmin']." where id=".$_POST['userId'].";";
		mysql_query($sql);
		//echo $sql;
		echo "<h1>个人信息已更新</h1>";
		}else{
			echo "<h1>请确保各项填写正确</h1>";
		}
		?>
		<a href="mainAdmin.php?fid=1&mid=1"><table><tr><td><img src="back.png" width="40px"> </img></td><td>返回</td></tr></table></a>
		<?php
	}
	else{
		if($_SESSION['USERAUTHORITY']){
			echo "<h1>编辑个人信息</h1>";
			$sql = "select * from logins where id=".$_SESSION['USERID'].";";
			echo $sql;
			$query = mysql_query($sql);
			$row = mysql_fetch_array($query)
			?>
			
			<form action = "mainAdmin.php?fid=3" method = "post">
			<table>
			
			<tr>
			<input type="hidden" name="userId" value="<?php echo $_SESSION['USERID']?>">
			<td>用户名：</td>
			<td><input type = "text" name = "username" style="width:200px" value="<?php echo $row['username']?>"></td>
			</tr>
			<tr>
			<td>姓名：</td>
			<td><input type = "text" name = "real_name" style="width:200px" value="<?php echo $row['real_name']?>"></td>
			</tr>
			<tr>
			<td>电子邮箱：</td>
			<td><input type = "text" name = "e_mail" style="width:200px" value="<?php echo $row['e_mail']?>"></td>
			</tr>
			<tr>
			<td>联系方式：</td>
			<td><input type = "text" name = "phone_number" style="width:200px" value="<?php echo $row['phone_number']?>"></td>
			</tr>
			<tr>
			<td>所属部门：</td>
			<td><input type = "text" name = "department" style="width:500px" value="<?php echo $row['department']?>"></td>
			</tr>
			<tr><td>是否为管理员：</td><td>
			<select name = "isSuperAdmin">
			<?php 
				if($row['isSuperAdmin']==1)
					echo "<option value = '1'>是</option><option value = '0'>否</option>";
				else
					echo "<option value = '0'>否</option><option value = '1'>是</option>";
			?>
			</select></td>
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
			echo "<a href='mainAdmin.php?fid=1&mid=1'><table><tr><td><img src='back.png' width='40px'> </img></td><td>返回上一级</td></tr></table></a>" ;
		}
	}
}else{
	echo header("Location:index.php");
	echo "<p>请以管理员身份登陆添加。</p>";
}
?>