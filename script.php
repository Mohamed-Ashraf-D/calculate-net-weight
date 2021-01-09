<script>
const activePage=$(".page-lookup").val();
switch(activePage){
    case 'الرئيسية':
        $('#home').attr("class","active");
    case 'عرض الفواتير':
        $('#inv_display').attr("class","active");
    case 'تفاصيل الفاتورة':
        $('#inv_details').attr("class","active");

}


//calculate sum_purchase column of table
function calculateTableTotal() {
    var total = 0;

    $('#table1 tbody tr td[id=sum_t]').each(function () {

        // find the amount input field
        var $input = $(this);
        total += parseFloat($input.html());
    });

    $("#sum_purchase").val(Math.round(+total*1000)/1000);

}

//calculate sum_sale column of table

function calculateTableTotal2() {
    var total = 0;

    $('#table1 tbody tr td[id=sum_s]').each(function () {

        // find the amount input field
        var $input = $(this);
        total += parseFloat($input.html());
    });

    $("#sum_sale").val(Math.round(+total*1000)/1000);

}

//calculate profit column from table
function calculateTableProfit() {
    var net_profit = 0;

    $('#table1 tbody tr td[id=sum_p]').each(function () {

        // find the amount input field
        var $input = $(this);
        net_profit += parseFloat($input.html());
    });

    Math.round($("#net_profit").val(Math.round(+net_profit*1000)/1000));

}

//to display value of selected option in input
// $('#cat').chosen();
//to search in option you selected
$(document).ready(function () {
    $('.single-select').select2();
});
//------------------------------
$('#empty').change(function () {
    var displayvalue1 = $('#empty option:selected').val();
    $('#empty_value').val(displayvalue1);
    calctotal2();
});

var selected_option = $('#cat option:selected');
var displaytype = selected_option.val();
var typeval1 = displaytype.split(",");
var cat = $('#cat');
var cat_weight = $('#cat_weight');
var net_weight = $('#net_weight');
var empty_value = $('#empty_value');
var total_p = $('#total_purchace');
var total_s = $('#total_sale');


var gm_weight = $('#gm_weight');
var cat_price_def = $('#cat_price_def');
var cat_price_dis = $('#cat_price_dis');
var enter_save = $('#submit');
var unit=$('#unit');

cat.change(function () {
    var selected_option = $('#cat option:selected');
    var displaytype = selected_option.val();
    var typeval1 = displaytype.split(",");
    cat_price_dis.val(typeval1[0]);
    cat_price_def.val(typeval1[2]);



    if (typeval1[1] === '0' || typeval1[1]==='2' || typeval1[1]==='3') {
        if(typeval1[1]==='0'){
            unit.val('<?=$unit_2?>');}
            else if(typeval1[1]==='2'){
            unit.val('<?=$unit_3?>')
        }else if (typeval1[1]==='3'){
            unit.val('<?=$unit_4?>');
        }
        var option2 = $('#empty option:eq(1)').val();
        $('#empty').val(option2).trigger('change');

        cat.focus();


        cat_weight.val('');
        total_p.val('');
        total_s.val('');
        cat_weight.keyup(function () {
            gm_weight.val('');
            net_weight.val('');
            total_p.val(cat_price_dis.val() * cat_weight.val());
            total_s.val(cat_price_def.val() * cat_weight.val());
            profit.val(total_s.val() - total_p.val());
        });


    } else if (typeval1[1] === '1') {
        var option2 = $('#empty option:eq(0)').val();
        $('#empty').val(option2).trigger('change');
        unit.val('<?=$unit_1?>');

        $('#cat_price_dis').val(typeval1[0]);
        cat_price_def.val(typeval1[2]);
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
    }else if(typeval1[1]==='2'){
        unit.val('<?=$unit_3?>');
    }else if(typeval1[1]==='3'){
        unit.val('<?=$unit_4?>');
    }
});
//apppppppppppppppppppppend
enter_save.click(function () {
    var selected_option = $('#cat option:selected');
    var displaytype = selected_option.val();
    var typeval1 = displaytype.split(",");
    if (typeval1[1] === '0'||typeval1[1]==='2'||typeval1[1]==='3') {
        if (cat.val() !== '' && cat_weight.val() !== '' && cat_price_dis.val() !== '' && total_p.val() !== '0' && total_s.val() !== '0' ) {
            if (empty_value.val()===''||empty_value.val()==='0'){
                var count = $('#table1 tbody tr').length;
                $('#table1 tbody').append('<tr>' +
                    '<td  class="no">' + (count + 1) + '</td>' +
                    '<td  class="cat_name">' + $('#cat option:selected').text() + '</td>' +
                    '<td  class="empty">' + $("#empty option:selected").text() + '</td>' +
                    '<td  class="empty_value">' + $('#empty_value').val() + '</td>' +
                    '<td  class="cat_weight">' + $('#cat_weight').val() + '</td>' +
                    '<td  class="unit">' + $('#unit').val() + '</td>' +
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
                $('span [aria-labelledby=select2-cat-container]').focus();
                var options=$('#empty').options;
                for (var i=0;i<options.length;i++){
                    if (options[i].text="بدون"){
                        options[i].selected=true;
                        break;
                    }
                }

            }else{

                gm_weight.val('');
                net_weight.val('');
                empty_value.val('0');
                alert('يجب ان يكون نوع الفارغ (بدون فارغ)');
                $('#empty').html('<option value="">اختر نوع الفارغ</option>');
            }

        } else {
            swal("ادخل الكمية اولا");

        }
    } else if (typeval1[1] === '1') {
        if (cat.val() !== ''  && cat_weight.val() !== '' && cat_price_dis.val() !== '') {
            if (parseFloat(empty_value.val()) < parseFloat(cat_weight.val()) && total_p.val() !== '0' && total_s.val() !== '0') {
                if(empty.val()!==''){
                    var count = $('#table1 tbody tr').length;
                    $('#table1 tbody').append('<tr>' +
                        '<td  class="no">' + (count + 1) + '</td>' +
                        '<td  class="cat_name">' + $('#cat option:selected').text() + '</td>' +
                        '<td  class="empty">' + $("#empty option:selected").text() + '</td>' +
                        '<td  class="empty_value">' + $('#empty_value').val() + '</td>' +
                        '<td  class="cat_weight">' + $('#cat_weight').val() + '</td>' +
                        '<td  class="unit">' + $('#unit').val() + '</td>' +
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
                    $('span [aria-labelledby=select2-cat-container]').focus();
                }else{
                    swal('أدخل نوع الفارغ');
                }
            } else {
                swal({title: "يجب ان يكون الوزن الكلى أكبر من وزن الفارغ"}, function () {
                    cat_weight.focus();
                });
            }
        } else {
            swal('ادخل البيانات أولا');
            cat.focus();
        }
    } else {
        swal("أدخل البيانات أولا");
    }


});

var profit = $('#profit');


function calctotal2() {

    if (cat_weight.val() !== '' && (empty_value.val()).length !== 0) {
        gm_weight.val((Math.abs(cat_weight.val() - empty_value.val())));
        net_weight.val((Math.abs(cat_weight.val() - empty_value.val())) / 1000);
        var total_purchase=cat_price_dis.val() * net_weight.val();
        total_p.val(Math.round(total_purchase * 1000)/1000);
        var total_sale=cat_price_def.val() * net_weight.val();
        total_s.val(Math.round(total_sale * 1000)/1000);
        var profit1=(cat_price_def.val() - cat_price_dis.val()) * net_weight.val();
        profit.val(Math.round(profit1*10000)/10000);
    } else {
        gm_weight.val('');
        net_weight.val('1');
        var total_purchase=cat_price_dis.val() * net_weight.val();
        total_p.val(Math.round(total_purchase * 1000)/1000);
        var total_sale=cat_price_def.val() * net_weight.val();
        total_s.val(Math.round(total_sale * 1000)/1000);
        var profit1=(cat_price_def.val() - cat_price_dis.val()) * net_weight.val();
        profit.val(Math.round(profit1*10000)/10000);

    }
}


//variabels
var empty = $('#empty');
var enter_save = $('#submit');
$('#cat_weight').keyup(function (e) {
    if (e.keyCode === 13) {
        enter_save.click();

    }
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



//--------------------------------------------------------

//delete one row of table
$('#table1').on('click', '#del', function () {
    $(this).closest('tr').remove();
    renumberrows();
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
$('#new').click(function () {
    $('#table1 tbody').empty();
    $('#frm')[0].reset();
    calculateTableTotal();
    calculateTableTotal2();
    calculateTableProfit();
    var option1 = $('#cat option:eq(0)').val();
    var option2 = $('#empty option:eq(0)').val();
    $('#cat').val(option1).trigger('change');
    $('#empty').val(option2).trigger('change');
    $('#cat').focus();

});



//push data in the array with each loop function, loop in each column in the table
// and send data with ajax in object format (key=>value) to php page (insert.php)
$('#send').click(function () {
    var no = [];
    var lastno = $('#invoice_no').val();
    var date = $('#date').val();
    var sum_purchase = $('#sum_purchase').val();
    var sum_sale = $('#sum_sale').val();
    var client_sel=$('#client_sel');
    var client_code=client_sel.val();
    var client_name=$('#client_sel option:selected').text();
    var cat_name = [];
    var empty = [];
    var empty_value = [];
    var cat_weight = [];
    var unit=[];
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
    $(".unit").each(function () {
        unit.push($(this).text());
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

    var tableempty = $('#table1 tr td').val();
    if (tableempty === '') {
        swal({
                title: 'حفظ الفاتورة',
                text: '',
                type: '',
                showLoaderOnConfirm: true,
                showCancelButton:true,
                cancelButtonText: 'لا',
                confirmButtonText: 'نعم',
                closeOnConfirm: false
            },
            function () {
                $.ajax({
                    data: {
                        no: no,
                        lastno: lastno,
                        client_name:client_name,
                        client_code:client_code,
                        date: date,
                        sum_purchase: sum_purchase,
                        sum_sale: sum_sale,
                        cat_name: cat_name,
                        empty: empty,
                        empty_value: empty_value,
                        cat_weight: cat_weight,
                        unit: unit,
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
                    url: "insert.php",


                    success: function (result) {
                        if (result.status == 'success') {
                            swal('successful saved', '', 'success')
                        } else {
                            swal('تم الحفظ بنجاح', '', 'success');
                            $('#table1 tbody').empty();
                            $('#sum').val('');
                            $('#net_profit').val('');
                            invoice_no();
                        }
                    }
                });

            });

    } else {
        swal({
            title: "ادخل البيانات أولا",
            text: "",
            type: "error",
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'تمام',
            closeOnConfirm: false,
            closeOnCancel: false
        });
    }


});
$(document).ready(function () {
    invoice_no();
});

function invoice_no() {

    $.ajax({
        url: "invoice_no.php",
        type: "post",
        success: function (dataresponse) {
            $('#invoice_no').val(dataresponse);
        }
    });
}

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
var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy = today.getFullYear();

today = yyyy + '-' + mm + '-' + dd;
$('#date').val(today);



$(document).ready(function (e) {
    $('#date').focus();

    if (e.keyCode === 9) {
        e.keyCode = 13;
    }


});


</script>