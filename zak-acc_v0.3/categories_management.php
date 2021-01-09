<?php
include "db.php";
session_start();
$pageTitle='ادارة الاصناف';
?>
<?php
$cat_name="";
$type="اختر نوع الصنف ..";
$cat_source="اختر مصدر الصنف ..";
$cat_price_def="";
$cat_price_dis="";
$id=0;
$update=false;

if (isset($_GET['edit'])){
    $id=$_GET['edit'];
    $update=true;
    $sql="SELECT * FROM categories WHERE id='$id'";
    $result=mysqli_query($conn,$sql);

    if($result){
        $rows=mysqli_fetch_array($result);
        $cat_name=$rows['cat_name'];
        $cat_price_dis=$rows['cat_price_dis'];
        $cat_price_def=$rows['cat_price_def'];
        $cat_source=$rows['cat_source'];
        $cat_type=$rows['type'];
        $sql3="SELECT unit_name FROM units WHERE unit_code='$cat_type'";
        $result2=mysqli_query($conn,$sql3);
        $rows2=mysqli_fetch_row($result2);
        $type=$rows2[0];

    }
}
?>
<?php include "header.php";?>


<div class="row">

    <div class="col-4">
        <form class="form mt-5" action="insert_categories.php" method="post">
            <input type="hidden" name="id" value="<?=$id?>">
            <div class="form-group text-right">
                <label for="cat_name"> اسم الصنف :</label>
                <input type="text" class="form-control border-dark" value="<?=$cat_name?>" name="cat_name" id="cat_name">
            </div>
            <div class="form-group text-right">
                <label for="cat_price_dis"> سعر الصنف جملة :</label>
                <input type="text" class="form-control border-dark" value="<?=$cat_price_dis?>" name="cat_price_dis" id="cat_price_dis">
            </div>
            <div class="form-group text-right">
                <label for="cat_price_def"> سعر الصنف قطاعى :</label>
                <input type="text" class="form-control border-dark" value="<?=$cat_price_def?>" name="cat_price_def" id="cat_price_def">
            </div>
            <div class="form-group text-right">
                <label for="cat_type"> نوع الصنف :</label>
                <select id="cat_type"name="cat_type"  class="form-control border-dark">
                   <option value="<?=$cat_type?>"><?=$type?></option>
                    <?php
                   $query='SELECT * FROM units';
                   $result1=mysqli_query($conn,$query);
                   while($rows1=mysqli_fetch_assoc($result1)){?>
                       <option value="<?=$rows1['unit_code']?>"><?=$rows1['unit_name']?></option>;

                    <?php
                   }

                   ?>

                </select>
            </div>
            <div class="form-group text-right">
                <label for="cat_source"> مصدر الصنف :</label>
                <select id="cat_source" name="cat_source" class="form-control border-dark">
                    <option value="<?=$cat_source?>"><?=$cat_source?></option>
                    <option value="شرقى">شرقى</option>
                    <option value="غربى">غربى</option>
                </select>
            </div>
            <?php if($update==true):?>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-info form-control" name="update" id="update">تعديل</button>
            </div>
            <?php elseif($update==false):?>
            <div class="form-group text-center">
               <button type="submit" class="btn btn-success form-control" name="insert" id="insert">حفظ</button>
            </div>
            <?php endif;?>
        </form>
    </div>
    <div class="col-8 mt-5">
        <div class="" style="overflow-y: scroll;overflow-x: hidden;height: 600px">

        <table class="table table-bordered table-striped overflow-auto table-sm" id="table1">
        <thead>
            <th>اسم الصنف</th>
            <th>سعر الصنف جملة</th>
            <th>سعر الصنف قطاعى</th>
            <th>مصدر الصنف</th>
            <th>نوع الصنف</th>
        </thead>
        <tbody>
        <?php
        $sql="SELECT * FROM categories";
        $result=mysqli_query($conn,$sql);
        while ($rows=mysqli_fetch_assoc($result)){
        ?>
        <tr>
            <td><?=$rows['cat_name']?></td>
            <td><?=$rows['cat_price_dis']?></td>
            <td><?=$rows['cat_price_def']?></td>
            <td><?=$rows['cat_source']?></td>
            <td><?php $sql2="SELECT unit_name FROM units WHERE unit_code=$rows[type]";
                      $result3=mysqli_query($conn,$sql2);
                      $rows3=mysqli_fetch_row($result3);
                      echo $rows3[0];

                ?></td>
            <td><a type="button" class="btn btn-primary btn-sm" href="categories_management.php?edit=<?=$rows['id']?>">تعديل</a></td>
            <td><a type="button" class="btn btn-danger btn-sm" href="insert_categories.php?delete=<?=$rows['id']?>">حذف</a></td>

        </tr>
<?php }?>
        </tbody>
        </table>
        </div>
        <?php
        if (isset($_SESSION['message'])):
            ?>
            <div class="alert text-center  alert-<?=$_SESSION['msg_type']?>">
                <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                ?>
            </div>
        <?php endif;?>
    </div>

</div>

<?php include 'footer.php'?>
<script>
    $(document).ready(function () {
       acceptOnlyNumbrer('cat_price_dis','cat_price_def');
    });
</script>



