<?php
	require_once('models/data_access_helper.php');

	// Create an instance of data access helper
	$db = new DataAccessHelper();

	// Connect to database
	$db->connect();

	$username = $_SESSION['username'];

	// Lấy dữ liệu
	$sql = "SELECT * FROM baidang WHERE Username = '$username'";
	$result = $db->executeQuery($sql);
	
	if($result){
		while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
			echo '<div class="modal fade" id="nd'. $row['Id'] .'">';
    		echo '<div class="modal-dialog modal-lg">';
      		echo '<div class="modal-content">';
        	echo '<div class="modal-header">';
          	echo '<h4 class="modal-title">Chi tiết nội dung :</h4>';
          	echo '<button type="button" class="close" data-dismiss="modal">×</button>';
          	echo '</div>';
        	echo '<div class="modal-body">';
          	echo '<p>'. $row['NoiDung'] .'</p>';
        	echo '</div></div></div></div>';

        	echo '<div class="modal fade" id="update'. $row['Id'] .'">';
    		echo '<div class="modal-dialog modal-lg">';
      		echo '<div class="modal-content">';
        	echo '<div class="modal-header">';
          	echo '<h4 class="modal-title">Chỉnh sửa chi tiết</h4>';
          	echo '<button type="button" class="close" data-dismiss="modal">×</button>';
        	echo '</div>';
        	echo '<div class="modal-body">';
	        	echo '<div class="input-group mb-3">';
	      		echo '<div class="input-group-prepend">';
	        	echo '<span class="input-group-text"><strong>Môn học :</strong></span>';
	      		echo '</div>';
	      		echo '<input class="form-control" id="monhoc-'. $row['Id'] .'" value="'. $row['MonHoc'] .'" readonly>';
	    		echo '</div>';

	    		echo '<div class="input-group mb-2">';
	      		echo '<div class="input-group-prepend">';
	        	echo '<span class="input-group-text"><strong>Học phí :</strong></span>';
	      		echo '</div>';
	      		echo '<input class="form-control only-number" id="hocphi-'. $row['Id'] .'" value="'. $row['HocPhi'] .'">';
	    		echo '</div>';

	    		echo '<div class="form-group mb-0">';
      			echo '<label class="ml-2" for="noidung-'. $row['Id'] .'"><strong>Nội dung :</strong></label>';
      			echo '<textarea class="form-control" rows="3" width="100%" id="noidung-'. $row['Id'] .'">'. $row['NoiDung'] .'</textarea>';
    			echo '</div>';

    			echo '<div class="ml-2 mb-1 mt-1" style="text-align:left"><strong>Thời gian học : </strong></div>';
    			echo '<div class="container">';
    			require('display_thoigianhoc_hv.php');
    			echo '<div class="input-group mb-3 mt-2">
	    			<div class="input-group-prepend">
	    			<span class="input-group-text"><strong>Thứ hai:</strong></span>
	    			</div>
	    			<select class="form-control" id="thuhai-'. $row['Id'] .'" name="thuhai">
	    			<option value="0">-- Chọn thời gian --</option>
	    			<option value="1">Sáng (8h00 - 11h00)</option>
	    			<option value="2">Chiều (15h00 - 18h00)</option>
	    			<option value="3">Tối (18h00 - 21h00)</option>
	    			<option value="12">Sáng + Chiều</option>
	    			<option value="13">Sáng + Tối</option>
	    			<option value="23">Chiều + Tối</option>
	    			<option value="123">Sáng + Chiều + Tối</option>
	    			<option value="0">Không học</option>
	    			</select>
	    			</div>
	    			<div class="input-group mb-3">
	    			<div class="input-group-prepend">
	    			<span class="input-group-text"><strong>Thứ ba:</strong></span>
	    			</div>
	    			<select class="form-control" id="thuba-'. $row['Id'] .'" name="thuba">
	    			<option value="0">-- Chọn thời gian --</option>
	    			<option value="1">Sáng (8h00 - 11h00)</option>
	    			<option value="2">Chiều (15h00 - 18h00)</option>
	    			<option value="3">Tối (18h00 - 21h00)</option>
	    			<option value="12">Sáng + Chiều</option>
	    			<option value="13">Sáng + Tối</option>
	    			<option value="23">Chiều + Tối</option>
	    			<option value="123">Sáng + Chiều + Tối</option>
	    			<option value="0">Không học</option>
	    			</select>
	    			</div>
	    			<div class="input-group mb-3">
	    			<div class="input-group-prepend">
	    			<span class="input-group-text"><strong>Thứ tư:</strong></span>
	    			</div>
	    			<select class="form-control" id="thutu-'. $row['Id'] .'" name="thutu">
	    			<option value="0">-- Chọn thời gian --</option>
	    			<option value="1">Sáng (8h00 - 11h00)</option>
	    			<option value="2">Chiều (15h00 - 18h00)</option>
	    			<option value="3">Tối (18h00 - 21h00)</option>
	    			<option value="12">Sáng + Chiều</option>
	    			<option value="13">Sáng + Tối</option>
	    			<option value="23">Chiều + Tối</option>
	    			<option value="123">Sáng + Chiều + Tối</option>
	    			<option value="0">Không học</option>
	    			</select>
	    			</div>
	    			<div class="input-group mb-3">
	    			<div class="input-group-prepend">
	    			<span class="input-group-text"><strong>Thứ năm:</strong></span>
	    			</div>
	    			<select class="form-control" id="thunam-'. $row['Id'] .'" name="thunam">
	    			<option value="0">-- Chọn thời gian --</option>
	    			<option value="1">Sáng (8h00 - 11h00)</option>
	    			<option value="2">Chiều (15h00 - 18h00)</option>
	    			<option value="3">Tối (18h00 - 21h00)</option>
	    			<option value="12">Sáng + Chiều</option>
	    			<option value="13">Sáng + Tối</option>
	    			<option value="23">Chiều + Tối</option>
	    			<option value="123">Sáng + Chiều + Tối</option>
	    			<option value="0">Không học</option>
	    			</select>
	    			</div>
	    			<div class="input-group mb-3">
	    			<div class="input-group-prepend">
	    			<span class="input-group-text"><strong>Thứ sáu:</strong></span>
	    			</div>
	    			<select class="form-control" id="thusau-'. $row['Id'] .'" name="thusau">
	    			<option value="0">-- Chọn thời gian --</option>
	    			<option value="1">Sáng (8h00 - 11h00)</option>
	    			<option value="2">Chiều (15h00 - 18h00)</option>
	    			<option value="3">Tối (18h00 - 21h00)</option>
	    			<option value="12">Sáng + Chiều</option>
	    			<option value="13">Sáng + Tối</option>
	    			<option value="23">Chiều + Tối</option>
	    			<option value="123">Sáng + Chiều + Tối</option>
	    			<option value="0">Không học</option>
	    			</select>
	    			</div>
	    			<div class="input-group mb-3">
	    			<div class="input-group-prepend">
	    			<span class="input-group-text"><strong>Thứ bảy:</strong></span>
	    			</div>
	    			<select class="form-control" id="thubay-'. $row['Id'] .'" name="thubay">
	    			<option value="0">-- Chọn thời gian --</option>
	    			<option value="1">Sáng (8h00 - 11h00)</option>
	    			<option value="2">Chiều (15h00 - 18h00)</option>
	    			<option value="3">Tối (18h00 - 21h00)</option>
	    			<option value="12">Sáng + Chiều</option>
	    			<option value="13">Sáng + Tối</option>
	    			<option value="23">Chiều + Tối</option>
	    			<option value="123">Sáng + Chiều + Tối</option>
	    			<option value="0">Không học</option>
	    			</select>
	    			</div>
	    			<div class="input-group">
	    			<div class="input-group-prepend">
	    			<span class="input-group-text"><strong>Chủ nhật:</strong></span>
	    			</div>
	    			<select class="form-control" id="chunhat-'. $row['Id'] .'" name="chunhat">
	    			<option value="0">-- Chọn thời gian --</option>
	    			<option value="1">Sáng (8h00 - 11h00)</option>
	    			<option value="2">Chiều (15h00 - 18h00)</option>
	    			<option value="3">Tối (18h00 - 21h00)</option>
	    			<option value="12">Sáng + Chiều</option>
	    			<option value="13">Sáng + Tối</option>
	    			<option value="23">Chiều + Tối</option>
	    			<option value="123">Sáng + Chiều + Tối</option>
	    			<option value="0">Không học</option>
	    			</select>
	    			</div>';
	    		echo '</div>';
    		echo '</div>';

    		echo '<div class="modal-footer p-8 m-0">';
          	echo '<button class="btn-phd btn-phd-pC" onclick="updateBaiDang('. $row['Id'] .')">Cập nhật</button>';
        	echo '</div>';

        	echo '</div></div></div>';
		}
	}

	$db->close();
?>