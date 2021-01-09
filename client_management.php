<?php
include "db.php";
session_start();
$pageTitle='ادارة العملاء';
?>
<?php
$ClientName="";
$ClientCode="";
$id=0;
$update=false;

if (isset($_GET['edit'])){
    $id=$_GET['edit'];
    $update=true;
    $sql="SELECT * FROM clients WHERE ClientID='$id'";
    $result=mysqli_query($conn,$sql);

    if($result){
        $rows=mysqli_fetch_array($result);
        $ClientName=$rows['ClientName'];
        $ClientCode=$rows['ClientCode'];
        $sql3="SELECT ClientCode FROM clients WHERE ClientID='$id'";
        $result2=mysqli_query($conn,$sql3);
        $rows2=mysqli_fetch_row($result2);
        $ClientCode2=$rows2[0];

    }
}
?>
<?php include "header.php";?>


<div class="row">

    <div class="col-4">
        <form class="form mt-5" action="insert_clients.php" method="post">
            <input type="hidden" name="id" value="<?=$id?>">
            <div class="form-group text-right">
                <label for="cat_name"> اسم العميل :</label>
                <input type="text" class="form-control border-dark" value="<?=$ClientName?>" name="client_name" id="client_name">
            </div>
            <div class="form-group text-right">
                <label for="cat_price_dis"> كود العميل :</label>
                <input type="text" class="form-control border-dark" value="<?=$ClientCode?>" name="client_code" id="client_code">
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
                <th>اسم العميل</th>
                <th> كود العميل </th>
                </thead>
                <tbody>
                <?php
                $sql="SELECT * FROM clients";
                $result=mysqli_query($conn,$sql);
                while ($rows=mysqli_fetch_assoc($result)){
                    ?>
                    <tr>
                        <td><?=$rows['ClientName']?></td>
                        <td><?=$rows['ClientCode']?></td>
                        <td><a type="button" class="btn btn-primary btn-sm" href="client_management.php?edit=<?=$rows['ClientID']?>">تعديل</a></td>
                        <td><a type="button" class="btn btn-danger btn-sm" href="insert_clients.php?delete=<?=$rows['ClientID']?>">حذف</a></td>

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
        acceptOnlyNumbrer('client_code','aa')
    });
</script>



