/*-----------ANH THU ------------- */
function Search(){
  var monhoc = document.getElementById('khoahoc').value;
  var chitietmonhoc = document.getElementById('monhoc').value;
  if (monhoc.length == 0 || chitietmonhoc.length == 0){
    alert("Vui lÃ²ng chá»n Ä‘áº§y Ä‘á»§ thÃ´ng tin");
    return;
  }
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        document.getElementById("text").innerHTML = this.responseText;
    }
  };
  var str = "controllers/search.php?khoahoc=" + monhoc +"&monhoc=" + chitietmonhoc;
  xhttp.open("GET", str, true);
  xhttp.send();
}

function book_course (clickId){
  var id = document.getElementById('STT1' + clickId).innerHTML;
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function(){
    if (this.readyState == 4 && this.status == 200){
      document.getElementById("modal-body1").innerHTML = this.responseText;
      setTimeout(function(){
          location.reload();
      }, 2000); 
    }
  };
  var str = "controllers/update_confirm_post.php?id=" + id;
  xhttp.open("GET", str, true);
  xhttp.send();
}

function confirm_course(clickId){
  var id = document.getElementById('notice' + clickId).innerHTML;
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function(){
    if (this.readyState == 4 && this.status == 200){
      document.getElementById("modal-confirm").innerHTML = this.responseText;
      setTimeout(function(){
          location.reload();
      }, 2000);
    }
  };
  var str = "controllers/update_confirm_post2.php?id=" + id;
  xhttp.open("GET", str, true);
  xhttp.send();
}

function cancel_course(clickId){
  var id = document.getElementById('notice' + clickId).innerHTML;
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function(){
    if (this.readyState == 4 && this.status == 200){
      document.getElementById("modal-confirm").innerHTML = this.responseText;
      setTimeout(function(){
          location.reload();
      }, 2000);
    }
  };
  var str = "controllers/cancel_course.php?id=" + id;
  xhttp.open("GET", str, true);
  xhttp.send();
}

function detail_gs(clickId){
  var id = document.getElementById('notice' + clickId).innerHTML;
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function(){
    if (this.readyState == 4 && this.status == 200){
      document.getElementById("modal-gs").innerHTML = this.responseText;
    }
  };
  var str = "views/info_course_tv.php?id=" + id;
  xhttp.open("GET", str, true);
  xhttp.send();
}

function detail_hv(clickId){
  var id = document.getElementById('STT' + clickId).innerHTML;
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function(){
    if (this.readyState == 4 && this.status == 200){
      document.getElementById("modal-hv").innerHTML = this.responseText;
    }
  };
  var str = "views/info_course_gs.php?id=" + id;
  xhttp.open("GET", str, true);
  xhttp.send();
}

function book_gs(clickId){
  var id = document.getElementById('Id' + clickId).innerHTML;
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function(){
    if (this.readyState == 4 && this.status == 200){
      document.getElementById("modal-body2").innerHTML = this.responseText;
      setTimeout(function(){
          location.reload();
      }, 1000); 
    }
  };
  var str = "controllers/update_confirm_bookgs.php?id=" + id;
  xhttp.open("GET", str, true);
  xhttp.send();
}

function confirm_gs(clickId){
  var id = document.getElementById('tb' + clickId).innerHTML;
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function(){
    if (this.readyState == 4 && this.status == 200){
      document.getElementById("modal-giasu").innerHTML = this.responseText;
      setTimeout(function(){
          location.reload();
      }, 2000);
    }
  };
  var str = "controllers/update_confirm_bookgs2.php?id=" + id;
  xhttp.open("GET", str, true);
  xhttp.send();
}

function cancel_gs(clickId){
  var id = document.getElementById('tb' + clickId).innerHTML;
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function(){
    if (this.readyState == 4 && this.status == 200){
      document.getElementById("modal-giasu").innerHTML = this.responseText;
      setTimeout(function(){
          location.reload();
      }, 2000);
    }
  };
  var str = "controllers/cancel_gs.php?id=" + id;
  xhttp.open("GET", str, true);
  xhttp.send();
}

function detail2_gs(clickId){
  var id = document.getElementById('tb' + clickId).innerHTML;
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function(){
    if (this.readyState == 4 && this.status == 200){
      document.getElementById("book-gs").innerHTML = this.responseText;
    }
  };
  var str = "views/info_book_gs.php?id=" + id;
  xhttp.open("GET", str, true);
  xhttp.send();
}

function detail2_hv(clickId){
  var id = document.getElementById('hocvien' + clickId).innerHTML;
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function(){
    if (this.readyState == 4 && this.status == 200){
      document.getElementById("book-hv").innerHTML = this.responseText;
    }
  };
  var str = "views/info_book_tv.php?id=" + id;
  xhttp.open("GET", str, true);
  xhttp.send();
}



/* ---------- HOANG DUC ---------- */
$(document).ready(function(){
  // Hiện message ngay trường input
  $("#email").keyup(function(){
    var email = $(this).val();
    var message = "";
    if(email.length == 0)
      message = "";
    else if(!isEmail(email))
      message = "*Email không hợp lệ !!!";
    else{
      var xhttp;
      xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var t = this.responseText;
          if (t == 0)
            document.getElementById("mess-email").innerHTML = "*Email đã tồn tại !";
          else
            document.getElementById("mess-email").innerHTML = "";
        }
        return;
      };
      var str = "controllers/check_email.php?email=" + email;
      xhttp.open("GET", str, true);
      xhttp.send();
    }
    document.getElementById("mess-email").innerHTML = message;
  });

  $("#sdt").keyup(function(){
    var sdt = $(this).val();
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var t = this.responseText;
        if (t == 0)
          document.getElementById("mess-sdt").innerHTML = "*Số điện thoại đã tồn tại !";
        else
          document.getElementById("mess-sdt").innerHTML = "";
      }
    };
    var str = "controllers/check_sdt.php?sdt=" + sdt;
    xhttp.open("GET", str, true);
    xhttp.send();
  });

  $("#cmnd").keyup(function(){
    var cmnd = $(this).val();
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var t = this.responseText;
        if (t == 0)
          document.getElementById("mess-cmnd").innerHTML = "*Số chứng minh đã tồn tại !";
        else
          document.getElementById("mess-cmnd").innerHTML = "";
      }
    };
    var str = "controllers/check_cmnd.php?cmnd=" + cmnd;
    xhttp.open("GET", str, true);
    xhttp.send();
  });

  $("#username").keyup(function(){
    var username = $(this).val();
    var message = "";
    if(username.length == 0){
      message =  "";
    }
    else if($.isNumeric(username.charAt(0))){
      message = "*Tên tài khoản phải bắt đầu bằng chữ !";
    }
    else if(!isAlphaNumberic(username)){
      message = "*Tài khoản không được chứa dấu, khoảng trắng và ký tự đặc biệt !";
    }
    else if(username.length < 5 || username.length > 30){
      message = "*Tài khoản phải từ 5-30 ký tự !";
    }
    else{
      var xhttp;
      xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var t = this.responseText;
          if (t == 0)
            document.getElementById("mess-username").innerHTML = "*Tài khoản đã tồn tại !";
          else
            document.getElementById("mess-username").innerHTML = "";
        }
        return;
      };
      var str = "controllers/check_username.php?username=" + username;
      xhttp.open("GET", str, true);
      xhttp.send();
    }
    document.getElementById("mess-username").innerHTML = message;
  });

  $("#pass").keyup(function(){
    var pass = $(this).val();
    var message = "";
    if(pass.length > 30)
      message = "*Mật khẩu dài tối đa 30 ký tự";
    document.getElementById("mess-pass").innerHTML = message;
  });

  $("#password").keyup(function(){
    var password = $(this).val();
    var pass = $("#pass").val();
    var message = "";
    if(pass != password)
      message = "*Mật khẩu nhập lại không đúng !";
    document.getElementById("mess-password").innerHTML = message;
  });

  $(".only-number").on("keypress keyup blur",function (event) {    
    $(this).val($(this).val().replace(/[^\d].+/, ""));
      if ((event.which < 48 || event.which > 57)) {
        event.preventDefault();
      }
  });

  // Các nút
  $("#btn-dangky-gs").click(function(){
    var messEmail = $("#mess-email").text().length;
    var messSDT = $("#mess-sdt").text().length;
    var messCMND = $("#mess-cmnd").text().length;
    var messUsername = $("#mess-username").text().length;
    var messPass = $("#mess-pass").text().length;
    var messPassword = $("#mess-password").text().length;

    if(messEmail + messSDT + messCMND + messUsername + messPass + messPassword == 0){
      var hovaten = $("#hovaten").val();
      var ngaysinh = $("#ngaysinh").val();
      var gioitinh = "";
      if(document.getElementById("radioNam").checked)
        gioitinh = $("#radioNam").val();
      else if(document.getElementById("radioNu").checked)
        gioitinh = $("#radioNu").val();
      var email = $("#email").val();
      var sdt = $("#sdt").val();
      var cmnd = $("#cmnd").val();
      var username = $("#username").val();
      var pass = $("#pass").val();
      var password = $("#password").val();

      if(hovaten.length*ngaysinh.length*gioitinh.length*email.length*sdt.length*cmnd.length*username.length*pass.length*password.length == 0)
        alert("ERROR: Không được để trống các trường");
      else{
        var xhttp;
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("notification").innerHTML = this.responseText;
          }
        };
        var str = "controllers/insert_gs.php?hovaten=" + hovaten + "&ngaysinh=" + ngaysinh +"&gioitinh=" + gioitinh + "&email=" + email + "&sdt=" + sdt + "&cmnd=" + cmnd  + "&username=" + username + "&password=" + password;
        xhttp.open("GET", str, true);
        xhttp.send();
      }
    }
    else alert("Còn trường nhập không hợp lệ !");
  });

  $("#btn-dangky-hv").click(function(){
    var messEmail = $("#mess-email").text().length;
    var messSDT = $("#mess-sdt").text().length;
    var messUsername = $("#mess-username").text().length;
    var messPass = $("#mess-pass").text().length;
    var messPassword = $("#mess-password").text().length;

    if(messEmail + messSDT + messUsername + messPass + messPassword == 0){
      var hovaten = $("#hovaten").val();
      var ngaysinh = $("#ngaysinh").val();
      var gioitinh = "";
      if(document.getElementById("radioNam").checked)
        gioitinh = $("#radioNam").val();
      else if(document.getElementById("radioNu").checked)
        gioitinh = $("#radioNu").val();
      var email = $("#email").val();
      var sdt = $("#sdt").val();
      var username = $("#username").val();
      var pass = $("#pass").val();
      var password = $("#password").val();

      if(hovaten.length*ngaysinh.length*gioitinh.length*email.length*sdt.length*username.length*pass.length*password.length == 0)
        alert("ERROR: Không được để trống các trường");
      else{
        var xhttp;
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("notification").innerHTML = this.responseText;
          }
        };
        var str = "controllers/insert_hv.php?hovaten=" + hovaten + "&ngaysinh=" + ngaysinh +"&gioitinh=" + gioitinh + "&email=" + email + "&sdt=" + sdt + "&username=" + username + "&password=" + password;
        xhttp.open("GET", str, true);
        xhttp.send();
      }
    }
    else alert("Còn trường nhập không hợp lệ !");
  });

  $("#btn-dangnhap").click(function(){
    var username = $("#taikhoan-dn").val();
    var password = $("#matkhau-dn").val();

    if(username.length == 0 || password.length == 0)
      alert('Vui lòng nhập đầy đủ !');
    else{
      var xhttp;
      xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var t = this.responseText;
          if(t == -1) alert("Gặp lỗi trong quá trình xử lý, vui lòng đăng nhập lại.");
          else if(t == 0) alert("Tài khoản hoặc mật khẩu không đúng !");
          else location.reload();
        }
      };
      var str = "controllers/login.php?username=" + username + "&password=" + password;
      xhttp.open("GET", str, true);
      xhttp.send();
    }
  });

  $("#btn-dangxuat").click(function(){
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200)
        location.reload();
    };
    xhttp.open("GET", "controllers/logout.php", true);
    xhttp.send();
  });

});



// My function
function isEmail(str) {
  const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(String(str).toLowerCase());
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

function isAlphaNumberic(str) {
  var pattern = /^[0-9a-zA-Z]+$/;
  if(!pattern.test(str))
    return false;
  else return true;
}

/* --- Các hàm Insert --- */
function insertMonDay(username) {
  var khoahoc = document.getElementById("khoahoc").value;
  var monhoc = document.getElementById("monhoc").value;
  var hocphi = document.getElementById("hocphi").value;
  if(khoahoc.length == 0 || monhoc.length == 0 || hocphi.length == 0){
    alert('Vui lòng không để trống các trường');
    return;
  }
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var t = this.responseText;
      if(t == -2) alert("ERROR: Server gặp lỗi trong quá trình xử lý !");
      else if(t == -1) alert("Dữ liệu không hợp lệ !");
      else if(t == 0) alert("Đã đăng ký môn này, vui lòng chọn môn khác !");
      else location.reload();
    }
  };
  var str = "controllers/insert_monday_gs.php?username=" + username + "&khoahoc=" + khoahoc + "&monhoc=" + monhoc + "&hocphi=" + hocphi;
  xhttp.open("GET", str, true);
  xhttp.send();
}

function insertTimGiaSu(username) {
  var khoahoc = document.getElementById("khoahoc").value;
  var monhoc = document.getElementById("monhoc").value;
  var monmoi = document.getElementById("monmoi").value;
  var noidung = document.getElementById("noidung").value;
  var hocphi = document.getElementById("hocphi").value;
  var thuhai = document.getElementById("thuhai").value;
  var thuba = document.getElementById("thuba").value;
  var thutu = document.getElementById("thutu").value;
  var thunam = document.getElementById("thunam").value;
  var thusau = document.getElementById("thusau").value;
  var thubay = document.getElementById("thubay").value;
  var chunhat = document.getElementById("chunhat").value;

  if(monmoi.length > 0){
    if(noidung.length*hocphi.length == 0){
      alert('Vui lòng không để trống Nội dung và Học phí');
      return;
    }
    if(noidung.length > 300 || monmoi > 100){
      alert('Nội dung hoặc môn học quá dài');
      return;
    }
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200){
        document.getElementById("notification").innerHTML = this.responseText;
      }
    };
    var str = "controllers/insert_baidang_tv.php?username=" + username + "&monhoc=" + monmoi + "&noidung=" + noidung + "&hocphi=" + hocphi;
    str += "&thuhai=" + thuhai + "&thuba=" + thuba + "&thutu=" + thutu + "&thunam=" + thunam + "&thusau=" + thusau + "&thubay=" + thubay + "&chunhat=" + chunhat;
    xhttp.open("GET", str, true);
    xhttp.send();
  }
  else if(khoahoc.length > 0 && monhoc.length > 0){
    if(noidung.length*hocphi.length == 0){
      alert('Vui lòng không để trống Nội dung và Học phí');
      return;
    }
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200){
        document.getElementById("notification").innerHTML = this.responseText;
      }
    };
    var str = "controllers/insert_baidang_tv.php?username=" + username + "&monhoc=" + monhoc + "&noidung=" + noidung + "&hocphi=" + hocphi;
    str += "&thuhai=" + thuhai + "&thuba=" + thuba + "&thutu=" + thutu + "&thunam=" + thunam + "&thusau=" + thusau + "&thubay=" + thubay + "&chunhat=" + chunhat;
    xhttp.open("GET", str, true);
    xhttp.send();
  }
  else alert('Bạn chưa chọn môn học');
}

function insertReview(username) {
  var noidung = document.getElementById("noidung").value;
  if(noidung.length == 0)
    alert('Vui lòng không để trống');
  else if(noidung.length > 300)
    alert('Nội dung quá dài');
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("notification").innerHTML = this.responseText;
    }
  };
  var str = "controllers/insert_review.php?username=" + username + "&noidung=" + noidung;
  xhttp.open("GET", str, true);
  xhttp.send();
}


/* --- Các hàm Update --- */
function updateSDT(username) {
  var sdt = document.getElementById("sdt").value;
  if(sdt.length == 0){
    return;
  }
  else{
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var t = this.responseText;
        if(t == -2) alert("ERROR: Server gặp lỗi trong quá trình xử lý !");
        else if(t == -1) alert("Số điện thoại không hợp lệ !");
        else if(t == 0) alert("Số điện thoại đã tồn tại !");
        else location.reload();
      }
    };
    xhttp.open("GET", "controllers/update_sdt.php?sdt=" + sdt + "&username=" + username, true);
    xhttp.send();
  }
}

function updateEmail(username) {
  var email = document.getElementById("email").value;
  if(email.length == 0){
    return;
  }
  else if(!isEmail(email)){
    alert("Email không hợp lệ !");
    return;
  }
  else{
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var t = this.responseText;
        if(t == -2) alert("ERROR: Server gặp lỗi trong quá trình xử lý !");
        else if(t == -1) alert("Email không hợp lệ !");
        else if(t == 0) alert("Email đã tồn tại !");
        else location.reload();
      }
    };
    xhttp.open("GET", "controllers/update_email.php?email=" + email + "&username=" + username, true);
    xhttp.send();
  }
}

function updateFB(username) {
  var fb = document.getElementById("fb").value;
  if(fb.length == 0){
    return;
  }
  else if(!isURL(fb)){
    alert("Đường link không hợp lệ !");
    return;
  }
  else{
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var t = this.responseText;
        if(t == -2) alert("ERROR: Server gặp lỗi trong quá trình xử lý !");
        else if(t == -1) alert("Đường link không hợp lệ !");
        else location.reload();
      }
    };
    xhttp.open("GET", "controllers/update_fb.php?fb=" + fb + "&username=" + username, true);
    xhttp.send();
  }
}

function updateMoTa(username) {
  var mota = document.getElementById("mota").value;
  if(mota.length == 0 || mota.length > 300)
    alert('Độ dài trường nhập không hợp lệ !');
  else{
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var t = this.responseText;
        if(t == -2) alert("ERROR: Server gặp lỗi trong quá trình xử lý !");
        else if(t == -1) alert("Mô tả không hợp lệ !");
        else location.reload();
      }
    };
    xhttp.open("GET", "controllers/update_mota_gs.php?mota=" + mota + "&username=" + username, true);
    xhttp.send();
  }
}

function updateWorkflow(username) {
  var linhvuc = document.getElementById("linhvuc").value;
  var chuyennganh = document.getElementById("chuyennganh").value;
  var hocvi = document.getElementById("hocvi").value;
  var noilamviec = document.getElementById("noilamviec").value;
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var t = this.responseText;
      if(t == -2) alert("ERROR: Server gặp lỗi trong quá trình xử lý !");
      else location.reload();
    }
  };
  var str = "controllers/update_workflow_gs.php?username=" + username + "&linhvuc=" + linhvuc + "&chuyennganh=" + chuyennganh + "&hocvi=" + hocvi + "&noilamviec=" + noilamviec;
  xhttp.open("GET", str, true);
  xhttp.send();
}

function updateThoiGianDay(username) {
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
      if(t == -2) alert("ERROR: Server gặp lỗi trong quá trình xử lý !");
      else location.reload();
    }
  };
  str = "controllers/update_thoigianday_gs.php?username=" + username + "&thuhai=" + thuhai + "&thuba=" + thuba + "&thutu=" + thutu + "&thunam=" + thunam + "&thusau=" + thusau + "&thubay=" + thubay + "&chunhat=" + chunhat;
  xhttp.open("GET", str, true);
  xhttp.send();
}

function updateCongViec(username) {
  var congviec = document.getElementById("congviec").value;
  if(congviec.length == 0)
    return;
  else{
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var t = this.responseText;
        if(t == -2) alert("ERROR: Server gặp lỗi trong quá trình xử lý !");
        else if(t == -1) alert("Công việc không hợp lệ !");
        else location.reload();
      }
    };
    xhttp.open("GET", "controllers/update_congviec_hv.php?congviec=" + congviec + "&username=" + username, true);
    xhttp.send();
  }
}

function updateBaiDang(id) {
  var hocphi = document.getElementById("hocphi-" + id).value;
  var noidung = document.getElementById("noidung-" + id).value;
  var thuhai = document.getElementById("thuhai-" + id).value;
  var thuba = document.getElementById("thuba-" + id).value;
  var thutu = document.getElementById("thutu-" + id).value;
  var thunam = document.getElementById("thunam-" + id).value;
  var thusau = document.getElementById("thusau-" + id).value;
  var thubay = document.getElementById("thubay-" + id).value;
  var chunhat = document.getElementById("chunhat-" + id).value;

  if(hocphi.length*noidung.length == 0)
    alert("Trường Nội dung và Học phí không được bỏ trống.");
  else if(noidung.length > 300)
    alert("Nội dung tối đa 300 ký tự.");
  else{
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var t = this.responseText;
        if(t == -2) alert("ERROR: Server gặp lỗi trong quá trình xử lý !");
        else if(t == -1) alert("Nội dung hoặc Học phí không hợp lệ !");
        else location.reload();
      }
    };
    var str = "controllers/update_baidang_hv?id=" + id + "&noidung=" + noidung + "&hocphi=" + hocphi;
    str += "&thuhai=" + thuhai + "&thuba=" + thuba + "&thutu=" + thutu + "&thunam=" + thunam + "&thusau=" + thusau + "&thubay=" + thubay + "&chunhat=" + chunhat;
    xhttp.open("GET", str, true);
    xhttp.send();
  }
}

function updateReview(username) {
  var noidung = document.getElementById("noidung").value;
  if(noidung.length == 0 || noidung.length > 300)
    alert('Độ dài trường nhập không hợp lệ !');
  else{
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var t = this.responseText;
        if(t == -2) alert("ERROR: Server gặp lỗi trong quá trình xử lý !");
        else if(t == -1) alert("Mô tả không hợp lệ !");
        else location.reload();
      }
    };
    xhttp.open("GET", "controllers/update_review.php?noidung=" + noidung + "&username=" + username, true);
    xhttp.send();
  }
}

/* --- Các hàm Delete --- */
function deleteMonDay(obj) {
  var id = obj.getAttribute("data-id");
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var t = this.responseText;
      if(t == -2) alert("ERROR: Server gặp lỗi trong quá trình xử lý !");
      else location.reload();
    }
  };
  xhttp.open("GET", "controllers/delete_monday_gs.php?id=" + id, true);
  xhttp.send();
}

function deleteBaiDang(obj) {
  var id = obj.getAttribute("data-id");
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var t = this.responseText;
      if(t == -2) alert("ERROR: Server gặp lỗi trong quá trình xử lý !");
      else location.reload();
    }
  };
  xhttp.open("GET", "controllers/delete_baidang_hv.php?id=" + id, true);
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
      $("#monhoc").empty().append('<option value="">-- Chọn môn --</option>');
      $("#monhoc").append('<option value="Giải Tích">Giải Tích</option>');
      $("#monhoc").append('<option value="Đại Số Tuyến Tính">Đại Số Tuyến Tính</option>');
      $("#monhoc").append('<option value="Cấu Trúc Rời Rạc">Cấu Trúc Rời Rạc</option>');
      $("#monhoc").append('<option value="Xác Suất Thống Kê">Xác Suất Thống Kê</option>');
      $("#monhoc").append('<option value="Nhập Môn Mạch Số">Nhập Môn Mạch Số</option>');
      $("#monhoc").append('<option value="Nhập Môn Điện Tử">Nhập Môn Điện Tử</option>');
      $("#monhoc").append('<option value="Phân Tích Và Thiết Kế Thuật Toán">Phân Tích Và Thiết Kế Thuật Toán</option>');
      break;
    case 'Lập Trình Căn Bản':
      $("#monhoc").empty().append('<option value="">-- Chọn môn --</option>');
      $("#monhoc").append('<option value="Nhập Môn Lập Trình">Nhập Môn Lập Trình</option>');
      $("#monhoc").append('<option value="Kỹ Thuật Lập Trình">Kỹ Thuật Lập Trình</option>');
      $("#monhoc").append('<option value="Cấu Trúc Dữ Liệu Và Giải Thuật">Cấu Trúc Dữ Liệu Và Giải Thuật</option>');
      $("#monhoc").append('<option value="Lập Trình Hướng Đối Tượng">Lập Trình Hướng Đối Tượng</option>');
      $("#monhoc").append('<option value="Cơ Sở Dữ Liệu">Cơ Sở Dữ Liệu</option>');
      $("#monhoc").append('<option value="Nhập Môn Mạng Máy Tính">Nhập Môn Mạng Máy Tính</option>');
      $("#monhoc").append('<option value="Hệ Điều Hành">Hệ Điều Hành</option>');
      break;
    case 'Lập Trình Web':
    $("#monhoc").empty().append('<option value="">-- Chọn môn --</option>');
      $("#monhoc").append('<option value="HTML-CSS">HTML-CSS</option>');
      $("#monhoc").append('<option value="PHP">PHP</option>');
      $("#monhoc").append('<option value="Node.js">Node.js</option>');
      $("#monhoc").append('<option value="JavaScript">JavaScript</option>');
      $("#monhoc").append('<option value="jQuery">jQuery</option>');
      $("#monhoc").append('<option value="AJAX">AJAX</option>');
      $("#monhoc").append('<option value="JSON">JSON</option>');
      $("#monhoc").append('<option value="React">React</option>');
      $("#monhoc").append('<option value="Vue.js">Vue.js</option>');
      $("#monhoc").append('<option value="Ruby on Rails">Ruby on Rails</option>');
      $("#monhoc").append('<option value="Bootstrap">Bootstrap</option>');
      $("#monhoc").append('<option value="AngularJS">AngularJS</option>');
      $("#monhoc").append('<option value="Laravel">Laravel</option>');
      $("#monhoc").append('<option value="ASP.NET">ASP.NET</option>');
      break;
    case 'Lập Trình Mobile':
      $("#monhoc").empty().append('<option value="">-- Chọn môn --</option>');
      $("#monhoc").append('<option value="Lập trình Mobile với">Lập trình Mobile với Java</option>');
      $("#monhoc").append('<option value="React Native">React Native</option>');
      $("#monhoc").append('<option value="Flutter">Flutter</option>');
      $("#monhoc").append('<option value="Ionic">Ionic</option>');
      $("#monhoc").append('<option value="Native Android">Native Android</option>');
      $("#monhoc").append('<option value="Xamarin">Xamarin</option>');
      $("#monhoc").append('<option value="NativeScript">NativeScript</option>');
      $("#monhoc").append('<option value="jQuery Mobile">jQuery Mobile</option>');
      $("#monhoc").append('<option value="Framework7">Framework7</option>');
      $("#monhoc").append('<option value="Realm">Realm</option>');
      $("#monhoc").append('<option value="Retrofit">Retrofit</option>');
      $("#monhoc").append('<option value="Picasso">Picasso</option>');
      $("#monhoc").append('<option value="Glide">Glide</option>');
      $("#monhoc").append('<option value="Zxing">Zxing</option>');
      $("#monhoc").append('<option value="Stetho">Stetho</option>');
      $("#monhoc").append('<option value="Espresso">Espresso</option>');
      break;
    case 'Lập Trình Game':
      $("#monhoc").empty().append('<option value="">-- Chọn môn --</option>');
      $("#monhoc").append('<option value="Lập Trình Game Với Unity3D">Lập Trình Game Với Unity3D</option>');
      $("#monhoc").append('<option value="Lập Trình Game Trong Thiết Bị Di Động">Lập Trình Game Trong Thiết Bị Di Động</option>');
      $("#monhoc").append('<option value="Kỹ Thuật DirectX">Kỹ Thuật DirectX</option>');
      $("#monhoc").append('<option value="Thiết Kế 3D Game Engine">Thiết Kế 3D Game Engine</option>');
      $("#monhoc").append('<option value="Đồ Họa Game">Đồ Họa Game</option>');
      break;
    case 'Lập Trình Hệ Thống':
      $("#monhoc").empty().append('<option value="">-- Chọn môn --</option>');
      $("#monhoc").append('<option value="Hệ Quản Trị Cơ Sở Dữ Liệu">Hệ Quản Trị Cơ Sở Dữ Liệu</option>');
      $("#monhoc").append('<option value="Hệ Thống Thông Tin Quản Lý">Hệ Thống Thông Tin Quản Lý</option>');
      $("#monhoc").append('<option value="Cơ Sở Dữ Liệu Phân Tán">Cơ Sở Dữ Liệu Phân Tán</option>');
      $("#monhoc").append('<option value="Khai Thác Dữ Liệu">Khai Thác Dữ Liệu</option>');
      $("#monhoc").append('<option value="Kho Dữ Liệu Và OLAP">Kho Dữ Liệu Và OLAP</option>');
      $("#monhoc").append('<option value="Hệ Hỗ Trợ Ra Quyết Định">Hệ Hỗ Trợ Ra Quyết Định</option>');
      $("#monhoc").append('<option value="Điện Toán Đám Mây">Điện Toán Đám Mây</option>');
      $("#monhoc").append('<option value="Big Data">Big Data</option>');
      break;
    case 'Tin Học Văn Phòng':
      $("#monhoc").empty().append('<option value="">-- Chọn môn --</option>');
      $("#monhoc").append('<option value="Word">Word</option>');
      $("#monhoc").append('<option value="Excel">Excel</option>');
      $("#monhoc").append('<option value="PowerPoint">PowerPoint</option>');
      break;
    default:
      $("#monhoc").empty().append('<option value="">-- Chọn môn --</option>');
  }
}