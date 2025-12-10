<?php
include '../../config/koneksi.php';
include '../sidebar.php';

$res = mysqli_query($conn, "SELECT * FROM supplier ORDER BY id DESC");
?>

<h1 class="text-2xl font-semibold">Data Supplier</h1>
<a href="supplier_tambah.php" class="inline-block mt-4 px-4 py-2 bg-blue-600 text-white rounded">+ Tambah Supplier</a>

<table class="table-auto mt-4 bg-white rounded shadow w-full">
    <thead>
        <tr class="bg-gray-100">
            <th class="px-4 py-2 border">No</th>
            <th class="px-4 py-2 border">Nama Supplier</th>
            <th class="px-4 py-2 border">No Telepon</th>
            <th class="px-4 py-2 border">Email</th>
            <th class="px-4 py-2 border">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        while ($row = mysqli_fetch_assoc($res)) { ?>
            <tr>
                <td class="border px-4 py-2"><?= $no++ ?></td>
                <td class="border px-4 py-2"><?= htmlspecialchars($row['nama_supplier']); ?></td>
                <td class="border px-4 py-2"><?= $row['no_telepon']; ?></td>
                <td class="border px-4 py-2"><?= $row['email']; ?></td>
                <td class="border px-4 py-2">
                    <a href="supplier_edit.php?id=<?= $row['id']; ?>" class="px-2 py-1 bg-yellow-400 rounded">Edit</a>
                    <a href="supplier_hapus.php?id=<?= $row['id']; ?>"
                        onclick="return confirm('Yakin ingin menghapus supplier ini?')"
                        class="px-2 py-1 bg-red-500 text-white rounded">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

</div>
</div>