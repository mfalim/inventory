<?php
include '../../config/koneksi.php';
include '../sidebar.php';

$id = intval($_GET['id']);
$delete = mysqli_query($conn, "DELETE FROM supplier WHERE id=$id");

if ($delete) {
    echo "
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Supplier berhasil dihapus',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            window.location = 'supplier.php';
        });
    </script>
    ";
} else {
    echo "
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: 'Gagal menghapus supplier',
            showConfirmButton: true
        }).then(() => {
            window.location = 'supplier.php';
        });
    </script>
    ";
}
?>