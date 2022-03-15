<?php
$auth = function() {
    if (isset($_SESSION['user'])) {
        return true;
    } else {
        return false;
    }
};
