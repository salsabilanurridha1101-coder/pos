<?php
// isset: ada / tidak kosong
//!     : tidak ada/ kosong
//jika session kosong
function checkLogin()
{
    if (!isset($_SESSION['ID'])) {
        header("location:index.php?access=failed");
    }
}
