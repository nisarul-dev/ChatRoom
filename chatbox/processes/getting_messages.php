<?php
include "functions.php";
if (isset($_POST['receiver'])) {
    $author_id = $_SESSION['id'];
    $receiver_id = $_POST['receiver'];

    if (!empty($_POST['message'])) {
        $message = sanitizer($_POST['message']);
        $insert_message = $connection->query("INSERT INTO `chats` (`msg_id`, `author_id`, `receiver_id`, `message`, `created`) VALUES (NULL, '$author_id', '$receiver_id', '$message', CURRENT_TIMESTAMP)");
        custom_query_error($insert_message);
    }

    $chat_table = $connection->query("SELECT * FROM chats WHERE (receiver_id = $receiver_id AND author_id = $author_id) OR (receiver_id = $author_id AND author_id = $receiver_id ) ORDER BY msg_id DESC");

    while ($chat_table_obj = $chat_table->fetch_object()) : ?>

        <?php if ($chat_table_obj->author_id == $author_id) : ?>
            <div class="d-flex justify-content-end mb-4">
                <div class="msg_cotainer_send" style="min-width: 7em;">
                    <?php echo $chat_table_obj->message; ?>
                    <span class="msg_time_send"><?php echo get_sweet_time($chat_table_obj->created); ?></span>
                </div>
                <div class="img_cont_msg">
                    <img src="images/users/<?php echo !empty($_SESSION['profile_img']) ? $_SESSION['profile_img'] : "usericon-self.png" ?>" class="rounded-circle user_img_msg">
                </div>
            </div>
        <?php endif; ?>

        <?php if ($chat_table_obj->author_id == $receiver_id) :
            $receiver_table = $connection->query("SELECT * FROM users WHERE usr_id = $receiver_id");
            $receiver_table_obj = $receiver_table->fetch_object();
            ?>
            <div class="d-flex justify-content-start mb-4">
                <div class="img_cont_msg">
                    <img src="images/users/<?php echo !empty($receiver_table_obj->profile_img) ? $receiver_table_obj->profile_img : "usericon-sender.png" ?>" class="rounded-circle user_img_msg">
                </div>
                <div class="msg_cotainer" style="min-width: 7em;">
                    <?php echo $chat_table_obj->message; ?>
                    <span class="msg_time">8:40 AM, Today</span>
                </div>
            </div>
        <?php endif; ?>

    <?php endwhile;
}



