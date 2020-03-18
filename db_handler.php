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
        //function will not execute if parameters passed are null 
        public function sign_up($f_name , $l_name , $email_id , $password){
            if(true){
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
            $sql = "SELECT count(*) from customer where email = '$email_id' password = '$password';";
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
            $email = _SESSION["mail_id"];
            $sql = "select cart_id from cart where email='$email'";
            $cart_id = mysqli_fetch_row($this->conn->query($sql));
            //take elements from cart_item and back to product table
                    $sql = "SELECT product_id,quantity FROM cart_item where cart_id='$cart_id[0]'";
                    $product_details = ($this->conn->query($sql));
                    
                    while( $row = $product_details -> fetch_row()){
                        $product_id = $row[0];
                        $_quantity = row[1];
                        //take quantity of product from product table
                        $sql = "SELECT quantity FROM product WHERE product_id ='$product_id';";
                        $product_quantity = (($this->conn->query($sql))->fetch_row())[0];
                        $product_quantity += $_quantity;
                    }            
            //clear cart item table
            //clear entery from payment table
            //clear payment field from customer table
            //clear cart table
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
            $email = _SESSION["mail_id"];
            $cart_id = mysqli_fetch_row($this->conn->query("SELECT cart_id FROM cart WHERE email='$email';"));
            if ($cart_id == null){
                return false;
            }else{
            return $cart_id;
            }
        }
    }
?>