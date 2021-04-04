<?php

include "functions.php";


$user_table = $connection->query("SELECT * FROM users");

while($user_table_obj = $user_table->fetch_object() ) : ?>

<li class="active">
    <div class="d-flex bd-highlight">
        <div class="img_cont">
            <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img">
            <span class="online_icon"></span>
        </div>
        <div class="user_info">
            <span><?php echo $user_table_obj->firstname; ?></span>
            <p><?php echo "Last message" . " ..."; ?></p>
        </div>
    </div>
</li>

<?php endwhile;
