$(function(){
    $.ajax({
        method: 'POST',
        url: '../../server/Get_Student.php',
        success:function(response){
            $('#table').html(response);
        },
        error:function(err){
            console.log(err);
        }
    });

    $.ajax({
        method: "POST",
        url: "../../server/Manage_Student.php",
        data: JSON.stringify({
            Type: "Books"
        }),
        success: function (response) {
            $("#productTable").html(response);
        },
        error: function (err) {
            console.log(err);
        },
    });
});

const Accept_Request = (isbn) => {
    $.ajax({
        method: "POST",
        url: "../../server/Manage_Student.php",
        data: JSON.stringify({ Type: "Accept", ISBN: isbn }),
        success: function (response) {
            let data = JSON.parse(response);
            console.log(data);
        },
        error: function (err) {
            console.log(err);
        },
    });
};

const Decline_Request = (isbn) => {
    $.ajax({
        method: "POST",
        url: "../../server/Manage_Student.php",
        data: JSON.stringify({Type: "Decline", ISBN: isbn}),
        success: function (response) {
            let data = JSON.parse(response);
            console.log(data);
        },
        error: function (err) {
            console.log(err);
        },
    });
}

const Verify_User = (id) => {
   // console.log(id);

    $.ajax({
        method: 'POST',
        url: '../../server/Manage_Student.php',
        data:{
            Verify: 'Verify',
            ID: id,
        },
        success: function(response){
            console.log(response);
        },
        error: function(err){
            alert(err);
        }
    });
}

const Remove_User = (id) => {
    console.log(id);

    $.ajax({
        method: 'POST',
        url: '../../server/Manage_Student.php',
        data:{
            Remove: 'Remove',
            ID: id,
        },
        success: function(response){
            console.log(response);
        },
        error: function(err){
            alert(err);
        }
    });
}
