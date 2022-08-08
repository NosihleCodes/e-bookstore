<?php
session_start();
if (isset($_SESSION['Cart']))
{
    $count = count($_SESSION['Cart']);
}else
{
    $count = 0;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>BookStore || Cart</title>
    <style>
        <?php include '../../Css/Cart.css' ?>
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

<?php include '../header.php' ?>

<input type="hidden" value="<?php
echo $_SESSION['Email'] ?>" id="email"/>

<input type="hidden" value="<?php
echo $_SESSION['Name'] ?>" id="name"/>

<input type="hidden" value="<?php
echo $_SESSION['UUID'] ?>" id="uuid"/>


<div class="content">
    <div class="left">
        <h2>Order</h2>
        <div class="block" id="block">

        </div>
    </div>
    <div class="right">
        <h2>Payment Summary</h2>
        <div class="block" >
            <div class="container">
                <p id="txtEmail"></p>
            </div>

            <div class="sep"></div>

            <div class="details">
                <div class="box">
                    <p>Order ID</p>
                    <p id="order_id">V7S5A1S58</p>
                </div>
                <div class="box">
                    <p>Sub Total</p>
                    <p id="sub">0</p>
                </div>
                <div class="box">
                    <p>Order Total</p>
                    <p id="order_total"></p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="delivery">
    <h2>Delivery</h2>

    <div class="box">
        <input type="radio" id="del" checked value="45"/>
        <div class="info">
            <p>Door-to-Door Delivery</p>
            <p>R 45.00</p>
        </div>
    </div>

    <div class="box">
        <input type="radio" id="self" value="0"/>
        <div class="info">
            <p>Self-Collect</p>
            <p>R 0.00</p>
        </div>
    </div>
</div>

<div class="personal_details">
    <h2>Personal Information</h2>
    <div class="flow">
        <div class="cards">
            <img src="../../Images/visa.png" alt="visa"/>
            <img src="../../Images/mastercard.png" alt="visa"/>
        </div>
        <div class="information">
            <input type="email" id="txtUserEmail" placeholder="Email" />
            <input type="text" id="txtName" placeholder="Name" />

            <div class="card_input">
                <input type="text" id="txtCardNumber" placeholder="0000 0000 0000 0000" />
                <div class="expiration">
                    <input type="text" id="txtExpirationDate" placeholder="DD/MM" />
                    <input type="text" id="txtCVV" placeholder="CVV" />
                </div>
            </div>
        </div>
    </div>

    <button id="btnOrder">Place Order</button>
</div>

<script src="../../JS/Cart.js" type="text/javascript"></script>

</body>
</html>

