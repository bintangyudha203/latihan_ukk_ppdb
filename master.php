<!DOCTYPE html>
<html>
<head>
	<title>Latihan UKK v2 - Master</title>
	
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
			document.location.href='master.php'</script>";
		}else{
			// cek data in database
			$cek_data = mysqli_query($con, "SELECT * FROM tb_siswa WHERE nis = '$nis'");
			$cek_total_data = mysqli_num_rows($cek_data);

			if($cek_total_data > 0){
				echo "<script>alert('NIS telah digunakan');
				document.location.href='master.php'</script>";
			}else{
			
				$save_data = mysqli_query($con, "INSERT INTO tb_siswa (id,nis,nama,jenis_kelamin,tempat_lahir,tanggal_lahir,alamat,asal_sekolah,kelas,jurusan) values ('', '$nis', '$nama', '$jenis_kelamin', '$tempat_lahir', '$tanggal_lahir', '$alamat', '$asal_sekolah', '$kelas', '$jurusan')");
				if($save_data){
					echo "<script>alert('Data berhasil disimpan');
					document.location.href='master.php'</script>";
				}else{
					echo "<script>alert('Data gagal disimpan');
					document.location.href='master.php'</script>";
				}
			}
		}
	}

	if(isset($_GET['edit'])){
		$edit = mysqli_query($con,"SELECT * FROM tb_siswa WHERE nis = '$_GET[nis]'");
		$row_edit = mysqli_fetch_array($edit);
	}else{
		$row_edit = null;
	}

	if(isset ($_POST['update'])){

		// cek data in database
		$nis = $_GET['nis'];
		$get_data_siswa = mysqli_query($con, "SELECT * FROM tb_siswa WHERE nis = '$nis'");
		$data_siswa = mysqli_fetch_array($get_data_siswa);
		$id = $data_siswa['id'];

		$cek_data = mysqli_query($con, "SELECT * FROM tb_siswa WHERE id != '$id' AND nis = '$nis'");
		$cek_total_data = mysqli_num_rows($cek_data);

		if($cek_total_data > 0){
			echo "<script>alert('NIS telah digunakan');
				document.location.href='master.php'</script>";
		}else{
			$update_data = mysqli_query($con,"UPDATE tb_siswa SET nis = '$_POST[nis]', nama = '$_POST[nama]', jenis_kelamin = '$_POST[jenis_kelamin]', tempat_lahir = '$_POST[tempat_lahir]', tanggal_lahir = '$_POST[tanggal_lahir]', alamat = '$_POST[alamat]', asal_sekolah = '$_POST[asal_sekolah]', kelas = '$_POST[kelas]', jurusan = '$_POST[jurusan]' WHERE id = '$id'");
			if($update_data) {
				echo "<script>alert('Data berhasil di Update');
				document.location.href='master.php'</script>";
			}else{
				echo "<script>alert('Data gagal di Update');
				document.location.href='master.php'</script>";
			}
		}
	}

	if(isset($_GET['hapus'])){
		$nis = $_GET['nis'];
		$get_data_siswa = mysqli_query($con, "SELECT * FROM tb_siswa WHERE nis = '$nis'");
		$data_siswa = mysqli_fetch_array($get_data_siswa);
		$id = $data_siswa['id'];

		// print_r($id);

		$hapus_data = mysqli_query($con,"DELETE FROM tb_siswa WHERE id = '$id'");

		if($hapus_data) {
			echo "<script>alert('Data berhasil di Hapus');
			document.location.href='master.php'</script>";

		}else{
			echo "<script>alert('Data gagal dihapus');
			document.location.href='master.php'</script>";

		}
	}

	session_start();
	if($_SESSION['status']!="login"){
		header("location:login_master.php?pesan=belum_login");
	}
?>

<body>
	<br>
	<div class="text-center bg-info" style="padding: 10px;">
			<h2>Master PPDB 2021</h2>
		</div>
	<div class="container">
		<br>
		<div class="row">
			<div class="col-sm-12 col-md-3">
				<div class="card">
					<div class="card-header">
						Inputan Data !
					</div>
					<div class="card-body">
						<form method="post">
							<div class="mb-3">
								<div class="form-group">
									<small class="text-muted">NIS</small>
									<input required="" type="number" class="form-control" name="nis" value="<?= $row_edit['nis']; ?>">
								</div>
							</div>
							
							<div class="mb-3">
								<div class="form-group">
									<small class="text-muted">Nama</small>
									<input required="" type="text" class="form-control" name="nama" value="<?= $row_edit['nama']; ?>">
								</div>
							</div>
							
							<div class="mb-3">
								<div class="form-group">
									<small class="text-muted">Jenis kelamin</small>
									<select class="form-control" name="jenis_kelamin">
										<option value="Laki-laki" <?php if($row_edit['jenis_kelamin'] == "Laki-laki"){echo "selected";} ?> >Laki-laki</option>
										<option value="Perempuan" <?php if($row_edit['jenis_kelamin'] == "Perempuan"){echo "selected";} ?> >Perempuan</option>
									</select>
								</div>
							</div>

							<div class="mb-3">
								<div class="form-group">
									<small class="text-muted">Alamat</small>
									<textarea required="" class="form-control" name="alamat"><?= $row_edit['alamat']; ?></textarea>
								</div>
							</div>

							<div class="mb-3">
								<div class="form-group">
									<small class="text-muted">Tempat lahir</small>
									<input required="" type="text" class="form-control" name="tempat_lahir" value="<?= $row_edit['tempat_lahir']; ?>">
								</div>
							</div>

							<div class="mb-3">
								<div class="form-group">
									<small class="text-muted">Tanggal lahir</small>
									<input required="" type="date" class="form-control" name="tanggal_lahir" value="<?= $row_edit['tanggal_lahir']; ?>">
								</div>
							</div>

							<div class="mb-3">
								<div class="form-group">
									<small class="text-muted">Asal Sekolah</small>
									<input required="" type="text" class="form-control" name="asal_sekolah" value="<?= $row_edit['asal_sekolah']; ?>">
								</div>
							</div>

							<div class="mb-3">
								<div class="form-group">
									<small class="text-muted">Kelas</small>
									<select class="form-control" name="kelas">
										<option value="x" <?php if($row_edit['kelas'] == "x"){echo "selected";} ?> >X</option>
										<option value="xi" <?php if($row_edit['kelas'] == "xi"){echo "selected";} ?> >XI</option>
										<option value="xii" <?php if($row_edit['kelas'] == "xii"){echo "selected";} ?> >XII</option>
									</select>
								</div>
							</div>

							<div class="mb-3">
								<div class="form-group">
									<small class="text-muted">Jurusan</small>
									<select class="form-control" name="jurusan">
										<option value="TKJ" <?php if($row_edit['jurusan'] == "TKJ"){echo "selected";} ?> >TKJ</option>
										<option value="RPL" <?php if($row_edit['jurusan'] == "RPL"){echo "selected";} ?> >RPL</option>
										<option value="Multimedia" <?php if($row_edit['jurusan'] == "Multimedia"){echo "selected";} ?> >Multimedia</option>
										<option value="OTKP" <?php if($row_edit['jurusan'] == "OTKP"){echo "selected";} ?> >OTKP</option>
										<option value="BDP" <?php if($row_edit['jurusan'] == "BDP"){echo "selected";} ?> >BDP</option>
										<option value="TBG" <?php if($row_edit['jurusan'] == "TBG"){echo "selected";} ?> >TBG</option>
										<option value="HTL" <?php if($row_edit['jurusan'] == "HTL"){echo "selected";} ?> >HTL</option>
									</select>
				
								</div>
							</div>

							<?php
								if(isset ($_GET['edit'])){
									?>
									<input type="submit" class="btn btn-info" name="update" value="update">
									<a class="btn btn-secondary	" onclick="reset()">Batal</a>
									<?php
								}else{
									?>
									<input type="submit" class="btn btn-info" name="simpan" value="Simpan"> &nbsp;
									<a class="btn btn-secondary	" onclick="reset()">Reset</a>
									<?php
								}
							?>
							
						</form>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-9">
				<div class="card">
					<div class="card-header">
						Siswa Data !	
					</div>
					<div class="card-body">
						<table class=" text-center" id="table_murid" style="font-size: 13px;">
							<thead>
								<tr>
									<th>NIS</th>
									<th>Nama</th>
									<th>Jenis kelamin</th>
									<th>Tempat, Tanggal lahir</th>
									<th>Alamat</th>
									<th>Asal sekolah</th>
									<th>Kelas</th>
									<th>Jurusan</th>
									<th width="150px">Action</th>
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
											<td><?= $row['nis']; ?></td>
											<td><?= $row['nama']; ?></td>
											<td><?= $row['jenis_kelamin']; ?></td>
											<td><?= $row['tempat_lahir'].", ".$row['tanggal_lahir']; ?></td>
											<td><?= $row['alamat']; ?></td>
											<td><?= $row['asal_sekolah']; ?></td>
											<td><?= $row['kelas']; ?></td>
											<td><?= $row['jurusan']; ?></td>
											<td>
												<a class="btn btn-sm btn-info" href="master.php?edit&nis=<?= $row['nis'];?>">Edit</a>  &nbsp;
												<a class="btn btn-sm btn-danger" href="master.php?hapus&nis=<?= $row['nis'];?>"onclick="return confirm('Anda yakin ingin menghapus data ini ?');">Delete</a>
											</td>
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
			document.location.href='master.php'
		}
	</script>
</html>