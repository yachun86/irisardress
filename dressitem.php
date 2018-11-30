<?php session_start(); 
  //用來判斷使用者是否有登入狀態才可預覽商品
  if(!isset($_SESSION['user_id']) || !isset($_SESSION['user_phone'])){
    header('Location: index.html');
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!--IE兼容模式，什麼版IE就用什麼版-->
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
           <!-- <li class="nav-item">
              <a class="nav-link" href="#">使用說明</a>
            </li>-->
        <!--下拉選單-->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">系列禮服</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="./dressitem.php?dress_type=a">公主型</a> 
                <a class="dropdown-item" href="./dressitem.php?dress_type=b">王后型</a>
                <a class="dropdown-item" href="./dressitem.php?dress_type=c">拖尾型</a>
                <a class="dropdown-item" href="./dressitem.php?dress_type=d">貼身型</a>
                <!--a class="dropdown-item" href="./dressitem.php">蓬裙型</a--> 
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">會員</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="./register.php">註冊</a> 
                <a class="dropdown-item" href="./login.php">登入</a>
                <a class="dropdown-item" href="./temp/login_temp.php">登出</a>
              </div>  
            </li>
            <br>
            <li class="nav-item">
              <a class="nav-link" href="./reservation.php">我的預約車</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <br>
    <?php

       //抓取目前商品類別
      $type = $_GET['dress_type'];

      $title_array = array('a'=>'公主型婚紗','b'=>'王后型婚紗','c'=>'拖尾型婚紗','d'=>'貼身型婚紗');
      $image_array = array('a'=>'./image/a01.jpg','b'=>'./image/b01.jpg','c'=>'./image/c01.jpg','d'=>'./image/d01.jpg');


      echo '<h2 class="text-center">'.$title_array[$type].'</h2>';
      echo '<p Align="center"> <img src="'.$image_array[$type].'"></p>';
      echo '<div class="container">';

      //與資料庫取得連結
      include('./temp/config.php');
     
      //使用ＳＱＬ語法抓取資料庫內與類別吻合的商品
      $sql = "SELECT * FROM `dressitem` WHERE `dressitem_type`='".$type."'";
      $result = mysqli_query($conn, $sql);
      $count_index = 1;
      while($row = mysqli_fetch_array($result)){
        if($count_index == 1) echo '<div class="row text-center">';
        else if(($count_index - 1) % 3 == 0 && $count_index != 1) echo '<div class="row text-center mt-4">';

        echo '<div class="col-md-4 pb-1 pb-md-0">';
        echo '<div class="card">';
        echo '<img class="card-img-top" src="'.$row['dressitem_image'].'" alt = "Card image cap">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">'.$row['dressitem_name'].'</h5>';
        echo '<p class="card-text">'.$row['dressitem_abstract'].'</p>';
        echo '<a href="'.$row['dressitem_3Dpath'].'" class="btn btn-primary">試穿</a>&nbsp;';

        if(isset($_SESSION['cart'])){
          if(array_key_exists($row['dressitem_id'], $_SESSION['cart'])){
            echo '<a href="#" class="btn btn-success">喜歡</a>';
          }else{
            echo '<a href="./temp/cart_temp.php?dress_type='.$type.'&dressitem_id='.$row['dressitem_id'].'" class="btn btn-primary">喜歡</a>';
          }
        }else{
          echo '<a href="./temp/cart_temp.php?dress_type='.$type.'&dressitem_id='.$row['dressitem_id'].'" class="btn btn-primary">喜歡</a>';
        }
        echo '</div></div></div>';

        if($count_index % 3 == 0) echo '</div>';
        $count_index = $count_index + 1;
      }
      //關閉資料庫
      mysqli_close($conn); 

      echo '</div>';
    ?>
    <div class="container text-white bg-secondary p-4">
      <div class="row">
        <div class="col-6 col-md-8 col-lg-7">
          <div class="row text-center">
            <div class="col-sm-6 col-md-4 col-lg-4 col-12">
              <ul class="list-unstyled">
 <!--           <li class="btn-link"> <a>Link anchor</a> </li>-->
              </ul>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-4 col-12">
              <ul class="list-unstyled">
 <!--           <li class="btn-link"> <a>Link anchor</a> </li>-->
              </ul>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-4 col-12">
              <ul class="list-unstyled">
 <!--           <li class="btn-link"> <a>Link anchor</a> </li>-->
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-lg-5 col-6">
          <address>
<!--            <strong>MyStoreFront, Inc.</strong><br>
            Indian Treasure Link<br>
            Quitman, WA, 99110-0219<br>
            <abbr title="Phone">P:</abbr> (123) 456-7890
          </address>
          <address>
            <strong>Full Name</strong><br>
            <a href="mailto:#">first.last@example.com</a>-->
          </address>
        </div>
      </div>
    </div>
    <footer class="text-center">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <p> </p>
          </div>
        </div>
      </div>
    </footer>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap-4.0.0.js"></script>
  </body>
</html>