<?php
// sidebar include, gunakan di setiap halaman admin
$base = dirname(__DIR__);
?>


<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<div class="flex">
    <aside class="w-64 h-screen bg-gray-800 text-white fixed">
        <div class="p-6 font-bold text-xl">Inventory</div>
        <nav class="mt-6">
            <a href="/inventory/admin/dashboard.php" class="sidebar-link px-6 py-2 block">Dashboard</a>
            <a href="/inventory/admin/kategori/kategori.php" class="sidebar-link px-6 py-2 block">Kategori</a>
            <a href="/inventory/admin/supplier/supplier.php" class="sidebar-link px-6 py-2 block">Supplier</a>
            <a href="/inventory/admin/barang/barang.php" class="sidebar-link px-6 py-2 block">Barang</a>
            <a href="/inventory/admin/barang_masuk/barang_masuk.php" class="sidebar-link px-6 py-2 block">Barang Masuk</a>
            <a href="/inventory/admin/barang_keluar/barang_keluar.php" class="sidebar-link px-6 py-2 block">Barang Keluar</a>
            <!-- <a href="/mini_project/admin/laporan/index.php" class="sidebar-link px-6 py-2 block">Laporan</a> -->
        </nav>
    </aside>
    <div class="flex-1 ml-64 p-8">