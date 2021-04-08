// Chat application Codes


//Getting the contacts
url2 = "processes/getting_users.php";

$.post(url2, {},
    function (result) {
        $(".contacts").html(result);
        window.receiver_id = $(".contacts_body .contacts .contact-item")[0].attributes['data-user-id'].value;

        $(".contacts_body .contacts .contact-item").click(function(e) {
            window.receiver_id = e.currentTarget.attributes['data-user-id'].value;
            $(".contacts_body .contacts .contact-item").removeClass("active");
            e.currentTarget.className = "active contact-item";

            // Getting the message header Part-I
            window.currentReceiverName = $(".contacts .active .user_info span").html();
            window.currentReceiverPhoto = $(".contacts .active .img_cont img").attr('src');
            $(".msg_head .user_info .receiver-name").html(window.currentReceiverName);
            $(".msg_head .img_cont img").attr('src', window.currentReceiverPhoto);
        });

        // Getting the message header Part-I
        window.currentReceiverName = $(".contacts .active .user_info span").html();
        window.currentReceiverPhoto = $(".contacts .active .img_cont img").attr('src');
        $(".msg_head .user_info .receiver-name").html(window.currentReceiverName);
        $(".msg_head .img_cont img").attr('src', window.currentReceiverPhoto);
    }
);


// Getting the message
var url = "processes/getting_messages.php";

$.post(url, { receiver: window.receiver_id},
    function (result) {
        window.result = result;
        $(".message-body").html(result);
    }
);

var autoLoad = setInterval(function () {
    $.post(url, {receiver: window.receiver_id},
        function (result) {
            if (window.result != result) {
                $(".message-body").html(result);
                window.result = result;
            }
    }
    );
}, 500);

// Submitting A message
$('#message-form').submit(function (e) {
    e.preventDefault();
    $.post(url, {
            receiver: window.receiver_id,
            message: $('#textarea1').val()
        }
    );
    $(".emojionearea-editor").html('');
    return false;
});





// Scrooling down
scrolldown(".message-body");

function scrolldown(document) {
    $(document).scrollTop($(document).height());
}

