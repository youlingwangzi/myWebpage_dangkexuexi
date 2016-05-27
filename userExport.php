<?php
session_start();
require("config.php");
$db = mysql_connect($dbhost,$dbuser,$dbpassword);
mysql_query("set names 'utf8' ");
mysql_query("set character_set_client=utf8");
mysql_query("set character_set_results=utf8");
mysql_select_db($dbdatabase, $db);

if($_SESSION['ISLOGIN']){
	if($_SESSION['USERAUTHORITY']){
		$query=mysql_query($_SESSION['sql-user']);

		require_once 'PHPExcel.php';
		require_once 'phpExcel/Writer/Excel2007.php';
		require_once 'phpExcel/Writer/Excel5.php';
		include_once 'phpExcel/IOFactory.php';

		$objExcel = new PHPExcel();
		//设置属性 (这段代码无关紧要，其中的内容可以替换为你需要的)
		$objExcel->getProperties()->setCreator("andy");
		$objExcel->getProperties()->setLastModifiedBy("andy");
		$objExcel->getProperties()->setTitle("Office 2003 XLS Test Document");
		$objExcel->getProperties()->setSubject("Office 2003 XLS Test Document");
		$objExcel->getProperties()->setDescription("Test document for Office 2003 XLS, generated using PHP classes.");
		$objExcel->getProperties()->setKeywords("office 2003 openxml php");
		$objExcel->getProperties()->setCategory("Test result file");
		$objExcel->setActiveSheetIndex(0);

		$i=0;
		//表头
		$k1="用户名";
		$k2="姓名";
		$k3="所在部门";
		$k4="联系方式";
		$k5="电子邮件";
		$k6="用户类型";

		$objExcel->getActiveSheet()->setCellValue('a1', "$k1");
		$objExcel->getActiveSheet()->setCellValue('b1', "$k2");
		$objExcel->getActiveSheet()->setCellValue('c1', "$k3");
		$objExcel->getActiveSheet()->setCellValue('d1', "$k4");
		$objExcel->getActiveSheet()->setCellValue('e1', "$k5");
		$objExcel->getActiveSheet()->setCellValue('f1', "$k6");
		//debug($links_list);
		while ($row = mysql_fetch_array($query)) {
			
			$u1=$i+2;
			$objExcel->getActiveSheet()->setCellValue('a'.$u1, $row["username"]);
			$objExcel->getActiveSheet()->setCellValue('b'.$u1, $row["real_name"]);
			$objExcel->getActiveSheet()->setCellValue('c'.$u1, $row["department"]);
			$objExcel->getActiveSheet()->setCellValue('d'.$u1, $row["phone_number"]);
			$objExcel->getActiveSheet()->setCellValue('e'.$u1, $row["e_mail"]);
			if($row['isSuperAdmin'] == 0) 
				$objExcel->getActiveSheet()->setCellValue('f'.$u1,"用户");
			else 
				$objExcel->getActiveSheet()->setCellValue('f'.$u1,"管理员");
			$i++;
		}

		// 高置列的宽度
		$objExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
		$objExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$objExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
		$objExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
		$objExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
		$objExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);

		$objExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&BPersonal cash register&RPrinted on &D');
		$objExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objExcel->getProperties()->getTitle() . '&RPage &P of &N');

		// 设置页方向和规模
		$objExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
		$objExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
		$objExcel->setActiveSheetIndex(0);
		$timestamp = time();
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="UserData'.$timestamp.'.xls"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objExcel, 'Excel5');
		$objWriter->save('php://output');
		exit;
	}else{
		echo "<h1>对不起你不是管理员。</h1>";
		echo "<p>请联系系统管理员。</p>";
		echo "<a href='mainAdmin.php?fid=1&mid=1'><table><tr><td><img src='back.png' width='40px'> </img></td><td>返回上一级</td></tr></table></a>" ;
	}
}else{
	echo "<p>请以管理员身份登陆添加。</p>";
}
?>
