<?php if (!defined('THINK_PATH')) exit(); if($is_following): ?><button type="button" class="btn btn-default" onclick="ufollow(this,<?php echo ($uid); ?>)">
        已关注
    </button>
    <?php else: ?>
    <button type="button" class="btn btn-primary" onclick="ufollow(this,<?php echo ($uid); ?>)">
        关注
    </button><?php endif; ?>