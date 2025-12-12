<?php
include '../../config/koneksi.php';
include '../sidebar.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($conn, $_POST['nama_kategori']);
    $insert = mysqli_query($conn, "INSERT INTO kategori (nama_kategori) VALUES ('$nama')");

    if ($insert) {
        echo "
            <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Kategori berhasil ditambahkan!',
            }).then(() => {
                window.location='kategori.php';
            });
            </script>";
    } else {
        echo "
            <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Gagal Menambahkan Kategori!',
            }).then(() => {
                window.location='kategori.php';
            });
            </script>";
    }
}
?>

<div>
    <h1 class="text-2xl font-semibold">Tambah Kategori</h1>
    <form action="" method="post" class="mt-4 bg-white p-4 rounded shadow">
        <label class="block">Nama Kategori</label>
        <input type="text" name="nama_kategori" class="border p-2 w-full mt-2" required>
        <button class="mt-4 px-4 py-2 bg-green-600 text-white rounded">Simpan</button>
    </form>
</div>