<?php
   class db_handler{
        private $conn;
        function __construct() {
            $servername = "localhost";
            $username = "onkar";
            $password = "onkar123";
            $db = 'vector_cam';
            $this->conn = new mysqli( $servername, $username, $password, $db );
        }

        public function sign_up($f_name , $l_name , $email_id , $password){
                $sql = "INSERT INTO customer(email,password,first_name,last_name) VALUES('$email_id','$password','$f_name ',' $l_name');";
                if ( ($this->conn->query($sql))) {
                    return true;
                    $this->conn->commit();
                } else {
                    return false;
                }
        }

        public function sign_in($email_id , $password){
            $sql = "SELECT count(*) from customer where email = '$email_id' AND password = '$password';";
            $result = mysqli_fetch_row($this->conn->query($sql))[0];
            if ($result){
                return true;
            }
            else{
                return false;
            }
        }

        public function count_accounts(){
            $sql = 'select count(*) from customer;';
            $result = $this->conn->query($sql);
            return $result->fetch_array()[0];
        }

        public function admin_sign_in($email , $password){
            $sql = 'select * from admin where email = "'.$email.'" and password = "'.$password.'";';
            $result = $this->conn->query($sql);
            if($result->num_rows == 1){
                return true;
            }
            return false;
        }

        public function get_admin_info($email){
            $sql = 'select * from admin where email = "'.$email.'";';
            $result = $this->conn->query($sql);
            return $result->fetch_assoc();
        }

        public function get_account_info($email){
            $sql = 'select * from customer where email = "'.$email.'";';
            $result = $this->conn->query($sql);
            return $result->fetch_assoc();
        }
        

        
        public function add_to_cart($product_id, $quantity){
            $product_quantity = (mysqli_fetch_row($this->conn->query("SELECT product_availability FROM product WHERE product_id='$product_id'")))[0];
            if($quantity < $product_quantity ){
                $cart_id = $this->check_cart();
                $amount = (mysqli_fetch_row($this->conn->query("SELECT amount FROM product WHERE product_id = '$product_id'; ")))[0];
                if($cart_id){
                    // check for the product in cart_item table
                        if( (mysqli_fetch_row( $this->conn->query("SELECT product_id FROM cart_item where cart_id = '$cart_id'") ))[0] ){
                                //get quantity of product from cart_item
                                $cart_item_quantity = mysqli_fetch_row($this->conn->query("SELECT quantity FROM cart_item WHERE product_id='$product_id' and cart_id='$cart_id' "))[0] + $quantity;
                                $cart_amount = mysqli_fetch_row($this->conn->query("SELECT quantity FROM cart_item WHERE product_id='$product_id' and cart_id = '$cart_id' "))[0] + ($quantity*$amount);
                                $update_cart = "UPDATE cart_item SET quantity = $cart_item_quantity, amount = $cart_amount WHERE cart_id='$cart_id'";
                                $this->conn->query($update_cart);

                                //update product table
                                $product_quantity = $product_quantity - $quantity;
                                $update_product_quantity = "UPDATE product SET product_availability = $update_product_quantity WHERE product_id = '$product_id';";
                                $this->conn->query($update_product_quantity);

                                //update payment table
                                $update_payment_amount = "UPDATE payment SET payment_amount = (SELECT amount FROM cart_item WHERE cart_id = '$cart_id') WHERE cart_id ='$cart_id';";
                                $this->conn->query($update_payment_amount);

                            }
                        else{                       //add product in cart_item
                                $cart_amount = $amount*$quantity;
                                $sql = "INSERT INTO cart_item(cart_id, quantity, amount, product_id) VALUES('$cart_id', $quantity, $cart_amount, '$product_id');";
                                $this->conn->query($sql);

                                $this->conn->query("UPDATE payment SET amount= $cart_amount WHERE cart_id ='$cart_id'");

                                $update_product_quantity -=  $quantity;
                                $this->conn->query("UPDATE product SET product_availability = $update_product_quantity");

                        }
                }
                else{
                    $this->create_cart();
                    add_to_cart($product_id,$quantity);
                }
            }
            else{
                return false;
            }
        }

        private function create_cart(){
            $cart_id = date('Y.d.h.i.').microtime(True);
            $email = $_SESSION["mail_id"];
            //insert cart_id,email into cart
            $insert_cart_id = "INSERT INTO cart( cart_id, email ) VALUES( '$cart_id', $email);";
            $insert_payment_id = "INSERT INTO payment_id( payment_id, cart_id, email ) VALUES('$cart_id', 'cart_id', $email);";
            $update_customer = "UPDATE customer SET payment_id = '$cart_id' WHERE email = '$email'; ";
            $update_cart = "UPDATE cart SET payment_id = '$cart_id' WHERE cart_id = '$cart_id';";
            $this->conn->query($insert_cart_id);
            $this->conn->query($insert_payment_id);
            $this->conn->query($update_customer);
            $this->conn->query($update_cart);
            return true;
        }

        // public function place_order($address){
        //     if($address){
        //         $payment_id = mysqli_fetch_row($this->conn->query("SELECT payment_id FROM customer where"))[0];
        //         $email = $_SESSION["mail_id"];
        //         $place_order = "INSERT INTO place_order VALUES('$payment_id', '$email', $address, $payment_id)";
        //         return true;
        //     }
        //     else{
        //         return false;
        //     }
        // }

        public function place_order($email , $product_id , $address , $quantity , $price){
            $sql = 'insert into orders(email , product_id , address , quantity , price , placed_date) values ("'.$email.'" , "'.$product_id.'" , "'.$address.'" , '.$quantity.' , '.$price.', "'.date("Y-m-d").'");';
            if($this->conn->query($sql)){
                $this->conn->commit();
                return true;
            }
            return false;
        }

        public function cancle_order($order_id){
            $sql = 'delete from orders where order_id = "'.$order_id.'";';
            $this->conn->query($sql);
            return true;
        }

        public function sum_transactions(){
            $sql = 'select sum(amount) from transaction where transaction_date > "'.date("Y-m").'-00";';
            $result = $this->conn->query($sql);
            return $result->fetch_array()[0];
        }


        public function get_orders($email){
            $sql = 'select * from orders where email = "'.$email.'";';
            $result = $this->conn->query($sql);
            $orders = array();
            while($row = $result->fetch_assoc()){
                array_push($orders , $row);
            }
            return $orders;
        }

        public function get_ordes_email(){
            $sql = 'select * from orders group by email;';
            $result = $this->conn->query($sql);
            $orders = array();
            while($row = $result->fetch_assoc()){
                array_push($orders , $row);
            }
            return $orders;
        }

        // function deletes cart
        public function delete_cart(){
            $email = $_SESSION["mail_id"];
            $sql = "select cart_id from cart where email='$email'";
            $cart_id = mysqli_fetch_row($this->conn->query($sql));
            //take elements from cart_item and back to product table
                    $sql = "SELECT product_id,quantity FROM cart_item where cart_id='$cart_id[0]'";
                    $product_details = ($this->conn->query($sql));
                    while( $row = $product_details -> fetch_row()){
                        $product_id = $row[0];
                        $_quantity = row[1];
                        //take quantity of product from product table
                        $sql = "SELECT product_availability FROM product WHERE product_id ='$product_id';";
                        $product_quantity = (($this->conn->query($sql))->fetch_row())[0] + $_quantity;
                        $update = "UPDATE product SET product_availability = $product_quantity WHERE product_id = '$product_id';";
                        $this->conn->query($update);
                        //delete from cart
                        $delete = "DELETE FROM cart_item WHERE cart_id = '$cart_id';";
                        $this->conn->query($delete);
                        //update payment_id entery in customer
                        $update = "UPDATE customer SET payment_id= NULL WHERE email='$email';";
                        //delete payment 
                        $delete="DELETE FROM payment WHERE cart_id = '$cart_id';";
                        $this->conn->query($delete);
                        //delete cart
                        $delete = "DELETE cart  WHERE cart_id = '$cart_id';";
                        $this->conn->query($delete);
                    }
        }

        // function returns cart details
        // order cart_id, quantity, amount, product_id 
        public function show_cart(){
            $cart_id = check_cart();
            if ($cart_id){
                // get number fo items and amount from cart_item
                $sql = "SELECT * FROM cart_item WHERE cart_id= $cart";
                $result = $this -> conn -> query($sql);
                $cart = array();
                while($row = $result->fetch_row()){
                    array_push($cart,$row);
                }
                return $cart;
            }
            else{
                return false;
            }
        }

        //display product information
        //returns 2-D array
        public function get_products(){
            $sql = " select * from product where product_id not in (select * from featured_product);";
            $result = $this->conn->query($sql);
            $products = array();
            while( $row = $result->fetch_assoc() ){
                array_push($products, $row);
            }
            return $products;
        }

        //function to get list of featured products
        public function get_featured_products(){
            $sql = "select * from product where product_id in (select * from featured_product);";
            $result = $this->conn->query($sql);
            $products = array();
            while($row = $result->fetch_assoc()){
                array_push( $products , $row);
            }
            return $products;
        }

        //function to get inforamtion about product using product id
        public function get_product_info($product_id){
            $sql = "select * from product where product_id = '".$product_id."'";
            $result = $this->conn->query($sql);
            return $result->fetch_assoc();
        }

        public function count_products(){
            $sql = 'select count(*) from product;';
            $result = $this->conn->query($sql);
            return $result->fetch_array()[0];
        }

        public function add_product($product_id , $product_name , $product_avilability , $product_price , $product_summary){
            $sql = 'insert into product values("'.$product_id.'" , "'.$product_name.'" , '.$product_price.' , '.$product_avilability.' , "'.$product_summary.'");';
            if($this->conn->query($sql)){
                $this->conn->commit();
                return true;
            }
            return false;
        }

        public function add_featured_product($product_id){
            $sql = 'insert into featured_product values("'.$product_id.'");';
            if($this->conn->query($sql)){
                $this->conn->commit();
                return true;
            }
            return false;
        }

        public function remove_featured_product($product_id){
            $sql = 'select * from featured_product where product_id = "'.$product_id.'";';
            $result = $this->conn->query($sql);
            if($result->num_rows == 0){
                return false;
            }

            $sql = 'delete from featured_product where product_id = "'.$product_id.'";';
            if($this->conn->query($sql)){
                $this->conn->commit();
                return true;
            }
            return false;
        }

        public function remove_product($product_id){
            $fp = $this->remove_featured_product($product_id);
            $sql = 'delete from product where product_id = "'.$product_id.'";';
            if($this->conn->query($sql)){
                $this->conn->commit();
                return true;
            }
            if($fp == true){
                $this->add_featured_product($product_id);
            }
            return false;
        }


        private function check_cart(){
            $email = $_SESSION["mail_id"];
            $cart_id = (mysqli_fetch_row($this->conn->query("SELECT cart_id FROM cart WHERE email='$email';")))[0];
            if ($cart_id){
                return $cart_id;
            }else{
            return false;
            }
        }
    }
?>
