<?php
include '../../config/koneksi.php';

$id = intval($_GET['id']);

$delete = mysqli_query($conn, "DELETE FROM barang WHERE id=$id");

if ($delete) {
    echo "
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Barang berhasil dihapus',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            window.location = 'barang.php';
        });
    </script>
    ";
} else {
    echo "
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: 'Gagal Menghapus Barang',
            showConfirmButton: true,
            timer: 1500
        }).then(() => {
            window.location = 'barang.php';
        });
    </script>
    ";
}
?>