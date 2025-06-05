<?php
$pageTitle = 'Home';
include 'layout/simple-header.php';
// require_once 'data/validation.php';
?>

<div class="bg-img-blue min-h-screen flex">
    <div class="my-auto mx-8 md:mx-16 text-white">
        <h1 class="text-white text-3xl md:text-5xl">Selamat Datang di Aplikasi <span class="title-label">CatatanKu</span>.</h1>
        <div class="md:text-2xl my-8">
            CatatanKu adalah apliaksi yang digunakan untuk menyimpan catatan Anda secara online.
        </div>
        <a href="#more" class="md:text-2xl bg-yellow-500 hover:bg-yellow-400 rounded-full py-2 px-6">Pelajari Selengkapnya</a>
    </div>
</div>

<div id="more" class="px-4 py-12 md:p-16 flex min-h-screen">
    <div class="my-auto w-full">
        <h1 class="text-center text-5xl mb-16">Fitur Aplikasi CatatanKu</h1>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="p-8 rounded-lg shadow-[0px_0px_0.25rem]">
                <h1 class="text-3xl mb-3">Akses Dimanapun</h1>
                <p class="text-gray-500">Anda dapat membuka catatan Anda dimanapun Anda berada.</p>
            </div>
            <div class="p-8 rounded-lg shadow-[0px_0px_0.25rem]">
                <h1 class="text-3xl mb-3">Akses Kapanpun</h1>
                <p class="text-gray-500">Anda dapat membuka catatan Anda kapanpun.</p>
            </div>
            <div class="p-8 rounded-lg shadow-[0px_0px_0.25rem]">
                <h1 class="text-3xl mb-3">Data Aman</h1>
                <p class="text-gray-500">Data Anda aman bersama kami.</p>
            </div>
            <div class="p-8 rounded-lg shadow-[0px_0px_0.25rem]">
                <h1 class="text-3xl mb-3">Akses Unlimited</h1>
                <p class="text-gray-500">Buat catatan sebanyak yang Anda mau tanpa batas.</p>
            </div>
        </div>
    </div>
</div>

<?php include 'layout/simple-footer.php' ?>