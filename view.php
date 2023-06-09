<?php
require_once 'data/validation.php';
requireLogin();

$viewId = getGetData('id');
$viewExist = false;
$viewTitle = $viewContent = '';
if ($viewId) {
    require_once 'data/connection.php';
    $st = $conn->prepare('SELECT title, content FROM note WHERE id=? AND owner=?');
    $st->bind_param('ii', $viewId, $userId);
    $st->execute();
    $result = $st->get_result()->fetch_assoc();
    if ($result) {
        $viewTitle = $result['title'];
        $viewContent = $result['content'];
    } else {
        redirectTo('not_found.php');
        die();
    }
    $st->close();
}

$pageTitle = $viewId ? $viewTitle : "Home";
include 'layout/header.php';
?>

<?php if ($viewId) { ?>
    <div class="w-full flex mb-3">
        <a href="edit.php?id=<?php echo $viewId ?>" class="py-2 pr-4 text-white font-bold bg-blue-500 hover:bg-blue-300 rounded-lg">
            <i class="px-2 fa fa-pencil"></i>
            Edit
        </a>
    </div>

    <div class="w-full p-2 relative shadow-sm shadow-black rounded-md">
        <h2 class="text-2xl font-bold"><?php echo $viewTitle ?></h2>
        <hr class="border-gray-400 my-2">
        <p><?php echo $viewContent ?></p>
    </div>

    <div class="w-full flex mt-3">
        <button id="delete" class="ml-auto px-2 py-2 pr-4  text-white font-bold bg-red-500 hover:bg-red-300 rounded-lg">
            <i class="px-2 fa fa-trash"></i>
            Hapus
        </button>
    </div>

    <!-- Form to delete note -->
    <form class="hidden" name="formDelete" action="delete.php" method="post">
        <input name="id" value="<?php echo htmlspecialchars($viewId) ?>">
    </form>

    <div id="dialog" class="hidden absolute left-0 right-0 top-0 bottom-0 bg-black bg-opacity-50 z-10 flex">
        <div class="m-auto bg-white border-4 border-solid border-amber-300 p-2">
            <div class="p-2 text-2xl font-bold">
                <i class="fa fa-triangle-exclamation px-2 text-3xl"></i>
                Apakah Anda yakin?
            </div>
            <div class="p-2">Hapus Catatan "<?php echo $viewTitle ?>"</div>
            <div class="p-2 flex">
                <button id="yes" class="py-1 m-1 font-bold text-white flex-auto rounded-md bg-blue-500 hover:bg-blue-400">YA</button>
                <button id="no" class="py-1 m-1 font-bold text-white flex-auto rounded-md bg-red-500 hover:bg-red-400">TIDAK</button>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('delete').addEventListener('click', () => document.getElementById('dialog').classList.remove('hidden'));
        document.getElementById('no').addEventListener('click', () => document.getElementById('dialog').classList.add('hidden'));
        document.getElementById('yes').addEventListener('click', () => {
            document.getElementById('dialog').classList.add('hidden');
            formDelete.submit();
        });
    </script>

<?php } else { ?>
    <div class="mx-auto my-4 md:my-12 w-fit rounded-lg shadow-[0px_0px_0.25rem] shadow-gray-500 p-3">
        <div class="max-w-sm p-5 text-center">
            <img src="img/Notebook Customizable Cartoon Illustrations Bro Style.png" alt="">
            Klik pada catatan yang ingin dibuka atau
            <a href="edit.php">
                <button class="block py-1 px-8 mx-auto my-1 text-white font-bold bg-blue-500 hover:bg-blue-400 rounded-full">
                    Buat Catatan
                </button>
            </a>
        </div>
    </div>
<?php } ?>

<?php include 'layout/footer.php' ?>