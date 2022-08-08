<?php

  include 'conn.php';

  class Create_Tables{

    public static $dbHelper;
    private static string $SQL;
    public static bool $response;

    function __construct(){
      /**
       * Constructor -> creates new object of Connection Class
       * -> Calls init function to create connection if null
       * @param none
       * @return none
       */

      self::$dbHelper = new DatabaseHelper;
      self::$dbHelper::init();      

      self::Create_User_Table(self::$dbHelper::$conn);
    }

    function Create_User_Table($conn){
      /**
       * Function to create users table
       * -> drops table if exists, (re)creates and populate
       * @param $conn
       * @return none       
       */

       //if conn is not null
      if ($conn){     
        self::$SQL = "DROP TABLE IF EXISTS tblusers"; //set query string

        //try-catch block to catch exceptions and errors
        try{
          $stmt = self::$dbHelper::$conn->prepare(self::$SQL); //create prepared statement
          $stmt->execute(); //execute statement
          self::$response = true; //set response to true if no exception
        }catch (Exception $ex){
          echo $ex; //echo exception
        }

        //if response is true
        if (self::$response){

          //if connection is not null
          if ($conn){
            //query to create users
            self::$SQL = "CREATE TABLE tblusers(
              Student_Number VARCHAR(15) PRIMARY KEY NOT NULL,
              First_Name VARCHAR(50) NOT NULL,
              Surname VARCHAR(50) NOT NULL,
              Email VARCHAR(50) NOT NULL,
              Course VARCHAR(50),
              Password TEXT NOT NULL,
              Verified TINYINT(1) NOT NULL
              )ENGINE=InnoDB DEFAULT CHARSET=utf8"; //set query string

              //try-catch block to catch exceptions and errors
              try{

                $stmt = self::$dbHelper::$conn->prepare(self::$SQL); //create prepared statement
                $stmt->execute(); //execute statement                                

                //read data from file
                $file = new SplFileObject('../../userData.txt');
                while (!$file->eof()){
                  $line = $file->fgets();
                  list($st_number, $first_name, $surname, $email, $course, $password, $verified) = explode(';', $line); //add items to list -> sep from ','

                  //try-catch block to catch exceptions and errors
                  try{
                    self::$SQL = "INSERT INTO tblusers (Student_Number, First_Name, Surname, Email, Course, Password, Verified) VALUES (?,?,?,?,?,?,?)"; //set query string
                    $sth = self::$dbHelper::$conn->prepare(self::$SQL); //create prepared statement
                    //bind values from list to '?' in query
                    $sth->bindValue(1, $st_number, PDO::PARAM_STR); 
                    $sth->bindValue(2, $first_name, PDO::PARAM_STR);
                    $sth->bindValue(3, $surname, PDO::PARAM_STR);
                    $sth->bindValue(4, $email, PDO::PARAM_STR);
                    $sth->bindValue(5, $course, PDO::PARAM_STR);
                    $sth->bindValue(6, $password, PDO::PARAM_STR);
                    $sth->bindValue(7, $verified, PDO::PARAM_STR);
                    $sth->execute();                    
                  }catch (Exception $ex){
                    echo "Could insert users " . $ex;
                  }                 
                }

              }catch (Exception $ex){
                echo "Could not create table " . $ex;
              }
          }          
        }
      }
    }    
  }

  $table = new Create_Tables();