<?php
   session_start();
   
   if(session_destroy()) {
      header("Location: client_login.php");
   }
?>