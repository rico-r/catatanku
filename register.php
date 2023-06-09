<?php
require_once 'data/validation.php';

$nama = $email = '';
if (methodIsPost()) {
    $nama = getPostData('nama', 'Nama harus diisi.');
    $email = getPostData('email', 'E-mail harus diisi.');
    $password = getPostData('password', 'Password harus diisi.');
    $confirmPassword = getPostData('confirmPassword', 'Konfirmasi password harus diisi');
    if ($password != $confirmPassword) {
        $errorMsg = 'Konfirmasi password tidak sama.';
    }

    if ($errorMsg == '') {
        require_once 'data/connection.php';
        $st = $conn->prepare('INSERT INTO user(nama, email, password) VALUES(?,?,?)');
        $password = password_hash($password, null);
        $st->bind_param('sss', $nama, $email, $password);
        $result = false;
        try {
            $result = $st->execute();
        } catch (mysqli_sql_exception $e) {
        }
        if ($result) {
            redirectTo('thanks.php');
            $conn->close();
            die();
        } else {
            $errorMsg = 'E-mail yang Anda masukkan sudah terdaftar.';
            $conn->close();
        }
    }
}

$pageTitle = 'Daftar';
include 'layout/simple-header.php';
?>
<div class="flex p-2 bg-img-blue min-h-screen">
    <div class="mx-auto my-auto w-96 p-4 md:p-8 rounded-lg shadow-[0px_0px_0.25rem] shadow-gray-500 bg-white">
        <h1 class="w-full text-center my-4 md:mt-8 md:mb-12 text-3xl font-bold">DAFTAR</h1>
        <form method="post" action="register.php">
            <div class="my-2 w-full flex">
                <div class="px-3 py-1 bg-blue-500 text-white border border-r-0 border-solid border-blue-500 rounded-l-md">
                    <i class="fa fa-user"></i>
                </div>
                <input class="p-1 pl-2 w-full flex-grow border border-solid border-blue-500 rounded-r-md" type="name" name="nama" placeholder="Nama" value="<?php echo $nama ?>" required>
            </div>
            <div class="my-2 w-full flex">
                <div class="px-3 py-1 bg-blue-500 text-white border border-r-0 border-solid border-blue-500 rounded-l-md">
                    <i class="fa fa-at"></i>
                </div>
                <input class="p-1 pl-2 w-full flex-grow border border-solid border-blue-500 rounded-r-md" type="email" name="email" placeholder="email" value="<?php echo $email ?>" required>
            </div>
            <div class="my-2 w-full flex">
                <div class="px-3 py-1 bg-blue-500 text-white border border-r-0 border-solid border-blue-500 rounded-l-md">
                    <i class="fa fa-lock"></i>
                </div>
                <input class="p-1 pl-2 w-full flex-grow border border-solid border-blue-500 rounded-r-md" type="password" name="password" placeholder="Password" required>
            </div>
            <div class="my-2 w-full flex">
                <div class="px-3 py-1 bg-blue-500 text-white border border-r-0 border-solid border-blue-500 rounded-l-md">
                    <i class="fa fa-repeat"></i>
                </div>
                <input class="p-1 pl-2 w-full flex-grow border border-solid border-blue-500 rounded-r-md" type="password" name="confirmPassword" placeholder="Konfirmasi Password" required>
            </div>
            <div class="text-red-500">
                <?php echo $errorMsg ?>
            </div>
            <div class="mt-4">
                Sudah punya akun?
                <a href="login.php" class="text-blue-500 hover:underline">Login</a>
            </div>
            <button class="w-full p-1 my-1 text-white font-bold bg-blue-500 hover:bg-blue-400 rounded-md">
                Daftar
            </button>
        </form>
    </div>
</div>
<?php include 'layout/simple-footer.php' ?>