<?php
    session_start();
    if (isset($_SESSION['Cart']))
    {
        $_SESSION['Cart'] = array();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edu-fy || Shop</title>
    <style>
    <?php include '../../Css/index.css'?>
    </style>
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <?php
        if (isset($_SESSION['Token']) && $_SESSION['Type'] == 'Student')
        {
            echo "<input type='hidden' value=$_SESSION[Token] id=token />";
            echo "<input type='hidden' value=$_SESSION[Course] id=course />";
        }
    ?>


    <div class="overlay" id="overlay"></div>

    <div class="modal" id="modal">
        <img src="../../images/done.png" alt="done" id="imgCheck" />
        <p>Product Added</p>
    </div>

    <div class="popup" id="popup">
        <p>You are not signed in!</p>
        <p class="sub">Please register or login to purchase products</p>
        <div class="buttons">
            <button id="btnRegister">Register</button>
            <button id="btnLogin">Sign in</button>
        </div>
    </div>

    <?php include '../header.php'; ?>


    <div class="header">
        <?php
           if (isset($_SESSION['Token'])){
               echo "<p>Welcome <span>$_SESSION[Name]</span></p>";
           }else {
                echo "<p>Welcome <span>Guest</span></p>";
           }
        ?>
    </div>

    <div class="search_block">
        <input type="text" placeholder="Search..." />
        <img src="../../images/search.png" alt="info" class="search" />
    </div>

    <?php
        if (isset($_SESSION['Token']) && $_SESSION['Type'] == 'Student');
        {
            if (isset($_SESSION['Course']))
            {
                echo "<div class='model'>".
                    "<h1>Products related to <span>$_SESSION[Course]</span></h1>".
                    "<div class='content' id='model'>".
                    "</div>".
                    "</div>";
            }
        }
    ?>

    <div class="box">
        <h1>All Books</h1>
        <div class="cardview" id="view">

        </div>
    </div>



    <script type="text/javascript" src="../../JS/index.js"></script>
</body>

</html>
