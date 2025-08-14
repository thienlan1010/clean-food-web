// function thevaogiohang(btn) {
//     // Lấy giỏ hàng mới nhất từ sessionStorage
//     var gh = sessionStorage.getItem('giohang');
//     var giohang = gh ? JSON.parse(gh) : [];

//     const card = btn.closest('.card');
//     const masp = card.dataset.id;
//     const tensp = card.querySelector('.card-title').innerText;
//     const giaText = card.querySelectorAll('.card-text')[1].innerText;
//     const gia = giaText.replace('Giá: ', '').replace('đ', '').trim();
//     const hinh = card.querySelector('a img').getAttribute('src');
//     const soluong = parseInt(card.querySelector('input[type="number"]').value);

//     let daCo = false;

//     for (let i = 0; i < giohang.length; i++) {
//         if (giohang[i][0] === masp) {
//             giohang[i][4] = parseInt(giohang[i][4]) + soluong;
//             daCo = true;
//             break;
//         }
//     }

//     if (!daCo) {
//         var sp = [masp, tensp, gia, hinh, soluong];
//         giohang.push(sp);
//     }
    
//     sessionStorage.setItem('giohang', JSON.stringify(giohang));
//     show_sl_sp();
//     alert('Đã thêm "' + tensp + '" vào giỏ hàng với số lượng: ' + soluong);
    
// }
function thevaogiohang(btn) {
    var gh = sessionStorage.getItem('giohang');
    var giohang = gh ? JSON.parse(gh) : [];

    const card = btn.closest('.card');
    const masp = card.dataset.id;
    const tensp = card.querySelector('.card-title').innerText;

    const giaText = card.querySelectorAll('.card-text')[1].innerText;
    const gia = giaText.replace('Giá: ', '').replace('đ', '').trim();

    const hinh = card.querySelector('a img').getAttribute('src');
    // const soluong = parseInt(card.querySelector('input[type="number"]').value);
    const inputSL = card.querySelector('input[type="number"]');
    const soluong = parseInt(inputSL.value);
    const slTon = parseInt(inputSL.max);

    // Kiểm tra nếu người dùng nhập vượt quá số lượng tồn kho
    if (soluong > slTon) {
        // alert('Số lượng mua vượt quá số lượng tồn kho!');
        alert("Chỉ còn lại " + slTon + " sản phẩm trong kho.");
        inputSL.value = slTon; // Gán lại bằng tồn kho
        return;
    }

    let daCo = false;

    // for (let i = 0; i < giohang.length; i++) {
    //     if (giohang[i][0] === masp) {
    //         giohang[i][4] = parseInt(giohang[i][4]) + soluong;
    //         daCo = true;
    //         break;
    //     }
    // }
    for (let i = 0; i < giohang.length; i++) {
        if (giohang[i][0] === masp) {
            const tongSL = parseInt(giohang[i][4]) + soluong;
            if (tongSL > slTon) {
                // alert('Tổng số lượng trong giỏ vượt quá số lượng tồn kho!');
                 alert('Chỉ còn '+ slTon +' sản phẩm, bạn đã có '+ parseInt(giohang[i][4]) + ' trong giỏ.');
                return;
            }

            giohang[i][4] = tongSL;
            daCo = true;
            break;
        }
    }

    if (!daCo) {
        var sp = [masp, tensp, gia, hinh, soluong];
        giohang.push(sp);
    }

    sessionStorage.setItem('giohang', JSON.stringify(giohang));
    show_sl_sp();
    //alert('Đã thêm "' + tensp + '" vào giỏ hàng với số lượng: ' + soluong);
    alert("Đã thêm vào giỏ hàng:))");
}


//thêm sản phẩm cho DB -> bo
// function themVaoGio(masp) {
//     const soluong = document.getElementById(`soluong-${masp}`).value;

//     fetch('index.php?act=them_vao_giohang', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/x-www-form-urlencoded'
//         },
//         body: `masp=${masp}&soluong=${soluong}`
//     })
//     .then(response => response.text())
//     .then(data => {
//         console.log(data); // hoặc hiện thông báo, v.v.
//     });
// }
//cái này là đã đăng nhập -> ok
// function themVaoGio(masp) {
//     const soluongInput = document.getElementById(`soluong-${masp}`);
//     const soluong = soluongInput.value;//lấy sl sp
   
//     fetch('index.php?act=them_vao_giohang', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/x-www-form-urlencoded'
//         },
//          body: `masp=${masp}&soluong=${soluong}`
//     })
//     .then(response => response.text())
//     .then(data => {
//          if (!isNaN(data)) {
//             // ✅ Cập nhật số lượng mới vào badge
//             document.querySelectorAll('.cart-badge').forEach(function(span) {
//                 span.textContent = data;
//             });
//             // ✅ Hiển thị thông báo thêm thành công
//             alert("Đã thêm vào giỏ hàng");
//         } else {
//             alert(data); // Có thể là "Bạn cần đăng nhập..." hoặc lỗi khác
//         }
//     })
//     .catch(error => {
//         console.error("Lỗi khi thêm vào giỏ hàng:", error);
//         alert("Có lỗi xảy ra, vui lòng thử lại.");
//     });
// }


function themVaoGio(masp) {
    const soluongInput = document.getElementById(`soluong-${masp}`);
    const soluong = parseInt(soluongInput.value);

    if (soluong < 1) {
        alert("Số lượng không hợp lệ!");
        return;
    }

    // Gọi PHP kiểm tra SL tồn trước khi gửi request thêm vào giỏ
    fetch('index.php?act=get_slton&masp=' + masp)
        .then(res => res.text())
        .then(slTon => {
            slTon = parseInt(slTon);

            if (soluong > slTon) {
                alert("Chỉ còn lại " + slTon + " sản phẩm trong kho.");
                soluongInput.value = slTon; // Reset về max
                return;
            }

            // Nếu hợp lệ, gọi thêm vào giỏ
            fetch('index.php?act=them_vao_giohang', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `masp=${masp}&soluong=${soluong}`
            })
            .then(response => response.text())
            .then(data => {
                if (!isNaN(data)) {
                    document.querySelectorAll('.cart-badge').forEach(function(span) {
                        span.textContent = data;
                    });
                    alert("Đã thêm vào giỏ hàng");
                } else {
                    alert(data);
                }
            })
            .catch(error => {
                console.error("Lỗi khi thêm vào giỏ hàng:", error);
                alert("Có lỗi xảy ra, vui lòng thử lại.");
            });
        })
        .catch(error => {
            console.error("Lỗi khi kiểm tra tồn kho:", error);
            alert("Không thể kiểm tra số lượng tồn.");
        });
}
