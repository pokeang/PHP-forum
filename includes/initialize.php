<?php //DIRECTORY_SEPARATOR use for linux
defined("DS")? null : define("DS", "/");
defined("LIB_PATH")? null : define("LIB_PATH", "");
require_once(LIB_PATH.DS."config.php");
defined("FRONT_SITE_DIR")? null : define("FRONT_SITE_DIR", str_replace(DS."includes","",LIB_PATH));
defined("BACK_SITE_DIR")? null : define("BACK_SITE_DIR", FRONT_SITE_DIR.DS.ADMIN_FOLDER);


require_once(LIB_PATH.DS."database.php");
require_once(LIB_PATH.DS."message.php");
require_once (LIB_PATH.DS."db_action.php");

?>