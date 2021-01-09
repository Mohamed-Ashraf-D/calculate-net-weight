<?php
include 'function.php';
?>

<html>

<head>
    <title><?php getTitle()?></title>
    <style>
    .navbar-expand-lg .navbar-nav .nav-link{
    padding-right: 8.5rem!important;
    }
    </style>
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <link rel="stylesheet" href="fonts/css/all.min.css">
    <link rel="stylesheet" href="css/sweetalert.css">
    <link rel="stylesheet" href="css/select2.min.css">
    <link rel="stylesheet" href="css/sweetalert.css">
    <link rel="stylesheet" href="css/style.css">




</head>
<body dir="rtl">


<div class="container-fluid">
<nav dir="rtl" class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a tabindex="-1" class="navbar-brand page-lookup <?php echo (basename($_SERVER['PHP_SELF'])=="index.php")?"active":""; ?>" id="logo" href="index.php">حلوانى زكريا</a>
    <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <ul class="navbar-nav">
               <li class="nav-item">
                   <a tabindex="-1" class="nav-link page-lookup <?php echo (basename($_SERVER['PHP_SELF'])=="index.php")?"active":""; ?>" id="home" href="index.php">الرئيسية</a>
               </li>
                <li class="nav-item">
                    <a tabindex="-1" class="nav-link page-lookup <?php echo (basename($_SERVER['PHP_SELF'])=="invoice_display.php")?"active":""; ?>" id="inv_display" href="invoice_display.php">عرض الفواتير</a>
                </li>

                <li>
                    <div class="btn-group mr-5">
                        <button type="button" class="btn btn-drop-mng btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                إدارة
                        </button>
                        <div class="dropdown-menu">
                            <a tabindex="-1" class="dropdown-item page-lookup <?php echo (basename($_SERVER['PHP_SELF'])=="categories_management.php")?"active":""; ?>" id="cat_mng" href="categories_management.php">ادارة الأصناف</a>
                            <a tabindex="-1" class="dropdown-item page-lookup <?php echo (basename($_SERVER['PHP_SELF'])=="client_management.php")?"active":""; ?> " id="client_mng" href="client_management.php">ادارة العملاء</a>
                            <a tabindex="-1" class="dropdown-item page-lookup <?php echo (basename($_SERVER['PHP_SELF'])=="empty_management.php")?"active":""; ?> " id="empty_mng" href="empty_management.php">الفوارغ</a>


                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
