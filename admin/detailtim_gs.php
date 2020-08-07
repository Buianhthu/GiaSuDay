<?php require_once('controllers/check_session.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Chi tiết bài đăng</title>
  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <script type="text/javascript">
    function duyettimgs(temp) {
      var ID = temp.getAttribute("data-id");
      var xhttp;
      xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var t = this.responseText;
          if(t == 1) location.reload();
          else alert('ERROR: Có lỗi trong quá trình xử lý !');
        }
      };
      xhttp.open("GET", "controllers/duyettimgs.php?id=" + ID, true);
      xhttp.send();
    }

    function huyduyettimgs(temp) {
      var ID = temp.getAttribute("data-id");
      var xhttp;
      xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var t = this.responseText;
          if(t == 1) location.reload();
          else alert('ERROR: Có lỗi trong quá trình xử lý !');
        }
      };
      xhttp.open("GET", "controllers/huyduyettimgs.php?id=" + ID, true);
      xhttp.send();
    }
  </script>
  <style type="text/css">
    button.btn {
      text-align: center !important;
    }
  </style>
</head>
<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-laugh-wink"></i></div>
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
            <a class="collapse-item" href="index.php">Danh sách gia sư</a>
            <a class="collapse-item" href="duyettim_gs.php">Danh sách bài đăng</a>
            <a class="collapse-item" href="duyetreview_gs.php">Danh sách review</a>
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
          <div class="container mb-5">
            <div id="notification"></div>
            <h2>Thông tin chi tiết bài viết tìm kiếm gia sư</h2>
            <?php
              require_once("controllers/data_access_helper.php");
              $db = new DataAccessHelper();
              $db->connect();
              $id = $_GET['id'];
              $sql = "SELECT * FROM baidang, thoigianhoc WHERE baidang.Id = thoigianhoc.Id AND baidang.Id = '$id'";
              $result = $db->executeQuery($sql);
              while ($row = $result->fetch_array()) 
              {
                echo '<ul class = "list-group list-group-flush mt-4">';
                echo '<li class = "list-group-item"><strong>ID: </strong>' . $row['Id'] . '</li>';
                echo '<li class = "list-group-item"><strong>Người đăng: </strong>' . $row['Username'] . '</li>';
                echo '<li class = "list-group-item"><strong>Môn Học: </strong>' . $row['MonHoc'] . '</li>';
                echo '<li class = "list-group-item"><strong>Nội Dung: </strong>' . $row['NoiDung'] . '</li>';
                echo '<li class = "list-group-item"><strong>Ngày Đăng: </strong>' . $row['NgayDang'] . '</li>';
                echo '<li class = "list-group-item"><strong>Học Phí: </strong>' . $row['HocPhi'] . '</li>';
                echo '<li class = "list-group-item" style="text-align:center"><strong>Thời gian học</strong>';
                  echo '<table class="table table-hover table-responsive mt-2" style="text-align:center;">
                        <thead class="thead-dark" style="width:auto">
                          <tr>
                            <th style="width:20%"></th>
                            <th style="width:12%">Thứ hai</th>
                            <th style="width:12%">Thứ ba</th>
                            <th style="width:12%">Thứ tư</th>
                            <th style="width:12%">Thứ năm</th>
                            <th style="width:12%">Thứ sáu</th>
                            <th style="width:12%">Thứ bảy</th>
                            <th style="width:12%">Chủ nhật</th>
                          </tr>
                        </thead>
                        <tbody id="content">';
                        echo '<tr>';
                        echo '<td>Sáng (8h - 11h)</td>';
                        if(strpos($row['ThuHai'], '1') !== false){
                          echo '<td><i class="far fa-check-circle"></i></td>';
                        }
                        else echo '<td></td>';
                        if(strpos($row['ThuBa'], '1') !== false){
                          echo '<td><i class="far fa-check-circle"></i></td>';
                        }
                        else echo '<td></td>';
                        if(strpos($row['ThuTu'], '1') !== false){
                          echo '<td><i class="far fa-check-circle"></i></td>';
                        }
                        else echo '<td></td>';
                        if(strpos($row['ThuNam'], '1') !== false){
                          echo '<td><i class="far fa-check-circle"></i></td>';
                        }
                        else echo '<td></td>';
                        if(strpos($row['ThuSau'], '1') !== false){
                          echo '<td><i class="far fa-check-circle"></i></td>';
                        }
                        else echo '<td></td>';
                        if(strpos($row['ThuBay'], '1') !== false){
                          echo '<td><i class="far fa-check-circle"></i></td>';
                        }
                        else echo '<td></td>';
                        if(strpos($row['ChuNhat'], '1') !== false){
                          echo '<td><i class="far fa-check-circle"></i></td>';
                        }
                        else echo '<td></td>';
                        echo '</tr>';

                        // Chiều
                        echo '<tr>';
                        echo '<td>Chiều (15h - 18h)</td>';
                        if(strpos($row['ThuHai'], '2') !== false){
                          echo '<td><i class="far fa-check-circle"></i></td>';
                        }
                        else echo '<td></td>';
                        if(strpos($row['ThuBa'], '2') !== false){
                          echo '<td><i class="far fa-check-circle"></i></td>';
                        }
                        else echo '<td></td>';
                        if(strpos($row['ThuTu'], '2') !== false){
                          echo '<td><i class="far fa-check-circle"></i></td>';
                        }
                        else echo '<td></td>';
                        if(strpos($row['ThuNam'], '2') !== false){
                          echo '<td><i class="far fa-check-circle"></i></td>';
                        }
                        else echo '<td></td>';
                        if(strpos($row['ThuSau'], '2') !== false){
                          echo '<td><i class="far fa-check-circle"></i></td>';
                        }
                        else echo '<td></td>';
                        if(strpos($row['ThuBay'], '2') !== false){
                          echo '<td><i class="far fa-check-circle"></i></td>';
                        }
                        else echo '<td></td>';
                        if(strpos($row['ChuNhat'], '2') !== false){
                          echo '<td><i class="far fa-check-circle"></i></td>';
                        }
                        else echo '<td></td>';
                        echo '</tr>';

                        // Tối
                        echo '<tr>';
                        echo '<td>Tối (18h - 21h)</td>';
                        if(strpos($row['ThuHai'], '3') !== false){
                          echo '<td><i class="far fa-check-circle"></i></td>';
                        }
                        else echo '<td></td>';
                        if(strpos($row['ThuBa'], '3') !== false){
                          echo '<td><i class="far fa-check-circle"></i></td>';
                        }
                        else echo '<td></td>';
                        if(strpos($row['ThuTu'], '3') !== false){
                          echo '<td><i class="far fa-check-circle"></i></td>';
                        }
                        else echo '<td></td>';
                        if(strpos($row['ThuNam'], '3') !== false){
                          echo '<td><i class="far fa-check-circle"></i></td>';
                        }
                        else echo '<td></td>';
                        if(strpos($row['ThuSau'], '3') !== false){
                          echo '<td><i class="far fa-check-circle"></i></td>';
                        }
                        else echo '<td></td>';
                        if(strpos($row['ThuBay'], '3') !== false){
                          echo '<td><i class="far fa-check-circle"></i></td>';
                        }
                        else echo '<td></td>';
                        if(strpos($row['ChuNhat'], '3') !== false){
                          echo '<td><i class="far fa-check-circle"></i></td>';
                        }
                        else echo '<td></td>';
                        echo '</tr>';
                  echo '</tbody></table>';

                if ($row['TinhTrang'] == -1)
                  echo '<li class = "list-group-item"><strong>Tình trạng: </strong>Chờ duyệt - Chờ đăng ký</li>';
                else if ($row['TinhTrang'] == 0)
                  echo '<li class = "list-group-item"><strong>Tình trạng: </strong>Chờ xác nhận</li>';
                else '<li class = "list-group-item"><strong>Tình trạng: </strong>Hoàn thành</li>';

                if ($row['KiemDuyet'] == 1) {
                  echo '<li class = "list-group-item"><strong>Kiểm Duyệt: </strong>Đã duyệt</li>';
                  echo '<button class="btn btn-danger mt-5" data-id="' . $row['Id'] . '" onclick="huyduyettimgs(this)">Hủy duyệt</button>';
                } 
                else {
                  echo '<li class = "list-group-item"><strong>Kiểm Duyệt: </strong>Chưa duyệt</li>';
                  echo '<button class="btn btn-primary mt-5" data-id="' . $row['Id'] . '" onclick="duyettimgs(this)">Duyệt</button>';
                }
                echo '</ul>';
              }
            ?>

          </div>
        </div>

        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
    </div>
    <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>

</body>
</html>