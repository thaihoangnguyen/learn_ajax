
<?php
    include 'db.php';

    // Select dữ liệu
    if(isset($_POST['id_quocgia'])){
        $id_quocgia = $_POST['id_quocgia'];
        $sql_thudo = mysqli_query($conn, "select * from thudo where id_quocgia='$id_quocgia'"); 
        $output = '';
        $output = '<option>-----Chọn thủ đô------</option>';
            while($rows_thudo = mysqli_fetch_array($sql_thudo)){
                $output .= '<option value="'.$rows_thudo['id_thudo'].'">'.$rows_thudo['tenthudo'].'</option>';
                
            }
            echo $output; 
        }



    // Chèn dữ liệu
    if(isset($_POST['hoten'])){
        $hoten = $_POST['hoten'];
        $sophone = $_POST['sophone'];
        $email = $_POST['email'];
        $diachi = $_POST['diachi'];
        $ghichu = $_POST['ghichu'];

        $result = mysqli_query($conn, "insert into khachhang(hoten, diachi, email, sophone, ghichu) values ('$hoten', '$diachi', '$email', '$sophone', '$ghichu') ");

    }



    //Delete dữ liệu
    if(isset($_POST['id_del'])){
        $id_del = $_POST['id_del'];
        $result = mysqli_query($conn, "delete from khachhang where id_kh='$id_del'");
    }



    //Edit dữ liệu
    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $text = $_POST['text'];
        $column_name = $_POST['column_name'];

        $result = mysqli_query($conn, "update khachhang set $column_name='$text' where id_kh='$id'");
    }


    //Lấy dữ liệu - thiết lập các phần tử html
    $output = '';
    $sql_select = mysqli_query($conn, "select * from khachhang order by id_kh desc");
    $output .='
    
        <div class="table table-responsive">
            <table class="table table-striped">
                <tr>
                    <th>Họ và tên</th>
                    <th>Số Phone</th>
                    <th>Địa chỉ</th>
                    <th>Email</th>
                    <th>Ghi chú</th>
                    <th>Quản lý</th>
                </tr>
            
    ';

    if(mysqli_num_rows($sql_select)>0){

        while($rows = mysqli_fetch_array($sql_select)){
            $output .='
                <tr>
                    <td class="ten" data-id1='.$rows['id_kh'].' contenteditable>'.$rows['hoten'].'</td>
                    <td class="sophone" data-id2='.$rows['id_kh'].' contenteditable>'.$rows['sophone'].'</td>
                    <td class="diachi" data-id3='.$rows['id_kh'].' contenteditable>'.$rows['diachi'].'</td>
                    <td class="email" data-id4='.$rows['id_kh'].' contenteditable>'.$rows['email'].'</td>
                    <td class="ghichu" data-id5='.$rows['id_kh'].' contenteditable>'.$rows['ghichu'].'</td>
                    <td><button class="btn btn-sm btn-danger del_data" name="delete_data" data-id_del='.$rows['id_kh'].'>Xóa</button></td>
                </tr>
            ';
        }

    }else{
        $output .='
            <tr>
                <td colspan="5">Dữ liệu chưa có</td>
            </tr>
        ';
    }

    $output .='
            </table>
        </div>
    ';



    echo $output;
?>

