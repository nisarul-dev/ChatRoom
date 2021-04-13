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
            window.goDown = true;


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
        $(".message-body").scrollTop($(".message-body")[0].scrollHeight);
    }
);

var autoLoad = setInterval(function () {
    $.post(url, {receiver: window.receiver_id},
        function (result) {
            if (window.result != result) {
                $(".message-body").html(result);
                window.result = result;

                // If some one goes up to see previous messages don't bring him down
                if ($(".message-body")[0].scrollTop > ($(".message-body")[0].scrollHeight - $(".message-body").height() - 240)) {
                    $(".message-body").scrollTop($(".message-body")[0].scrollHeight);
                } else if ($(".message-body")[0].scrollTop  == 0)  {
                    $(".message-body").scrollTop($(".message-body")[0].scrollHeight);
                }

                if (window.goDown == true) {
                    $(".message-body").scrollTop($(".message-body")[0].scrollHeight);
                    window.goDown == false;
                }
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
    },
        function (result) {
            $(".message-body").html(result);
            $(".message-body").scrollTop($(".message-body")[0].scrollHeight);
        }
        );
    // $(".emojionearea-editor").html('');
    $('#textarea1').val('');
    $('#textarea1').focus();
    return false;
});

// Scrolling down
$(".message-body").scrollTop($(".message-body")[0].scrollHeight);




// Message go with Enter and NewLine with Shift+Enter
$("#textarea1").keyup(function (event) {
    if (event.keyCode == 13 && event.shiftKey) {
        e.preventDefault();
    }
    if (event.keyCode == 13 && !event.shiftKey) {
        $("#btn-submit").click();
    }
});