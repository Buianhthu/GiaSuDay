<?php
session_start(); 
    require_once('../models/data_access_helper.php');
    // Create an instance of data access helper
    $db = new DataAccessHelper();

    // Connect to database
    $db->connect();
    if (isset($_GET['id'])){
      $id = $_GET['id'];
    }
    $qr = "SELECT * FROM ThongBao,GiaSu,User WHERE ThongBao.NguoiGui = GiaSu.SDT_GS AND GiaSu.SDT_GS = User.SDT AND Id = $id";
    $result = $conn->query($qr);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Đăng ký gia sư</title>
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
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="../css/styles.css" rel="stylesheet"/>
  <link href="../css/override.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body id="page-top">
    <?php
      require_once ('navigation.php');
    ?>
<section class="page-section bg-light" id="portfolio">
  <div class="container">
    <div class="text-center">
	  <h2>THÔNG TIN GIA SƯ</h2>
	  <table class="table">
	    <thead class="thead-dark">
	      <tr>
	        <th>Họ Tên</th>
	        <th>Số điện thoại</th>
	        <th>Email - FaceBook</th>
	      </tr>
	    </thead>
	    <tbody>
	    <?php
    	   if($result->num_rows > 0){
                foreach ($result as $dt){
                    if ($_SESSION['username']==$dt['NguoiNhan']){
                        echo "<tr>";
                        echo "<td>".$dt['HoTen']."</td>";
                        echo "<td>".$dt['SDT_GS']."</td>";
                        echo "<td>".$dt['Email']."<br>".$dt['LinkFB']."</td>";
                        echo "</tr>"; 
                    }
                }
            }
          ?>
      </tbody>
    </table>
        <?php
                    echo '<h4 class="mt-5">Các Môn Dạy</h4>';
                    $sdt = $dt['SDT_GS'];
                    $sql = "SELECT * FROM monday WHERE SDT_GS = '$sdt'";
                    $kq = $db->executeQuery($sql);

                    if($kq){
                      while ($r = $kq->fetch_array(MYSQLI_ASSOC)) {
                        echo '<ul class="list-group list-group-flush mb-5">';
                        echo '<li class="list-group-item"><strong>Môn học : </strong>'. $r['TenMonHoc'] .'</li>';
                        echo '<li class="list-group-item"><strong>Chi tiết môn học : </strong>'. $r['ChiTietMonHoc'] .'</li>';
                        echo '<li class="list-group-item"><strong>Học phí : </strong>'. $r['HocPhi'] .' đồng / 1 buổi</li>';
                        echo '</ul>';
                      }
                    }

                  echo '<h4 class="mt-5">Thời Gian Dạy</h4>';
                  echo '<table class="table table-hover table-striped mt-2" style="text-align:center">';
                    echo '<thead class="thead-dark">';
                        echo '<tr><th width="10%"></th>';
                        echo '<th>Thứ hai</th>
                              <th>Thứ ba</th>
                              <th>Thứ tư</th>
                              <th>Thứ năm</th>
                              <th>Thứ sáu</th>
                              <th>Thứ bảy</th>
                              <th>Chủ nhật</th></tr></thead>';
                    echo '<tbody id="content">';
                      $sql = "SELECT * FROM thoigianday WHERE SDT_GS = '$sdt'";
                      $kq = $db->executeQuery($sql);

                      if($kq){
                        while ($row = $kq->fetch_array(MYSQLI_ASSOC)) {
                          // Sáng
                          echo '<tr>';
                          echo '<td>Sáng</td>';
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
                          echo '<td>Chiều</td>';
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
                          echo '<td>Tối</td>';
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
                        }
                      }
                    echo '</tbody></table>';
                  echo '<div><span class="mr-5">Sáng : 8h - 11h</span><span class="mr-5">Chiều : 15h - 18h</span><span class="mr-5">Tối : 18h - 21h</span></div>';
            ?>
        </div>
    </div>
</section>

	

