<?php

session_start();
require 'conn.php';


class Cart
{
    //class Attributes
    private static DatabaseHelper $dbHelper;

    private static float $subTotal;
    private static string $SQL;

    private static $stmt;
    private static $encodedData;
    private static $decodedData;

    private static string $uuid;
    private static string $isbn;
    private static string $order_id;
    private static string $order_total;
    private static string $order_date;
    private static string $delivery_method;


    public function __construct()
    {
        self::$dbHelper = new DatabaseHelper;
        self::$dbHelper::init();

        self::$encodedData = file_get_contents('php://input');
        self::$decodedData = json_decode(self::$encodedData, true);

        if (self::$decodedData['Type'] == 'Add')
        {
            echo json_encode(self::Add_To_Cart(self::$decodedData));

        }elseif (self::$decodedData['Type'] == 'View')
        {
            self::View_Cart(self::$dbHelper::$conn);

        }elseif (self::$decodedData['Type'] == 'Sub')
        {
            echo json_encode(self::Total(self::$dbHelper::$conn));

        }elseif (self::$decodedData['Type'] == 'Remove')
        {
            self::Remove_Item(self::$decodedData);
        }elseif (self::$decodedData['Type'] == 'Order')
        {
            self::Store_Order(self::$dbHelper::$conn, self::$decodedData);
        }
    }

    /**
     * Adds items to cart (Session super global)
     *
     * @param $arr
     * @return int
     **/
    public static function Add_To_Cart($arr):int
    {
        if (empty($_SESSION['Cart']))
        {
            $_SESSION['Cart'] = array();
        }

        $_SESSION['Cart'][] = $arr['ID'];

        return count($_SESSION['Cart']);
    }

    /**
     * Removes items from cart
     *
     *
     * @param $arr
     * @return void
     */
    public static function Remove_Item($arr)
    {
        $index = $arr['Token'];

        if ($result = array_Search($index, $_SESSION['Cart']))
        {
            unset($_SESSION['Cart'][$result]);
        }
    }

    /**
     * Display all items in current cart
     *
     *
     * @param $conn
     * @return void
     */
    public static function View_Cart($conn)
    {
        $whereIn = "";
        if ($conn)
        {
            if (isset($_SESSION['Cart']))
            {
                $whereIn = implode(',', $_SESSION['Cart']);
            }
            try {
                self::$SQL = "SELECT tbladmin.First_Name, tbladmin.Surname, tblbooks.ISBN, tblbooks.Display_Name, tblbooks.Price, tblbooks.Image FROM tblbooks INNER JOIN tbladmin ON tblbooks.Admin_ID = tbladmin.Admin_ID WHERE tblbooks.ISBN IN ('" . str_replace(",", "','", $whereIn) . "')";
                self::$stmt = $conn->prepare(self::$SQL);
                self::$stmt->execute();

                while ($row = self::$stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT))
                {
                    echo "<div class='card'>" .
                        "<img src=../Images/$row[Image] alt='$row[Image]' />" .
                        "<div class='info'>" .
                        "<p class='title'>$row[Display_Name]</p>" .
                        "<p>$row[First_Name] . $row[Surname]</p>" .
                        "</div>" .
                        "<div class='scale'>" .
                        "<p class='price'>R$row[Price]</p>" .
                        "<label for=txtQty>Quantity: </label>" .
                        "<input type=text placeholder=1 id=txtQty />" .
                        "</div>" .
                        "<img src=../../Images/delete.png alt=Delete class='imgDelete' id=$row[ISBN] onclick='Remove_Item(this.id)'/>" .
                        "</div>";
                }
            } catch (Exception $ex)
            {
                echo "<p>$ex</p>";
            }
        }
    }

    /**
     * Calculate cart total
     *
     *
     * @param $conn
     * @return float
     */
    public static function Total($conn):float
    {
        if ($conn)
        {
            self::$subTotal = 0.0;
            $whereIn = implode(',', $_SESSION['Cart']);
            try
            {
                self::$SQL = "SELECT Price FROM tblbooks WHERE ISBN IN ('" . str_replace(",", "','", $whereIn) . "')";
                self::$stmt = $conn->prepare(self::$SQL);
                self::$stmt->execute();

                while ($row = self::$stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT))
                {
                    self::$subTotal = self::$subTotal + $row['Price'];
                }
                return self::$subTotal;
            } catch (Exception $ex)
            {
                echo "<p>$ex</p>";
            }
        }
        return self::$subTotal;
    }

    /**
     * Store order in database
     *
     *
     * @param $conn
     * @param $arr
     * @return void
     */
    public static function Store_Order($conn, $arr)
    {
        if ($conn)
        {
            self::$uuid = $arr['ID'] ?? "";
            self::$order_id = $arr['Order_ID'] ?? "" ;
            self::$order_date = $arr['Order_Date'] ?? "";
            self::$order_total = $arr['Order_Total'] ?? "";
            self::$delivery_method = $arr['Delivery_Method'] ?? "";

            $i = 0;
            while ($i < count($_SESSION['Cart']))
            {
               try
               {
                   self::$SQL = "INSERT INTO tblorders(Student_Number, Order_ID, ISBN, Order_date, Order_Total, Delivery_Method) VALUES (?,?,?,?,?,?)";
                   self::$stmt = $conn->prepare(self::$SQL);
                   self::$stmt->bindValue(1, self::$order_id);
                   self::$stmt->bindValue(2, $_SESSION['Cart'][$i]);
                   self::$stmt->bindValue(3, self::$uuid);
                   self::$stmt->bindValue(4, self::$order_date);
                   self::$stmt->bindValue(5, self::$order_total);
                   self::$stmt->bindValue(6, self::$delivery_method);

                   self::$stmt->execute();
                   $i++;

                   if ($i == count($_SESSION['Cart']))
                   {
                      echo json_encode(array('Message' => 'Order Created Successfully'));
                      $_SESSION['Cart'] = array();
                   }
               }catch(Exception $ex)
               {
                    echo json_encode(array('Message' => 'Could not create order'));
               }
            }

        }
    }

}

$cart = new Cart();