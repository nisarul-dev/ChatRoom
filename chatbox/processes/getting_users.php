<?php

include "functions.php";


$user_table = $connection->query("SELECT * FROM users");
$i=0;
while($user_table_obj = $user_table->fetch_object() ) :
if($user_table_obj->usr_id != $_SESSION['id']) : ?>


<li class="<?php if($i == 0) echo "active"; ?> contact-item" data-user-id="<?php echo $user_table_obj->usr_id; ?>" style="cursor: pointer">
    <div class="d-flex bd-highlight" >
        <div class="img_cont">
            <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img">
            <span class="online_icon"></span>
        </div>
        <div class="user_info">
            <span><?php echo $user_table_obj->firstname . " " .  $user_table_obj->lastname;  ?></span>
            <p>
            <?php
                    $author_id = $_SESSION['id'];
                    $receiver_id = $user_table_obj->usr_id;
                    $last_message = $connection->query("SELECT `message` FROM `chats` WHERE (receiver_id = $receiver_id AND author_id = $author_id) OR (receiver_id = $receiver_id AND author_id = $author_id ) ORDER BY `msg_id` DESC ");
                    if($last_message->num_rows < 1) {
                        echo "No Messages";
                    } else {
                        echo substr($last_message->fetch_object()->message, "0", "30") . " ...";
                    }
                ?>
            </p>
        </div>
    </div>
</li>

<?php $i++; endif; endwhile;
