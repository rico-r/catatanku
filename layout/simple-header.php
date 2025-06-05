<!DOCTYPE html>
<html lang="en" class="min-h-screen">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Rico Ronaldo">
    <meta name="nim" content="22330781">
    <title><?php echo htmlspecialchars($pageTitle) ?> | CatatanKu</title>
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <link rel="stylesheet" href="css/solid.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://cdn.tailwindcss.com/"></script>
</head>

<body class="min-h-screen">
    <div class="shadow-md z-50 py-1 flex fixed left-0 top-0 right-0 bg-white">
        <div class="flex">
            <img src="img/logo-1.png" alt="LogoCatatanKu" width="40" class="mr-2">
            <a href="index.php" class="title-label text-2xl my-auto">CatatanKu</a>
        </div>
        <?php $page = basename($_SERVER["SCRIPT_NAME"]) ?>
        <div id="menu" class="w-fit ml-auto my-auto p-2">
            <a href="index.php" class="px-3 py-1 border-solid border-blue-500 text-blue-500 font-bold hover:bg-blue-200 <?php if ($page == 'index.php') echo 'border-b-2' ?>">Home</a>
            <?php if ($page != "login.php") { ?>
                <a href="login.php" class="py-1 px-4 text-blue-500 hover:bg-blue-500 hover:text-white font-bold border border-solid border-blue-500 rounded-full">Login</a>
            <?php } else { ?>
                <a href="register.php" class="py-1 px-4 text-blue-500 hover:bg-blue-500 hover:text-white font-bold border border-solid border-blue-500 rounded-full">Daftar</a>
            <?php } ?>
        </div>
    </div>