<?php
session_start();
if(isset($_SESSION['name'])){
    $text = $_POST['text'];
     
    $cb = fopen("log.html", 'a');
    fwrite($cb, "<div class='msgln'> <b>".$_SESSION['name']."</b>: ".stripslashes(htmlspecialchars($text))."<br><br></div>");
    fclose($cb);
}
?>