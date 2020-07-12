<?php 
$data = mysqli_query($conn, "SELECT * FROM tb_saldo ORDER BY id DESC");
$kd = mysqli_fetch_assoc($data);

if (isset($_POST['simpan'])) {
	$tanggal=$_POST["tanggal"];
	$uraian=$_POST["uraian"];
	$debit=$_POST["debit"];
	$kredit=$_POST["kredit"];
	$saldo=$_POST["saldo"];
	$query= "INSERT INTO tb_saldo VALUES ('', '$tanggal', '$uraian', '$debit', '$kredit', '$saldo')";
	mysqli_query($conn, $query);
	if (mysqli_affected_rows($conn) > 0){
		echo "<script>document.location.href='".url('debit_kredit')."'</script>";
	}
}

?>
<title>Debit/Kredit</title>
<div class="row">
	<div class="col-lg-12">
		<div class="card-box">
			<h4 class="m-t-0 header-title text-center" style="margin-bottom: 20px;"><b>Tambah Data</b></h4>
			<hr>
			<form class="form-horizontal" role="form" method="POST">
				<div class="form-group">
					<label class="col-sm-3 control-label">Tanggal</label>
					<div class="col-sm-7">
						<input type="date" class="form-control" name="tanggal" value="<?= date('Y-m-d') ?>" required>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Uraian</label>
					<div class="col-sm-7">
						<input type="text" class="form-control" name="uraian" placeholder="Uraian" autocomplete="off" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Debit/Kredit</label>
					<div class="col-sm-7">
						<select class="form-control" id="pilihan">
							<option value="">---Pilih---</option>
							<option value="debit" id="">Debit</option>
							<option value="kredit" id="val_kredit">Kredit</option>
						</select>
					</div>
				</div>
				<div hidden class="form-group" id="set_debit">
					<label class="col-sm-3 control-label">Jumlah Debit</label>
					<div class="col-sm-7">
						<input type="number" class="form-control" id="debit" name="debit" placeholder="Jumlah Debit" autocomplete="off">
					</div>
				</div>
				<div hidden class="form-group" id="set_kredit">
					<label class="col-sm-3 control-label">Jumlah Kredit</label>
					<div class="col-sm-7">
						<input type="number" id="kredit" class="form-control" name="kredit" placeholder="Jumlah Kredit" autocomplete="off">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Saldo</label>
					<div class="col-sm-7">
						<input type="hidden" value="<?= $kd['saldo'] ?>" id="saldo">
						<input readonly="true" type="number" class="form-control" name="saldo" id="set_saldo" value="" placeholder="Saldo">
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-7">
						<input type="hidden" value="<?= $value ?>" name="action">
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

<script>
	$(document).ready(function() {
		$('#pilihan').change(function() {
			var pilihan = $('#pilihan').val();
			if (pilihan == 'debit') {
				$('#set_debit').removeAttr('hidden', '');
				$('#set_kredit').attr('hidden', '');
				$('#debit').val('');
				$('#kredit').val('0');
			}
			else if (pilihan == 'kredit') {
				$('#set_kredit').removeAttr('hidden', '');
				$('#set_debit').attr('hidden', '');
				$('#kredit').val('');
				$('#debit').val('0');
			}
			else {
				$('#set_debit').attr('hidden', '');
				$('#set_kredit').attr('hidden', '');
			}
		});

		if ($('#saldo').val() <= 0 || $('#saldo').val() == null) {
			$('#val_kredit').attr('disabled', '');
		}

		var saldo = $('#saldo').val();
		if (saldo == '') $('#set_saldo').val('');
		else $('#set_saldo').val(saldo);

		$('#pilihan').blur(function() {
			var pilihan = $('#pilihan').val();
			$('#'+pilihan).keyup(function() {
				var debit = parseInt($('#debit').val());
				var kredit = parseInt($('#kredit').val());
				var saldo = parseInt($('#saldo').val());
				if ($('#saldo').val() == '') {
					$('#set_saldo').val(debit);
				}
				else {
					var saldo_akhir = saldo + debit - kredit;
					$('#set_saldo').val(saldo_akhir);
				}

				if ($('#'+pilihan).val() <= 0 || $('#'+pilihan).val() == null) {
					$('#set_saldo').val(saldo);
				}
			});
		});
	});
</script>