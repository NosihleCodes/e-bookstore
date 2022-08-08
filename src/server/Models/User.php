<?php

class User{

    private static $student_number;
    private static $first_name;
    private static $surname;
    private static $email;
    private static $course;
    private static $password;
    private static $verified;

    private static $SQL;
    private static $stmt;  
    private static $message;  

    public static function create($data){
        self::$student_number = $data['Student_Number'];
        self::$first_name = $data['First_Name'];
        self::$surname = $data['Surname'];
        self::$email = $data['Email'];
        self::$course = $data['Course'];
        self::$password = $data['Password'];
        self::$verified = $data['Verified'];
    }

    public static function save($conn){
        if ($conn){
            try{
                self::$SQL = "INSERT INTO tblusers (Student_Number, First_Name, Surname, Email, Course, Password, Verified) VALUES (?,?,?,?,?,?,?)";
                self::$stmt = $conn->prepare(self::$SQL);
                self::$stmt->bindValue(1, self::$student_number, PDO::PARAM_STR); 
                self::$stmt->bindValue(2, self::$first_name, PDO::PARAM_STR);
                self::$stmt->bindValue(3, self::$surname, PDO::PARAM_STR);
                self::$stmt->bindValue(4, self::$email, PDO::PARAM_STR);
                self::$stmt->bindValue(5, self::$course, PDO::PARAM_STR);
                self::$stmt->bindValue(6, self::$password, PDO::PARAM_STR);
                self::$stmt->bindValue(7, self::$verified, PDO::PARAM_STR);
                self::$stmt->execute();                 
                
                self::$message = "Success";
            }catch(Exception $ex){
                self::$message = $ex;
            }
        }

        return self::$message;
    }
}