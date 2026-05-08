<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk | Manajemen Kantin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container">
        <h2>Data Produk</h2>
        
        <div style="margin-bottom: 20px;">
            <a href="form.php" class="btn btn-add">+ Tambah Produk Baru</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = mysqli_query($conn, "SELECT * FROM produk");
                $no = 1;
                while($data = mysqli_fetch_array($query)){
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td>
                        <img src="uploads/<?= $data['foto']; ?>" alt="Foto Produk" class="img-thumb">
                    </td>
                    <td><strong><?= $data['nama_produk']; ?></strong></td>
                    <td>Rp <?= number_format($data['harga'], 0, ',', '.'); ?></td>
                    <td><?= $data['stok']; ?> pcs</td>
                    <td>
                        <a href="form.php?id=<?= $data['id']; ?>" class="btn btn-edit">Edit</a>
                        <a href="hapus.php?id=<?= $data['id']; ?>" class="btn btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if(mysqli_num_rows($query) == 0): ?>
                <tr>
                    <td colspan="6" style="padding: 20px; color: #888;">Belum ada data produk.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>
</html>