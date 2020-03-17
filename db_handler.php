<?php
   class db_handler{
        public $conn;

        function __construct() {
            $servername = "localhost";
            $username = "username";
            $password = "localhost";

            $this->conn = mysqli_connect($servername, $username, $password);
        }

        public function sign_up($f_name , $l_name , $email_id , $password){
            $sql = "INSERT INTO customer(email,password,first_name,last_name) values('". $email_id ."','". $password ."','". $f_name ."','".$l_name."');";
            if ( $conn->query($sql) === TRUE) {
                return TRUE;
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
                return FALSE;
            }

        }
        
        public function sign_in($email_id , $password){
            $sql = "select count(*) from customer where email ='". $email_id ."' password = '". $password ."';";
            $result = $conn->query(sql);
            if ($result == 0){
                return false;
            }
            return true;
        }

        public function show_products(){
            $sql = "SELECT * FROM PRODUCTS";
            $result = $conn->query($sql);
            return $sql;
        }

    }
?>