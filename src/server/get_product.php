<?php

include 'conn.php';

class Products{

    private static $dbHelper;
    private static string $SQL;
    private static $stmt;

    function __construct(){
        self::$dbHelper = new DatabaseHelper;
        self::$dbHelper::init();

        self::Get_Products(self::$dbHelper::$conn);
    }

    /**
     * Get All products in database
     *
     *
     * @param $conn
     * @return void
     */
    function Get_Products($conn){
        if ($conn){
            try{
                self::$SQL = "SELECT Admin_ID, ISBN, Book_Name, Display_Name, Price, InStock, Image FROM tblbooks WHERE Admin_ID IS NOT NULL AND InStock = 1";
                self::$stmt = $conn->prepare(self::$SQL);
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
            }catch (Exception $ex){
                echo $ex;
            }
        }
    }
}

$product = new Products();
