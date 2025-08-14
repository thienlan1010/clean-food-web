<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
         main {
            flex: 1;
            margin-top: 170px;
        }
        /* Bảng sản phẩm */
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        /* Header bảng */
        table th {
            background-color:rgb(19, 198, 82);
            color: #fff;
            padding: 12px;
            text-align: center;
            font-weight: bold;
        }

        /* Dòng dữ liệu */
        table td {
            padding: 10px;
            text-align: center;
            vertical-align: middle;
            border-bottom: 1px solid #ddd;
        }

        /* Hover dòng */
        table tr:hover {
            background-color: #f1f1f1;
        }
        .danhgia{         
            font-size: 30px;
           
            text-align: center;
            margin: 40px 0 30px;
            color: #000;
        }
        .notreview{
             text-align: center;
             color: red;
        }
    </style>
</head>
<body>
    <main>
        <div class="container mt-3">
                <div class="row mb-4">
                    <h2 class="danhgia">Tất cả các đánh giá</h2>

                    <?php 
                            if(isset($danhgia) && (count($danhgia) > 0)){
                echo '<table>
                        <tr class="text-center">
                                <th>STT</th>  
                                <th>Mã đánh giá</th>                          
                                <th>Tên KH</th>
                                <th>Mã DH</th>
                                <th>Sản phẩm</th>
                                <th>Số sao</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                        </tr>';
                        //>1 tức có dl 
                                $i=1;
                                foreach ($danhgia as $dg) {
                                    echo '<tr class="text-center mb-2">
                                            <td>'.$i.'</td>                                        
                                            <td>'.$dg['DGSP_ID'].'</td>
                                            <td>'.$dg['KH_HOTEN'].'</td>
                                            <td>'.$dg['DH_MADH'].'</td>
                                            <td><img src="images/'.$dg['SP_HINH'].'" width="80px" height="60px"></td>
                                            <td>'.$dg['DGSP_SOSAO'].'</td>
                                            <td>'.$dg['DGSP_TRANGTHAI'].'</td>
                                            <td><a class="btn-edit" href="index.php?act=chitiet-danhgia&id='.$dg['DGSP_ID'].'&idkh='.$dg['KH_ID'].'"><i class="fa-solid fa-eye"></i></a>                                                       
                                            </td>
                                        </tr>';
                                        $i++;
                                }
                            }else{
                                echo '<p class="notreview">Chưa có đánh giá nào!</p>';
                            }
                            ?>                                                      
                    </table>
                  

                       
                </div>
            </div>
    </main>
</body>
</html>