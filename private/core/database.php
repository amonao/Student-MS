<?php

/**
 * Database connection
 */

 class Database
 {
    private function connect()
     {
        $string = DBDRIVER .":host=;dbname=school_db";
        if (!$conn= new PDO($string, 'root', '')){
           die("could not connect to database");
        }
        return $conn;
     }

   

     
      public function query ($query, $data = array(), $data_type= "object")
         {
           $conn= $this->connect();
           $stm= $conn->prepare($query);

           if($stm){
              $check = $stm->execute($data);
              if($check){
                 if($data_type== "object"){
                 $data = $stm->fetchAll(PDO::FETCH_OBJ);
              } else {
                 $data = $stm->fetchAll(PDO::FETCH_ASSOC);
              }
              if(is_array($data) && count($data)>0){
                 return $data;
              }
              return true;
           }
           return false;
         }

   }
 }