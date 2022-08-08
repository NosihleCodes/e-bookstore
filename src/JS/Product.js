let admin_ID;

$(function(){
  let url = window.location.href;
  let senderContent = $('#uuid').val();


  $(function () {
    const sku = url.substring(url.indexOf("=") + 1);

    if (sku) {
      $.ajax({
        url: "/poe/src/server/Get_Info.php",
        method: "POST",
        data: JSON.stringify({
          Type:'Info',
          SKU: sku,
        }),
        success: function (response) {
          if (response.trim(response)) {
            let data = JSON.parse(response);
            Set_Page_Data(data);
            Set_Data(data);

            Set_Student_Message(data[0].Admin_ID, senderContent);
            Set_Admin_Message(data[0].Admin_ID, senderContent);


          } else {
          }
        },
        error: function (err) {
          console.log(err);
        },
      });
    } else {
      console.log("Could Not Retrieve Data");
    }
  });

  Close_Chat();
});

const Set_Student_Message = (admin, student) => {
  const chatbox = document.getElementById('messages'); //main chat area

  let obj = {
    Type: 'Student_Messages',
    UUID: student,
    Admin: admin
  };

  $.ajax({
    method: 'POST',
    url: '/poe/src/server/Get_Info.php',
    data: JSON.stringify(obj),
    success:function(response){
      console.log(response);
      let data = JSON.parse(response);
      console.log(data);

      const messageBlock = document.createElement("div");
      messageBlock.classList.add('message');

      //creating sender paragraph tag
      const sender = document.createElement('p');
      sender.innerText = data[0].Sender;
      sender.classList.add('sender');

      //create message content
      const msg = document.createElement('p');
      msg.innerText = data[0].Message;
      msg.classList.add('content');

      messageBlock.appendChild(sender);
      messageBlock.appendChild(msg);

      chatbox.appendChild(messageBlock);
    },
    error: function(err){
      console.log(err);
    }
  });
}

const Set_Admin_Message = (admin, student) => {
  const chatbox = document.getElementById('messages'); //main chat area

  let obj = {
    Type: 'Admin_Messages',
    UUID: student,
    Admin: admin
  };

  $.ajax({
    method: 'POST',
    url: '/poe/src/server/Get_Info.php',
    data: JSON.stringify(obj),
    success:function(response){
      console.log(response);
      let data = JSON.parse(response);
      console.log(data);

      const messageBlock = document.createElement("div");
      messageBlock.classList.add('message');

      //creating sender paragraph tag
      const sender = document.createElement('p');
      sender.innerText = data[0].Sender;
      sender.classList.add('sender');

      //create message content
      const msg = document.createElement('p');
      msg.innerText = data[0].Message;
      msg.classList.add('content');

      messageBlock.appendChild(sender);
      messageBlock.appendChild(msg);

      chatbox.appendChild(messageBlock);
    },
    error: function(err){
      console.log(err);
    }
  });
}

const Set_Page_Data = (json) => {
  admin_ID = json[0].Admin_ID;
  let page_title = "EDU-FY || " + json[0].Display_Name;
  let in_stock = json[0].InStock;

  document.title = page_title;
  $("#isVerified").text(`Seller: ${admin_ID}`);

  in_stock === "1"
    ? Set_Stock({
        node: "In Stock",
        curr_node: "no_stock",
        new_node: "stock",
      })
    : Set_Stock({
        node: "Out of Stock",
        curr_node: "stock",
        new_node: "no_stock",
      });

  Open_Chat(admin_ID);

};

const Set_Data = (json) => {
  $("#ProductName").text(json[0].Display_Name);
  $("#Price").text(`R ${json[0].Price}`);
  $("#Description").text(json[0].Description);
  $("#imgProduct").attr("src", json[0].Image_Source);
  $("#ISBN").text(`ISBN(13): ${json[0].ISBN}`);
};

const Set_Stock = (arg) => {
  $("#instock").text(arg.node);
  $("#instock").removeClass(arg.curr_node).addClass(arg.new_node);
};

const Close_Chat = () => {
  const chat = document.getElementById("chat");
  chat.style.transition = "all 0.8s ease-in-out";
  chat.style.height = "0%";
  chat.style.display = "none";
}



const Open_Chat = (name) => {
  $("#btnChat").on("click", function () {
    const chat = document.getElementById("chat");
    chat.style.transition = "all 0.8s ease-in-out";
    chat.style.height = "40%";
    chat.style.display = "block";

    $("#txtSeller").text("Chat with " + name);
  });
};

$(function(){
  $('#btnSend').on('click',function(){
    const chatbox = document.getElementById('messages'); //main chat area
    let senderContent = $('#uuid').val();
    let message = $('#content').val();

    if (message){
      //create message parent container
      const messageBlock = document.createElement("div");
      messageBlock.classList.add('message');

      //creating sender paragraph tag
      const sender = document.createElement('p');
      sender.innerText = senderContent;
      sender.classList.add('sender');

      //create message content
      const msg = document.createElement('p');
      msg.innerText = message;
      msg.classList.add('content');

      messageBlock.appendChild(sender);
      messageBlock.appendChild(msg);

      chatbox.appendChild(messageBlock);

      let obj = {
        Type: 'Message',
        Sender: senderContent,
        Receiver: admin_id,
        Message_Content: message
      };

      $.ajax({
        method: 'POST',
        url: '/poe/src/server/Get_Info.php',
        data: JSON.stringify(obj),
        success:function(response){
          console.log(response);
        },
        error: function(err){
          console.log(err);
        }
      });
    }
  });
});
