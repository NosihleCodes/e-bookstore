<?php
    session_start();
?> 

<!DOCTYPE html>
<html>

<head>
    <title>EDU-FY || Students</title>
    <style>
        <?php include '../../Css/Students.css' ?> 
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
<div class="overlay" id="overlay"></div>
    <?php include '../header.php'; ?>


    <div class="header">
        <?php 
           if (isset($_SESSION['Token'])){
                if (isset($_SESSION['Admin'])){
                    echo "<p>Welcome <span>$_SESSION[Admin]</span></p>";
               }
           }
        ?>
    </div>

    <div class="verify" id="verification">
        <div class="top">
            <p>Requires Verification</p>            
        </div>

        <div class="table" id="table">

        </div>
           
    </div>

    <div class="products">
        <p>Requested Books</p>
        <div class="table" id="productTable">

        </div>
    </div>

    <script type="text/javascript" src="../../JS/Student.js"></script>

</body>

</html>