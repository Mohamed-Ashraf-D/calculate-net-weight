<?php
include "db.php";
$pageTitle='تفاصيل الفاتورة';
if(isset($_GET['id'])){
$id=$_GET['id'];
$client_name_det=$_GET['client_name_dis'];
$sql2="SELECT * FROM total where invoice_no='".$id."'";
$result2=mysqli_query($conn,$sql2);
$rows2=mysqli_fetch_assoc($result2);


}
?>

<?php include'header.php' ?>
    <div id="printing">
        <div>
            <img  src="img/zak-logo.png" id="logo2">

            <p id="client_name_pr"><b> اسم العميل: </b> <?=$client_name_det?> </p>
            <p id="invoice_no_pr"><b> رقم الفاتورة: </b> <?=$_GET['id'];?> </p>
            <p id="date_pr"><b> التاريخ: </b> <?=$rows2['date']?> </p>
            <h2 id="title-pr">فاتورة بيع</h2>
        </div>
    <table style="direction: rtl;" class="table table-sm table-striped table-bordered" id="printTable" border="1" cellspacing="0" cellpadding="0">
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
        <tbody>
<?php
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $sql1="SELECT * FROM invoice where invoice_no='".$id."'";
    $sql2="SELECT * FROM total where invoice_no='".$id."'";
    $result1=mysqli_query($conn,$sql1);
    $result2=mysqli_query($conn,$sql2);
    $rows2=mysqli_fetch_assoc($result2);
    while ($rows=mysqli_fetch_assoc($result1)){

        echo '<tr>
                 <td colspan="1">'.$rows['no'].'</td>
                 <td colspan="1">'.$rows['cat_name'].'</td>
                 <td>'.$rows['empty_name'].'</td>
                 <td>'.$rows['empty_value'].'</td>
                 <td>'.$rows['cat_weight'].'</td>
                 <td>'.$rows['Unit'].'</td>
                 <td>'.$rows['gm_weight'].'</td>
                 <td>'.$rows['net_weight'].'</td>
                 <td>'.$rows['cat_price_dis'].'</td>
                 <td>'.$rows['cat_price_def'].'</td>
                 <td>'.$rows['total_purchase'].'</td>
                 <td>'.$rows['total_sale'].'</td>
                 <td>'.$rows['profit'].'</td>
             </tr>';
    }

}

?>

        </tbody>
    </table>
        <div style="margin-top: 20px">
            <span id="purchase_pr"><b> اجمالى سعر الشراء: </b> <b style="color: red"><?=$rows2['sum_purchase'];?></b></span>
            <span id="sale_pr"><b> اجمالى سعر البيع: </b> <b style="color: red"><?=$rows2['sum_sale'];?></b></span>
            <span id="profit_pr"><b> الربح من اجمالى الفاتورة : </b> <b style="color: red"><?=$rows2['net_profit'];?></b></span>
        </div>

    </div>
    <div class="text-center mt-5">
        طباعة الفاتورة
    <button class="btn btn-primary" id="print"><span class="fas fa-print fa-2x"></span></button>
</div>

<?php include 'footer.php'?>
<script>
    function printData()
    {
        var divToPrint=document.getElementById("printing");
        newWin= window.open("");
        newWin.document.write('<style>@media print {' +
           ' #logo2 {'+
            'float: right;'+
            'margin-right: 10px;'+
            'margin-bottom: 10px;'+
            'width: 150px;'+
            'height: 120px;}'+
            '#title-pr{\n' +
            '    position: absolute;\n' +
            '    top: 0;\n' +
            '    right: 500px;\n' +
            '}'+
            '#client_name_pr{\n' +
            '    position:absolute;\n' +
            '    top:40px;\n' +
            '    left: 200px;\n' +
            '}'+
            '#invoice_no_pr{\n' +
            '    position:absolute;\n' +
            '    top:65px;\n' +
            '    left: 250px;\n' +
            '}'+
            '#date_pr{\n' +
            '    position:absolute;\n' +
            '    top:90px;\n' +
            '    left: 210px;\n' +
            '}'+
            '#purchase_pr{\n' +
            '    margin-left: 250px;\n' +
            '}\n' +
            '#sale_pr{\n' +
            '    margin-left: 200px;\n' +
            '}\n' +
            '#profit_pr{\n' +
            '    margin-left: 100px;\n' +
            '}'+

        '    #printTable{' +
            '        border-collapse: collapse!important;\n' +
            '        border-spacing: 0!important;\n' +
            '        width: 100%;!important;\n' +
            '    }' +
            '    #printTable >thead >tr >th,tbody> tr> td {\n' +
            '        text-align: right;!important;\n' +
            '        padding: 0;!important;\n' +
            '        -webkit-print-color-adjust: exact; \n' +

            '    }\n' +
            '\n' +
            '   #printTable >tbody >tr:nth-child(even) {\n' +
            '        background-color: #f2f2f2!important;\n' +
            '        -webkit-print-color-adjust: exact; \n' +
            '    }\n' +
            '}</style>');
        newWin.document.write(divToPrint.outerHTML);
        newWin.print();
        newWin.close();
    }
    $('#print').click(function () {
        printData();
    })
</script>