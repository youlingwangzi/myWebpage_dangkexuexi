<table ><tr><td><h1>档案信息管理</h1></td><td><td width=270> </td><td class="addnew" align = right>
<?php
if($_SESSION['USERAUTHORITY']){
	echo "<a href = 'mainAdmin.php?fid=2&mid=12'>增加新档案信息<img src='add.png' width='13px'></img></a>";
	echo "<a href = 'docoffileExport.php'>导出<img src='downLoad.jpg' width='16px'></img></a>";
	//echo "<a href = 'mainAdmin.php?fid=2&mid=15'>导入<img src='upLoad.jpg' width='16px'></img></a>";
}
 ?>
</td></tr></table>

<link rel = "stylesheet" href = "page.css" type = "text/css" />
<?php
require_once('page.class.php'); //分页类 
$showrow = 7; //一页显示的行数 
$curpage = empty($_GET['page']) ? 1 : $_GET['page']; //当前的页,还应该处理非数字的情况 
$url = "?fid=2&mid=3&page={page}"; //分页地址，如果有检索条件 ="?page={page}&q=".$_GET['q'] 
//省略了链接mysql的代码，测试时自行添加 
if($_POST['submitSearch']){
		$_SESSION['sql-docoffile'] = "SELECT * FROM doc_of_file WHERE title LIKE '%".$_POST['title']."%' AND author LIKE '%".$_POST['author']."%' AND date LIKE '%".$_POST['date']."%' AND content LIKE '%".$_POST['content']."%'";
}
//echo $_SESSION['sql-docoffile'];
$total = mysql_num_rows(mysql_query($_SESSION['sql-docoffile'])); //记录总条数 
if (!empty($_GET['page']) && $total != 0 && $curpage > ceil($total / $showrow)) 
    $curpage = ceil($total_rows / $showrow); //当前页数大于最后页数，取最后一页 
//获取数据 
$sql=$_SESSION['sql-docoffile']." LIMIT " . ($curpage - 1) * $showrow . ",$showrow;"; 
$query = mysql_query($sql);
?>

<table style="margin-bottom:20px;border-collapse:collapse;" cellspacing="0">
<form action="mainAdmin.php?fid=2&mid=3&search=1" method="POST">
<tr>
<td class="search_title">文件标题：</td>
<td class="search_content"><input type="text" name="title" style="width:150"></td>
<td class="search_title">上传者：</td>
<td class="search_content"><input type="text" name="author" style="width:150"></td>
</tr>
<tr>
<td class="search_title">更新时间：</td>
<td class="search_content"><input type="text" name="date" style="width:150"></td>
<td class="search_title"><input type ="submit" name="submitSearch" value = "查询"></td>
</tr>
<input type="hidden" name="fid" value = 2/>
<input type="hidden" name="mid" value = 3/>
</form>
</table>


<table> 
<tr>
<td></td><td></td><td></td><td></td>
</tr>
</table>
<table class="dates" cellspacing="0"> 

	<tr> 
		<td class = "username-t">		<span><?php echo "文件标题" ?></span> </td>
		<td class = "real_name-t">		<span><?php echo "上传者" ?></span> </td>
		<td class = "department-t">		<span><?php echo "更新时间" ?></span> </td>
		<td class = "phone_number-t">	<span><?php echo "内容" ?></span> </td>
		
		<td class = "function-t">	<span>操作</span> </td>
    </tr> 
    <?php while ($row = mysql_fetch_array($query)) { ?> 
        <tr> 
            <td class = "username">		<span><?php echo $row['title'] ?></span> </td>
			<td class = "username">	<span><?php echo $row['author'] ?></span> </td>
			<td class = "username">	<span><?php echo $row['date'] ?></span> </td>
			<td class = "username">	<span><?php echo $row['content'] ?></span> </td>
			<td class = "username"><span>
			<table>
			<tr>
			<td>
			<form name="form1" action="<?php echo $row['path'] ?>" method="post">
			<input type="hidden" name="userId" value="<?php echo $row['id'] ?>"/>
			<input type ="submit" name="submitDownload" value = "下载"/>
			</form>
			</td>
			<td>
			<form name="form1" action="mainAdmin.php?fid=2&mid=13" method="post">
			<input type="hidden" name="userId" value="<?php echo $row['id'] ?>"/>
			<input type ="submit" name="submitEdit" value = "编辑"/>
			</form>
			</td>
			<td>
			<form name="form1" action="mainAdmin.php?fid=2&mid=14" method="post">
			<input type="hidden" name="userId" value="<?php echo $row['id'] ?>"/>
			<input type="hidden" name="path" value="<?php echo $row['path'] ?>"/>
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