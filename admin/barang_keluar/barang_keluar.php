<?php
include '../../config/koneksi.php';
include '../sidebar.php';

// PAGINATION
$limit = 10;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$mulai = ($page - 1) * $limit;

$q = mysqli_query(
    $conn,
    "SELECT bk.*, b.nama_barang 
 FROM barang_keluar bk 
 JOIN barang b ON bk.barang_id=b.id
 ORDER BY bk.id DESC 
 LIMIT $mulai,$limit"
);

$total = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM barang_keluar"));
$pages = ceil($total / $limit);
?>

<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Log Barang Keluar</h1>

    <a href="barang_keluar_tambah.php" class="bg-green-600 text-white px-4 py-2 rounded">+ Barang Keluar</a>

    <table class="mt-4 w-full bg-white rounded shadow table-auto">
        <tr class="bg-gray-100">
            <th class="px-4 py-2">No</th>
            <th class="px-4 py-2">Barang</th>
            <th class="px-4 py-2">Jumlah</th>
            <th class="px-4 py-2">Tanggal</th>
            <th class="px-4 py-2">Keterangan</th>
        </tr>

        <?php
        $no = $mulai + 1;
        while ($d = mysqli_fetch_assoc($q)): ?>
            <tr>
                <td class="border px-4 py-2"><?= $no++ ?></td>
                <td class="border px-4 py-2"><?= $d['nama_barang'] ?></td>
                <td class="border px-4 py-2"><?= $d['jumlah'] ?></td>
                <td class="border px-4 py-2"><?= $d['tanggal'] ?></td>
                <td class="border px-4 py-2"><?= $d['keterangan'] ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

    <!-- PAGINATION -->
    <div class="mt-4 flex gap-2">
        <?php for ($i = 1; $i <= $pages; $i++): ?>
            <a href="?page=<?= $i ?>" class="px-3 py-1 border rounded <?= $i == $page ? 'bg-blue-500 text-white' : '' ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>
    </div>

</div>
</div>