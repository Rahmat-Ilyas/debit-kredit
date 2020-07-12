<?php 
$data = mysqli_query($conn, "SELECT * FROM tb_admin");
$dta = mysqli_fetch_assoc($data);
$username = $dta['username'];

if (isset($_POST['simpan'])) {
	$username=$_POST["username"];
	$password=$_POST["password"];
	$pass = password_hash($password, PASSWORD_DEFAULT);
	$query= "UPDATE tb_admin SET username = '$username', password = '$pass'";
	if (mysqli_query($conn, $query)) {
		echo "<script>alert('Akun berhasil di perbaharui');document.location.href='".url('debit_kredit')."'</script>";
	}
}

?>
<title>Debit/Kredit</title>
<div class="row">
	<div class="col-lg-12">
		<div class="card-box">
			<h4 class="m-t-0 header-title text-center" style="margin-bottom: 20px;"><b>Atur Akun Login</b></h4>
			<hr>
			<form class="form-horizontal" role="form" method="POST">
				<div class="form-group">
					<label class="col-sm-4 control-label">Username</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" name="username" placeholder="Username" autocomplete="off" value="<?= $username ?>" required>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-4 control-label">Password Baru</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" name="password" placeholder="Password Baru" autocomplete="off" required>
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-4">
						<button type="submit" class="btn btn-default waves-effect waves-light" name="simpan">
							<i class="fa fa-save"></i>&nbsp;Simpan
						</button>
						<a href="<?= url('debit_kredit') ?>" role="button" class="btn btn-danger waves-effect waves-light m-l-5 batal">
							<i class="fa fa-times-circle"></i>&nbsp;Batal
						</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>