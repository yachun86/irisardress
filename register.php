<?php session_start(); ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>愛麗絲禮服  AR</title>
<link href="css/bootstrap-4.0.0.css" rel="stylesheet">
<style type="text/css">
  .errortxt{
    display: inline;
    color:red;
    font-size:12px;
  } 
</style>
<script language="javascript">
  var email_ck = false;
  var name_ck = false;
  var phone_ck = false;
  var pwd_ck = false;
  var repwd_ck = false;

  function emailck(){
    var email = register_form.user_email.value.trim();
    if(email == ""){
      document.getElementById("email-error").innerHTML = "請輸入E-mail。";
      email_ck = false;
    }
    else{
      document.getElementById("user_email").value = email;
      document.getElementById("email-error").innerHTML = "";
      email_ck = true;
    }
  }
  function nameck(){
    var name = register_form.user_name.value.trim();
    if(name == ""){
      document.getElementById("name-error").innerHTML = "請輸入姓名。";
      name_ck = false;
    }
    else{
      document.getElementById("user_name").value = name;
      document.getElementById("name-error").innerHTML = "";
      name_ck = true;
    }
  }
  function phoneck(){
    var phone = register_form.user_phone.value.trim();
    if(phone == ""){
      document.getElementById("phone-error").innerHTML = "請輸入手機號碼。";
      phone_ck = false;
    }
    else if(phone.length != 10 || phone.substr(0,2) != "09"){
      document.getElementById("phone-error").innerHTML = "請依照格式輸入正確手機號碼(10碼)。";
      phone_ck = false;
    }else{
      /*var phone_check = window.open('./temp/regist_temp.php?phone_check=' + phone + "&post_check=3" ,'','scrollbars=no,menubar=no,height=315,width=450,resizable=no,toolbar=no,location=no,status=no');
      alert(phone_check);*/

      document.getElementById("user_phone").value = phone;
      document.getElementById("phone-error").innerHTML = "";
      phone_ck = true;
    }
  }
  function pwdck(){
    var pwd = register_form.user_pwd.value.trim();
    if(pwd == ""){
      document.getElementById("pwd-error").innerHTML = "請輸入密碼。";
      pwd_ck = false;
    }
    else{
      document.getElementById("user_pwd").value = pwd;
      document.getElementById("pwd-error").innerHTML = "";
      pwd_ck = true;
    }
  }
  function repwdck(){
    var repwd = register_form.re_user_pwd.value.trim();
      if(repwd == ""){
        document.getElementById("repwd-error").innerHTML = "請再次輸入密碼。";
        repwd_ck = false;
      }
      else if(repwd != register_form.user_pwd.value.trim()){
        document.getElementById("repwd-error").innerHTML = "兩次密碼輸入不相同";
        repwd_ck = false;
      }
      else{
        document.getElementById("re_user_pwd").value = repwd;
        document.getElementById("repwd-error").innerHTML = "";
        repwd_ck = true;
      }
  }
  function btnck(){
    var name = document.getElementById('user_name').value;
    var pwd = document.getElementById('user_pwd').value;
    var phone = document.getElementById('user_phone').value;
    var email = document.getElementById('user_email').value;

    emailck();
    nameck();
    phoneck();
    pwdck();

    if(name_ck && pwd_ck && repwd_ck && phone_ck && email_ck){
      //var txt = "name:" + name + "\npwd:" + pwd + "\nphone:" + phone + "\nemail:" + email;
      //alert(txt);
      register_form.action = "./temp/regist_temp.php?post_check=2";
      register_form.submit();
    }else{
      alert("請填寫完整資料");
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
              </div> 
          </li><br>
          <li class="nav-item">
            <a class="nav-link" href="./reservation.php">我的預約車</a>
          </li><br>
        </ul>
      </div>
      </div>
    </nav>
	   
<form action="#" method="post" id="register_form">

   <div class="container">
     <div class="row jumbotron">
       <div class="col-md-6 col-md-offset-6"> 
         <h2 class="text-center">會員註冊</h2>
         <hr>
         <div class="form-group">
           <label for="user_email">Email ：</label>
           <input type="email" class="form-control" id="user_email" name="user_email" 
           <?php echo 'value="'.$_SESSION['user_email'].'"'; ?> \
           autocorrect="off" autocapitalize="off" autocomplete="off" onblur="emailck()">
           <div><span id="email-error" for="pass_repeat" generated="true" class="errortxt"></span></div>
         </div>
         <br>
       <div class="form-group">
         <label for="user_name">姓名  ：</label>
         <input type="text" class="form-control" id="user_name" name="user_name" 
         <?php echo 'value="'.$_SESSION['user_name'].'"'; ?> \
         autocorrect="off" autocapitalize="off" autocomplete="off" onblur="nameck()">
         <div><span id="name-error" for="pass_repeat" generated="true" class="errortxt"></span></div>
       </div>
         <br>
       <div class="form-group">
         <label for="user_phone ">電話  ：</label>
         <input type="phone" class="form-control" id="user_phone" name="user_phone" \
         autocorrect="off" autocapitalize="off" autocomplete="off" onkeyup="value=value.replace(/[^\d]/g,'') " onblur="phoneck()">
         <div><span id="phone-error" for="pass_repeat" generated="true" class="errortxt"></span></div>
       </div>
         <br>
       <div class="form-group">
         <label for="user_pwd">密碼  ：</label>
         <input type="password" class="form-control" id="user_pwd" name="user_pwd" 
         <?php echo 'value="'.$_SESSION['user_pwd'].'"'; ?> \
         autocorrect="off" autocapitalize="off" autocomplete="off" onblur="pwdck()">
         <div><span id="pwd-error" for="pass_repeat" generated="true" class="errortxt"></span></div>
       </div>
        <br>
        <div class="form-group">
         <label for="user_repwd">請再輸入一次密碼  ：</label>
         <input type="password" class="form-control" id="re_user_pwd" name="re_user_pwd"  \
         autocorrect="off" autocapitalize="off" autocomplete="off" onblur="repwdck()">
         <div><span id="repwd-error" for="pass_repeat" generated="true" class="errortxt"></span></div>
       </div>
        <br>
       <!-- <input type="submit" class="btn btn-primary btn-lg btn-block" value="註冊" name="submit"> -->
       <button type="button" class="btn btn-primary btn-lg btn-block" onclick="btnck()">註冊</button>
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
unset($_SESSION['user_email']);
unset($_SESSION['user_name']);
unset($_SESSION['user_phone']);
unset($_SESSION['user_pwd']);
?>