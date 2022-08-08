<?php

require 'conn.php';

class Model
{
    private static DatabaseHelper $dbHelper;

    private static string $SQL;

    private static $stmt;

    private static $encodedData;
    private static $decodedData;

    public function __construct()
    {
        self::$dbHelper = new DatabaseHelper;
        self::$dbHelper::init();

        self::$encodedData = file_get_contents('php://input');
        self::$decodedData = json_decode(self::$encodedData, true);

        if (self::$decodedData['Type'] == 'Model')
        {
            self::__Get_Model(self::$dbHelper::$conn, self::$decodedData);
        }
    }

    public static function __Get_Model($conn, $arr)
    {
        if ($conn)
        {
            $code = $arr['Code'];
            try
            {
                self::$SQL = 'SELECT * FROM tblbooks WHERE Course=?';
                self::$stmt = $conn->prepare(self::$SQL);
                self::$stmt->bindValue(1, $code);

                self::$stmt->execute();

                while ($row = self::$stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)){
                    echo "<div class=card>".
                        "<img src=$row[Image] alt=$row[Book_Name]/>".
                        "<div class=info>" .
                        "<a href=product.php?isbn=$row[ISBN]>$row[Display_Name]</a>".
                        "<p>R$row[Price]</p>" .
                        "<button id='$row[ISBN]' onclick=Add_To_Cart(this.id)>Add To Cart</button>" .
                        "</div>".
                        "</div>";
                }
            }catch (Exception $ex)
            {
                echo "<p>Could find any products related to $code</p>";
            }
        }
    }
}

$model = new Model();