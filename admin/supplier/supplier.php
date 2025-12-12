<?php
include '../../config/koneksi.php';
include '../sidebar.php';

// --- Konfigurasi Pagination ---
$limit = 10; // jumlah data per halaman
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$start = ($page - 1) * $limit;

// QUERY DATA
$res = mysqli_query($conn, "
    SELECT * FROM supplier 
    ORDER BY id DESC 
    LIMIT $start, $limit
");

// TOTAL DATA
$total = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM supplier"));
$pages = ceil($total / $limit);

$showing_from = $start + 1;
$showing_to = min($start + $limit, $total);
?>

<h1 class="text-2xl font-semibold">Data Supplier</h1>

<a href="supplier_tambah.php" class="inline-block mt-4 px-4 py-2 bg-blue-600 text-white rounded">
    + Tambah Supplier
</a>

<table class="table-auto mt-4 bg-white rounded shadow w-full">
    <thead>
        <tr class="bg-gray-100">
            <th class="px-4 py-2 border">No</th>
            <th class="px-4 py-2 border">Nama Supplier</th>
            <th class="px-4 py-2 border">No Telepon</th>
            <th class="px-4 py-2 border">Email</th>
            <th class="px-4 py-2 border text-center" colspan="2">Aksi</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $no = $start + 1;
        while ($row = mysqli_fetch_assoc($res)) { ?>
            <tr>
                <td class="border px-4 py-2"><?= $no++; ?></td>
                <td class="border px-4 py-2"><?= htmlspecialchars($row['nama_supplier']); ?></td>
                <td class="border px-4 py-2"><?= htmlspecialchars($row['no_telepon']); ?></td>
                <td class="border px-4 py-2"><?= htmlspecialchars($row['email']); ?></td>

                <td class="border px-4 py-2 border-r">
                    <a href="supplier_edit.php?id=<?= $row['id']; ?>"
                        class="px-2 py-1 bg-yellow-400 rounded block w-full text-center text-black">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                </td>

                <td class="border px-4 py-2">
                    <button class="px-2 py-1 bg-red-500 text-white rounded block w-full text-center btnDelete"
                        data-id="<?= $row['id']; ?>">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<!-- PAGINATION - Layout Baru -->
<div class="mt-4 flex justify-between items-center">

    <!-- Showing -->
    <div class="text-gray-600">
        Showing <?= $showing_from ?> to <?= $showing_to ?> of <?= $total ?> results
    </div>

    <div class="flex gap-2 items-center">

        <!-- Previous -->
        <?php if ($page > 1): ?>
            <a href="?page=<?= $page - 1 ?>" class="px-3 py-1 border rounded bg-white hover:bg-gray-100">
                Previous
            </a>
        <?php else: ?>
            <span class="px-3 py-1 border rounded bg-gray-200 text-gray-500 cursor-not-allowed">
                Previous
            </span>
        <?php endif; ?>

        <!-- Page Numbers -->
        <?php for ($i = 1; $i <= $pages; $i++): ?>
            <a href="?page=<?= $i ?>" class="px-3 py-1 border rounded 
               <?= ($page == $i ? 'bg-blue-600 text-white' : 'bg-white hover:bg-gray-100') ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>

        <!-- Next -->
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

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const deleteButtons = document.querySelectorAll(".btnDelete");

        deleteButtons.forEach(btn => {
            btn.addEventListener("click", function () {
                let id = this.getAttribute("data-id");

                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: "Data supplier akan hilang permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = "supplier_hapus.php?id=" + id;
                    }
                });
            });
        });
    });
</script>