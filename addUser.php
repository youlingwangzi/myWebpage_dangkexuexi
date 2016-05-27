<?php 
if($_SESSION['ISLOGIN']){
	if($_POST['submitUser']){
		if(1){
		$sql = "insert into logins(username, password, isSuperAdmin, real_name, department, phone_number, e_mail) values('".$_POST['username']."','".$_POST['password']."','".$_POST['isSuperAdmin']."','".$_POST['real_name']."','".$_POST['department']."','".$_POST['phone_number']."','".$_POST['e_mail']."');";
		mysql_query($sql);
		echo "<h1>继续添加用户</h1>";
		}else{
			echo "<h1>请确保各项填写正确</h1>";
		}
		?>
		<form action = "mainAdmin.php?fid=1&mid=2" method = "post">
			<table>
			
			<tr>
			<td>用户名：</td>
			<td><input type = "text" name = "username" style="width:200px"></td>
			</tr>
			<tr>
			<td>姓名：</td>
			<td><input type = "text" name = "real_name" style="width:200px"></td>
			</tr>
			<tr>
			<td>密码：</td>
			<td><input type = "password" name = "password" style="width:200px"></td>
			</tr>
			<tr>
			<td>再次输入密码：</td>
			<td><input type = "password" name = "password2" style="width:200px"></td>
			</tr>
			<tr>
			<td>电子邮箱：</td>
			<td><input type = "text" name = "e_mail" style="width:200px"></td>
			</tr>
			<tr>
			<td>联系方式：</td>
			<td><input type = "text" name = "phone_number" style="width:200px"></td>
			</tr>
			<tr>
			<td>所属部门：</td>
			<td><input type = "text" name = "department" style="width:500px"></td>
			</tr>		
			<tr><td>是否为管理员：</td><td>
			<select name = "isSuperAdmin">
			<option value = '0'>否</option>
			<option value = '1'>是</option>
			</select></td>
			</tr>
			<tr>
			<td></td>
			<td><input type = "submit" name = "submitUser" value = "保存"></td>
			</tr>
			
			</table>
			</form>
		<?php
	}
	else{
		if($_SESSION['USERAUTHORITY']){
			echo "<h1>添加用户</h1>";
			?>
			<form action = "mainAdmin.php?fid=1&mid=2" method = "post">
			<table>
			
			<tr>
			<td>用户名：</td>
			<td><input type = "text" name = "username" style="width:200px"></td>
			</tr>
			<tr>
			<td>姓名：</td>
			<td><input type = "text" name = "real_name" style="width:200px"></td>
			</tr>
			<tr>
			<td>密码：</td>
			<td><input type = "password" name = "password" style="width:200px"></td>
			</tr>
			<tr>
			<td>再次输入密码：</td>
			<td><input type = "password" name = "password2" style="width:200px"></td>
			</tr>
			<tr>
			<td>电子邮箱：</td>
			<td><input type = "text" name = "e_mail" style="width:200px"></td>
			</tr>
			<tr>
			<td>联系方式：</td>
			<td><input type = "text" name = "phone_number" style="width:200px"></td>
			</tr>
			<tr>
			<td>所属部门：</td>
			<td><input type = "text" name = "department" style="width:500px"></td>
			</tr>
			<tr><td>是否为管理员：</td><td>
			<select name = "isSuperAdmin">
			<option value = '0'>否</option>
			<option value = '1'>是</option>
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
			echo "<h1>对不起你不是管理员，不能添加用户。</h1>";
			echo "<p>请联系系统管理员添加。</p>";
		}
	}
}else{
	echo "<h1>对不起你没有登录，不能添加用户。</h1>";
	echo "<p>请以管理员身份登陆添加。</p>";
}
?>