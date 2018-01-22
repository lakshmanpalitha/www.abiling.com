<?php
include("../include/include.php");
if ($read->get("loginFormSubmit", "POST")) {
    $adt->login();
}
if (!$pr->getSession("adt")) {
    $pr->redirect("login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Create Account</title>
    </head>
    <body>
        <?php
        $ob = $er->displayerror();

        if (($ob->error_code == 0 || $ob->error_code == 1) && $ob->error) {
            echo ($ob->error_code == 1 ? "<div class='mws-form-message error'>
                            	This is an error message
                                <ul>
                                	<li>" . $ob->error . "</li>
                                   
                                </ul>
                            </div>" : "<div class='mws-form-message success'>
                            	This is a success message
                                <ol>
                                	<li>" . $ob->error . "</li>
                                   
                                </ol>
                            </div>");
        }
        ?>
        <a href="addvertiser/createads.php"/>Create Ads</a>
    <a href="addviewer/manageads.php">Manage Ads</a>


</body>
</html>