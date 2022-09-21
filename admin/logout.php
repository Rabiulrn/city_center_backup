<?php
    session_start(); // start a session first, else you cannot destroy/unset it
    session_destroy(); // destroy all sessions
    header('location:index.php'); // redirect
?>