<?php
include("../include/include.php");
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
        <?php $fromValue = $er->getFromValue(); ?>
        <form action="adsfile.php" method="post">


            <p>
                <label for="last_name">Title</label>
                <input value="<?php if ($fromValue)
            echo $fromValue['title']; ?>" type="text" id="last_name" name="fields_req[title]" />
            </p>
            <p>
                <label for="last_name">Description</label>
                <input value="<?php if ($fromValue)
                           echo $fromValue['description']; ?>" type="text" id="last_name" name="fields_req[description]" />
            </p>
          
            <ul>
                <li><input type="checkbox" name="coun[]" value="1"/> srilanka</li>
                <li><input type="checkbox" name="pro[]" value="2"/> Western</li>
                <li><input type="checkbox"  name="dis[]" value="3"/> Colombo</li>
                <li><select name="job"><option value="1">IT</option><option value="2">Engineer</option></select></li>
                <li><select name="accat"><option value="100">All</option><option value="1">Gold</option><option value="2">Silver</option><option value="2">Pltinam</option></select></li>
                <li><select name="sex"><option value="MF">All</option><option value="M">Male</option><option value="F">Female</option></select></li>
                <li><select name="_18"><option value="100">All</option><option value="1">18+</option><option value="2">18-</option></select></li>
            </ul>


            <input type="submit" name="adsFormSubmit" value="Send" />
        </form>

    </body>
</html>