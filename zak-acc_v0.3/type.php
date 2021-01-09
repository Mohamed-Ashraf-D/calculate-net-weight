<?php
if (isset($_POST['type'])) {
    $cat = $_POST['type'];
    $sel3 = "SELECT * FROM categories where cat_name='$cat'";
    $result3 = mysqli_query($conn, $sel3);
    while ($rows3 = mysqli_fetch_assoc($result3)) {
        $type = $rows3['type'];

           echo $type;
    }
}
            else{
                echo "wwwwwwwwwwwwwwwwww";
            }
            ?>
