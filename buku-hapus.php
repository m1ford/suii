<?php
require_once 'koneksi.php';

// Mengambil ID buku dari URL
$id = $_GET['id'];

// Mengambil data buku berdasarkan ID dengan INNER JOIN kategori
$sql = "SELECT 
            tb_buku.*,
            tb_kategori_buku.kategori_buku
        FROM tb_buku
        INNER JOIN tb_kategori_buku
        ON tb_buku.id_kategori_buku = tb_kategori_buku.id_kategori_buku
        WHERE tb_buku.id_buku = '$id'";

$query = mysqli_query($conn, $sql);

$data = mysqli_fetch_assoc($query);

// Memeriksa data buku
if (!$data) {
    echo "<script>
            alert('Data buku tidak ditemukan!');
            window.location='buku.php';
          </script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($data['judul_buku']); ?></title>
</head>
<body>

    <h1>Detail Buku</h1>
    <hr>

    <p>
        <strong>Kategori:</strong>
        <?php echo htmlspecialchars($data['kategori_buku']); ?>
    </p>

    <h2>
        <?php echo htmlspecialchars($data['judul_buku']); ?>
    </h2>

    
    <p>
        <strong>Penulis:</strong> <?php echo htmlspecialchars($data['penulis']); ?><br>
        <strong>Penerbit:</strong> <?php echo htmlspecialchars($data['penerbit']); ?>
    </p>

    <p>
        <strong>Tanggal Ditambahkan:</strong>
        <?php echo date('d-m-Y', strtotime($data['created_at'])); ?>
    </p>

\    <?php if (!empty($data['foto_cover'])) { ?>
        <img src="uploads/<?php echo htmlspecialchars($data['foto_cover']); ?>"
             width="300"
             alt="Foto Cover Buku">
    <?php } else { ?>
        <p>Tidak ada foto cover.</p>
    <?php } ?>
    <br><br>

    <!-- Tombol Kembali -->
    <a href="buku.php">Kembali ke Daftar Buku</a>

</body>
</html>