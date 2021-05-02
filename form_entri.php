<div class="d-flex flex-column flex-md-row px-4 py-2 mt-4 text-white bg-indigo rounded shadow">
  <!-- judul halaman -->
  <div class="d-flex align-items-center me-md-auto">
    <i class="fas fa-edit fa-lg me-3"></i>
    <h1 class="h5 pt-2">Entri Data Member</h1>
  </div>
  <!-- breadcrumbs -->
  <div class="ms-5 ms-md-0 pt-md-3 pb-md-0">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="http://www.indrasatya.com/"><i class="fas fa-home"></i></a></li>
        <li class="breadcrumb-item"><a href="?halaman=data">Member</a></li>
        <li class="breadcrumb-item" aria-current="page">Entri</li>
      </ol>
    </nav>
  </div>
</div>

<div class="p-4 mt-3 bg-body rounded shadow">
  <!-- form entri data -->
  <form action="proses_entri.php" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
    <div class="row gx-5">
      <div class="col-md-7">
        <div class="row gx-3 mb-3">
          <div class="mb-3 col-md-6">
            <?php
            // membuat "id_member"
            // sql statement untuk menampilkan 5 digit terakhir dari "id_member" pada tabel "tbl_member"
            $query = mysqli_query($mysqli, "SELECT RIGHT(id_member,5) as nomor FROM tbl_member ORDER BY id_member DESC LIMIT 1")
                                            or die('Ada kesalahan pada query tampil data : ' . mysqli_error($mysqli));
            // ambil jumlah baris data hasil query
            $rows = mysqli_num_rows($query);

            // cek hasil query
            // jika "id_member" sudah ada
            if ($rows <> 0) {
              // ambil data hasil query
              $data = mysqli_fetch_assoc($query);
              // nomor urut "id_member" yang terakhir + 1 (contoh nomor urut yang terakhir adalah 2, maka 2 + 1 = 3, dst..)
              $nomor_urut = $data['nomor'] + 1;
            }
            // jika "id_member" belum ada
            else {
              // nomor urut "id_member" = 1
              $nomor_urut = 1;
            }

            // menambahkan karakter "ID-" diawal dan karakter "0" disebelah kiri nomor urut
            $id_member = "ID-" . str_pad($nomor_urut, 5, "0", STR_PAD_LEFT);
            ?>
            <label class="form-label">ID Member <span class="text-danger">*</span></label>
            <!-- tampilkan "id_member" -->
            <input type="text" name="id_member" class="form-control" value="<?= $id_member; ?>" readonly>
          </div>

          <div class="mb-3 col-md-6">
            <label class="form-label">Tanggal Gabung <span class="text-danger">*</span></label>
            <input type="text" name="tanggal_gabung" class="form-control form-control-datepicker" autocomplete="off" required>
            <div class="invalid-feedback">Tanggal gabung tidak boleh kosong.</div>
          </div>
        </div>

        <hr>

        <div class="mb-3 pt-2">
          <label class="form-label">Jenis Member <span class="text-danger">*</span></label>
          <select name="jenis_member" class="form-select" autocomplete="off" required>
            <option selected disabled value="">-- Pilih --</option>
            <option value="Gratis">Gratis</option>
            <option value="Pelajar">Pelajar</option>
            <option value="Personal">Personal</option>
            <option value="Bisnis">Bisnis</option>
          </select>
          <div class="invalid-feedback">Jenis member tidak boleh kosong.</div>
        </div>

        <div class="mb-3">
          <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
          <input type="text" name="nama_lengkap" class="form-control" autocomplete="off" required>
          <div class="invalid-feedback">Nama lengkap tidak boleh kosong.</div>
        </div>

        <div class="mb-3">
          <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
          <br>
          <div class="form-check form-check-inline">
            <input type="radio" id="laki_laki" name="jenis_kelamin" class="form-check-input" value="Laki-laki" required>
            <label class="form-check-label" for="laki_laki">Laki-laki</label>
          </div>
          <div class="form-check form-check-inline">
            <input type="radio" id="perempuan" name="jenis_kelamin" class="form-check-input" value="Perempuan" required>
            <label class="form-check-label" for="perempuan">Perempuan</label>
            <div class="invalid-feedback invalid-feedback-inline">Pilih salah satu jenis kelamin.</div>
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Alamat <span class="text-danger">*</span></label>
          <textarea name="alamat" rows="2" class="form-control" autocomplete="off" required></textarea>
          <div class="invalid-feedback">Alamat tidak boleh kosong.</div>
        </div>

        <div class="row gx-3 mb-3">
          <div class="mb-3 col-md-6">
            <label class="form-label">Email <span class="text-danger">*</span></label>
            <input type="email" name="email" class="form-control" autocomplete="off" required>
            <div class="invalid-feedback">Email tidak boleh kosong.</div>
          </div>

          <div class="mb-3 col-md-6">
            <label class="form-label">WhatsApp <span class="text-danger">*</span></label>
            <input type="text" name="whatsapp" class="form-control" maxlength="13" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" required>
            <div class="invalid-feedback">WhatsApp tidak boleh kosong.</div>
          </div>
        </div>
      </div>
      <div class="col-md-5">
        <div class="mb-3">
          <label class="form-label">Foto Profil <span class="text-danger">*</span></label>
          <input type="file" accept=".jpg, .jpeg, .png" id="foto" name="foto" class="form-control" autocomplete="off" required>
          <div class="invalid-feedback">Foto profil tidak boleh kosong.</div>

          <div class="text-center mt-4">
            <img id="preview_foto" src="images/user.png" alt="Foto Profil" class="foto-preview rounded-circle shadow">
          </div>

          <div class="form-text mt-5">
            Keterangan : <br>
            - Tipe file yang bisa diunggah adalah *.jpg atau *.png. <br>
            - Ukuran file yang bisa diunggah maksimal 1 Mb.
          </div>
        </div>
      </div>
    </div>
    <div class="pt-4 pb-2 text-end border-top">
      <!-- button simpan data -->
      <input type="submit" name="simpan" value="Simpan" class="btn btn-primary px-3 me-2">
      <!-- button kembali ke halaman "Data Member" -->
      <a href="?halaman=data" class="btn btn-secondary px-4">Batal</a>
    </div>
  </form>
</div>

<script type="text/javascript">
  // validasi file dan preview file sebelum diunggah
  document.getElementById('foto').onchange = function() {
    // mengambil value dari file
    var fileInput = document.getElementById('foto');
    var filePath = fileInput.value;
    var fileSize = fileInput.files[0].size;
    // tentukan extension file yang diperbolehkan
    var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;

    // Jika tipe file yang diunggah tidak sesuai dengan "allowedExtensions"
    if (!allowedExtensions.exec(filePath)) {
      alert("Tipe file tidak sesuai. Harap unggah file yang memiliki tipe *.jpg atau *.png.");
      // reset input file
      fileInput.value = "";
      // tampilkan file default
      document.getElementById("preview_foto").src = "images/user.png";
    }
    // jika ukuran file yang diunggah lebih dari 1 Mb
    else if (fileSize > 1000000) {
      alert("Ukuran file lebih dari 1 Mb. Harap unggah file yang memiliki ukuran maksimal 1 Mb.");
      // reset input file
      fileInput.value = "";
      // tampilkan file default
      document.getElementById("preview_foto").src = "images/user.png";
    }
    // jika file yang diunggah sudah sesuai, tampilkan preview file
    else {
      var reader = new FileReader();

      reader.onload = function(e) {
        // preview file
        document.getElementById("preview_foto").src = e.target.result;
      };
      // membaca file sebagai data URL
      reader.readAsDataURL(this.files[0]);
    }
  };
</script>