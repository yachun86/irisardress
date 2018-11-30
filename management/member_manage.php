<?php session_start(); 

  if(!isset($_SESSION['user_id']) || !isset($_SESSION['user_phone']) || $_SESSION['user_permission'] != 1){
    header('Location: ../index.html');
  }
  //echo $_SESSION['user_permission'];
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>會員管理介面</title>
<link href="../css/bootstrap-4.0.0.css" rel="stylesheet" />
<!--link href="../css/management.css" rel="stylesheet" /-->
<script language="javascript">
	function add_new_td() {
		 //先取得目前的row數
		 var num = document.getElementById("member_table").rows.length;
		 //建立新的tr 因為是從0開始算 所以目前的row數剛好為目前要增加的第幾個tr
		 var Tr = document.getElementById("member_table").insertRow(num);
		 //建立新的td 而Tr.cells.length就是這個tr目前的td數
		 Td = Tr.insertCell(Tr.cells.length);
		 //而這個就是要填入td中的innerHTML
		 Td.innerHTML='<input name="name[]" type="text" size="12">';
		 //這裡也可以用不同的變數來辨別不同的td (我是用同一個比較省事XD)
		 Td = Tr.insertCell(Tr.cells.length);
		 Td.innerHTML='<input name="content[]" type="text" size="12">';
		 //這樣就好囉 記得td數目要一樣 不然會亂掉~
	}
</script>
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
				<button onclick="location.href='./member_manage.php?modify=-1'">新增</button>
				<button onclick="location.href='./member_manage.php?modify=-9999'">刪除</button>
				<table class="table" id="member_table">
					<tr>
						<th>會員編號</th>
						<th>會員姓名</th>
						<th>會員手機</th>
						<th>會員密碼</th>
						<th>會員E-mail</th>
						<th>會員權限</th>	
						<th>修改管理</th>
					</tr>

					<?php

						include('../temp/config.php');

						$modify = $_GET['modify'];

						$sql = "SELECT * FROM `tb_user` where `user_id` != '".$_SESSION['user_id']."'";
						$result = mysqli_query($conn, $sql) or die('MySQL query error');
						
						if($modify == -9999){
							echo '<form action="../temp/member_manage_temp.php?" method="POST">';
						}

						while($row = mysqli_fetch_array($result)){
							//
							if($modify == $row['user_id']){
								echo '<form action="../temp/member_manage_temp.php?manage_type=1&user_id='.$modify.'" method="POST">';
								echo '<tr>';
								echo '<td>'.$row['user_id'].'</td>';
								echo '<td><input type="text" class="form-control" id="user_name" name="user_name" \
								value="'.$row['user_name'].'" autocorrect="off" autocapitalize="off" autocomplete="off"></td>';
								echo '<td><input type="phone" class="form-control" id="user_phone" name="user_phone" onkeyup="value=value.replace(/[^\d]/g,\'\') " \
								value="'.$row['user_phone'].'" autocorrect="off" autocapitalize="off" autocomplete="off"></td>';
								echo '<td><input type="text" class="form-control" id="user_pwd" name="user_pwd" \
								value="'.$row['user_pwd'].'" autocorrect="off" autocapitalize="off" autocomplete="off"></td>';
								echo '<td><input type="email" class="form-control" id="user_email" name="user_email" \
								value="'.$row['user_email'].'" autocorrect="off" autocapitalize="off" autocomplete="off"></td>';

								if($row['user_permission'] == 1){
									$permis_1 = 'checked';
									$permis_0 = '';
								}else{
									$permis_0 = 'checked';
									$permis_1 = '';
								}
								echo '<td><input type="radio" name="permission" value="1" '.$permis_1.' > 有<br>
									<input type="radio" name="permission" value="0" '.$permis_0.' > 無</td>';
								
								echo '<td><button type="submit">確定</button></td>';
								
								echo '</tr>';
								echo '</form>';

							}
							else{
								echo '<tr>';
								if($modify == -9999){
									//刪除會員的form
									echo '<td><input type="checkbox" name="scales[]" value="'.$row['user_id'].'">'.$row['user_id'].'</td>';
								}else{
									echo '<td>'.$row['user_id'].'</td>';
								}
								echo '<td>'.$row['user_name'].'</td>';
								echo '<td>'.$row['user_phone'].'</td>';
								echo '<td>'.$row['user_pwd'].'</td>';
								echo '<td>'.$row['user_email'].'</td>';
								if($row['user_permission']==1) echo '<td>有</td>';
								else echo '<td>無</td>';
								echo '<td><a href="./member_manage.php?modify='.$row['user_id'].'" >修改</a></td>';
								echo '</tr>';
							}
						}
						if($modify == -1){
							//新增會員表格
							echo '<form action="../temp/member_manage_temp.php?manage_type=-1" method="POST">';
							echo '<tr>';
							echo '<td>new</td>';
							echo '<td><input type="text" class="form-control" id="user_name" name="user_name" \
								autocorrect="off" autocapitalize="off" autocomplete="off"></td>';
							echo '<td><input type="phone" class="form-control" id="user_phone" name="user_phone" onkeyup="value=value.replace(/[^\d]/g,\'\') " \
								autocorrect="off" autocapitalize="off" autocomplete="off"></td>';
							echo '<td><input type="text" class="form-control" id="user_pwd" name="user_pwd" \
								autocorrect="off" autocapitalize="off" autocomplete="off"></td>';
							echo '<td><input type="email" class="form-control" id="user_email" name="user_email" \
								autocorrect="off" autocapitalize="off" autocomplete="off"></td>';

							
							echo '<td><input type="radio" name="permission" value="1" > 有<br>
								<input type="radio" name="permission" value="0" checked > 無</td>';
							
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

	<script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap-4.0.0.js"></script>

</body>
</html>


