<?php
require_once 'data/validation.php';
requireLogin();

$viewId = -1;
$pageTitle = "Catatan Tidak Ditemukan";
include 'layout/header.php';
?>

<div class="mx-auto my-4 md:my-12 w-fit rounded-lg shadow-[0px_0px_0.25rem] shadow-gray-500 p-3">
    <div class="max-w-sm p-5 text-center">
        <img src="img/not_found.jpeg" alt="">
        <h3 class="font-bold text-xl">Catatan Tidak Ditemukan.</h3>
        <div class="text-center">Catatan mungkin telah dihapus.</div>
    </div>
</div>

<?php include 'layout/footer.php' ?>