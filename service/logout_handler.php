<?php
session_start();
session_unset();
session_destroy();

echo "Logged out.";
echo "<a href='/pages/login.php'>Log in?</a>";