<?php

/**
 * 
 * User Model
 * 
 */

 class User extends Model

 {
    protected $allowedColumns = [
       'firstname',
       'lastname',
       'email',
       'password',
       'gender',
       'rank',
       'date',
      ];


    protected $beforeInsert = [
       'make_user_id',
       'make_school_id',
       'hash_password'
      ];


   

    public function validate($DATA)
    {
       $this->errors = array();

      //check for firstname
       if(empty($DATA['firstname']) || !preg_match('/^[a-zA-Z]+$/', $DATA['firstname']) )
       {
          $this->errors['firstname'] = "Only letters alowed in first name";
       }

      //check for lastname
       if(empty($DATA['lastname']) || !preg_match('/^[a-zA-Z]+$/', $DATA['lastname']) )
       {
          $this->errors['lastname'] = "Only letters alowed in lastname name";
       }

      //check for password
       if(empty($DATA['password']) || $DATA['password'] !== $DATA['password2'])
       {
          $this->errors['password'] = "The passwords do not match";
       }


      //check for lenght of password
       if(strlen($DATA['password']) < 8)
       {
          $this->errors['password'] = "Password must be 8 characters long";
       }
      //check for email
       if(empty($DATA['email']) || !filter_var($DATA['email'], FILTER_VALIDATE_EMAIL ))
       {
          $this->errors['email'] = "Email is not valid";
       }


      //check if email exists
       if($this->where('email'== $DATA['email']))
       {
         $this->errors['email'] = "That email is already in use";
       }


       //check for gender
       $genders= ['female', 'male'];
       if(empty($DATA['gender']) || !in_array($DATA['gender'], $genders))
       {
          $this->errors['gender'] = "Gender is not valid";
       }


       $ranks= ['student', 'reception', 'admin', 'super_admin','lecturer' ];
       if(empty($DATA['rank']) || !in_array($DATA['rank'], $ranks))
       {
          $this->errors['rank'] = "Rank is not valid";
       }
      

       if(count($this->errors) == 0)
        {
           return true;
        }
      return false;
    }

    public function make_user_id($data)
    {
       $data['user_id'] = random_string(60);
       return $data;
    }

    public function make_school_id($data)
    {
       if(isset($_SESSION['USER']->school_id))
       {
         $data['school_id'] = $_SESSION['USER']->school_id;
       }
       return $data;
    }

    public function hash_password($data)
    {
       $data['password'] = password_hash( $data['password'], PASSWORD_DEFAULT);
       return $data;
    }

    private function random_string($lenght)
    {
       $array= array(0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','w','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R', 'S','T','U','V','W','X','Y','Z');
       $text = "";

       for($x = 0; $x < $lenght; $x++)
       {
          $random= rand(0,61);
          $text .= $array[$random];
       }

       return $text;
    }
 }