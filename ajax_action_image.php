<?php
    // upload 1 ảnh
    if($_FILES['file']['name'] != ''){
        $extension = explode(".", $_FILES['file']['name']);
        $file_extension = end($extension);
        $allowed_type = array("jpg", "jpeg", "png", "gif");
        if(in_array($file_extension, $allowed_type)){
            $new_name = rand().".".$file_extension;
            $path = "./uploads/".$new_name;
            if(move_uploaded_file($_FILES['file']['tmp_name'], $path)){
                echo '  <div class="col-md-8">
                            <img src="'.$path.'" class="img-responsive">
                        </div>
                        <div class="col-md-2">
                            <button type="button" data-path="'.$path.'" id="remove_button" class="btn btn-danger">X</button>
                        </div>
                                    
                            ';
            } else{
                echo '<script>alert("File ảnh không có hiệu lực")</script>';
            }
        }else{
            echo '<script>alert("Làm ơn chọn file ảnh dùm")</script>';
        }

        //xóa ảnh
        if(!empty($_POST['path'])){
            if(unlink($_POST['path'])){
                echo '';
            }   
        }
    }
?>