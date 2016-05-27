<?php
session_start();
require("config.php");
$db = mysql_connect($dbhost,$dbuser,$dbpassword);
mysql_query("set names 'utf8' ");
mysql_query("set character_set_client=utf8");
mysql_query("set character_set_results=utf8");
mysql_select_db($dbdatabase, $db);
 if (! empty ( $_FILES ['file_stu'] ['name'] )) {
    $tmp_file = $_FILES ['file_stu'] ['tmp_name'];
    $file_types = explode ( ".", $_FILES ['file_stu'] ['name'] );
    $file_type = $file_types [count ( $file_types ) - 1];

	/*判别是不是.xls文件，判别是不是excel文件*/
	if (strtolower ( $file_type ) != "xls")              
	{
		$this->error ( '不是Excel文件，重新上传' );
	}

	/*设置上传路径*/
	$savePath = './upfile/';

	/*以时间来命名上传的文件*/
	$str = date ( 'Ymdhis' ); 
	$file_name = $str . "." . $file_type;

	/*是否上传成功*/
	if (! copy ( $tmp_file, $savePath . $file_name )) 
	{
		$this->error ( '上传失败' );
	}

	require_once 'PHPExcel.php';
	require_once 'PHPExcel/IOFactory.php';
	require_once 'PHPExcel/Reader/Excel5.php';

	$objReader=PHPExcel_IOFactory::createReader('Excel5');//use excel2007 for 2007 format
	$objPHPExcel=$objReader->load($savePath.$file_name);//$file_url即Excel文件的路径
	$sheet=$objPHPExcel->getSheet(0);//获取第一个工作表
	$highestRow=$sheet->getHighestRow();//取得总行数
	$highestColumn=$sheet->getHighestColumn(); //取得总列数
	?>
	<h1>成功导入以下用户数据</h1>
	<link rel = "stylesheet" href = "page.css" type = "text/css" />
	<table class="dates" cellspacing="0">
	<tr> 
		<td class = "username-t">		<span><?php echo "毕业年份" ?></span> </td>
		<td class = "real_name-t">		<span><?php echo "姓名" ?></span> </td>
		<td class = "department-t">		<span><?php echo "身份证号" ?></span> </td>
		<td class = "phone_number-t">	<span><?php echo "联系方式" ?></span> </td>
		<td class = "e_mail-t">	<span><?php echo "专业" ?></span> </td>
		<td class = "isSuperAdmin-t">	<span><?php echo "学号" ?></span> </td>
    </tr> 
	<?php
	//循环读取excel文件,读取一条,插入一条
	for($j=2;$j<=$highestRow;$j++){//从第一行开始读取数据
		$str='';
		for($k='A';$k<=$highestColumn;$k++){            //从A列读取数据
		//这种方法简单，但有不妥，以'\\'合并为数组，再分割\\为字段值插入到数据库,实测在excel中，如果某单元格的值包含了\\导入的数据会为空        
			$str.=$objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue().'\\';//读取单元格
		}
		//explode:函数把字符串分割为数组。
		$strs=explode("\\",$str);
		$sql="insert into file_stay(stu_id, name, iden_id, depart, education_level, file_content, reason, object, phone_num, gra_year) values(
		'".$strs[0]."',
		'".$strs[1]."',
		'".$strs[2]."',
		'".$strs[3]."',
		'".$strs[4]."',
		'".$strs[5]."',
		'".$strs[6]."',
		'".$strs[7]."',
		'".$strs[8]."',
		'".$strs[9]."');";
		//echo $sql."\n";
		mysql_query($sql);
		?>
		<tr> 
            <td class = "username">		<span><?php echo $strs[9] ?></span> </td>
			<td class = "real_name">	<span><?php echo $strs[1] ?></span> </td>
			<td class = "department">	<span><?php echo $strs[2] ?></span> </td>
			<td class = "phone_number">	<span><?php echo $strs[8] ?></span> </td>
			<td class = "phone_number">	<span><?php echo $strs[7] ?></span> </td>
			<td class = "e_mail">	<span><?php echo $strs[0] ?></span> </td>
        </tr> 
		<?php
	}
	?>
	</table>
	<a href="mainAdmin.php?fid=2&mid=2"><table><tr><td><img src="back.png" width="40px"> </img></td><td>返回上一级</td></tr></table></a>
	<?php
	unlink($savePath.$file_name); //删除excel文件
}
else{
?>
<h1>导入遗留档案Excel表：</h3>
<form method="post" action="mainAdmin.php?fid=2&mid=11" enctype="multipart/form-data">
<input  type="file" name="file_stu" />
<input type="submit"  value="导入" />
</form>
<h3>Excel表格格式示例</h3>
<img src="FileStayImportExample.jpg"></img>
<a href="mainAdmin.php?fid=2&mid=2"><table><tr><td><img src="back.png" width="40px"> </img></td><td>返回上一级</td></tr></table></a>
<?php
}
?>


