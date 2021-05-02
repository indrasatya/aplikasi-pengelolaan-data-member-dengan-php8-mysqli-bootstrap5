<div class="d-flex flex-column flex-md-row px-4 py-2 mt-4 text-white bg-indigo rounded shadow">
  <!-- judul halaman -->
  <div class="d-flex align-items-center me-md-auto">
    <i class="fas fa-clone fa-lg me-3"></i>
    <h1 class="h5 pt-2">Detail Data Member</h1>
  </div>
  <!-- breadcrumbs -->
  <div class="ms-5 ms-md-0 pt-md-3 pb-md-0">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="http://www.indrasatya.com/"><i class="fas fa-home"></i></a></li>
        <li class="breadcrumb-item"><a href="?halaman=data">Member</a></li>
        <li class="breadcrumb-item" aria-current="page">Detail</li>
      </ol>
    </nav>
  </div>
</div>

<?php
// mengecek data GET "id_member"
if (isset($_GET['id'])) {
  // ambil data GET dari tombol detail
  $id_member = $_GET['id'];

  // sql statement untuk menampilkan data dari tabel "tbl_member" berdasarkan "id_member"
  $query = mysqli_query($mysqli, "SELECT * FROM tbl_member WHERE id_member='$id_member'")
                                  or die('Ada kesalahan pada query tampil data : ' . mysqli_error($mysqli));
  // ambil data hasil query
  $data = mysqli_fetch_assoc($query);
}
?>
<!-- tampilkan data -->
<div class="p-4 mt-3 bg-body rounded shadow">
  <div class="row mb-3">
    <div class="col-lg-3">
      <div class="text-center mb-3 mb-lg-0">
        <img src="images/<?= $data['foto_profil']; ?>" alt="Foto Profil" class="foto-preview rounded-circle shadow">
      </div>
    </div>
    <div class="col-lg-9">
      <div class="table-responsive">
        <table class="table table-striped">
          <tr>
            <td width="150">ID Member</td>
            <td width="10">:</td>
            <td><?= $data['id_member']; ?></td>
          </tr>
          <tr>
            <td>Tanggal Gabung</td>
            <td>:</td>
            <td><?= tanggal_indo($data['tanggal_gabung']); ?></td>
          </tr>
          <tr>
            <td>Jenis Member</td>
            <td>:</td>
            <td><?= $data['jenis_member']; ?></td>
          </tr>
          <tr>
            <td>Nama Lengkap</td>
            <td>:</td>
            <td><?= $data['nama_lengkap']; ?></td>
          </tr>
          <tr>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td><?= $data['jenis_kelamin']; ?></td>
          </tr>
          <tr>
            <td>Alamat</td>
            <td>:</td>
            <td><?= $data['alamat']; ?></td>
          </tr>
          <tr>
            <td>Email</td>
            <td>:</td>
            <td><?= $data['email']; ?></td>
          </tr>
          <tr>
            <td>WhatsApp</td>
            <td>:</td>
            <td><?= $data['whatsapp']; ?></td>
          </tr>
        </table>
      </div>
    </div>
  </div>

  <div class="pt-4 pb-2 text-end border-top">
    <!-- button kembali ke halaman "Data Member" -->
    <a href="?halaman=data" class="btn btn-primary">
      <i class="far fa-arrow-alt-circle-left me-1"></i> Kembali
    </a>
  </div>
</div>