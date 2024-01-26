<?php
session_start();
session_unset();
session_destroy();
return header("Location: index.php");