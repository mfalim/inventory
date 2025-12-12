<?php
include '../../config/koneksi.php';
include '../sidebar.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $barang_id = $_POST['barang_id'];
    $supplier_id = $_POST['supplier_id'];
    $jumlah = $_POST['jumlah'];
    $tanggal = $_POST['tanggal'];
    $keterangan = $_POST['keterangan'];

    $insert = mysqli_query($conn, "INSERT INTO barang_masuk (barang_id, supplier_id, jumlah, tanggal, keterangan) 
                         VALUES('$barang_id','$supplier_id','$jumlah','$tanggal','$keterangan')");

    mysqli_query($conn, "UPDATE barang SET stok = stok + $jumlah WHERE id='$barang_id'");

    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'id';
    $order = isset($_GET['order']) ? $_GET['order'] : 'DESC';

    $allowed_sort = ['id', 'nama_barang', 'stok', 'harga', 'nama_kategori'];

    if (!in_array($sort, $allowed_sort)) {
        $sort = 'id';
    }

    $order = ($order === 'asc') ? 'ASC' : 'DESC';

    if ($insert) {
        echo "
            <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Barang berhasil ditambahkan!',
            }).then(() => {
                window.location='barang_masuk.php';
            });
            </script>";
    } else {
        echo "
            <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Gagal Menambahkan Barang!',
            }).then(() => {
                window.location='barang_masuk.php';
            });
            </script>";
    }
    exit;
}

$barang = mysqli_query($conn, "SELECT * FROM barang");
$supplier = mysqli_query($conn, "SELECT * FROM supplier");
?>

<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Tambah Barang Masuk</h1>

    <form method="post" class="bg-white p-4 rounded shadow w-96">

        <label>Nama Barang</label>
        <select name="barang_id" required class="border p-2 w-full mt-2">
            <option value="">Pilih Barang</option>
            <?php while ($b = mysqli_fetch_assoc($barang)): ?>
                <option value="<?= $b['id'] ?>"><?= $b['nama_barang'] ?></option>
            <?php endwhile; ?>
        </select>

        <label class="mt-3 block">Supplier</label>
        <select name="supplier_id" required class="border p-2 w-full mt-2">
            <option value="">Pilih Supplier</option>
            <?php while ($s = mysqli_fetch_assoc($supplier)): ?>
                <option value="<?= $s['id'] ?>"><?= $s['nama_supplier'] ?></option>
            <?php endwhile; ?>
        </select>

        <label class="mt-3 block">Jumlah</label>
        <input type="number" name="jumlah" required class="border p-2 w-full">

        <label class="mt-3 block">Tanggal</label>
        <input type="date" name="tanggal" required class="border p-2 w-full">

        <label class="mt-3 block">Keterangan</label>
        <textarea name="keterangan" class="border p-2 w-full"></textarea>

        <button class="mt-4 bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
    </form>

</div>
</div>