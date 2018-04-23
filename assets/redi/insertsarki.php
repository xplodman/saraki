<meta charset="utf-8">
<?php
require 'sqlcon.php';
session_start();

$prosid=$_SESSION['prosid'];
$idusers=$_SESSION["idusers"];
$field_name1=$_POST['field_name1'];
$field_name2=$_POST['field_name2'];
$field_name3=$_POST['field_name3'];
$result1 = array_filter($field_name1);
$result2 = array_filter($field_name2);
$result3 = array_filter($field_name3);
$len1 = count($result1);
$len2 = count($result2);
$len3 = count($result3);
if ($len1 == $len2 && $len2 == $len3 && $len1==0) {
    header('Location: ../../sarki.php?backresult=6  ');
    session_start();
    $_SESSION["casenumdub"] = $stack;
    $_SESSION["year"] = $year;
    $_SESSION["casetypename"] = $casetypename;
    $_SESSION["departname"] = $departname;
    exit;
}
for($y=0 ; $y < $len1 ; $y++)
{
    if ($result1[$y] > $result2[$y]) {
        header('Location: ../../sarki.php?backresult=5  ');
        session_start();
        $_SESSION["casenumdub"] = $stack;
        $_SESSION["year"] = $year;
        $_SESSION["casetypename"] = $casetypename;
        $_SESSION["departname"] = $departname;
        exit;
    }
}
$date=$_POST['date'];
$type=$_POST['type'];
$notes=$_POST['notes'];
$year=$_POST['year'];
$type2 = $_POST['type2'];

if(empty($_POST['type2'])) {
    header('Location: ../../sarki.php?backresult=119');
    exit;
}

$depart=$_POST['depart'];
$stack = [];
$combined_array = array();
foreach($result1 as $key=>$value)
{
    $combined_array[$key]=$value." TO ".$result2[$key];
}
$combined_array_done = implode(", ", $combined_array);
if (!empty($result3)) {
    $result3imploded = implode(",", $result3);
    $combined_array_done .= " ,".$result3imploded;
}

if($len1 == $len2)
{
    $merge=[];
    for($y=0 ; $y < $len1 ; $y++)
    {
        $range = range($result1[$y],$result2[$y]);
        $merge = array_merge($merge, $range);
        if (count($merge) > 500) {
            header('Location: ../../sarki.php?backresult=8');
            $fh = fopen('/tmp/track.txt','a');
            fwrite($fh, $_SERVER['REMOTE_ADDR'].' '.date('c')."\n");
            fclose($fh);
            session_start();
            $_SESSION["casenumdub"] = $stack;
            $_SESSION["year"] = $year;
            $_SESSION["casetypename"] = $casetypename;
            $_SESSION["departname"] = $departname;
            exit;
        }
    }
    $merge = array_merge($merge, $result3);
    $aaaaaaa = mysqli_query($sqlcon, "INSERT INTO `pic`.`sarki` (`idsarki`, `date`, `from`, `to`, `year`,  `casetype_idcasetype`, `casetype2_idcasetype2`, `departs_iddeparts`, `createdate`, `updatedate`, `idusers`, `notes`) VALUES (NULL, '$date', '$combined_array_done', '$combined_array_done', '$year', '$type', '$type2', '$depart', NOW(), NULL, '$idusers', '$notes');")or die(mysqli_error($sqlcon));
    $maxid = mysqli_query($sqlcon, "SELECT MAX(idsarki) FROM sarki");
    $maxidrow = mysqli_fetch_row($maxid);
    $comma_separated = implode("", $maxidrow);
    $maxcaseid = mysqli_query($sqlcon, "Select Max(`case`.idcase) From `case`");
    $maxcaseidrow = mysqli_fetch_row($maxcaseid);
    $maxcaseid = implode("", $maxcaseidrow);
    $len = count($merge);
    for($z=0 ; $z < $len ; $z++)
    {
        $maxcaseid=$maxcaseid+1;
        $dataentry = mysqli_query($sqlcon, "INSERT INTO `pic`.`caseentry` (`idcaseentry`, `idusers`, `idcase`, `status`, `idpros`, `createdate`) VALUES (NULL, '$idusers', '$maxcaseid', '1', '$prosid', NOW());");
        $result2 = mysqli_query($sqlcon, "INSERT INTO `pic`.`case` (`idcase`, `casenum`, `caseyear`, `sarki_idsarki`, `casetype2_idcasetype2`, `casetype_idcasetype`, `departs_iddeparts`, `createdate`, `updatedate`) VALUES ('$maxcaseid', '$merge[$z]', '$year', '$comma_separated', '$type2', '$type', '$depart', NOW(), NULL);");
        if ($result2) {

        }
        else {
            array_push($stack, $merge[$z]);
        }
    };



    if (count($stack) < 1)
    {
        mysqli_commit($sqlcon);
        header('Location: ../../sarki.php?backresult=1');
        $fh = fopen('/tmp/track.txt','a');
        fwrite($fh, $_SERVER['REMOTE_ADDR'].' '.date('c')."\n");
        fclose($fh);
        session_start();
        $_SESSION["casenumdub"] = $stack;
        $_SESSION["year"] = $year;
        $_SESSION["casetypename"] = $casetypename;
        $_SESSION["departname"] = $departname;
        exit;

    }
    else
    {

        header('Location: ../../sarki.php?backresult=0');
        $fh = fopen('/tmp/track.txt','a');
        fwrite($fh, $_SERVER['REMOTE_ADDR'].' '.date('c')."\n");
        fclose($fh);
        session_start();
        $_SESSION["casenumdub"] = $stack;
        $_SESSION["year"] = $year;
        $_SESSION["type"] = $type;
        $_SESSION["depart"] = $depart;
        exit;

    }





}

else{
    header('Location: ../../sarki.php?backresult=9');
    $fh = fopen('/tmp/track.txt','a');
    fwrite($fh, $_SERVER['REMOTE_ADDR'].' '.date('c')."\n");
    fclose($fh);
    session_start();
    $_SESSION["casenumdub"] = $stack;
    $_SESSION["year"] = $year;
    $_SESSION["casetypename"] = $casetypename;
    $_SESSION["departname"] = $departname;
    exit;

};
?>
