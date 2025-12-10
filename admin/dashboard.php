<?php
include '../config/koneksi.php';
include 'sidebar.php';

// ------ CARD SUMMARY ------
$tb_barang = mysqli_query($conn, "SELECT COUNT(*) as cnt FROM barang");
$r_barang = mysqli_fetch_assoc($tb_barang);

$tb_kategori = mysqli_query($conn, "SELECT COUNT(*) as cnt FROM kategori");
$r_kategori = mysqli_fetch_assoc($tb_kategori);

$tb_supplier = mysqli_query($conn, "SELECT COUNT(*) as cnt FROM supplier");
$r_supplier = mysqli_fetch_assoc($tb_supplier);

// ------ GRAFIK DATA MASUK & KELUAR PER BULAN ------
$masuk = mysqli_query($conn, "SELECT MONTH(tanggal) bulan, SUM(jumlah) total FROM barang_masuk GROUP BY MONTH(tanggal)");
$keluar = mysqli_query($conn, "SELECT MONTH(tanggal) bulan, SUM(jumlah) total FROM barang_keluar GROUP BY MONTH(tanggal)");

$bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
$dataMasuk = array_fill(0, 12, 0);
$dataKeluar = array_fill(0, 12, 0);

while ($m = mysqli_fetch_assoc($masuk))
    $dataMasuk[$m['bulan'] - 1] = $m['total'];
while ($k = mysqli_fetch_assoc($keluar))
    $dataKeluar[$k['bulan'] - 1] = $k['total'];
?>


<h1 class="text-2xl font-semibold">Dashboard</h1>

<!-- CARD SUMMARY -->
<div class="grid grid-cols-3 gap-4 mt-6">
    <div class="p-4 bg-white rounded shadow">
        <div class="text-sm text-gray-500">Total Barang</div>
        <div class="text-3xl font-bold"><?= $r_barang['cnt']; ?></div>
    </div>
    <div class="p-4 bg-white rounded shadow">
        <div class="text-sm text-gray-500">Kategori</div>
        <div class="text-3xl font-bold"><?= $r_kategori['cnt']; ?></div>
    </div>
    <div class="p-4 bg-white rounded shadow">
        <div class="text-sm text-gray-500">Supplier</div>
        <div class="text-3xl font-bold"><?= $r_supplier['cnt']; ?></div>
    </div>
</div>


<!-- GRAFIK -->
<div class="bg-white rounded shadow p-4 mt-8">
    <div class="flex justify-between mb-3">
        <h2 class="text-xl font-semibold">Grafik Barang Masuk & Keluar</h2>

        <div class="space-x-2">
            <a href="file/export_excel.php" class="px-3 py-1 bg-green-600 text-white rounded">Export Excel</a>
            <a href="file/export_txt.php" class="px-3 py-1 bg-gray-700 text-white rounded">Export TXT</a>
        </div>
    </div>

    <canvas id="chartBarang" height="100"></canvas>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('chartBarang');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($bulan) ?>,
            datasets: [
                {
                    label: 'Barang Masuk',
                    data: <?= json_encode($dataMasuk) ?>,
                    backgroundColor: 'rgba(54,162,235,0.6)'
                },
                {
                    label: 'Barang Keluar',
                    data: <?= json_encode($dataKeluar) ?>,
                    backgroundColor: 'rgba(255,99,132,0.6)'
                }
            ]
        }
    });
</script>

</div>
</div>