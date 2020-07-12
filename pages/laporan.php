<?php 
$all = ''; $day = ''; $mon = '';
if (isset($_GET['value'])) {
  $value = $_GET['value'];
  $data = mysqli_query($conn, "SELECT * FROM tb_saldo WHERE tanggal LIKE '%$value%'");

  if (strlen($value) > 3) {
    $day = "selected";
    $judul = "Laporan Rekap Debit/Kredit (".date('d F Y', strtotime($value)).")";
    echo "<script>$(document).ready(function() { $('#day').removeAttr('hidden', ''); $('#tanggal').val('".$value."')})</script>";
  }
  else if (strlen($value) == 3) {
    $mon = "selected";
    $judul = "Laporan Rekap Debit/Kredit (".date('F', strtotime(substr($value, 0,2))).")";
    echo "<script>$(document).ready(function() { $('#mon').removeAttr('hidden', ''); $('#bulan').val('".substr($value, 0,2)."')})</script>";
  }
  $debit = jumlah('debit', $value);
  $kredit = jumlah('kredit', $value);
  $saldo = jumlah('saldo', $value);
}
else {
  $data = mysqli_query($conn, "SELECT * FROM tb_saldo");
  $debit = jumlah('debit', '0');
  $kredit = jumlah('kredit', '0');
  $saldo = jumlah('saldo', '0');
  $judul = "Laporan Rekap Debit/Kredit";
}
?>
<title><?= $judul ?></title>
<div class="row">
  <div class="col-sm-12">
    <div class="card-box table-responsive">
      <h4 class=" header-title"><b>Laporan</b></h4>
      <hr>
      <form class="form-horizontal" role="form" method="">
        <div class="row">
          <div class="col-sm-4 border">
            <div class="form-group">
              <label class="col-sm-6 control-label">Jenis Laporan</label>
              <div class="col-sm-6">
                <select class="form-control" id="pilihan">
                  <option <?= $all ?> value="all">Semua Data</option>
                  <option <?= $day ?> value="day">Data Harian</option>
                  <option <?= $mon ?> value="mon">Data Bulanan</option>
                </select>
              </div>
            </div>
          </div>
          <div hidden id="day" class="col-sm-4">
            <div class="form-group">
              <label class="col-sm-6 control-label">Tanggal</label>
              <div class="col-sm-6">
                <input type="date" class="form-control" id="tanggal" value="" required>
              </div>
            </div>
          </div>
          <div hidden id="mon" class="col-sm-4">
            <div class="form-group">
              <label class="col-sm-6 control-label">Bulan</label>
              <div class="col-sm-6">
                <select class="form-control" id="bulan">
                  <option value="">---Pilih Bulan---</option>
                  <option value="01">Januari</option>
                  <option value="02">Februari</option>
                  <option value="03">Maret</option>
                  <option value="04">April</option>
                  <option value="05">Mei</option>
                  <option value="06">Juni</option>
                  <option value="07">Juli</option>
                  <option value="08">Agustus</option>
                  <option value="09">September</option>
                  <option value="10">Oktober</option>
                  <option value="11">November</option>
                  <option value="12">Desember</option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </form>
      <div class="row m-b-10">
        <div class="col-lg-4">
          <table class="table table-bordered m-0">  
            <thead>
              <tr>
                <th class="text-center">Total Debit</th>
                <th class="text-center">Total Kredit</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center"><label class="text-success"><b>Rp. <?= $debit ?></b></label></td>
                <td class="text-center"><label class="text-success"><b>Rp. <?= $kredit ?></b></label></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <table id="datatable-buttons" class="table table-striped table-bordered">
        <thead>
          <tr>
            <th> No </th>
            <th> Tanggal </th>
            <th> Uraian </th>
            <th> Debit </th>
            <th> Kredit </th>
            <th> Saldo </th>
          </tr>
        </thead>
        <tbody id="fill">
          <?php $no = 1; foreach ($data as $dta) : ?>
          <tr>
            <td><?= $no ?></td>
            <td><?= date('d M Y', strtotime($dta['tanggal'])) ?></td>
            <td><?= $dta['uraian'] ?></td>
            <td><?= uang($dta['debit']) ?></td>
            <td><?= uang($dta['kredit']) ?></td>
            <td><?= uang($dta['saldo']) ?></td>
          </tr>
          <?php $no = $no + 1; endforeach ?>
          <?php if ($no > 1) : ?>
            <tr>
              <td hidden>N</td>
              <td hidden></td>
              <td colspan="3" class="text-center"><b>Jumlah</b></td>
              <td><b><?= $debit ?></b></td>
              <td><b><?= $kredit ?></b></td>
              <td><b><?= $saldo ?></b></td>
            </tr>
          <?php endif ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('#pilihan').change(function() {
      var pilihan = $('#pilihan').val();
      if (pilihan == 'day') {
        $('#day').removeAttr('hidden', '');
        $('#mon').attr('hidden', '');
      }
      else if (pilihan == 'mon') {
        $('#mon').removeAttr('hidden', '');
        $('#day').attr('hidden', '');
      }
      else {
        $('#day').attr('hidden', '');
        $('#mon').attr('hidden', '');
        document.location.href="<?= url('laporan') ?>";
      }
    });

    $('#tanggal').change(function() {
      var tanggal = $('#tanggal').val();
      document.location.href="<?= url('laporan').'&value=' ?>"+tanggal;
    });

    $('#bulan').change(function() {
      var bulan = $('#bulan').val()+'-';
      document.location.href="<?= url('laporan').'&value=' ?>"+bulan;
    });
  });
</script>