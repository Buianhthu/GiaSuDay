<?php
  session_start();
  $time = $_SERVER['REQUEST_TIME'];
  $timeout_duration = 900;
  if ( isset($_SESSION['LAST_ACTIVITY']) && ($time - $_SESSION['LAST_ACTIVITY']) > $timeout_duration ) {
    session_unset();
    session_destroy();
    session_start();
  }
  $_SESSION['LAST_ACTIVITY'] = $time;
  if(!isset($_SESSION['username']) || !isset($_SESSION['password']) || !isset($_SESSION['level']) || !isset($_SESSION['avatar']) || $_SESSION['level'] != 1){
    header("location:../index.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Chi tiết gia sư</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <script type="text/javascript">
        function duyetdkgs(temp) {
            var SDT_GS = temp.getAttribute("data-id");
            var xhttp;
            xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("notification").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "controllers/duyetdkgs.php?id=" + SDT_GS, true);
            xhttp.send();
        }

        function huyduyetdkgs(temp) {
            var SDT_GS = temp.getAttribute("data-id");
            var xhttp;
            xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("notification").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "controllers/huyduyetdkgs.php?id=" + SDT_GS, true);
            xhttp.send();
        }
    </script>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Admin</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="duyettim_gs.php">Bài đăng tìm gia sư</a>
                        <a class="collapse-item" href="index.php">Danh sách gia sư</a>
                        <a class="collapse-item" href="duyetreview_gs.php">Đánh giá gia sư</a>
                    </div>
                </div>
            </li>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin duyet tim kiem gia su-->
                <div id="main">
                    <div class="container">
                        <div id="notification"></div>
                        <h2>Thông tin chi tiết gia sư</h2>
                        <?php
                        require_once("controllers/data_access_helper.php");
                        $db = new DataAccessHelper();
                        $db->connect();
                        $SDT_GS = $_GET['id'];
                        $sql = "select * from giasu where SDT_GS = '$SDT_GS'";
                        $result = $db->executeQuery($sql);
                        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                            echo '<ul class = "list-group list-group-flush mt-4">';
                            echo '<li class = "list-group-item"><strong>Số Điện Thoại: </strong>' . $row['SDT_GS'] . '</li>';
                            echo '<li class = "list-group-item"><strong>Họ Tên: </strong>' . $row['HoTen'] . '</li>';
                            echo '<li class = "list-group-item"><strong>Ngày Sinh: </strong>' . $row['NgaySinh'] . '</li>';
                            echo '<li class = "list-group-item"><strong>Giới Tính: </strong>' . $row['GioiTinh'] . '</li>';
                            echo '<li class = "list-group-item"><strong>Chứng Minh Nhân Dân: </strong>' . $row['CMND'] . '</li>';
                            echo '<li class = "list-group-item"><strong>Lĩnh Vực: </strong>' . $row['LinhVuc'] . '</li>';
                            echo '<li class = "list-group-item"><strong>Chuyên Ngành: </strong>' . $row['ChuyenNganh'] . '</li>';
                            echo '<li class = "list-group-item"><strong>Học Vị: </strong>' . $row['HocVi'] . '</li>';
                            echo '<li class = "list-group-item"><strong>Nơi Làm Việc: </strong>' . $row['NoiLamViec'] . '</li>';
                            echo '<li class = "list-group-item"><strong>Mô Tả: </strong>' . $row['MoTa'] . '</li>';
                            //echo'<li class = "list-group-item"><strong>kiểm duyệt</strong>'.$row['KIEMDUYET'].'</li>'; 
                            if ($row['KiemDuyet'] == '1') {

                                echo '<li class = "list-group-item"><strong>Kiểm Duyệt: </strong>đã kiểm duyệt</li>';
                                echo '<button class="icon mt-5" data-id="' . $row['SDT_GS'] . '" onclick="huyduyetdkgs(this)">Hủy kiểm duyệt</button>';
                            } else {
                                echo '<li class = "list-group-item"><strong>Kiểm Duyệt: </strong>chưa kiểm duyệt</li>';
                                echo '<button class="icon mt-5" data-id="' . $row['SDT_GS'] . '" onclick="duyetdkgs(this)">kiểm duyệt</button>';
                            }
                            echo '</ul>';
                        }
                        ?>

                    </div>
                </div>

                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">

                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>