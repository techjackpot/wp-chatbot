<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://github.com/techjackpot
 * @since      1.0.0
 *
 * @package    Sixaxis_Wp_Chatbot
 * @subpackage Sixaxis_Wp_Chatbot/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
  <h2>Training</h2>
  <form class="chatbot-training-form" method="POST" style="display: none;">
    <div class="chatbot-training-status"></div>
    <p class="submit"><input type="submit" name="submit" id="chatbot-training-submit" class="button button-primary" value="Trigger"></p>
  </form>
</div>