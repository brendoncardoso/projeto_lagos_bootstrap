<?php 
include_once('header.php'); 
include_once('breadcrumb.php'); 

$sql = mysql_query("SELECT cms_historia FROM cms WHERE id = 1");
$row = mysql_fetch_assoc($sql);
$texto = $row['cms_historia'];
?>

<!--HEADER MENU-->
<!--<div class="page_title mb-5">
    <div class="container">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-6 pt-3">
                    <h4>HISTÓRIA</h4>
                </div>
                <div class="col-sm-6 pt-3">
                    <div class="right">
                        <a href="index.php" class="text-white">Home</a>
                        <span>» Breve História</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>-->

<!--<div class="container">
    <div class="col-sm-12">
        <?php echo $texto; ?>
    </div>
</div>-->

<?php include_once('footer.php'); ?>