<?php
include '../../config/koneksi.php';

$id = intval($_GET['id']);
$delete = mysqli_query($conn, "DELETE FROM supplier WHERE id=$id");

if ($delete) {
    echo "<script>alert('Supplier berhasil dihapus'); window.location='supplier.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus supplier'); window.location='supplier.php';</script>";
}
?>