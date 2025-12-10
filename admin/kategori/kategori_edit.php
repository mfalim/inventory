<?php
include '../../config/koneksi.php';
include '../sidebar.php';

// Ambil data berdasarkan ID dari URL
$id = intval($_GET['id']);
$q = mysqli_query($conn, "SELECT * FROM kategori WHERE id=$id");
$row = mysqli_fetch_assoc($q);

// Jika form dikirim (POST) maka update data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama_kategori']);

    $update = mysqli_query($conn, "UPDATE kategori SET nama_kategori='$nama' WHERE id=$id");

    if ($update) {
        echo "<script>alert('Data berhasil diupdate'); window.location='kategori.php';</script>";
    } else {
        echo "<script>alert('Gagal update');</script>";
    }
}
?>

<h1 class="text-2xl font-semibold">Edit Kategori</h1>
<form action="" method="post" class="mt-4 bg-white p-4 rounded shadow">
    <input type="hidden" name="id" value="<?= $row['id']; ?>">

    <label class="block">Nama Kategori</label>
    <input type="text" name="nama_kategori" value="<?= htmlspecialchars($row['nama_kategori']); ?>"
        class="border p-2 w-full mt-2" required>

    <button class="mt-4 px-4 py-2 bg-blue-600 text-white rounded">Update</button>
</form>

</div>
</div>