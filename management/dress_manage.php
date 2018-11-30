<?php session_start(); 

  if(!isset($_SESSION['user_id']) || !isset($_SESSION['user_phone']) || $_SESSION['user_permission'] != 1){
    header('Location: ../index.html');
  }

?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>商品管理介面</title>
<link href="../css/bootstrap-4.0.0.css" rel="stylesheet">
<!--link href="../css/management.css" rel="stylesheet"-->
<script language="javascript">
	function image_file_sel(){
		var url = document.getElementById("dressitem_image").value;
		var st_array = url.split("\\");
		var file_name = st_array[st_array.length-1];
		//alert(file_name);
		document.getElementById("dress_image_show").src = "../image/dress/" + file_name;
		document.getElementById("dressitem_image_label").innerHTML = "./image/dress/" + file_name;
		document.getElementById("dressitem_image_input").value = "./image/dress/" + file_name;
	}
	function path_file_sel(){
		var url = document.getElementById("dressitem_3Dpath").value;
		var st_array = url.split("\\");
		var file_name = st_array[st_array.length-1];

		document.getElementById("dressitem_3Dpath_label").innerHTML = "./AR/" +file_name;
		document.getElementById("dressitem_3Dpath_input").value = "./AR/" + file_name;
	}
</script>
<style type="text/css">
	.manage_img{
		height:100px;
		width:200px;
	}
	.table td{
		vertical-align:middle;
	}
</style>
</head>
<body>
	<?php include('tittle.php'); ?>
	<br>
	<div  style="width:100%;text-align:right;">
		<?php echo '<p>目前身份：'.$_SESSION['user_name'].'管理員，歡迎您．</p>'; ?>
	</div>
	<div id="container">
		<div id = "Content">
			<div id = "word">
				<?php
					$dressitem_type = $_GET['dressitem_type'];
					if($dressitem_type=='') $dressitem_type='a';
					$dress_selected = ['','','','',''];
					if($dressitem_type=='a') $dress_selected[0] = 'selected';
					else if($dressitem_type=='b') $dress_selected[1] = 'selected';
					else if($dressitem_type=='c') $dress_selected[2] = 'selected';
					else if($dressitem_type=='d') $dress_selected[3] = 'selected';
					

					echo '<button onclick="location.href=\'./dress_manage.php?dressitem_type='.$dressitem_type.'&modify=-1\'">新增</button>';
					echo '<button onclick="location.href=\'./dress_manage.php?dressitem_type='.$dressitem_type.'&modify=-9999\'">刪除</button>';

					echo '<select id="dressitem_sel" onchange="javascript:location.href=this.value;">
							<option value="?dressitem_type=a" '.$dress_selected[0].'>公主型婚紗</option>
							<option value="?dressitem_type=b" '.$dress_selected[1].'>王后型婚紗</option>
							<option value="?dressitem_type=c" '.$dress_selected[2].'>拖尾型婚紗</option>
							<option value="?dressitem_type=d" '.$dress_selected[3].'>貼身型婚紗</option>
						</select>';
				?>
				
				<table class="table" id="member_table">
					<tr>
						<th >商品編號</th>
						<th >商品名稱</th>
						<th >商品簡介</th>
						<th >商品歸類</th>
						<th width="300">商品位置</th>
						<th width="300">3D模型位置</th>
						<th>修改管理</th>
					</tr>
					<?php

						$dress_type_str = array('a'=>'公 主 型','b'=>'王 后 型','c'=>'拖 尾 型','d'=>'貼 身 型');

						include('../temp/config.php');

						$modify = $_GET['modify'];

						$sql = "SELECT * FROM `dressitem` where `dressitem_type`='".$dressitem_type."'";
						$result = mysqli_query($conn, $sql) or die('MySQL query error');
						
						if($modify == -9999){
							echo '<form action="../temp/dress_manage_temp.php? method="POST">';
						}
						while($row = mysqli_fetch_array($result)){

							if($modify == $row['dressitem_id']){
								//修改請求，依據傳入dressitem_id更改表格狀態為輸入
								echo '<form action="../temp/dress_manage_temp.php?manage_type=1&dressitem_id='.$modify.'" method="POST" enctype="multipart/form-data">';
								echo '<tr>';
								echo '<td>'.$row['dressitem_id'].'</td>';
								echo '<td><input type="text" class="form-control" id="dressitem_name" name="dressitem_name" \
									value="'.$row['dressitem_name'].'" autocorrect="off" autocapitalize="off" autocomplete="off"></td>';
								echo '<td><input type="textarea" class="form-control" id="dressitem_abstract" name="dressitem_abstract" \
									value="'.$row['dressitem_abstract'].'" autocorrect="off" autocapitalize="off" autocomplete="off"></td>';
								echo '<td><select name="dressitem_type" id="dressitem_type">
									<option value="a" '.$dress_selected[0].'>公主型婚紗</option>
									<option value="b" '.$dress_selected[1].'>王后型婚紗</option>
									<option value="c" '.$dress_selected[2].'>拖尾型婚紗</option>
									<option value="d" '.$dress_selected[3].'>貼身型婚紗</option>
								</select></td>';
								echo '<td><label id="dressitem_image_label" for="dressitem_image">'.$row['dressitem_image'].'</label>
									<input type="file" accept="image/*" class="form-control" id="dressitem_image" name="dressitem_image" onchange="image_file_sel()" hidden />
									<img id="dress_image_show" class="manage_img" src="../'.$row['dressitem_image'].'" />
									<input type="text" id="dressitem_image_input" name="dressitem_image_input" value="'.$row['dressitem_image'].'"hidden /></td>';
								echo '<td><label id="dressitem_3Dpath_label" for="dressitem_3Dpath">'.$row['dressitem_3Dpath'].'</label>
									<input type="file" accept="text/html, test/php" class="form-control" id="dressitem_3Dpath" name="dressitem_3Dpath" onchange="path_file_sel()" hidden />
									<input type="text" id="dressitem_3Dpath_input" name="dressitem_3Dpath_input" value="'.$row['dressitem_3Dpath'].'"hidden /></td>';
								echo '<td><button type="submit">確定</button></td>';
								echo '</tr>';
								echo '</form>';

							}
							else{
								//無任何需求，僅顯示目前dressitem資料庫資料
								echo '<tr>';
								if($modify == -9999){
									//刪除會員的form
									echo '<td><input type="checkbox" name="scales[]" value="'.$row['dressitem_id'].'">'.$row['dressitem_id'].'</td>';
								}else{
									echo '<td>'.$row['dressitem_id'].'</td>';
								}
								echo '<td>'.$row['dressitem_name'].'</td>';
								echo '<td>'.$row['dressitem_abstract'].'</td>';
								echo '<td>'.$dress_type_str[$row['dressitem_type']].'</td>';
								echo '<td><img src="../'.$row['dressitem_image'].'" class="manage_img" /></td>';
								echo '<td>'.$row['dressitem_3Dpath'].'</td>';
								echo '<td><a href="./dress_manage.php?dressitem_type='.$dressitem_type.'&modify='.$row['dressitem_id'].'">修改</a></td>';
								echo '</tr>';
							}
						}
						if($modify==-1){
							//新增請求，將最底下表格新加入空白輸入欄位
							echo '<form action="../temp/dress_manage_temp.php?manage_type=-1" method="POST" enctype="multipart/form-data">';
							echo '<tr>';
							echo '<td>new</td>';
							echo '<td><input type="text" class="form-control" id="dressitem_name" name="dressitem_name" \
								autocorrect="off" autocapitalize="off" autocomplete="off"></td>';
							echo '<td><input type="textarea" class="form-control" id="dressitem_abstract" name="dressitem_abstract" \
								autocorrect="off" autocapitalize="off" autocomplete="off"></td>';
							echo '<td><select name="dressitem_type" id="dressitem_type">
								<option value="a" '.$dress_selected[0].'>公主型婚紗</option>
								<option value="b" '.$dress_selected[1].'>王后型婚紗</option>
								<option value="c" '.$dress_selected[2].'>拖尾型婚紗</option>
								<option value="d" '.$dress_selected[3].'>貼身型婚紗</option>
							</select></td>';
							echo '<td><label id="dressitem_image_label" for="dressitem_image">選擇檔案</label>
								<input type="file" accept="image/*" class="form-control" id="dressitem_image" name="dressitem_image" onchange="image_file_sel()" hidden />
								<img id="dress_image_show" class="manage_img" src="../'.$row['dressitem_image'].'" />
								<input type="text" id="dressitem_image_input" name="dressitem_image_input" value="'.$row['dressitem_image'].'"hidden /></td>';
							echo '<td><label id="dressitem_3Dpath_label" for="dressitem_3Dpath">選擇檔案</label>
								<input type="file" accept="text/html, test/php" class="form-control" id="dressitem_3Dpath" name="dressitem_3Dpath" onchange="path_file_sel()" hidden />
								<input type="text" id="dressitem_3Dpath_input" name="dressitem_3Dpath_input" value="#"hidden /></td>';
							//echo '<td><input type="file" accept="image/png, image/jpg" class="form-control" id="dressitem_image" name="dressitem_image" /></td>';
							//echo '<td><input type="file" class="form-control" id="dressitem_3Dpath" name="dressitem_3Dpath" /></td>';
							
							echo '<td><button type="submit">確定</button></td>';
							
							echo '</tr>';
							echo '</form>';
						}else if($modify == -9999){
							//刪除會員的送出按鈕
							echo '<button type="submit">送出</button>';
							echo '</form>';

						}
						mysqli_close($conn);
					?>
					
				</table>
			</div>
		</div>
	</div>
</body>
</html>


