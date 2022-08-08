<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Edu-fy</title>
    <style>
        <?php include '../Css/Register.css'?>
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

    <div class="overlay" id="overlay">
    </div>
    <div class="modal" id="modal">
        <p id="modal_content">Modal</p>
    </div>


    <div class="main">
        <div class="left">
            <img src="../images/old-library-3.jpg" alt="lib2">
        </div>
        <div class="right">
            <div class="form">
                <div class="header">
                    <p class="title">Welcome!</p>
                    <p class="sub">Create an account to continue</p>
                </div>
                <div class="regForm">
                    <p class="error" id="error"></p>
                    <input type="text" id="first_name" placeholder="FIRST NAME" />
                    <input type="text" id="surname" placeholder="SURNAME" />
                    <input type="email" id="email" placeholder="EMAIL" />
                    <input type="text" id="st_number" placeholder="STUDENT NUMBER" />
                    <input type="text" id="course" placeholder="COURSE" />
                    <input type="password" id="password" placeholder="PASSWORD" />
                    <input type="submit" value="Register" id="btnRegister" onsubmit=Register() />
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="../JS/Register.js"></script>
</body>

</html>