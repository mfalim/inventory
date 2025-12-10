<?php
include '../../config/koneksi.php';
include '../sidebar.php';

$res = mysqli_query($conn, "
    SELECT barang.*, kategori.nama_kategori 
    FROM barang 
    LEFT JOIN kategori ON barang.kategori_id = kategori.id 
    ORDER BY barang.id DESC
");
?>

<h1 class="text-2xl font-semibold">Data Barang</h1>

<a href="barang_tambah.php" class="inline-block mt-4 px-4 py-2 bg-blue-600 text-white rounded">
    + Tambah Barang
</a>

<table class="table-auto mt-4 bg-white rounded shadow w-full">
    <thead>
        <tr>
            <th class="px-4 py-2 border">No</th>
            <th class="px-4 py-2 border">Nama Barang</th>
            <th class="px-4 py-2 border">Kategori</th>
            <th class="px-4 py-2 border">Stok</th>
            <th class="px-4 py-2 border">Harga</th>
            <th class="px-4 py-2 border">Aksi</th>
        </tr>
    </thead>

    <tbody>
        <?php $no = 1;
        while ($row = mysqli_fetch_assoc($res)) { ?>
            <tr>
                <td class="border px-4 py-2"><?= $no++; ?></td>
                <td class="border px-4 py-2"><?= htmlspecialchars($row['nama_barang']); ?></td>
                <td class="border px-4 py-2">
                    <?= $row['nama_kategori'] ?? '<span class="text-gray-400 italic">Belum ada</span>' ?></td>
                <td class="border px-4 py-2"><?= $row['stok']; ?></td>
                <td class="border px-4 py-2">Rp<?= number_format($row['harga']); ?></td>
                <td class="border px-4 py-2 space-x-2">
                    <a href="barang_edit.php?id=<?= $row['id']; ?>" class="px-2 py-1 bg-yellow-400 rounded">Edit</a>

                    <a href="barang_hapus.php?id=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus?')"
                        class="px-2 py-1 bg-red-500 text-white rounded">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

</div>
</div>