<?php
include '../../config/koneksi.php';
include '../sidebar.php';

// PROSES SIMPAN
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $barang_id = $_POST['barang_id'];
    $jumlah = $_POST['jumlah'];
    $keterangan = $_POST['keterangan'];

    $cek = mysqli_query($conn, "SELECT stok FROM barang WHERE id='$barang_id'");
    $stok_barang = mysqli_fetch_assoc($cek)['stok'];

    if ($jumlah > $stok_barang) {
        echo "
        <script>
        Swal.fire({
            icon: 'error',
            title: 'Stok Tidak Cukup',
            text: 'Jumlah melebihi stok yang tersedia!',
        }).then(() => {
            window.location='barang_keluar_tambah.php';
        });
        </script>";
        exit;
    }

    $tanggal = date("Y-m-d");

    $insert = mysqli_query($conn, "
        INSERT INTO barang_keluar (barang_id, jumlah, tanggal, keterangan)
        VALUES ('$barang_id', '$jumlah', '$tanggal', '$keterangan')
    ");

    mysqli_query($conn, "UPDATE barang SET stok = stok - $jumlah WHERE id='$barang_id'");

    if ($insert) {
        echo "
        <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Barang keluar berhasil disimpan!',
        }).then(() => {
            window.location='barang_keluar.php';
        });
        </script>";
    } else {
        echo "
        <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: 'Gagal menyimpan barang keluar.',
        }).then(() => {
            window.location='barang_keluar.php';
        });
        </script>";
    }

    exit;
}

$barang = mysqli_query($conn, "SELECT * FROM barang");
?>

<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Tambah Barang Keluar</h1>

    <form method="post" class="bg-white p-4 rounded shadow w-96">

        <label>Nama Barang</label>
        <select name="barang_id" required class="border p-2 w-full mt-2">
            <option value="">Pilih Barang</option>
            <?php while ($b = mysqli_fetch_assoc($barang)): ?>
                <option value="<?= $b['id'] ?>">
                    <?= $b['nama_barang'] ?> (Stok: <?= $b['stok'] ?>)
                </option>
            <?php endwhile; ?>
        </select>

        <label class="block mt-3">Jumlah Keluar</label>
        <input type="number" name="jumlah" min="1" required class="border p-2 w-full">

        <label class="block mt-3">Keterangan</label>
        <textarea name="keterangan" class="border p-2 w-full"></textarea>

        <button class="mt-4 bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
    </form>

</div>
</div>