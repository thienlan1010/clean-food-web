<?php
session_start();
//kiểm tra xem giohang có chưa, nếu chưa tạo nó = rỗng
if(!isset($_SESSION['giohang'])) $_SESSION['giohang']=[];


ob_start();
include "model/thuvien.php";
include "model/user.php";
include "model/donhang.php";
include "model/quantri.php";
include "model/customer.php";
include "model/employee.php";
include "model/hoadon.php";
include "model/ors_model.php";


require_once "phpqrcode/qrlib.php"; // Đường dẫn đến qrlib.php


//gọi hàm connection
ketnoidb();
//lấy all danh mục
$dsdm=getall_dm();

if(isset($_GET['act'])){//nếu tồn tại biên này thì kiểm tra
         $act=$_GET['act'];
    switch ($act) {
        case 'gioithieu':
            include "view/header.php";
            include "view/gioithieu.php";
            include "view/footer.php";
            break;
        case 'lienhe':
            include "view/header.php";
            include "view/lienhe.php";
            include "view/footer.php";
            break;
        case 'gioithieu':
            include "view/header.php";
            include "view/gioithieu.php";
            include "view/footer.php";
            break;
        case 'dangki':
            include "view/header.php";
            include "view/dangki.php";
            include "view/footer.php";
            break;
        case 'dangnhap':
            include "view/header.php";
            include "view/dangnhap.php";
            include "view/footer.php";
            break;
        case 'quyche':
            include "view/header.php";
            include "view/quyche.php";
            include "view/footer.php";
            break;
        case 'chitiet':
            
            include "view/header.php";
                if (isset($_GET['msp']) && ($_GET['msp'] > 0)) {//lấy masp trên trình duyệt
                    $id = $_GET['msp'];
                    // Lấy thông tin chi tiết sản phẩm dựa trên ID
                    $spct = getall_detail_product($id);
                    // Cập nhật lượt xem cho sản phẩm
                    update_view_count($id);

                    if ($spct) {
                        // Lấy sản phẩm liên quan
                        $related_products = get_related_products($spct['DM_MADM'], $id);

                        // Truyền dữ liệu vào trang chi tiết sản phẩm
                        $reviews = get_3_danhgia($id);
                        $dinhduong = get_dinhduong($id);
                        $thetrang = get_thetrang_phuhop($id);
                        include "view/sanpham-chitiet.php";

                    }}
                    include "view/footer.php";
            break;

        case 'sanpham':
            include "view/header.php";
            //lấy id trên link trình duyệt
            if(isset($_GET['id'])&&($_GET['id']>0)){
                $id=$_GET['id'];
            }
            
            $name_dm=get_name_dm($id);
            $dssp=getall_product($id);//lấy tất cả sp
            include "view/sanpham.php";
            include "view/footer.php";
            break;

        case 'xulu-dangki': // gom chung luôn GET (show form) và POST (xử lý form)
           include "view/header.php";
                if (isset($_POST['dangki']) && $_POST['dangki']) {//kiem tra nút dang ki có nhấn hay chưa
                    // Lấy dữ liệu từ form
                    $name = $_POST['name'];
                    $email = $_POST['email'];
                    $address = $_POST['address'];
                    $username = $_POST['user'];
                    $password = $_POST['pass'];
                    $sdt = $_POST['phone'];     

                    // Kiểm tra tên đăng nhập có tồn tại hay không
                    if (check_username_login($username)) {
                        echo "<script>alert('Tên đăng nhập đã tồn tại. Vui lòng chọn tên khác.');
                                     window.history.back();
                                    </script>";
                    }else if (strlen($password) != 8) { // Kiểm tra mật khẩu đúng 8 kí tự
                        echo "<script>alert('Mật khẩu phải chứa đúng 8 ký tự.');
                                window.history.back();</script>";
                    } else if(check_email_exists($email)){//check email tồn tại
                        echo "<script>alert('Email đã tồn tại. Vui lòng chọn email khác.');
                                    window.history.back();</script>";
                    }else if (!is_numeric($sdt)) { // Kiểm tra số điện thoại là số
                        echo "<script>alert('Số điện thoại phải là số. Vui lòng nhập lại.');
                                window.history.back();</script>";
                    }else{
                        $tk_id = register_user($username, $password);
                        insert_customer_info($tk_id, $name, $email, $sdt, $address);    

                        echo "<script>
                                alert('Đăng ký thành công!');
                                window.location.href = 'index.php?act=dangnhap';
                            </script>";
                        exit;

                                  
                       
                    }
                }
               
                break;

            case 'login':
                include "view/header.php";
                 // ✅ Thêm thông báo nếu là truy cập từ hành động "đặt hàng mà chưa đăng nhập"
                if (isset($_POST['dangdat']) && $_POST['dangdat'] == 1) {
                        echo "<script>alert('Cần đăng nhập để mua hàng!');
                         window.location.href = 'index.php?act=dangnhap';</script>";
                        exit;
                    }

                    // ✅ Xử lý đăng nhập nếu người dùng nhấn nút đăng nhập
                if (isset($_POST['login']) && ($_POST['login'])) { // Kiểm tra nếu form được submit
                    $user = $_POST['user'];
                    $pass = $_POST['pass'];
                    $kq = get_user_info($user, $pass); // return ve người login

                    if (!empty($kq)) { // Kiểm tra xem người dùng có tồn tại không (kiểm tra xem kq trả vè có trống hay không)
                        $role = $kq[0]['TK_VAITRO'];//return cột ROLE xem là admin or customer

                        if ($role == 2) { // Nếu là admin
                            $_SESSION['ROLE'] = $role;
                            //mới thêm 2 dòng dưới này
                            $_SESSION['id_admin'] = $kq[0]['TK_ID'];
                            $_SESSION['name_admin'] = $kq[0]['TK_TENDANGNHAP'];
                            header('Location: index.php?act=admin'); // Chuyển hướng tới trang admin
                        } else if($role == 0){ //nếu là nhân viên giao hàng
                            $_SESSION['ROLE'] = $role;
                            //mới thêm 2 dòng dưới này
                            $_SESSION['id_nv'] = $kq[0]['TK_ID'];
                            $_SESSION['name_nv'] = $kq[0]['TK_TENDANGNHAP'];
                            header('Location: index.php?act=nhanvien'); // Chuyển hướng tới trang admin
                        }else { // Nếu là người dùng bình thường
                            $_SESSION['ROLE'] = $role;
                            $_SESSION['iduser'] = $kq[0]['TK_ID'];
                            $_SESSION['username'] = $kq[0]['TK_TENDANGNHAP'];

                            //Lấy mã khách hàng từ ID tài khoản đã đănh nhập
                            $makh = get_customer_id_from_account($_SESSION['iduser']);
                            $_SESSION['idcustomer'] = $makh;//đây là mã kh đăng nhập thành công

                            //lấy id giỏ hàng
                            $idgh = get_giohang_chua_dat($makh);
                            $slsp = count_sp_gh($idgh);
                            $_SESSION['slsp'] = $slsp;

                            header('Location: index.php?act=luu_giohang'); // Chuyển hướng tới trang chính
                            exit();
                        }
                    } else {
                        // Nếu không tìm thấy thông tin tài khoản
                        $txt = "Username hoặc Password không hợp lệ";

                    }

                    

                }
                include "view/dangnhap.php";
                include "view/footer.php";
                break;

                case 'luu_giohang':
                    include "view/header.php";
                    echo '
                        <script>
                            // Nếu sessionStorage có giỏ hàng thì gửi nó đến server bằng form tự động
                            const data = sessionStorage.getItem("giohang");
                            if (data) {
                                const form = document.createElement("form");
                                form.method = "POST";
                                form.action = "index.php?act=luu_giohang_xuly";

                                const input = document.createElement("input");
                                input.type = "hidden";
                                input.name = "data_giohang";
                                input.value = data;

                                form.appendChild(input);
                                document.body.appendChild(form);
                                form.submit();
                            } else {
                                window.location.href = "index.php"; // Nếu không có thì quay lại trang chủ
                            }
                        </script>';
                    include "view/footer.php";
                    break;

                case 'luu_giohang_xuly':
                    if (isset($_SESSION['idcustomer']) && isset($_POST['data_giohang'])) {
                        $giohang = json_decode($_POST['data_giohang'], true);
                        $idgh = get_giohang_chua_dat($_SESSION['idcustomer']);
                        if (!$idgh) {//chưa có giỏ hàng hoặc đã đặt rồi -> tạo giỏ hàng mới
                            $idgh = tao_giohang($_SESSION['idcustomer']);
                        }
                      

                        foreach ($giohang as $sp) {
                            themChiTietGioHang($idgh, $sp[0], $sp[4], $sp[2]); // (GH_ID, MASP, SOLUONG, GIA)
                        }
                            
                            $slsp = count_sp_gh($idgh);
                            $_SESSION['slsp'] = $slsp;

                        echo '<script>
                            sessionStorage.removeItem("giohang");
                            window.location.href = "index.php";
                        </script>';
                    }
                    //header('Location: index.php');
                    break;

                //OUT cho khách hàng
            case 'thoat':
                include "view/header.php";
                unset($_SESSION['ROLE']);
                unset($_SESSION['iduser']);
                unset($_SESSION['username']);
                unset($_SESSION['idcustomer']);
                unset($_SESSION['slsp']);
                //header('location: index.php');
                // Hiển thị page xóa sessionStorage và chuyển trang
                echo '<script>
                    sessionStorage.removeItem("giohang");
                    window.location.href = "index.php";
                </script>';
                include "view/footer.php";
                break;
            case 'info_user':
                include "view/header.php";
                $info = get_customer_id_from_customer($_SESSION['idcustomer']);
                $login = get_info_taikhoan($_SESSION['iduser']);//tra ve thong tin tai khoan kh
                include "view/info_user.php"; 
                include "view/footer.php";
                break;
            case 'lichsu-order':
                    include "view/header.php";
                    $lichsu = get_customer_order_history($_SESSION['idcustomer']);//makh
                    include "view/lichsu_order.php"; // Bao gồm tệp để hiển thị thông tin người dùng
                    include "view/footer.php";
                    break;
            case 'detail-dh':
                include "view/header.php";
                if(isset($_GET['id'])&&($_GET['id']>0)){
                    $id=$_GET['id'];
                }
                    $ls_dh = get_dtail_order($id);//madh
                    //kiêm tra xem đã đánh giá chưa
                   
                     // lấy trạng thái đơn hàng
                    $status = get_status_order($id);
                    include "view/detail_order.php"; // Bao gồm tệp để hiển thị thông tin người dùng
                    include "view/footer.php";
                    break;
            case 'danhgia':
                    include "view/header.php";
                    //  if (isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['iddh']) && $_GET['iddh'] > 0) {
                    //     $id = $_GET['id'];    // mã sản phẩm
                    //     $iddh = $_GET['iddh']; // mã đơn hàng

                    //     $info_sp = getall_detail_product($id);
                    //     $reviews = get_reviews($id);
                       

                    //     include "view/danhgia.php";
                    // } 
                     if (isset($_POST['danhgia'])) {
                        $id = $_POST['id'];//mã đơn
                        $masp = $_POST['masp'];
                        $info_sp = getall_detail_product($masp);
                        $reviews = get_3_danhgia($masp);
                        include "view/danhgia.php";
                    }
                    include "view/footer.php";
                    break;
            case 'xuly-nhanxet':
                if (isset($_POST['guinhanxet'])) {
                    $masp = $_POST['masp'];
                    $madh = $_POST['madh'];
                    $sao = $_POST['rating'];
                    $nd = $_POST['review'];
                    $tthai = 'Hiện';
                    
                    add_review($masp, $madh, $sao, $nd, $tthai);
                        echo "<script>
                            alert('Đánh giá của bạn đã được gửi thành công!');
                            window.location.href = 'index.php?act=trangchu';
                        </script>";

                    exit();
                }
                break;
            //tìm kiếm sản phẩm
            case 'timkiem':
            include "view/header.php";
            if (!empty($_POST['nhaptim'])) {//tìm vừa type và giọng nói nên khỏi phải isset nút tìm kiếm
                $kyw = $_POST['nhaptim']; // Lấy từ khóa từ form tìm kiếm
                $dstk = search_product_by_keyword($kyw); // Gọi hàm tìm kiếm sản phẩm theo từ khóa
                include "view/timkiem.php"; // Hiển thị danh sách sản phẩm tìm kiếm được
            } else {
                // Nếu không có từ khóa tìm kiếm, bạn có thể xử lý trang rỗng hoặc hiển thị thông báo
                $dstk = []; // Không có sản phẩm nào để hiển thị
                include "view/timkiem.php"; // Hiển thị trang sản phẩm với danh sách rỗng
            } 
            include "view/footer.php";
            break;

            case 'forgot_password':
                include "view/header.php";
                include "view/forgot_password.php";
                include "view/footer.php";
                break;

            case 'update_password':
                include "view/header.php";
                    if (isset($_POST['capnhatmk']) && $_POST['capnhatmk']) {
                        $name = $_POST['name'];//tên đăng nhập
                        $pass = $_POST['re-password'];//mk
                        $email = $_POST['email'];//email

      
                        if (strlen($pass) != 8) { // Kiểm tra mật khẩu đúng 8 kí tự
                            echo "<script>alert('Mật khẩu phải chứa đúng 8 ký tự.');
                                history.back();</script>";
                            }else if (check_username_email_login($name, $email)) {

                                update_password($name, $pass);
                                echo "<script>alert('Đặt lại mật khẩu thành công!');</script>";

                                // Điều hướng người dùng đến trang đăng nhập sau khi hiển thị thông báo
                                echo "<script>window.location.href = 'index.php?act=dangnhap';</script>";
                                exit;

                        } else {
                            //nếu ko trả về kq
                            echo "<script>alert('Tên đăng nhập hoặc email không tồn tại.');
                            history.back();</script>";

                        }
                        }
                   include "view/footer.php";
                    break;

             // Cập nhật thông tin khách hàng       
            case 'capnhat': 
                    include "view/header.php";
                    if (isset($_POST['capnhat']) && $_POST['capnhat']) {    
                        
                        $name = $_POST['name'];
                        $email = $_POST['email'];
                        $sdt = $_POST['phone'];
                        $address = $_POST['address'];
                        $user_id = $_POST['user_id'];//id của tài khoản
                        $idkh = $_SESSION['idcustomer'];//id của khách hàng

                         if (!is_numeric($sdt)) { // Kiểm tra số điện thoại là số
                            echo "<script>alert('Số điện thoại phải là số. Vui lòng nhập lại.');
                                window.location.href = 'index.php?act=info_user';</script>";                             
                        }else if (check_sdt($sdt, $idkh) > 0) {
                            echo "<script>alert('SĐT đã được sử dụng bởi khách hàng khác!'); 
                                window.location.href = 'index.php?act=info_user';</script>";                      
                        }else if (check_email($email, $idkh) > 0) {
                            echo "<script>alert('Email đã được sử dụng bởi khách hàng khác!'); 
                                window.location.href = 'index.php?act=info_user';</script>";                      
                        }else{ 
                               update_info_customer($name, $sdt, $address, $email, $idkh);
                                echo "<script>alert('Cập nhật thông tin thành công!'); window.location.href = 'index.php?act=info_user';</script>";   
                        }
                        
                        }
                    

                    include "view/footer.php";
                    break;
            
            case 'info_taikhoan';
                include "view/header.php";
                $login = get_info_taikhoan($_SESSION['iduser']);//tra ve thong tin tai khoan kh
                include "view/taikhoan.php";
                include "view/footer.php";
                break;

            case 'update-tk':
        //         echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";
        // exit;
                include "view/header.php";
                if (isset($_POST['capnhat']) && $_POST['capnhat']) {      
                    $tendangnhap = $_POST['login'];
                    $passold = $_POST['passold'];
                    $passnew = $_POST['passnew'];
                    // $passold = trim($_POST['passold'] ?? 1);
                    // $passnew = trim($_POST['passnew'] ?? 1);
                    $tkid = $_POST['user_id'];


                    if (check_username_exists($tendangnhap, $tkid) > 0) {
                        echo "<script>alert('Tên đăng nhập đã tồn tại. Vui lòng chọn tên khác.'); 
                            window.location.href = 'index.php?act=info_taikhoan';</script>";
                    } else {
                        if ($passold == 1 && $passnew == 1) {
                            update_name($tendangnhap, $tkid);
                            echo "<script>alert('Cập nhật nhập thành công!'); 
                                window.location.href = 'index.php?act=info_taikhoan';</script>";
                        } else {
                            if (strlen($passnew) != 8) {
                                echo "<script>alert('Mật khẩu phải đúng 8 kí tự!'); 
                                    window.location.href = 'index.php?act=info_taikhoan';</script>";
                            } else {
                                if (check_mk_cu($passold, $tkid)>0) {
                                    update_mk($tendangnhap, $passnew, $tkid);
                                    echo "<script>alert('Cập nhật thành công!'); 
                                        window.location.href = 'index.php?act=info_taikhoan';</script>";
                                } else {
                                    echo "<script>alert('Mật khẩu cũ không đúng!'); 
                                        window.location.href = 'index.php?act=info_taikhoan';</script>";
                                }
                            } 
                        }
                    }
                }

                include "view/taikhoan.php";
                include "view/footer.php";
                break;

                //giỏ hàng bằng sesion  
                case 'addcart':
                    include "view/header.php";
                    //láy dl từ form để lưu vào giỏ hàng
                    if(isset($_POST['addcart']) && ($_POST['addcart'])){
                        $id=$_POST['id'];
                        $tensp=$_POST['tensp'];
                        $img=$_POST['hinh'];
                        $gia=$_POST['gia'];
                        
                        if(isset($_POST['sl']) && ($_POST['sl']) > 0){//nếu có tồn tại box sl
                            $sl=$_POST['sl'];
                        }else{
                            $sl=1;//khởi tạo sl
                        }
                        $fg=0;//= 0 thì chưa tồn tại sản phẩm đó
                        $i=0;// Chỉ số của sản phẩm trong mảng giỏ hàng session
                        foreach ($_SESSION['giohang'] as $item) {   //$item = [id sản phẩm, tên sản phẩm, ảnh, giá, số lượng];
                            if($item[1]==$tensp){
                                $slnew = $sl + $item[4];
                                $_SESSION['giohang'][$i][4] = $slnew;
                                $fg=1;
                                break;
                            }
                            $i++;
                        }                  
                        if($fg==0){//chưa có trong giỏ hàng
                            $item = array($id, $tensp, $img, $gia, $sl);
                        //đưa mảng này vào session
                        $_SESSION['giohang'][]=$item; // cái [] là thêm một phần tử mới vào cuối mảng
                        }
                    } 
                    // if (isset($_POST['return_url'])) {
                    //     $return_url = $_POST['return_url'];
                    //     header("Location: " . $return_url);
                    //     exit();
                    // }
                  
                    include "view/giohang.php";
                    include "view/footer.php";
                    break;
            case 'giohang':
                include "view/header.php";
                // Kiểm tra đã đăng nhập chưa
                if (isset($_SESSION['username']) && isset($_SESSION['idcustomer'])) {
                    // Kiểm tra đã có giỏ hàng chưa
                    
                        $idgh = get_giohang_chua_dat($_SESSION['idcustomer']);
                        $gh = get_giohang($idgh);
                    
                    include "view/giohang.php";
                }else{  
                    include "view/giohang.php";
                }
                
                
                include "view/footer.php";
            break;
            case 'delcart':
            include "view/header.php";
            //danh cho xóa cá nhân
            if(isset($_GET['i']) && ($_GET['i'])>=0){//[i] này là vị trí trong session chứ ko mảng id của sản phẩm đó => EX: có 3 sản phẩm thì i=0,1,2 => 0 là sản phẩm đầu tiên thêm vào session
                xoa_sp_canhan($_GET['i'], $_SESSION['idcustomer']);
                unset($_SESSION['slsp']);
            }
                        $idgh = get_giohang_chua_dat($_SESSION['idcustomer']);
                        $gh = get_giohang($idgh);

                        //show sl sp
                        $slsp = count_sp_gh($idgh);
                        $_SESSION['slsp'] = $slsp;
                // 🔄 Redirect lại để tránh phải F5
                    header("Location: index.php?act=giohang");
                    exit();
            
            break;

        //     case 'dathang':
        //         include "view/header.php";
                
                
        //         $idgh = get_giohang_chua_dat($_SESSION['idcustomer']);
        //         $gh = get_giohang($idgh);
        //         //lấy số lượng hiện tại
              
        //             foreach ($gh as $item) {
        //                 $idsp = $item['SP_MASP'];//lấy mã sản phẩm
        //                 //lấy được sl trong giỏ hàng
        //                 $sl_order = $item['CTGH_SOLUONG']; // số lượng đặt của sản phẩm đó
        //                 $slton = getall_item($idsp); //trả về SP_SLTON trong DB
        //                 if ($sl_order > $slton['SP_SLTON']) {
        //                     echo "<script>
        //                             alert('Sản phẩm {$item['SP_TENSP']} hiện tại không đủ số lượng, vui lòng kiểm tra lại số lượng! Số lượng còn lại: " . $slton['SP_SLTON'] . ".');
        //                             window.location.href = 'index.php?act=giohang';
        //                         </script>";
        //                                 exit; // Dừng thực thi để tránh tiếp tục
        //                             }
                       
        //             }
        //             // ✅ Bước 1: Kiểm tra đăng nhập
        //             if (!isset($_SESSION['idcustomer']) || empty($_SESSION['idcustomer'])) {
        //                 echo "<script>
        //                         alert('Cần đăng nhập để mua hàng!');
        //                         window.location.href = 'index.php?act=dangnhap';
        //                     </script>";
        //                 exit();
        //             }else{

                        
        //                 $info = get_customer_id_from_customer($_SESSION['idcustomer']);
        //                 //lấy phương thức ra
        //                 $pttt = get_ptth();
        //                 //lấy điểm tích lũy ra
        //                 $diem = get_diem_tich_luy($_SESSION['idcustomer']);
        //                 //lấy các địa chỉ ra
        //                 $quan = get_quan();
        //                 //xử lý giá sao khi trừ điểm tích lũy

                       
        //             }
        //    //$giohang = get_giohang($_SESSION['idgh'], $_SESSION['idcustomer']);
                
        //     include "view/thanhtoan.php";
        //     include "view/footer.php";
        //     break;
        case 'dathang':
        include "view/header.php";

        // // ✅ Bước 1: Kiểm tra đăng nhập
        // if (!isset($_SESSION['idcustomer']) || empty($_SESSION['idcustomer'])) {
        //     echo "<script>
        //             alert('Cần đăng nhập để mua hàng!');
        //         setTimeout(function() {
        //             window.location.href = 'index.php?act=dangnhap';
        //         }, 300); 
        //         </script>";
        //     exit();
        // }

        // ✅ Bước 2: Lấy dữ liệu sau khi đã đảm bảo đăng nhập
        $idgh = get_giohang_chua_dat($_SESSION['idcustomer']);
        $gh = get_giohang($idgh);

        // ✅ Bước 3: Kiểm tra tồn kho
        foreach ($gh as $item) {
            $idsp = $item['SP_MASP'];
            $sl_order = $item['CTGH_SOLUONG'];
            $slton = getall_item($idsp);
           
            if ($sl_order > $slton['SP_SLTON']) {
                echo "<script>
                        alert('Sản phẩm {$item['SP_TENSP']} hiện tại không đủ số lượng, vui lòng kiểm tra lại số lượng! Số lượng còn lại: " . $slton['SP_SLTON'] . ".');
                        window.location.href = 'index.php?act=giohang';
                    </script>";
                exit;
            }
            //tính trong lượng của từng sản phẩm
            // ✅ Tính trọng lượng của từng sản phẩm
            $trongluong = $item['SP_TRONGLUONG'];
            $tong_trongluong += $trongluong * $sl_order;


           
        }
        
        // ✅ Bước 4: Lấy thông tin khách hàng & thanh toán
        $info = get_customer_id_from_customer($_SESSION['idcustomer']);
        $pttt = get_ptth();
        $diem = get_diem_tich_luy($_SESSION['idcustomer']);
        // $quan = get_quan();
        $phuong = get_phuong_duoc_giao();
        include "view/thanhtoan.php";
        include "view/footer.php";
        break;

            //dùng để show quận và phường => dùng js 
            // case 'loadphuong':
            //     include "model/phuong.php";
            //     if (isset($_GET['quan_id'])) {
            //         $quan_id = $_GET['quan_id'];
            //         $phuongs = get_phuong($quan_id);
            //         echo '<option value="">--Chọn Phường--</option>';
            //         foreach ($phuongs as $p) {
            //             echo '<option value="' . $p['P_ID'] . '">' . $p['P_TENPHUONGXA'] . '</option>';
            //         }
            //     }
            //     break;

            //cập nhật sl sản phẩm trong giỏ hàng database
        case 'capnhat_soluong':
            if (isset($_SESSION['idcustomer']) && isset($_POST['masp']) && isset($_POST['soluong'])) {
                $idkh = $_SESSION['idcustomer'];
                $masp = $_POST['masp'];
                $soluong = $_POST['soluong'];
                $idgh = get_giohang_chua_dat($idkh); // lấy giỏ hàng chưa đặt

                capNhatSoLuongSanPham($idgh, $masp, $soluong);
                echo "OK";
            } 
             exit();
            break;

            //thêm sp vào giỏ hàng DB and check tổng sl có > slton ko
            case 'them_vao_giohang':
                if (isset($_SESSION['idcustomer']) && isset($_POST['masp']) && isset($_POST['soluong'])) {
                    $idkh = $_SESSION['idcustomer'];
                    $masp = $_POST['masp'];
                    $soluongThem = $_POST['soluong'];
                   
                    //lấy giỏ hàng chưa đặt hàng
                    $idgh = get_giohang_chua_dat($idkh);

                    // Nếu chưa có giỏ hàng => tạo mới
                    if (!$idgh) {
                        $idgh = tao_giohang($idkh); // bạn cần tạo thêm hàm này
                    }

                    // Lấy số lượng đã có trong giỏ nếu có
                    $soluongHienTai = get_soluong_trong_gio($idgh, $masp); // bạn cần tạo hàm này
                    $tongSoLuong = $soluongHienTai + $soluongThem;

                    // Lấy số lượng tồn kho thực tế
                    $slTon = get_soluong_ton($masp); // bạn cần tạo hàm này

                    if ($tongSoLuong > $slTon) {
                        echo "Chỉ còn {$slTon} sản phẩm, bạn đã có {$soluongHienTai} trong giỏ.";
                        exit();
                    }

                    $gia = get_gia($_POST['masp']);
                    $gia = $gia['DG_GIAMOI'];  // giả sử mảng trả về có key 'SP_GIA'
                    themHoacCapNhatSanPhamVaoGio($idgh, $masp, $soluongThem, $gia);

                     // ✅ Cập nhật lại số lượng sản phẩm trong giỏ hàng
                    $slsp = count_sp_gh($idgh);
                    $_SESSION['slsp'] = $slsp;
                    
                  // Gửi số lượng mới về cho JS
                    echo $slsp;
                }else {
                        echo 'Bạn cần đăng nhập và gửi đủ dữ liệu!';
                    }
                exit();
                break;

            case'xacnhan':
                // echo "<pre>";
                //     var_dump($_POST);
                //     echo "</pre>";
                //     exit();

                include "view/header.php";
                if (isset($_POST['xacnhan'])) {
                    $tongdon = $_POST['tongdonhang'];//đã cộng phí và dùng điểm
                    //$tongdonhang = $_POST['tongdon'];đã trừ và cộng phí giao
                    $hoten = $_POST['hoten'];
                    $sdt = $_POST['tel'];
                    $thanhpho = 'TP Hồ Chí Minh'; // mặc định, vì field này readonly
                    // $quan_id = $_POST['quan_id'];
                    $phuong_id = $_POST['phuong_id'];
                    $diachi_chitiet = $_POST['address_chitiet']; // số nhà, đường
                    $pttt = $_POST['pttt'] ?? null;
                    // Nối lại địa chỉ đầy đủ (tuỳ bạn muốn lưu riêng hay nối lại)
                    $phuong = get_name_phuong($phuong_id);
                    // $quan = get_name_quan($quan_id);
                    $diachi_daydu = $diachi_chitiet . ', ' . $phuong . ', ' . $thanhpho;
                    $phigiao = $_POST["phidelivery"];                
                    $kc = $_POST["idkc"];
                    $tl =$_POST["idtl"];
                    $tldh = $_POST["total-tl"];//đơn hàng có tổng trọng lượng

                   $dungdiem = 0;
                    if (isset($_POST['diemtichluy']) && $_POST['diemtichluy'] == 'chon') {
                        $diem_raw = str_replace('.', '', $_POST['diem_dung']); // loại bỏ dấu chấm phân cách hàng nghìn
                        $dungdiem = (int)$diem_raw;

                        // Trừ điểm của khách hàng
                        update_diem($_SESSION['idcustomer'], $dungdiem);
                    }

                    // $phigiao = ($tongdon >= 100000) ? 0 : 15000;
                    //lấy phí giao
                    
                    //lấy id khoang cách
                    //lấy id trọng lượng
                    //lấy ngày áp dung( tức id đơn giá)
                    $info_phigiao = get_phi_giao($kc, $tl);
                    $id_kc = $info_phigiao["KC_ID"];
                    $id_tl = $info_phigiao["TL_ID"];
                    $date_apdung = $info_phigiao["PG_NGAYAPDUNG"];

                    
                    $tong = $tongdon + $phigiao - $dungdiem;
                
                   $tongdonhang = number_format($tong, 0, ',', '.'); // hiển thị: 52.940



                    //tính điểm cộng cho đơn hàng
                    $diemcong = ($tongdon * 0.01);   //giá của đơn hàng sau khi trừ và cộng phí               
                    //lấy giỏ hàng chưa đặt hàng của khách hàng
                    $idgh = get_giohang_chua_dat($_SESSION['idcustomer']);
                    //thêm đơn đặt hàng(DH_ID, NV_ID, GH_ID, P_ID, KH_ID, PTTT_ID, DH_TENNGUOINHAN,DH_SDT, DH_DIACHINHAN, DH_TONGTIEN, DH_NGAYDAT, DH_TRANGTHAI, DH_ĐIEMADUNG, DH_DIEMCONG, DH_PHIGIAO)
                    //lấy mã trạng thái bên bảng trạng thái là xét duyệt
                    

                    $iddh = add_donhang($idgh, $phuong_id, $_SESSION['idcustomer'], $pttt, $hoten, $sdt, $diachi_daydu, $tongdonhang, $dungdiem, $diemcong, $id_kc, $id_tl, $date_apdung);
                    //lưu đơn hàng + trạng thái vào bảng lsdh
                    add_statue_order($iddh);
                    //thêm chi tiết đơn hàng
                    $gh = get_giohang($idgh); //lấy sản phẩm trong chi tiết giỏ hàng
                    foreach ($gh as $item) {
                        $idsp = $item['SP_MASP'];
                        $soluong = $item['CTGH_SOLUONG'];
                        $dongia = $item['CTGH_DONGIA'];
                        add_detail_donhang($iddh, $idsp, $soluong, $dongia);
                        capnhat_sl_sp($idsp, $soluong);
                    }

                    //cập nhật điểm tích lũy cho khách hàng
                    //update_diem_tich_luy($_SESSION['idcustomer'], $diemcong);
                    //cập nhật số lượng sản phẩm
                   
                    //lấy sản phẩm trong giỏ hàng show ra trang đơn hàng
                      
                     // ✅ Redirect sau khi đặt hàng thành công
                        header("Location: index.php?act=donhangdadat&idgh=$idgh&tongdonhang=$tongdonhang&iddh=$iddh");
                        exit();

                }
                // if (isset($_POST['xacnhan'])) {
                //     header("Location: index.php?act=donhangdadat&idgh=2&tongdonhang=100000&iddh=26");
                //     exit();
                // }

                include "view/footer.php";
                break;
            case 'donhangdadat':
                include "view/header.php";
                if (isset($_GET['idgh'])) {
                    $tongdonhang = $_GET['tongdonhang'] ?? 0;
                    $iddh = $_GET['iddh'];
                    $idgh = $_GET['idgh'];
                    $gh = get_giohang($idgh);
                    //lấy thông tin từ đơn hàng
                    $info_donhang = get_info_donhang($iddh);
                    unset($_SESSION['slsp']);
                    include "view/dathang.php";
                } else {
                    echo "Không tìm thấy đơn hàng đã đặt.";
                }
                include "view/footer.php";
                break;
            case 'xem-danhgia':
                include "view/header.php";
                $danhgia = get_review_canhan($_SESSION['idcustomer']);//id khách hàng
                include "view/xem_danhgia.php";
                include "view/footer.php";
                break;
            case 'chitiet-danhgia':
                include "view/header.php";
                 if (isset($_GET['id']) && isset($_GET['idkh'])) {
                    $review = get_review_iddg($_GET['id']);//id khách hàng
                    include "view/chitiet_danhgia.php";
                 }
                include "view/footer.php";
                break;
            //FILE ADMIN
            case 'admin':
                // Gọi hàm để đếm số lượng tài khoản mới
                $new_accounts_count = count_accounts_by_role();
                // Đếm tổng số đơn hàng
                $total_orders = count_id_order();//dùng chung ngày bd và kt
                // Gọi hàm để tính tổng doanh thu trong khoảng thời gian cụ thể
                $total_revenue = count_revenue();
                //đếm số đánh giá
                $danhgia = count_danhgia();
                //lấy doanh thu theo tháng
                $yearly_monthly_revenue = getYearlyMonthlyRevenue();
                // đơn hàng theo tháng
                $yearly_monthly_orders = getYearlyMonthlyOrders();
                // Gọi hàm và gán giá trị cho biến $yearly_monthly_customers
                $yearly_monthly_customers = getYearlyMonthlyCustomers();
                //lấy sl trạng thái -> biểu đồ tròn
                $count_status = get_count_status_order();
                 // Tách dữ liệu ra làm 2 mảng: nhãn (labels) và số lượng (data)
                $labels_status = [];
                $data_status = [];

                foreach ($count_status as $row) {
                    $labels_status[] = $row['TT_TENTT'];
                    $data_status[] = $row['soluong'];
                }
                //lấy số sao đánh giá
                $sosao_data = get_count_sosao_danhgia();
                $ratingData = array_values($sosao_data);
                include "admin/admin.php";
                break;
            case 'info-admin':
            // Lấy manv của admin từ ID tài khoản
            //$employee_id = get_employee_id_from_account($_SESSION['id_admin']);
            // Lấy thông tin cá nhân của nhân viên trả về ds=> show info admin
            $info_admin = get_employee_info($_SESSION['id_admin']);
            
            include "admin/info-admin.php";
            break;
            
            
            case 'out':
                include "view/header.php";
                unset($_SESSION['ROLE']);
                unset($_SESSION['id_admin']);
                unset($_SESSION['name_admin'] );
                include "view/dangnhap.php";
                include "view/footer.php";
                break;

            //cập nhật thông tin
            case 'capnhat-admin':
                if (isset($_POST['capnhat-admin']) && $_POST['capnhat-admin']) {      
                    $name = $_POST['hoten'];
                    $sdt = $_POST['sodienthoai'];
                    $email = $_POST['email'];
                    $employee_id = $_POST['manv'];
                    $diachi = $_POST['diachi'];
                    update_info_employee($employee_id, $name, $sdt, $diachi, $email);
                
                echo "<script>
                            alert('Cập nhật thông tin thành công!');
                            window.location.href = 'index.php?act=info-admin';
                    </script>";

                    }

            break;

            // case 'qlsp':
            //     $dsdm = getall_dm();
            //     $kq = getall_sanpham();
            //     include "admin/ql-sanpham.php";
            //     break;
            case 'qlsp':
                $dsdm = getall_dm();

                // Phân trang
                $limit = 20;
                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $start = ($page - 1) * $limit;
                //lấy sản phẩm theo danh mục
                $iddm = $_GET['iddm'] ?? '';
                $kq = getall_sanpham($start, $limit);

                // Lấy tổng số sản phẩm để chia trang
                $conn = ketnoidb();
                if ($iddm !== '') {
                    $stmt_count = $conn->prepare("SELECT COUNT(*) FROM san_pham WHERE DM_MADM = :iddm");
                    $stmt_count->bindValue(':iddm', $iddm, PDO::PARAM_INT);
                } else {
                    $stmt_count = $conn->prepare("SELECT COUNT(*) FROM san_pham");
                }
                $stmt_count->execute();
                $total_products = $stmt_count->fetchColumn();//tổng số sp
                $total_pages = ceil($total_products / $limit);//trả về số trang
                $all_dm = getall_dm();
                include "admin/ql-sanpham.php";
                break;


            case 'search-admin':
                if (isset($_POST['timkiem']) && !empty($_POST['nhaptim'])) {
                    $kyw = $_POST['nhaptim']; 
                    $dstk = search_product_by_keyword($kyw); 
                    include "admin/search-sp.php"; 
                }

                break;
            case 'add_product':
                $dm = getall_dm();
                $thetrang = get_thetrang();
                include "admin/add-sanpham.php";
                break;
            case 'qldm':
                $dm = getall_dm_luon();
                include "admin/ql-danhmuc.php"; 
                break;
            case 'add_danhmuc':
                include "admin/add-danhmuc.php"; 
                break;
            case 'addm-db':
                if (isset($_POST['themdm'])) {
                    $tendm = trim($_POST['tendm']);

                    if (check_danhmuc($tendm)) {
                        echo "<script>
                                alert('Danh mục đã tồn tại. Vui lòng chọn tên khác.');
                                window.history.back();
                            </script>";
                        exit();
                    }
                    $trangthai = "Còn kinh doanh";
                    themdanhmuc($tendm, $trangthai);
                    echo "<script>
                            alert('Thêm danh mục thành công!');
                            window.location.href = 'index.php?act=qldm';
                        </script>";
                    exit();
                }
                break;
            case 'update-dm':
                 if (isset($_GET['id'])) {
                    $idsm = $_GET['id'];
                    $dm = get_dm_theo_id($idsm);
                 }
                include "admin/update-danhmuc.php"; 
                break;
            //cập nhât danh mục trong DB
            case 'xuli-up-dm':
                 if (isset($_POST['capnhat'])) {
                    $madm = $_POST['iddm'];
                    $tendm = trim($_POST['tendm']);
                    $trangthai = $_POST['trangthai'];

                   capnhat_danhmuc($madm, $tendm, $trangthai);
                    echo "<script>
                            alert('Cập nhật danh mục thành công!');
                            window.location.href = 'index.php?act=qldm';
                        </script>";
                    exit();
                }
                break;
            // case 'xoa-dm':
            //     if (isset($_GET['id'])) {
            //         $iddm = $_GET['id'];
            //         xoa_dm($iddm);
            //         echo "<script>
            //                 alert('Xóa danh mục thành công!');
            //                 window.location.href = 'index.php?act=qldm';
            //             </script>";
            //         exit();
            //      }
            //      break;
            case 'add-sp-db':
                if (isset($_POST['themsp'])) {
                    $tensp = $_POST['tensp'];
                    $mota = $_POST['des-sp'];
                    $madm = $_POST['madm'];
                    $tonkho = $_POST['tonkho'];
                    $gia = $_POST['gia'];
                    $donvi = $_POST['donvi'];
                    $trongluong = $_POST['trongluong'];
                    $ngayphathanh = $_POST['date'];
                    //lấy info dinh dưỡng
                    $calo = $_POST['calo'];
                    $dam = $_POST['dam'];
                    $chatbeo = $_POST['chatbeo'];
                    $duong = $_POST['duong'];
                    $chatxo = $_POST['chatxo'];
                    $natri = $_POST['natri'];
                    //lấy info thể trạng
                    $ds_thetrang = $_POST['thetrang'] ?? [];  // danh sách mã thể trạng được chọn (mảng)
                    $mota_ph = $_POST['mota_phuhop'];
                    
                    //check trùng tên sp
                    if(check_name_product($tensp)){
                    echo "<script>
                                alert('Tên sản phẩm bị trùng!');
                                window.history.back();
                            </script>";
                        exit();
                    }
                // var_dump($ngayphathanh);
                //         exit;
                    // Xử lý ảnh
                // Kiểm tra định dạng ảnh
                $target_dir = "images/";
                $target_file = basename($_FILES["anh"]["name"]);
                $img = $target_file;
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
                // Các định dạng ảnh cho phép
                $allowedExtensions = ["jpg", "jpeg", "png", "gif"];
                if (!in_array($imageFileType, $allowedExtensions)) {
                    echo "<script>
                            alert('Chỉ cho phép các định dạng ảnh JPG, JPEG, PNG, GIF!');
                            window.history.back();
                        </script>";
                    $uploadOk = 0;
                }
        
                // Nếu ảnh hợp lệ, thực hiện upload
                if ($uploadOk == 1) {
                    if (!move_uploaded_file($_FILES["anh"]["tmp_name"], $target_dir . $target_file)) {
                        echo "<script>
                                alert('Lỗi khi tải ảnh lên!');
                                window.history.back();
                            </script>";
                        exit();
                    }
                } else {
                    // Nếu định dạng ảnh không hợp lệ, ngừng quá trình thêm sản phẩm
                    exit();
                }
                $trangthai="Còn kinh doanh";
                //kiêm tra trùng tên sp
                
                // Gọi hàm thêm sản phẩm
                $idsp_new = them_sanpham($tensp, $img, $tonkho, $mota, $trangthai, $madm, $ngayphathanh, $donvi, $trongluong);
                add_dongia_sp_new($idsp_new, $gia, $ngayphathanh);
                add_dinhduong($idsp_new, $calo, $dam, $chatbeo, $duong, $chatxo, $natri);
                //thêm thể trạng cho sản phẩm -> 1 sp có nhiều thể trạng nên thế
                foreach ($ds_thetrang as $tt_id) {
                    add_phuhop($tt_id, $idsp_new, $mota_ph); // bạn có thể cho thêm mô tả nếu muốn
                }
                echo "<script>
                            alert('Thêm sản phẩm thành công!');
                            window.location.href = 'index.php?act=qlsp';
                        </script>";
                    exit();
                }
            
                break;
            case 'update-sp-form':
                if (isset($_GET['id'])) {
                    $idsp = $_GET['id'];
                    $info = get_sp_theo_id($idsp);
                    $dinhduong  = get_dinhduong($idsp);
                    $thetrang = get_thetrang();
                    $phuhop = get_thetrang_phuhop($idsp);
                    $lsgia = get_lichsu_gia($idsp);
                    $map_phuhop = [];
                    foreach ($phuhop as $row) {
                        $map_phuhop[$row['TTRANG_MA']] = $row['PH_MOTA'];
                    }
                    $dm = getall_dm();
                 }
                include "admin/update-sanpham.php"; 
                break;

            case 'up-sp-db':
                if (isset($_POST['capnhatsp'])) {
                    $idsp = $_POST['idsp'];
                    // Lấy dữ liệu từ form
                    $tensp = $_POST['tensp'];
                    $mota = $_POST['des-sp'];
                    $madm = $_POST['madm'];
                    $tonkho = $_POST['tonkho'];
                    $gia = $_POST['gia'];
                    $ngayphathanh = $_POST['date'];
                    $donvi = $_POST['donvi'];
                    $trongluong = $_POST['trongluong'];
                    $trangthai = $_POST['trangthai'];


                    //lấy info dinh dưỡng
                    $calo = $_POST['calo'];
                    $dam = $_POST['dam'];
                    $chatbeo = $_POST['chatbeo'];
                    $duong = $_POST['duong'];
                    $chatxo = $_POST['chatxo'];
                    $natri = $_POST['natri'];

                    //lấy info thể trạng
                    $ds_thetrang = $_POST['thetrang'] ?? [];  // danh sách mã thể trạng được chọn (mảng)
                    $mota_phuhop = $_POST['mota_phuhop'] ?? []; // Mô tả tương ứng từng thể trạng
                    // Xử lý ảnh
                    $anh = $_FILES['anh']['name'];
                    $target_dir = "images/";
                    $target_file = $target_dir . basename($anh);

                    if ($anh != "") {
                        move_uploaded_file($_FILES['anh']['tmp_name'], $target_file);
                    } else {
                        // Không chọn ảnh mới thì giữ ảnh cũ
                        $img = get_img_cu($idsp);
                        $anh = $img;
                    }
                    $spcu = get_sp_theo_id($idsp);
                    // Gọi hàm cập nhật sản phẩm
                    update_sanpham($idsp, $tensp, $mota, $anh, $madm, $tonkho, $ngayphathanh, $donvi, $trangthai, $trongluong);
                    update_dinhduong($idsp, $calo, $dam, $chatbeo, $duong, $chatxo, $natri);
                    xoa_phuhop_theo_sp($idsp); // Xoá sạch thể trạng cũ để ghi lại

                    foreach ($ds_thetrang as $tt_id) {
                          $mota_ph = $mota_phuhop[$tt_id] ?? '';
                        add_phuhop($tt_id, $idsp, $mota_ph); // bạn có thể cho thêm mô tả nếu muốn
                    }
                    if( $gia != $spcu['DG_GIAMOI']){
                        insert_gia_sp($idsp, $gia);
                    }
                   

                     echo "<script>
                            alert('Cập nhật sản phẩm thành công!');
                            window.location.href = 'index.php?act=update-sp-form&id=$idsp';
                        </script>";
                    exit();
                }
                break;

            case 'qlkhang':
                $kh = show_kh_admin();
                include "admin/ql-khachhang.php"; 
                break;
            case 'search-customer':
                if (isset($_POST['timkiem']) && !empty($_POST['nhaptim'])) {
                    $kyw = $_POST['nhaptim']; 
                    $kh = search_customer_by_keyword($kyw); 
                    include "admin/search-kh.php"; 
                } 
                break;
            case 'detail-kh':
                if(isset($_GET['id'])){
                    $kh = get_customer_id_from_customer($_GET['id']);
                    $dh = get_dh_customer($_GET['id']);
                    $sodon = count_don_hang_by_khachhang($_GET['id']);
                    $review = get_review($_GET['id']);
                    $so_review = count_review($_GET['id']);
                    include "admin/detail-kh.php";
                }
                
                break;
            case 'content-review':
                if(isset($_GET['id']) && isset($_GET['idkh'])){    
                    //lấy thông tin khách hàng
                    $info_kh = get_customer_id_from_customer($_GET['idkh']);
                    //lấy nd đánh giá  có sp, dánh giá, đơn hàng -> cần thì lấy   
                    $review = get_review_iddg($_GET['id']);   //id của đánh giá               
                    include "admin/content-review.php";
                }
                
                break;
        case 'xem-order':
            // $dh = get_all_order(); 
            $trangthai = get_tt();
            // Phân trang
                $limit = 10;
                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $start = ($page - 1) * $limit;             
                $dh = get_all_order($start, $limit);

                // Lấy tổng số sản phẩm để chia trang
                $conn = ketnoidb();            
                $stmt_count = $conn->prepare("SELECT COUNT(*) FROM don_hang");
                $stmt_count->execute();
                $total_fee = $stmt_count->fetchColumn();//tổng số sp
                $total_pages = ceil($total_fee / $limit);//trả về số trang
            include "admin/ql-donhang.php";
            break;
        case 'det-dh':
            if(isset($_GET['id'])){
                $dh = get_detail_donhang($_GET['id']);
                $ls_status = get_ls_status($_GET['id']);
                include "admin/detail-dh.php";
              }
            break;
        case 'qlnhanvien':
            $nv = get_all_nv();
            include "admin/ql-nhanvien.php";
            break;
        case 'search-nhanvien':
            if (isset($_POST['timkiem']) && !empty($_POST['nhaptim'])) {
                    $kyw = $_POST['nhaptim']; 
                    $nv = search_employee_by_keyword($kyw); 
                    include "admin/search-nv.php"; 
                } 
                break;
        case 'detail-nv':
            if(isset($_GET['id'])){//id nhân viên
                $nv = get_info_nv($_GET['id']);
                $idnv = $nv['TK_ID'];
                $so_don_thanh_cong = count_don_hang_thanh_cong($idnv);
                $so_don_that_bai = count_don_hang_bi_huy($idnv);
                $khuvuc = get_khuvuc_nv($_GET['id']);
                include "admin/detail-nv.php";
              }
            break;
        case 'qltaikhoan':
            //đếm tk nv giao hàng
            $tknv = count_all_tk_nv();
            //đếm tk admin
            $tkadmin = count_all_tk_admin();
            //đếm tk kh
            $tkkh = count_all_tk_kh();
            //đếm tk bị khóa
            $tkbk = count_all_tk_bk();
            //lấy ds tài khoản
            $tk = get_all_tai_khoan();
            include "admin/ql_taikhoan.php";
            break;
        case 'search-tk':          
            $tknv = count_all_tk_nv();
            $tkadmin = count_all_tk_admin();          
            $tkkh = count_all_tk_kh();           
            $tkbk = count_all_tk_bk();
            if (isset($_POST['timkiem']) && !empty($_POST['nhaptim'])) {
                    $kyw = $_POST['nhaptim']; 
                    $tk = search_tk_by_id($kyw); 
                    include "admin/search_tk.php"; 
                } 
            
            break;
        case 'add_tk':
            add_tai_khoan(); //thêm nv + thêm tk cùng 1 lúc :)))
            include "admin/ql_taikhoan.php";
            break;
        case 'add_nv':
            $bophan = get_bophan();
            include "admin/add_nhanvien.php";
            break;
        case 'add-nhanvien':
            if (isset($_POST['themnv']) && !empty($_POST['themnv'])) {
                $username = $_POST['username'];
                $password = $_POST['password'];
                $vaitro   = $_POST['vaitro'];
                $hoten    = $_POST['hoten'];
                $gioitinh = $_POST['gioitinh'];
                $sdt      = $_POST['sdt'];
                $email    = $_POST['email'];
                $diachi   = $_POST['diachi'];
                $bophan   = $_POST['bophan']; 

                // Kiểm tra trùng tên đăng nhập
                if (check_username_login($username) > 0) {
                    echo "<script>
                            alert('Tên đăng nhập đã tồn tại. Vui lòng chọn tên khác.');
                            window.history.back();
                        </script>";
                    exit; // Bắt buộc phải có
                }

                // Nếu không trùng, thêm tài khoản và nhân viên
                $idtk = add_tk_nv($username, $password, $vaitro);
                add_nv($bophan, $hoten, $gioitinh, $sdt, $email, $diachi, $idtk);

                echo "<script>
                        alert('Thêm nhân viên thành công.');
                        window.location.href = 'index.php?act=qlnhanvien';
                    </script>";
                exit;
            }
            break;
        case 'search-danhmuc':
             if (isset($_POST['timkiem']) && !empty($_POST['nhaptim'])) {
                    $kyw = $_POST['nhaptim']; 
                    $dm = search_dm_by_id($kyw); 
                    include "admin/search_dm.php"; 
                } 
            break;
        case 'detail-tk':
            if(isset($_GET['id'])){if (isset($_GET['id']) && isset($_GET['vaitro'])) {
                $id = $_GET['id'];//id cá nhân của kh or nv
                $vaitro = $_GET['vaitro'];
                if ($vaitro == 1) {
                        $kh = get_kh($id);
                    } elseif ($vaitro == 0 || $vaitro == 2) {
                        $nv = get_nv($id);
                    }else{
                         echo "Vai trò không hợp lệ.";
                        exit;
                    }
                       
                    }
                        // Là nhân viên hoặc quản trị
               
                include "admin/detail-tk.php";
              }
            break;

        //cập nhật trạng thái đơn hàng
        case 'capnhat_trangthai':
            if (isset($_POST['madh']) && isset($_POST['trangthai'])) {             
                $madh = $_POST['madh'];
                $trangthai = $_POST['trangthai'];//mã status
                $trangthai_cu = get_trangthai_donhang($madh); // Lấy trạng thái cũ trước khi cập nhật
                 echo "DEBUG: Trạng thái cũ: $trangthai_cu, Trạng thái mới: $trangthai<br>";
                
                 update_stutas_order($madh, $trangthai, $trangthai_cu);
                
                // Nếu chuyển từ trạng thái khác → hủy (5) => cộng lại tồn kho
                if ($trangthai == 5 && $trangthai_cu != 5) {
                    $slsp = get_all_slsp_in_dh($madh);
                    foreach ($slsp as $sp) {
                        $masp = $sp['SP_MASP'];
                        $sl = $sp['CTDH_SOLUONG'];
                        update_sltonkho($masp, $sl); // cộng lại tồn kho
                    }
                }
                // Nếu chuyển từ hủy (5) → sang trạng thái khác => trừ lại tồn kho
                if ($trangthai_cu == 5 && $trangthai != 5) {
                    $slsp = get_all_slsp_in_dh($madh);
                    foreach ($slsp as $sp) {
                        $masp = $sp['SP_MASP'];
                        $sl = $sp['CTDH_SOLUONG'];
                        update_tru_slton($masp, $sl); // trừ số lượng (dùng dấu -)
                    }
                }
                echo "OK";
            } 
             exit();
            break;
        case 'phancong':
            //lấy all các đơn hàng chưa phân công giao hàng
            // $dh = get_order_chua_phancong();
            //lấy nhân viên giao hàng
            $nv = get_nv_giaohang();
            // Phân trang
                $limit = 20;
                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $start = ($page - 1) * $limit;             
                $dh = get_order_chua_phancong($start, $limit);

                // Lấy tổng số sản phẩm để chia trang
                $conn = ketnoidb();            
                $stmt_count = $conn->prepare("SELECT COUNT(*) FROM don_hang WHERE NV_ID IS NULL");
                $stmt_count->execute();
                $total_fee = $stmt_count->fetchColumn();//tổng số sp
                $total_pages = ceil($total_fee / $limit);//trả về số trang
            include "admin/phancong_order.php";
            break;
        case 'luu_phancong':
            if (isset($_POST['madon']) && isset($_POST['nv_giaohang'])) {
                $madon = $_POST['madon']; // ID đơn hàng
                $nv_id = $_POST['nv_giaohang']; // ID nhân viên giao hàng được chọn

                // Gọi hàm xử lý phân công
                phancong_giaohang($madon, $nv_id);

                // Có thể thêm thông báo hoặc redirect
                echo "<script>
                        alert('Phân công thành công.');
                        window.location.href = 'index.php?act=phancong';
                    </script>";              
                exit();
            }
            break;
        case 'luu_phancong_two':
            if (isset($_POST['madon']) && isset($_POST['nv_giaohang'])) {
                $madon = $_POST['madon']; // ID đơn hàng
                $nv_id = $_POST['nv_giaohang']; // ID nhân viên giao hàng được chọn

                // Gọi hàm xử lý phân công
                phancong_giaohang($madon, $nv_id);

                // Có thể thêm thông báo hoặc redirect
                echo "<script>
                        alert('Phân công thành công.');
                        window.location.href = 'index.php?act=daphancong';
                    </script>";              
                exit();
            }
            break;
        case 'daphancong':
            // $dh = get_don_da_phancong();
            // Phân trang
                $limit = 20;
                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $start = ($page - 1) * $limit;             
                $dh = get_don_da_phancong($start, $limit);

                // Lấy tổng số sản phẩm để chia trang
                $conn = ketnoidb();            
                $stmt_count = $conn->prepare("SELECT COUNT(*) FROM don_hang WHERE NV_ID IS NOT NULL");
                $stmt_count->execute();
                $total_fee = $stmt_count->fetchColumn();//tổng số sp
                $total_pages = ceil($total_fee / $limit);//trả về số trang
            include "admin/order-da-phancong.php";
            break;
        case 'auto_phancong':
            phancong_tudong();

            echo "<script>
                        alert('Phân công thành công.');
                        window.location.href = 'index.php?act=phancong';
                    </script>";              
                exit();
             break;
        case 'search-dh':
            if (isset($_POST['timkiem']) && !empty($_POST['nhaptim'])) {
                    $kyw = $_POST['nhaptim']; 
                    $dh = search_dh_by_id($kyw); 
                    include "admin/search_dh.php"; 
                } 
                break;
        case 'search-dh-dapc':
            if (isset($_POST['timkiem']) && !empty($_POST['nhaptim'])) {
                    $kyw = $_POST['nhaptim']; 
                    $dh = search_dh_dapc_by_id($kyw); 
                    include "admin/search_dh_dapc.php"; 
                } 
                break;
        case 'list_taikhoan':
            // Lấy giá trị role từ GET (nếu có)
            $role = isset($_GET['role']) ? $_GET['role'] : '';
            //đếm tk nv giao hàng
            $tknv = count_all_tk_nv();
            //đếm tk admin
            $tkadmin = count_all_tk_admin();
            //đếm tk kh
            $tkkh = count_all_tk_kh();
            //đếm tk bị khóa
            $tkbk = count_all_tk_bk();
            // Gọi model lấy dữ liệu
            $tk = get_all_accounts($role);

            include "admin/loc-tk.php";
            break;
        case 'list_sao':
            $role = isset($_GET['role']) ? $_GET['role'] : '';
            $danhgia = get_review_cuthe( $role);//số sao
            //các box
            $dem_so_danhgia = get_count_sosao_danhgia_canhan();
            $danhgia_an = get_count_sosao_an();
            include "admin/loc-review.php";
            break;
        case 'list_sp':
                $iddm = isset($_GET['iddm']) ? $_GET['iddm'] : '';
                $dsdm = getall_dm();

                // Phân trang
                $limit = 20;
                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $start = ($page - 1) * $limit;
                //lấy sản phẩm theo danh mục
                $kq = getall_sanpham($start, $limit, $iddm);

                // Lấy tổng số sản phẩm để chia trang
                $conn = ketnoidb();
                 if ($iddm !== '') {
                    $stmt_count = $conn->prepare("SELECT COUNT(*) FROM san_pham WHERE DM_MADM = :iddm");
                    $stmt_count->bindValue(':iddm', $iddm, PDO::PARAM_INT);
                } else {
                    $stmt_count = $conn->prepare("SELECT COUNT(*) FROM san_pham");
                }
            
                $stmt_count->execute();
                $total_products = $stmt_count->fetchColumn();//tổng số sp
                $total_pages = ceil($total_products / $limit);//trả về số trang
                $all_dm = getall_dm();
            include "admin/loc-product.php";
            break;
        case 'list_dh':
                $idtt = isset($_GET['idstatus']) ? $_GET['idstatus'] : '';
                $trangthai = get_tt();

                // Phân trang
                $limit = 20;
                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $start = ($page - 1) * $limit;
                //lấy sản phẩm theo danh mục
                $dh = get_all_order($start, $limit,$idtt);

                // Lấy tổng số sản phẩm để chia trang
                $conn = ketnoidb();
                if ($idtt !== '') {
                    $stmt_count = $conn->prepare("SELECT COUNT(*) FROM don_hang dh, lich_su_don_hang ls WHERE 
                    dh.DH_MADH = ls.DH_MADH AND TT_MATT = :idtt");
                    $stmt_count->bindValue(':idtt', $idtt, PDO::PARAM_INT);
                } else {
                    $stmt_count = $conn->prepare("SELECT COUNT(*) FROM san_pham");
                }
                $stmt_count->execute();
                $total_products = $stmt_count->fetchColumn();//tổng số sp
                $total_pages = ceil($total_products / $limit);//trả về số trang
                $all_dm = getall_dm();
            include "admin/loc-order.php";
            break;
        case 'capnhat_trangthai_nv':
             if (isset($_POST['manv']) && isset($_POST['trangthai'])) {             
                $manv = $_POST['manv'];
                $trangthai = $_POST['trangthai'];
                update_stutas_employee($manv, $trangthai);
                echo "OK";
            } 
             exit();
            break;
        case 'capnhat_trangthai_tk':
             if (isset($_POST['idtk']) && isset($_POST['trangthai'])) {             
                $idtk = $_POST['idtk'];
                $trangthai = $_POST['trangthai'];
                update_stutas_tk($idtk, $trangthai);
                echo "OK";
            } 
             exit();
            break;
        case 'qldg':
            $dem_so_danhgia = get_count_sosao_danhgia_canhan();
            $danhgia_an = get_count_sosao_an();
            $danhgia = get_all_danhgia();
            include "admin/ql-danhgia.php"; 
            break;
        case 'detail-dg':
            if(isset($_GET['id']) && isset($_GET['idkh'])){
                $info_kh = get_customer_id_from_customer($_GET['idkh']);
                    //lấy nd đánh giá  có sp, dánh giá, đơn hàng -> cần thì lấy   
                    $review = get_review_iddg($_GET['id']);   //id của đánh giá   
                include "admin/content-review.php";
            }
            break;
        case 'search-danhgia':
            if (isset($_POST['timkiem']) && !empty($_POST['nhaptim'])) {
                    $kyw = $_POST['nhaptim']; 
                    $danhgia = search_danhgia_by_keyword($kyw); 
                    include "admin/search-dg.php"; 
                }

                break;
        case 'xoa-dg':
            if(isset($_GET['id'])){
               xoa_danhgia($_GET['id']);
                include "admin/ql-danhgia.php"; 
            }
            break;
        case 'capnhat_danhgia':
            if (isset($_POST['madg']) && isset($_POST['trangthai'])) {             
                $madg = $_POST['madg'];
                $trangthai = $_POST['trangthai'];
                capnhat_statue_danhgia($madg, $trangthai);
               
            }
        case 'update_nv_gh':
             if(isset($_GET['id'])){
                $dh = get_order_cansua($_GET['id']);
                //lấy nhân viên giao hàng
                $nv = get_nv_giaohang();
                include "admin/update-phancong.php"; 
            }
            break;
        case 'qlkv':
            $khuvuc = get_all_khuvuc();
            include "admin/ql-khuvuc.php"; 
            break;
        case 'add_khuvuc':
            //lấy all phường cho admin chọn
            $phuong = get_phuong();
            //lấy nhân viên giao hàng
            $nv_delivery = get_all_nv_giaohang();
            include "admin/add-khuvuc.php"; 
            break;
        case 'add-kv_delivery':
            if (isset($_POST['themkv'])) {
                $kv = $_POST['phuong_id'];
                $nv = $_POST['nv_id'];
                add_khuvuc($kv, $nv);
                echo "<script>alert('Thêm khu vực thành công!'); 
                        window.location='index.php?act=qlkv';
                    </script>";
                exit();
            }
            break;
        case 'update-kv':
            if(isset($_GET['id'])){//id khu vực
            $kv = get_kv_cansua($_GET['id']);
            //lấy all phường cho admin chọn
            $phuong_hientai = 
            $phuong = get_phuong();
            //lấy nhân viên giao hàng
            $nv_delivery = get_all_nv_giaohang();
            include "admin/update-khuvuc.php"; 
            }
            break;
        case 'xuli-up-kv':
            if(isset($_POST['capnhat'])){
                $makv = $_POST['makv'];
                $idphuong = $_POST['phuong_id'];
                $idnv = $_POST['nv_id'];
                $status_kv = $_POST['kv_status'];
                update_kv($makv, $idphuong, $idnv, $status_kv);
                echo "<script>alert('Cập nhật khu vực thành công!'); 
                        window.location='index.php?act=qlkv';
                    </script>";
                exit();
            }
            break;
        case 'search-khuvuc':
            if (isset($_POST['timkiem']) && !empty($_POST['nhaptim'])) {
                    $kyw = $_POST['nhaptim']; 
                    $khuvuc = search_kv_by_name($kyw); 
                    include "admin/search_kv.php"; 
                } 
            break;
        case 'up-login-nv':
            if (isset($_POST['capnhat']) && !empty($_POST['capnhat'])) {
                    $username = $_POST['ten_dang_nhap'];
                    $pass = $_POST['mat_khau']; 
                    $idtk = $_POST['idtk'];
                    $idnv = $_POST['idnv'];
                    update_login_employee($idtk, $username, $pass); 
                    echo "<script>
                        alert('Cập nhật thông tin thành công!');
                        window.location = 'index.php?act=detail-nv&id=" . $idnv . "';
                    </script>";

                exit();
                } 
            break;
        case 'xuat-hd':
            if (isset($_GET['id'])) {
                $madon = $_GET['id'];
                $info_hd = get_info_hoadon($madon);
                $makh = $info_hd[0]['KH_ID'];
                // Nội dung mã QR
                $qr_content = "http://localhost/LUAN_VAN/tichdiem.php?madon=$madon&makh=$makh";

                // Đường dẫn và tên file QR code
                $qr_filename = "qrcode_$madon.png";
                $qr_path = "qrcode/" . $qr_filename;

                // Tạo thư mục nếu chưa có
                if (!file_exists('qrcode')) {
                    mkdir('qrcode', 0777, true);
                }

                // Sinh ảnh QR code
                QRcode::png($qr_content, $qr_path, QR_ECLEVEL_L, 4);
                include "view/hoadon_pdf.php"; // View này sẽ xử lý PDF và hiển thị luôn
            }
            break;
        case 'tich-diem':
            include "view/header.php";
            $diem_da_tich = get_diem_datich($_SESSION['idcustomer']);//makh
            include "view/xem-tichdiem.php";
            include "view/footer.php";
            break;
       case 'all-danhgia':
            include "view/header.php";

            if (isset($_GET['masp'])) {
                $idsp = $_GET['masp'];
                $page = $_GET['page'] ?? 1;
                $limit = 20;
                $start = ($page - 1) * $limit;
                $filter_star = $_GET['sao'] ?? '';

                // Lấy đánh giá (có phân trang và lọc sao)
                $reviews = get_reviews_paginated($idsp, $start, $limit, $filter_star);

                // Tổng số đánh giá để tính tổng số trang
                $total_reviews = count_reviews($idsp, $filter_star);
                $total_pages = ceil($total_reviews / $limit);
                $avg_data = get_avg_rating($idsp);
                $stats = get_rating_statistics($idsp);
                // lấy tên sản phẩm
                $tensp = get_tensp($idsp);
            }

            include "view/all-danhgia.php";
            include "view/footer.php";
            break;
        // case 'list_sanpham':
        //     if(isset($_GET['iddm'])){
        //         $kq = getall_product($id);
        //         include "admin/loc-sanpham.php";
        //     }
        //     break;
        case 'get_slton':
            if (isset($_GET['masp'])) {
                $masp = $_GET['masp'];
                $conn = ketnoidb();

                $sql = "SELECT SP_SLTON FROM san_pham WHERE SP_MASP = ?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$masp]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($row) {
                    echo $row['SP_SLTON'];
                } else {
                    echo 0;
                }
            }
            break;
        case 'check_slton_ajax':
           if (isset($_POST['masp'])) {
                $masp = $_POST['masp'];
                $conn = ketnoidb();

                $sql = "SELECT SP_SLTON FROM san_pham WHERE SP_MASP = ?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$masp]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($row) {
                    echo $row['SP_SLTON'];
                } else {
                    echo 0;
                }
            } else {
                echo "Thiếu mã sản phẩm";
            }
             exit(); // ✅ Quan trọng: kết thúc luôn, không chạy xuống dưới
            break;
        case 'qlpg':
                // Phân trang
                $limit = 20;
                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $start = ($page - 1) * $limit;             
                $phi = get_phigiao($start, $limit);

                // Lấy tổng số sản phẩm để chia trang
                $conn = ketnoidb();            
                $stmt_count = $conn->prepare("SELECT COUNT(*) FROM phi_giao");
                $stmt_count->execute();
                $total_fee = $stmt_count->fetchColumn();//tổng số sp
                $total_pages = ceil($total_fee / $limit);//trả về số trang
            include "admin/ql-phigiao.php";
            break;
        case 'add_phigiao':
            include "admin/add-phigiao.php";
            break;
        case 'add-fee':
            if(isset($_POST['fee'])){
                $kc_ct = number_format($_POST['kc-cantren'], 2, '.', '');
                $kc_cd = number_format($_POST['kc-canduoi'], 2, '.', '');
                $tl_ct = str_replace('.', '', $_POST['tl-cantren']);
                $tl_cd = str_replace('.', '', $_POST['tl-canduoi']);
                $phi = str_replace('.', '', $_POST['phi']);
                $ngay = $_POST['ngay'];

                add_phigiao($kc_ct, $kc_cd, $tl_ct, $tl_cd, $phi, $ngay);
                 echo "<script>
                        alert('Thêm phí giao thành công!');
                        window.location = 'index.php?act=qlpg';
                    </script>";

                exit();
            }

            break;
        case 'update-phigiao':
            if(isset($_GET['date'])){
                $idkc = $_GET['idkc'];
                $idtl = $_GET['idtl'];
                $info_fee = get_info_fee($_GET['date'], $idkc, $idtl);
                include "admin/update-phigiao.php";
            }
            
            break;
        case "update-fee":
            if (isset($_POST['upfee'])) {
                $kc_cantren = number_format($_POST['kc-cantren'], 2, '.', '');
                $kc_canduoi = number_format($_POST['kc-canduoi'], 2, '.', '');
                $tl_cantren = str_replace('.', '', $_POST['tl-cantren']);
                $tl_canduoi = str_replace('.', '', $_POST['tl-canduoi']);
                $phi = str_replace('.', '', $_POST['phi']);
                $ngay = $_POST['ngay'];
                $idkc = $_POST['idkc'];
                $idtl = $_POST['idtl'];
                $ngayhientai = $_POST['ngayhientai'];

                update_phigiao($kc_cantren, $kc_canduoi, $tl_cantren, $tl_canduoi, $idkc, $idtl, $phi, $ngay, $ngayhientai);
                // Thông báo thành công (tuỳ ý bạn có thể redirect hoặc hiển thị)
                echo "<script>alert('Cập nhật phí giao thành công!'); window.location.href='index.php?act=qlpg';</script>";
            }
            break;
            case 'xem-fee':
                include "view/header.php";
                // Phân trang
                $limit = 20;
                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $start = ($page - 1) * $limit;             
                $phi = get_phigiao_two($start, $limit);

                // Lấy tổng số sản phẩm để chia trang
                $conn = ketnoidb();            
                $stmt_count = $conn->prepare("SELECT COUNT(*) FROM phi_giao");
                $stmt_count->execute();
                $total_fee = $stmt_count->fetchColumn();//tổng số sp
                $total_pages = ceil($total_fee / $limit);//trả về số trang
                include "view/xem-phigiao.php";
                include "view/footer.php";
                break;
        //NHÂN VIÊN
        case 'nhanvien':
            $don_hang_hom_nay = count_don_hang_chua_giao($_SESSION['id_nv']);//idtk
            $so_don_thanh_cong = count_don_hang_thanh_cong($_SESSION['id_nv']);
            $so_don_that_bai = count_don_hang_bi_huy($_SESSION['id_nv']);
            $idnv = get_id_nv($_SESSION['id_nv']);
            $khuvuc = get_khuvuc_nv($idnv);

            include "nhanvien/nhanvien.php"; 
            break;
        case 'cut':
                include "view/header.php";
                unset($_SESSION['ROLE']);
                unset($_SESSION['id_nv']);
                unset($_SESSION['name_nv'] );
                include "view/dangnhap.php";
                include "view/footer.php";
                break;
        case 'info-nv':
            $info = get_info_nv_giaohang($_SESSION['id_nv']);
            include "nhanvien/info-nhanvien.php"; 
            break;
        case 'capnhat-nhanvien':
            if (isset($_POST['capnhat'])) {
                $manv = $_POST['manv'];
                $hoten = $_POST['hoten'];
                $sodienthoai = $_POST['sodienthoai'];
                $email = $_POST['email'];
                $diachi = $_POST['diachi'];

                // Gọi hàm cập nhật (tùy bạn đặt tên)
                update_info_employee($manv, $hoten, $sodienthoai,$diachi, $email);

                // Gửi thông báo hoặc chuyển hướng
                echo "<script>alert('Cập nhật thông tin thành công!'); window.location='index.php?act=info-nv';</script>";
                exit();
            }
            break;
        case 'dsdh':
            //lấy trạng thái đơn hàng
            $trangthai = get_tt();
            $dh = get_dh_chua_giao_hang($_SESSION['id_nv']);
            include "nhanvien/dh-nhanvien.php"; 
            break;
            //xem chi tiết đơn hàng của nhân viên
        case 'det-dh-nv':
            if (isset($_GET['id'])) {
                $iddh = $_GET['id'];
                $dh = get_detail_donhang($iddh);
                $ls_status = get_ls_status($_GET['id']);
                include "nhanvien/detail-dh-nv.php"; 
             }
            break;
        case 'lsgh':
            $lsdh = get_dh_da_giao_tahnhcong($_SESSION['id_nv']);
            include "nhanvien/lichsugiao.php"; 
            break;

        case 'thongbao':
            include "controller/lienhe.php";
            break;
        //lấy khoảng cách
        case 'get_distance':
            if (isset($_POST['thanhpho'], $_POST['phuong_id'], $_POST['address_chitiet'])) {
                $phuong = get_name_phuong($_POST['phuong_id']);
                $full_address = $_POST['address_chitiet'] . ', ' . $phuong . ', ' . $_POST['thanhpho'];
                $distance = get_distance_from_store($full_address);
                echo json_encode(['distance' => $distance]);
            }
 
            break;
        // case 'scan_qr':
        //     include "view/header.php";
        //     include "scan_qr.php";
        //     include "view/footer.php";
        //     break;
        default:
            //lấy produce discount
            $discouts = getall_discount();
            //lấy sp mới
            $newproduce = getall_sp(0);
            //lấy sp nhiều lượt xem
            $view = getall_sp(1);
            $dsdm=getall_dm();
            include "view/header.php";
            include "view/trangchu.php";
            include "view/footer.php";
            break;
    }
    } else{
            $discouts = getall_discount();
            //lấy sp mới
            $newproduce = getall_sp(0);
            //lấy sp nhiều lượt xem
            $view = getall_sp(1);
            $dsdm=getall_dm();
            include "view/header.php";
            include "view/trangchu.php";
            include "view/footer.php";
    }
?>