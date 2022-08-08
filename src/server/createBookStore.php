<?php 

include 'conn.php';

class Create_DB{

    private static $file;
    private static $line;

    private static $SQL;
    private static $stmt;
    private static $Message;

    private static $dbHelper;

    public function __construct(){
        self::$dbHelper = new DatabaseHelper;
        self::$dbHelper::init();
        
        self::Load_File(self::$dbHelper::$conn);
    }

    private static function Load_File($conn){
        self::$line = file_get_contents('../bookstore.sql');
        if ($conn){
            try{                              
                if (self::$line){
                    self::$SQL = self::$line;
                    self::$stmt = $conn->prepare(self::$SQL);
                    self::$stmt->execute();
                    self::$Message = "Success";
                }else {
                    self::$Message = "No Content Found";
                }

            }catch(Exception $ex){
                self::$Message = $ex;
            }
        }

        echo self::$Message;
    }     
}

$db = new Create_DB();