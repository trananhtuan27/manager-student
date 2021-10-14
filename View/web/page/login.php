<?php
require_once('Model/DBconnect.php');
if (!isset($_SESSION)) {
    session_start();
}
$error = [];

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (empty($email)) {
        $error['email'] = "メールアドレスを入力してください。";
    }
    if (empty($password)) {
        $error['password'] = "パスワードを入力してください。";
    }

    $sql = "SELECT * FROM student WHERE email = '$email'";
    $query = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($query);
    $checkEmail = mysqli_num_rows($query);
    if (!isset($_SESSION)) {
        session_start();
    }
    if ($checkEmail == 1) {
        $checkPass = password_verify($password, $data['password']);
        if ($checkPass) {
            $_SESSION['student'] = $data;
            $_SESSION['login_success'] = "Login thành công";
            header('Location: http://localhost/democode');
        } else {
            $errorPassword = "Sai mật khẩu";
        }
    } else {
        $errorMail = "Mail Không tồn tại";
    }
}
?>
<section>

    <div class="login-page">
        <?php if (isset($_SESSION['register_success'])) { ?>
            <div class="alert alert-primary" role="alert">
                Chúc mừng bạn đã đăng kí thành công tài khoản
            </div>
            <?php
            unset($_SESSION['register_success']);
        } ?>
        <div class="content-login-page">
            <h2>ようこそ就職支援システム</h2>
            <div class="form-login">
                <form action="" method="POST">
                    <div class="detail-form-login">
                        <img src="./public/assets/web/image/icon-login.png" alt="icon-login">
                        <div class="input-email">
                            <img src="./public/assets/web/image/human.jpg" alt="Human">
                            <input name="email" type="email" placeholder="メールアドレス">
                        </div>
                        <div class="error-validate">

                            <?php if (isset($error['email'])) { ?>
                                <span><?php echo (isset($error['email'])) ? $error['email'] : '' ?></span>
                            <?php } else { ?>
                                <span><?php echo (isset($errorMail)) ? $errorMail : '' ?></span>
                            <?php } ?>

                        </div>
                        <div class="input-password">
                            <img src="./public/assets/web/image/key-icon.jpg" alt="key-icon">
                            <input name="password" type="password" placeholder="パスワード">
                        </div>
                        <div class="error-validate">
                            <span><?php echo (isset($error['password'])) ? $error['password'] : '' ?></span>
                            <span><?php echo (isset($errorPassword)) ? $errorPassword : '' ?></span>
                        </div>
                        <div class="tern">
                            <input name="checkbox" type="checkbox">
                            <p>ログインしたままにする</p>
                        </div>

                        <button type="submit">ログイン</button>
                    </div>
                </form>
            </div>
            <div class="register-login-page">
                <p>ユーザーがない場合<a href="?view=register">＜＜新登録＞＞</a>をクリックしてください</p>
            </div>
        </div>
    </div>

</section>