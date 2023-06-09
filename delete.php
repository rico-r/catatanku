<?php
require_once 'data/validation.php';
requireLogin();

if (methodIsPost()) {
    $noteId = getPostData('id', 'No id');
    if (!$errorMsg) {
        require_once 'data/connection.php';
        $st = $conn->prepare('DELETE FROM note WHERE id=? AND owner=?');
        $st->bind_param('ii', $noteId, $userId);
        $st->execute();
        $st->close();
    }
}
redirectTo('view.php');
