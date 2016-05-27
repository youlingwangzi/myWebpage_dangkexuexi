<table ><tr><td><h1>遗留档案管理</h1></td><td><td width=220> </td><td class="addnew" align = right>
<?php
if($_SESSION['USERAUTHORITY']){
	echo "<a href = 'mainAdmin.php?fid=2&mid=9'>增加新的遗留档案<img src='add.png' width='13px'></img></a>";
	echo "<a href = 'fileStayExport.php'>导出<img src='downLoad.jpg' width='16px'></img></a>";
	echo "<a href = 'mainAdmin.php?fid=2&mid=11'>导入<img src='upLoad.jpg' width='16px'></img></a>";
}
 ?>
</td></tr></table>

<link rel = "stylesheet" href = "page.css" type = "text/css" />
<?php
require_once('page.class.php'); //分页类
$showrow = 7; //一页显示的行数 
$curpage = empty($_GET['page']) ? 1 : $_GET['page']; //当前的页,还应该处理非数字的情况 
$url = "?fid=2&mid=2&page={page}"; //分页地址，如果有检索条件 ="?page={page}&q=".$_GET['q'] 
//省略了链接mysql的代码，测试时自行添加 
if($_POST['submitSearch']){
		$_SESSION['sql-file_stay'] = "SELECT * FROM file_stay WHERE gra_year LIKE '%".$_POST['gra_year']."' AND name LIKE '%".$_POST['name']."%' AND iden_id LIKE '%".$_POST['iden_id']."%'"; 
}
//echo $_SESSION['sql-file_stay'];
$total = mysql_num_rows(mysql_query($_SESSION['sql-file_stay'])); //记录总条数 
if (!empty($_GET['page']) && $total != 0 && $curpage > ceil($total / $showrow)) 
    $curpage = ceil($total_rows / $showrow); //当前页数大于最后页数，取最后一页 
//获取数据 
$sql=$_SESSION['sql-file_stay']." LIMIT " . ($curpage - 1) * $showrow . ",$showrow;"; 
$query = mysql_query($sql);
?>

<table style="margin-bottom:20px;border-collapse:collapse;" cellspacing="0">
<form action="mainAdmin.php?fid=2&mid=2&search=1" method="POST">
<tr>
<td class="search_title">毕业年份：</td>
<td class="search_content"><input type="text" name="gra_year" style="width:150"></td>
<td class="search_title">姓名：</td>
<td class="search_content"><input type="text" name="name" style="width:150"></td>
</tr>
<tr>
<td class="search_title">身份证号：</td>
<td class="search_content"><input type="text" name="iden_id" style="width:150"></td>
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
		<td class = "username-t">		<span><?php echo "毕业年份" ?></span> </td>
		<td class = "username-t">		<span><?php echo "姓名" ?></span> </td>
		<td class = "username-t">		<span><?php echo "身份证号" ?></span> </td>
		<td class = "username-t">	<span><?php echo "联系方式" ?></span> </td>
		<td class = "username-t">	<span><?php echo "专业" ?></span> </td>
		<td class = "isSuperAdmin-t">	<span><?php echo "学号" ?></span> </td>
		<td class = "function-t">	<span>操作</span> </td>
    </tr> 
    <?php while ($row = mysql_fetch_array($query)) { ?> 
        <tr> 
            <td class = "username">		<span><?php echo $row['gra_year'] ?></span> </td>
			<td class = "username">	<span><?php echo $row['name'] ?></span> </td>
			<td class = "username">	<span><?php echo $row['iden_id'] ?></span> </td>
			<td class = "username">	<span><?php echo $row['phone_num'] ?></span> </td>
			<td class = "username">	<span><?php echo $row['object'] ?></span> </td>
			<td class = "isSuperAdmin">	<span><?php echo $row['stu_id'] ?></span>
			<td class = "function"><span>
			<table>
			<tr>
			<td>
			<form name="form1" action="mainAdmin.php?fid=2&mid=8" method="post">
			<input type="hidden" name="userId" value="<?php echo $row['id'] ?>"/>
			<input type ="submit" name="submitEdit" value = "编辑"/>
			</form>
			</td>
			<td>
			<form name="form1" action="mainAdmin.php?fid=2&mid=10" method="post">
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