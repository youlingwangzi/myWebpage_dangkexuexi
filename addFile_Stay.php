<?php 
if($_SESSION['ISLOGIN']){
	if($_POST['submitUser']){
		if(1){
		$sql = "insert into file_stay(stu_id, name, iden_id, depart, education_level, file_content, reason, object, phone_num, gra_year) values('".$_POST['stu_id']."','".$_POST['name']."','".$_POST['iden_id']."','".$_POST['depart']."','".$_POST['education_level']."','".$_POST['file_content']."','".$_POST['reason']."','".$_POST['object']."','".$_POST['phone_num']."','".$_POST['gra_year']."');";
		mysql_query($sql);
		echo "<h1>继续添加档案</h1>";
		}else{
			echo "<h1>请确保各项填写正确</h1>";
		}
		?>
		<form action = "mainAdmin.php?fid=2&mid=6" method = "post">
			<table>
			
			<tr>
			<td>学号：</td>
			<td><input type = "text" name = "stu_id" style="width:200px"></td>
			</tr>
			<tr>
			<td>姓名：</td>
			<td><input type = "text" name = "name" style="width:200px"></td>
			</tr>
			<tr>
			<td>身份证号：</td>
			<td><input type = "text" name = "iden_id" style="width:200px"></td>
			</tr>
			<tr>
			<td>院系：</td>
			<td><input type = "text" name = "depart" style="width:200px"></td>
			</tr>
			<tr>
			<td>学历层次：</td>
			<td><input type = "text" name = "education_level" style="width:200px"></td>
			</tr>
			<tr>
			<td>档案内容：</td>
			<td><input type = "text" name = "file_content" style="width:200px"></td>
			</tr>
            <tr>
			<td>留校原因：</td>
			<td><input type = "text" name = "reason" style="width:500px"></td>
			</tr>
			<tr>
			<td>专业：</td>
			<td><input type = "text" name = "object" style="width:500px"></td>
			</tr>
          
            <tr>
			<td>手机号码：</td>
			<td><input type = "text" name = "phone_num" style="width:200px"></td>
			</tr>	
            
             <tr>
			<td>毕业年份：</td>
			<td><input type = "text" name = "gra_year" style="width:200px"></td>
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
			echo "<h1>添加遗留档案</h1>";
			?>
			<form action = "mainAdmin.php?fid=2&mid=6" method = "post">
			<table>
			
			<tr>
			<td>学号：</td>
			<td><input type = "text" name = "stu_id" style="width:200px"></td>
			</tr>
			<tr>
			<td>姓名：</td>
			<td><input type = "text" name = "name" style="width:200px"></td>
			</tr>
			<tr>
			<td>身份证号：</td>
			<td><input type = "text" name = "iden_id" style="width:200px"></td>
			</tr>
			<tr>
			<td>院系：</td>
			<td><input type = "text" name = "depart" style="width:200px"></td>
			</tr>
			<tr>
			<td>学历层次：</td>
			<td><input type = "text" name = "education_level" style="width:200px"></td>
			</tr>
			<tr>
			<td>档案内容：</td>
			<td><input type = "text" name = "file_content" style="width:200px"></td>
			</tr>
            <tr>
			<td>留校原因：</td>
			<td><input type = "text" name = "reason" style="width:500px"></td>
			</tr>
			<tr>
			<td>专业：</td>
			<td><input type = "text" name = "object" style="width:500px"></td>
			</tr>
          
            <tr>
			<td>手机号码：</td>
			<td><input type = "text" name = "phone_num" style="width:200px"></td>
			</tr>	
            
             <tr>
			<td>毕业年份：</td>
			<td><input type = "text" name = "gra_year" style="width:200px"></td>
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