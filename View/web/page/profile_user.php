<?php

require_once('Model/DBconnect.php');
if (!isset($_SESSION)) {
    session_start();
}

$error = [];
$student = (isset($_SESSION['student'])) ? $_SESSION['student'] : [];

$currentUser = $_SESSION['student'];//lay session us or die(mysqli_error(1));
$id = $currentUser['id'];



$query = mysqli_query($conn, "SELECT * FROM student where id ='$id'") or die(mysqli_error());
$row = mysqli_fetch_array($query);

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $student_code = $_POST['student_code'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $re_password = $_POST['re_password'];
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    if (empty($name)) {
        $error['name'] = "名前を記入してください。";
    }
    if (empty($password)) {
        $error['password'] = "パスワードを入力してください。";
    }
    if ($password != $re_password) {
        $error['re_password'] = "パスワードを合わせていません。";
    }
    if (empty($error)) {
        $sql = "UPDATE student SET name='$name',password = '$password_hash' WHERE id='$id'";
        $query = mysqli_query($conn, $sql);
        if (isset($query)) {
            $_SESSION['profile_update_success'] = "Cập nhật thông tin thành công";
            header('Location: http://localhost/democode');

        } else {
            echo "Cập nhật không thành công";
        }
        $conn->close();

    }


}
?>


<section>
    <div class="update-profile-user">
        <h2>ユーザーの情報変更</h2>
        <div class="content-update-profile-user">
            <form action="" method="POST">
                <div class="form-group">
                    <label>名前</label>
                    <input type="text" name="name" class="form-control" value="<?php echo $row['name'] ?>"
                           placeholder="名前を変更してください。">
                </div>
                <div class="error-validate">
                    <span><?php echo (isset($error['name'])) ? $error['name'] : '' ?></span>
                </div>

                <div class="form-group">
                    <label>学生番号</label>
                    <input type="text" name="student_code" class="form-control" id="student_code"
                           readonly="readonly" value="<?php echo $currentUser['student_code']; ?>">
                </div>
                <div class="form-group">
                    <label>メールアドレス</label>
                    <input type="email" name="email" class="form-control" id="email"
                           readonly="readonly" value="<?php echo $currentUser['email']; ?>">
                </div>

                <div class="form-group">
                    <label>性別</label>
                    <input type="text" name="gender" class="form-control" id="gender"
                           readonly="readonly" value="<?php echo $currentUser['gender']; ?>">
                </div>
                <div class="form-group">
                    <label>パスワード</label>
                    <input type="password" name="password" class="form-control" id="password"
                           placeholder="パスワードを入力してください。">
                </div>
                <div class="error-validate">
                    <span><?php echo (isset($error['password'])) ? $error['password'] : '' ?></span>
                </div>

                <div class="form-group">
                    <label>パスワードを一度確認してください。</label>
                    <input type="password" name="re_password" class="form-control" id="re_password"
                           placeholder="パスワードを一度入力してください。">
                </div>
                <div class="error-validate">
                    <span><?php echo (isset($error['re_password'])) ? $error['re_password'] : '' ?></span>
                </div>

                <button type="submit" name="submit" class="btn btn-primary">保存</button>
            </form>
        </div>
    </div>

</section>