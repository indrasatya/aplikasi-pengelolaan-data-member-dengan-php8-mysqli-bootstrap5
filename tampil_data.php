<div class="d-flex flex-column flex-md-row px-4 py-2 mt-4 text-white bg-indigo rounded shadow">
  <!-- judul halaman -->
  <div class="d-flex align-items-center me-md-auto">
    <i class="fas fa-user-circle fa-2x me-3"></i>
    <h1 class="h5 pt-2">Data Member</h1>
  </div>
  <!-- breadcrumbs -->
  <div class="ms-5 ms-md-0 pt-md-3 pb-md-0">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="http://www.indrasatya.com/"><i class="fas fa-home"></i></a></li>
        <li class="breadcrumb-item"><a href="?halaman=data">Member</a></li>
        <li class="breadcrumb-item" aria-current="page">Data</li>
      </ol>
    </nav>
  </div>
</div>

<div class="px-4 py-3 mt-3 bg-body rounded shadow">
  <div class="d-flex flex-column flex-md-row">
    <!-- button entri data -->
    <a href="?halaman=entri" class="btn btn-primary me-md-3 mb-2 mb-md-0">
      <i class="fas fa-plus-circle me-1"></i> Entri Member
    </a>
    <!-- button cetak data -->
    <a href="cetak.php" target="_blank" class="btn btn-warning me-md-3 mb-2 mb-md-0">
      <i class="fas fa-print me-1"></i> Cetak
    </a>
    <!-- button export data -->
    <a href="export.php" class="btn btn-success mb-3 mb-md-0">
      <i class="fas fa-file-excel me-1"></i> Export
    </a>
    <!-- form pencarian -->
    <form action="?halaman=pencarian" method="post" class="form-search needs-validation ms-md-auto" novalidate>
      <input type="text" name="kata_kunci" class="form-control" placeholder="Cari Member ..." autocomplete="off">
    </form>
  </div>
</div>

<?php
// menampilkan pesan sesuai dengan proses yang dijalankan
// jika pesan tersedia
if (isset($_GET['pesan'])) {
  // jika pesan = 1
  if ($_GET['pesan'] == 1) {
    // tampilkan pesan sukses simpan data
    echo '<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <strong><i class="fas fa-check-circle me-2"></i>Sukses!</strong> Data member berhasil disimpan.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
  }
  // jika pesan = 2
  elseif ($_GET['pesan'] == 2) {
    // tampilkan pesan sukses ubah data
    echo '<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <strong><i class="fas fa-check-circle me-2"></i>Sukses!</strong> Data member berhasil diubah.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
  }
  // jika pesan = 3
  elseif ($_GET['pesan'] == 3) {
    // tampilkan pesan sukses hapus data
    echo '<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <strong><i class="fas fa-check-circle me-2"></i>Sukses!</strong> Data member berhasil dihapus.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
  }
}
?>

<div class="p-4 mt-3 bg-body rounded shadow">
  <?php
  /* membatasi jumlah data yang ditampilkan dari database untuk membuat pagination/paginasi */
  // cek data "paginasi" pada URL untuk mengetahui paginasi halaman aktif
  // jika data "paginasi" ada, maka paginasi halaman = data "paginasi". jika data "paginasi" tidak ada, maka paginasi halaman = 1
  $paginasi_halaman = (isset($_GET['paginasi'])) ? (int) $_GET['paginasi'] : 1;
  // tentukan jumlah data yang ditampilkan per paginasi halaman
  $batas = 5;
  // tentukan dari data ke berapa yang akan ditampilkan pada paginasi halaman
  $batas_awal = ($paginasi_halaman - 1) * $batas;

  // sql statement untuk menampilkan data dari tabel "tbl_member"
  $query = mysqli_query($mysqli, "SELECT id_member, tanggal_gabung, jenis_member, nama_lengkap, foto_profil FROM tbl_member 
                                  ORDER BY id_member DESC LIMIT $batas_awal, $batas")
                                  or die('Ada kesalahan pada query tampil data : ' . mysqli_error($mysqli));
  // ambil jumlah data hasil query
  $rows = mysqli_num_rows($query);

  // cek hasil query
  // jika data member ada
  if ($rows <> 0) {
    // ambil data hasil query
    while ($data = mysqli_fetch_assoc($query)) { ?>
      <!-- tampilkan data -->
      <div class="d-flex flex-column flex-md-row align-items-center align-items-md-left">
        <div class="me-md-3 pb-3 pb-md-0">
          <img src="images/<?= $data['foto_profil']; ?>" alt="Foto Profil" class="rounded-circle foto-profil">
        </div>
        <div class="text-center text-md-start pb-3 pb-md-0">
          <h6 class="text-uppercase mb-1"><span class="text-primary"><?= $data['id_member']; ?></span> - <?= $data['nama_lengkap']; ?></h6>
          <div>
            Member <span class="text-warning"><?= $data['jenis_member']; ?></span>.
            Tanggal Gabung <span class="text-warning"><?= tanggal_indo($data['tanggal_gabung']); ?></span>.
          </div>
        </div>
        <div class="ms-md-auto">
          <!-- button detail data -->
          <a href="?halaman=detail&id=<?= $data['id_member']; ?>" class="btn btn-warning btn-sm me-2 mb-2 mb-md-0">
            <i class="fas fa-clone me-1"></i> Detail
          </a>
          <!-- button ubah data -->
          <a href="?halaman=ubah&id=<?= $data['id_member']; ?>" class="btn btn-primary btn-sm me-2 mb-2 mb-md-0">
            <i class="fas fa-edit me-1"></i> Ubah
          </a>
          <!-- button hapus data -->
          <a href="proses_hapus.php?id=<?= $data['id_member']; ?>" onclick="return confirm('Anda yakin ingin menghapus data member <?= $data['nama_lengkap']; ?>?')" class="btn btn-danger btn-sm mb-2 mb-md-0">
            <i class="fas fa-trash me-1"></i> Hapus
          </a>
        </div>
      </div>
      <div class="separator-dashed my-3"></div>
    <?php } ?>

    <div class="row">
      <!-- menampilkan informasi jumlah paginasi halaman dan jumlah data -->
      <div class="col-md-6">
        <div class="text-center text-md-start pt-3">
          <?php
          // sql statement untuk menampilkan jumlah data pada tabel "tbl_member"
          $query = mysqli_query($mysqli, "SELECT id_member FROM tbl_member")
                                          or die('Ada kesalahan pada query jumlah data : ' . mysqli_error($mysqli));
          // ambil jumlah data dari hasil query
          $jumlah_data = mysqli_num_rows($query);

          // hitung jumlah paginasi halaman yang tersedia
          $jumlah_paginasi_halaman = ceil($jumlah_data / $batas);

          // cek jumlah data
          // jika data ada
          if ($jumlah_data <> 0) {
            // tampilkan informasi paginasi halaman aktif dan jumlah paginasi halaman
            echo "Halaman $paginasi_halaman dari $jumlah_paginasi_halaman";
          }
          ?>

          <span class="mx-2">|</span>

          <?php
          // ambil data awal yang ditampilkan per paginasi halaman
          /* jika "jumlah_paginasi_halaman" <> "0", maka "data_awal" = "batas_awal" + 1.
             jika "jumlah_paginasi_halaman" == "0", maka "data_awal" = "batas_awal". */
          $data_awal = ($jumlah_paginasi_halaman <> 0) ? $batas_awal + 1 : $batas_awal;

          // sql statement untuk menampilkan jumlah data pada tabel "tbl_member" yang ditampilkan per halaman
          $query = mysqli_query($mysqli, "SELECT id_member FROM tbl_member LIMIT $data_awal, $batas")
                                          or die('Ada kesalahan pada query jumlah data per halaman : ' . mysqli_error($mysqli));
          // ambil jumlah data dari hasil query
          $jumlah_data_per_paginasi_halaman = mysqli_num_rows($query);

          // ambil data akhir yang ditampilkan per paginasi halaman
          /* jika "jumlah_data_per_paginasi_halaman" < "batas", maka "data_akhir" = "data_awal" + "jumlah_data_per_paginasi_halaman".
             jika "jumlah_data_per_paginasi_halaman" >= "batas", maka "data_akhir" = "batas_awal" + "jumlah_data_per_paginasi_halaman". */
          $data_akhir = ($jumlah_data_per_paginasi_halaman < $batas) ? $data_awal + $jumlah_data_per_paginasi_halaman : $batas_awal + $jumlah_data_per_paginasi_halaman;
          ?>
          <!-- tampilkan informasi jumlah data -->
          Menampilkan <?= $data_awal; ?> sampai <?= $data_akhir; ?> dari <?= $jumlah_data; ?> data
        </div>
      </div>

      <!-- membuat pagination -->
      <div class="col-md-6">
        <ul class="pagination justify-content-center justify-content-md-end pt-3">
          <!-- button link "<" -->
          <?php
          // jika paginasi halaman <= 1, maka button link "<" tidak aktif
          if ($paginasi_halaman <= '1') { ?>
            <li class="page-item circle-pagination disabled">
              <a class="page-link" aria-label="Previous">
                <i class="fas fa-angle-left"></i>
              </a>
            </li>
          <?php
          }
          // jika paginasi halaman > 1, maka button link "<" aktif
          else { ?>
            <li class="page-item circle-pagination">
              <a class="page-link" href="?paginasi=<?= $paginasi_halaman - 1; ?>" aria-label="Previous">
                <i class="fas fa-angle-left"></i>
              </a>
            </li>
          <?php } ?>

          <!-- button link nomor -->
          <?php
          // tentukan jumlah button link nomor yang ditampilkan sebelum dan sesudah link yang aktif
          $jumlah_button = 3;

          // tentukan nilai awal dan nilai akhir yang akan digunakan pada perulangan untuk menampilkan button link nomor
          /* jika "paginasi_halaman" > "jumlah_button", maka "nomor_awal" = "paginasi_halaman" - "jumlah_button".
             jika "paginasi_halaman" <= "jumlah_button", maka "nomor_awal" = 1. */
          $nomor_awal  = ($paginasi_halaman > $jumlah_button) ? $paginasi_halaman - $jumlah_button : 1;

          /* jika "paginasi_halaman" < ("jumlah_paginasi_halaman" - "jumlah_button"), maka "nomor_akhir" = "paginasi_halaman" + "jumlah_button".
             jika "paginasi_halaman" >= ("jumlah_paginasi_halaman" - "jumlah_button"), maka "nomor_akhir" = "jumlah_paginasi_halaman". */
          $nomor_akhir = ($paginasi_halaman < ($jumlah_paginasi_halaman - $jumlah_button)) ? $paginasi_halaman + $jumlah_button : $jumlah_paginasi_halaman;

          // lakukan perulangan untuk menampilkan button link nomor sesuai jumlah paginasi halaman
          for ($x = $nomor_awal; $x <= $nomor_akhir; $x++) {
            // membuat link aktif
            /* jika "halaman" sama dengan link aktif, maka tambahkan css class "active"
               jika "halaman" tidak sama dengan link aktif, maka hilangkan css class "active" */
            $link_active = ($paginasi_halaman == $x) ? 'active' : '';
          ?>
            <li class="page-item circle-pagination <?= $link_active; ?>">
              <a class="page-link" href="?paginasi=<?= $x; ?>"><?= $x; ?></a>
            </li>
          <?php } ?>

          <!-- button link ">" -->
          <?php
          // jika "paginasi_halaman" >= "jumlah_paginasi_halaman", maka button link ">" tidak aktif 
          if ($paginasi_halaman >= $jumlah_paginasi_halaman) { ?>
            <li class="page-item circle-pagination disabled">
              <a class="page-link" aria-label="Next">
                <i class="fas fa-angle-right"></i>
              </a>
            </li>
          <?php
          }
          // jika "paginasi_halaman" < "jumlah_paginasi_halaman", maka button link ">" aktif
          else { ?>
            <li class="page-item circle-pagination">
              <a class="page-link" href="?paginasi=<?= $paginasi_halaman + 1; ?>" aria-label="Next">
                <i class="fas fa-angle-right"></i>
              </a>
            </li>
          <?php } ?>
        </ul>
      </div>
    </div>
  <?php
  }
  // jika data member tidak ada
  else { ?>
    <!-- tampilkan pesan data tidak tersedia -->
    <div class="text-center">
      Tidak ada data yang tersedia.
    </div>
    <div class="separator-dashed my-3"></div>
  <?php } ?>
</div>