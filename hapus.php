<?php
include 'koneksi.php';
$id = $_GET['id'];
$d = mysqli_fetch_array(mysqli_query($conn, "SELECT foto FROM produk WHERE id='$id'"));
unlink("uploads/".$d['foto']);
mysqli_query($conn, "DELETE FROM produk WHERE id='$id'");
header("location:index.php");
?>