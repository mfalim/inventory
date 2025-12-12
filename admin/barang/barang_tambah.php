<?php
include '../../config/koneksi.php';
include '../sidebar.php';

$kategori = mysqli_query($conn, "SELECT * FROM kategori ORDER BY nama_kategori ASC");

// Jika submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $kategori_id = intval($_POST['kategori']);
    $stok = intval($_POST['stok']);
    $harga = intval($_POST['harga']);
    $satuan = mysqli_real_escape_string($conn, $_POST['satuan']);

    $insert = mysqli_query($conn, "
        INSERT INTO barang (nama_barang, kategori_id, stok, harga, satuan)
        VALUES ('$nama','$kategori_id','$stok','$harga','$satuan')
    ");

    if ($insert) {
        echo "
        <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Barang berhasil ditambahkan!'
        }).then(() => {
            window.location = 'barang.php';
        });
        </script>";
    } else {
        echo "
        <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: 'Gagal menambahkan barang.'
        });
        </script>";
    }
}
?>


<div>
    <h1 class="text-2xl font-semibold">Tambah Barang</h1>
    <form action="" method="post" class="mt-4 bg-white p-4 rounded shadow w-full max-w-lg">

        <label class="block">Nama Barang</label>
        <input type="text" name="nama" class="border p-2 w-full mt-2" required>

        <label class="block mt-4">Kategori</label>
        <select name="kategori" class="border p-2 w-full mt-2" required>
            <option value="">-- Pilih Kategori --</option>
            <?php while ($k = mysqli_fetch_assoc($kategori)) { ?>
                <option value="<?= $k['id']; ?>"><?= $k['nama_kategori']; ?></option>
            <?php } ?>
        </select>

        <label class="block mt-4">Stok</label>
        <input type="number" name="stok" class="border p-2 w-full mt-2" required>

        <label class="block mt-4">Harga</label>
        <input type="number" name="harga" class="border p-2 w-full mt-2" required>

        <label class="block mt-4">Satuan</label>
        <select name="satuan" class="border p-2 w-full mt-2" required>
            <option value="">-- Pilih Satuan --</option>
            <option value="pcs">Pcs</option>
            <option value="kg">Kg</option>
            <option value="liter">Liter</option>
        </select>

        <button class="mt-4 px-4 py-2 bg-green-600 text-white rounded">Simpan</button>
    </form>
</div>
</div>