<?php
require_once 'data/validation.php';
requireLogin();

$editId = $title = $content = '';
if (methodIsPost()) {
    $id = getPostData('id', false);
    $title = getPostData('title', 'Judul tidak boleh kosong.');
    $content = getPostData('content', 'Isi catatan tidak boleh kosong.');
    if (strlen($title) > 40) {
        $errorMsg = "Judul terlalu panjang.";
    }

    if (!$errorMsg) {
        require_once 'data/connection.php';
        if ($id) {
            // update
            $st = $conn->prepare('UPDATE note SET title=?, content=?, last_modified=now() WHERE id=? and owner=?');
            $st->bind_param('ssii', $title, $content, $id, $userId);
            $st->execute();
            $resultId = $id;
        } else {
            // create
            $st = $conn->prepare('INSERT INTO note(owner, title, content) values(?, ?, ?)');
            $st->bind_param('iss', $userId, $title, $content);
            $st->execute();
            $resultId = $st->insert_id;
        }
        redirectTo("view.php?id=$resultId");
        $st->close();
        die();
    }
}

$editId = getGetData('id', false);
if ($editId) {
    $viewId = $editId;
    require_once 'data/connection.php';
    $st = $conn->prepare('SELECT owner, title, content FROM note WHERE id=? AND owner=?');
    $st->bind_param('ii', $editId, $userId);
    $st->execute();
    $result = $st->get_result()->fetch_assoc();
    if ($result) {
        $title = $result['title'];
        $content = $result['content'];
    } else {
        redirectTo('not_found.php');
        die();
    }
    $st->close();
} else {
    $viewId = -1;
}

$pageTitle = $editId ? "Edit Catatan" : "Buat Catatan";
include 'layout/header.php';
?>

<div class="w-full flex mb-3 p-2">
    <button onclick="formEdit.submit()" class="py-2 pl-2 pr-4 text-white font-bold bg-blue-500 hover:bg-blue-300 rounded-lg">
        <i class="px-2 fa fa-save"></i>
        Simpan
    </button>
    <a id="delete" href=" <?php echo $editId ? "view.php?id=$editId" : "view.php" ?>" class="ml-auto px-2 py-2 pr-4 text-white font-bold bg-red-500 hover:bg-red-300 rounded-lg">
        <i class="px-2 fa fa-x"></i>
        Batal
    </a>
</div>

<div class="w-full relative shadow-sm shadow-gray-700 p-3">
    <div class="text-sm text-red-500 mb-2"><?php echo $errorMsg ?></div>
    <form name="formEdit" action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post">
        <?php if ($editId) { ?>
            <input type="hidden" name="id" value="<?php echo $editId ?>">
        <?php } ?>
        <input type="text" name="title" id="title" placeholder="Judul" value="<?php echo $title ?>" class="px-2 py-1 w-full border border-solid border-gray-500 rounded-md" required>
        <textarea name="content" id="content" rows="5" placeholder="Catatan..." class="px-2 py-1 mt-2 w-full border border-solid border-gray-500 rounded-md" required><?php echo $content ?></textarea>
    </form>
</div>


<?php include 'layout/footer.php' ?>