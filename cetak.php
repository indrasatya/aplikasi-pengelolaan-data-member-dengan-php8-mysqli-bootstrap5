<?php
// panggil file "autoload.inc.php" untuk load dompdf, libraries, dan helper functions
require_once("assets/plugin/dompdf/autoload.inc.php");
// mereferensikan Dompdf namespace
use Dompdf\Dompdf;

// panggil file "database.php" untuk koneksi ke database
require_once "config/database.php";
// panggil file "fungsi_tanggal_indo.php" untuk membuat format tanggal indonesia
require_once "helper/fungsi_tanggal_indo.php";

// gunakan dompdf class
$dompdf = new Dompdf();
// setting options
$options = $dompdf->getOptions();
$options->setIsRemoteEnabled(true);
$options->setChroot(__DIR__);
$dompdf->setOptions($options);

// halaman HTML yang akan diubah ke PDF
$html = '<!DOCTYPE html>
        <html>
        <head>
          <title>Data Member</title>
          <link rel="stylesheet" href="assets/css/laporan.css">
        </head>
        <body>
          <div class="text-center">
            <h2>DATA MEMBER</h2>
          </div>
          <hr>
          <div>
            <table class="table table-bordered" cellspacing="0">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>ID Member</th>
                  <th>Tanggal Gabung</th>
                  <th>Jenis Member</th>
                  <th>Nama Lengkap</th>
                  <th>Jenis Kelamin</th>
                  <th>Alamat</th>
                  <th>Email</th>
                  <th>WhatsApp</th>
                  <th>Foto</th>
                </tr>
              </thead>
              <tbody>';
// variabel untuk nomor urut tabel
$no = 1;
// sql statement untuk menampilkan data dari tabel "tbl_member"
$query = mysqli_query($mysqli, "SELECT * FROM tbl_member ORDER BY id_member ASC")
                                or die('Ada kesalahan pada query tampil data : ' . mysqli_error($mysqli));
// ambil data hasil query
while ($data = mysqli_fetch_assoc($query)) {
  // tampilkan data
  $html .= '		<tr>
                  <td width="30" align="center">' . $no++ . '</td>
                  <td width="60" align="center">' . $data['id_member'] . '</td>
                  <td width="65" align="center">' . date('d-m-Y', strtotime($data['tanggal_gabung'])) . '</td>
                  <td width="60" align="center">' . $data['jenis_member'] . '</td>
                  <td width="120">' . $data['nama_lengkap'] . '</td>
                  <td width="60" align="center">' . $data['jenis_kelamin'] . '</td>
                  <td width="140">' . $data['alamat'] . '</td>
                  <td width="100">' . $data['email'] . '</td>
                  <td width="75" align="center">' . $data['whatsapp'] . '</td>
                  <td width="60" align="center"><img src="images/' . $data['foto_profil'] . '" alt="Foto Profil" class="foto-profil"></td>
                </tr>';
}
$html .= '    </tbody>
            </table>
          </div>
          <div class="text-right mt-5">Bandar Lampung, ' . tanggal_indo(date('Y-m-d')) . '</div>
        </body>
        </html>';

// load html
$dompdf->loadHtml($html);
// mengatur ukuran dan orientasi kertas
$dompdf->setPaper('legal', 'landscape');
// mengubah dari HTML menjadi PDF
$dompdf->render();
// menampilkan file PDF yang dihasilkan ke browser dan berikan nama file "Data-Member.pdf"
$dompdf->stream('Data-Member.pdf', array('Attachment' => 0));
