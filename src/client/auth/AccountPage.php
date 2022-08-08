<?php
session_start();
?>
<!DOCTYPE html>
<hmtl>
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Edu-fy || Account</title>

    <style>
        <?php include '../../Css/Account.css'  ?>
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

    <?php include '../header.php' ?>

    <input type=hidden value=<?php echo $_SESSION['UUID']; ?> id=uuid />

    <div class="main">
        <div class="detail">
            <p class="title">Details</p>
            <div class="block">
                <p>Full Name</p>
                <p id="txtName">Full Name</p>
            </div>
            <div class="block">
                <p>Student Number</p>
                <p id="txtNumber">Student Number</p>
            </div>
            <div class="block">
                <p>Email</p>
                <p id="txtEmail">Email</p>
            </div>
            <div class="block">
                <p>Account Type</p>
                <p id="txtType">Student</p>
            </div>
        </div>

        <div class="upload" >
            <div class="form" id="upload">
                <h2>Upload a product</h2>

                <div class="inputs">
                    <input type="text" placeholder="Book Name" id="txtBookName" />
                    <input type="text" placeholder="Shortened Book Display Name" id="txtDisplayName" />
                    <input type="text" placeholder="ISBN (13)" id="txtISBN" />
                    <input type="text" placeholder="Price" id="txtPrice" />
                    <input type="text" placeholder="Course" id="txtCourse" />
                    <textarea id="txtDescription" placeholder="Description...."></textarea>
                    <input type="text" placeholder="Student Email" id="txtStudentEmail" />
                    <input type="file" id="txtImage"/>
                    <button onclick="Upload()">Upload Book</button>
                </div>
            </div>
            <button onclick="Open_Upload()">Upload Product</button>
        </div>
    </div>



    <script type="text/javascript" src="../../JS/Account.js"></script>

</body>
</hmtl>
