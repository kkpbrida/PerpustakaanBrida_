<?php
// jika belum login
if(isset($_SESSION['login'])){
}
else{
    header("location: home.php");
}
?>