<?php
include "db.php";
try {
    if (isset($_POST['no'])) {
        $no = $_POST['no'];
        $last_no = $_POST['lastno'];
        $date = strtotime($_POST['date']);
        $dates = date("Y-m-d", $date);
        $client_name = $_POST['client_name'];
        $client_code = $_POST['client_code'];
        $sum_purchase = $_POST['sum_purchase'];
        $sum_sale = $_POST['sum_sale'];
        $cat_name = $_POST['cat_name'];
        $empty = $_POST['empty'];
        $empty_value = $_POST['empty_value'];
        $cat_weight = $_POST['cat_weight'];
        $unit = $_POST['unit'];
        $gm_weight = $_POST['gm_weight'];
        $net_weight = $_POST['net_weight'];
        $cat_price_dis = $_POST['cat_price_dis'];
        $cat_price_def = $_POST['cat_price_def'];
        $total_p = $_POST['total_p'];
        $total_s = $_POST['total_s'];
        $profit = $_POST['profit'];
        $net_profit = $_POST['net_profit'];

        $query = '';
        for ($x = 0; $x < count($_POST['no']); $x++) {
            $no_clean = mysqli_real_escape_string($conn, $no[$x]);
            $cat_name_clean = mysqli_real_escape_string($conn, $cat_name[$x]);
            $empty_clean = mysqli_real_escape_string($conn, $empty[$x]);
            $empty_value_clean = mysqli_real_escape_string($conn, $empty_value[$x]);
            $cat_weight_clean = mysqli_real_escape_string($conn, $cat_weight[$x]);
            $unit_clean = mysqli_real_escape_string($conn, $unit[$x]);
            $gm_weight_clean = mysqli_real_escape_string($conn, $gm_weight[$x]);
            $net_weight_clean = mysqli_real_escape_string($conn, $net_weight[$x]);
            $cat_price_dis_clean = mysqli_real_escape_string($conn, $cat_price_dis[$x]);
            $cat_price_def_clean = mysqli_real_escape_string($conn, $cat_price_def[$x]);
            $total_p_clean = mysqli_real_escape_string($conn, $total_p[$x]);
            $total_s_clean = mysqli_real_escape_string($conn, $total_s[$x]);
            $profit_clean = mysqli_real_escape_string($conn, $profit[$x]);

            $query .= 'insert into invoice (invoice_no,no,cat_name,empty_name,empty_value,cat_weight,Unit,
            gm_weight,net_weight, cat_price_dis, cat_price_def, total_purchase, total_sale, profit) values ("' . $last_no . '","' . $no_clean . '"
            ,"' . $cat_name_clean . '","' . $empty_clean . '","' . $empty_value_clean . '","' . $cat_weight_clean . '","' . $unit_clean . '","' . $gm_weight_clean . '"
            ,"' . $net_weight_clean . '","' . $cat_price_dis_clean . '","' . $cat_price_def_clean . '","' . $total_p_clean . '","' . $total_s_clean . '","' . $profit_clean . '");
           ';
            $query2 = 'insert into 
                       total(invoice_no, date, ClientName, ClientCode, sum_purchase, sum_sale, net_profit) 
                       values
                       ("' . $last_no . '",CAST("' . $dates . '" AS DATE),"' . $client_name . '","' . $client_code . '","' . $sum_purchase . '","' . $sum_sale . '","' . $net_profit . '")' or mysqli_error($conn);

        }


        if ($query != '' && $sum_purchase != '' && $sum_sale != '') {
            if (mysqli_query($conn, $query2)) {
                echo "تم الحفظ فى جدول ال total";
            } else {
                echo mysqli_error($conn);
                echo "فى مشكلة فى حفظ الTotal ";
            }

            if (mysqli_multi_query($conn, $query)) {
                echo "تمت عملية الحفظ";
            } else {
                echo "حدث خطا";
            }
        } else {
            echo "املأ جميع الحقول";
        }
        return 'success';
    } else {
        echo "error";
    }


} catch (Exception $e) {
    return 'success';
}


?>