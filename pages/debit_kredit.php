<?php 
$data = mysqli_query($conn, "SELECT * FROM tb_saldo");
$data2 = mysqli_query($conn, "SELECT * FROM tb_saldo ORDER BY ID DESC");
$dta_ = mysqli_fetch_assoc($data);
$kd = mysqli_fetch_assoc($data2);

if (isset($_POST["hapus"])) {
  $id = $_POST["id"];
  if ($dta_['ID'] == $id) {
     $query ="DELETE FROM tb_saldo WHERE ID = $id";
  }
  else {
    foreach ($data as $i => $get) {
      $id_q[] = $get['ID'];
      if ($id_q[$i] == $id) {
        $index = $i-1;
        $get_id = $id_q[$index];
        $data_updt = mysqli_query($conn, "SELECT * FROM tb_saldo WHERE ID = '$get_id'");
        $gdta = mysqli_fetch_assoc($data_updt);
      }
    }

    $saldo = $gdta['saldo'];
    foreach ($data as $updt) {
      if ($updt['ID'] > $id) {
        $id_updt = $updt['ID'];
        $updt_saldo = $saldo + $updt['debit'] - $updt['kredit'];
        $query ="UPDATE tb_saldo SET saldo = '$updt_saldo' WHERE ID = '$id_updt'";
        mysqli_query($conn, $query);
        if (mysqli_affected_rows($conn)>0) $saldo = $updt_saldo;
      }
    }

    $query ="DELETE FROM tb_saldo WHERE ID = $id";
  }
  mysqli_query($conn, $query);
  if (mysqli_affected_rows($conn)>0){
    echo "<script>document.location.href='".url('debit_kredit')."'</script>";

  }
}
?>
<title>Debit/Kredit</title>
<div class="row">
  <div class="col-sm-12">
    <div class="card-box table-responsive">
      <h4 class=" header-title"><b>Debit/Kredit</b></h4>
      <h5 class="text-success"><b>Saldo Akhir : Rp. <?= uang($kd['saldo']) ?></b></h5>
      <hr>
      <a href="<?= url('tambah_data') ?>" style="margin-bottom: 20px;" role="button" class="btn btn-default waves-effect waves-light tambah">
        <i class="fa fa-plus-square"></i>&nbsp;Tambah Data
      </a>
      <table id="datatable" class="table table-striped table-bordered">
        <thead>
          <tr>
            <th> No </th>
            <th> Tanggal </th>
            <th> Uraian </th>
            <th> Debit </th>
            <th> Kredit </th>
            <th> Saldo </th>
            <th> Proses </th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; foreach ($data as $dta) : ?>
          <tr>
            <td><?= $no ?></td>
            <td><?= date('d M Y', strtotime($dta['tanggal'])) ?></td>
            <td><?= $dta['uraian'] ?></td>
            <td><?= uang($dta['debit']) ?></td>
            <td><?= uang($dta['kredit']) ?></td>
            <td><?= uang($dta['saldo']) ?></td>
            <td style="min-width: 10px;">
              <a href="<?= url('edit_data').'&id='.$dta['ID'] ?>" role="button" class="btn btn-icons btn-default"><i class="fa fa-edit"></i></a>
              <button class="btn btn-icons btn-danger" type="button" data-toggle="modal" data-target="#staticModal<?= $dta['ID'] ?>"><i class="fa fa-trash-o"></i></button>
            </td>
          </tr>

          <!-- Konfirmasi Hapus -->
          <div class="modal fade" id="staticModal<?= $dta['ID'] ?>" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="staticModalLabel">Hapus Data</h5>
                </div>
                <div class="modal-body">
                  <p>Yakin ingin menghapus data ini?</p>
                </div>
                <div class="modal-footer form-inline">
                  <form method="POST">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <input type="hidden" name="id" value="<?= $dta["ID"]?>">
                    <input type="hidden" name="debit" value="<?= $dta["debit"]?>">
                    <input type="hidden" name="kredit" value="<?= $dta["kredit"]?>">
                    <button type="submit" name="hapus" class="btn btn-danger hapus">Hapus</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- End Konfirmasi Hapus -->

          <?php $no = $no + 1; endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
</div>