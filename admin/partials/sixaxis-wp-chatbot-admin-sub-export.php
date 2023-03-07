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
  <h2>Export</h2>
  <form class="chatbot-export-form" method="POST">
    <table class="form-table">
      <tr>
        <th>From:</th>
        <td><input type="date" id="date_from" value="<?php echo date('Y-m-d'); ?>" /></td>
      </tr>
      <tr>
        <th>To:</th>
        <td><input type="date" id="date_to" value="<?php echo date('Y-m-d'); ?>" /></td>
      </tr>
    </table>
    <p class="submit"><input type="submit" name="submit" id="chatbot-export-submit" class="button button-primary" value="Export"></p>
  </form>
</div>