<table ><tr><td><h1>用户管理</h1></td><td><td width=350> </td><td class="addnew" align = right>
<?php
if($_SESSION['USERAUTHORITY']){
	echo "<a href = 'mainAdmin.php?fid=1&mid=2'>增加新用户<img src='add.png' width='13px'></img></a>";
	echo "<a href = 'userExport.php'>导出<img src='downLoad.jpg' width='16px'></img></a>";
	echo "<a href = 'mainAdmin.php?fid=1&mid=6'>导入<img src='upLoad.jpg' width='16px'></img></a>";
}
 ?>
</td></tr></table>

<link rel = "stylesheet" href = "page.css" type = "text/css" />
<?php
require_once('page.class.php'); //分页类 
$showrow = 7; //一页显示的行数 
$curpage = empty($_GET['page']) ? 1 : $_GET['page']; //当前的页,还应该处理非数字的情况 
$url = "?fid=1&mid=1&page={page}"; //分页地址，如果有检索条件 ="?page={page}&q=".$_GET['q'] 
//省略了链接mysql的代码，测试时自行添加 
if($_POST['submitSearch']){
	if($_POST['isSuperAdmin']==2){
		$_SESSION['sql-user'] = "SELECT * FROM logins WHERE username LIKE '%".$_POST['username']."%' AND real_name LIKE '%".$_POST['real_name']."%' AND isSuperAdmin<2 AND department LIKE '%".$_POST['department']."%'"; 
	}
	elseif($_POST['isSuperAdmin']==1){
		$_SESSION['sql-user'] = "SELECT * FROM logins WHERE username LIKE '%".$_POST['username']."%' AND real_name LIKE '%".$_POST['real_name']."%' AND isSuperAdmin=1 AND department LIKE '%".$_POST['department']."%'"; 
	}else{
		$_SESSION['sql-user'] = "SELECT * FROM logins WHERE username LIKE '%".$_POST['username']."%' AND real_name LIKE '%".$_POST['real_name']."%' AND isSuperAdmin=0 AND department LIKE '%".$_POST['department']."%'"; 
	}
}
//echo $_SESSION['sql-user'];
$total = mysql_num_rows(mysql_query($_SESSION['sql-user'])); //记录总条数 
if (!empty($_GET['page']) && $total != 0 && $curpage > ceil($total / $showrow)) 
    $curpage = ceil($total_rows / $showrow); //当前页数大于最后页数，取最后一页 
//获取数据 
$sql=$_SESSION['sql-user']." LIMIT " . ($curpage - 1) * $showrow . ",$showrow;"; 
$query = mysql_query($sql);
?>

<table style="margin-bottom:20px;border-collapse:collapse;" cellspacing="0">
<form action="mainAdmin.php?fid=1&mid=1&search=1" method="POST">
<tr>
<td class="search_title">用户名：</td>
<td class="search_content"><input type="text" name="username" style="width:150"></td>
<td class="search_title">姓名：</td>
<td class="search_content"><input type="text" name="real_name" style="width:150"></td>
</tr>
<tr>
<td class="search_title">身份：</td>
<td class="search_content"><select name = "isSuperAdmin"><option value=2>所有</option><option value = 0>用户</option><option value = 1>管理员</option></select></td>
<td class="search_title">部门：</td>
<td class="search_content"><input type="text" name="department" style="width:150"></td>
<td class="search_title"><input type ="submit" name="submitSearch" value = "查询"></td>
</tr>
<input type="hidden" name="fid" value = 1/>
<input type="hidden" name="mid" value = 1/>
</form>
</table>


<table> 
<tr>
<td></td><td></td><td></td><td></td>
</tr>
</table>
<table class="dates" cellspacing="0"> 

	<tr> 
		<td class = "username-t">		<span><?php echo "用户名" ?></span> </td>
		<td class = "real_name-t">		<span><?php echo "姓名" ?></span> </td>
		<td class = "department-t">		<span><?php echo "所在部门" ?></span> </td>
		<td class = "phone_number-t">	<span><?php echo "联系方式" ?></span> </td>
		<td class = "e_mail-t">	<span><?php echo "电子邮箱" ?></span> </td>
		<td class = "isSuperAdmin-t">	<span><?php echo "权限" ?></span> </td>
		<td class = "function-t">	<span>操作</span> </td>
    </tr> 
    <?php while ($row = mysql_fetch_array($query)) { ?> 
        <tr> 
            <td class = "username">		<span><?php echo $row['username'] ?></span> </td>
			<td class = "real_name">	<span><?php echo $row['real_name'] ?></span> </td>
			<td class = "department">	<span><?php echo $row['department'] ?></span> </td>
			<td class = "phone_number">	<span><?php echo $row['phone_number'] ?></span> </td>
			<td class = "e_mail">	<span><?php echo $row['e_mail'] ?></span> </td>
			<td class = "isSuperAdmin">	<span><?php if($row['isSuperAdmin'] == 0)echo "用户";else echo "管理员";?></span>
			<td class = "function"><span>
			<table>
			<tr>
			<td>
			<form name="form1" action="mainAdmin.php?fid=1&mid=3" method="post">
			<input type="hidden" name="userId" value="<?php echo $row['id'] ?>"/>
			<input type ="submit" name="submitEdit" value = "编辑"/>
			</form>
			</td>
			<td>
			<form name="form1" action="mainAdmin.php?fid=1&mid=4" method="post">
			<input type="hidden" name="userId" value="<?php echo $row['id'] ?>"/>
			<input type ="submit" name="submitDelete" value = "删除"/>
			</form>
			</td>
			</tr>
			</table>
			</span> </td>
        </tr> 
    <?php } ?> 
</table>

<div class="showPage"> 
    <?php 
    if ($total > $showrow) {//总记录数大于每页显示数，显示分页 
        $page = new page($total, $showrow, $curpage, $url, 2); 
        echo $page->myde_write(); 
    } 
    ?> 
</div>