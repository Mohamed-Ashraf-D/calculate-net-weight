<?php
include 'db.php';
session_start();
$client_name="";
$client_code="";
if (isset($_POST['insert_empty'])){
    $weight_name = $_POST['weight_name'];
    $weight = $_POST['weight'];
    $weight_code = $_POST['weight_code'];
    if($weight_name!==''&& $weight!=='' && $weight_code!==''){
        $sql = "INSERT INTO weights(weight_name, weight, weight_code) VALUES('$weight_name','$weight','$weight_code')";
        mysqli_query($conn, $sql) or die(mysqli_error($conn));
        echo "successful inserted";
        $_SESSION['message']="تم حفظ الفارغ";
        $_SESSION['msg_type']="success";
        header('Location:empty_management.php');
    }
    else{
        $_SESSION['message']="أكمل البيانات أولا";
        $_SESSION['msg_type']="warning";
        header('Location:empty_management.php');

    }
}else{
    echo" not inserted";
}

if (isset($_POST['insert'])) {
    $client_name = $_POST['client_name'];
    $client_code = $_POST['client_code'];
    if($client_name!=='' && $client_code!==''){
        $sql = "INSERT INTO clients(ClientName, ClientCode) VALUES('$client_name', '$client_code')";
        mysqli_query($conn, $sql) or die(mysqli_error($conn));
        echo "successful inserted";
        $_SESSION['message']="تم حفظ العميل";
        $_SESSION['msg_type']="success";
        header('Location:client_management.php');
    }
    else{
        $_SESSION['message']="أكمل البيانات أولا";
        $_SESSION['msg_type']="warning";
        header('Location:client_management.php');

    }
}
else{
    echo" not inserted";
}

if(isset($_GET['delete_empty'])){
    $id=$_GET['delete_empty'];
    $sql="DELETE FROM weights WHERE id='$id'";
    mysqli_query($conn,$sql)or mysqli_error($conn);
    $_SESSION['message']="تم حذف الفارغ";
    $_SESSION['msg_type']="danger";
    header('Location:empty_management.php');

}

if(isset($_GET['delete'])){
    $id=$_GET['delete'];
    $sql="DELETE FROM clients WHERE ClientID='$id'";
    mysqli_query($conn,$sql)or mysqli_error($conn);
    $_SESSION['message']="تم حذف العميل";
    $_SESSION['msg_type']="danger";
    header('Location:client_management.php');

}
if (isset($_GET['edit_empty'])){
    $id=$_GET['edit_empty'];
    $sql="SELECT * FROM weights WHERE id='$id'";
    $result=mysqli_query($conn,$sql);
    $rows=mysqli_fetch_array($result);
    if(count($rows)==1){

        $weight_name=$rows['weight_name'];
        $weight=$rows['weight'];
        $weight_code=$rows['weight_code'];

    }
}
if (isset($_GET['edit'])){
    $id=$_GET['edit'];
    $sql="SELECT * FROM clients WHERE ClientID='$id'";
    $result=mysqli_query($conn,$sql);
    $rows=mysqli_fetch_array($result);
    if(count($rows)==1){

        $client_name=$rows['ClientName'];
        $client_code=$rows['ClientCode'];

    }
}

if (isset($_POST['update_empty'])){
    $weight_name=$_POST['weight_name'];
    $weight= $_POST['weight'];
    $weight_code= $_POST['weight_code'];
    if($weight_name!=='' && $weight_code!==''&& $weight!=='' ){

        $sql="UPDATE weights SET weight_name='$weight_name',weight='$weight',weight_code='$weight_code' WHERE id='$_POST[id]'";
        mysqli_query($conn,$sql) or mysqli_error($conn);
        $_SESSION['message']="تم تعديل اسم الفارغ";
        $_SESSION['msg_type']="success";
        header('Location:empty_management.php');
    }else{
        $_SESSION['message']="اكمل البيانات أولا";
        $_SESSION['msg_type']="warning";
        header('Location:empty_management.php');
    }
}

if (isset($_POST['update'])){
    $client_name=$_POST['client_name'];
    $client_code= $_POST['client_code'];
    if($client_name!=='' && $client_code!=='' ){

        $sql="UPDATE clients SET ClientName='$client_name',ClientCode='$client_code' WHERE ClientID='$_POST[id]'";
        mysqli_query($conn,$sql) or mysqli_error($conn);
        $_SESSION['message']="تم تعديل اسم العميل";
        $_SESSION['msg_type']="success";
        header('Location:client_management.php');
    }else{
        $_SESSION['message']="اكمل البيانات أولا";
        $_SESSION['msg_type']="warning";
        header('Location:client_management.php');
    }
}