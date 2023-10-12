<?php

require_once 'connect.php';
$output = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['nrp']) && isset($_POST['pass'])) {
        $user = strtolower($_POST['nrp']);
        $pass = $_POST['pass'];
        $imap = false;
        $timeout = 30;

        $fp = fsockopen ($host ='john.petra.ac.id',$port = 110,$errno,$errstr,$timeout);
        $errstr = fgets ($fp);
        if (substr($errstr,0,1) == '+'){
            fputs ($fp,"USER ".$user."\n");
            $errstr = fgets ($fp);
            if (substr ($errstr,0,1) == '+'){
                fputs ($fp,"PASS ".$pass."\n");
                $errstr = fgets ($fp);
                if (substr ($errstr,0,1) == '+'){
                    $imap = true;
                }
            }
        }

        // if($user == "c14220206a"){
        //     $imap = true;
        // }
        if($imap){
            $nrp = strtoupper(substr($_POST["nrp"], 0, 9));
            $sql = "SELECT * FROM `panitia` WHERE nrp = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$nrp]);
            
            if ($stmt->rowCount() > 0 && $imap) {
                session_start();
                $_SESSION['nrp_admin'] = $nrp;
                $output = "success";
                header("Location:connect.php");
            }
            else {
                $output = "error1";
            }
        }
        else {
            $output = "error2";
        }

        // if ($user == "dummy" && $pass == "admintest") {
        //     session_start();
        //     $_SESSION['nrp_admin'] = $user;
        //     $output = "success";
        // }
        // else {
        //     $output = "error";
        // }
    
    }

    echo $output;
}

?>
