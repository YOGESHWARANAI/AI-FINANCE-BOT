<?php if (!defined('ABSPATH')) { exit; } ?>

<div
    text-type="h7">
    Something went wrong?
    <a
        href="<?= CHATBOTCOM_ADMIN_PAGE_URL ?>&nonce=<?= wp_create_nonce(CHATBOTCOM_NONCE) ?>&action=disconnect"
        text-color="black"
        text-underline
        text-actions>
        Disconnect your account
    </a>
</div>
