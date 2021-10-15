<?php
require_once('../../Model/DBconnect.php');
if (!isset($_SESSION)) {
    session_start();
}

$error = [];
$admin = (isset($_SESSION['user-admin'])) ? $_SESSION['user-admin'] : [];

$id = $admin['id'];
$sql = "SELECT * FROM student where id='$id'";
$query = mysqli_query($conn, $sql);
$student = mysqli_fetch_array($query);

if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $company_name = $_POST['company_name'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $re_password = $_POST['re_password'];
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    if (empty($name)) {
        $error['name'] = "名前を入力してください。";
    }
    if (empty($email)) {
        $error['email'] = "Thiếu email";
    }
    if (empty($gender)) {
        $error['gender'] = "Sai giới tính";
    }
    if (empty($company_name)) {
        $error['company_name'] = "Thiếu công ty";
    }
    if (empty($address)) {
        $error['address'] = "Thiếu địa chỉ";
    }
    if (empty($password)) {
        $error['password'] = "パスワードを入力してください。";
    }
    if ($password != $re_password) {
        $error['re_password'] = "パスワードを合わせていませんでした。";
    }
    if (empty($error)) {
        $sql = "UPDATE student SET name='$name' , password = '$password_hash', email = '$email', company_name = '$company_name' ,address = '$address' WHERE id='$id'";
        $query = mysqli_query($conn, $sql);
        if (isset($query)) {
            $_SESSION['edit-profile-success'] = "Sửa Học sinh thành công";
            header('Location: http://localhost/democode/view/admin/index.php');
        } else {
            echo "Cập nhật k thành công";
        }
        $conn->close();
    }
}

?>

<!-- Content Header (Page header) -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">ホーム</a></li>
                        <li class="breadcrumb-item active">編集</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">編集</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">名前</label>
                                    <input type="text" class="form-control" name="name"
                                           value="<?php echo $student['name']; ?>">
                                </div>
                                <div class="error-validate">
                                    <span><?php echo (isset($error['name'])) ? $error['name'] : '' ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">メールアドレス</label>
                                    <input type="email" class="form-control" name="email"
                                           value="<?php echo $student['email']; ?>">
                                </div>
                                <div class="error-validate">
                                    <span><?php echo (isset($error['email'])) ? $error['email'] : '' ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">性別</label>
                                    <select class="form-control" name="gender">
                                        <option>男性</option>
                                        <option>女性</option>
                                    </select>
                                </div>
                                <div class="error-validate">
                                    <span><?php echo (isset($error['gender'])) ? $error['gender'] : '' ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Công ty</label>
                                    <input type="text" class="form-control" name="company_name"    value="<?php echo $student['company_name']; ?>">
                                </div>
                                <div class="error-validate">
                                    <span><?php echo (isset($error['company_name'])) ? $error['company_name'] : '' ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Địa chỉ</label>
                                    <input type="text" class="form-control" name="address"    value="<?php echo $student['address']; ?>">
                                </div>
                                <div class="error-validate">
                                    <span><?php echo (isset($error['address'])) ? $error['address'] : '' ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">パスワード</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                                <div class="error-validate">
                                    <span><?php echo (isset($error['password'])) ? $error['password'] : '' ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">パスワードを再入力</label>
                                    <input type="password" class="form-control" name="re_password">
                                </div>
                                <div class="error-validate">
                                    <span><?php echo (isset($error['re_password'])) ? $error['re_password'] : '' ?></span>
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Sửa thông tin</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->


                </div>
                <!--/.col (left) -->

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
</div>
<style>
    .error-validate span {
        color: red;
    }
</style>
<!-- /.content -->
