<?php
include "functions.php";

if (!empty($_POST['author_id']) && !empty($_POST['message'])) {
    $author_id = $_POST['author_id'];
    $message = $_POST['message'];
    $insert_message = $connection->query("INSERT INTO `chats` (`msg_id`, `author_id`, `message`, `created`) VALUES (NULL, '$author_id', '$message', CURRENT_TIMESTAMP)");
    custom_query_error($insert_message);
}


$chat_table = $connection->query("SELECT * FROM chats");

while($chat_table_obj = $chat_table->fetch_object() ) : ?>

<div class="d-flex justify-content-start mb-4">
    <div class="img_cont_msg">
        <img src="../images/_D.jpg" class="rounded-circle user_img_msg">
    </div>
    <div class="msg_cotainer" style="min-width: 5em;">
        <?php echo $chat_table_obj->message; ?>
        <span class="msg_time">8:40 AM, Today</span>
    </div>
</div>

<?php endwhile;




