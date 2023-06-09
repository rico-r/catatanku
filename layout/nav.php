<?php
require_once __DIR__ . '/../data/connection.php';

$st = $conn->prepare('SELECT id, title, last_modified FROM note WHERE owner=? ORDER BY last_modified DESC');
$st->bind_param('i', $userId);
$st->execute();
$rows = $st->get_result()->fetch_all(MYSQLI_ASSOC);
$st->close();
?>

<div id="nav-top" class="mt-2">
    <div class="w-full flex">
        <input id="search" class="p-1 pl-2 w-full flex-grow border border-solid border-blue-500 rounded-l-md" type="text" placeholder="Cari Catatan...">
        <button class="px-3 py-1 bg-blue-500 text-white hover:bg-blue-400 border border-l-0 border-solid border-blue-500 rounded-r-md" onclick="search()">
            <i class="fa fa-search"></i>
        </button>
    </div>
    <a href="edit.php">
        <button class="w-full p-1 my-1 text-white font-bold bg-blue-500 hover:bg-blue-400 rounded-md">
            <i class="fa fa-plus-square"></i>
            Buat Catatan
        </button>
    </a>
</div>
<?php
$curr = date_create();
foreach ($rows as $index => $row) {
    $itemId = $row['id'];
    $last_modified = new DateTime($row['last_modified']);
    $diff = date_diff($curr, $last_modified, true);
    $class1 = $class2 = '';
    if ($itemId == $viewId) {
        $class2 = "bg-blue-400";
    }
    if ($diff->days == 0) {
        $class1 = "lastmod-today";
    } else if ($diff->days == 1) {
        $class1 = "lastmod-yesterday";
    } else if ($diff->days < 7) {
        $class1 = "lastmod-week";
    } else if ($diff->days < 30) {
        $class1 = "lastmod-month";
    } else {
        $class1 = "lastmod-old";
    }
?>
    <div class="<?php echo $class1 ?>">
        <a href="<?php echo "view.php?id=$itemId" ?>" class="block p-2 border-t border-solid border-gray-300 <?php echo $class2 ?> hover:bg-blue-300">
            <i class="fa fa-circle-arrow-right pr-2"></i>
            <?php echo $row['title'] ?>
        </a>
    </div>
<?php } ?>