<?
session_start();
if(!$_SESSION[users]){
die();
}
$users = $_SESSION[users];
$user = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM users WHERE email='$users'"));
$listdv1 = mysqli_query($conn,"SELECT * FROM dichvu");
$dv2 = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM dichvu"))
?>
<script>

function thanhtoan(){
			var soluong = $('#soluong').val();
			var dichvu = $('#dichvu').val();
			if(soluong < 1){
				toarst("error","Vui Lòng Mua Ít Nhất 1 Sản Phẩm","Thông Báo");
				return;
			}
			if (soluong == '') {
				toarst("error","Vui Lòng Nhập Đầy Đủ Thông Tin.","Thông Báo");
				return false;
			}
<? 		
	$listdv2 = mysqli_query($conn,"SELECT * FROM dichvu");
while($dv3 = mysqli_fetch_array($listdv2)){
$soitem3 = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM item WHERE dichvu='".$dv3[id]."'"));
echo 'if(dichvu == '.$dv3[id].' && soluong > '.$soitem3.'){
				toarst("error","Hệ Thống Không Đủ Sản Phẩm","Thông Báo");

				return;
			}';
}
?>
			$('#submitz').prop('disabled', true).addClass('btn btn-info').html('ĐANG XỬ LÝ...');
			$.post('/private/mua-san-pham.php', {
			soluong: soluong,
			dichvu:dichvu
			}, function(data, status) {
			$("#mess").html(data);
			$('#submitz').prop('disabled', false).removeClass('btn btn-info').addClass('btn btn-primary').html('MUA THÀNH CÔNG!');
			});
			}
function tinhtien(){
var soluong = $('#soluong').val();
var dichvu = $('#dichvu').val();
var soitem = $('#soitem').val();
if(soluong == ""){
$("#submitz").css("display","none");
}
<? 			
while($dv1 = mysqli_fetch_array($listdv1)){
$soitem1 = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM item WHERE dichvu='".$dv1[id]."'"));
echo 'if(dichvu == '.$dv1[id].' && soluong > '.$soitem1.'){
				toarst("error","Hệ Thống Không Đủ Sản Phẩm","Thông Báo");

				return;
			}
if(dichvu == '.$dv1[id].'){
			var gia = '.$dv1[gia].';

            }
';
}
echo 'var tien = gia * soluong;
			var vnd = '.$user[tien].';
			if(tien > vnd){
				toarst("error","Vui Lòng Nạp Thêm Tiền Để Mua","Thông Báo"); 
			}else{
$("#submitz").removeClass("disabled");
$("#submitz").css("display","block");
}
if(dichvu !== "0" ){
$("#tongthanhtoan").html(tien);
}
';
?>
}
</script>
<div class="container">
<br />

<div class="row">
<!-- col -->
<div class="col-sm-6">
<div class="card bg-secondary mb-3" style="max-width: 200rem;">
  <div class="card-header text-center"> <b>PROFILE INFOMATION</b> </div>
  <div class="card-body text-center">
     <b style="">User ID: <code><? echo $user[id] ?></code></b> | <b style="">Password <code><? echo $user[pass] ?></code></b><hr/>
      Bạn đang có: <code class="rain"><? echo number_format($user[tien]) ?>.VNĐ</code><hr/>
      <b class=""><a href="/dang-xuat.php" >Bạn muốn đăng xuất ?</a></b>
  </div>
</div>
<!-- col 2 -->
<div class="card bg-secondary mb-3" style="max-width: 200rem;">
  <div class="card-header text-center"> <b> DỊCH VỤ CỦA CHÚNG TÔI </b> </div>
  <div class="card-body text-center">
      <? $checkdv = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM dichvu")); 
if($checkdv < 1){

echo ' <h3 class="rain">CHƯA CÓ DỊCH VỤ</h3> ';
} else {

echo '<select name="dichvu" id="dichvu" class="form-control input-lg text-center" required="required">
                        ';
$listdv = mysqli_query($conn,"SELECT * FROM dichvu");
while($dv = mysqli_fetch_array($listdv)){
$soitem = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM item WHERE dichvu='".$dv[id]."'"));
echo '<option value="'.$dv[id].'">'.$dv[ten].' (<b id="soitem">'.$soitem.'</b>)</option>';
  }
echo '</select>';
?>
<br/>
<div class="form-group">                   
                    <input type="number" oninput="tinhtien()" class="form-control input-lg" name="soluong" id="soluong" placeholder="Nhập số lượng"> </div>
<div class="form-group">
                    <button style="display:block" type="button" onclick="thanhtoan()" id="submitz" class="btn btn-block btn-success disabled" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Đang xử lý, xin chờ..." >THANH TOÁN - <b style="color:red" id="tongthanhtoan">0</b>.đ</button>
                </div>
<?
}
?>
<div id="mess"></div>
  </div>
</div>

</div>

<div class="col-sm-6">
<div class="card bg-secondary mb-3" style="max-width: 200rem;">
  <div class="card-header text-center"> <b>NẠP TIỀN BẰNG THẺ ĐIỆN THOẠI</b> </div>
  <div class="card-body">
       <div class="form-group">
                    <label for="menhgia">Loại thẻ</label>
                    <select name="loaithe" id="loaithe" class="form-control input-lg" required="required">
                        <option value="0" selected="selected">- Chọn loại thẻ -</option>
                        <option value="VIETTEL">Viettel</option>
                        <option value="VINAPHONE">Vinaphone</option>
                        <option value="MOBIFONE">Mobifone</option>
                       <option value="ZING">Zing</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="menhgia">Mệnh giá thẻ</label>
                    <select name="menhgia" id="menhgia" class="form-control input-lg" required="required">
                        <option >- Chọn mệnh giá -</option>
                        
                        <option value="10000">10,000 VND</option>
                        <option value="20000">20,000 VND</option>
                        <option value="50000">50,000 VND</option>
                        <option value="100000">100,000 VND</option>
                        <option value="200000">200,000 VND </option>
                        <option value="300000">300,000 VND </option>
                        <option value="500000">500,000 VND</option>
                        <option value="1000000">1,000,000 VND </option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="seri">Số Seri:</label>
                    <input type="text" class="form-control input-lg" name="seri" id="seri" placeholder="Nhập số seri in trên thẻ..."> </div>
                <div class="form-group">
                    <label for="mathe">Mã thẻ:</label>
                    <input type="text" class="form-control input-lg" name="mathe" id="mathe" placeholder="Nhập mã thẻ cào..."> </div>
                <div class="form-group" style="text-align: center;"> </div>
                <div class="form-group">
                    <button type="submit" onclick="naptien()" id="napthe" class="btn btn-block btn-warning" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Đang xử lý, xin chờ..." >NẠP THẺ</button>
                </div>
                <div style="display:none" class="error-msg alert alert-danger hide" style="text-align: center;"></div>
                <div id="result" style="text-align: center;"></div>
  </div>
</div>
</div>
<!-- col -->
<div class="col-sm-6">
<div class="card bg-secondary mb-3" style="max-width: 200rem;">
  <div class="card-header text-center"> <b>LỊCH SỬ MUA HÀNG</b> </div>
  <div class="card-body text-center">
     
<div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">

                        <thead>
                            <tr>

                                <th>
                                    <center>Dịch Vụ</center>
                                </th>
                                <th>
                                    <center>Số Lượng</center>
                                </th>
                                <th>
                                    <center>Số Tiền (đ)</center>
                                </th>
                                <th>
                                    <center>Hành Động</center>
                                </th>

                            </tr>
                        </thead>
                        <tbody>
<?
$lsmua = mysqli_query($conn,"SELECT * FROM mualog WHERE email='".$_SESSION[users]."' LIMIT 0,7");
while($lsmua1=mysqli_fetch_array($lsmua)){
$laydv = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM dichvu WHERE id='".$lsmua1[dichvu]."'"));
echo '
<tr>

                                <th>
                                    <center><b>'.$laydv[ten].'</b></center>
                                </th>
                                <th>                              <center>'.$lsmua1[soluong].'</center>
                                </th>                                
                                <th>
                                    <center>'.number_format($lsmua1[tien]).'</center>
                                </th>                                
                                <th>
                                    <center><a href="/xem-san-pham.php?time='.$lsmua1[time].'" class="badge badge-pill badge-danger">Xem Ngay</a>
</center>
                                </th>


                            </tr>
';

}
?>
                                                    </tbody>
                    </table>
                </div>

  </div>
</div></div>
    <!-- col -->
<div class="col-sm-6">
<div class="card bg-secondary mb-3" style="max-width: 200rem;">
  <div class="card-header text-center"> <b>LỊCH SỬ NẠP TIỀN</b> </div>
  <div class="card-body text-center">
     
<div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">

                        <thead>
                            <tr>

                                <th>
                                    <center>Mã Thẻ</center>
                                </th>
                                <th>
                                    <center>Serial</center>
                                </th>
                                <th>
                                    <center>Mệnh Giá (đ)</center>
                                </th>
                                <th>
                                    <center>Trạng Thái</center>
                                </th>

                            </tr>
                        </thead>
                        <tbody>
<?
$lsnap = mysqli_query($conn,"SELECT * FROM naptien WHERE email='".$_SESSION[users]."' AND trangthai='0' OR email='".$_SESSION[users]."' AND trangthai='99 '");
while($lsnap1=mysqli_fetch_array($lsnap)){
echo '
<tr>

                                <th>
                                    <center><b>'.$lsnap1[code].'</b></center>
                                </th>
                                <th>                              <center>'.$lsnap1[serial].'</center>
                                </th>                                
                                <th>
                                    <center>'.number_format($lsnap1[vnd]).'</center>
                                </th>                                
                                <th>
                                    <center><span class="badge badge-pill badge-primary">'.$lsnap1[msg].'</span>
</center>
                                </th>


                            </tr>
';

}
?>                                                    </tbody>
                    </table>
                </div>

  </div>
</div>
<!-- end col -->

</div>
<div id="return"></div>


</div>

<script>
document.addEventListener("DOMContentLoaded", function(event) {
      Swal.fire(
  'THÔNG BÁO!',
  'Bạn nhớ <b>lưu lại</b> sản phẩm nhé. Hệ thống sẽ <b> tự động xoá </b>trong 3 ngày',
  'success'
);
});
</script>
<script src="/assets/js/naptien.js">
</script>
