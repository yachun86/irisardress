
<?php session_start();
  //確認會員是否是登入狀態，並且已選購商品
  if(!isset($_SESSION['user_id']) || !isset($_SESSION['user_phone'])) {
  	echo "<script>alert(\"未登入，請登入會員!\");</script>";
   	echo "<script>setTimeout(document.location.href='./login.php',3000)</script>";
  }else if(count($_SESSION['cart'])==0){
    echo "<script>alert(\"您尚未選購商品\");</script>";
    echo "<script>setTimeout(document.location.href='./dressitem.php?dress_type=a',3000)</script>";
  }
  //echo count($_SESSION['cart']);

?>
<!DOCTYPE html>
 
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!--IE兼容模式，什麼版IE就用什麼版-->
    <meta >
	<title>愛麗絲禮服  AR</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap-4.0.0.css" rel="stylesheet">
    <script type="text/javascript">
      //用於驗證使用者送出訂單前的驗證，以及身高體重的驗證，再決定是否送出訂單
      function reservation_confirm(){
        var datetime = document.getElementById('reservation_time').value;
        var dressitem = document.getElementsByName('dressitem_id[]');
        var height = document.getElementById('height').value;
        var weight = document.getElementById('weight').value;
        var check_bool = false;
        for(var i=0;i<dressitem.length;i++){
          if(dressitem[i].checked){
            check_bool = true;
            break;
          }
        }
        if(height==0 || weight==0){
          alert("身高體重請勿空白！");
        }else if(datetime==""){
          alert("預約日期時間請勿空白！");
        }else if(!check_bool){
          alert("尚未選擇任何商品！");
        }else{
          document.getElementById('reservation_form').action = "./temp/reservation_temp.php?behavior=1";
          document.getElementById('reservation_form').submit();
        }
      }
      //將選購商品刪除時另外呼叫購物車頁面進行移除
      function reservation_delete(){
        var dressitem = document.getElementsByName('dressitem_id[]');
        var check_bool = false;
        for(var i=0;i<dressitem.length;i++){
          if(dressitem[i].checked){
            check_bool = true;
            break;
          }
        } 
        if(check_bool){
          document.getElementById('reservation_form').action = "./temp/cart_temp.php";
          document.getElementById('reservation_form').submit();
        }else{
          alert('無任何商品被刪除！');
        }
      }
    </script>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="./index.html">愛麗絲禮服  Iris Dress</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="./aboutus.html">關於我們</a>
          </li>
          <!--<li class="nav-item">
            <a class="nav-link" href="#">使用說明</a>
          </li>
        下拉選單-->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">系列禮服</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="./dressitem.php?dress_type=a">公主型</a> 
                <a class="dropdown-item" href="./dressitem.php?dress_type=b">王后型</a>
                <a class="dropdown-item" href="./dressitem.php?dress_type=c">拖尾型</a>
                <a class="dropdown-item" href="./dressitem.php?dress_type=d">貼身型</a>
                <!--<a class="dropdown-item" href="./dressitem.php?dress_type=e">西裝類</a> -->
              </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">會員</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="./register.php">註冊</a> 
                <a class="dropdown-item" href="./login.php">登入</a>
                <a class="dropdown-item" href="./temp/login_temp.php">登出</a>
              </div> 
          </li><br>
          <li class="nav-item">
            <a class="nav-link" href="./reservation.php">我的預約車</a>
          </li><br>
        </ul>
      </div>
      </div>
    </nav>
	
	
<div class="container">
          
  <div class="panel panel-info">
    <div class="panel-heading">
		  <h3 class="panel-title">預約內容</h3>
    </div>
    <br>
    <form id="reservation_form" action="#" method="post" role="form" class="form-horizontal">
      <div class="col-md-9 col-sm-8">
        <?php
          //與資料庫取得連結
          include('./temp/config.php');
          //透過ＳＱＬ與法取得使用者的身高與體重紀錄
          $sql = "SELECT * FROM `tb_user` WHERE `user_id` = '".$_SESSION['user_id']."'";
          $result = mysqli_query($conn, $sql) or die('MySQL query error');
          if($row = mysqli_fetch_array($result)){
            $height = $row['user_height'];
            $weight = $row['user_weight'];          
          }
          echo '<p>身高體重：</p>';
          echo '<p>身高：<input type="number" id="height" name="user_height" value="'.$height.'" />cm</p>';
          echo '<p>體重：<input type="number" id="weight" name="user_weight" value="'.$weight.'" />kg</p>';
        ?>
        
      </div>
      <br>
      <div class="col-md-9 col-sm-8">預約樣式：</div><br>
      <table border="1">
        <tr>
          <td align='center' valign="middle"> 選 擇 </td>
      		<td align='center' valign="middle"> 系 列 </td>
      		<td align='center' valign="middle"> 款 式 </td>
      		<!--<td align='center' valign="middle"> 預 選 尺 寸 </td>-->
      	</tr>
        <?php
          //建立字典查詢，方便我們使用類別取得陣列值
          $dress_type_str = array('a'=>'公 主 系 列','b'=>'王 后 系 列','c'=>'拖 尾 系 列','d'=>'貼 身 系 列');
          
          //依據購物車內的資料，向資料庫索取資料，並且顯示於訂單上
          foreach(array_keys($_SESSION['cart']) as $dress_id){  
            $sql = "SELECT * FROM `dressitem` WHERE `dressitem_id`='".$dress_id."'";
            $result = mysqli_query($conn, $sql) or die('MySQL query error');
                
            if($row = mysqli_fetch_array($result)){
              echo '<tr>';
              echo '<td><input type="checkbox" name="dressitem_id[]" value="'.$dress_id.'"></td>';
              echo '<td align="center" valign="middle"><div class="col-sm-">'.$dress_type_str[$row['dressitem_type']].'</div></td>';
              echo '<td><img class="reservationform" src="'.$row['dressitem_image'].'" width="400"/></td>';
             //echo '<td align="center" valign="middle">M</td>';
              echo '</tr>';
            }
          
          }
          mysqli_close($conn);
        ?>
      	
      </table>
      <br>
      <div class="panel-body">
      	<div class="form-group">
      		<label class="col-md-4 control-label">預約時間：</label>
      		<div class="col-md-8">
      			<input type="datetime-local" id="reservation_time" name="reservation_time" value="" class="form-control" placeholder="年/月/日 00:00">
      		</div><br>
      	  <label class="col-md-4 control-label">試穿地點：</label>
      		<div class="col-md-8">
      			<select name="reservation_address" value="" class="form-control">
      				<option value="艾莉絲婚紗館">艾莉絲婚紗館(Address)</option>
      				<option value="中科婚紗館">中科婚紗館(Address)</option>
      			</select>
      		</div>
        </div>
      	<div class="form-group">
      	  <label class="col-md-4"></label>
      		<div class="col-md-8">
      			<button type="button" name="button" class="btn btn-primary" onclick="reservation_confirm()">確定預約</button>
            <button type="button" name="button" class="btn btn-primary" onclick="reservation_delete()">刪除</button>
            <button type="button" name="button" class="btn btn-primary" onclick="location.href='./reservationcheck.php'">查看訂單</button>
      		</div>
      	</div> 
      </div>
    </div>
  </form>
</div>
		<script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap-4.0.0.js"></script>

		<!-- 頁尾 -->
    <div class="container text-white bg-secondary p-4">
      <div class="row">
        <div class="col-6 col-md-8 col-lg-7">
          <div class="row text-center">
          </div>
        </div>
      </div>
	  </div>
	</body>
</html>
	
