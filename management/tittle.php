
<?php session_start(); 

  if(!isset($_SESSION['user_id']) || !isset($_SESSION['user_phone']) || $_SESSION['user_permission'] != 1){
    header('Location: ../index.html');
  }

echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container">
			<a class="navbar-brand" href="./index.html">愛麗絲禮服  Iris Dress</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a class="nav-link" href="../aboutus.html">關於我們</a>
					</li>
					<!--<li class="nav-item">
						<a class="nav-link" href="#">使用說明</a>
					</li>-->
					<!--下拉選單-->
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">系列禮服</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="../dressitem.php?dress_type=a">公主型</a> 
							<a class="dropdown-item" href="../dressitem.php?dress_type=b">王后型</a>
							<a class="dropdown-item" href="../dressitem.php?dress_type=c">拖尾型</a>
							<a class="dropdown-item" href="../dressitem.php?dress_type=e">貼身型</a>
							<!--a class="dropdown-item" href="../dressitem.php">蓬裙型</a--> 
						</div>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">會員</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="../register.php">註冊</a> 
							<a class="dropdown-item" href="../login.php">登入</a>
							<a class="dropdown-item" href="../temp/login_temp.php">登出</a>
						</div>
					</li>
					<br>
					<li class="nav-item">
						<a class="nav-link" href="../reservation.php">我的預約車</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="./member_manage.php">會員管理</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="./dress_manage.php">商品管理</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>';
?>