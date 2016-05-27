<?php
header("content-type:text/html;charset=utf-8");
?>


<?php
if(isset($_POST['sub'])){    // isset()函数判断提交按钮值是否存在
  if(!is_dir("upfile/docOfFile")){     // is_dir()函数判断指定的文件夹是否存在
    mkdir("upfile/docOfFile");         // mkdir()函数创建文件夹
  }
  $file=$_FILES['upfile'];   // 获取上传文件
  if(is_uploaded_file($file['tmp_name'])){   // 判断上传是不是通过HTTP POST上传的
    $str=stristr($file['name'],'.');         // stristr()函数获取上传文件的后缀
    // strtotime()函数定义一个Unix时间戳
    $path="upfile/docOfFile/".strtotime("now").$str;   // 定义上传文件的存储位置
    if(move_uploaded_file($file['tmp_name'],$path)){   // 执行文件上传操作
      echo "<h3>上传成功</h3>";
	  //echo "地址为：".$path;
    }
  }
}
?>

<form action="" method="post" enctype="multipart/form-data">
			<table>
			<tr>
<input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
			<td>选择文件</td>
			<td><input type="file" name="upfile" /></td>
			<tr>
			<td>文件标题：</td>
			<td><input type = "text" name = "title" style="width:200px"></td>
			</tr>
			<tr>
			<td>内容：</td>
			<td><input type = "text" name = "content" style="width:200px"></td>
			</tr>
			<tr><td></td><td><input type="submit" name="sub" value="上传" /></td></tr>
			</table>
</form>
