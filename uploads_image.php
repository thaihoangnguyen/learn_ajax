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
            <form action="ajax_action_image.php" method="post" id="submit_form">
                <div class="form-group">
                    <label for="">Chọn ảnh</label>
                    <input type="file" name="file" id="image_file">
                    <span class="help_block">Cho phép ảnh : jpg, jpeg, png, gif</span>
                </div>
                <input type="submit" name="uploads_button" class="btn btn-success" value="uploads">
            </form>
            <hr>
            <h3 align="center">Xem trước ảnh</h3>
            <div id="image_preview">

            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('#submit_form').on('submit', function(e){
                e.preventDefault();  //khi nhấn nút upload sẽ giúp trang k cần reset lại
                $.ajax({
                    url:"ajax_action_image.php",
                    method:"POST",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success:function(data){
                        $('#image_preview').html(data);
                        $('#image_file').val('');
                    }
                });
            });

            $(document).on('click', '#remove_button', function(){
                if(confirm("Bạn có muốn xóa ảnh này không ?")){
                    var path = $('#remove_button').data("path");
                    $.ajax({
                        url: "ajax_action_image.php",
                        method: "POST",
                        data:{path:path},
                        success:function(data){
                            $('#image_preview').html('');
                            alert("Đã xóa ảnh");
                        }
                    });
                }else{
                    return false;
                }
            }); 
        });
    </script>

    
</body>

</html>