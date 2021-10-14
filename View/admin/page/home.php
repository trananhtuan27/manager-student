<!-- Content Wrapper. Contains page content -->
<?php
require_once('../../Model/DBconnect.php');
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">テーブル</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">ホーム</a></li>
                        <li class="breadcrumb-item active">テーブル</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">

                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <?php $sql  =  "SELECT COUNT(*) AS student_code FROM student";
                        $query = mysqli_query($conn, $sql);
                        $data = mysqli_fetch_array($query);
                        $countStudent = $data["student_code"];
                        ?>
                        <div class="inner">
                            <h3><?php echo $countStudent  ?><sup style="font-size: 20px"></sup></h3>

                            <p>報告書</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="?view=share-experience" class="small-box-footer">詳しく <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                    <?php $sql  =  "SELECT COUNT(*) AS id FROM student";
                        $query = mysqli_query($conn, $sql);
                        $data = mysqli_fetch_array($query);
                        $countUser = $data["id"];
                        ?>
                        <div class="inner">
                            <h3><?php echo $countUser ?></h3>

                            <p>利用者</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="?view=user" class="small-box-footer">詳しく<i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->

                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->

            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
