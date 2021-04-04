// Chat application Codes
// var id = prompt("Your id:");
var id = 1;

// AJAX
var url = "processes/getting_messages.php";
// Submitting A message
$('#message-form').submit(function (e) {
    e.preventDefault();
    $.post(url, {
        author_id: id,
        message: $('#textarea1').val()
    },
        function (result) {
            $(".message-body").html(result);
        }
    );
    $(".emojionearea-editor").html('');
    return false;
});

// Getting the message
var autoLoad = setInterval(function () {
    $.get(url, {},
    function (result) {
        $(".message-body").html(result);
    }
    );
}, 500);



// Scrooling down
scrolldown(".message-body");

function scrolldown(document) {
    $(document).scrollTop($(document).height());
}



//Getting the contacts
url2 = "processes/getting_users.php";
$.get(url2, {},
    function (result) {
        $(".contacts").html(result);
    }
);