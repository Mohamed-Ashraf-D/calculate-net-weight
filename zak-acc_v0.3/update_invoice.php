<?php
include "db.php";
try {
    if (isset($_POST['no'])) {
        $count = $_POST['count'];
        $no = $_POST['no'];
        $last_no = $_POST['lastno'];
        $sum_purchase = $_POST['sum_purchase'];
        $sum_sale = $_POST['sum_sale'];
        $date = strtotime($_POST['date']);
        $dates = date("Y-m-d", $date);
        $dates1 = $_POST['date'];
        $client_name = $_POST['client_name'];
        $client_code = $_POST['client_code'];
        $sum = $_POST['sum'];
        $cat_name = $_POST['cat_name'];
        $empty = $_POST['empty'];
        $empty_value = $_POST['empty_value'];
        $cat_weight = $_POST['cat_weight'];
        $gm_weight = $_POST['gm_weight'];
        $net_weight = $_POST['net_weight'];
        $cat_price_dis = $_POST['cat_price_dis'];
        $cat_price_def = $_POST['cat_price_def'];
        $total_p = $_POST['total_p'];
        $total_s = $_POST['total_s'];
        $profit = $_POST['profit'];
        $net_profit = $_POST['net_profit'];
        $id = $_POST['id'];
        $query = '';
        for ($x = 0; $x < count($no); $x++) {
            $no_clean = $no[$x];
            $cat_name_clean = $cat_name[$x];
            $empty_clean = $empty[$x];
            $empty_value_clean = $empty_value[$x];
            $cat_weight_clean = $cat_weight[$x];
            $gm_weight_clean = $gm_weight[$x];
            $net_weight_clean = $net_weight[$x];
            $cat_price_dis_clean = $cat_price_dis[$x];
            $cat_price_def_clean = $cat_price_def[$x];
            $total_p_clean = $total_p[$x];
            $total_s_clean = $total_s[$x];
            $profit_clean = $profit[$x];


            $query .= 'update invoice set invoice_no="' . $id . '",no="' . $no_clean . '",cat_name="' . $cat_name_clean . '"
            ,empty_name="' . $empty_clean . '",empty_value="' . $empty_value_clean . '",
                cat_weight="' . $cat_weight_clean . '",gm_weight="' . $gm_weight_clean . '",net_weight="' . $net_weight_clean . '",
                cat_price_dis="' . $cat_price_dis_clean . '",cat_price_def="' . $cat_price_def_clean . '",total_purchase="' . $total_p_clean . '",total_sale="' . $total_s_clean . '",profit="' . $profit_clean . '" where no="' . $no_clean . '" and invoice_no="' . $id . '";';


        }
        $query3 = 'select * from invoice where invoice_no="' . $id . '";';
        if ($result = mysqli_query($conn, $query3)) {
            $row = mysqli_num_rows($result);
            $count = $row;
            $c = $count + 1;
        }
        $query4 = '';
        for ($y = $count; $y < count($no); $y++) {

            $no_clean1 = mysqli_real_escape_string($conn, $no[$y]);
            $cat_name_clean1 = mysqli_real_escape_string($conn, $cat_name[$y]);
            $empty_clean1 = mysqli_real_escape_string($conn, $empty[$y]);
            $empty_value_clean1 = mysqli_real_escape_string($conn, $empty_value[$y]);
            $cat_weight_clean1 = mysqli_real_escape_string($conn, $cat_weight[$y]);
            $gm_weight_clean1 = mysqli_real_escape_string($conn, $gm_weight[$y]);
            $net_weight_clean1 = mysqli_real_escape_string($conn, $net_weight[$y]);
            $cat_price_dis_clean1 = mysqli_real_escape_string($conn, $cat_price_dis[$y]);
            $cat_price_def_clean1 = mysqli_real_escape_string($conn, $cat_price_def[$y]);
            $total_p_clean1 = mysqli_real_escape_string($conn, $total_p[$y]);
            $total_s_clean1 = mysqli_real_escape_string($conn, $total_s[$y]);
            $profit_clean1 = mysqli_real_escape_string($conn, $profit[$y]);


            $query4 .= 'insert into invoice (invoice_no, no, cat_name,empty_name, empty_value, cat_weight,
            gm_weight, net_weight, cat_price_dis, cat_price_def, total_purchase, total_sale, profit) values ("' . $id . '","' . $no_clean1 . '"
            ,"' . $cat_name_clean1 . '","' . $empty_clean1 . '","' . $empty_value_clean1 . '",
            "' . $cat_weight_clean1 . '","' . $gm_weight_clean1 . '"
            ,"' . $net_weight_clean1 . '","' . $cat_price_dis_clean1 . '","' . $cat_price_def_clean1 . '","' . $total_p_clean1 . '","' . $total_s_clean1 . '","' . $profit_clean1 . '");';


        }

        $query2 = 'update total set invoice_no="' . $id . '",date=CAST("' . $dates . '" AS DATE), ClientName="' . $client_name . '", ClientCode="' . $client_code . '", sum_purchase="' . $sum_purchase . '", sum_sale="' . $sum_sale . '", net_profit="' . $net_profit . '" where invoice_no="' . $id . '"';
        if (mysqli_query($conn, $query2, MYSQLI_USE_RESULT)) {
            echo "تمت عملية الحفظ q2";
            echo mysqli_error($conn);
        } else {
            echo "حدث خطأ q2" . mysqli_error($conn);
            header('location:update.php');
        }
        $result4 = mysqli_multi_query($conn, $query4);
        if ($result4) {
            echo "success inserted";
        } else {
            echo "error" . mysqli_error($conn);
            echo $no_clean;
        }

        $result = mysqli_multi_query($conn, $query);


        if ($result) {
            echo "تمت عملية الحفظ";
        } else {
            echo "حدث خطا";
        }

        return 'success';
    } else {
        echo "error";
    }


} catch (Exception $e) {
    return 'success';
}


?>