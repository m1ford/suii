<?php
require_once 'koneksi.php';

$sql = "SELECT tb_buku.*, tb_kategori_buku.kategori_buku 
                  FROM tb_buku 
                  INNER JOIN tb_kategori_buku 
                  ON tb_buku.id_kategori_buku = tb_kategori_buku.id_kategori_buku";


$query = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Buku</title>
</head>
<body>

<h2>Data Buku</h2>

<a href="buku-tambah.php">+ Tambah Buku</a>

<br><br>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Kategori</th>
            <th>Judul</th>
            <th>Foto Berita</th>
            <th>Created At</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $no = 1;

        if (mysqli_num_rows($query) > 0) {
            while ($data = mysqli_fetch_assoc($query)) {
        ?>

        <tr>
            <td><?= $no++; ?></td>

            <td><?= htmlspecialchars($data['id_kategori_buku']); ?></td>

            <td><?= htmlspecialchars($data['judul_buku']); ?></td>

            <td>
                <?php if (!empty($data['foto_cover'])) { ?>
                    <img src="uploads/<?= htmlspecialchars($data['foto_cover']); ?>"
                         width="100">
                <?php } else { ?>
                    Tidak ada foto
                <?php } ?>
            </td>

            <td><?= htmlspecialchars($data['created_at']); ?></td>

            <td>
                <a href="buku-edit.php?id=<?= $data['id_buku']; ?>">Edit</a>
                |
                <a href="buku-hapus.php?id=<?= $data['id_buku']; ?>"
                   onclick="return confirm('Yakin ingin menghapus buku ini?')">
                    Hapus
                </a>
            </td>
        </tr>

        <?php
            }
        } else {
        ?>

        <tr>
            <td colspan="6">Belum ada buku.</td>
        </tr>

        <?php } ?>
    </tbody>
</table>

</body>
</html>