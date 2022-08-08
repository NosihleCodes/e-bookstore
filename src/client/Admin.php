<!DOCTYPE html>
<html>
<head>
    <title>EDU-FY || Admin Login</title>
    <style>
    <?php include '../Css/Admin.css';
    ?>
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

    <div class="overlay" id="overlay"></div>
    <div class="modal" id="modal">
        <p id="modal_content">Modal</p>
    </div>

    <div class="main">
        <div class="left">
            <img src="../images/old-library-3.jpg" alt="lib">
        </div>
        <div class="right">
            <div class="loginForm">
                <p class="title">Sign in</p>
                <p class="sub">Log into your account to continue</p>
                <div class="form">
                    <input type="email" placeholder="EMAIL" id="email" />
                    <input type="password" placeholder="PASSWORD" id="password" />
                    <input type="submit" value="Login" id="btnLogin" />
                    <div class="admin">
                        <a href="Login.php">Login as User</a>
                    </div>
                    <div class="no_acc">
                        <p>Don't have an account?</p>
                        <a href="Register.php">Create one</a>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript" src="../JS/Admin.js"></script>
</body>
</html>