<?php
include '../../config/koneksi.php';
include '../sidebar.php';

$limit = 10;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$start = ($page - 1) * $limit;

$query = mysqli_query($conn, "SELECT bm.*, b.nama_barang, s.nama_supplier
                              FROM barang_masuk bm
                              JOIN barang b ON bm.barang_id=b.id
                              JOIN supplier s ON bm.supplier_id=s.id
                              ORDER BY bm.id DESC LIMIT $start, $limit");

$total = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM barang_masuk"));
$pages = ceil($total / $limit);

$showing_from = $start + 1;
$showing_to = min($start + $limit, $total);
?>

<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Log Barang Masuk</h1>

    <a href="barang_masuk_tambah.php" class="px-4 py-2 bg-blue-600 text-white rounded">
        + Tambah Barang Masuk
    </a>

    <table class="w-full mt-5 border-collapse">
        <tr class="bg-gray-200 text-left">
            <th class="p-2 border">Barang</th>
            <th class="p-2 border">Supplier</th>
            <th class="p-2 border">Jumlah</th>
            <th class="p-2 border">Tanggal</th>
            <th class="p-2 border">Keterangan</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($query)): ?>
            <tr>
                <td class="border p-2"><?= htmlspecialchars($row['nama_barang']) ?></td>
                <td class="border p-2"><?= htmlspecialchars($row['nama_supplier']) ?></td>
                <td class="border p-2"><?= $row['jumlah'] ?></td>
                <td class="border p-2"><?= $row['tanggal'] ?></td>
                <td class="border p-2"><?= $row['keterangan'] ?></td>
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