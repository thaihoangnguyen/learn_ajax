<?php
    include 'db.php';

    $sql_quocgia = mysqli_query($conn, "select * from quocgia order by id_quocgia asc");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Import jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Import bootstrap -->
        <!-- Latest compiled and minified CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Latest compiled JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>
    
    <div class="container">
        <div class="col-md-12">
            <h3>Insert dữ liệu trong Form</h3>
            <form method="POST" id="insert_data_hoten">
                <div class="md-3 mt-3">
                    <label class="form-label">Họ và tên</label>
                    <input type="text" class="form-control" id="hoten" placeholder="Điền họ và tên">
                </div>
                <div class="md-3 mt-3">
                    <label class="form-label">Số Phone</label>
                    <input type="text" class="form-control" id="sophone" placeholder="Số Phone">
                </div>
                <div class="md-3 mt-3">
                    <label class="form-label">Địa Chỉ</label>
                    <input type="text" class="form-control" id="diachi" placeholder="Địa chỉ">
                </div>
                <div class="md-3 mt-3">
                    <label class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" placeholder="Email">
                </div>
                <div class="md-3 mt-3">
                    <label class="form-label">Ghi Chú</label>
                    <input type="text" class="form-control" id="ghichu" placeholder="Ghi chú">
                </div>
                <div class="md-3 mt-3">
                    <input type="button" value="Insert" id="button_insert" name="insert_data" class="btn btn-success">
                </div>
            </form>

            <div class="md-3 mt-3">
                <h3>Load dữ liệu bằng Ajax</h3>
                <div id="load_data">

                </div>
                <h3>Select dữ liệu bằng Ajax</h3>
                    <label for="">Quốc gia</label>
                    <select class="form-control" id="quocgia" name="quocgia">
                        <option value="">------Chọn quốc gia------</option>
                        <?php
                            while($row_quocgia = mysqli_fetch_array($sql_quocgia)){
                                echo '<option value="'.$row_quocgia['id_quocgia'].'">'.$row_quocgia['tenquocgia'].'</option>';
                            }
                        ?>
                        
                    </select><br>
                    <label for="">Thủ đô</label>
                    <select class="form-control" id="thudo" name="thudo">
                    </select>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('#quocgia').change(function(){
                var id_quocgia = $(this).val();
                $.ajax({
                    url: "ajax_action.php",
                    method: "POST",
                    data:{id_quocgia:id_quocgia},
                    success:function(data){


                        $('#thudo').html(data);
                    
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function(){  //khi trang được reset thì mọi cái trong này đều được thực thi
            
            function fetch_data(){
                $.ajax({
                    url: "ajax_action.php",
                    method: "POST",
                    success:function(data){
                        // // Sau khi thêm thành công các trường dữ liệu sẽ được reset trống
                        // $('#insert_data_hoten')[0].reset();

                        $('#load_data').html(data);
                    
                    }
                });
            }
            fetch_data();


            // delete dữ liệu
            $(document).on('click', '.del_data', function(){
                var id_del = $(this).data('id_del');
                $.ajax({
                        url: "ajax_action.php",
                        method: "POST",
                        data:{id_del:id_del},
                        success:function(data){

                            alert("Delete dữ liệu thành công");   
                            fetch_data();
                        }
                });
            }); 





            // edit dữ liệu
            function edit_data( id, //id khách hàng cần sữa
                                text, //cái dữ liệu cần lấy
                                column_name){  //cái cột cần thay đổi dữ liệu

                    $.ajax({
                        url: "ajax_action.php",
                        method: "POST",
                        data:{id:id, text:text, column_name},
                        success:function(data){

                            alert("Edit dữ liệu thành công");   
                            fetch_data();
                        }
                    });

            }
            $(document).on('blur', '.ten', function(){
                var id = $(this).data('id1');
                var text = $(this).text();
                edit_data(id, text, "hoten");
            }); 
            $(document).on('blur', '.sophone', function(){
                var id = $(this).data('id2');
                var text = $(this).text();
                edit_data(id, text, "sophone");
            }); 
            $(document).on('blur', '.diachi', function(){
                var id = $(this).data('id3');
                var text = $(this).text();
                edit_data(id, text, "diachi");
            }); 
            $(document).on('blur', '.email', function(){
                var id = $(this).data('id4');
                var text = $(this).text();
                edit_data(id, text, "email");
            }); 
            $(document).on('blur', '.ghichu', function(){
                var id = $(this).data('id5');
                var text = $(this).text();
                edit_data(id, text, "ghichu");
            }); 

            


            //chèn dữ liệu
            $('#button_insert').on('click',function(){
            var hoten = $('#hoten').val();
            var sophone = $('#sophone').val();
            var diachi = $('#diachi').val();
            var email = $('#email').val();
            var ghichu = $('#ghichu').val();

            if(hoten=="" || sophone=="" || diachi=="" || email==""){
                alert("Các trường không được bỏ trống");
            }else{
                $.ajax({
                    url: "ajax_action.php",
                    method: "POST",
                    data:{hoten:hoten, diachi:diachi, sophone:sophone, email:email, ghichu:ghichu},
                    success:function(data){

                        alert("Thêm dữ liệu thành công");   
                        // // Sau khi thêm thành công các trường dữ liệu sẽ được reset trống

                        $('#insert_data_hoten')[0].reset();
                        fetch_data();
                    }
                });
            }

            });

        });
    </script>

</body>
</html>