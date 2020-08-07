<?php
  session_start();
  $time = $_SERVER['REQUEST_TIME'];
  $timeout_duration = 100;
  if ( isset($_SESSION['LAST_ACTIVITY']) && ($time - $_SESSION['LAST_ACTIVITY']) > $timeout_duration ) {
    session_unset();
    session_destroy();
    session_start();
  }
  $_SESSION['LAST_ACTIVITY'] = $time;

  if(!isset($_SESSION['username']) || !isset($_SESSION['password']) || !isset($_SESSION['level']) || !isset($_SESSION['avatar']) || ($_SESSION['level'] != 2 && $_SESSION['level'] != 3) ){
    header("location:index.php");
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Thông báo</title>
  <!-- Icon trang web -->
  <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
  <!-- BootStrap -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <!-- Font Awesome icons (free version)-->
  <script src="https://use.fontawesome.com/releases/v5.12.1/js/all.js" crossorigin="anonymous"></script>
  <!-- Google fonts-->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
  <!-- Jquery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="css/styles.css" rel="stylesheet"/>
  <link href="css/override.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body id="page-top">
  <!-- VIEWS -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="index.php">GSD<i class="fas fa-chalkboard-teacher" style="font-size: 40px; margin-left:5px"></i></a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu<i class="fas fa-bars ml-1"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav text-uppercase ml-auto mr-5">
          <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php#portfolio">GIA SƯ</a></li>
          <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php#services">TÌM GIA SƯ</a></li>
          <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php#about">ĐÁNH GIÁ</a></li>
          <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php#contact">LIÊN HỆ</a></li>
        </ul>
      </div>
      <?php require_once('views/display_login.php') ?>
    </div>
  </nav>
  <!-- END VIEWS -->
  <br>
  <br>
  <br>
  <div class="container">
    <h4 class="mt-3" style="text-align:center">Thông báo của tôi</h4>
    <div class="row">
      <div class="col">
        <table class="table table-hover table-striped mt-2" style="text-align:center">
          <thead class="thead-dark">
            <tr>
              <th style="width:30%">Người gửi</th>
              <th style="width:30%">Nội dung</th>
              <th style="width:20%">Ngày</th>
              <th style="width:10%"></th>
              <th style="width:5%"></th>
              <th style="width:5%"></th>
            </tr>
          </thead>
          <tbody id="content">
            <!-- Thông báo kiểm duyệt -->
            <?php
              require_once('models/data_access_helper.php');
              //Create an instance of data access helper
              $db = new DataAccessHelper();

              //Connect to database
              $db->connect();

              $username = $_SESSION['username']; 
              $qr = "SELECT * FROM ThongBao WHERE ThongBao.NguoiNhan = '$username' ORDER BY NgayThongBao ASC";
              $result = $db->executeQuery($qr);
              if ($result){
                foreach ($result as $dt) {
                      if ($dt['Loai']==0){
                        echo "<tr>";
                        echo "<td>".$dt['NguoiGui']."</td>";
                        echo "<td>".$dt['NoiDung']."</td>";
                        echo "<td>".$dt['NgayThongBao']."</td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "</tr>";
                      }
                } 
              }
            ?> 
            <!-- Thông báo cho thành viên khi gia sư nhận lớp -->
            <?php
              if ($_SESSION['level'] == 3){
                $username = $_SESSION['username'];
                $qr = "SELECT * FROM ThongBao,Giasu WHERE ThongBao.NguoiGui = GiaSu.Username AND ThongBao.NguoiNhan = '$username' ORDER BY NgayThongBao ASC";
                $result = $db->executeQuery($qr);
                if($result){
                  foreach ($result as $dt){
                      if ($dt['Loai']==-1 && $dt['Seen']==0){
                        echo "<tr>";
                        echo "<td>".$dt['HoTen']."</td>";
                        echo "<td>".$dt['NoiDung']."</td>";
                        echo "<td>".$dt['NgayThongBao']."</td>";
                        echo "<td hidden id='notice".$dt['Id']."'>".$dt['Id']."</td>";
                        // echo "<td hidden id='notice'>".$dt['Id']."</td>";
                        echo "<td><a data-toggle='modal' href='#confirm_course".$dt['Id']."'><i class='far fa-check-circle'></i></a></td>";
                        echo "<td><a data-toggle='modal' href='#cancel_course".$dt['Id']."'><i class='far fa-times-circle'></i></a></td>";
                        echo "<td><a id=".$dt['Id']." onclick='detail_gs(this.id)' data-toggle='modal' href='#Detail1' class='btn btn-danger'><i class='fas fa-info-circle'></i></a></td>";
                        echo "</tr>";
                      }
                      elseif ($dt['Seen'] == 1){
                        echo "<tr>";
                        echo "<td>".$dt['HoTen']."</td>";
                        echo "<td>".$dt['NoiDung']."</td>";
                        echo "<td>".$dt['NgayThongBao']."</td>";
                        echo "<td hidden id='notice".$dt['Id']."'>".$dt['Id']."</td>";
                        echo "<td hidden id='notice'>".$dt['Id']."</td>";
                        echo "<td>Đã cập nhật</td>";
                        echo "<td></td>";
                        echo "<td><a id=".$dt['Id']." onclick='detail_gs(this.id)' data-toggle='modal' href='#Detail1' class='btn btn-danger'><i class='fas fa-info-circle'></i></a></td>";
                        echo "</tr>";
                    } 
                  }
                }
              }
          ?>

            <!-- Thông báo cho gia sư về việc xác nhận lớp -->
            <?php
              if ($_SESSION['level'] == 2){
                $username = $_SESSION['username'];
                $qr = "SELECT * FROM ThongBao, HocVien WHERE ThongBao.NguoiNhan = '$username' AND ThongBao.NguoiGui = HocVien.Username ORDER BY NgayThongBao ASC";
                $result = $db->executeQuery($qr);
                if ($result){
                   foreach ($result as $dt){
                      if ($_SESSION['username'] == $dt['NguoiNhan']){
                         if ($dt['Loai']==1 && $dt['Seen']==0){
                          echo "<tr>";
                          echo "<td>admin</td>";
                          echo "<td hidden id='STT".$dt['Id']."'>".$dt['Id']."</td>";
                          echo "<td>".$dt['NoiDung']."</td>";
                          echo "<td>".$dt['NgayThongBao']."</td>";
                          echo "<td></td>";
                          echo "<td></td>";
                          echo "<td><a id=".$dt['Id']." onclick='detail_hv(this.id)' data-toggle='modal' href='#Detail2' class='btn btn-danger'><i class='fas fa-info-circle'></i></a></td>";
                          echo "</tr>";
                      }
                    }
                  }
                }
              }
            ?>

            <!-- Thông báo cho gia sư biết đã nhận được lời mời dạy học -->
            <?php
              if ($_SESSION['level'] == 2){
                $qr = "SELECT * FROM ThongBao,HocVien,User WHERE ThongBao.NguoiNhan = '".$_SESSION['username']."' AND ThongBao.NguoiGui = HocVien.Username AND HocVien.Username = User.Username ORDER BY NgayThongBao ASC";
                $result = $conn->query($qr);
                if($result){
                  foreach ($result as $dt){
                      if ($dt['Loai']==-1 && $dt['Seen']==0){
                        echo "<tr>";
                        echo "<td>".$dt['HoTen']."</td>";
                        echo "<td>".$dt['NoiDung']."</td>";
                        echo "<td id='tb".$dt['Id']."' hidden>".$dt['Id']."</td>";
                        echo "<td id='tb' hidden>".$dt['Id']."</td>";
                        echo "<td>".$dt['NgayThongBao']."</td>";
                        echo "<td><a data-toggle='modal' href='#confirm_gs".$dt['Id']."'><i class='far fa-check-circle'></i></a></td>";
                        echo "<td><a data-toggle='modal' href='#cancel_gs".$dt['Id']."'><i class='far fa-times-circle'></i></a></td>";
                        // echo "<td><a href='./controllers/update_confirm_bookgs2.php?&xn=".$dt['Id']."' id='xndk'><i class='far fa-check-circle'></i></a></td>";
                        // echo "<td><a href='./controllers/update_confirm_bookgs2.php?huy=".$dt['Id']."' id='huydk'><i class='far fa-times-circle'></i></a></td>";

                        // echo "<td><a href='views/info_book_gs.php?&id=".$dt['Id']."' class='btn btn-danger'><i class='fas fa-info-circle'></i></a></td>";
                        echo "<td><a id=".$dt['Id']." onclick='detail2_gs(this.id)' data-toggle='modal' href='#Detail3' class='btn btn-danger'><i class='fas fa-info-circle'></i></a></td>";
                        echo "</tr>";
                      }
                      elseif ($dt['Seen']==1){
                        echo "<tr>";
                        echo "<td>".$dt['HoTen']."</td>";
                        echo "<td id='tb".$dt['Id']."' hidden>".$dt['Id']."</td>";
                        echo "<td id='tb' hidden>".$dt['Id']."</td>";
                        echo "<td>".$dt['NoiDung']."</td>";
                        echo "<td>".$dt['NgayThongBao']."</td>";
                        echo "<td>Đã cập nhật</td>";
                        echo "<td></td>";
                        echo "<td><a id=".$dt['Id']." onclick='detail2_gs(this.id)' data-toggle='modal' href='#Detail3' class='btn btn-danger'><i class='fas fa-info-circle'></i></a></td>";
                        echo "</tr>";
                      }
                    }
                  }
                }
              ?>

            <!-- Thông báo cho thành viên về việc book gia sư -->
            <?php
              if ($_SESSION['level'] == 3){
                $qr = 'SELECT * FROM ThongBao INNER JOIN HocVien ON ThongBao.NguoiNhan = HocVien.Username ORDER BY NgayThongBao ASC';
                $result = $db->executeQuery($qr);
                if ($result){
                   foreach ($result as $dt){
                      if ($_SESSION['username'] == $dt['NguoiNhan']){
                         if ($dt['Loai']==1 && $dt['Seen']==0){
                          echo "<tr>";
                          echo "<td>admin</td>";
                          echo "<td hidden id='hocvien".$dt['Id']."'>".$dt['Id']."</td>";
                          echo "<td>".$dt['NoiDung']."</td>";
                          echo "<td>".$dt['NgayThongBao']."</td>";
                          // echo "<td><a href='views/info_book_tv.php?&id=".$dt['Id']."'' class='btn btn-danger'><i class='fas fa-info-circle'></i></a></td>";
                          echo "<td></td>";
                          echo "<td></td>";
                          echo "<td><a id=".$dt['Id']." onclick='detail2_hv(this.id)' data-toggle='modal' href='#Detail4' class='btn btn-danger'><i class='fas fa-info-circle'></i></a></td>";
                          echo "</tr>";
                      }
                    }
                  }
                }
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Thành viên xác nhận hoặc huỷ khi gia sư nhận lớp từ bài đăng -->
  <?php
    $username = $_SESSION['username'];
      $qr = "SELECT * FROM ThongBao,Giasu WHERE ThongBao.NguoiGui = GiaSu.Username AND ThongBao.NguoiNhan = '$username' ORDER BY NgayThongBao ASC";
      $result = $conn->query($qr);
      if($result->num_rows > 0){
        foreach ($result as $dt){
          echo "<div class='modal fade' id='confirm_course".$dt['Id']."'>"; //Xác Nhận -->
            echo "<div class='modal-dialog'>";
              echo "<div class='modal-content'>";
                // <!-- Modal Header -->
                echo "<div class='modal-header'>";
                  echo "<h4 class='modal-title'>XÁC NHẬN</h4>";
                  echo "<button type='button' class='close' data-dismiss='modal'>&times;</button>";
                echo "</div>";
                // <!-- Modal body -->
                echo "<div id='modal-body'>";
                  echo "Bạn đồng ý xác nhận khoá học.";    
                echo "</div>";
                echo "<div class='modal-footer'>";
                  echo "<button id=".$dt['Id']." type='button' class='btn btn-danger' data-dismiss='modal' data-toggle='modal' data-target='#myModal5' onclick='confirm_course(this.id)'>Đồng ý</button>";
                echo "</div>";
              echo "</div>";
            echo "</div>";
          echo "</div>";
        }
      }
    ?>

    <?php
      if($result->num_rows > 0){
        foreach ($result as $dt){
          echo "<div class='modal fade' id='cancel_course".$dt['Id']."'>"; //<!-- Huỷ -->
            echo "<div class='modal-dialog'>";
              echo "<div class='modal-content'>";
                //<!-- Modal Header -->
                echo "<div class='modal-header'>";
                  echo "<h4 class='modal-title'>XÁC NHẬN</h4>";
                  echo "<button type='button' class='close' data-dismiss='modal'>&times;</button>";
                echo "</div>";
                //<!-- Modal body -->
                echo "<div id='modal-body'>";
                  echo "Bạn muốn huỷ khoá học.";    
                echo "</div>";
                echo "<div class='modal-footer'>";
                  echo "<button id=".$dt['Id']." type='button' class='btn btn-danger' data-dismiss='modal' data-toggle='modal' data-target='#myModal5' onclick='cancel_course(this.id)'>Đồng ý</button>";
                echo "</div>";
              echo "</div>";
            echo "</div>";
          echo "</div>";
        }
      }
    ?>


  <div class="modal fade" id="myModal5">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">XÁC NHẬN</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div id="modal-confirm">  
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>


  <!-- Chi tiet Gia Su Nhan Lop-->
  
    <div class='modal fade' id='Detail1'>
      <div class='modal-dialog'>
        <div class='modal-content'>
          <!-- Modal Header -->
          <div class='modal-header'>
            <h4 class='modal-title'></h4>
              <button type='button' class='close' data-dismiss='modal'>&times;</button>
          </div>
            <!-- Modal body -->
            <div id='modal-gs'>    
            </div>
            </div>
          </div>
        </div>
      
       

  <!-- Chi tiết Học Viên của lớp học -->
  <div class="modal fade" id="Detail2">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title"></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          <div id='modal-hv'></div>
        </div>
      </div>
    </div>
  </div>

  <!----------------------------------------------------------------------------->
  <!-- Gia sư xác nhận hoặc huỷ khi học viên book gia sư -->
  <?php
  $qr = "SELECT * FROM ThongBao,HocVien,User WHERE ThongBao.NguoiNhan = '".$_SESSION['username']."' AND ThongBao.NguoiGui = HocVien.Username AND HocVien.Username = User.Username ORDER BY NgayThongBao ASC";
  $result = $conn->query($qr);
  if($result){
    foreach ($result as $dt){
      echo "<div class='modal fade' id='confirm_gs".$dt['Id']."'>"; //<!-- Xác Nhận -->
        echo "<div class='modal-dialog'>";
          echo "<div class='modal-content'>";
            //<!-- Modal Header -->
            echo "<div class='modal-header'>";
              echo "<h4 class='modal-title'>XÁC NHẬN</h4>";
              echo "<button type='button' class='close' data-dismiss='modal'>&times;</button>";
            echo "</div>";
            //<!-- Modal body -->
            echo "<div id='modal-body'>";
              echo "Bạn đồng ý xác nhận lời mời dạy học";    
            echo "</div>";
            echo "<div class='modal-footer'>";
              echo "<button id=".$dt['Id']." type='button' class='btn btn-danger' data-dismiss='modal' data-toggle='modal' data-target='#myModal5' 
              onclick='confirm_gs(this.id)'>Đồng ý</button>";
            echo "</div>";
          echo "</div>";
        echo "</div>";
      echo "</div>";
    }
  }
  ?>
<?php 
  $qr = "SELECT * FROM ThongBao,HocVien,User WHERE ThongBao.NguoiNhan = '".$_SESSION['username']."' AND ThongBao.NguoiGui = HocVien.Username AND HocVien.Username = User.Username ORDER BY NgayThongBao ASC";
  $result = $conn->query($qr);
  if($result){
    foreach ($result as $dt){
      echo "<div class='modal fade' id='cancel_course".$dt['Id']."'>"; //<!-- Huỷ -->
        echo "<div class='modal-dialog'>";
          echo "<div class='modal-content'>";
            //<!-- Modal Header -->
            echo "<div class='modal-header'>";
              echo "<h4 class='modal-title'>XÁC NHẬN</h4>";
              echo "<button type='button' class='close' data-dismiss='modal'>&times;</button>";
            echo "</div>";
            //<!-- Modal body -->
            echo "<div id='modal-body'>";
              echo "Bạn muốn huỷ lời mời dạy học.";    
            echo "</div>";
            echo "<div class='modal-footer'>";
              echo "<button id=".$dt['Id']." type='button' class='btn btn-danger' data-dismiss='modal' data-toggle='modal' data-target='#myModal5' onclick='cancel_gs(this.id)'>Đồng ý</button>";
            echo "</div>";
          echo "</div>";
        echo "</div>";
      echo "</div>";
    }
  }
  $db->close();
?>

  <div class="modal fade" id="myModal5">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">XÁC NHẬN</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div id="modal-giasu">  
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="Detail3">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title"></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div id="book-gs">    
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="Detail4">
    <div class="modal-dialog" >
      <div class="modal-content" style="width:40rem; ">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title"></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          <div id='book-hv'></div>
        </div>
      </div>
    </div>
  </div>



  <!-- My JavaScript -->
  <script src="js/myScript.js"></script>
</body>
</html>