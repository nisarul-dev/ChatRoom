<?php

include "functions.php";


$user_table = $connection->query("SELECT * FROM users");
$i=0;
while($user_table_obj = $user_table->fetch_object() ) :
if($user_table_obj->usr_id != $_SESSION['id']) : ?>

<li class="<?php if($i == 0) echo "active"; ?> contact-item" data-user-id="<?php echo $user_table_obj->usr_id; ?>" style="cursor: pointer">
    <a href="#to-message" style="text-decoration: none;">
        <div class="d-flex bd-highlight" >
            <div class="img_cont">
                <img src="images/users/<?php echo !empty($user_table_obj->profile_img) ? $user_table_obj->profile_img : "usericon-sender.png" ?>" class="rounded-circle user_img">
                <span class="online_icon"></span>
            </div>
            <div class="user_info">
                <span><?php echo $user_table_obj->firstname . " " .  $user_table_obj->lastname;  ?></span>
                <p>
                <?php
                        $author_id = $_SESSION['id'];
                        $receiver_id = $user_table_obj->usr_id;
                        $last_message = $connection->query("SELECT `message` FROM `chats` WHERE (receiver_id = $receiver_id AND author_id = $author_id) OR (receiver_id = $author_id AND author_id = $receiver_id ) ORDER BY `msg_id` DESC ");
                        if($last_message->num_rows < 1) {
                            echo "No Messages";
                        } else {
                            echo substr($last_message->fetch_object()->message, "0", "30") . " ...";
                        }
                    ?>
                </p>
            </div>
        </div>
    </a>
</li>

<?php $i++; endif; endwhile;
