<?php
include '../../config/koneksi.php';
include '../sidebar.php';

// Ambil data barang berdasarkan ID
$id = intval($_GET['id']);
$q = mysqli_query($conn, "SELECT * FROM barang WHERE id=$id");
$row = mysqli_fetch_assoc($q);

$kategori = mysqli_query($conn, "SELECT * FROM kategori ORDER BY nama_kategori ASC");

// Jika update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $kategori_id = intval($_POST['kategori']);
    $stok = intval($_POST['stok']);
    $harga = intval($_POST['harga']);
    $satuan = mysqli_real_escape_string($conn, $_POST['satuan']);

    $update = mysqli_query(
        $conn,
        "UPDATE barang SET 
            nama_barang='$nama',
            kategori_id='$kategori_id',
            stok='$stok',
            harga='$harga',
            satuan='$satuan'
         WHERE id=$id"
    );

    if ($update) {
        echo "<script>alert('Data berhasil diupdate'); window.location='barang.php';</script>";
    } else {
        echo "<script>alert('Gagal update');</script>";
    }
}
?>

<h1 class="text-2xl font-semibold">Edit Barang</h1>
<form action="" method="post" class="mt-4 bg-white p-4 rounded shadow w-full max-w-lg">

    <input type="hidden" name="id" value="<?= $row['id']; ?>">

    <label class="block">Nama Barang</label>
    <input type="text" name="nama" value="<?= htmlspecialchars($row['nama_barang']); ?>" class="border p-2 w-full mt-2"
        required>

    <label class="block mt-4">Kategori</label>
    <select name="kategori" class="border p-2 w-full mt-2" required>
        <?php while ($k = mysqli_fetch_assoc($kategori)) { ?>
            <option value="<?= $k['id']; ?>" <?= ($k['id'] == $row['kategori_id']) ? 'selected' : '' ?>>
                <?= $k['nama_kategori']; ?>
            </option>
        <?php } ?>
    </select>

    <label class="block mt-4">Stok</label>
    <input type="number" name="stok" value="<?= $row['stok']; ?>" class="border p-2 w-full mt-2" required>

    <label class="block mt-4">Harga</label>
    <input type="number" name="harga" value="<?= $row['harga']; ?>" class="border p-2 w-full mt-2" required>

    <label class="block mt-4">Satuan</label>
    <input type="text" name="satuan" value="<?= $row['satuan']; ?>" class="border p-2 w-full mt-2" required>

    <button class="mt-4 px-4 py-2 bg-blue-600 text-white rounded">Update</button>
</form>

</div>
</div>