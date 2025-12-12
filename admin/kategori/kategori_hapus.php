<?php
include '../../config/koneksi.php';
include '../sidebar.php';
$id = intval($_GET['id']);
$delete = mysqli_query($conn, "DELETE FROM kategori WHERE id=$id");
if ($delete) {
    echo "
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Kategori berhasil dihapus',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            window.location = 'kategori.php';
        });
    </script>
    ";
} else {
    echo "
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: 'Gagal Menghapus Kategori',
            showConfirmButton: true,
            timer: 1500
        }).then(() => {
            window.location = 'kategori.php';
        });
    </script>
    ";
}