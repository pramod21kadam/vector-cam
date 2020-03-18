<?php
   class db_handler{
        var $conn;

        //Constructor
        function __construct() {
            $servername = "localhost";
            $username = "onkar";
            $password = "onkar123";
            $db = 'vector_cam';
            $this->conn = new mysqli( $servername, $username, $password, $db );
        }

        //Signup function
        public function sign_up($f_name , $l_name , $email_id , $password){
            $sql = "insert into customer(password , email,first_name,last_name) values('".$password."','".$email_id."','".$f_name."','".$l_name."');";
            if ( ($this->conn->query($sql)) == true) {
                return true;
            } else {
                return false;
            }
        }

        //Signin function
        public function sign_in($email_id , $password){
            $sql = "select * from customer where email ='".$email_id."' and password = '".$password."';";
            $result = $this->conn->query($sql);
            if ($result->num_rows > 0){
                return true;
            }
            return false;
        }


        //display product information
        //returns array
        // order id, name, price, quantity
        public function show_products(){
            $sql = "SELECT * FROM PRODUCTS";
            $result =  mysqli_fetch_row($this->conn->query($sql));
            return $result;
        }


        // function creates cart (if not) and adds item to cart 
        public function add_to_cart($product_id, $quantity){
            $cart_info = $this->show_cart();
            if($cart_info){
                
            }
        }

        // function deletes cart
        public function delete_cart(){
            
        }

        // function returns cart details
        // order cart_id, quantity, amount, product_id 
        public function show_cart(){
            $cart_id = check_cart();
            if ($cart_id){
                // get number fo items and amount from cart_item
                $sql = "select * from cart_item where cart_id= $cart";
                $cart_info= mysqli_fetch_row($this->conn->query($sql));
                return $cart_info;
            }
            else{
                return false;
            }
        }

        // private functions
        private function check_cart(){
            $email = session_id();
            $cart_id = mysqli_fetch_row($this->conn->query("SELECT cart_id FROM cart WHERE email='$email';"));
            if ($cart_id == null){
                return false;
            }else{
            return $cart_id;
            }
        }


        function __destruct(){
            $this->conn->close();
        }
    }
?>