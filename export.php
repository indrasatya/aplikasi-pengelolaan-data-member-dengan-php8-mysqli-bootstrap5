<?php
// panggil file "database.php" untuk koneksi ke database
require_once "config/database.php";
// panggil file "fungsi_tanggal_indo.php" untuk membuat format tanggal indonesia
require_once "helper/fungsi_tanggal_indo.php";

// fungsi header untuk mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
// mendefinisikan nama file hasil ekspor "Data-Member.xls"
header("Content-Disposition: attachment; filename=Data-Member.xls");
?>
<!-- halaman HTML yang akan diexport ke excel -->
<!-- judul tabel -->
<center>
  <h2>DATA MEMBER</h2>
</center>
<!-- tabel untuk menampilkan data dari database -->
<table border="1">
  <thead>
    <tr style="background-color:#31316a;color:#fff">
      <th height="30" align="center" vertical="center">No.</th>
      <th height="30" align="center" vertical="center">ID Member</th>
      <th height="30" align="center" vertical="center">Tanggal Gabung</th>
      <th height="30" align="center" vertical="center">Jenis Member</th>
      <th height="30" align="center" vertical="center">Nama Lengkap</th>
      <th height="30" align="center" vertical="center">Jenis Kelamin</th>
      <th height="30" align="center" vertical="center">Alamat</th>
      <th height="30" align="center" vertical="center">Email</th>
      <th height="30" align="center" vertical="center">WhatsApp</th>
    </tr>
  </thead>
  <tbody>
    <?php
    // variabel untuk nomor urut tabel 
    $no = 1;
    // sql statement untuk menampilkan data dari tabel "tbl_member"
    $query = mysqli_query($mysqli, "SELECT * FROM tbl_member ORDER BY id_member ASC")
                                    or die('Ada kesalahan pada query tampil data : ' . mysqli_error($mysqli));
    // ambil data hasil query
    while ($data = mysqli_fetch_assoc($query)) { ?>
      <!-- tampilkan data -->
      <tr>
        <td width="50" align="center"><?= $no++; ?></td>
        <td width="100" align="center"><?= $data['id_member']; ?></td>
        <td width="130" align="center"><?= date('d-m-Y', strtotime($data['tanggal_gabung'])); ?></td>
        <td width="130" align="center"><?= $data['jenis_member']; ?></td>
        <td width="200"><?= $data['nama_lengkap']; ?></td>
        <td width="120" align="center"><?= $data['jenis_kelamin']; ?></td>
        <td width="250"><?= $data['alamat']; ?></td>
        <td width="240"><?= $data['email']; ?></td>
        <td width="120" align="center">'<?= $data['whatsapp']; ?></td>
      </tr>
    <?php } ?>
  </tbody>
</table>
<br><br>
<div style="text-align: right">Bandar Lampung, <?= tanggal_indo(date('Y-m-d')); ?></div>