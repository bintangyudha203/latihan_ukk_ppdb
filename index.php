<!DOCTYPE html>
<html>
<head>
	<title>Latihan UKK v2 - Dashboard</title>
	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
</head>

<?php
	$con = mysqli_connect('localhost','root','','latihan_ukk_2');

	if( isset($_POST['simpan']) ){

		$id = "";
		$nis = $_POST['nis'];
		$nama = $_POST['nama'];
		$jenis_kelamin = $_POST['jenis_kelamin'];
		$tempat_lahir = $_POST['tempat_lahir'];
		$tanggal_lahir = $_POST['tanggal_lahir'];
		$alamat = $_POST['alamat'];
		$asal_sekolah = $_POST['asal_sekolah'];
		$kelas = $_POST['kelas'];
		$jurusan = $_POST['jurusan'];

		// cek data
		if($nis == "" || $nama == "" || $jenis_kelamin == "" || $tempat_lahir == "" || $tanggal_lahir == "" || $alamat == "" || $asal_sekolah == "" || $kelas == "" || $jurusan == "" ){
			echo "<script>alert('Data tidak lengkap');
			document.location.href='index.php'</script>";
		}else{
			// cek data in database
			$cek_data = mysqli_query($con, "SELECT * FROM tb_siswa WHERE nis = '$nis'");
			$cek_total_data = mysqli_num_rows($cek_data);

			if($cek_total_data > 0){
				echo "<script>alert('NIS telah digunakan');
				document.location.href='index.php'</script>";
			}else{
			
				$save_data = mysqli_query($con, "INSERT INTO tb_siswa (id,nis,nama,jenis_kelamin,tempat_lahir,tanggal_lahir,alamat,asal_sekolah,kelas,jurusan) values ('', '$nis', '$nama', '$jenis_kelamin', '$tempat_lahir', '$tanggal_lahir', '$alamat', '$asal_sekolah', '$kelas', '$jurusan')");
				if($save_data){
					echo "<script>alert('Data berhasil disimpan');
					document.location.href='index.php'</script>";
				}else{
					echo "<script>alert('Data gagal disimpan');
					document.location.href='index.php'</script>";
				}
			}
		}

	}

?>

<body>
	<br>
	<div class="text-center bg-info" style="padding: 10px;">
			<h2>Selamat datang di PPDB 2021</h2>
		</div>
	<div class="container">
		<br>
		<div class="row">
			<div class="col-sm-12 col-md-6">
				<div class="card">
					<div class="card-header">
						Daftar Segera !
					</div>
					<div class="card-body">
						<form method="post">
							<div class="mb-3">
								<div class="form-group">
									<div class="row">
										<div class="col-6">
											<small class="text-muted">NIS</small>
											<input required="" type="number" class="form-control" name="nis">
										</div>
										<div class="col-6">
											<small class="text-muted">Nama</small>
											<input required="" type="text" class="form-control" name="nama">
										</div>
									</div>
								</div>
							</div>

							<div class="mb-3">
								<div class="form-group">
									<div class="row">
										<div class="col-6">
											<small class="text-muted">Jenis kelamin</small>
											<select class="form-control" name="jenis_kelamin">
												<option value="Laki-laki">Laki-laki</option>
												<option value="Perempuan">Perempuan</option>
											</select>
										</div>
										<div class="col-6">
											<small class="text-muted">Alamat</small>
											<textarea required="" class="form-control" name="alamat"></textarea>
										</div>
									</div>
								</div>
							</div>

							<div class="mb-3">
								<div class="form-group">
									<div class="row">
										<div class="col-6">
											<small class="text-muted">Tempat lahir</small>
											<input required="" type="text" class="form-control" name="tempat_lahir">
										</div>
										<div class="col-6">
											<small class="text-muted">Tanggal lahir</small>
											<input required="" type="date" class="form-control" name="tanggal_lahir">
										</div>
									</div>
								</div>
							</div>

							<div class="mb-3">
								<div class="form-group">
									<small class="text-muted">Asal Sekolah</small>
									<input required="" type="text" class="form-control" name="asal_sekolah">
								</div>
							</div>

							<div class="mb-3">
								<div class="form-group">
									<div class="row">
										<div class="col-6">
											<small class="text-muted">Kelas</small>
											<select class="form-control" name="kelas">
												<option value="x">X</option>
												<option value="xi">XI</option>
												<option value="xii">XII</option>
											</select>
										</div>
										<div class="col-6">
											<small class="text-muted">Jurusan</small>
											<select class="form-control" name="jurusan">
												<option value="TKJ">TKJ</option>
												<option value="RPL">RPL</option>
												<option value="Multimedia">Multimedia</option>
												<option value="OTKP">OTKP</option>
												<option value="BDP">BDP</option>
												<option value="TBG">TBG</option>
												<option value="HTL">HTL</option>
											</select>
										</div>
									</div>		
								</div>
							</div>

							<input type="submit" class="btn btn-info" name="simpan" value="Simpan"> &nbsp;
							<a class="btn btn-secondary	" onclick="reset()">Reset</a>
						</form>
					</div>
				</div>
			</div>

			<div class="col-sm-12 col-md-6">
				<div class="card">
					<div class="card-header">
						Data siswa yang telah mendaftar !	
					</div>
					<div class="card-body">
						<table class="text-center" id="table_murid">
							<thead>
								<tr>
									<th>Nama</th>
									<th>Asal sekolah</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$sql = mysqli_query($con,"SELECT * FROM tb_siswa");
								$no = 0;
								while($row = mysqli_fetch_array($sql)){
									$no++
									?>
										<tr>
											<td><?= $row['nama']; ?></td>
											<td><?= $row['asal_sekolah']; ?></td>
										</tr>
									<?php
									}
								?>
							</tbody>
						</table>
					</div>
				</div>
						
			</div>
		</div>
	</div>
</body>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

	<script type="text/javascript">
		$(document).ready( function () {
		    $('#table_murid').DataTable();
		});
		function reset() {
			document.location.href='index.php'
		}
	</script>
</html>