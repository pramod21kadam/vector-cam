<?php
   class db_handler{
        var $conn;

        //Constructor
        function __construct() {
            $servername = "localhost";
            $username = "username";
            $password = "password";
            $db = 'vector_cam';
            $this->conn = new mysqli( $servername, $username, $password, $db );
        }

        //Signup function
        public function sign_up($f_name , $l_name , $email_id , $password){
            if($password and $f_name and $l_name and $email){
                $sql = "insert INTO customer(email,password,first_name,last_name) values('$email_id','$password','$f_name ',' $l_name');";
                if ( ($this->conn->query($sql)) == TRUE) {
                    return TRUE;
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                    return FALSE;
                }
            }
        }

        //Signin function
        public function sign_in($email_id , $password){
            $sql = "SELECT count(*) from customer where email ='". $email_id ."' password = '". $password ."';";
            $result = mysqli_fetch_row($this->conn->query(sql));
            if ($result){
                return false;
            }
            return true;
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
    }
?>