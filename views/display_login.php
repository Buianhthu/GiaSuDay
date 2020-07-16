<?php 
  if( isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['level']) && isset($_SESSION['avatar']) ){
    if($_SESSION['level'] == 1){ // Quyen Admin
      echo '<div class="dropdown-user ml-5" id="userInfo" style="background-image:url(';
      echo "'". $_SESSION['avatar'] ."')" .'">';
      echo '<div class="dropdown-content-user dropdown-menu-center">';

      echo '<a href="admin/"><i class="fas fa-user-tie fa-sm fa-fw mr-2"></i>Trang quản trị</a>';
      echo '<button onclick="logout()"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>Đăng xuất</button>';

      echo '</div>';
      echo '</div>';
    }
    else if($_SESSION['level'] == 2){ // Quyen Gia Su
      echo '<div class="dropdown-user ml-5" id="userInfo" style="background-image:url(';
      echo "'". $_SESSION['avatar'] ."')" .'">';
      echo '<div class="dropdown-content-user dropdown-menu-center">';

      echo '<a href="thongtin_gs.php"><i class="fas fa-user fa-sm fa-fw mr-2"></i>Thông tin tài khoản</a>';
      echo '<a href="thongbao.php"><i class="fas fa-bell fa-sm fa-fw mr-2"></i>Thông báo</a>';
      echo '<a href="quanlydayhoc.php"><i class="fas fa-tasks fa-sm fa-fw mr-2"></i>Quản lý dạy học</a>';
      echo '<button onclick="logout()"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>Đăng xuất</button>';

      echo '</div>';
      echo '</div>';
    }
    else{ // Quyen Thanh vien
      echo '<div class="dropdown-user ml-5" id="userInfo" style="background-image:url(';
      echo "'". $_SESSION['avatar'] ."')" .'">';
      echo '<div class="dropdown-content-user dropdown-menu-center">';

      echo '<a href="thongtin_tv.php"><i class="fas fa-user fa-sm fa-fw mr-2"></i>Thông tin cá nhân</a>';
      echo '<a href="thongbao.php"><i class="fas fa-bell fa-sm fa-fw mr-2"></i>Thông báo</a>';
      echo '<a href="quanlybaidang.php"><i class="fas fa-paste fa-sm fa-fw mr-2"></i>Bài đăng của tôi</a>';
      echo '<a href="quanlyreview.php"><i class="fas fa-clipboard-list fa-sm fa-fw mr-2"></i>Review của tôi</a>';

      echo '<a href="timgiasu.php"><i class="fas fa-user-plus fa-sm fa-fw mr-2"></i>Tìm gia sư</a>';
      echo '<a href="dangreview.php"><i class="fas fa-file-medical fa-sm fa-fw mr-2"></i></i>Đăng review</a>';
      echo '<button onclick="logout()"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>Đăng xuất</button>';

      echo '</div>';
      echo '</div>';
    }
  }
  else{ // Chua dang ky
    echo '<ul class="navbar-nav text-uppercase ml-5" id="macdinh">';
    echo '<li class="nav-item"><a class="nav-link" data-toggle="modal" href="#login">Đăng Nhập</a></li>';
    echo '<li class="nav-item dropdown"><a class="nav-link" href="#">Đăng Ký</a>';
    echo '<div class="dropdown-content dropdown-menu-center">';
    echo '<a href="./dangky_tv.php">Thành Viên</a>';
    echo '<a href="./dangky_gs.php">Trở thành Gia Sư</a>';
    echo '</div>';
    echo '</li>';
    echo '</ul>';
  }
?>