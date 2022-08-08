$(function () {
  $("#btnLogin").on("click", function () {
      //assign input values
      let email = $('#email').val();
      let password = $('#password').val();

      if (!email || !password){
        let overlay = document.getElementById("overlay");
        let modal = document.getElementById("modal");
  
        //set element styles
        overlay.style.display = "block";
        modal.style.transition = "all 0.8s ease-in-out";
        modal.style.top = "10%";
        $("#modal_content").text("Please fill in all fields");
  
        //timeout functions -> hides modal and overay
        setTimeout(function () {
          modal.style.transition = "all 0.8s ease-in-out";
          modal.style.top = "-50%";
          overlay.style.display = "none";
        }, 2000);
      }else {
          $.ajax({
            method: 'POST',
            url: '../server/Admin.php',
            data:{
                Email: email,
                Password: password,
            },
            success:function(response){
                let json = JSON.parse(response);

                console.log(json);

                switch (json[0].Message){
                  case 'Authenticated':
                    window.location.href = "../client/auth/index.php?" + json[0].Token;
                    break;
                  case 'Failed':
                    alert('Incorrect details supplied or your account doesn`t exist');
                    break;

                }
            },
            error: function (err){
                console.log(err);
            }
          });
      }
  });
});
