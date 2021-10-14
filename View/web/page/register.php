<?php
require_once('Model/DBconnect.php');

$error = [];
//khởi tạo các giá trị để lưu về DB
if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $student_code = $_POST['student_code'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $re_password = $_POST['re_password'];

    if (empty($name)) {
        $error['name'] = "名前を入力してください。";
    }
    if (empty($student_code)) {
        $error['student_code'] = "学生番号を入力してください。";
    }
    if (empty($gender)) {
        $error['gender'] = "性別を入力してください。";
    }
    if (empty($email)) {
        $error['email'] = "メールアドレスを入力してください。";
    }
    if (empty($password)) {
        $error['password'] = "パスワードを入力してください。";
    }
    if ($password != $re_password) {
        $error['re_password'] = "パスワードを合わせていませんでした。";
    }
    if (empty($error)) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO student (name, gender,email,student_code,password)
VALUES ('$name', '$gender', '$email','$student_code','$password')";
        //check trùng giá trị mail
        $checkEmail = "SELECT * FROM student WHERE email = '$email'";
        $queryEmail = mysqli_query($conn, $checkEmail);
        $checkEmail = mysqli_num_rows($queryEmail);
        //check trùng giá trị mã số học sinh
        $checkStudentNumber = "SELECT * FROM student WHERE student_code = '$student_code'";
        $queryStudentNumber = mysqli_query($conn, $checkStudentNumber);
        $checkStudentNumber = mysqli_num_rows($queryStudentNumber);
        if ($checkEmail == 1) {
            $errorMail = "Mail đã tồn tại";
        } elseif ($checkStudentNumber == 1) {
            $errorStudent = "Mã học sinh đã tồn tại";
        } else {
            $query = mysqli_query($conn, $sql);
        }
    }
    //nếu tồn tại query thì thực thi lệnh chuyển hướng 
    if (isset($query)) {
        $_SESSION['register_success'] = "Đăng kí thành công";
        header('Location: http://localhost/democode/?view=login');
        exit;
    }
}
?>
<section>
    <div class="register-page">
        <div class="content-register-page">
            <p>登録</p>
            <form action="" method="POST">
                <input name="name" id="name" type="text" placeholder="名前">
                <div class="error-validate">
                    <span><?php echo (isset($error['name'])) ? $error['name'] : '' ?></span>
                </div>
                <div class="student-number-gender">
                    <input name="student_code" id="student_coder" type="text" placeholder="学生番号">
                    <select name="gender" id="gender">性別
                        <option value="男性">男性</option>

                        <option value="女性">女性</option>
                    </select>
                </div>
                <div class="error-validate">
                    <span><?php echo (isset($error['student_code'])) ? $error['student_code'] : '' ?></span>
                </div>
                <div class="error-validate">
                    <span><?php echo (isset($errorStudent)) ? $errorStudent : '' ?></span>
                </div>
                <div class="error-validate">
                    <span><?php echo (isset($error['checkstudent'])) ? $error['checkstudent'] : '' ?></span>
                </div>
                <div class="error-validate">
                    <span><?php echo (isset($error['gender'])) ? $error['gender'] : '' ?></span>
                </div>
                <input id="email" name="email" type="email" placeholder="メールアドレス">
                <div class="error-validate">
                    <span><?php echo (isset($error['email'])) ? $error['email'] : '' ?></span>
                </div>
                <div class="error-validate">
                    <span><?php echo (isset($errorMail)) ? $errorMail : '' ?></span>
                </div>
                <input id="password" type="password" name="password" placeholder="パスワード">
                <div class="error-validate">
                    <span><?php echo (isset($error['password'])) ? $error['password'] : '' ?></span>
                </div>
                <input id="re_password" type="password" name="re_password" placeholder="パスワード確認">
                <div class="error-validate">
                    <span><?php echo (isset($error['re_password'])) ? $error['re_password'] : '' ?></span>
                </div>
                <button type="submit">登録</button>
            </form>
            <div class="login-page-register">
                <p> ユーザーが有れば、ここに <a href="?view=login">ログイン</a>してください</p>
            </div>
        </div>
    </div>

</section>
