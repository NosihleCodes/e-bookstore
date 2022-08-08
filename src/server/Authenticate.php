<?php

require 'conn.php';

class Authenticate
{
    //class attributes
    private static DatabaseHelper $dbHelper;

    private static string $SQL;
    private static PDOStatement $stmt;
    private static $row;
    private static Array $response;

    private static $encodedData;
    private static $decodedData;

    private static string $Message;
    private static string $email;
    private static string $password;
    private static string $fullname;
    private static string $uuid;

    /**
     * Class constructor
     * => initialize objects
     *
     *
     */
    public function __construct()
    {
        self::$dbHelper = new DatabaseHelper;
        self::$dbHelper::init();

        self::$encodedData = file_get_contents("php://input");
        self::$decodedData = json_decode(self::$encodedData, true);

        if (self::$decodedData['Type'] == 'Login')
        {
            self::Authenticate(self::$dbHelper::$conn);

        }else if (self::$decodedData['Type'] == 'Register')
        {
            self::create(self::$dbHelper::$conn);
        }
    }

    /**
     * Handles authentication of users
     *
     *
     * @param $conn
     * @return void
     */
    public static function Authenticate($conn)
    {
        if ($conn)
        {
            self::$email = self::$decodedData['Email'] ?? "";
            self::$password = self::$decodedData['Password'] ?? "";

            try
            {
                self::$SQL = "SELECT Student_Number, First_Name, Surname, Email, Course, Password, Verified FROM tblusers WHERE Email=?";
                self::$stmt = $conn->prepare(self::$SQL);
                self::$stmt->bindValue(1, self::$email);
                self::$stmt->execute();

                self::$row = self::$stmt->fetch();

                if (isset(self::$row))
                {
                    if (password_verify(self::$password, self::$row['Password']))
                    {
                        self::$Message = "Authenticated";
                        session_start();

                        $_SESSION['Name'] = self::$row['First_Name']. ' ' . self::$row['Surname'];
                        $_SESSION['Email'] = self::$row['Email'];
                        $_SESSION['Token'] = self::Generate_Token();
                        $_SESSION['Course'] = self::$row['Course'];
                        $_SESSION['UUID'] = self::$row['Student_Number'];
                        $_SESSION['Verified'] = self::$row['Verified'];
                        $_SESSION['Type'] = 'Student';

                        self::$response[] = array('Message' => self::$Message,
                            'Token' => self::Generate_Token(),
                            'UUID' => self::$row['Student_Number']);

                    }else
                    {
                        self::$Message = "Invalid Password";
                        self::$response[] = array('Message' => self::$Message);
                    }
                }else
                    {
                        self::$Message = "Account not Found";
                        self::$response[] = array('Message' => self::$Message);
                    }
            }catch (Exception $ex)
            {
                self::$Message = "[Exception]:" . $ex->getMessage();
                self::$response[] = array('Message' => self::$Message);
            }
        }

        echo json_encode(self::$response);
    }

    /**
     * Handles the creating of new accounts
     *
     *
     * @param $conn
     * @return void
     */
    public static function create($conn)
    {
        if ($conn) {
            self::$email = self::$decodedData['Email'] ?? "";
            self::$password = self::$decodedData['Password'] ?? "";
            self::$fullname = self::$decodedData['FullName'] ?? "";
            self::$uuid = self::$decodedData['UUID'] ?? "";
            self::$course = self::$decodedData['Course'] ?? "";
            self::$verified = self::$decodedData['Verified'] ?? "";


            try {
                if (self::Check_User_Exists($conn, self::$email))
                {
                    self::$Message = "User Already Exists";

                } else
                {
                    self::$SQL = "INSERT INTO tblusers(Student_Number, First_Name, Surname, Email, Course, Password, Verified) VALUES (?,?,?,?)";
                    self::$stmt = $conn->prepare(self::$SQL);
                    self::$stmt->bindValue(1, self::$uuid);
                    self::$stmt->bindValue(2, self::$fullname);
                    self::$stmt->bindValue(3, self::$email);
                    self::$stmt->bindValue(4, self::$password);
                    self::$stmt->execute();

                    self::$Message = "registered";
                    self::$response[] = array('Message' => self::$Message);
                }
            } catch (Exception $ex) {
                self::$Message = "[Exception]: $ex";
                self::$response[] = array('Message' => self::$Message);
            }
        }
        echo json_encode(self::$response);
    }

    /**
     * Check if a user already exists with credentials
     *
     *
     * @param $conn
     * @param $email
     * @return bool
     */
    public static function Check_User_Exists($conn, $email): bool
    {
        if ($conn)
        {
            try
            {
                self::$SQL = "";
                self::$stmt = $conn->prepare(self::$SQL);
                self::$stmt->bindValue(1, $email);
                self::$stmt->execute();

                self::$row[] = self::$stmt->fetch();

                if (isset(self::$row['Student_Number']))
                {
                    return true;
                }
            }catch (Exception $ex)
            {
                return false;
            }
        }

        return false;
    }

    /**
     * Generates session id token
     *
     *
     * @return string
     */
    public static function Generate_Token(): string
    {
        $token = openssl_random_pseudo_bytes(16);
        return bin2hex($token);
    }
}

$auth = new Authenticate();
