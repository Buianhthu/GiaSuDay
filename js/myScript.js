/* ---------- Anh Thu ---------- */



/* ---------- Hoang Duc ---------- */
function login() {
  var sdt = document.getElementById("sdt_dn").value;
  var password = document.getElementById("password_dn").value;

  if(sdt.length == 0 || password.length == 0){
    alert('Vui lòng nhập đầy đủ !');
    return;
  }
  else{
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var t = this.responseText;
        if(t == -1) alert("Gặp lỗi trong quá trình xử lý, vui lòng đăng nhập lại.");
        else if(t == 0) alert("Số điện thoại hoặc mật khẩu không đúng !");
        else location.reload();
      }
    };
    var str = "controllers/login.php?username=" + sdt + "&password=" + password;
    xhttp.open("GET", str, true);
    xhttp.send();
  }
}

function logout() {
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      location.reload();
    }
  };
  xhttp.open("GET", "controllers/logout.php", true);
  xhttp.send();
}

function validateNumber(evt) {
  var theEvent = evt || window.event;

  // Handle paste
  if (theEvent.type === 'paste') {
      key = event.clipboardData.getData('text/plain');
  } else {
  // Handle key press
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode(key);
  }
  var regex = /[0-9]/;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}

function isEmail(email) {
  const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(String(email).toLowerCase());
}

function isURL(str) {
  var pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
  '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.?)+[a-z]{2,}|'+ // domain name
  '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
  '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
  '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
  '(\\#[-a-z\\d_]*)?$','i'); // fragment locator
  return pattern.test(str);
}

function insertTV(){
  var hovaten = document.getElementById("hovaten").value;
  var ngaysinh = document.getElementById("ngaysinh").value;
  var gioitinh = "";
  if(document.getElementById('radioNam').checked) {
    gioitinh = document.getElementById('radioNam').value;
  }else if(document.getElementById('radioNu').checked) {
    gioitinh = document.getElementById('radioNu').value;
  }
  var email = document.getElementById("email").value;
  var sdt = document.getElementById("sdt").value;
  var pass = document.getElementById("pass").value;
  var password = document.getElementById("password").value;

  if(hovaten.length == 0 || ngaysinh.length == 0 || gioitinh.length == 0 || email.length == 0 || sdt.length == 0 || pass.length == 0 || password.length == 0){
    alert('Không được bỏ trống các trường !');
    return;
  }
  else if(isEmail(email) == false){
    alert('Email không hợp lệ !');
    return;
  }
  else if(pass != password){
    alert('Password nhập lại không đúng !')
    return;
  }
  else{
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("notification").innerHTML = this.responseText;
      }
    };
    var str = "controllers/insert_tv.php?hovaten=" + hovaten + "&ngaysinh=" + ngaysinh +"&gioitinh=" + gioitinh + "&email=" + email + "&sdt=" + sdt + "&password=" + password;
    xhttp.open("GET", str, true);
    xhttp.send();
  }
}

function insertGS(){
  var hovaten = document.getElementById("hovaten").value;
  var ngaysinh = document.getElementById("ngaysinh").value;
  var gioitinh = "";
  if(document.getElementById('radioNam').checked) {
    gioitinh = document.getElementById('radioNam').value;
  }else if(document.getElementById('radioNu').checked) {
    gioitinh = document.getElementById('radioNu').value;
  }
  var email = document.getElementById("email").value;
  var sdt = document.getElementById("sdt").value;
  var cmnd = document.getElementById("cmnd").value;
  var pass = document.getElementById("pass").value;
  var password = document.getElementById("password").value;

  if(hovaten.length == 0 || ngaysinh.length == 0 || gioitinh.length == 0 || email.length == 0 || sdt.length == 0 || cmnd.length == 0 || pass.length == 0 || password.length == 0){
    alert('Không được bỏ trống các trường !');
    return;
  }
  else if(isEmail(email) == false){
    alert('Email không hợp lệ !');
    return;
  }
  else if(pass != password){
    alert('Password nhập lại không đúng !')
    return;
  }
  else{
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("notification").innerHTML = this.responseText;
      }
    };
    var str = "controllers/insert_gs.php?hovaten=" + hovaten + "&ngaysinh=" + ngaysinh +"&gioitinh=" + gioitinh + "&email=" + email + "&sdt=" + sdt + "&cmnd=" + cmnd  + "&password=" + password;
    xhttp.open("GET", str, true);
    xhttp.send();
  }
}

function insertMonDay(sdt) {
  var monhoc = document.getElementById("monhoc").value;
  var chitietmonhoc = document.getElementById("chitietmonhoc").value;
  var hocphi = document.getElementById("hocphi").value;
  if(monhoc.length == 0 || chitietmonhoc.length == 0 || hocphi.length == 0){
    alert('Vui lòng không để trống các trường');
    return;
  }
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var t = this.responseText;
      if(t == -1) alert("Đã đăng ký môn này, vui lòng chọn môn khác.");
      else if(t == 0) alert("ERROR: Thêm thất bại !");
      else location.reload();
    }
  };
  var str = "controllers/insert_monday_gs.php?sdt=" + sdt + "&monhoc=" + monhoc + "&chitietmonhoc=" + chitietmonhoc + "&hocphi=" + hocphi;
  xhttp.open("GET", str, true);
  xhttp.send();
}

function insertTimGiaSu(sdt) {
  var monhoc = document.getElementById("monhoc").value;
  var chitietmonhoc = document.getElementById("chitietmonhoc").value;
  var monmoi = document.getElementById("monmoi").value;
  var noidung = document.getElementById("noidung").value;
  var thoigianhoc = document.getElementById("thoigianhoc").value;
  var hocphi = document.getElementById("hocphi").value;

  if(monmoi.length > 0){
    if(noidung.length == 0 || thoigianhoc.length == 0 || hocphi.length == 0){
      alert('Vui lòng nhập đủ các trường cần thiết');
      return;
    }
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200)
        document.getElementById("notification").innerHTML = this.responseText;
    };
    var str = "controllers/insert_timgiasu_tv.php?sdt=" + sdt + "&tenmonhoc=" + monmoi + "&noidung=" + noidung + "&thoigianhoc=" + thoigianhoc + "&hocphi=" + hocphi;
    xhttp.open("GET", str, true);
    xhttp.send();
  }
  else if(monhoc.length > 0 && chitietmonhoc.length > 0){
    if(noidung.length == 0 || thoigianhoc.length == 0 || hocphi.length == 0){
      alert('Vui lòng nhập đủ các trường cần thiết');
      return;
    }
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200)
        document.getElementById("notification").innerHTML = this.responseText;
    };
    var str = "controllers/insert_timgiasu_tv.php?sdt=" + sdt + "&tenmonhoc=" + chitietmonhoc + "&noidung=" + noidung + "&thoigianhoc=" + thoigianhoc + "&hocphi=" + hocphi;
    xhttp.open("GET", str, true);
    xhttp.send();
  }
  else alert('Bạn chưa chọn môn học');
}

function insertReview(sdt) {
  var noidung = document.getElementById("noidung").value;
  if(noidung.length == 0){
    alert('Vui lòng không để trống');
    return;
  }
  else if(noidung.length > 299){
    alert('Nội dung quá dài');
    return;
  }
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("notification").innerHTML = this.responseText;
    }
  };
  var str = "controllers/insert_review_tv.php?sdt=" + sdt + "&noidung=" + noidung;
  xhttp.open("GET", str, true);
  xhttp.send();
}

function updateMoTa(sdt) {
  var mota = document.getElementById("mota").value;
  if(mota.length == 0 || mota.length > 299){
    alert('Độ dài trường nhập không hợp lệ !');
    return;
  }
  else{
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var t = this.responseText;
        if(t == 0){
          alert("ERROR: Cập nhật thất bại !");
        }
        else location.reload();
      }
    };
    xhttp.open("GET", "controllers/update_mota_gs.php?mota=" + mota + "&sdt=" + sdt, true);
    xhttp.send();
  }
}

function updateEmail(sdt) {
  var email = document.getElementById("email").value;
  if(email.length == 0){
    return;
  }
  else if(isEmail(email) == false){
    alert("Email không hợp lệ !");
    return;
  }
  else{
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var t = this.responseText;
        if(t == -1) alert("Email đã tồn tại.");
        else if(t == 0) alert("ERROR: Cập nhật thất bại !");
        else location.reload();
      }
    };
    xhttp.open("GET", "controllers/update_email.php?email=" + email + "&sdt=" + sdt, true);
    xhttp.send();
  }
}

function updateFB(sdt) {
  var fb = document.getElementById("fb").value;
  if(fb.length == 0){
    return;
  }
  else if(isURL(fb) == false){
    alert("Đường link không hợp lệ !");
    return;
  }
  else{
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var t = this.responseText;
        if(t == 0) alert("ERROR: Cập nhật thất bại !");
        else{ location.reload();}
      }
    };
    xhttp.open("GET", "controllers/update_fb.php?fb=" + fb + "&sdt=" + sdt, true);
    xhttp.send();
  }
}

function updateThoiGianDay(sdt) {
  var thuhai = document.getElementById("thuhai").value;
  var thuba = document.getElementById("thuba").value;
  var thutu = document.getElementById("thutu").value;
  var thunam = document.getElementById("thunam").value;
  var thusau = document.getElementById("thusau").value;
  var thubay = document.getElementById("thubay").value;
  var chunhat = document.getElementById("chunhat").value;

  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var t = this.responseText;
      if(t == 0) alert("ERROR: Cập nhật thất bại !");
      else{ location.reload();}
    }
  };
  str = "controllers/update_thoigianday_gs.php?sdt=" + sdt + "&thuhai=" + thuhai + "&thuba=" + thuba + "&thutu=" + thutu + "&thunam=" + thunam + "&thusau=" + thusau + "&thubay=" + thubay + "&chunhat=" + chunhat;
  xhttp.open("GET", str, true);
  xhttp.send();
}

function updateWorkflow(sdt) {
  var linhvuc = document.getElementById("linhvuc").value;
  var chuyennganh = document.getElementById("chuyennganh").value;
  var hocvi = document.getElementById("hocvi").value;
  var noilamviec = document.getElementById("noilamviec").value;
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var t = this.responseText;
      if(t == 0) alert("ERROR: Cập nhật thất bại !");
      else{ location.reload();}
    }
  };
  var str = "controllers/update_workflow_gs.php?sdt=" + sdt + "&linhvuc=" + linhvuc + "&chuyennganh=" + chuyennganh + "&hocvi=" + hocvi + "&noilamviec=" + noilamviec;
  xhttp.open("GET", str, true);
  xhttp.send();
}

function deleteMonDay(obj) {
  var id = obj.getAttribute("data-id");
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var t = this.responseText;
      if(t == 0) alert("Gặp lỗi trong quá trình xử lý !");
      else location.reload();
    }
  };
  xhttp.open("GET", "controllers/delete_monday_gs.php?id=" + id, true);
  xhttp.send();
}

function getChuyenNganh(obj) {
  var value = obj.value;
  switch (value){
    case 'Sư phạm':
      $("#chuyennganh").empty().append('<option value="">-- Chọn chuyên ngành --</option>');
      $("#chuyennganh").append('<option value="Sư Phạm Toán">Sư Phạm Toán</option>');
      $("#chuyennganh").append('<option value="Sư Phạm Tin Học">Sư Phạm Tin Học</option>');
      break;
    case 'Khoa học tự nhiên':
      $("#chuyennganh").empty().append('<option value="">-- Chọn chuyên ngành --</option>');
      $("#chuyennganh").append('<option value="Toán Học">Toán Học Lý Thuyết</option>');
      $("#chuyennganh").append('<option value="Toán Học">Toán Học Ứng Dụng</option>');
      $("#chuyennganh").append('<option value="Toán-Tin">Toán-Tin</option>');
      break;
    case 'Công nghệ thông tin':
      $("#chuyennganh").empty().append('<option value="">-- Chọn chuyên ngành --</option>');
      $("#chuyennganh").append('<option value="Công Nghệ Phần Mềm">Công Nghệ Phần Mềm</option>');
      $("#chuyennganh").append('<option value="Khoa Học Máy Tính">Khoa Học Máy Tính</option>');
      $("#chuyennganh").append('<option value="Hệ Thống Thông Tin">Hệ Thống Thông Tin</option>');
      $("#chuyennganh").append('<option value="Thương Mại Điện Tử">Thương Mại Điện Tử</option>');
      $("#chuyennganh").append('<option value="Khoa Học Dữ Liệu">Khoa Học Dữ Liệu</option>');
      $("#chuyennganh").append('<option value="Mạng Máy Tính - Truyền Thông Dữ Liệu">Mạng Máy Tính - Truyền Thông Dữ Liệu</option>');
      $("#chuyennganh").append('<option value="An Toàn Thông Tin">An Toàn Thông Tin</option>');
      $("#chuyennganh").append('<option value="Kỹ Thuật Máy Tính">Kỹ Thuật Máy Tính</option>');
      break;
    default:
      $("#chuyennganh").empty().append('<option value="">-- Chọn chuyên ngành --</option>');
  }
}

function getCTMH(obj) {
  var value = obj.value;
  switch (value){
    case 'Khoa Học Tự Nhiên':
      $("#chitietmonhoc").empty().append('<option value="">-- Chọn môn chi tiết --</option>');
      $("#chitietmonhoc").append('<option value="Giải Tích">Giải Tích</option>');
      $("#chitietmonhoc").append('<option value="Đại Số Tuyến Tính">Đại Số Tuyến Tính</option>');
      $("#chitietmonhoc").append('<option value="Cấu Trúc Rời Rạc">Cấu Trúc Rời Rạc</option>');
      $("#chitietmonhoc").append('<option value="Xác Suất Thống Kê">Xác Suất Thống Kê</option>');
      $("#chitietmonhoc").append('<option value="Nhập Môn Mạch Số">Nhập Môn Mạch Số</option>');
      $("#chitietmonhoc").append('<option value="Nhập Môn Điện Tử">Nhập Môn Điện Tử</option>');
      $("#chitietmonhoc").append('<option value="Phân Tích Và Thiết Kế Thuật Toán">Phân Tích Và Thiết Kế Thuật Toán</option>');
      break;
    case 'Lập Trình Căn Bản':
      $("#chitietmonhoc").empty().append('<option value="">-- Chọn môn chi tiết --</option>');
      $("#chitietmonhoc").append('<option value="Nhập Môn Lập Trình">Nhập Môn Lập Trình</option>');
      $("#chitietmonhoc").append('<option value="Kỹ Thuật Lập Trình">Kỹ Thuật Lập Trình</option>');
      $("#chitietmonhoc").append('<option value="Cấu Trúc Dữ Liệu Và Giải Thuật">Cấu Trúc Dữ Liệu Và Giải Thuật</option>');
      $("#chitietmonhoc").append('<option value="Lập Trình Hướng Đối Tượng">Lập Trình Hướng Đối Tượng</option>');
      $("#chitietmonhoc").append('<option value="Cơ Sở Dữ Liệu">Cơ Sở Dữ Liệu</option>');
      $("#chitietmonhoc").append('<option value="Nhập Môn Mạng Máy Tính">Nhập Môn Mạng Máy Tính</option>');
      $("#chitietmonhoc").append('<option value="Hệ Điều Hành">Hệ Điều Hành</option>');
      break;
    case 'Lập Trình Web':
    $("#chitietmonhoc").empty().append('<option value="">-- Chọn môn chi tiết --</option>');
      $("#chitietmonhoc").append('<option value="HTML-CSS">HTML-CSS</option>');
      $("#chitietmonhoc").append('<option value="PHP">PHP</option>');
      $("#chitietmonhoc").append('<option value="Node.js">Node.js</option>');
      $("#chitietmonhoc").append('<option value="JavaScript">JavaScript</option>');
      $("#chitietmonhoc").append('<option value="jQuery">jQuery</option>');
      $("#chitietmonhoc").append('<option value="AJAX">AJAX</option>');
      $("#chitietmonhoc").append('<option value="JSON">JSON</option>');
      $("#chitietmonhoc").append('<option value="React">React</option>');
      $("#chitietmonhoc").append('<option value="Vue.js">Vue.js</option>');
      $("#chitietmonhoc").append('<option value="Ruby on Rails">Ruby on Rails</option>');
      $("#chitietmonhoc").append('<option value="Bootstrap">Bootstrap</option>');
      $("#chitietmonhoc").append('<option value="AngularJS">AngularJS</option>');
      $("#chitietmonhoc").append('<option value="Laravel">Laravel</option>');
      $("#chitietmonhoc").append('<option value="ASP.NET">ASP.NET</option>');
      break;
    case 'Lập Trình Mobile':
      $("#chitietmonhoc").empty().append('<option value="">-- Chọn môn chi tiết --</option>');
      $("#chitietmonhoc").append('<option value="Lập trình Mobile với">Lập trình Mobile với Java</option>');
      $("#chitietmonhoc").append('<option value="React Native">React Native</option>');
      $("#chitietmonhoc").append('<option value="Flutter">Flutter</option>');
      $("#chitietmonhoc").append('<option value="Ionic">Ionic</option>');
      $("#chitietmonhoc").append('<option value="Native Android">Native Android</option>');
      $("#chitietmonhoc").append('<option value="Xamarin">Xamarin</option>');
      $("#chitietmonhoc").append('<option value="NativeScript">NativeScript</option>');
      $("#chitietmonhoc").append('<option value="jQuery Mobile">jQuery Mobile</option>');
      $("#chitietmonhoc").append('<option value="Framework7">Framework7</option>');
      $("#chitietmonhoc").append('<option value="Realm">Realm</option>');
      $("#chitietmonhoc").append('<option value="Retrofit">Retrofit</option>');
      $("#chitietmonhoc").append('<option value="Picasso">Picasso</option>');
      $("#chitietmonhoc").append('<option value="Glide">Glide</option>');
      $("#chitietmonhoc").append('<option value="Zxing">Zxing</option>');
      $("#chitietmonhoc").append('<option value="Stetho">Stetho</option>');
      $("#chitietmonhoc").append('<option value="Espresso">Espresso</option>');
      break;
    case 'Lập Trình Game':
      $("#chitietmonhoc").empty().append('<option value="">-- Chọn môn chi tiết --</option>');
      $("#chitietmonhoc").append('<option value="Lập Trình Game Với Unity3D">Lập Trình Game Với Unity3D</option>');
      $("#chitietmonhoc").append('<option value="Lập Trình Game Trong Thiết Bị Di Động">Lập Trình Game Trong Thiết Bị Di Động</option>');
      $("#chitietmonhoc").append('<option value="Kỹ Thuật DirectX">Kỹ Thuật DirectX</option>');
      $("#chitietmonhoc").append('<option value="Thiết Kế 3D Game Engine">Thiết Kế 3D Game Engine</option>');
      $("#chitietmonhoc").append('<option value="Đồ Họa Game">Đồ Họa Game</option>');
      break;
    case 'Lập Trình Hệ Thống':
      $("#chitietmonhoc").empty().append('<option value="">-- Chọn môn chi tiết --</option>');
      $("#chitietmonhoc").append('<option value="Hệ Quản Trị Cơ Sở Dữ Liệu">Hệ Quản Trị Cơ Sở Dữ Liệu</option>');
      $("#chitietmonhoc").append('<option value="Hệ Thống Thông Tin Quản Lý">Hệ Thống Thông Tin Quản Lý</option>');
      $("#chitietmonhoc").append('<option value="Cơ Sở Dữ Liệu Phân Tán">Cơ Sở Dữ Liệu Phân Tán</option>');
      $("#chitietmonhoc").append('<option value="Khai Thác Dữ Liệu">Khai Thác Dữ Liệu</option>');
      $("#chitietmonhoc").append('<option value="Kho Dữ Liệu Và OLAP">Kho Dữ Liệu Và OLAP</option>');
      $("#chitietmonhoc").append('<option value="Hệ Hỗ Trợ Ra Quyết Định">Hệ Hỗ Trợ Ra Quyết Định</option>');
      $("#chitietmonhoc").append('<option value="Điện Toán Đám Mây">Điện Toán Đám Mây</option>');
      $("#chitietmonhoc").append('<option value="Big Data">Big Data</option>');
      break;
    case 'Tin Học Văn Phòng':
      $("#chitietmonhoc").empty().append('<option value="">-- Chọn môn chi tiết --</option>');
      $("#chitietmonhoc").append('<option value="Word">Word</option>');
      $("#chitietmonhoc").append('<option value="Excel">Excel</option>');
      $("#chitietmonhoc").append('<option value="PowerPoint">PowerPoint</option>');
      break;
    default:
      $("#chuyennganh").empty().append('<option value="">-- Chọn môn chi tiết --</option>');
  }
}