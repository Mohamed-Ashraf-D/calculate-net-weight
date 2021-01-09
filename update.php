<?php
include "db.php";
$pageTitle='تعديل الفاتورة';
$id = $_GET['id'];
$date = date('Y-m-d',strtotime($_GET['date']));
$unit_1 = 'كيلو جرام';
$unit_2 = 'قطعة';
$unit_3 = 'جالون';
$unit_4 = 'سنتيمتر';
?>


<?php include 'header.php' ?>

<div class="row mt-3 mr-3">
    <div class="col-2 col-md-2 mt-4  col-sm-2 text-center ">
        <label class="hide" for="client_sel">.</label>
        <select id="client_sel" class="form-control" tabindex="1" style="height: 100px;">
            <option value="">اختر اسم العميل</option>
            <?php $sql2 = "SELECT * FROM clients";
            $result2 = mysqli_query($conn, $sql2);
            while ($rows2 = mysqli_fetch_array($result2)) { ?>

                <option name="client_sel" value="<?= $rows2['ClientCode']; ?>"><?= $rows2['ClientName']; ?></option>
                <?php
            }
            ?>
        </select>
    </div>
    <div class="col-2 col-md-2 mt-4 col-sm-2 text-center ">

        <label class="" for="invoice_no">رقم الفاتورة</label>

        <input class="form-control" type="text" value="<?= $id ?>" id="invoice_no" readonly>
    </div>
    <div class="col-2 col-md-2 mt-4 text-center">
        <label class="" for="date">التاريخ</label>

        <input class="form-control" value="<?=$date?>" type="date" id="date">
    </div>
    <div class="col-2 mt-4 col-md-2 text-center">
        <label class="" for="sum_purchase"> مجموع س-الشراء</label>

        <input class="form-control" type="text" id="sum_purchase" readonly>
    </div>
    <div class="col-2 mt-4 col-md-2 text-center">
        <label class="" for="sum_sale"> مجموع س-البيع</label>

        <input class="form-control" type="text" id="sum_sale" readonly>
    </div>

    <div class="col-2 mt-4 col-md-2 text-center">
        <label class="" for="net_profit">الربح الكلى</label>

        <input class="form-control" type="text" id="net_profit" readonly>
    </div>
</div>

<div class="row mt-5">

</div>
<form id="frm" action="update.php" method="post">
    <table class="table-sm table  text-center" cellpadding="0" cellspacing="0" id="table3">

        <thead>
        <tr>
            <th>اختر الصنف</th>
            <th>اختر نوع الفارغ</th>
            <th>وزن الفارغ</th>
            <th>الكمية</th>
            <th>الوزن بالجرام(جم)</th>
            <th>الوزن بالكيلو(كجم)</th>
            <th> س-الشراء</th>
            <th>سعر البيع</th>
            <th>إجمالى س-الشراء</th>
            <th>إجمالى س-البيع</th>
            <th>الربح</th>
        </tr>
        </thead>
        <tbody>

        <tr>

            <td style="width: 180px"><select id="cat" class="form-control">


                    <option value=",">أدخل الصنف...</option>


                    <?php $sql1 = "SELECT * FROM categories";
                    $result1 = mysqli_query($conn, $sql1);
                    while ($rows1 = mysqli_fetch_array($result1)) {
                        $type = $rows1['type'];
                        echo '<option class="cat" name="cat_name" value="' . $rows1['cat_price_dis'] . ',' . $rows1['type'] . ',' . $rows1['cat_price_def'] . '"><a href="NewInvoice.php?cat_name=' . $rows1['type'] . '">' . $rows1['cat_name'] . '</a></option>';

                    }
                    ?>
                </select></td>
            <td style="width: 150px;"><select id="empty" class="form-control">
                    <option value="">نوع الفارغ...</option>
                    <option value="0">بدون</option>
                    <option value=""></option>
                    <?php $sql2 = "SELECT * FROM weights";
                    $result2 = mysqli_query($conn, $sql2);
                    while ($rows2 = mysqli_fetch_array($result2)) {

                        echo '<option class=""  name="empty" value="' . $rows2['weight'] . '">' . $rows2['weight_name'] . '</option>';
                    }
                    ?>


                </select></td>
            <td><input class="form-control" type="text" id="empty_value" name="empty_value" readonly value=""></td>
            <td><label for="unit" id="unit-l">الوحدة:</label>
                <input type="text" class="form-control form-control-sm " id="unit" tabindex="-1" value="" readonly>
                <input class="form-control" type="text" id="cat_weight" name="cat_weight" value=""></td>
            <td><input class="form-control" type="text" id="gm_weight" name="gm_weight" readonly value=""></td>
            <td><input class="form-control" type="text" id="net_weight" readonly value=""></td>
            <td><input class="form-control" type="text" id="cat_price_dis" readonly></td>
            <td><input class="form-control" type="text" id="cat_price_def" readonly></td>
            <td><input class="form-control" type="text" id="total_purchace" readonly></td>
            <td><input class="form-control" type="text" id="total_sale" readonly></td>
            <td><input class="form-control" type="text" id="profit" readonly></td>

        </tr>
        </tbody>
    </table>

</form>
<div class="row">
    <div class="col-4 col-md-4"></div>
    <div class="col-2 col-md-3 col-sm-3 mt-3">
        <form action="update.php" method="post">
            <input type="button" class="form-control btn btn-primary" value="اضافة البيانات الى الجدول" name="submit"
                   id="submit">
        </form>
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
    <div class="col-12 col-md-12" style="overflow-y: scroll;overflow-x: hidden;height: 400px">
        <form class="" action="update.php" method="POST">
            <table class="table table-bordered table-striped overflow-auto table-sm" id="table1">
                <thead>
                <tr>

                    <th class="">رقم</th>
                    <th>اسم الصنف</th>
                    <th>نوع الفارغ</th>
                    <th>وزن الفارغ</th>
                    <th>الكمية/الوزن</th>
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
                <?php
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $sql = "SELECT * FROM invoice where invoice_no='$id'";
                    $result = mysqli_query($conn, $sql);
                    while ($rows = mysqli_fetch_assoc($result)) {
                        echo "<tr class='record'>           
                               <td class='no'></td>
                               <td class='cat_name'>$rows[cat_name]</td>
                               <td class='empty'>$rows[empty_name]</td>
                               <td class='empty_value'>$rows[empty_value]</td>
                               <td class='cat_weight'>$rows[cat_weight]</td>
                               <td class='gm_weight'>$rows[gm_weight]</td>
                               <td class='net_weight'>$rows[net_weight]</td>
                               <td class='cat_price_dis'>$rows[cat_price_dis]</td>
                               <td class='cat_price_def'>$rows[cat_price_def]</td>
                               <td id='sum_t' class='total_p sum_t'>$rows[total_purchase]</td>
                               <td id='sum_s' class='total_s sum_s'>$rows[total_sale]</td>
                               <td id='sum_p' class='profit sum_p'>$rows[profit]</td>
                              </tr>";
                    }
                }
                ?>
                </tbody>
            </table>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-5 col-md-5 mt-5">
    </div>
    <div class="col-2 col-md-2 mt-1">
        <input type="button" class="form-control btn btn-success" value="حفظ التعديلات" name="send" id="update">
    </div>
</div>


<script src="fonts/all.min.js"></script>
<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/popper.js"></script>
<script src="js/select2.min.js"></script>
<script src="js/swwetalert.js"></script>
<script src="js/jquery.tabledit.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</div>
<!--if click edit remove atrribute read only-->

<?php
if (isset($_POST['del_btn'])) {
    $del_id = $_POST['del_btn'];
    $sql3 = "DELETE FROM invoice where id='$del_id'";
    $result3 = mysqli_query($conn, $sql3);
    if ($result3) {
        echo "success deleted";
    } else {
        echo "not deleted";
    }
}
//الحصول على اسم العميل عندما دخول صفحة ال update
if ($_GET['client_code']) {
    $client_code = $_GET['client_code'];
}

?>

<script>


    $(document).ready(function () {
        var option_cli = "<?=$client_code?>";
        var option_sel = $('#client_sel');
        option_sel.val(option_cli).trigger('change');
    });

    //calculate sum_purchase column of table
    function calculateTableTotal() {
        var total = 0;

        $('#table1 tbody tr td[id=sum_t]').each(function () {

            // find the amount input field
            var $input2 = $(this);
            total += parseFloat($input2.text());
        });

        $("#sum_purchase").val(Math.round(+total*1000)/1000);

    }

    //calculate sum_sale column of table

    function calculateTableTotal2() {
        var total = 0;

        $('#table1 tbody tr td[id=sum_s]').each(function () {

            // find the amount input field
            var $input = $(this);
            total += parseFloat($input.text());
        });

        $("#sum_sale").val(Math.round(+total*1000)/1000);

    }

    //calculate profit column of table

    function calculateTableProfit() {
        var net_profit = 0;

        $('#table1 tbody tr td[id=sum_p]').each(function () {

            // find the amount input field
            var $input2 = $(this);
            net_profit += parseFloat($input2.text());
        });

        $("#net_profit").val(Math.round(+net_profit*1000)/1000);

    }

    $(document).ready(function (e) {

        $('#table1').Tabledit({

            url: 'edit.php',
            deleteButton: false,
            restoreButton: false,
            buttons: {
                edit: {
                    class: 'btn btn-sm btn-primary',
                    html: '<span class="fa fa-edit"></span> &nbsp تعديل',
                },
                save: {
                    class: 'btn btn-sm btn-success',
                    html: '<span class="fa fa-save"></span> &nbsp  حفظ',
                    id: 'update',
                    name: 'send'
                }
            },

            columns: {
                identifier: [0, 'id'],
                editable: [[1, 'cat_name'], [2, 'empty_name'], [3, 'empty_value'], [4, 'cat_weight'], [5, 'gm_weight'], [6, 'net_weight'], [7, 'cat_price_dis'], [8, 'cat_price_def'], [9, 'total_p'], [10, 'total_s'], [11, 'profit']]
            },
            onSuccess: function (result) {
                if (result.status == 'success') {
                    calculateTableTotal();
                    calculateTableTotal2();
                    calculateTableProfit();
                } else {
                    calculateTableTotal();
                    calculateTableTotal2();
                    calculateTableProfit();

                }
            },
            success: function () {
                calculateTableTotal();
                calculateTableTotal2();
                calculateTableProfit();
            }


        });

    });
</script>
<script>
    $(function () {

        $(".del_btn").click(function () {
            var del_id = $(this).attr("id");
            var info = 'del_btn=' + del_id;
            if (confirm("متأكد من أنك تريد فعلا حذف هذا الصنف لايمكن التراجع بعد عملية الحذف.")) {
                $.ajax({
                    type: "POST",
                    url: "update.php", //URL to the delete php script
                    data: info,
                    success: function () {
                        calculateTableTotal();
                        calculateTableTotal2();
                        calculateTableProfit();
                        location.reload();
                    }
                });
                $(this).parents(".record").animate("fast").animate({
                    opacity: "hide"
                }, "slow");
            }

            return false;
        });
    });


    function rearrange() {

        var count = $('#table1 tbody tr').length;
        var td = $('#table1 tbody tr td:first-child');
        for (var i = 0; i < count; i++) {
            td[i].innerHTML = i + 1;
        }
    }

    $(document).ready(function () {
        rearrange();

        calculateTableTotal();
        calculateTableTotal2();
        calculateTableProfit();

    });


    //to edit table

    //to display value of selected option in input
    // $('#cat').chosen();
    $(document).ready(function () {
        $('select').select2();
    });
    $('#empty').change(function () {
        var displayvalue1 = $('#empty option:selected').val();
        $('#empty_value').val(displayvalue1);
        calctotal2();
    });
</script>
<script>
    var cat = $('#cat');
    var cat_weight = $('#cat_weight');
    var net_weight = $('#net_weight');
    var empty_value = $('#empty_value');
    var total = $('#total');
    var gm_weight = $('#gm_weight');
    var cat_price_dis = $('#cat_price_dis');
    var cat_price_def = $('#cat_price_def');
    var total_p = $('#total_purchace');
    var total_s = $('#total_sale');
    var enter_save = $('#submit');
    var profit = $('#profit');
    var unit = $('#unit');


    cat.change(function () {
        var selected_option = $('#cat option:selected');
        var displaytype = selected_option.val();
        var typeval1 = displaytype.split(",");
        cat_price_dis.val(typeval1[0]);
        cat_price_def.val(typeval1[2]);
        if (typeval1[1] === '0' || typeval1[1] === '2' || typeval1[1] === '3') {
            if (typeval1[1] === '0') {
                unit.val('<?=$unit_2?>');
            }
            else if (typeval1[1] === '2') {
                unit.val('<?=$unit_3?>')
            } else if (typeval1[1] === '3') {
                unit.val('<?=$unit_4?>');
            }
            var option2 = $('#empty option:eq(1)').val();
            $('#empty').val(option2).trigger('change');

            cat.focus();
            cat_weight.val('');
            total_p.val('');
            total_s.val('');
            total.val('');
            cat_weight.keyup(function () {
                cat_weight.focus();
                gm_weight.val('');
                net_weight.val('');
                total_p.val(cat_price_dis.val() * cat_weight.val());
                total_s.val(cat_price_def.val() * cat_weight.val());
                profit.val(total_s.val() - total_p.val());
            });


        }
        else if (typeval1[1] === '1') {
            var option2 = $('#empty option:eq(0)').val();
            $('#empty').val(option2).trigger('change');
            unit.val('<?=$unit_1?>');
            $('#cat_price_dis').val(typeval1[0]);
            $('#cat_price_def').val(typeval1[2]);
            cat_weight.val('');
            total_p.val('');
            total_s.val('');
            gm_weight.val('');
            net_weight.val('');
            cat_weight.keyup(function () {
                calctotal2();
            });


            enter_save.click(function () {


            });
        }
        else if (typeval1[1] === '2') {
            unit.val('<?=$unit_3?>');
        } else if (typeval1[1] === '3') {
            unit.val('<?=$unit_4?>');
        }
    });
    //apppppppppppppppppppppend
    enter_save.click(function () {
        var selected_option = $('#cat option:selected');
        var displaytype = selected_option.val();
        var typeval1 = displaytype.split(",");
        if (typeval1[1] === '0' || typeval1[1] === '2' || typeval1[1] === '3') {
            if (cat.val() !== '' && cat_weight.val() !== '' && cat_price_dis.val() !== '' && total_p.val() !== '0' && total_s.val() !== '0') {
                var count = $('#table1 tbody tr').length;
                $('#table1 tbody').append('<tr>' +
                    '<td  class="no">' + (count + 1) + '</td>' +
                    '<td  class="cat_name">' + $('#cat option:selected').text() + '</td>' +
                    '<td  class="empty">' + $("#empty option:selected").text() + '</td>' +
                    '<td  class="empty_value">' + $('#empty_value').val() + '</td>' +
                    '<td  class="cat_weight">' + $('#cat_weight').val() + '</td>' +
                    '<td  class="gm_weight">' + $('#gm_weight').val() + '</td>' +
                    '<td  class="net_weight">' + $('#net_weight').val() + '</td>' +
                    '<td  class="cat_price_dis">' + $('#cat_price_dis').val() + '</td>' +
                    '<td  class="cat_price_def">' + $('#cat_price_def').val() + '</td>' +
                    '<td  id="sum_t" class="total_p">' + $('#total_purchace').val() + '</td>' +
                    '<td  id="sum_s" class="total_s">' + $('#total_sale').val() + '</td>' +
                    '<td  id="sum_p" class="profit">' + $('#profit').val() + '</td>' +
                    '<td  id="del" class="text-center p-0" ><button class="btn btn-sm btn-danger"><span type="button" style="cursor: pointer;:hover{background-color: red;}" class="fa fa-times-circle text-white" ></span>&nbsp;&nbsp; حذف</button></td>' +

                    '</tr>');

                $('#frm')[0].reset();
                calculateTableTotal();
                calculateTableTotal2();
                calculateTableProfit();
                //reset select to the first option
                var option1 = $('#cat option:eq(0)').val();
                var option2 = $('#empty option:eq(0)').val();
                $('#cat').val(option1).trigger('change');
                $('#empty').val(option2).trigger('change');
                $('#cat').focus();
            }
        } else if (typeval1[1] === '1') {
            if (cat.val() !== '' && empty.val() !== '' && cat_weight.val() !== '' && cat_price_dis.val() !== '') {
                if (parseFloat(empty_value.val()) < parseFloat(cat_weight.val()) && total_p.val() !== '0' && total_s.val() !== '0') {
                    var count = $('#table1 tbody tr').length;
                    $('#table1 tbody').append('<tr>' +
                        '<td  class="no">' + (count + 1) + '</td>' +
                        '<td  class="cat_name">' + $('#cat option:selected').text() + '</td>' +
                        '<td  class="empty">' + $("#empty option:selected").text() + '</td>' +
                        '<td  class="empty_value">' + $('#empty_value').val() + '</td>' +
                        '<td  class="cat_weight">' + $('#cat_weight').val() + '</td>' +
                        '<td  class="gm_weight">' + $('#gm_weight').val() + '</td>' +
                        '<td  class="net_weight">' + $('#net_weight').val() + '</td>' +
                        '<td  class="cat_price_dis">' + $('#cat_price_dis').val() + '</td>' +
                        '<td  class="cat_price_def">' + $('#cat_price_def').val() + '</td>' +
                        '<td  id="sum_t" class="total_p">' + $('#total_purchace').val() + '</td>' +
                        '<td  id="sum_s" class="total_s">' + $('#total_sale').val() + '</td>' +
                        '<td  id="sum_p" class="profit">' + $('#profit').val() + '</td>' +
                        '<td  id="del" class="text-center p-0" ><button class="btn btn-sm btn-danger"><span type="button" style="cursor: pointer;:hover{background-color: red;}" class="fa fa-times-circle text-white" ></span>&nbsp;&nbsp; حذف</button></td>' +

                        '</tr>');
                    $('#frm')[0].reset();
                    calculateTableTotal();
                    calculateTableTotal2();
                    calculateTableProfit();
                    //reset select to the first option
                    var option1 = $('#cat option:eq(0)').val();
                    var option2 = $('#empty option:eq(0)').val();
                    $('#cat').val(option1).trigger('change');
                    $('#empty').val(option2).trigger('change');
                    $('#cat').focus();
                }
                else {
                    swal({title: "يجب ان يكون الوزن الكلى أكبر من وزن الفارغ"}, function () {
                        cat_weight.focus();
                    });
                }
            } else {
                swal('ادخل البيانات أولا');
            }
        } else {
            swal("أدخل البيانات أولا");
        }


    });
</script>

<script>
    var cat = $('#cat');
    var cat_weight = $('#cat_weight');
    var net_weight = $('#net_weight');
    var empty_value = $('#empty_value');
    var total = $('#total');
    var gm_weight = $('#gm_weight');
    var cat_price_dis = $('#cat_price_dis');
    var enter_save = $('#submit');


    function calctotal2() {

        if (cat_weight.val() !== '' && (empty_value.val()).length !== 0) {
            gm_weight.val((Math.abs(cat_weight.val() - empty_value.val())));
            net_weight.val((Math.abs(cat_weight.val() - empty_value.val())) / 1000);
            var total_purchase = cat_price_dis.val() * net_weight.val();
            total_p.val(Math.round(total_purchase * 1000) / 1000);
            var total_sale = cat_price_def.val() * net_weight.val();
            total_s.val(Math.round(total_sale * 1000) / 1000);
            var profit1 = (cat_price_def.val() - cat_price_dis.val()) * net_weight.val();
            profit.val(Math.round(profit1 * 10000) / 10000);
        }
        else {
            gm_weight.val('');
            net_weight.val('1');
            var total_purchase = cat_price_dis.val() * net_weight.val();
            total_p.val(Math.round(total_purchase * 1000) / 1000);
            var total_sale = cat_price_def.val() * net_weight.val();
            total_s.val(Math.round(total_sale * 1000) / 1000);
            var profit1 = (cat_price_def.val() - cat_price_dis.val()) * net_weight.val();
            profit.val(Math.round(profit1 * 10000) / 10000);
        }
    }


</script>
<script>
    //variabels
    var cat_weight = $('#cat_weight');
    var cat = $('#cat');
    var empty = $('#empty');
    var enter_save = $('#submit');
    var displayvalue3 = $('#cat option:selected').text();
    $('#cat_weight').keyup(function (e) {
        if (e.keyCode === 13) {
            enter_save.click();
            $('span [aria-labelledby=select2-cat-container]').focus();
        }
    });

    //delete one row of table
    $('#table1').on('click', '#del', function () {
        $(this).closest('tr').remove();
        renumberrows();
        rearrange();
        calculateTableTotal();
        calculateTableTotal2();
        calculateTableProfit();
    });

    //rearrange row number
    function renumberrows() {
        var rowCount = $('#table1 tbody tr');
        for (var n = 0; n < rowCount.length; n++) {
            var firstCol = rowCount[n].firstChild;
            firstCol.innerText = n + 1;

        }
    }

    //delete all data


</script>
<script>
    //push data in the array with each loop function, loop in each column in the table
    // and send data with ajax in object format (key=>value) to php page (insert.php)
    $('#update').click(function (e) {
        e.preventDefault();
        var no = [];
        var lastno = $('#invoice_no').val();
        var date = $('#date').val();
        var sum_purchase = $('#sum_purchase').val();
        var sum_sale = $('#sum_sale').val();
        var client_sel = $('#client_sel');
        var client_code = client_sel.val();
        var client_name = $('#client_sel option:selected').text();
        var cat_name = [];
        var empty = [];
        var empty_value = [];
        var cat_weight = [];
        var gm_weight = [];
        var net_weight = [];
        var cat_price_dis = [];
        var total_p = [];
        var total_s = [];
        var cat_price_def = [];
        var profit = [];
        var net_profit = $('#net_profit').val();
        $(".no").each(function () {
            no.push($(this).text());
        });
        $(".cat_name").each(function () {
            cat_name.push($(this).text());
        });
        $(".empty").each(function () {
            empty.push($(this).text());
        });
        $(".empty_value").each(function () {
            empty_value.push($(this).text());
        });
        $(".cat_weight").each(function () {
            cat_weight.push($(this).text());
        });
        $(".gm_weight").each(function () {
            gm_weight.push($(this).text());
        });


        $(".net_weight").each(function () {
            net_weight.push($(this).text());
        });
        $(".cat_price_dis").each(function () {
            cat_price_dis.push($(this).text());
        });
        $(".total_p").each(function () {
            total_p.push($(this).text());
        });
        $(".total_s").each(function () {
            total_s.push($(this).text());
        });
        $(".cat_price_def").each(function () {
            cat_price_def.push($(this).text());
        });
        $(".profit").each(function () {
            profit.push($(this).text());
        });
        var id = $('#invoice_no').val();

        var count = $('#table1 tbody tr').length;
        if (count !== 0) {
            swal({
                    title: 'حفظ البيانات فى قاعدة البيانات' + date,
                    text: '',
                    type: '',
                    showLoaderOnConfirm: true,
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    closeOnConfirm: false
                },
                function () {
                    $.ajax({
                        data: {
                            count: count,
                            id: id,
                            no: no,
                            lastno: lastno,
                            client_name: client_name,
                            client_code: client_code,
                            date: date,
                            sum_purchase: sum_purchase,
                            sum_sale: sum_sale,
                            cat_name: cat_name,
                            empty: empty,
                            empty_value: empty_value,
                            cat_weight: cat_weight,
                            gm_weight: gm_weight,
                            net_weight: net_weight,
                            cat_price_dis: cat_price_dis,
                            total_p: total_p,
                            total_s: total_s,
                            cat_price_def: cat_price_def,
                            profit: profit,
                            net_profit: net_profit
                        },
                        method: "POST",
                        url: "update_invoice.php",


                        success: function (result) {
                            if (result.status == 'success') {
                                swal('successful saved', '', 'success')
                                location.reload();
                            } else {
                                swal('تم الحفظ بنجاح', '', 'success');
                                location.reload();
                            }
                        }
                    });

                });

        }
        else {
            swal("يجب ادخال صنف واحد على الاقل اثناء التعديل");
        }


    });

    $(document).ready(function () {
        $("#cat_weight").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190, 188]) !== -1 ||
                // Allow: Ctrl+A, Command+A
                (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                // Allow: home, end, left, right, down, up
                (e.keyCode >= 35 && e.keyCode <= 40)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    });
    //set focus to select client if click enter when you were in date
    //-------------------------------------------------
    $('#date').keyup(function (e) {
        if(e.keyCode===13){
            $('span [aria-labelledby=select2-client_sel-container').focus();

        }

    });
    $(document).ready(function () {
        if($('span [aria-labelledby=select2-client_sel-container').keyup(function (e) {
            if(e.keyCode===13){
                $('span [aria-labelledby=select2-cat-container]').focus();

            }
        }));
        if($("span [aria-labelledby=select2-cat-container]").keyup(function (e) {
            if(e.keyCode===13){
                $('span [aria-labelledby=select2-empty-container]').focus();
            }
        }));
        if($("span [aria-labelledby=select2-empty-container]").keyup(function (e) {
            if(e.keyCode===13){
                $('#cat_weight').focus();
            }
        }));

    });
$(document).ready(function () {
    $('#date').focus();
});


    //--------------------------------------------------------
</script>

</body>
</html>