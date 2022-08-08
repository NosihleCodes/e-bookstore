<?php

include 'conn.php';

class Admin{

    private static $dbHelper;
    private static $stmt;
    private static $row;

    private static string $email, $password, $SQL, $Message;
    private static Array $response;

    /**
     * Class constructor
     * => initialize objects
     *
     *
     *
     * @return Void
     **/


    function __construct(){
        self::$dbHelper = new DatabaseHelper;
        self::$dbHelper::init();

        self::Admin_Login(self::$dbHelper::$conn);
    }

    /**
     * Handles admin authentication
     *
     *
     * @param $conn
     * @return void
     */
    function Admin_Login($conn) : void
    {
        self::$email = $_POST['Email'] ?? null;
        self::$password = $_POST['Password'] ?? null;

        if ($conn){
            try{
                self::$SQL = "SELECT * FROM tbladmin WHERE Email=?";
                self::$stmt = self::$dbHelper::$conn->prepare(self::$SQL);
                self::$stmt->bindValue(1, self::$email, PDO::PARAM_STR);
                self::$stmt->execute();

                self::$row = self::$stmt->fetch();

                if (password_verify(self::$password, self::$row['Password'])){
                    self::$Message = "Authenticated";

                    session_start();
                    $_SESSION['Name'] = self::$row['First_Name'] . ' ' . self::$row['Surname'];
                    $_SESSION['Type'] = 'Admin';
                    $_SESSION['Token'] = self::create_session_id();



                }else {
                    self::$Message = "Failed";
                }
            }catch (Exception $ex){
                self::$Message = $ex;
            }

            self::$response[] = array('Message' => self::$Message,
                'Token' => $_SESSION['Token'],
                'Admin' => $_SESSION['Name']);
        }
        echo json_encode(self::$response);
    }

    /**
     * Creates a session ID for each user
     *
     *
     *
     * @return string
     **/
    function create_session_id() : string
    {
        //Generate a random string.
        $token = openssl_random_pseudo_bytes(16);

        //Convert the binary data into hexadecimal representation.
        return bin2hex($token);
   }
}

$admin = new Admin();
