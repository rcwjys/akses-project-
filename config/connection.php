<?php 
    $conn = mysqli_connect('localhost', 'root', '', 'akses');

    if (!$conn) {
        echo mysqli_connect_error($conn);
    }
?>