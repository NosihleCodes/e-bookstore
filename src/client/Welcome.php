<?php 
    include '../server/Tables.php';
    if (isset($_SESSION['Token']))
    {
        $_SESSION = array();
        print_r($_SESSION);
    }
?>
<!DOCTYPE html>
<html>

<head>
    <title>EDU-FY || Welcome</title>
    <style>
    <?php include '../Css/Welcome.css';
    ?>
    </style>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport" />     
</head>

<body>

    <div class="container">
        <div class="topBar">
            <div class="left">
                <img src="../images/icon.png" />
                <p>EDU-FY</p>
            </div>
            <div class="right">
                <a href='auth/index.php' class="home">Home</a>
                <a href="auth/AboutUs.php" class="about">About Us</a>
            </div>
        </div>
        <div class="parent">
            <div class="left">
                <p class="sub">
                    From quality books to affordable prices.<br> Edu-fy helps you ace!
                </p>
                <div class="button">
                    <button class="active" onClick="Register()">Get Started</button>
                    <button onClick="Login()">Continue</button>
                </div>
            </div>
            <div class="right">
                <img src="../images/img_content.png" />
            </div>
        </div>
    </div>

    <script type="text/javascript" src="../JS/Welcome.js"></script>

</body>

</html>