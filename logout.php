<?php
session_start();
session_unset();
session_destroy();
setcookie("logged_in", true, time() - (86400 * 30), "/");
setcookie("privilege", $_SESSION["privilege"], time() - (86400 * 30), "/");
setcookie("username", $_SESSION["username"], time() - (86400 * 30), "/");
return header("Location: index.php");