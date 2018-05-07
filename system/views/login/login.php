<?php
/*
 |  FoxCMS      Content Management Simplified <www.foxcms.org>
 |  @file       ./system/views/login/login.php
 |  @author     SamBrishes@pytesNET
 |  @version    0.8.4 [0.8.4] - Alpha
 |
 |  @license    GNU GPL v3
 |  @copyright  Copyright © 2015 - 2018 SamBrishes, pytesNET <pytes@gmx.net>
 |
 |  @history    Copyright © 2009 - 2015 Martijn van der Kleijn <martijn.niji@gmail.com>
 |              Copyright © 2008 - 2009 Philippe Archambault <philippe.archambault@gmail.com>
 */
    if(!defined("FOXCMS")){ die(); }

?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo DEFAULT_LANGUAGE; ?>" lang="<?php echo DEFAULT_LANGUAGE; ?>">
    <head>
        <meta charset="utf-8" />

        <title><?php echo $this->getTitle(); ?> | Fox CMS Administration</title>

        <link type="text/css" rel="stylesheet" href="<?php echo get_theme_path("login.css"); ?>" media="screen" />
        <script type="text/javascript" src="<?php echo get_theme_path("../../js/jquery-1.8.3.min.js"); ?>" charset="UTF-8"></script>

        <!-- A Wolf CMS Script -->
        <script type="text/javascript">
            $(document).ready(function(){
                (function showMessages(e) {
                    e.fadeIn('slow')
                    .animate({opacity: 1.0}, 1500)
                    .fadeOut('slow', function() {
                        if ($(this).next().attr('class') == 'message') {
                            showMessages($(this).next());
                        }
                        $(this).remove();
                    })
                })( $(".message:first") );

                $("input:visible:enabled:first").focus();
            });
        </script>
    </head>
    <body>
        <div id="dialog">
            <h1><?php echo __("Login") . " - " . Setting::get("site-title"); ?></h1>
            <?php
                foreach(array("error", "warning", "success", "info") AS $type){
                    if(!empty(Flash::get($type))){
                        ?>
                            <div id="<?php echo $type; ?>" class="message" style="display: none;">
                                <?php print(Flash::get($type)); ?>
                            </div>
                        <?php
                    }
                }
            ?>
            <form method="post" action="<?php echo get_url("login/login"); ?>">
                <div id="login-username-div">
                    <label for="login-username"><?php _e("Username"); ?></label>
                    <input type="text" id="login-username" name="login[username]" value="" class="medium"
                        placeholder="<?php _e("Your Username or eMail"); ?>" />
                </div>
                <div id="login-password-div">
                    <label for="login-password"><?php _e("Password"); ?></label>
                    <input type="password" id="login-password" name="login[password]" value="" class="medium"
                        placeholder="<?php _e("Your Password"); ?>" />
                </div>
                <div class="clean"></div>

                <div>
                    <input type="checkbox" id="login-remember-me" name="login[remember]" value="checked" class="checkbox" />
                    <label for="login-remember-me" class="checkbox"><?php _e("Remember Login"); ?></label>
                </div>
                <div id="login_submit">
                    <input type="hidden" id="login-redirect" name="redirect_to" value="<?php echo $redirect; ?>" />
                    <input type="submit" name="submit" value="<?php _e("Login"); ?>" class="submit" />
                    <span>(<a href="<?php echo get_url("login/forgot"); ?>"><?php _e("Forgot Password?"); ?></a>)</span>
                </div>
            </form>
        </div>
        <p><?php _e("Website"); ?>: <a href="<?php echo PUBLIC_URL; ?>"><?php echo Setting::get("site-title"); ?></a></p>
    </body>
</html>