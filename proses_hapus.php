<?php
// panggil file "database.php" untuk koneksi ke database
require_once "config/database.php";

// mengecek data GET "id_member"
if (isset($_GET['id'])) {
  // ambil data GET dari tombol hapus
  $id_member = mysqli_real_escape_string($mysqli, $_GET['id']);

  // mengecek data foto profil
  // sql statement untuk menampilkan data "foto_profil" dari tabel "tbl_member" berdasarkan "id_member"
  $query = mysqli_query($mysqli, "SELECT foto_profil FROM tbl_member WHERE id_member='$id_member'")
                                  or die('Ada kesalahan pada query tampil data : ' . mysqli_error($mysqli));
  // ambil data hasil query
  $data = mysqli_fetch_assoc($query);
  // tampilkan data
  $foto_profil = $data['foto_profil'];

  // jika data "foto_profil" tidak kosong
  if (!empty($foto_profil)) {
    // hapus file foto dari folder images
    $hapus_file = unlink("images/$foto_profil");
  }

  // sql statement untuk delete data dari tabel "tbl_member"
  $delete = mysqli_query($mysqli, "DELETE FROM tbl_member WHERE id_member='$id_member'")
                                  or die('Ada kesalahan pada query delete : ' . mysqli_error($mysqli));
  // cek query
  // jika proses delete berhasil
  if ($delete) {
    // alihkan ke halaman data member dan tampilkan pesan berhasil hapus data
    header('location: index.php?halaman=data&pesan=3');
  }
}
