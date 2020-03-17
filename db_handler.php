<?php
   class db_handler{
        var $conn;

        function __construct() {
            $servername = "localhost";
            $username = "username";
            $password = "password";
            $db = 'vector_cam';
            $this->conn = new mysqli_connect($servername, $username, $password , $db);
        }

        public function sign_up($f_name , $l_name , $email_id , $password){
            $sql = "INSERT INTO customer(email,password,first_name,last_name) values('$email_id' ,'$password','$f_name ',' $l_name');";
            if ( ($this->conn->query($sql)) == TRUE) {
                return TRUE;
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
                return FALSE;
            }

        }
        
        public function sign_in($email_id , $password){
            $sql = "SELECT count(*) from customer where email ='". $email_id ."' password = '". $password ."';";
            $result = $this->conn->query(sql);
            if ($result == 0){
                return false;
            }
            return true;
        }

        public function show_products(){
            $sql = "SELECT * FROM PRODUCTS";
            $result = $this->conn->query($sql);
            return $sql;
        }

        public function add_to_cart(){

        }

        
        
        
        // private functions
        private function check_cart(){
            $email = session_id();
        }
    }
?>