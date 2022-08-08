<?php

include 'conn.php';

class Manage{

    private static $dbHelper;
    private static $Message; 
    private static $stmt;

    private static string $SQL;
    private string $email;


    function __construct(){
        self::$dbHelper = new DatabaseHelper;
        self::$dbHelper::init();

        $encodedData = file_get_contents('php://input');
        $decodedData = json_decode($encodedData, true);

        if (isset($_POST['Verify'])){
            self::Verify_User(self::$dbHelper::$conn);
        }elseif (isset($_POST['Remove'])){
            self::Remove_User(self::$dbHelper::$conn);
        }elseif ($decodedData['Type'] == 'Edit'){
            self::Edit_User(self::$dbHelper::$conn);
        }elseif ($decodedData['Type'] == 'Books')
        {
            self::Get_Book(self::$dbHelper::$conn);
        }
    }

    function Verify_User($conn){       
        $this->email = $_POST['ID'] ?? "";
        if ($conn){

            try{

                self::$SQL = "UPDATE tblusers SET Verified=1 WHERE Student_Number=?";            
                self::$stmt = $conn->prepare(self::$SQL);
                self::$stmt->bindValue(1, $this->email, PDO::PARAM_STR);
                self::$stmt->execute();

                self::$Message = "Success";

            }catch (Exception $ex){
                self::$Message = 'Failed';
            }            
        }    
        
        echo self::$Message;
    }

    function Remove_User($conn){        
        $this->email = $_POST['ID'] ?? "";
        if ($conn){

            try{

                self::$SQL = "DELETE FROM tblusers WHERE Student_Number=?";            
                self::$stmt = $conn->prepare(self::$SQL);
                self::$stmt->bindValue(1, $this->email, PDO::PARAM_STR);
                self::$stmt->execute();

                self::$Message = "Success";

            }catch (Exception $ex){
                self::$Message = 'Failed';
            }            
        }    
        
        echo self::$Message;
    }

    public static function Get_Book ( $conn )
    {
        if ( $conn ) {
            self::$SQL = "SELECT * FROM tblrequests";
            self::$stmt = $conn -> prepare ( self::$SQL );
            self::$stmt -> execute ();

            echo "<table>" .
                "<tr>" .
                "<th>ISBN</th>" .
                "<th>Display Name</th>" .
                "<th>Price</th>" .
                "<th>Seller</th>" .
                "<th colspan=3 class=action>Action</th>" .
                "</tr>";
            while ( $row = self::$stmt -> fetch ()) {
                if ( count ( $row ) > 0 ) {
                    echo "<tr>" .
                        "<td>$row[ISBN]</td>" .
                        "<td>$row[Display_Name]</td>" .
                        "<td>$row[Price]</td>" .
                        "<td>$row[Email]</td>" .
                        "<td><button class=btnverify id=$row[ISBN] onclick=Accept_Request(this.id)>Accept</button></td>" .
                        "<td><button class=btnremove id=$row[ISBN] onclick=Decline_Request(this.id)>Decline</button></td>" .
                        "</tr>";
                } else {
                    echo "<td>No product found</td>";
                }
                echo "</table>";
            }
        }
    }
}

$student_management = new Manage();
