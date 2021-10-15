<?php
ob_start();
require_once('../../Model/DBconnect.php');
if (!isset($_SESSION)) {
    session_start();
}
$admin = (isset($_SESSION['user-admin'])) ? $_SESSION['user-admin'] : [];
$adminId = (isset($_SESSION['user-admin'])) ? $admin['id'] : [];
if (isset($_SESSION['user-admin'])){
    $nameAdmin = "SELECT `name` FROM `student` WHERE id = $adminId";
    $query = mysqli_query($conn, $nameAdmin);
    $data = mysqli_fetch_assoc($query);

}
?>
<section>
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="http://localhost/democode/view/admin/index.php" class="nav-link">ホームページ</a>
            </li>
         
        </ul>

        <!-- Right navbar links -->

       <ul class="navbar-nav ml-auto">
           <li class="nav-item dropdown">
               <a class="nav-link" data-toggle="dropdown" href="#">

                   <?php echo $data['name'] ?>
               </a>
               <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                   <div class="dropdown-divider"></div>
                   <a href="?view=profile-admin" class="dropdown-item">
                    Sửa  Trang cá nhân
                   </a>
                   <div class="dropdown-divider"></div>
                   <a href="?view=logout" class="dropdown-item">
                       Logout
                   </a>


               </div>
           </li>
       </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4 navr_aside">
        <!-- Brand Logo -->
        <a href="http://localhost/democode/view/admin/index.php" class="brand-link">
            <!-- <img src="../../public/assets/web/image/icon_world.jpg" alt="AdminLTE Logo"
                 class="brand-image img-circle elevation-3"
                 style="opacity: .8"> -->
            <span class="navr_title">報告書2021</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">

                <div class="info">
                    <a href="#" class="d-block"><?php echo $data['name'] ?></a>
                </div>
            </div>


            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item menu-open">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                一般情報
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php 
                            
                            ?>
                            <li class="nav-item" id="change-background">
                                <a onclick="ChangeBackGround()" href="?view=student" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>ユーザー管理</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="?view=share-experience" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>報告書管理</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
    <style>
        .active-background {
            background: red;
        }
    </style>
    <script>
        function ChangeBackGround(){
            document.getElementById('change-background').setAttribute("class","active-background");
        }
    </script>
</section>