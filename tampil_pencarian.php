<div class="d-flex flex-column flex-md-row px-4 py-2 mt-4 text-white bg-indigo rounded shadow">
  <!-- judul halaman -->
  <div class="d-flex align-items-center me-md-auto">
    <i class="fas fa-search fa-lg me-3"></i>
    <h1 class="h5 pt-2">Pencarian Data Member</h1>
  </div>
  <!-- breadcrumbs -->
  <div class="ms-5 ms-md-0 pt-md-3 pb-md-0">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="http://www.indrasatya.com/"><i class="fas fa-home"></i></a></li>
        <li class="breadcrumb-item"><a href="?halaman=data">Member</a></li>
        <li class="breadcrumb-item" aria-current="page">Pencarian</li>
      </ol>
    </nav>
  </div>
</div>

<div class="px-4 py-3 mt-3 bg-body rounded shadow">
  <div class="d-flex flex-column flex-md-row">
    <!-- button kembali ke halaman "Data Member" -->
    <a href="?halaman=data" class="btn btn-primary mb-3 mb-md-0">
      <i class="far fa-arrow-alt-circle-left me-1"></i> Data Member
    </a>
    <!-- form pencarian -->
    <form action="?halaman=pencarian" method="post" class="form-search needs-validation ms-md-auto" novalidate>
      <input type="text" name="kata_kunci" class="form-control" placeholder="Cari Member ..." autocomplete="off">
    </form>
  </div>
</div>

<div class="p-4 mt-3 bg-body rounded shadow">
  <?php
  // mengecek data hasil submit dari form
  if (isset($_POST['kata_kunci'])) {
    // ambil data hasil submit dari form
    $kata_kunci = $_POST['kata_kunci'];
  ?>
    <div class="alert alert-info alert-dismissible fade show mb-4" role="alert">
      <i class="far fa-hand-point-right me-2"></i>Hasil Pencarian <span class="fw-bold fst-italic">"<?= $kata_kunci; ?>"</span>
    </div>

    <div class="separator-dashed my-3"></div>

    <?php
    // sql statement untuk menampilkan data dari tabel "tbl_member" berdasarkan "kata_kunci"
    $query = mysqli_query($mysqli, "SELECT id_member, tanggal_gabung, jenis_member, nama_lengkap, foto_profil FROM tbl_member 
                                    WHERE id_member LIKE '%$kata_kunci%' OR nama_lengkap LIKE '%$kata_kunci%'
                                    ORDER BY id_member DESC")
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
      <?php
      }
    }
    // jika data member tidak ada
    else { ?>
      <!-- tampilkan pesan data tidak ditemukan -->
      <div>
        <i class="far fa-question-circle me-1"></i>
        Data member dengan kata kunci <span class="text-primary fst-italic">"<?= $kata_kunci; ?>"</span> tidak ditemukan.
      </div>
      <div class="separator-dashed my-3"></div>
  <?php
    }
  }
  ?>
</div>