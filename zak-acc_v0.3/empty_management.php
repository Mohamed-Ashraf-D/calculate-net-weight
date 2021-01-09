<?php
include "db.php";
session_start();
$pageTitle='ادارة الفوارغ';
?>
<?php
$weight_name="";
$weight_code="";
$weight="";
$id=0;
$update=false;

if (isset($_GET['edit_empty'])){
    $id=$_GET['edit_empty'];
    $update=true;
    $sql="SELECT * FROM weights WHERE id='$id'";
    $result=mysqli_query($conn,$sql);

    if($result){
        $rows=mysqli_fetch_array($result);
        $weight_name=$rows['weight_name'];
        $weight=$rows['weight'];
        $weight_code=$rows['weight_code'];
        $sql3="SELECT id FROM weights WHERE id='$id'";
        $result2=mysqli_query($conn,$sql3);
        $rows2=mysqli_fetch_row($result2);
        $id=$rows2[0];

    }
}
?>
<?php include "header.php";?>


<div class="row">

    <div class="col-4">
        <form class="form mt-5" action="insert_clients.php" method="post">
            <input type="hidden" name="id" value="<?=$id?>">
            <div class="form-group text-right">
                <label for="weight_name"> اسم الفارغ :</label>
                <input type="text" class="form-control border-dark" value="<?=$weight_name?>" name="weight_name" id="weight_name">
            </div>
            <div class="form-group text-right">
                <label for="weight"> وزن الفارغ :</label>
                <input type="text" class="form-control border-dark" value="<?=$weight?>" name="weight" id="weight">
            </div>
            <div class="form-group text-right">
                <label for="weight_code"> كود الفارغ :</label>
                <input type="text" class="form-control border-dark" value="<?=$weight_code?>" name="weight_code" id="weight_code">
            </div>
            <?php if($update==true):?>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-info form-control" name="update_empty" id="update">تعديل</button>
                </div>
            <?php elseif($update==false):?>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-success form-control" name="insert_empty" id="insert">حفظ</button>
                </div>
            <?php endif;?>
        </form>
    </div>
    <div class="col-8 mt-5">
        <div class="" style="overflow-y: scroll;overflow-x: hidden;height: 600px">

            <table class="table table-bordered table-striped overflow-auto table-sm" id="table1">
                <thead>
                <th>اسم الفارغ</th>
                <th> وزن الفارغ </th>
                <th> كود الفارغ </th>
                </thead>
                <tbody>
                <?php
                $sql="SELECT * FROM weights";
                $result=mysqli_query($conn,$sql);
                while ($rows=mysqli_fetch_assoc($result)){
                    ?>
                    <tr>
                        <td><?=$rows['weight_name']?></td>
                        <td><?=$rows['weight']?></td>
                        <td><?=$rows['weight_code']?></td>
                        <td><a type="button" class="btn btn-primary btn-sm" href="empty_management.php?edit_empty=<?=$rows['id']?>">تعديل</a></td>
                        <td><a type="button" class="btn btn-danger btn-sm" href="insert_clients.php?delete_empty=<?=$rows['id']?>">حذف</a></td>

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
        var id1='weight';
        var id2='weight_code';
       acceptOnlyNumbrer(id1,id2);
       console.log();
    });






</script>

