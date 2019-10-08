<?php

class Message {

    private static $errors;
    private static $successes;
    private static $warnings;

    public static function concatError($error) {
        self::$errors = self::$errors . "<h4 class='alert_error'>$error</h4>";
    }

    public static function raiseError() {
        echo self::$errors;
    }

    public static function isError() {
        if (self::$errors != "")
            return false;
        return true;
    }

    public static function concatWarning($warning) {
        self::$warnings = self::$warnings . "<h4 class='alert_warning'>$warning</h4>";
    }

    public static function raiseWarning() {
        echo self::$warnings;
    }

    public static function concatSuccess($success) {
        self::$successes = self::$successes . "<h4 class='alert_success'>$success</h4>";
    }

    public static function raiseSuccess() {
        echo self::$successes;
    }

}

?>