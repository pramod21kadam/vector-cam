<?php
   class db_handler{
       public function sign_up($f_name , $l_name , $email_id , $password){
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