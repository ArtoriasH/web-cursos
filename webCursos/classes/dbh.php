<?php
    class Dbh {
        protected function connect(){
            try{
                $user = "root";
                $password = "Widow1234";
                $dbh = new PDO('mysql:host=localhost;dbname=piabdm', $user, $password);
                return $dbh;
            }
            catch(PDOException $e){
                print "Error!:  " . $e->getMessage() . "<br/>";
                die();
            }
        }
    }
?>
