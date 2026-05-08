<?php
include 'koneksi.php';

if(isset($_POST['simpan'])){
    $id = $_POST['id'];
    $nama = mysqli_real_escape_string($conn, $_POST['nama']); // Biar aman dari karakter aneh
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $foto = $_FILES['foto']['name'];

    if($foto != ""){
        $nama_baru = time()."_".$foto;
        
        // Pastikan folder 'uploads' sudah dibuat di direktori UTS
        if (move_uploaded_file($_FILES['foto']['tmp_name'], 'uploads/'.$nama_baru)) {
            if($id == ""){
                // Gunakan nama kolom agar tidak error di ID
                $query = "INSERT INTO produk (nama_produk, harga, stok, foto) VALUES ('$nama', '$harga', '$stok', '$nama_baru')";
            } else {
                $query = "UPDATE produk SET nama_produk='$nama', harga='$harga', stok='$stok', foto='$nama_baru' WHERE id='$id'";
            }
        } else {
            die("Gagal mengupload gambar. Pastikan folder 'uploads' sudah ada.");
        }
    } else {
        if($id != ""){
            $query = "UPDATE produk SET nama_produk='$nama', harga='$harga', stok='$stok' WHERE id='$id'";
        }
    }

    if(mysqli_query($conn, $query)){
        header("location:index.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>