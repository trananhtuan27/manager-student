<?php
require_once('Model/DBconnect.php');
if (!isset($_SESSION)) {
    session_start();
}

$error = [];

if (isset($_SESSION['student'])) {
    $student = (isset($_SESSION['student'])) ? $_SESSION['student'] : [];
} else {
    header("Location: http://localhost/democode/?view=login"); /* Redirect browser */
}
$studentId = $student['id'];

if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $student_code = $_POST['student_code'];
    $registration_date = $_POST['registration_date'];
    $gender = $_POST['gender'];
    $company_name = $_POST['company_name'];
    $address = $_POST['address'];

    if (empty($name)) {
        $error['name'] = "名前を入力してください。";
    }
    if (empty($registration_date)) {
        $error['registration_date'] = "こちらに入力してください。";
    }
    if (empty($student_code)) {
        $error['student_code'] = "こちらに入力してください。";
    }
    if (empty($gender)) {
        $error['gender'] = "こちらに入力してください。";
    }
    if (empty($company_name)) {
        $error['company_name'] = "こちらに入力してください。";
    }
    if (empty($address)) {
        $error['address'] = "こちらに入力してください。";
    }

    //recruit
    $recruitment_method = $_POST['recruitment_method'];
    $interview_content = $_POST['interview_content'];
    $career_field = $_POST['career_field'];


    //naitei
    $shiken_kekka = isset($_POST['shiken_kekka']) ? $_POST['shiken_kekka'] : '';

    // $shiken_kekka = $_POST['shiken_kekka'];
    // $naitei = $_POST['naitei'];

    $naitei = isset($_POST['naitei']) ? $_POST['naitei'] : '';

    $naiteibi = $_POST['naiteibi'];

    // $method = $_POST['method'];

    $method = isset($_POST['method']) ? $_POST['method'] : '';

    $advice = $_POST['advice'];

    if (empty($shiken_kekka)) {
        $error['shiken_kekka'] = "こちらに入力してください。";
    }
    if (empty($naitei)) {
        $error['naitei'] = "こちらに入力してください。";
    }
    if (empty($naiteibi)) {
        $error['naiteibi'] = "こちらに入力してください。";
    }
    if (empty($method)) {
        $error['method'] = "こちらに入力してください。";
    }
    if (empty($advice)) {
        $error['advice'] = "こちらに入力してください。";
    }

    //    shiken
    $date_time_interview = $_POST['date_time_interview'];
    $jikan = $_POST['jikan'];
    $kaiyou = $_POST['kaiyou'];
    $action = $_POST['action'];
    $general_job = $_POST['general_job'];
    $jikan_general_job = $_POST['jikan_general_job'];
    $ronbun = $_POST['ronbun'];
    $jikan_ronbun = $_POST['jikan_ronbun'];
    $senmon = $_POST['senmon'];
    $jikan_senmon = $_POST['jikan_senmon'];
    $gengo = $_POST['gengo'];
    $jikan_gengo = $_POST['jikan_gengo'];
    $tekisei = $_POST['tekisei'];
    $jikan_tekisei = $_POST['jikan_tekisei'];
    $ichimensetsu = $_POST['ichimensetsu'];
    $jikan_ichimensetsu = $_POST['jikan_ichimensetsu'];
    $keishiki_ichimensetsu = isset($_POST['keishiki_ichimensetsu']) ? $_POST['keishiki_ichimensetsu'] : '';

    $nijimensetsu = $_POST['nijimensetsu'];
    $jikan_nijikanmensetsu = $_POST['jikan_nijikanmensetsu'];
    $keishiki_ni = isset($_POST['keishiki_ni']) ? $_POST['keishiki_ni'] : '';


    if (empty($date_time_interview)) {
        $error['date_time_interview'] = "こちらに入力してください。";
    }
    if (empty($jikan)) {
        $error['jikan'] = "こちらに入力してください。";
    }
    if (empty($kaiyou)) {
        $error['kaiyou'] = "こちらに入力してください。";
    }
    if (empty($action)) {
        $error['action'] = "こちらに入力してください。";
    }
    if (empty($general_job)) {
        $error['general_job'] = "こちらに入力してください。";
    }
    if (empty($jikan_general_job)) {
        $error['jikan_general_job'] = "こちらに入力してください。";
    }

    if (empty($ronbun)) {
        $error['ronbun'] = "こちらに入力してください。";
    }

    if (empty($jikan_ronbun)) {
        $error['jikan_ronbun'] = "こちらに入力してください。";
    }


    if (empty($senmon)) {
        $error['senmon'] = "こちらに入力してください。";
    }

    if (empty($jikan_senmon)) {
        $error['jikan_senmon'] = "こちらに入力してください。";
    }

    if (empty($gengo)) {
        $error['gengo'] = "こちらに入力してください。";
    }
    if (empty($jikan_gengo)) {
        $error['jikan_gengo'] = "こちらに入力してください。";
    }
    if (empty($tekisei)) {
        $error['tekisei'] = "こちらに入力してください。";
    }
    if (empty($jikan_tekisei)) {
        $error['jikan_tekisei'] = "こちらに入力してください。";
    }
    if (empty($ichimensetsu)) {
        $error['ichimensetsu'] = "こちらに入力してください。";
    }
    if (empty($jikan_ichimensetsu)) {
        $error['jikan_ichimensetsu'] = "こちらに入力してください。";
    }
    if (empty($keishiki_ichimensetsu)) {
        $error['keishiki_ichimensetsu'] = "こちらに入力してください。";
    }
    if (empty($nijimensetsu)) {
        $error['nijimensetsu'] = "こちらに入力してください。";
    }
    if (empty($jikan_nijikanmensetsu)) {
        $error['jikan_nijikanmensetsu'] = "こちらに入力してください。";
    }
    if (empty($keishiki_ni)) {
        $error['keishiki_ni'] = "こちらに入力してください。";
    }

    if (empty($error)) {

        $sql = "UPDATE student SET `student_code`='$student_code', `registration_date`='$registration_date' ,`company_name`='$company_name',`address`='$address' WHERE id='$studentId';
        INSERT INTO naitei (student_code,shiken_kekka,naitei,naiteibi,method,advice)
        VALUES ('$student_code','$shiken_kekka','$naitei','$naiteibi','$method','$advice');
        INSERT INTO recruit (student_code,recruitment_method,interview_content,career_field)
        VALUES ('$student_code','$recruitment_method','$interview_content','$career_field');
        INSERT INTO shiken (student_code,date_time_interview,jikan,kaiyou,action,general_job,jikan_general_job,ronbun,jikan_ronbun,senmon,jikan_senmon,gengo,jikan_gengo,tekisei,jikan_tekisei,ichimensetsu,jikan_ichimensetsu,keishiki_ichimensetsu,nijimensetsu,jikan_nijikanmensetsu,keishiki_ni)  
        VALUES ('$student_code','$date_time_interview','$jikan','$kaiyou','$action','$general_job','$jikan_general_job','$ronbun',
            '$jikan_ronbun','$senmon','$jikan_senmon','$gengo','$jikan_gengo','$tekisei','$jikan_tekisei',
            '$ichimensetsu','$jikan_ichimensetsu','$keishiki_ichimensetsu','$nijimensetsu','$jikan_nijikanmensetsu','$keishiki_ni');";
        $query = $conn->multi_query($sql) or trigger_error("Query Failed! SQL: $sql - Error: " . mysqli_error($conn), E_USER_ERROR);
        $_SESSION['create_report_success'] = "Tạo Báo cáo thành công";
        header('Location: http://localhost/democode/');
    } else {
        $query = isset($array['query']) ? $array['query'] : '';
    }

}
?>


<section>
    <div class="create-form-student">
        <h2>報告書</h2>
        <form action="" id="form" method="POST">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                        <div class="form-left">
                            <input type="text" hidden name="student_code"
                                   value="<?php echo $student['student_code'] ?>">
                            <div class="form-left-firt">
                                <label class="input-registration_date">
                                    <p>提出日</p>
                                    <input name="registration_date" type="date"
                                           value=" <?php echo $student['registration_date'] ?>">
                                </label>
                                <div class="error-validate">
                                    <span><?php echo (isset($error['registration_date'])) ? $error['registration_date'] : '' ?></span>
                                </div>
                                <div class="code-name-gender-student">
                                    <label class="code-student-code">
                                        <p class="code-student">学生番号</p>
                                        <input name="student_code" type="text"
                                               value="<?php echo $student['student_code'] ?>">
                                    </label>

                                    <label class="full-name-label">
                                        <p class="full-name"> 名前</p>
                                        <input name="name" type="text" id="name" value="<?php echo $student['name'] ?>">
                                    </label>

                                    <label class="gender-label">
                                        <span class="gender">性別</span>
                                        <select name="gender">
                                            <option value="男性">男性</option>
                                            <option value="女性">女性</option>
                                        </select>

                                    </label>
                                </div>
                                <div class="error-validate">
                                    <span><?php echo (isset($error['student_code'])) ? $error['student_code'] : '' ?></span>
                                </div>
                                <div class="error-validate">
                                    <span><?php echo (isset($error['name'])) ? $error['name'] : '' ?></span>
                                </div>
                                <label>
                                    <p>会社名</p>
                                    <input type="text" name="company_name" id="company_name">
                                </label>
                                <div class="error-validate">
                                    <span><?php echo (isset($error['company_name'])) ? $error['company_name'] : '' ?></span>
                                </div>
                                <label>
                                    <p>会場</p>
                                    <textarea name="address"></textarea>
                                </label>
                                <div class="error-validate">
                                    <span><?php echo (isset($error['address'])) ? $error['address'] : '' ?></span>
                                </div>

                            </div>
                            <div class="form-left-end">
                                <h2>内定の情報</h2>
                                <div class="slect-chapter-firt">
                                    <label>
                                        <p class="slect-chapter-firt_item">応募方法</p>
                                        <select name="recruitment_method">
                                            <option value="学科紹介">学科紹介</option>
                                            <option value="就職課紹介">就職課紹介</option>
                                            <option value="自由応募">自由応募</option>
                                            <option value="縁故">縁故</option>
                                            <option value="その他">その他</option>

                                        </select>
                                    </label>

                                    <label>
                                        <p>訪問内容</p>
                                        <select name="interview_content">
                                            <option value="セミナー">セミナー</option>
                                            <option value="OB訪問">OB訪問</option>
                                            <option value="工場見学">工場見学</option>
                                            <option value="会社訪問">会社訪問</option>
                                            <option value="試験">試験</option>
                                            <option value="面接">面接</option>
                                            <option value="内定研修">内定研修</option>
                                            <option value="その他">その他</option>
                                        </select>
                                    </label>

                                    <label>
                                        <p>職種</p>
                                        <select name="career_field">
                                            <option value="建設技術">建設技術</option>
                                            <option value="電気技術">電気技術</option>
                                            <option value="機械技術">機械技術</option>
                                            <option value="製造技術">製造技術</option>
                                            <option value="設計">設計</option>
                                            <option value="デザイン">デザイン</option>
                                            <option value="情纂・測量">情纂・測量</option>
                                            <option value="現場指導">現場指導</option>
                                            <option value="研究開発">研究開発</option>
                                            <option value="品質管理">品質管理</option>
                                            <option value="生産管理">生産管理</option>
                                            <option value="検査">検査</option>
                                            <option value="サービスエンジニア">サービスエンジニア</option>
                                            <option value="システムエンジニア">システムエンジニア</option>
                                            <option value="プログラマー">プログラマー</option>
                                            <option value="企画・調査">企画・調査</option>
                                            <option value="セールスエンジニア">セールスエンジニア</option>
                                            <option value="福集・取材">福集・取材</option>
                                            <option value="営業・販売">営業・販売</option>
                                            <option value="プロパー">プロパー</option>
                                            <option value="サービス">サービス</option>
                                            <option value="事務">事務</option>
                                            <option value="教員">教員</option>
                                            <option value="公務員">公務員</option>
                                            <option value="その他">その他</option>
                                        </select>
                                    </label>

                                </div>
                                <label class="slect-chapter_label">
                                    <p>試験の結果</p>

                                    <input type="radio" id="naitei" name="shiken_kekka" value="内定">
                                    <p class="slect-chapter_label_item" for="内定">内定</p>

                                    <input type="radio" id="truot" name="shiken_kekka" value="不採用">
                                    <label for="不採用">不採用</label>

                                    <input type="radio" id="doi_ket_qua" name="shiken_kekka" value="結果待ち">
                                    <label for="結果待ち">結果待ち</label>
                                </label>
                                <div class="error-validate">
                                    <span><?php echo (isset($error['shiken_kekka'])) ? $error['shiken_kekka'] : '' ?></span>
                                </div>
                                <label>
                                    <p>就職が内定した</p>
                                    <input type="radio" id="di_lam" name="naitei" value="入社する">
                                    <label for="入社する">入社する</label>

                                    <input type="radio" id="khong_di_lam" name="naitei" value="入社しない">
                                    <label for="入社しない">入社しない</label>
                                </label>
                                <div class="error-validate">
                                    <span><?php echo (isset($error['naitei'])) ? $error['naitei'] : '' ?></span>
                                </div>
                                <label>
                                    <p>内定日および方法</p>
                                    <input name="naiteibi" type="date">
                                    <!--                                    <span>Phương pháp nhận quyết định</span>-->


                                    <input type="radio" id="thu_moi" name="method" value="文書">
                                    <label for="文書">文書</label>

                                    <input type="radio" id="truyen_mieng" name="method" value="口答">
                                    <label for="口答">口答</label>

                                    <input type="radio" id="dien_thoai" name="method" value="電話連絡">
                                    <label for="電話連絡">電話連絡</label>

                                </label>
                                <div class="error-validate">
                                    <span><?php echo (isset($error['method'])) ? $error['method'] : '' ?></span>
                                </div>
                                <label>アドバイス</label>
                                <textarea name="advice"></textarea>
                                <div class="error-validate">
                                    <span><?php echo (isset($error['advice'])) ? $error['advice'] : '' ?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                        <div class="form-rigt">
                            <div class="form-right-firt">
                                <p class="detail-interview">面接内容</p>
                                <label class="date-time-label">
                                    <p class="date">試験日</p>
                                    <input name="date_time_interview" type="date">
                                    <span class="together">時間</span>
                                    <div class="input-smail">
                                        <input type="text" name="jikan" placeholder="時間">
                                    </div>
                                </label>
                                <div class="error-validate">
                                    <span><?php echo (isset($error['date_time_interview'])) ? $error['date_time_interview'] : '' ?></span>
                                </div>
                                <div class="error-validate">
                                    <span><?php echo (isset($error['jikan'])) ? $error['jikan'] : '' ?></span>
                                </div>
                                <label class="address-hall">
                                    <p>会場</p>
                                    <input name="kaiyou" type="text">
                                </label>
                                <div class="error-validate">
                                    <span><?php echo (isset($error['kaiyou'])) ? $error['kaiyou'] : '' ?></span>
                                </div>
                                <label class="active-label">
                                    <p>行動概要</p>
                                    <textarea name="action"></textarea>
                                </label>
                                <div class="error-validate">
                                    <span><?php echo (isset($error['action'])) ? $error['action'] : '' ?></span>
                                </div>
                                <label>
                                    <p>一般常識</p>
                                    <input name="general_job" type="text">
                                    <div class="input-smail">
                                        <input type="text" name="jikan_general_job" placeholder="時間">
                                    </div>

                                </label>
                                <div class="error-validate">
                                    <span><?php echo (isset($error['jikan_general_job'])) ? $error['jikan_general_job'] : '' ?></span>
                                </div>
                                <label>
                                    <p>論文</p>
                                    <input name="ronbun" type="text">
                                    <div class="input-smail">
                                        <input type="text" name="jikan_ronbun" placeholder="時間">
                                    </div>

                                </label>
                                <div class="error-validate">
                                    <span><?php echo (isset($error['ronbun'])) ? $error['ronbun'] : '' ?></span>
                                </div>
                                <div class="error-validate">
                                    <span><?php echo (isset($error['jikan_ronbun'])) ? $error['jikan_ronbun'] : '' ?></span>
                                </div>
                                <label>
                                    <p>専門</p>
                                    <input name="senmon" type="text">
                                    <div class="input-smail">
                                        <input name="jikan_senmon" type="text" placeholder="時間">
                                    </div>
                                </label>
                                <div class="error-validate">
                                    <span><?php echo (isset($error['senmon'])) ? $error['senmon'] : '' ?></span>
                                </div>
                                <div class="error-validate">
                                    <span><?php echo (isset($error['jikan_senmon'])) ? $error['jikan_senmon'] : '' ?></span>
                                </div>
                                <label>
                                    <p>語学</p>
                                    <input name="gengo" type="text">
                                    <div class="input-smail">
                                        <input name="jikan_gengo" type="text" placeholder="時間">
                                    </div>
                                </label>
                                <div class="error-validate">
                                    <span><?php echo (isset($error['gengo'])) ? $error['gengo'] : '' ?></span>
                                </div>
                                <div class="error-validate">
                                    <span><?php echo (isset($error['jikan_gengo'])) ? $error['jikan_gengo'] : '' ?></span>
                                </div>
                                <label>
                                    <p>適正</p>
                                    <input name="tekisei" type="text">
                                    <div class="input-smail">
                                        <input name="jikan_tekisei" type="text" placeholder="時間">
                                    </div>
                                </label>
                                <div class="error-validate">
                                    <span><?php echo (isset($error['tekisei'])) ? $error['tekisei'] : '' ?></span>
                                </div>
                                <div class="error-validate">
                                    <span><?php echo (isset($error['jikan_tekisei'])) ? $error['jikan_tekisei'] : '' ?></span>
                                </div>

                            </div>
                            <div class="exam-forms">
                                <label class="exam-forms-label">
                                    <p>一次面接</p>
                                    <input name="ichimensetsu" type="data">
                                    <div class="input-smail">
                                        <input name="jikan_ichimensetsu" type="text" placeholder="時間">
                                    </div>
                                </label>
                                <div class="error-validate">
                                    <span><?php echo (isset($error['ichimensetsu'])) ? $error['ichimensetsu'] : '' ?></span>
                                </div>
                                <div class="error-validate">
                                    <span><?php echo (isset($error['jikan_ichimensetsu'])) ? $error['jikan_ichimensetsu'] : '' ?></span>
                                </div>
                                <label>
                                    <p>形式</p>
                                    <div class="display-radio">
                                        <input type="radio" id="persional" name="keishiki_ichimensetsu" value="個人">
                                        <label for="個人">個人</label>

                                        <input type="radio" id="group" name="keishiki_ichimensetsu" value="グループ">
                                        <label for="グループ">グループ</label>
                                    </div>

                                </label>
                                <div class="error-validate">
                                    <span><?php echo (isset($error['keishiki_ichimensetsu'])) ? $error['keishiki_ichimensetsu'] : '' ?></span>
                                </div>
                            </div>
                            <div class="exam-forms">
                                <label class="exam-forms-label">
                                    <p>二次面接</p>
                                    <input name="nijimensetsu" type="data">
                                    <div class="input-smail">
                                        <input name="jikan_nijikanmensetsu" type="text" placeholder="時間">
                                    </div>
                                </label>
                                <div class="error-validate">
                                    <span><?php echo (isset($error['nijimensetsu'])) ? $error['nijimensetsu'] : '' ?></span>
                                </div>
                                <div class="error-validate">
                                    <span><?php echo (isset($error['jikan_nijikanmensetsu'])) ? $error['jikan_nijikanmensetsu'] : '' ?></span>
                                </div>
                                <label>
                                    <p>形式</p>
                                    <div class="display-radio">
                                        <input type="radio" id="persional" name="keishiki_ni" value="個人">
                                        <label for="個人">個人</label>

                                        <input type="radio" id="theo_nhom" name="keishiki_ni" value="グループ">
                                        <label for="グループ">グループ</label>
                                    </div>
                                </label>
                                <div class="error-validate">
                                    <span><?php echo (isset($error['keishiki_ni'])) ? $error['keishiki_ni'] : '' ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="submit-form">
                    <button type="submit">登録</button>
                </div>
            </div>
        </form>
    </div>


</section>