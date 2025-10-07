<?php
session_start();
unset($_SESSION['login']);
?>
<script>
    let url = '../login.php';
    window.location.href = url;
</script>