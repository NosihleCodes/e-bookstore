<?php

require 'conn.php';

class Account
{
    //class Attributes
    private static DatabaseHelper $dbHelper;

    private static string $SQL = "";
    private static string $uuid;

    private static Array $response;

    private static $stmt;
    private static $row;

    private static $encodedData;
    private static $decodedData;

    private static string $student_number;
    private static string $book_name;
    private static string $isbn;
    private static string $display_name;
    private static string $description;
    private static string $price;
    private static string $course;
    private static string $image;

    /**
     * Class constructor => initialize objects
     *
     *
     */
    public function __construct()
    {

        self::$dbHelper = new DatabaseHelper;
        self::$dbHelper::init();

        self::$encodedData = file_get_contents("php://input");
        self::$decodedData = json_decode(self::$encodedData, true);

        if (self::$decodedData['Type'] == 'Request')
        {
            self::Request_Book(self::$dbHelper::$conn, self::$decodedData);

        }elseif (self::$decodedData['Type'] == 'Details')
        {
            echo json_encode(self::Get_Details (self::$dbHelper::$conn, self::$decodedData));
        }

    }

    /**
     * Get Student/Admin Details
     *
     *
     * @param $conn
     * @param $arr
     * @return array
     */
    public static function Get_Details($conn, $arr):array
    {
        if ($conn)
        {
            self::$uuid = $arr['UUID'] ?? "";

            try
            {
                self::$SQL = "SELECT * FROM tblusers WHERE Student_Number=?";
                self::$stmt = $conn->prepare(self::$SQL);
                self::$stmt->bindValue(1, self::$uuid);
                self::$stmt->execute();

                self::$row = self::$stmt->fetch();

                self::$response = array(
                    'Name' => self::$row['First_Name'] . ' ' .self::$row['Surname'],
                    'Email' => self::$row['Email'],
                    'Student_Number' => self::$row['Student_Number'],
                    'Account_Type' => 'Student'
                );

                return self::$response;

            }catch (Exception $ex)
            {
                return array('Message' => $ex->getMessage());
            }
        }
        return array();
    }

    /**
     * Handles product request to sell books
     *
     *
     * @param $conn
     * @param $arr
     * @return void
     */
    public static function Request_Book($conn, $arr)
    {
        if ($conn)
        {
            //Assign values from json array
            self::$student_number = $arr['Email'] ?? "";
            self::$book_name = $arr['Name'] ?? "";
            self::$display_name = $arr['Display'] ?? "";
            self::$description = $arr['Description'] ?? "";
            self::$price = $arr['Price'] ?? "";
            self::$course = $arr['Course'] ?? "";
            self::$image = $arr['Image'] ?? "";
            self::$isbn = $arr['ISBN'] ?? "";

            try
            {

                self::$SQL = "INSERT INTO tblrequests(Student_Number, ISBN, Book_Name, Display_Name, Description, Price, Course, Image) VALUES(?,?,?,?,?,?,?,?)";
                self::$stmt = $conn->prepare(self::$SQL);
                self::$stmt->bindValue(1, self::$student_number);
                self::$stmt->bindValue(2, self::$isbn);
                self::$stmt->bindValue(3, self::$book_name);
                self::$stmt->bindValue(4, self::$display_name);
                self::$stmt->bindValue(5, self::$description);
                self::$stmt->bindValue(6, self::$price);
                self::$stmt->bindValue(7, self::$course);
                self::$stmt->bindValue(8, self::$image);

                self::$stmt->execute();

                echo json_encode(array('Message' => 'Request Process Complete'));

            }catch (Exception $ex)
            {
                echo json_encode(array('Message' => "Could not process request $ex"));
            }
        }
    }
}

$account = new Account();
