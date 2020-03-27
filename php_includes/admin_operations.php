<?php
    require "db_handler.php";
    $db = new db_handler;

    switch($_GET["action"]){
        case 0:
            if($_POST["product_id"]){
                if($_POST["intent"] == "true"){
                    if($db->add_featured_product($_POST["product_id"])){
                        header("location:http://127.0.0.1:8080/admin_dashbord.php?action=1");
                        die();
                    }
                }
                else{
                    if($db->remove_featured_product($_POST["product_id"])){
                        header("location:http://127.0.0.1:8080/admin_dashbord.php?action=1");
                        die();
                    }
                }
            }
        break;

        case 1:
            
            // creating essential directories
            mkdir("../static/images/products/".$_POST["product_id"]."/");
            
            // saving thumbnail
            $file_tmp =$_FILES['thumbnail']['tmp_name'];
            move_uploaded_file($file_tmp,"../static/images/products/".$_POST["product_id"]."/".$_POST["product_id"].".jpg");

            // saving description
            $file_tmp =$_FILES['description']['tmp_name'];
            move_uploaded_file($file_tmp,"../static/descriptions/".$_POST["product_id"].".txt");

            // saving banner_images
            for($i = 0; $i<count($_FILES["banner"]["name"]) ; $i++){
                $file_tmp =$_FILES['banner']['tmp_name'][$i];
                move_uploaded_file($file_tmp,"../static/images/products/".$_POST["product_id"]."/banner_".$i.".png");
            }

        break;
        
    }

   
?>