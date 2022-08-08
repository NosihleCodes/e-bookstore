<?php 

include 'conn.php';

class Students{

    private static $dbHelper;
    private static $stmt;

    private static string $SQL, $Message;

    function __construct(){
        self::$dbHelper = new DatabaseHelper;
        self::$dbHelper::init();

        self::Get_Unverified_Student(self::$dbHelper::$conn);
    }

    /**
     * Displays all unverified students
     *
     *
     * @param $conn
     * @return void
     */
    function Get_Unverified_Student($conn){
        if ($conn){
            try{

                self::$SQL = "SELECT * FROM tblusers WHERE Verified = 0";
                self::$stmt = self::$dbHelper::$conn->prepare(self::$SQL);
                self::$stmt->execute();
               
                echo "<table>".
                        "<tr>" . 
                        "<th>ID</th>".
                        "<th>Name</th>".
                        "<th>Surname</th>".
                        "<th>Email</th>".
                        "<th>Course</th>".
                        "<th colspan=3 class=action>Action</th>".
                        "</tr>";
                while ($row = self::$stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)){                   
                    echo "<tr>" . 
                         "<td>$row[Student_Number]</td>".
                         "<td>$row[First_Name]</td>".
                         "<td>$row[Surname]</td>".
                         "<td>$row[Email]</td>".
                         "<td>$row[Course]</td>".
                         "<td><button class=btnverify id=$row[Student_Number] onclick=Verify_User(this.id)>Verify</button></td>".  
                         "<td><button class=btnremove id=$row[Student_Number] onclick=Remove_User(this.id)>Remove</button></td>".
                         "</tr>";
                }     
            echo "</table>";       
            }catch (Exception $ex){
                echo $ex;
            }
        }
    }
}

$unverified_student = new Students();