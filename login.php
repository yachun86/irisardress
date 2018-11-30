<?php session_start();
  if(isset($_SESSION['user_id']) || isset($_SESSION['user_phone']) || isset($_SESSION['user_permission'])){
    header('Location: ./index.html');
  }
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>會員登入</title>
<link href="css/bootstrap-4.0.0.css" rel="stylesheet">
<script language="javascript">
  function captchang(){
    document.getElementById("rand-img").src = "../tmp/captcha.php";
  }

  function login_check(){
    var phone = document.getElementById('input-phone').value;
    var pwd = document.getElementById('input-password').value;
    var capt = document.getElementById('captch').value;

    if(phone==""){
      alert("帳號請勿空白");
    }else if(pwd==""){
      alert("密碼請勿空白");
    }else if(capt==""){
      alert("驗證碼請勿空白");
    }else{
      
      if(phone.length!=10 || phone.substr(0,2) != "09")
        alert("手機格式不對。");
      else{
        document.getElementById("form-login").action = "./temp/login_temp.php";
        document.getElementById("form-login").submit();
      }
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
            </li>-->
        <!--下拉選單-->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">系列禮服</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="./dressitem.php?dress_type=a">公主型</a> 
                <a class="dropdown-item" href="./dressitem.php?dress_type=b">王后型</a>
                <a class="dropdown-item" href="./dressitem.php?dress_type=c">拖尾型</a>
                <a class="dropdown-item" href="./dressitem.php?dress_type=e">貼身型</a>
                <!--<a class="dropdown-item" href="./dressitem.php">蓬裙型</a> -->
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
  <form action="#" method="POST" id="form-login">
    <div class="container">
    <div class="row jumbotron">
     <div class="col-md-6 col-md-offset-8"> 
     <h2 class="text-center">會員登入</h2>
     <hr>
     <div class="form-group">
     <label for="input-nick">電話  ：</label>
     <input type="phone" class="form-control" tabindex="1" \
     autocorrect="off" autocapitalize="off" autocomplete="off" onkeyup="value=value.replace(/[^\d]/g,'') " \
     <?php echo 'value="'.$_SESSION['input_phone'].'" '; ?>
     id="input-phone" name="input-phone">
     </div>
    	 <br>
     <div class="form-group">
     <label for="input-password">密碼  ：</label>
     <input type="password" class="form-control" id="input-password" name="input-password" tabindex="2">
     </div>
    	<br>
      <div class="form-group">
        <label for="input-nick">請輸入驗證碼</label>
        <input type="text" class="form-captcha" id="captch" name="captch" class="form-control" tabindex="3" \
        onkeyup="value=value.replace(/[^\d]/g,'')" placeholder="驗證碼" autocorrect="off" autocapitalize="off" autocomplete="off" tabindex="4">
        <img src="./temp/captcha.php" id="rand-img" />
        <div>
          <a href="#" onclick="captchang()">看不清楚點我</a>
        </div>
      </div>
    <input type="button" class="btn btn-primary btn-lg btn-block" value="登入" id="login_" tabindex="4" onclick="login_check()">
    	</div>
    	</div>
    </div>
  </form>

	<script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap-4.0.0.js"></script>

</body>
</html>
<?php
unset($_SESSION['input_phone']);
unset($_SESSION['input_pwd']);
?>