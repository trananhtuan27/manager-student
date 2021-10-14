<?php
require_once('../../Model/DBconnect.php');
require_once('../../Model/search_databese.php');
?>
<section>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>利用者</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">ホーム</a></li>
                            <li class="breadcrumb-item active">報告書</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">報告書</h3>
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-xs-12">
                                        <form action="index.php" method="GET">
                                            <div class="search">
                                                <i class="fas fa-search"></i>
                                                <input type="text" name="keyword" value="<?php (isset($_GET['keyword'])) ? $_GET['keyword'] : ''  ?>" placeholder="会社名">
                                                <div class="btn_search">
                                                    <button type="button" class="btn btn-info" action="">検索</button>
                                                </div>

                                            </div>

                                        </form>
                                    </div>
                                </div>

                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                                <p class="add-form-user"><a href="#">報告書</a></p>
                                <table id="example2" class="table table-bordered table-hover table-responsive-xl">
                                    <thead>
                                        <tr class="share_experience_table">
                                            <th>名前</th>
                                            <th>学生番号</th>
                                            <th>性別</th>
                                            <th>会社名</th>
                                            <th>試験日</th>
                                            <th>住所</th>
                                            <th>機能</th>
                                        </tr>
                                    </thead>
                                    <tbody class="share_experience_table_down">
                                        <?php
                                        //    $sql = "SELECT Donhang.DonhangID, Khachhang.Hoten, Donhang.Ngaydathang
                                        //     FROM Donhang
                                        //     INNER JOIN Khachhang ON Donhang.KhachhangID = Khachhang.KhachhangID";
                                        $listStudent = "SELECT *  FROM shiken INNER JOIN student ON student.student_code = shiken.student_code";
                                        $students = mysqli_query($conn, $listStudent);

                                        ?>
                                        <?php foreach ($students as $key => $students) : ?>
                                            <tr>
                                                <td><?php echo $students['name']; ?></td>
                                                <td><?php echo $students['student_code'] ?></td>
                                                <td><?php echo $students['gender']; ?></td>
                                                <td><?php echo $students['company_name']; ?></td>
                                                <td><?php echo $students['date_time_interview']; ?></td>
                                                <td><?php echo $students['address']; ?></td>
                                                <td class="function-student">
                                                    <a class="btn-primary" style="border-radius: 5px; height: 50px;padding: 11px 15px;padding-top: 5px;" href="index.php?view=update-share-experience&student_code=<?php echo $students['student_code'] ?>">編集</a>
                                                    <a href="#" class="btn btn-danger" onclick="deleteStudent('<?php echo $students['student_code'] ?>')">削除</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <style>
        .function-student a {
            padding: 5px 10px;
        }

        .add-form-user a {
            padding: 5px 10px;
            background: #00A000;
            color: #fff;
        }
    </style>
    <script type="text/javascript">
        function deleteStudent(student_code) {

            option = confirm('削除したいですか？')
            if (!option) {
                return;
            }

            $.post('delete-student.php', {
                'student_code': student_code
            }, function(data) {
                alert(data)
                location.reload()
            })
        }
    </script>

</section>