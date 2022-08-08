const Check_Input = (email, password) => {
  return !(!email || !password);
};

$(function () {

  $.ajax({
    method: "POST",
    url: "/poe/src/server/createBookStore.php",
    success: function (response) {
      console.log(response)
    },
    error: function (error) {
      Show_Modal(error.state() + 'Could not send request');
    },
  });

  $("#btnLogin").on("click", function () {
    let email = $("#email").val();
    let password = $("#password").val();

    if (!Check_Input(email, password)) {
      Show_Modal("Please fill in all fields");
    } else {

      let data = {
        Email: email,
        Password: password,
        Type: "Login",
      };

      $.ajax({
        method: "POST",
        url: "/poe/src/server/Authenticate.php",
        data: JSON.stringify(data),
        success: function (response) {
          let json = JSON.parse(response);

          console.log(json);

          switch (json[0].Message){
            case 'Authenticated':
              window.location.href = "auth/index.php?auth="+json[0].Token+"?user="+json[0].UUID;
              break;
            case 'Invalid Password':
              Show_Modal('Invalid Password');
              break;
            case 'Account Not Found':
              Show_Modal('Account not found');
              break;
          }
        },
        error: function (error) {
          Show_Modal(error.state() + 'Could not send request');
        },
      });
    }
  });
});

const Show_Modal = (content) => {
  //create references to elements
  let overlay = document.getElementById("overlay");
  let modal = document.getElementById("modal");

  //set element styles
  overlay.style.display = "block";
  modal.style.transition = "all 0.8s ease-in-out";
  modal.style.top = "10%";
  $("#modal_content").text(content);

  //timeout functions -> hides modal and overay
  setTimeout(function () {
    modal.style.transition = "all 0.8s ease-in-out";
    modal.style.top = "-50%";
    overlay.style.display = "none";
  }, 2000);
};
