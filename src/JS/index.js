$(document).ready(function () {
  let course = $('#course').val();

  //Load all products
  $.ajax({
    method: "GET",
    url: "../../server/get_product.php",
    success: function (response) {
      $("#view").html(response);
    },
    error: function (err) {
      alert(err);
    },
  });

  //Load products based on user data
  $.ajax({
    method: "POST",
    url: "../../server/Model.php",
    data:JSON.stringify({
      Type: 'Model',
      Code: course
    }),
    success: function (response) {
      $("#model").html(response);
    },
    error: function (err) {
      alert(err);
    },
  });
});

const Add_To_Cart = (uid) => {
  let token = $('#token').val();

  //assign data for JSON string
  let data = {
    Type:'Add',
    ID: uid
  };


  //ajax request to server
  $.ajax({
    method: 'POST',
    url: '../../server/Cart.php',
    data: JSON.stringify(data),
    success:function(response){
      let resp_data = JSON.parse(response);
      $('#cart').text(`Cart(${resp_data})`);
      console.log(resp_data);
    },
    error:function(err){
      console.log(err)
    },
  });

};

$(function () {
  $("#btnRegister").on("click", function () {
    window.location.href = "../client/Register.php";
  });
});

$(function () {
  $("#btnLogin").on("click", function () {
    window.location.href = "../client/Login.php";
  });
});

$(function () {
  $("#overlay").on("click", function () {
    let overlay = document.getElementById("overlay");
    let popup = document.getElementById("popup");

    overlay.style.display = "none";
    popup.style.transition = "all 0.8s ease-in-out";
    popup.style.top = "-50%";
  });
});
