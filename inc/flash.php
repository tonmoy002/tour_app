<?php 

class FlashMessage {

    public static function render($var) {
        if (!isset($_SESSION[$var])) {
            return null;
        }
        $messages = $_SESSION[$var];
        unset($_SESSION[$var]);
        return $messages;
    }

    public static function add($var,$val) {
        return $_SESSION[$var]= $val;
    }

}

?>