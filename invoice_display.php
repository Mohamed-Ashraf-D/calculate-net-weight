<?php
include 'db.php';
$pageTitle='عرض الفواتير';
?>

   <?php include 'header.php'?>
    <form class="form-inline mt-5" method="post" action="invoice_display.php" style="direction: rtl;">
        <div class="form-group">
            <label for="startDate" class="mr-5">من </label>
            <input id="startDate" class="form-control mr-1" type="date" name="startDate">
            <label for="endDate" class="mr-5">الى </label>
            <input id="endDate"  class="form-control mr-1" type="date" name="endDate">
            <label for="inv_no" class="mr-5">رقم الفاتورة </label>
            <input id="inv_no"  class="form-control mr-1" type="number" name="inv_no">
        </div>
        <div class="text-center mr-5 " style="width: 250px">
            <select id="client_sel_dis" class="form-control"   tabindex="1" style="height: 100px;width: 250px">
                <option value="">اختر اسم العميل</option>
                <?php $sql2 = "SELECT * FROM clients";
                $result2 = mysqli_query($conn, $sql2);
                while ($rows2 = mysqli_fetch_array($result2)) { ?>

                    <option name="client_sel" value="<?= $rows2['ClientCode']; ?>"><?= $rows2['ClientName']; ?></option>
                    <?php
                }
                ?>
            </select>
            <input type="hidden" name="client_code_dis" id="client_code_dis">
        </div>
        <button type="submit" name="submit" id="submit" class="form-control btn btn-success mr-5" value="">تصفية<span class="fa fa-filter"></span></button>
        <button type="submit" name="disp_separate" id="dis_separate" class="form-control btn btn-primary mr-2  " value="">عرض منفصل</button>
        <input type="submit" name="displayAll" id="displayAll" class="form-control btn btn-warning mr-2 " value="عرض الكل">
        <a tabindex="-1" href="NewInvoice.php"><input type="button" name="newInvoice" id="newinvoice" class="form-control btn btn-info mr-2" value="فاتورة جديدة"></a>
    </form>
<div id="dis-print">
<div>
    <img  src="img/zak-logo.png" id="logo2">


    <h2 id="title-dis">فواتير بيع اجماليه</h2>
</div>

<table class="table table-bordered table-striped mt-5 rtl table-sm" style="direction: rtl;" id="table5" border="1" cellspacing="0" cellpadding="4">
    <thead>
    <tr>
        <th>رقم الفاتورة</th>
        <th>تاريخ الفاتورة</th>
        <th>إجمالى س-الشراء</th>
        <th>إجمالى س-البيع</th>
        <th>الربح</th>
        <th>اسم العميل</th>
        <th>عرض الفاتورة</th>
        <th>تعديل الفاتورة</th>
        <th>حذف الفاتورة</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if (isset($_POST['submit'])){

      $startDate=$_POST['startDate'];
      $endDate=$_POST['endDate'];
      $inv_no=$_POST['inv_no'];
      $client_code=$_POST['client_code_dis'];





    $query="SELECT * FROM total WHERE ((date between '$startDate' and '$endDate') AND (ClientCode='$client_code'))OR (invoice_no='$inv_no')";

    $result=mysqli_query($conn,$query);
    if($result){
    while ($rows=mysqli_fetch_assoc($result)) {
        ?>
        <tr class="record">
            <td><?= $rows['invoice_no'] ?></td>
            <td><?= $rows['date'] ?></td>
            <td id="sum_t"><?= $rows['sum_purchase'] ?></td>
            <td id="sum_s"><?= $rows['sum_sale'] ?></td>
            <td id="sum_p"><?= $rows['net_profit'] ?></td>
            <td id="client_name_dis"><?= $rows['ClientName'] ?></td>
            <td><a type="button" href="invoice_details.php?id=<?= $rows['invoice_no'] ?>&&client_name_dis=<?=$rows['ClientName']?>"
                   class="btn btn-info viewButton btn-sm"> <i class="far fa-sm fa-eye"></i></a></td>
            <td><a type="button" href="update.php?id=<?= $rows['invoice_no'] ?>&client_code=<?= $rows['ClientCode'] ?>&date=<?=$rows['date']?>"
                   class="btn btn-sm btn-primary editButton"> <i class="fas fa-edit"></i></a></td>
            <td>
                <button class="btn btn-sm btn-danger delButton" id="<?= $rows['invoice_no'] ?>"><i
                            class="fas fa-sm fa-trash"></i></button>
            </td>

        </tr>
        <?php
    }}}
    elseif (isset($_POST['displayAll'])){
    $query2="SELECT * FROM total";
    $result2=mysqli_query($conn,$query2);
    while ($rows2=mysqli_fetch_assoc($result2)){
    ?>
    <tr class="record">
        <td><?=$rows2['invoice_no']?></td>
        <td><?=$rows2['date']?></td>
        <td id="sum_t"><?=$rows2['sum_purchase']?></td>
        <td id="sum_s"><?=$rows2['sum_sale']?></td>
        <td id="sum_p"><?=$rows2['net_profit']?></td>
        <td id="client_name_dis"><?=$rows2['ClientName']?></td>
        <td><a type="button" href="invoice_details.php?id=<?=$rows2['invoice_no']?>&&client_name_dis=<?=$rows2['ClientName']?>" class="btn btn-sm btn-info viewButton" > <i class="far fa-sm fa-eye"></i></a></td>
        <td><a type="button" href="update.php?id=<?=$rows2['invoice_no']?>&client_code=<?=$rows2['ClientCode']?>&date=<?=$rows2['date']?>" class="btn btn-sm btn-primary editButton" > <i class="fas fa-sm fa-edit"></i></a></td>
        <td><button class="btn btn-sm btn-danger delButton"  id="<?=$rows2['invoice_no']?>"> <i class="fas fa-sm fa-trash"></i></button></td>

    </tr>
    <?php }}
    elseif (isset($_POST['disp_separate'])){
        $startDate=$_POST['startDate'];
        $endDate=$_POST['endDate'];
        $inv_no=$_POST['inv_no'];
        $client_code=$_POST['client_code_dis'];
        $query3 = "SELECT * FROM total WHERE (date between '$startDate' and '$endDate') OR (ClientCode='$client_code') OR (invoice_no='$inv_no')";
        $result3 = mysqli_query($conn, $query3);
        while ($rows3 = mysqli_fetch_assoc($result3)){?>

            <tr class="record">
                <td><?=$rows3['invoice_no']?></td>
                <td><?=$rows3['date']?></td>
                <td id="sum_t"><?=$rows3['sum_purchase']?></td>
                <td id="sum_s"><?=$rows3['sum_sale']?></td>
                <td id="sum_p"><?=$rows3['net_profit']?></td>
                <td id="client_name_dis"><?=$rows3['ClientName']?></td>
                <td><a type="button" href="invoice_details.php?id=<?=$rows3['invoice_no']?>&&client_name_dis=<?=$rows3['ClientName']?>" class="btn btn-sm btn-info viewButton" > <i class="far fa-sm fa-eye"></i></a></td>
                <td><a type="button" href="update.php?id=<?=$rows3['invoice_no']?>&client_code=<?=$rows3['ClientCode']?>&date=<?=$rows3['date']?>" class="btn btn-sm btn-primary editButton" > <i class="fas fa-sm fa-edit"></i></a></td>
                <td><button class="btn btn-sm btn-danger delButton"  id="<?=$rows3['invoice_no']?>"> <i class="fas fa-sm fa-trash"></i></button></td>

            </tr>



            <?php
        }
    }
    ?>

    </tbody>
</table>
    <div style="margin-top: 20px">
        <span id="purchase_pr"><b> مجموع سعر الشراء: </b> <b style="color: red" id="sumtion_p"></b></span>
        <span id="sale_pr"><b> مجموع سعر البيع: </b> <b style="color: red" id="sumtion_s"></b></span>
        <span id="profit_pr"><b> الربح من اجمالى الفواتير : </b> <b style="color: red" id="net_profit"></b></span>
    </div>
</div>
    <div class="text-center mt-5">
        طباعة الفواتير
        <button class="btn btn-primary" id="pr_inv"><span class="fas fa-print fa-2x"></span></button>
    </div>

</div>
<?php
if (isset($_POST['id'])) {
    $inv_no = $_POST['id'];

    $sql1 = "DELETE  total ,invoice from total join invoice where total.invoice_no ='" . $inv_no . "' and invoice.invoice_no='" . $inv_no . "';";
    $result1 = mysqli_query($conn, $sql1);
    if (!$result1){
        echo "not deleted";
    }
    else{
        echo "deleted";
        header("Location:invoice_display.php");

    }
}
?>

<?php include 'footer.php'?>
<script>
    //pass value of client_code to input hidden
    var client_sel_dis=$('#client_sel_dis');
    client_sel_dis.change(function () {
       var client_code_dis=$('#client_code_dis');
       client_code_dis.val(client_sel_dis.val());
    });
    $(document).ready(function () {
        $('select').select2();
    });
    $(function() {

        $(".delButton").click(function() {
            var del_id = $(this).attr("id");
            var info = 'id='+ del_id;
            if (confirm("متأكد من أنك تريد فعلا حذف هذه الفاتورة لايمكن التراجع بعد عملية الحذف.")) {
                $.ajax({
                    type : "POST",
                    url : "invoice_display.php",
                    data : info,
                    success : function() {
                        location.reload();
                    }
                });
                $(this).parents(".record").animate("fast").animate({
                    opacity : "hide"
                }, "slow");
            }

            return false;
        });
    });
//calculate table total
    function calculateTableTotal(id1,id2) {
        var total = 0;

        $('#table5 tbody tr td[id='+id1+']').each(function () {

            // find the amount input field
            var $input = $(this);
            total +=parseFloat($input.html());
        });

        $(id2).html(Math.round(+total*1000)/1000);

    }


    $(document).ready(function () {
        calculateTableTotal('sum_t','#sumtion_p');
        calculateTableTotal('sum_p','#net_profit');
        calculateTableTotal('sum_s','#sumtion_s');
    });

    function printData()
    {
        var divToPrint=document.getElementById("dis-print");
        newWin= window.open("");
        newWin.document.write("<style> #table5 tbody tr td:nth-last-child(-n+3){display:none !important;} </style>");
        newWin.document.write("<style> #table5 thead tr th:nth-last-child(-n+3){display:none !important;} </style>");
        newWin.document.write('<style>@media print {\n' +
            '#table5{'+
            'margin-top: 70px;'+
            'width: 100%;'+
            'border: 1px solid grey'+
            '}' +
            '#sumtion_p{'+
            'margin-left: 150px' +
            '' +
            '}'+
            '#sumtion_s{'+
            'margin-left: 100px' +
            '' +
            '}'+
            '#net_profit{'+
            'margin-left: 50px' +
            '}'+
            '#table5 thead{'+
            'background-color:lightgray!important;'+
            ' -webkit-print-color-adjust: exact;'+

            '}'+
                '#table5 tbody tr:nth-child(even){'+
                'background-color: #f2f2f2!important;'+
                ' -webkit-print-color-adjust: exact;'+
                '}'+
            '#logo2 {' +
            '        float: right;' +
            '        margin-right: 10px;' +
            '        margin-bottom: 10px;' +
            '        width: 150px;' +
            '        height: 120px;' +
            '    }' +
            '    #title-dis{' +
            '        position: absolute;' +
            '        top: 40px;' +
            '        right: 350px;' +
            '' +
            '    }' +
            '}' +
            '</style>');
        newWin.document.write(divToPrint.outerHTML);
        newWin.print();
        newWin.close();
    }
    $('#pr_inv').click(function () {
        printData();
    })
</script>
