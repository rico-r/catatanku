<!DOCTYPE html>
<html lang="en" class="min-h-full">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Rico Ronaldo">
    <meta name="nim" content="22330781">

    <title><?php echo $pageTitle ?> | CatatanKu</title>

    <link rel="stylesheet" href="css/fontawesome.min.css">
    <link rel="stylesheet" href="css/solid.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen">
    <div class="md:shadow-md z-50 flex max-md:flex-col">
        <div class="max-md:shadow-md flex p-2">
            <img src="img/logo-1.png" alt="LogoCatatanKu" width="40" class="mr-2">
            <div class="title-label text-2xl my-auto">CatatanKu</div>
            <button id="nav-button" class="px-2 ml-auto rounded-md border border-solid hidden border-gray-400 hover:shadow-sm hover:shadow-gray-700 max-md:block">
                <i class="fa fa-list"></i>
            </button>
        </div>
        <div id="menu" class="md:ml-auto p-2 max-md:hidden">
            <!-- Menu for medium screen -->
            <div class="max-md:hidden">
                <div data-popover-target="popover-click" data-popover-trigger="click">
                    <i class="block fa text-4xl fa-user-circle"></i>
                </div>
                <div data-popover id="popover-click" role="tooltip" data-popover-placement="left" class="absolute z-10 invisible inline-block w-64 transition-opacity duration-300 bg-white shadow-[0px_0px_0.25rem] p-2 rounded-md">
                    <div class="flex text-xs mb-2">
                        <i class="block fa text-4xl fa-user-circle"></i>
                        <div class="mx-2 my-auto">
                            <div><?php echo htmlspecialchars(getSessionData('nama')) ?></div>
                            <div><?php echo getSessionData('email') ?></div>
                        </div>
                    </div>
                    <div class="p-2 border-t border-solid border-gray-300 hover:bg-blue-300" onclick="logout()">
                        <i class="fa fa-sign-out-alt"></i>
                        Logout
                    </div>
                </div>
            </div>
            <!-- menu for small screen -->
            <div class="md:hidden">
                <div class="flex text-xs mb-2">
                    <i class="block fa text-4xl fa-user-circle"></i>
                    <div class="mx-2 my-auto">
                        <div><?php echo htmlspecialchars(getSessionData('nama')) ?></div>
                        <div><?php echo getSessionData('email') ?></div>
                    </div>
                </div>
                <div class="p-2 border-y border-solid border-gray-300 hover:bg-blue-300" onclick="logout()">
                    <i class="fa fa-sign-out-alt"></i>
                    Logout
                </div>
            </div>
        </div>
    </div>
    <div class="flex min-h-screen max-md:flex-col-reverse">
        <div id="navigation" class="shadow-sm shadow-black px-1 md:w-1/4 md:min-h-screen">
            <?php include 'nav.php' ?>
            <div class="empty text-center p-4 text-gray-500">
                Tidak ada catatan
            </div>
        </div>
        <div class="w-3/4 max-md:w-full p-3">