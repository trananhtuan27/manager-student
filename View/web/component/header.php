<?php
require_once('Model/DBconnect.php');
ob_start();
if (!isset($_SESSION)) {
    session_start();
}
$student = (isset($_SESSION['student'])) ? $_SESSION['student'] : [];
$studentId = (isset($_SESSION['student'])) ? $student['id'] : [];

if (isset($_SESSION['student'])){
    $nameStudent = "SELECT `name` FROM `student` WHERE id = $studentId";
    $query = mysqli_query($conn, $nameStudent);
    $data = mysqli_fetch_assoc($query);
}

?>
<section>
    <div class="header-pc">
        <div class="header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                        <div class="logo">
                            <a href="http://localhost/democode/">
                                <img src="./public/assets/web/image/icon-book.png" alt="icon_book">
                            </a>
                            <p>就職支援</p>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-xs-12">
                        <form action="index.php" method="GET">
                            <div class="search">
                                <i class="fas fa-search"></i>
                                <input type="text" name="keyword"
                                       value="<?php (isset($_GET['keyword'])) ? $_GET['keyword'] : '' ?>"
                                       placeholder="会社名">
                                <div class="btn_search">
                                    <button type="submit" class="btn btn-info" action="">検索</button>
                                </div>

                            </div>

                        </form>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                        <?php if (isset($student['name'])) { ?>
                            <div class="profile-createform">
                                <div class="create-form">
                                    <a href="?view=create_form">報告書新登録</a>
                                </div>
                                <div class="dropdown">
                              <p class="dropbtn">
                                    <?php echo $data['name'] ?></p>

                                    <div class="dropdown-content">
                                        <a href="?view=profile_user">情報変更</a>
                                        <a href="?view=logout">ログアウト</a>
                                    </div>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="register-login">
                                <div class="login">
                                    <a href="?view=login">ログイン</a>
                                </div>
                                <div class="register">
                                    <a href="?view=register">新登録</a>
                                </div>
                            </div>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>


</section>