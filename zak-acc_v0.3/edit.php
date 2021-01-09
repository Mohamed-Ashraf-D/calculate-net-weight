<?php
include 'db.php';
$input = filter_input_array(INPUT_POST);
$cat_name = mysqli_real_escape_string($conn, $input['cat_name']);
$empty_name = mysqli_real_escape_string($conn, $input['empty_name']);
$empty_value = mysqli_real_escape_string($conn, $input['empty_value']);
$cat_weight = mysqli_real_escape_string($conn, $input['cat_weight']);
$gm_weight = mysqli_real_escape_string($conn, $input['gm_weight']);
$net_weight = mysqli_real_escape_string($conn, $input['net_weight']);
$cat_price_dis = mysqli_real_escape_string($conn, $input['cat_price_dis']);
$cat_price_def = mysqli_real_escape_string($conn, $input['cat_price_def']);
$total_purchase = mysqli_real_escape_string($conn, $input['total_p']);
$total_sale = mysqli_real_escape_string($conn, $input['total_s']);
$profit = mysqli_real_escape_string($conn, $input['profit']);
if ($input['action'] === 'edit') {
  // $sql = "UPDATE invoice SET cat_name='" . $cat_name . "',empty_name='" . $empty_name . "',empty_value='" . $empty_value . "',cat_weight='" . $cat_weight . "',gm_weight='" . $gm_weight . "',net_weight='" . $net_weight . "',cat_price='" . $cat_price . "',total='" . $total . "' WHERE id='" . $input['id'] . "'";
//mysqli_query($conn,$sql);
}
echo json_encode($input);
?>