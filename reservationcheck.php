<?php session_start(); 
  //判定使用者是否為登入狀態，反則返回登入頁面
  if(!isset($_SESSION['user_id']) || !isset($_SESSION['user_phone'])) {
    echo "<script>alert(\"未登入，請登入會員!\");</script>";
    echo "<script>setTimeout(document.location.href='./login.php',3000)</script>";
  }
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
  		<h3 class="panel-title">預約確認資料</h3>
  	</div><br>
  	<p>謝謝您的預約！預約明細已寄至您的信箱。</p>
    <table border="1">
    		<td align='center' valign="middle"> 系 列 </td>
    		<td align='center' valign="middle"> 款 式 </td>
    		<!--td align='center' valign="middle"> 預 選 尺 寸 </td-->
    		<td align='center' valign="middle"> 預 約 時 間 </td>
    		<td align='center' valign="middle"> 試 穿 地 點 </td>
    		<td align='center' valign="middle"> 預 約 會 員 </td>
    		<td align='center' valign="middle"> 預 約 結 果 </td>
    	</tr>
      <?php
        //與資料庫取得連結
        include('./temp/config.php');

        //此為驗證變數，用於判斷是否合併表格
        $verification = "";
        //建立字典查詢，方便我們使用類別取得陣列值
        $dress_type_str = array('a'=>'公 主 系 列','b'=>'王 后 系 列','c'=>'拖 尾 系 列','d'=>'貼 身 系 列');
        //透過ＳＱＬ語法與join將許多資料庫合併，查詢出我們所需要的完成訂單資料
        $sql = "SELECT * FROM `reservation` join `inventory` join `dressitem` where `reservation`.`reservation_confirm` = `inventory`.`inventory_confirm` and `reservation`.`user_id` = '".$_SESSION['user_id']."' and `inventory`.`dressitem_id` = `dressitem`.`dressitem_id`";
       // echo $sql;
        $result = mysqli_query($conn, $sql) or die('MySQL query error');
            
        while($row = mysqli_fetch_array($result)){
          //此參數用於表格合併數量
          $rowspan = 0;
          //將取得到的資料依序顯示並且有些合併表格
          echo '<tr>';
          echo '<td align="center" valign="middle"> <div class="col-sm-">'.$dress_type_str[$row['dressitem_type']].'</div></td>';
          echo '<td><img class="reservationform" src="'.$row['dressitem_image'].'" width="200" /></td>';
          //echo '<td align="center" valign="middle">M</td>';

          if($verification!=$row['reservation_confirm']){
            $verification = $row['reservation_confirm'];
            $rowspan = $row['reservation_count'];
            echo '<td align="center" valign="middle" rowspan="'.$rowspan.'"> '.$row['reservation_datetime'].' </td>';
            echo '<td align="center" valign="middle" rowspan="'.$rowspan.'"> '.$row['reservation_address'].' </td>';
            echo '<td align="center" valign="middle" rowspan="'.$rowspan.'"> '.$_SESSION['user_name'].'<br>'.$_SESSION['user_phone'].'<br>'.$_SESSION['user_email'].' </td>';
            echo '<td align="center" valign="middle" rowspan="'.$rowspan.'"> 成 功 </td>';

          }else{
            /*echo '<td align="center" valign="middle"> '.$row['reservation_datetime'].'</td>';
            echo '<td align="center" valign="middle"> '.$row['reservation_address'].'</td>';
            echo '<td align="center" valign="middle"> '.$_SESSION['user_name'].'<br>'.$_SESSION['user_phone'].'<br>'.$_SESSION['user_email'].'</td>';
            echo '<td align="center" valign="middle"> 成 功 </td>';*/
          }
          echo '</tr>';
        }

        
      ?>
    </table>
  </div>
</div>
		
		<!-- 頁尾 -->
		<br>
    <div class="container text-white bg-secondary p-4">
      <div class="row">
        <div class="col-6 col-md-8 col-lg-7">
          <div class="row text-center">
          </div>
        </div>
      </div>
	</div>
  
  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap-4.0.0.js"></script>

	</body>
	</html>
	
