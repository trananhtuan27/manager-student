<?php
require_once('../../Model/DBconnect.php');

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
                            <li class="breadcrumb-item active">ユーザーテーブル</li>
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
                                <h3 class="card-title">利用者情報</h3>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                                <p class="add-form-user"><a href="#">新利用者</a></p>
                                <table id="example2" class="table table-bordered table-hover table-responsive-xl">
                                    <thead>
                                    <tr class="users_table">
                                        <th>名前</th>
                                        <th>学生番号</th>
                                        <th>メールアドレス</th>
                                        <th>会社名</th>
                                        <th>性別</th>
                                        <th>機能</th>
                                    </tr>
                                    </thead>
                                    <tbody class="user_table_down">
                                    <?php
                                    $listUser = 'select * from student';
                                    $student = mysqli_query($conn, $listUser);
                                    ?>
                                    <?php foreach ($student as $key => $student ): ?>
                                        <tr>
                                            <td><?php echo $student['name']; ?></td>
                                            <td><?php echo $student['student_code']; ?></td>
                                            <td><?php echo $student['email']; ?></td>
                                            <td><?php echo $student['company_name'];?></td>
                                            <td><?php echo $student['gender']; ?></td>
                                            <td class="function-user">
                                                    <a class="btn-primary" style="border-radius: 5px; height: 50px;padding: 11px 15px;padding-top: 5px;"
                                                        href="index.php?view=edit-user&id=<?php echo $student['id'] ?>">編集</a>
                                                    <a class="btn btn-danger"
                                                   onclick="deleteUser('<?php echo $student['id'] ?>')">削除</a>
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
        .function-user a {
            padding: 5px 10px;
        }

        .add-form-user a {
            padding: 5px 10px;
            background: #00A000;
            color: #fff;
        }
    </style>
    <script type="text/javascript">
        function deleteUser(id) {
            option = confirm('削除したいですか？')
            if (!option) {
                return;
            }
            $.post('delete-user.php', {
                'id': id
            }, function (data) {
                alert(data)
                location.reload()
            })
        }
    </script>

</section>