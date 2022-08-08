<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Merriweather:wght@300&display=swap');
            *{
                margin: 0;
                padding: 0;
            }

            .parent .head{
                width: 100%;
                height: 150px;
                display: flex;
                flex-direction: row;
                justify-content: center;
            }

            .parent .head img {
                width: 100px;
                height: 100px;
                align-self: center;
            }

            .parent .head a{
                font-size: 28px;
                align-self: center;
                margin-left: 15px;
                text-decoration: none;
                color: #cc7722;
                font-weight: 700;
            }

            .parent .nav {
                width: 100%;
                height: 55px;
                background-color: #cc7722;
            }

            .parent .nav .container {
                width: 75%;
                height: 100%;
                display: flex;
                flex-direction: row;
                margin: auto;
            }

            .parent .container a {
                text-decoration: none;
                color: #fff;
                font-family: 'Merriweather', serif;
                align-self: center;
                margin-left: 10px;
            }

            .parent .nav .container .block{
                width: 25%;
                height: 100%;
                display: flex;
                flex-direction: row;
                border-right: 1px solid #C0C0C0;
                justify-content: center;
            }

            .parent .nav .container .block:last-child{
                border: none;
            }

            .parent .nav .container .block img {
                width: 30px;
                height: 30px;
                align-self: center;
            }

            .parent .nav .container .block a{
                text-decoration: none;
                color: #fff;
                font-family: 'Merriweather', serif;
                align-self: center;
                margin-left: 10px;
            }

            .parent .nav .container .block a:hover{
                text-decoration: underline;
            }

            .parent .head .close{
                display: none;
            }

            @media only screen and (max-width: 480px) {

                .parent{
                    display: none;
                    z-index: 200;
                }

                .hamburger-lines {
                    display: block;
                    height: 26px;
                    width: 32px;
                    position: absolute;
                    top: 17px;
                    left: 10px;
                    z-index: 300;
                    display: flex;
                    flex-direction: column;
                    justify-content: space-between;
                }

                .hamburger-lines .line {
                    display: block;
                    height: 4px;
                    width: 100%;
                    border-radius: 10px;
                    background: #0e2431;
                }

                .hamburger-lines .line1 {
                    transform-origin: 0% 0%;
                    transition: transform 0.4s ease-in-out;
                }

                .hamburger-lines .line2 {
                    transition: transform 0.2s ease-in-out;
                }

                .hamburger-lines .line3 {
                    transform-origin: 0% 100%;
                    transition: transform 0.4s ease-in-out;
                }

                .parent .head .close{
                    display: block;
                    position: absolute;
                    left: 10px;
                    top: 10px;
                    font-family: 'Microsoft YaHei';
                    font-size: 26px;
                }

                .parent .nav{
                    width: 100%;
                    height: 10%;
                    border: none;
                }

                .parent .nav .container{
                    width: 100%;
                    height: 400px;
                    display: flex;
                    flex-direction: column;
                }

                .parent .nav .container .block {
                    width: 100%;
                }

            }

        </style>
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>
<body>

    <div class="hamburger-lines" id="menu">
        <span class="line line1"></span>
        <span class="line line2"></span>
        <span class="line line3"></span>
    </div>

    <div class="parent" id="parent">
        <div class="head">
            <p class="close" id="close">X</p>
            <img src="../../images/icon.png" alt="icon"/>
            <a href="index.php">EDU-FY</a>
        </div>
        <div class="nav">
            <div class="container">
                <div class="block">
                    <img src="../../images/ask_us.png" alt="ask-Us" />
                    <a href="AboutUs.php">About Us</a>
                </div>
                <div class="block">
                    <img src="../../images/my_account.png" alt="ask-Us" />
                    <a href="../Login.php">Logout</a>
                </div>
                <div class="block">
                    <?php
                        echo "<img src=../../images/my_account.png alt=About-Us />";
                        if (isset($_SESSION['Type']) && $_SESSION['Type'] == 'Student')
                        {
                            echo "<a href=AccountPage.php>Account</a>";
                        }elseif (isset($_SESSION['Type']) && $_SESSION['Type'] == 'Admin')
                        {
                            echo "<a href=Students.php>Student</a>";
                        }else
                        {
                            echo "<a href=../Login.php>Login</a>";
                        }
                    ?>
                </div>
                <?php
                    if (isset($_SESSION['Type']) && $_SESSION['Type'] == 'Student')
                    {
                        echo "<div class=block>".
                                "<img src=../../images/my_cart.png alt=ask-Us />".
                                "<a href=Cart.php id=cart>Cart (0)</a>".
                            "</div>";
                    }
                ?>
                <?php
                    if (!isset($_SESSION['Token']))
                    {

                        echo "<div class=block>".
                            "<img src=../../images/my_account.png alt=About-Us />".
                            "<a href=../Login.php>Login</a>";
                            "</div>";
                    }
                ?>
                </div>
        </div>
    </div>

    <script type="text/javascript" src="../../JS/Header.js"></script>
</body>
</html>
