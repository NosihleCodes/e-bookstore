const check_input = () => {
  let first_name = $("#first_name").val();
  let surname = $("#surname").val();
  let email = $("#email").val();
  let student_number = $("#st_number").val();
  let password = $("#password").val();

  if (!first_name || !surname || !email || !student_number || !password) {
    return "Invalid";
  } else {
    return "Valid";
  }
};

$("#btnRegister").on("click", function () {
  //store response of check input in variable
  let response = check_input();

  //check response
  if (response === "Invalid") {
    $("#error").text("Please fill in all fields");
  } else if (response === "Valid") {
    $("#error").text("");
    
    //ajax request if response is valid
    $.ajax({
      method: "POST",
      url: "../server/Register.php",
      data: {
        First_Name: $("#first_name").val(),
        Surname: $("#surname").val(),
        Email: $("#email").val(),
        Course: $("#course").val(),
        Student_Number: $("#st_number").val(),
        Password: $("#password").val(),
      },
      success: function (response) {
        let json = JSON.parse(response);
        console.log(json);

        switch (json[0].Message) {
          case "Found":
            //reference elements
            var overlay = document.getElementById("overlay");
            var el = document.getElementById("modal");

            //set element styling and transition
            el.style.transition = "all 0.8s ease-in-out";
            el.style.top = "10%";
            overlay.style.display = "block";

            //set modal content
            $("#modal_content").text("User already exists");

            //timeout function to hide modal
            setTimeout(function () {
              el.style.transition = "all 0.8s ease-in-out";
              el.style.top = "-50%";
              overlay.style.display = "none";
            }, 2000);
            
            break;
          case "Success":
            window.location.href =
              "../client/Authenticate.php?" + json[0].Token + "?authType=1";
            break;
        }
      },
      error: function (err) {
        //Display error in alert
        alert(err);
      },
    });
  }
});
