<?php
include '../../config/koneksi.php';
include '../sidebar.php';


$res = mysqli_query($conn, "SELECT * FROM kategori ORDER BY id DESC");
?>


<h1 class="text-2xl font-semibold">Data Kategori</h1>
<a href="kategori_tambah.php" class="inline-block mt-4 px-4 py-2 bg-blue-600 text-white rounded">+ Tambah Kategori</a>


<table class="table-auto mt-4 bg-white rounded shadow">
    <thead>
        <tr>
            <th class="px-4 py-2">No</th>
            <th class="px-4 py-2">Nama Kategori</th>
            <th class="px-4 py-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        while ($row = mysqli_fetch_assoc($res)) { ?>
            <tr>
                <td class="border px-4 py-2"><?= $no++; ?></td>
                <td class="border px-4 py-2"><?= htmlspecialchars($row['nama_kategori']); ?></td>
                <td class="border px-4 py-2">
                    <a href="kategori_edit.php?id=<?= $row['id']; ?>" class="px-2 py-1 bg-yellow-400 rounded">Edit</a>
                    <a href="kategori_hapus.php?id=<?= $row['id']; ?>" onclick="return confirm('Yakin?')"
                        class="px-2 py-1 bg-red-500 text-white rounded">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>


</div>
</div>