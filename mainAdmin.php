<?php 
require("header.php");

if(isset($_GET['fid']) == false){
	$functionId = 0;
	$menuId = 0;
}else{
	$functionId = $_GET['fid']; 
	$menuId = $_GET['mid']; 
}
?>

<script language = "javascript">
$(document).ready(function(){
	$(".cat_list_dt").siblings().hide();
	$(".cat_list_dt").click(function(){
		if($(this).siblings().is(":hidden")){
			$(this).siblings().show(200);
		}else{
			$(this).siblings().hide(200);
		}
	});
});
</script>

<table>
<tr>
<td id = "bar">
<table>
<?php
require("userCenter.php");
?>
<tr><td class = "bar_line" ></td></tr>
<tr style = "padding:0px"><td>
<a class = adminCt href = 'mainAdmin.php'><p class = cat_list>管理中心>></p></a></td></tr>

<tr><td class = "bar_line" ></td></tr>
<tr><td>

<?php
	//if($functionId == 0 && $menuId == 0){
 		echo "<dl><dt class = cat_list_dt_on><h3>基本信息</h3></dt>";
		echo "<dd><p class = articleList><a href = 'mainAdmin.php?mid=1&fid=1'>▎用户管理</a></p></dd></dl>";
		echo "<dl><dt class = cat_list_dt_on><h3>档案管理</h3></dt>";
		echo "<dd><p class = articleList><a href = 'mainAdmin.php?mid=1&fid=2'>▎档案文件</a></p></dd>";
		echo "<dd><p class = articleList><a href = 'mainAdmin.php?mid=2&fid=2'>▎遗留档案</a></p></dd>";
		echo "<dd><p class = articleList><a href = 'mainAdmin.php?mid=3&fid=2'>▎档案信息</a></p></dd></dl>";
	/*}
	elseif($functionId == 1 && ($menuId == 1 || $menuId == 2 || $menuId == 3 || $menuId == 6)){
		echo "<dl><dt class = cat_list_dt_on><h3>基本信息</h3></dt>";
		echo "<dd><p class = importPart>▎用户管理</p></dd></dl>";
		echo "<dl><dt class = cat_list_dt><h3>档案管理</h3></dt>";
		echo "<dd><p class = articleList><a href = 'mainAdmin.php?mid=1&fid=2'>▎档案文件</a></p></dd>";
		echo "<dd><p class = articleList><a href = 'mainAdmin.php?mid=2&fid=2'>▎遗留档案</a></p></dd>";
		echo "<dd><p class = articleList><a href = 'mainAdmin.php?mid=3&fid=2'>▎档案信息</a></p></dd></dl>";
	}
	elseif($functionId == 2 && $menuId == 1){
		echo "<dl><dt class = cat_list_dt><h3>基本信息</h3></dt>";
		echo "<dd><p class = articleList><a href = 'mainAdmin.php?mid=1&fid=1'>▎用户管理</a></p></dd></dl>";
		echo "<dl><dt class = cat_list_dt_on><h3>档案管理</h3></dt>";
		echo "<dd><p class = importPart>▎档案文件</p></dd>";
		echo "<dd><p class = articleList><a href = 'mainAdmin.php?mid=2&fid=2'>▎遗留档案</a></p></dd>";
		echo "<dd><p class = articleList><a href = 'mainAdmin.php?mid=3&fid=2'>▎档案信息</a></p></dd></dl>";
	}
	elseif($functionId == 2 && $menuId == 2){
		echo "<dl><dt class = cat_list_dt><h3>基本信息</h3></dt>";
		echo "<dd><p class = articleList><a href = 'mainAdmin.php?mid=1&fid=1'>▎用户管理</a></p></dd></dl>";
		echo "<dl><dt class = cat_list_dt_on><h3>档案管理</h3></dt>";
		echo "<dd><p class = articleList><a href = 'mainAdmin.php?mid=1&fid=2'>▎档案文件</a></p></dd>";
		echo "<dd><p class = importPart>▎遗留档案</p></dd>";
		echo "<dd><p class = articleList><a href = 'mainAdmin.php?mid=3&fid=2'>▎档案信息</a></p></dd></dl>";
	}
	elseif($functionId == 2 && $menuId == 3){
		echo "<dl><dt class = cat_list_dt><h3>基本信息</h3></dt>";
		echo "<dd><p class = articleList><a href = 'mainAdmin.php?mid=1&fid=1'>▎用户管理</a></p></dd></dl>";
		echo "<dl><dt class = cat_list_dt_on><h3>档案管理</h3></dt>";
		echo "<dd><p class = articleList><a href = 'mainAdmin.php?mid=1&fid=2'>▎档案文件</a></p></dd>";
		echo "<dd><p class = articleList><a href = 'mainAdmin.php?mid=2&fid=2'>▎遗留档案</a></p></dd>";
		echo "<dd><p class = importPart>▎档案信息</p></dd></dl>";
	}*/
?>
</dl>
</td></tr>
</table>
</td>

<td id = "main_body">
<?php 

	if($functionId == 0 && $menuId == 0){
		require("adminCenter.php");
	}
	elseif($functionId == 1 && $menuId == 1){
		require("userAdmin.php");
	}
	elseif($functionId == 1 && $menuId == 2){
		require("addUser.php");
	}
	elseif($functionId == 1 && $menuId == 3){
		require("editUser.php");
	}
	elseif($functionId == 1 && $menuId == 4){
		require("deleteUser.php");
	}
	elseif($functionId == 1 && $menuId == 6){
		require("userImport.php");
	}
	elseif($functionId == 2 && $menuId == 1){
		require("FileAdmin.php");
	}
	elseif($functionId == 2 && $menuId == 2){
		require("fileStayAdmin.php");
	}
	elseif($functionId == 2 && $menuId == 8){
		require("editFileStay.php");
	}
	elseif($functionId == 2 && $menuId == 9){
		require("addFile_Stay.php");
	}
	elseif($functionId == 2 && $menuId == 11){
		require("fileStayImport.php");
	}
	elseif($functionId == 2 && $menuId == 4){
		require("addFile.php");
	}
	elseif($functionId == 2 && $menuId == 5){
		require("editFile.php");
	}
	elseif($functionId == 2 && $menuId == 6){
		require("deleteFile.php");
	}
	elseif($functionId == 2 && $menuId == 7){
		require("fileImport.php");
	}
	elseif($functionId == 2 && $menuId == 3){
		require("DocoffileAdmin.php");
	}
	elseif($functionId == 2 && $menuId == 12){
		require("addDocoffile.php");
	}
	elseif($functionId == 2 && $menuId == 13){
		require("editDocoffile.php");
	}
	elseif($functionId == 2 && $menuId == 14){
		require("deleteDocoffile.php");
	}
	elseif($functionId == 2 && $menuId == 15){
		require("docoffileImport.php");
	}
	elseif($functionId == 3){
		require("editMyInfo.php");
	}

?>

</td>
</tr>
</table>

<?php 
//	$sql = "SELECT id,username,real_name,department,phone_number,isSuperAdmin,e_mail FROM logins WHERE username like %".$_POST['']."% and real_name like %".$_POST['real_name']."% and isSuperAdmin=".$_POST['isSuperAdmin']." and department like %".$_POST['department']."%;"; 
require("footer.php");?>