<?php
include '../../config/koneksi.php';
include '../sidebar.php';

$limit = 10;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$start = ($page - 1) * $limit;

$q = mysqli_query(
    $conn,
    "SELECT bk.*, b.nama_barang 
     FROM barang_keluar bk 
     JOIN barang b ON bk.barang_id=b.id
     ORDER BY bk.id DESC 
     LIMIT $start,$limit"
);

$total = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM barang_keluar"));
$pages = ceil($total / $limit);

$showing_from = $start + 1;
$showing_to = min($start + $limit, $total);
?>

<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Log Barang Keluar</h1>

    <a href="barang_keluar_tambah.php" class="bg-blue-600 text-white px-4 py-2 rounded">+ Tambah Barang Keluar</a>

    <table class="mt-4 w-full bg-white rounded shadow table-auto">
        <tr class="bg-gray-100">
            <th class="px-4 py-2">No</th>
            <th class="px-4 py-2">Barang</th>
            <th class="px-4 py-2">Jumlah</th>
            <th class="px-4 py-2">Tanggal</th>
            <th class="px-4 py-2">Keterangan</th>
        </tr>

        <?php
        $no = $start + 1;
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

    <div class="mt-4 flex justify-between items-center">

        <div class="text-gray-600">
            Showing <?= $showing_from ?> to <?= $showing_to ?> of <?= $total ?> results
        </div>
    
        <div class="flex gap-2 items-center">
    
            <?php if ($page > 1): ?>
                <a href="?page=<?= $page - 1 ?>" class="px-3 py-1 border rounded bg-white hover:bg-gray-100">
                    Previous
                </a>
            <?php else: ?>
                <span class="px-3 py-1 border rounded bg-gray-200 text-gray-500 cursor-not-allowed">
                    Previous
                </span>
            <?php endif; ?>
    
            <?php for ($i = 1; $i <= $pages; $i++): ?>
                <a href="?page=<?= $i ?>" class="px-3 py-1 border rounded 
                       <?= ($page == $i ? 'bg-blue-600 text-white' : 'bg-white hover:bg-gray-100') ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>
    
            <?php if ($page < $pages): ?>
                <a href="?page=<?= $page + 1 ?>" class="px-3 py-1 border rounded bg-white hover:bg-gray-100">
                    Next
                </a>
            <?php else: ?>
                <span class="px-3 py-1 border rounded bg-gray-200 text-gray-500 cursor-not-allowed">
                    Next
                </span>
            <?php endif; ?>
    
        </div>
    </div>

</div>
</div>