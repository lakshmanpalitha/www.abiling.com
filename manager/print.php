<?php
include("../include/include.php");
if (!$pr->getSession("admin")) {
    $pr->redirect("../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <style>
            .pr-table{
                border: thin solid #CCCCCC;
                width: 600px;
            }
            .right{
                text-align: right;
            }
            .pr-table tr td{
                border: thin solid #CCCCCC;
                font-family: sans-serif;
                font-size: 17px;
                padding: 5px 2px 5px 5px;
            }
        </style>
    </head>
    <body>
    <center>
        <h3>Panora Report</h3>
        <table class="pr-table">
            <tbody>
            <tbody>

                <tr>
                    <td class="panel-title">Total Members</td>
                    <td class="right"><?php echo $mgt->totalUsers(); ?></td>
                </tr> 
                <tr>
                    <td class="panel-title">Total Register Member</td>
                    <td class="right"><?php echo $mgt->totalRegUsers(); ?></td>
                </tr>  
                <?php
                $pak = $set->getPakageSettings();
                if ($pak) {
                    foreach ($pak as $p) {
                        ?> 
                        <tr>
                            <td class="panel-title">Total Register Member(<?php echo $p->name ?>)</td>
                            <td class="right"><?php echo $mgt->totalAccountUsers($p->id); ?></td>
                        </tr>  
                    <?php }
                } ?>
                <tr>
                    <td class="panel-title">Total Register Amount($)</td>
                    <td class="right"><?php echo $mgt->totalRegAmount(); ?></td>
                </tr>  
                <?php
                $pak = $set->getPakageSettings();
                if ($pak) {
                    foreach ($pak as $p) {
                        ?> 
                        <tr>
                            <td class="panel-title">Total Register Amount(<?php echo $p->name ?>)$</td>
                            <td class="right"><?php echo $mgt->totalRegAmountPakage($p->id); ?></td>
                        </tr>  
                    <?php }
                } ?>
                <tr>
                    <td class="panel-title">Total Amount Of Pay for Ads($)</td>
                    <td class="right"><?php echo $mgt->totalMemberEarn(); ?></td>
                </tr>  
            </tbody>


            </tbody>
        </table>
        <h5>Time : <?php echo date("Y-m-d h:m:s"); ?></h5>
    </center>
   
</body>
</html>
