<?php 

require 'conn.php';

class Info
{

	private static DatabaseHelper $dbHelper;
	
	private static $stmt;

	private static string $SQL;
	private static string $SKU;
	private static Array $response;
	private static Array $messages;

	private static $decodedData;
	private static $encodedData;

	private static $row;

    private static string $receiver;

	/**
     * Class constructor => initialize objects
     * 
     * 
     * 
     * @return Void
     **/ 
	function __construct()
	{
		self::$dbHelper = new DatabaseHelper;
		self::$dbHelper::init();

		self::$encodedData = file_get_contents('php://input');
		self::$decodedData = json_decode(self::$encodedData, true);



        if (self::$decodedData['Type'] == 'Info')
        {
            self::Get_Info(self::$dbHelper::$conn, self::$decodedData);

        }elseif (self::$decodedData['Type'] == 'Message')
        {
            self::Send_Message(self::$dbHelper::$conn, self::$decodedData);
        }elseif (self::$decodedData['Type'] == 'Student_Messages')
        {
            self::Get_Message(self::$dbHelper::$conn, self::$decodedData);
        }elseif (self::$decodedData['Type'] == 'Admin_Messages')
        {
            self::Get_Admin_Message(self::$dbHelper::$conn, self::$decodedData);
        }

	}

	/**
     * Retrieve info from DB
     * 
     * 
     * 
     * @return void
     **/  

	public function Get_Info($conn, $data)
    {
		self::$SKU = isset($data) ? $data['SKU'] : "";		

		if ($conn)
		{
			try
			{

				self::$SQL = "SELECT tblbooks.Display_Name, tblbooks.Admin_ID, tblbooks.ISBN, tblbooks.Description, tblbooks.Price, tblbooks.Course, tblbooks.Image, tblbooks.InStock, tbladmin.First_Name, tbladmin.Surname FROM tblbooks inner join tbladmin ON tblbooks.Admin_ID = tbladmin.Admin_ID WHERE tblbooks.Admin_ID = tbladmin.Admin_ID AND tblbooks.ISBN=? AND tblbooks.Admin_ID != '' ORDER BY tblbooks.Display_Name";

				self::$stmt = $conn->prepare(self::$SQL);
				self::$stmt->bindValue(1, self::$SKU, PDO::PARAM_STR);
				self::$stmt->execute();

				self::$row = self::$stmt->fetch();

				if (isset(self::$row))
				{
					self::set_info(self::$row);
                    $_SESSION['Admin'] = self::$row['Admin_ID'];
				}else 
				{
					self::$response[] = array('Message' => 'No Product Available');
				}

			}catch (Exception $ex){				
				self::$response[] = array('Message' => $ex);
			}
		}

		echo json_encode(self::$response);
	}

    /**
     * Set product information
     *
     *
     * @return void
     **/

    function Set_Info($row){
        self::$response[] = array( 
            "Display_Name" => $row['Display_Name'],
            "ISBN" => $row['ISBN'],
            "Description" => $row['Description'],
            "Price" => $row['Price'],
            "Course" => $row['Course'],
            "Image_Source" => $row['Image'],
            "InStock" => $row['InStock'],
            "Admin_Name" => $row['First_Name'],
            "Admin_Surname" => $row['Surname'],            
            "Admin_ID" => $row['Admin_ID']);                           
    }

    /**
     * Sends message to admin
     *
     *
     * @return void
     **/

    public static function Send_Message($conn, $arr)
    {
        if ($conn)
        {
            $sender = $arr['Sender'] ?? "";
            self::$receiver = $arr['Receiver'] ?? "";
            $message = $arr['Message_Content'] ?? "";

            try
            {
                self::$SQL = "INSERT INTO tblmessages (Sender, Receiver, Message) VALUES (?,?,?)";
                self::$stmt = $conn->prepare(self::$SQL);
                self::$stmt->bindValue(1, $sender);
                self::$stmt->bindValue(2, self::$receiver );
                self::$stmt->bindValue(3, $message);
                self::$stmt->execute();

                echo json_encode(array('Message' => 'Message sent'));
            }catch (Exceptions $ex)
            {
                echo json_encode(array('Message' => 'Could Not Send Message'));
            }
        }
    }

    /**
     * Retrieves Messages
     *
     *
     * @return void
     **/

    public static function Get_Message($conn, $arr)
    {
        if ($conn)
        {
            $uuid = $arr['UUID'] ?? "";
            self::$receiver  = $arr['Admin'] ?? "";

            try
            {
                self::$SQL = "SELECT * FROM tblmessages WHERE Sender=? AND Receiver=?";
                self::$stmt = $conn->prepare(self::$SQL);
                self::$stmt->bindValue(1, $uuid);
                self::$stmt->bindValue(2, self::$receiver);

                self::$stmt->execute();

                while (self::$row = self::$stmt->fetch())
                {
                    self::$response[] = self::$row;
                }

                echo json_encode(self::$response);
            }catch (Exception $ex)
            {
                echo $ex;
            }
        }
    }

    /**
     * Retrieves Messages
     *
     *
     * @return void
     **/
    public static function Get_Admin_Message($conn, $arr)
    {
        if ($conn)
        {
            $uuid = $arr['UUID'] ?? "";
            self::$receiver  = $arr['Admin'] ?? "";

            try
            {
                self::$SQL = "SELECT * FROM tblmessages WHERE Sender=? AND Receiver=?";
                self::$stmt = $conn->prepare(self::$SQL);
                self::$stmt->bindValue(1, self::$receiver);
                self::$stmt->bindValue(2, $uuid);

                self::$stmt->execute();

                while (self::$row = self::$stmt->fetch())
                {
                    self::$messages[] = self::$row;
                }

                echo json_encode(self::$messages);
            }catch (Exception $ex)
            {
                echo $ex;
            }
        }
    }
}

$info = new Info();