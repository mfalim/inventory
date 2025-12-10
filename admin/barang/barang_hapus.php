<?php
include '../../config/koneksi.php';

$id = intval($_GET['id']);

$delete = mysqli_query($conn, "DELETE FROM barang WHERE id=$id");

if ($delete) {
    echo "<script>alert('Barang berhasil dihapus'); window.location='barang.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus barang'); window.location='barang.php';</script>";
}
?>