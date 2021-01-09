<?php
include 'db.php';
session_start();
$cat_name="";
$cat_type="اختر نوع الصنف ..";
$cat_source="اختر مصدر الصنف ..";
$cat_price_def="";
$cat_price_dis="";

if (isset($_POST['insert'])) {
    $cat_name = $_POST['cat_name'];
    $cat_price_dis = $_POST['cat_price_dis'];
    $cat_price_def = $_POST['cat_price_def'];
    $cat_source = $_POST['cat_source'];
    $cat_type = $_POST['cat_type'];
    if($cat_name!=='' && $cat_price_dis!==''&& $cat_price_def && $cat_source!=='' && $cat_type!==''){
    $sql = "INSERT INTO categories(cat_name, cat_price_dis, cat_price_def, cat_source, type) VALUES('$cat_name', '$cat_price_dis', '$cat_price_def', '$cat_source', '$cat_type')";
    mysqli_query($conn, $sql) or die(mysqli_error($conn));
    echo "successful inserted";
    $_SESSION['message']="تم حفظ الصنف";
    $_SESSION['msg_type']="success";
    header('Location:categories_management.php');
}
    else{
        $_SESSION['message']="أكمل البيانات أولا";
        $_SESSION['msg_type']="warning";
        header('Location:categories_management.php');

    }
}
else{
    echo" not inserted";
}
if(isset($_GET['delete'])){
    $id=$_GET['delete'];
    $sql="DELETE FROM categories WHERE id='$id'";
    mysqli_query($conn,$sql);
    $_SESSION['message']="تم حذف الصنف";
    $_SESSION['msg_type']="danger";
    header('Location:categories_management.php');

}
if (isset($_GET['edit'])){
    $id=$_GET['edit'];
    $sql="SELECT * FROM categories WHERE id='$id'";
    $result=mysqli_query($conn,$sql);
    $rows=mysqli_fetch_array($result);
    if(count($rows)==1){

        $cat_name=$rows['cat_name'];
        $cat_price_dis=$rows['cat_price_dis'];
        $cat_price_def=$rows['cat_price_def'];
        $cat_source=$rows['cat_source'];
        $cat_type=$rows['type'];

    }
}
if (isset($_POST['update'])){
    $cat_name=$_POST['cat_name'];
    $cat_price_dis = $_POST['cat_price_dis'];
    $cat_price_def = $_POST['cat_price_def'];
    $cat_source = $_POST['cat_source'];
    $cat_type = $_POST['cat_type'];
    if($cat_name!=='' && $cat_price_dis!==''&& $cat_price_def!==''){

        $sql="UPDATE categories SET cat_name='$cat_name',cat_price_dis='$cat_price_dis',cat_price_def='$cat_price_def',cat_source='$cat_source',type='$cat_type' WHERE id='$_POST[id]'";
    mysqli_query($conn,$sql) or mysqli_error($conn);
    $_SESSION['message']="تم تعديل الصنف";
    $_SESSION['msg_type']="success";
    header('Location:categories_management.php');
    }else{
        $_SESSION['message']="اكمل البيانات أولا";
        $_SESSION['msg_type']="warning";
        header('Location:categories_management.php');
    }
}