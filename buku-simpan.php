<?php
require_once 'koneksi.php';

$id_kategori_buku = $_POST['id_kategori_buku'];
$judul_buku       = mysqli_real_escape_string($conn, $_POST['judul_buku']);
$penulis          = mysqli_real_escape_string($conn, $_POST['penulis']);
$penerbit         = mysqli_real_escape_string($conn, $_POST['penerbit']);


$foto_cover = $_FILES['foto_cover']['name'];
$tmp        = $_FILES['foto_cover']['tmp_name'];
$folder     = "uploads/";

move_uploaded_file($tmp, $folder . $foto_cover);

$sql = "INSERT INTO tb_buku
        (id_kategori_buku, judul_buku, penulis, penerbit, Foto_cover)
        VALUES
        ('$id_kategori_buku', '$judul_buku', '$penulis', '$penerbit', '$foto_cover')";

$query = mysqli_query($conn, $sql);

if ($query) {
    echo "<script>
            alert('Data buku berhasil ditambahkan!');
            window.location='buku.php';
          </script>";
} else {
    echo "<script>
            alert('Data buku gagal ditambahkan!');
            window.location='buku-tambah.php';
          </script>";
}
?>