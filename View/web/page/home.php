<?php
require_once('Model/DBconnect.php');
$data = "SELECT *  FROM shiken INNER JOIN student ON student.student_code = shiken.student_code
INNER JOIN naitei ON naitei.student_code = shiken.student_code
INNER JOIN recruit ON recruit.student_code = shiken.student_code";
//phuong thuc khoi tao sesstion de tao phien lam viec tren browser//
if (!isset($_SESSION)) {
    session_start();
}
//chuc nang seacher lay name trong html dung toan tu 3 ngoi//
$key = (isset($_GET['keyword'])) ? $_GET['keyword'] : [];

//* session của login dùng toan tử 3 ngồi để xét giá trị nếu isset (kiểm tra sesion user (name trong html) thì chyaj session đó không thì in ra rỗng)
$student = (isset($_SESSION['student'])) ? $_SESSION['student'] : [];

//lay giá trị trên trinh duyệt để xét nếu có thì sẽ lấy giá trị trong DB để in ra//
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

//hàm check không rỗng
if (!empty($keyword)) {
    $search = "SELECT *  FROM shiken INNER JOIN student ON student.student_code = shiken.student_code
        INNER JOIN naitei ON naitei.student_code = shiken.student_code
        INNER JOIN recruit ON recruit.student_code = shiken.student_code 
       WHERE `company_name` like '%" . $key . "%'";
//kết nối với DB nếu có thí sẽ lấy DB và lưu
    $result = mysqli_query($conn, $search);
} else {
    $result = mysqli_query($conn, $data);
}
?>
<section>

    <div class="home">
        <?php if (isset($_SESSION['login_success'])) { ?>
            <div class="alert alert-primary" role="alert">
                Đăng nhập thành công!
            </div>
            <?php
            unset($_SESSION['login_success']);
        } ?>
        <?php if (isset($_SESSION['profile_update_success'])) { ?>
            <div class="alert alert-primary" role="alert">
                Chúc mừng bạn cập nhật thông tin thành công!
            </div>
            <?php
            unset($_SESSION['profile_update_success']);
        } ?>
        <?php if (isset($_SESSION['create_report_success'])) { ?>
            <div class="alert alert-primary" role="alert">
                Chúc mừng bạn tạo báo cáo thành công!
            </div>
            <?php
            unset($_SESSION['create_report_success']);
        } ?>
        <!-- <img src="../../../public/assets/web/image/background-home.png" width="100%" alt="background-home"> -->
        <div class="content-home">
            <h2>ようこそ就職支援システム</h2>

            <div class="list-item">
                <div class="container-fluid">
                    <div class="slider">

                        <?php foreach ($result as $key => $f) : ?>

                            <div class="item slider_item">

                                <div class="background-company">
                                    <div class="myDIV"><?php echo $f["company_name"] ?></div>
                                </div>

                                <div class="info">
                                    <p class="name"><span class="name_span"> 名前： </span><?php echo $f["name"] ?></p>
                                    <p class="description"><span
                                                class="name_span">内定日 : </span><?php echo $f["naiteibi"] ?></p>
                                    <p class="name-company"><span
                                                class="name_span"> 会社名 : </span><?php echo $f["company_name"] ?></p>
                                    <?php if (isset($_SESSION["student"])) { ?>
                                        <button type="button" class="detail infor_button" data-toggle="modal"
                                                data-target="#<?php echo $f["student_code"] ?>">
                                            詳しく
                                        </button>
                                    <?php } else { ?>
                                        <button type="button" onclick="login()" class="detail infor_button">
                                            詳しく
                                        </button>

                                    <?php } ?>

                                </div>
                            </div>


                        <?php endforeach; ?>
                    </div>

                    <?php foreach ($result as $key => $f) : ?>
                        <div class="modal fade" id="<?php echo $f["student_code"] ?>" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel" style="color:cornsilk">
                                            報告書の詳細</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                                    <div class="show-report">
                                                        <div class="show-report-student">
                                                            <p>
                                                                <span>提出日:&nbsp;</span> <?php echo $f["registration_date"] ?>
                                                            </p>

                                                            <p>
                                                                <span>性別:&nbsp;</span> <?php echo $f["gender"] ?>
                                                            </p>
                                                            <p>
                                                                <span>会社名:&nbsp;</span> <?php echo $f["company_name"] ?>
                                                            </p>
                                                            <p>
                                                                <span>会社の住所:&nbsp;</span> <?php echo $f["address"] ?>
                                                            </p>
                                                        </div>
                                                        <!-- <div class="show-report-student"> -->

                                                        <!-- </div> -->
                                                    </div>

                                                </div>
                                                <div class="col-xl-6 col-lg-6 col-md-6">
                                                    <div class="show-report_text">
                                                        <div class="show-report_name">
                                                            <p class="name-student"><?php echo $f["name"] ?> </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="show-report">
                                                        <table>
                                                            <tr>
                                                                <th width="20%">データベース</th>
                                                                <th width="80%">内容</th>
                                                            </tr>
                                                            <tr>
                                                                <th>内定</th>
                                                                <th>
                                                                    <div class="show-report">

                                                                        <p>
                                                                            <span>試験の結果:&nbsp;</span><?php echo $f["shiken_kekka"] ?>
                                                                        </p>
                                                                        <p>
                                                                            <span>内定:&nbsp;</span><?php echo $f["naitei"] ?>
                                                                        </p>
                                                                        <p>
                                                                            <span>内定日:&nbsp;</span><?php echo $f["naiteibi"] ?>
                                                                        </p>
                                                                        <p>
                                                                            <span>内定及び方法:&nbsp;</span><?php echo $f["method"] ?>
                                                                        </p>
                                                                        <p>
                                                                            <span>感想及び先輩へのアドバイス:&nbsp;</span><?php echo $f["advice"] ?>
                                                                        </p>
                                                                    </div>
                                                                </th>

                                                            </tr>

                                                        </table>
                                                    </div>

                                                    <div class="show-report">
                                                        <table>
                                                            <tr>
                                                                <th style="width: 20% ">応募情報</th>
                                                                <th style="width: 80%">
                                                                    <div class="show-report">

                                                                        <p>
                                                                            <span>応募方法:&nbsp;</span><?php echo $f["recruitment_method"] ?>
                                                                        </p>
                                                                        <p>
                                                                            <span>訪問内容:&nbsp;</span><?php echo $f["interview_content"] ?>
                                                                        </p>
                                                                        <p>
                                                                            <span>職種： &nbsp;</span><?php echo $f["career_field"] ?>
                                                                        </p>
                                                                    </div>
                                                                </th>

                                                            </tr>

                                                        </table>
                                                    </div>

                                                    <div class="show-report">
                                                        <table>
                                                            <tr>
                                                                <th style="width: 20%">試験の内容</th>
                                                                <th style="width: 80%">
                                                                    <div class="show-report">

                                                                        <div class="show-report-shiken">
                                                                            <div class="skiken-left">
                                                                                <p>
                                                                                    <span>試験日:&nbsp;</span><?php echo $f["date_time_interview"] ?>
                                                                                </p>
                                                                                <p>
                                                                                    <span>時間:&nbsp;</span><?php echo $f["jikan"] ?>
                                                                                </p>
                                                                                <p>
                                                                                    <span>会場: &nbsp;</span><?php echo $f["kaiyou"] ?>
                                                                                </p>
                                                                                <p>
                                                                                    <span>行動概要: &nbsp;</span><?php echo $f["action"] ?>
                                                                                </p>
                                                                                <p>
                                                                                    <span>一般常識: &nbsp;</span><?php echo $f["general_job"] ?>
                                                                                </p>
                                                                                <p>
                                                                                    <span>時間: &nbsp;</span><?php echo $f["jikan_general_job"] ?>
                                                                                </p>
                                                                                <p>
                                                                                    <span>論文: &nbsp;</span><?php echo $f["ronbun"] ?>
                                                                                </p>
                                                                                <p>
                                                                                    <span>時間: &nbsp;</span><?php echo $f["jikan_ronbun"] ?>
                                                                                </p>
                                                                                <p>
                                                                                    <span>専門: &nbsp;</span><?php echo $f["senmon"] ?>
                                                                                </p>
                                                                                <p>
                                                                                    <span>時間: &nbsp;</span><?php echo $f["jikan_senmon"] ?>
                                                                                </p>

                                                                            </div>
                                                                            <div class="skiken-right">
                                                                                <p>
                                                                                    <span>語学: &nbsp;</span><?php echo $f["gengo"] ?>
                                                                                </p>
                                                                                <p>
                                                                                    <span>時間: &nbsp;</span><?php echo $f["jikan_gengo"] ?>
                                                                                </p>
                                                                                <p>
                                                                                    <span>適正: &nbsp;</span><?php echo $f["tekisei"] ?>
                                                                                </p>
                                                                                <p>
                                                                                    <span>時間: &nbsp;</span><?php echo $f["jikan_tekisei"] ?>
                                                                                </p>
                                                                                <p>
                                                                                    <span>一次面接: &nbsp;</span><?php echo $f["ichimensetsu"] ?>
                                                                                </p>
                                                                                <p>
                                                                                    <span>時間 : &nbsp;</span><?php echo $f["jikan_ichimensetsu"] ?>
                                                                                </p>
                                                                                <p>
                                                                                    <span>形式: &nbsp;</span><?php echo $f["keishiki_ichimensetsu"] ?>
                                                                                </p>
                                                                                <p>
                                                                                    <span>二次面接: &nbsp;</span><?php echo $f["nijimensetsu"] ?>
                                                                                </p>
                                                                                <p>
                                                                                    <span>時間 : &nbsp;</span><?php echo $f["jikan_nijikanmensetsu"] ?>
                                                                                </p>
                                                                                <p>
                                                                                    <span>形式: &nbsp;</span><?php echo $f["keishiki_ni"] ?>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </th>

                                                            </tr>

                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <?php
                                        $student_code = $f["student_code"];
                                        $student_user_code = isset($student['student_code']) ? $student['student_code'] : '';
                                        ?>
                                        <?php
                                        if ($student_code === $student_user_code) { ?>
                                            <a class="btn btn-primary"
                                               href="?view=edit_form&student_code=<?php echo $f['student_code'] ?>">編集</a>
                                            <a class="btn btn-danger" onclick="return confirm('削除したいですか？')"
                                               href="?view=delete-share-experience&student_code=<?php echo $f['student_code'] ?>">削除</a>
                                        <?php } ?>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる
                                        </button>


                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>


                </div>
            </div>
        </div>


</section>