<?php
require_once 'data/validation.php';
requireNotLogin('view.php');

$email = '';
if (methodIsPost()) {
    $email = getPostData('email', 'E-mail harus diisi.');
    $password = getPostData('password', 'Password harus diisi.');

    if ($errorMsg == '') {
        require_once 'data/connection.php';
        $st = $conn->prepare('SELECT id, nama, email, password FROM user WHERE email=?');
        $st->bind_param('s', $email);
        $st->execute();
        $result = $st->get_result();
        if ($result->num_rows == 0) {
            $errorMsg = 'E-mail atau password yang anda masukkan tidak benar.';
        } else {
            $row = $result->fetch_assoc();
            $hashedPassword = $row['password'];
            if (password_verify($password, $hashedPassword)) {
                $_SESSION['userId'] = $row['id'];
                $_SESSION['nama'] = $row['nama'];
                $_SESSION['email'] = $row['email'];
                redirectTo('view.php');
                die();
            } else {
                $errorMsg = 'E-mail atau password yang anda masukkan tidak benar.';
            }
        }
        $conn->close();
    }
}

$pageTitle = 'Login';
include 'layout/simple-header.php';
?>
<div class="flex p-2 bg-img-blue min-h-screen">
    <div class="mx-auto my-auto md:w-2/3 rounded-lg shadow-[0px_0px_0.25rem] shadow-gray-500 flex bg-white">
        <div class="max-md:hidden w-1/2 rounded-l-lg bg-cover bg-no-repeat bg-bottom" style="background-image: url(img/bg-1.jpeg);">
        </div>
        <div class="md:w-1/2 p-4 md:p-8">
            <h1 class="w-full my-4 md:my-12 text-center text-3xl font-bold">LOGIN</h1>
            <form action="login.php" method="post">
                <div class="my-2 w-full flex">
                    <div class="px-3 py-1 bg-blue-500 text-white border border-r-0 border-solid border-blue-500 rounded-l-md">
                        <i class="fa fa-at"></i>
                    </div>
                    <input class="p-1 pl-2 w-full flex-grow border border-solid border-blue-500 rounded-r-md" type="email" name="email" placeholder="email" value="<?php echo htmlspecialchars($email) ?>" required>
                </div>
                <div class="my-2 w-full flex">
                    <div class="px-3 py-1 bg-blue-500 text-white border border-r-0 border-solid border-blue-500 rounded-l-md">
                        <i class="fa fa-lock"></i>
                    </div>
                    <input class="p-1 pl-2 w-full flex-grow border border-solid border-blue-500 rounded-r-md" type="password" name="password" placeholder="password" required>
                </div>
                <div>
                    <input type="checkbox" name="rememberme" id="rememberme">
                    <label for="rememberme">Ingat Saya</label>
                </div>
                <div class="text-red-500">
                    <?php echo $errorMsg ?>
                </div>
                <div class="mt-4">
                    Belum punya akun?
                    <a href="register.php" class="text-blue-500 hover:underline">Daftar Sekarang</a>
                </div>
                <button class="w-full p-1 my-1 text-white font-bold bg-blue-500 hover:bg-blue-400 rounded-md">
                    Login
                </button>
            </form>
        </div>
    </div>
</div>
<?php include 'layout/simple-footer.php' ?>