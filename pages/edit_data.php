<?php 
$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM tb_saldo WHERE ID = '$id'");
$dta = mysqli_fetch_assoc($data);

$data1 = mysqli_query($conn, "SELECT * FROM tb_saldo");
$dta1 = mysqli_fetch_assoc($data1);
if ($dta1['ID'] == $id) {
	$data_updt = mysqli_query($conn, "SELECT * FROM tb_saldo WHERE ID = '$id'");
	$gdta = mysqli_fetch_assoc($data_updt);
}
else {
	foreach ($data1 as $i => $get) {
		$id_q[] = $get['ID'];	
		if ($id_q[$i] == $id) {
			$index = $i-1;
			$get_id = $id_q[$index];
			$data_updt = mysqli_query($conn, "SELECT * FROM tb_saldo WHERE ID = '$get_id'");
			$gdta = mysqli_fetch_assoc($data_updt);
		}
	}
}

if (isset($_POST['update'])) {
	$tanggal=$_POST["tanggal"];
	$uraian=$_POST["uraian"];
	$debit=$_POST["debit"];
	$kredit=$_POST["kredit"];
	$saldo=$_POST["saldo"];
	$query= "UPDATE tb_saldo SET tanggal = '$tanggal', uraian = '$uraian', debit = '$debit', kredit = '$kredit', saldo = '$saldo' WHERE ID = '$id'";

	mysqli_query($conn, $query);
	
	foreach ($data1 as $updt) {
		if ($updt['ID'] > $id) {
			$id_updt = $updt['ID'];
			$updt_saldo = $saldo + $updt['debit'] - $updt['kredit'];
			$query ="UPDATE tb_saldo SET saldo = '$updt_saldo' WHERE ID = '$id_updt'";
			mysqli_query($conn, $query);
			if (mysqli_affected_rows($conn)>0) $saldo = $updt_saldo;
		}
	}

	echo "<script>document.location.href='".url('debit_kredit')."'</script>";
}

?>
<title>Debit/Kredit</title>
<div class="row">
	<div class="col-lg-12">
		<div class="card-box">
			<h4 class="m-t-0 header-title text-center" style="margin-bottom: 20px;"><b>Tambah Data</b></h4>
			<hr>
			<form class="form-horizontal" role="form" method="POST">
				<div class="form-group row">
					<label class="col-sm-3 control-label">Tanggal</label>
					<div class="col-sm-7">
						<input type="date" class="form-control" name="tanggal" value="<?= $dta['tanggal'] ?>" required>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-3 control-label">Uraian</label>
					<div class="col-sm-7">
						<input type="text" class="form-control" name="uraian" value="<?= $dta['uraian'] ?>" placeholder="Uraian" autocomplete="off" required>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-3 control-label">Debit/Kredit</label>
					<div class="col-sm-7">
						<select class="form-control" id="pilihan">
							<option value="">---Pilih---</option>
							<option value="debit" <?php  if ($dta['debit'] > 0) echo"selected" ?> id="">Debit</option>
							<option value="kredit" <?php  if ($dta['kredit'] > 0) echo"selected" ?> id="val_kredit">Kredit</option>
						</select>
					</div>
				</div>
				<div hidden class="form-group row" id="set_debit">
					<label class="col-sm-3 control-label">Jumlah Debit</label>
					<div class="col-sm-7">
						<input type="number" class="form-control" id="debit" name="debit" value="<?= $dta['debit'] ?>" placeholder="Jumlah Debit" autocomplete="off">
					</div>
				</div>
				<div hidden class="form-group row" id="set_kredit">
					<label class="col-sm-3 control-label">Jumlah Kredit</label>
					<div class="col-sm-7">
						<input type="number" id="kredit" class="form-control" name="kredit" value="<?= $dta['kredit'] ?>" placeholder="Jumlah Kredit" autocomplete="off">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-3 control-label">Saldo</label>
					<div class="col-sm-7">
						<input type="hidden" value="<?= $gdta['saldo'] ?>" id="saldo">
						<input readonly="true" type="number" class="form-control" name="saldo" id="set_saldo" value="<?= $dta['saldo'] ?>" placeholder="Saldo">
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-7">
						<input type="hidden" value="<?= $value ?>" name="action">
						<button type="submit" class="btn btn-default waves-effect waves-light" name="update">
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

<script>
	$(document).ready(function() {
		if ($('#debit').val() > 0) $('#set_debit').removeAttr('hidden', '');
		if ($('#kredit').val() > 0) $('#set_kredit').removeAttr('hidden', '');

		$(document).on('change', '#pilihan', function() {
			var saldo = $('#saldo').val();
			var pilihan = $('#pilihan').val();
			if (pilihan == 'debit') {
				$('#set_debit').removeAttr('hidden', '');
				$('#set_kredit').attr('hidden', '');
				$('#debit').val('');
				$('#kredit').val('0');
				$('#set_saldo').val(saldo);
			}
			else if (pilihan == 'kredit') {
				$('#set_kredit').removeAttr('hidden', '');
				$('#set_debit').attr('hidden', '');
				$('#kredit').val('');
				$('#debit').val('0');
				$('#set_saldo').val(saldo);
			}
			else {
				$('#set_debit').attr('hidden', '');
				$('#set_kredit').attr('hidden', '');
				$('#set_saldo').val(saldo);
			}
		});

		$('#pilihan').blur(function() {
			var pilihan = $('#pilihan').val();
			$('#'+pilihan).keyup(function() {
				var debit = parseInt($('#debit').val());
				var kredit = parseInt($('#kredit').val());
				var saldo = parseInt($('#saldo').val());

				var saldo_akhir = saldo + debit - kredit;
				$('#set_saldo').val(saldo_akhir);

				if ($('#'+pilihan).val() <= 0) {
					$('#set_saldo').val(saldo);
				}
			});
		});

		var pilihan = $('#pilihan').val();
		$('#'+pilihan).keyup(function() {
			var debit = parseInt($('#debit').val());
			var kredit = parseInt($('#kredit').val());
			var saldo = parseInt($('#saldo').val());

			var saldo_akhir = saldo + debit - kredit;
			$('#set_saldo').val(saldo_akhir);

			if ($('#'+pilihan).val() <= 0) {
				$('#set_saldo').val(saldo);
			}
		});
	});
</script>