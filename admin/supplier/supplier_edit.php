<?php
include '../../config/koneksi.php';
include '../sidebar.php';

$id = intval($_GET['id']);
$q = mysqli_query($conn, "SELECT * FROM supplier WHERE id=$id");
$row = mysqli_fetch_assoc($q);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama_supplier']);
    $telp = mysqli_real_escape_string($conn, $_POST['no_telepon']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $update = mysqli_query($conn, "
        UPDATE supplier SET
        nama_supplier='$nama',
        no_telepon='$telp',
        email='$email'
        WHERE id=$id
    ");

    if ($update) {
        echo "<script>alert('Data supplier berhasil diperbarui'); window.location='supplier.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data');</script>";
    }
}
?>

<h1 class="text-2xl font-semibold">Edit Supplier</h1>
<form action="" method="post" class="mt-4 bg-white p-4 rounded shadow max-w-lg">

    <input type="hidden" name="id" value="<?= $row['id']; ?>">

    <label class="block">Nama Supplier</label>
    <input type="text" name="nama_supplier" value="<?= $row['nama_supplier']; ?>" class="border p-2 w-full mt-2"
        required>

    <label class="block mt-4">No Telepon</label>
    <input type="text" name="no_telepon" value="<?= $row['no_telepon']; ?>" class="border p-2 w-full mt-2" required>

    <label class="block mt-4">Email</label>
    <input type="email" name="email" value="<?= $row['email']; ?>" class="border p-2 w-full mt-2" required>

    <button class="mt-4 px-4 py-2 bg-blue-600 text-white rounded">Update</button>
</form>

</div>
</div>