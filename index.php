<?php
/* #################
 * Get get last language, or set en as default.
  ################ */

$lang = "de-de";
$langxml = simplexml_load_file("./lang/" . $lang . ".xml");
$stats = Array("health", "stamina", "oxygen", "food", "weight", "melee", "movement");

function generateStatLine($statName, $langxml) {
    $htmlContainer  = '<div class="row">';
    $htmlContainer .= '<div class="col-xs-4">';
    $htmlContainer .= '<span class="input-group-addon" >' . $langxml->$statName . ' ' . $langxml->tame . '</span>';
    $htmlContainer .= '<div class="input-group spinner">';
    $htmlContainer .= '<input type="text" class="form-control numberInput wildValue values" disabled id="' . $statName . 'WildValue" aria-type="' . $statName . '">';
    $htmlContainer .= '<input type="text" class="form-control numberInput levels" id="' . $statName . 'level" aria-status="wild" aria-type="' . $statName . '" value="0">';
    $htmlContainer .= '<div class="input-group-btn-vertical">';
    $htmlContainer .= '<button class="btn btn-default" type="button" aria-type="' . $statName . '"><i class="fa fa-caret-up" aria-type="' . $statName . '" aria-field-daddy="' . $statName . 'level"></i></button>';
    $htmlContainer .= '<button class="btn btn-default" type="button" aria-type="' . $statName . '"><i class="fa fa-caret-down" aria-type="' . $statName . '" aria-field-daddy="' . $statName . 'level"></i></button>';
    $htmlContainer .= '</div>';
    $htmlContainer .= '</div>';
    $htmlContainer .= '</div>';
    $htmlContainer .= '<div class="col-xs-4">';
    $htmlContainer .= '<span class="input-group-addon" >' . $langxml->$statName . ' ' . $langxml->wish . '</span>';
    $htmlContainer .= '<div class="input-group spinner">';
    $htmlContainer .= '<input type="text" class="form-control numberInput tamedValue values" disabled id="' . $statName . 'value"  aria-type="' . $statName . '">';
    $htmlContainer .= '<input type="text" class="form-control numberInput levels" id="' . $statName . 'wish" aria-status="tamed" aria-type="' . $statName . '"  value="0">';
    $htmlContainer .= '<div class="input-group-btn-vertical">';
    $htmlContainer .= '<button class="btn btn-default" type="button" aria-type="' . $statName . '"><i class="fa fa-caret-up" aria-type="' . $statName . '" aria-field-daddy="' . $statName . 'wish"></i></button>';
    $htmlContainer .= '<button class="btn btn-default" type="button" aria-type="' . $statName . '"><i class="fa fa-caret-down" aria-type="' . $statName . '" aria-field-daddy="' . $statName . 'wish"></i></button>';
    $htmlContainer .= '</div>';
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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
                        $dino_json = json_decode(file_get_contents("./data/dino_data.json"));
                        foreach ($dino_json as $value) {
                            echo "<option>" . $value->name . "</option>";
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
                    <div class="btn btn-primary disabled"> Save Wish Values</div>
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
            <div class="alert alert-info alert-dismissable" style="height:130px;" contenteditable="true">
                <h4><?= $langxml->cookieHeadline; ?></h4>
                <?= $langxml->cookieText; ?>
                <div class="col-md-6 col-xs-12" style="margin-top:12px"><button type="button" style="right:0px;top:0px;" class="close acceptCookie" data-dismiss="alert" aria-hidden="true"><?= $langxml->cookieAccept; ?></button></div>
                <div class="col-md-6 col-xs-12" style="margin-top:12px"><button type="button" style="right:0px;top:0px;" class="close" data-dismiss="alert" aria-hidden="true"><?= $langxml->cookieDecline; ?></button></div>
            </div>
            <div class="row">
                <div class="col-md-4 col-xs-12">
                    <div class="btn btn-info"> Impressum</div>
                </div>
            </div>
            <div class="alert alert-info alert-dismissable impressum" style="display:none" contenteditable="true">
                <h4><?= $langxml->impressumHeadline; ?></h4>
                <?= $langxml->impressumText; ?>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="./js/dvc.js"></script>
    </body>
</html>
