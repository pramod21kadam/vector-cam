<?php
   class db_handler{
       public function sign_up($email_id , $phone_number , $password){
           return true;
       }
       public function sign_in($email_id , $password){
           return true;
       }

       public function delete_account($email , $password){
           return true;
       }
   }
?>