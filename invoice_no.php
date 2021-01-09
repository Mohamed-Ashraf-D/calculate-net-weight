<?php
include "db.php";
$sql="SELECT MAX(invoice_no) AS max_invoice from invoice";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);
$last_invoice_no=$row['max_invoice']+1;
echo $last_invoice_no;
?>

