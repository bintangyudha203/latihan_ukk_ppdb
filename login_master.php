<!DOCTYPE html>
<html>
<head>
	<title>Latihan UKK v2 - Login</title>
	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
</head>

<?php
	$con = mysqli_connect('localhost','root','','latihan_ukk_2');

	if( isset($_POST['login']) ){

		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$data_admin = mysqli_query($con,"SELECT * FROM tb_admin WHERE username = '$username' AND password = '$password'");

		$cek = mysqli_num_rows($data_admin);
		

		if($cek > 0){
			session_start();
			$_SESSION['username'] = $username;
			$_SESSION['status'] = "login";
			header("location:master.php");
		}else{
			header("location:login_master.php?pesan=gagal");
		}
	}

	if( isset($_POST['logout']) ){
		session_start();
		session_destroy();
		header("location/login_master.php?pesan=logout");
	}
	
?>

<body>
	<br>
	<div class="text-center bg-info" style="padding: 10px;">
			<h2>Halaman login - logout</h2>
		</div>
	<div class="container">
		<br>
		<?php 
			if(isset($_GET['pesan'])){
				if($_GET['pesan'] == "gagal"){
					echo "Login gagal! username dan password salah!";
					echo "<br>";
				}else if($_GET['pesan'] == "logout"){
					echo "Anda telah berhasil logout";
					echo "<br>";
				}else if($_GET['pesan'] == "belum_login"){
					echo "Anda harus login untuk mengakses halaman master";
					echo "<br>";
				}
			}
			session_start();
			if(isset($_SESSION['status'])){

		?>
		<form method="post">		
			<input type="submit" class="btn btn-info" name="logout" value="Logout">
		</form>
		<?php
			}else{
		?>
		<br>
		<div class="row">
			<div class="col-sm-12 col-md-5">
				<div class="card">
					<div class="card-header">
						Masukkan data anda !
					</div>
					<div class="card-body">
						<form method="post">
							
							<div class="mb-3">
								<div class="form-group">	
									<small class="text-muted">Username</small>
									<input required="" type="text" class="form-control" name="username" >
								</div>
							</div>
		
							<div class="mb-3">
								<div class="form-group">
									<small class="text-muted">Password</small>
									<input required="" type="password" class="form-control" name="password" >
								</div>
							</div>

							<input type="submit" class="btn btn-info" name="login" value="Login">
						</form>
					</div>
				</div>
			</div>
		</div>
		<?php
			}
		?>
	</div>
</body>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

</html>