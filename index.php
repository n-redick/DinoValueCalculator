<?php
/* #################
 * Get get last language, or set en as default.
  ################ */

$lang = "de-de";
$langxml = simplexml_load_file("./lang/" . $lang . ".xml");
$stats = Array("health", "stamina", "oxygen", "food", "weight", "melee", "speed");

function generateStatLine($statName, $langxml) {
    $htmlContainer = '';
    $htmlContainer .= '<div class="row">';
    $htmlContainer .= '<div class="col-xs-4">';
    $htmlContainer .= '<div class="input-group">';
    $htmlContainer .= '<span class="input-group-addon" >' . $langxml->$statName . ' ' . $langxml->tame . '</span>';
    $htmlContainer .= '<input type="text" class="form-control numberInput" id="' . $statName . 'level" aria-type="' . $statName . '">';
    $htmlContainer .= '</div>';
    $htmlContainer .= '</div>';
    $htmlContainer .= '<div class="col-xs-4">';
    $htmlContainer .= '<div class="input-group">';
    $htmlContainer .= '<span class="input-group-addon" >' . $langxml->$statName . ' ' . $langxml->wish . '</span>';
    $htmlContainer .= '<input type="text" class="form-control" id="' . $statName . 'wish" aria-type="' . $statName . '">';
    $htmlContainer .= '</div>';
    $htmlContainer .= '</div>';
    $htmlContainer .= '<div class="col-xs-4">';
    $htmlContainer .= '<div class="input-group">';
    $htmlContainer .= '<span class="input-group-addon chance">' . $langxml->chance . '</span>';
    $htmlContainer .= '<input type="text" class="form-control" disabled  id="' . $statName . 'chance">';
    $htmlContainer .= '</div>';
    $htmlContainer .= '</div>';
    $htmlContainer .= '</div>';
    return $htmlContainer;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Dino Value Manager</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/dvc.css">
        <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        -->
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-xs-12">
                    <select class="form-control" id="dinotype">
                        <option><?= $langxml->selectdefault; ?></option>
                        <?php
                        $handle = fopen("./data/dinos.html", "r");
                        if ($handle) {
                            while (($line = fgets($handle)) !== false) {
                                echo "<option>" . $line . "</option>";
                            }

                            fclose($handle);
                        } else {
                            // error opening the file.
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-4 col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon">Bonus Level</span>
                        <input type="text" class="form-control" id="blevel">
                    </div>
                </div>
                <div class="col-md-4 col-xs-12">
                    <div class="btn btn-primary"> Save Wish Values</div>
                </div>
            </div>
            <div class="row"style="margin-top:50px;">
                <div class="col-xs-12">
                    <div class="input-group" style="width:255px;margin:0 auto;">
                        <span class="input-group-addon"><?= $langxml->chanceToImprove; ?></span>
                        <input type="text" class="form-control" disabled id="coi">
                    </div>
                </div>
            </div>
            <?php
            foreach ($stats as $statName) {
                echo generateStatLine($statName, $langxml);
            }
            ?>
            <div class="alert alert-danger alert-dismissable" contenteditable="true">
                <button type="button" class="close acceptCookie" data-dismiss="alert" aria-hidden="true"><?= $langxml->cookieAccept; ?></button>
                <h4><?= $langxml->cookieHeadline; ?></h4>
                <?= $langxml->cookieText; ?>
            </div>
            <div class="col-xs-12">Impressum</div>
            <div class="alert alert-danger alert-dismissable" contenteditable="true">
                <button type="button" class="close acceptCookie" data-dismiss="alert" aria-hidden="true"><?= $langxml->cookieAccept; ?></button>
                <h4><?= $langxml->cookieHeadline; ?></h4>
                <?= $langxml->cookieText; ?>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="./js/dvc.js"></script>
    </body>
</html>
