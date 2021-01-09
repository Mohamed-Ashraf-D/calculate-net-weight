<?php
include "db.php";
$pageTitle = 'فاتورة جديدة';
$unit_1 = 'الكيلو جرام';
$unit_2 = 'قطعة';
$unit_3 = 'الجالون';
$unit_4 = 'السنتيمتر';
?>

<?php include 'header.php' ?>

<div class="row mt-3 ">

    <div class="col-2 col-md-2 mt-4  col-sm-2 text-center ">
        <label class="hide" for="client_sel">.</label>
        <select id="client_sel" class="form-control single-select" tabindex="1" style="height: 100px;">
            <option value="" disabled selected hidden>اختر اسم العميل</option>
            <?php $sql3 = "SELECT * FROM clients";
            $result3 = mysqli_query($conn, $sql3);
            while ($rows3 = mysqli_fetch_assoc($result3)) { ?>


                <option name="client_sel"  value="<?php echo $rows3['ClientCode']?>"><?php echo $rows3['ClientName']?></option>
                <?php
            }
            ?>
        </select>
    </div>
    <div class="col-1 col-md-1 mt-4 col-sm-2 text-center ">
        <label class="" for="invoice_no">رقم الفاتورة</label>

        <input class="form-control" type="text" tabindex="-1" id="invoice_no" readonly>
    </div>
    <div class="col-2 col-md-2 mt-4 text-center">
        <label class="" for="date">التاريخ</label>

        <input tabindex="1" class="form-control" type="date" data-date="12-02-2012" data-date-format="yyyy-mm-dd"
               id="date">
    </div>

    <div class="col-2 mt-4 col-md-2 text-center">
        <label class="" for="sum_purchase"> مجموع س-الشراء</label>

        <input class="form-control" type="text" tabindex="-1" id="sum_purchase" readonly>
    </div>
    <div class="col-2 mt-4 col-md-2 text-center">
        <label class="" for="sum_sale"> مجموع س-البيع</label>

        <input class="form-control" tabindex="-1" type="text" id="sum_sale" readonly>
    </div>

    <div class="col-2 mt-4 col-md-2 text-center">
        <label class="" for="net_profit">الربح الكلى</label>

        <input class="form-control" tabindex="-1" type="text" id="net_profit" readonly>
    </div>
</div>

<div class="row mt-5">

</div>
<form id="frm">
    <table class="table-sm table  text-center" cellpadding="0" cellspacing="0">

        <thead>
        <tr>
            <th style="width: 150px">اختر الصنف</th>
            <th>اختر نوع الفارغ</th>
            <th>وزن الفارغ</th>
            <th>الكمية</th>
            <th>الوزن بالجرام(جم)</th>
            <th>الوزن بالكيلو(كجم)</th>
            <th>سعر الشراء</th>
            <th>سعر البيع</th>
            <th>إجمالى س-الشراء</th>
            <th>إجمالى س-البيع</th>
            <th>الربح</th>
        </tr>
        </thead>
        <tbody>
        <tr>

            <td style="width: 200px">
                <select id="cat" class="form-control single-select" tabindex="2">
                    <option value="" disabled selected hidden>أدخل الصنف...</option>
                    <?php $sql1 = "SELECT * FROM categories";
                    $result1 = mysqli_query($conn, $sql1);
                    while ($rows1 = mysqli_fetch_array($result1)) {
                        $type = $rows1['type'];
                        echo '<option class="cat"   name="cat_name" 
                            value="' . $rows1['cat_price_dis'] . ',' . $rows1['type'] . ','
                            . $rows1['cat_price_def'] . ',' . $rows1['empty_weight'] . '' . $rows1['empty_type'] . '
                                ">' . $rows1['cat_name'] . '</option>';

                    }
                    ?>
                </select></td>
            <td style="width: 210px;">
                <select id="empty" class="form-control single-select" tabindex="3">
                    <option value="" disabled selected hidden>اختر نوع الفارغ</option>
                    <option value="0">بدون</option>
                    <option value=""></option>
                    <?php $sql2 = "SELECT * FROM weights";
                    $result2 = mysqli_query($conn, $sql2);
                    while ($rows2 = mysqli_fetch_array($result2)) { ?>

                        <option name="Empty" value="<?= $rows2['weight']; ?>"><?= $rows2['weight_name']; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </td>
            <td><input class="form-control" type="text" id="empty_value" tabindex="-1" name="empty_value" readonly></td>
            <td><label for="unit" id="unit-l">الوحدة:</label><input type="text" class="form-control form-control-sm "
                                                                    id="unit" tabindex="-1" value="" readonly><input
                        class="form-control" type="text" id="cat_weight" tabindex="4"></td>
            <td><input class="form-control" type="text" id="gm_weight" readonly tabindex="-1"></td>
            <td><input class="form-control" type="text" id="net_weight" tabindex="-1" readonly></td>
            <td><input class="form-control" type="text" id="cat_price_dis" tabindex="-1" readonly></td>
            <td><input class="form-control" type="text" id="cat_price_def" tabindex="-1" readonly></td>
            <td><input class="form-control" type="text" id="total_purchace" tabindex="-1" readonly></td>
            <td><input class="form-control" type="text" id="total_sale" tabindex="-1" readonly></td>
            <td><input class="form-control" type="text" id="profit" tabindex="-1" readonly></td>
        </tr>
        </tbody>
    </table>
    <input type="hidden" id="weight_code" value="" name="weight_type_code">
</form>
<div class="row">
    <div class="col-4 col-md-4"></div>
    <div class="col-2 col-md-3 col-sm-3 mt-3 text-center">
        <input type="button" class="form-control btn btn-primary" tabindex="5" value="اضافة الصنف الى الفاتورة"
               name="submit"
               id="submit">
    </div>
</div>


<?php
//if(isset($_POST['submit'])){
//    //$cat=$_POST['cat'];
//    //$empty=$_POST['empty'];
//    $empty_value=$_POST['empty_value'];
//    $sql="insert into bills(cat,empty,empty_value) values ('$cat','$empty','$empty_value')";
//    $result=mysqli_query($conn,$sql);
//    if ($result){
//        echo "success";
//    }
//}
?>
<div class="row mt-5">
    <div class="col-2 col-md-2"></div>
    <div class="col-12 col-md-12" style="overflow-y: scroll;overflow-x: hidden;height: 250px">
        <table class="table table-bordered table-striped overflow-auto table-sm" id="table1">
            <thead>
            <tr>
                <th>كود</th>
                <th>اسم الصنف</th>
                <th>نوع الفارغ</th>
                <th>وزن الفارغ</th>
                <th>الكمية/الوزن</th>
                <th>الوحدة</th>
                <th>الوزن بالجرام(جم)</th>
                <th>الوزن بالكيلو(كجم)</th>
                <th>سعر الشراء</th>
                <th>سعر البيع</th>
                <th>إجمالى س-الشراء</th>
                <th>إجمالى س-البيع</th>
                <th>الربح</th>
            </tr>
            </thead>
            <tbody style="">

            </tbody>
        </table>
    </div>
</div>

<div class="row">
    <div class="col-4 col-md-4"></div>
    <div class="col-2 col-md-2 mt-5">
        <input type="button" class="form-control btn btn-warning" value="من جديد" name="new" id="new">
    </div>
    <div class="col-2 col-md-2 mt-5">
        <input type="button" class="form-control btn btn-success" tabindex="5" value="حفظ الفاتورة" name="send"
               id="send">
    </div>
</div>

<?php include 'footer.php' ?>
<?php include 'script.php' ?>

