<?php 
include 'koneksi.php';

$id = ""; $nama = ""; $harga = ""; $stok = "";
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = mysqli_query($conn, "SELECT * FROM produk WHERE id='$id'");
    $data = mysqli_fetch_array($sql);
    $nama = $data['nama_produk'];
    $harga = $data['harga'];
    $stok = $data['stok'];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= ($id == "") ? "Tambah" : "Edit"; ?> Produk</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container" style="max-width: 500px;">
        <h2><?= ($id == "") ? "Tambah Data Produk" : "Edit Data Produk"; ?></h2>
        
        <form action="proses.php" method="POST" enctype="multipart/form-data" id="formProduk">
            <input type="hidden" name="id" value="<?= $id; ?>">

            <div class="form-group">
                <label for="nama">Nama Lengkap Produk</label>
                <input type="text" name="nama" id="nama" value="<?= $nama; ?>" placeholder="Contoh: Nasi Goreng">
            </div>

            <div class="form-group">
                <label for="harga">Harga (Rp)</label>
                <input type="number" name="harga" id="harga" value="<?= $harga; ?>" placeholder="Contoh: 15000">
            </div>

            <div class="form-group">
                <label for="stok">Stok Tersedia</label>
                <input type="number" name="stok" id="stok" value="<?= $stok; ?>" placeholder="Contoh: 50">
            </div>

            <div class="form-group">
                <label for="foto">Foto Produk <?= ($id != "") ? "<small>(Kosongkan jika tidak ingin ganti)</small>" : ""; ?></label>
                <input type="file" name="foto" id="foto">
            </div>

            <div style="margin-top: 20px;">
                <button type="submit" name="simpan" class="btn btn-save" style="background-color: #4a90e2; color: white; width: 100%;">
                    Simpan Data Ke Database
                </button>
            </div>
            
            <div style="text-align: center; margin-top: 15px;">
                <a href="index.php" style="text-decoration: none; color: #666; font-size: 14px;">← Kembali ke Daftar</a>
            </div>
        </form>
    </div>

    <script>
    document.getElementById('formProduk').onsubmit = function(e) {
        const nama = document.getElementById('nama').value;
        const harga = document.getElementById('harga').value;
        const stok = document.getElementById('stok').value;
        const fileInput = document.getElementById('foto');
        const file = fileInput.files[0];

        // Validasi Field Kosong
        if(nama.trim() === "" || harga === "" || stok === "") {
            alert("Harap isi semua field teks!");
            e.preventDefault(); // Batalkan pengiriman form
            return;
        }

        // Validasi File (Hanya jika ada file yang dipilih)
        if(file) {
            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
            if(!allowedTypes.includes(file.type)) {
                alert("Hanya file gambar (JPG/PNG) yang diperbolehkan!");
                e.preventDefault();
            } else if(file.size > 2 * 1024 * 1024) { // 2MB
                alert("Ukuran file maksimal adalah 2MB!");
                e.preventDefault();
            }
        } else if("<?= $id; ?>" === "") {
            // Jika mode tambah baru tapi foto kosong
            alert("Harap unggah foto produk!");
            e.preventDefault();
        }
    };
    </script>

</body>
</html>