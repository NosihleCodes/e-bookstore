<?php 

session_start();

?>

<!DOCTYPE html>
<html>

<head>
    <title id="title"></title>
    <style>
    <?php include '../../Css/Product.css'?>
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

   <?php include '../header.php' ?> 

   <input type="hidden" id="uuid" value=<?php echo $_SESSION['UUID'] ?> />
   <input type="hidden" id="id" />

    <div class="main" id="main">
        <div class="left">
            <img id='imgProduct' />
        </div>
        <div class="right">
            <p id="ProductName" class="product_Name"></p>
            <div class="sep"></div>
            <p id="Price" class="price"></p>
            <div class="desc">
                <p id="Description" class="description"></p>
            </div>
            <p id="instock" class="no_stock"></p>
            <p id="ISBN" class="isbn"></p>
            <div id="student_verified" class='student_verified'>
                <p id="isVerified"></p>
                <img src='../../images/verified.png' id='imgVerified'/>
            </div>
            <input type="submit" id="btnChat" Value='Contact Seller'/>
            <input type="submit" id="btnAddToCart" Value='Add To Cart'/>
        </div>
    </div>

    <div class="chat" id="chat">
        <div class="topBar">
            <p id="txtSeller"></p>
            <p class="close" id="close" onclick="Close_Chat()">X</p>
        </div>        
        <div class="chatbox" id="chatbox">
            <div class="messages" id="messages">
                
            </div>
        </div>
        <div class="box">
            <textarea type="text" placeholder="Type message..." class="message" id="content"></textarea>
            <button id="btnSend">Send</button>
        </div>
    </div>     

    <script type="text/javascript" src="../../JS/Product.js"></script>

</body>
</html>