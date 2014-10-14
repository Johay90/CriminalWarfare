<?php
error_reporting(E_ALL & ~(E_NOTICE|E_STRICT));
require_once("nbbc.php");
include("class.php");

function dbconnect()
    {
        try {
            $db_host = 'localhost';  //  hostname
            $db_name = 'project';  //  databasename
            $db_user = 'root';  //  username
            $user_pw = '';  //  password

            $con = new PDO('mysql:host='.$db_host.'; dbname='.$db_name, $db_user, $user_pw);  
            $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            $con->exec("SET CHARACTER SET utf8");  //  return all sql requests as UTF-8  
        }
        catch (PDOException $err) {  
            echo "Database connection has failed: ";
            $err->getMessage() . "<br/>";
            file_put_contents('PDOErrors.txt',$err, FILE_APPEND);  // write some details to an error-log outside public_html  
            die();  //  terminate connection
        }
        return $con;
    }


function logged_in() {
    $username = $_POST['username'];
    $host  = $_SERVER['HTTP_HOST'];
    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $extra = 'index.php';
    $_SESSION['user']=$username;
    redirect("http://$host$uri/$extra");
}

function insert(){ // function to import default user ids into tables for crimes, GTA etc etc.

    $dbh = dbconnect();

    $sql = "SELECT * FROM users WHERE username = '".$_SESSION['user']."'";
    $result = $dbh->query($sql);
    $row = $result->fetch(PDO::FETCH_ASSOC);

    // check to see it is a new user (they haven't already got their data in the table)
    $sql1 = "SELECT * FROM crimestats WHERE user_id = '".$row['id']."'";
    $crimestats = $dbh->query($sql1);

        if ($crimestats->rowCount() == 0){
            
             // insert info into crimestats
             $sql2 = "INSERT INTO crimestats (user_id) VALUES (:user_id)";
             $insert = $dbh->prepare($sql2);
             $insert->bindValue(':user_id', $row['id']);
             $insert->execute();
        }

}

function not_logged_in() {
    $host  = $_SERVER['HTTP_HOST'];
    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $extra = 'index.php';
    if (!isset($_SESSION["user"])){
        redirect("log_out.php");
    die();
     }
            if (isset($_SESSION['user'])){
                    $var = new UpdateUser($_SESSION['user']);
                    $var->updateUser();
                    // update timers
                    $time_left =  time()-15;
                    $time_left1 =  time()-120;
                    $dbh = dbconnect();
                    $del="DELETE FROM travel WHERE time_left<$time_left";
                    $res= $dbh->prepare($del);
                    $res->execute();
                    $del1="DELETE FROM crimes WHERE time_left<$time_left1";
                    $res1= $dbh->prepare($del1);
                    $res1->execute();


                    // del row from jail

                    $injailSQL = "SELECT * FROM jail";
                    $injailRESULT = $dbh->query($injailSQL);

                        if ($injailRESULT->rowCount() >= 1){
                            $a = "SELECT rank FROM jail";
                            $b = $dbh->query($a);
                            $c = $b->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($c AS $row) {

                                        if ($row['rank'] = "Beginner Jail Breaker"){
                                            $jailtime =  time()-30;
                                            $del2="DELETE FROM jail WHERE time_left<$jailtime AND rank = 'Beginner Jail Breaker'";
                                            $res2 = $dbh->query($del2);
                                        }

                                        if ($row['rank'] = "Bagman"){
                                            $jailtime =  time()-45;
                                            $del2="DELETE FROM jail WHERE time_left<$jailtime AND rank = 'Bagman'";
                                            $res2 = $dbh->query($del2);
                                        }

                                        if ($row['rank'] = "Bodyguard"){
                                            $jailtime =  time()-60;
                                            $del2="DELETE FROM jail WHERE time_left<$jailtime AND rank = 'Bodyguard'";
                                            $res2 = $dbh->query($del2);
                                        }

                                        if ($row['rank'] = "Safecracker"){
                                            $jailtime =  time()-75;
                                            $del2="DELETE FROM jail WHERE time_left<$jailtime AND rank = 'Safecracker'";
                                            $res2 = $dbh->query($del2);
                                        }

                                        if ($row['rank'] = "Mastermind"){
                                            $jailtime =  time()-110;
                                            $del2="DELETE FROM jail WHERE time_left<$jailtime AND rank = 'Mastermind'";
                                            $res2 = $dbh->query($del2);
                                        }

                                        if ($row['rank'] = "Professional Jail Breaker"){
                                            $jailtime =  time()-180;
                                            $del2="DELETE FROM jail WHERE time_left<$jailtime AND rank = 'Professional Jail Breaker'";
                                            $res2 = $dbh->query($del2);
                                        }
                                }
                        }
            }
    }

 function online_check() {
     if (isset($_SESSION["user"])){ 
             $session = session_id();
             $time= time();
             $time_check = $time-300; //5 mins
             $dbh = dbconnect();

                $sql="SELECT * FROM users_online WHERE username ='".$_SESSION['user']."'";
                $result = $dbh->query($sql);
                $count = $result->rowCount();
                    if($count == "0"){
                     $sql = "INSERT INTO users_online (username, session, time) VALUES (:username, :session, :time)";
                     $r = $dbh->prepare($sql);
                     $r->bindValue(":username", $_SESSION['user']);
                     $r->bindValue(":session", $session);
                     $r->bindValue(":time", $time);
                     $r->execute();
                    }
                    else {
                     $sql = "UPDATE users_online SET time='$time' WHERE session = '$session'";
                     $result = $dbh->query($sql);
                }
             $del="DELETE FROM users_online WHERE time<$time_check";
             $res= $dbh->prepare($del);
             $res->execute();
            }
        }

    function bbtag($data){
            $bbcode = new BBCode;
            $output = $bbcode->Parse($data);
            return $output;
    }
    function linebreak($data){
        return str_replace(array(
        '<br/>',
        '<br />',
        '<br>',
        '<br >'
    ), '', $data);
    }
function redirect($url)
{
    if (!headers_sent())
    {    
        header('Location: '.$url);
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$url.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
        echo '</noscript>'; exit;
    }
}

function jail(){
    $dbh = dbconnect();
    $sql = "SELECT * FROM jail WHERE username = '".$_SESSION["user"]."'";
    $result = $dbh->query($sql);
        if ($result->rowCount() != 0){
            redirect("jail.php");
        }
}

function script_check(){
    $dbh = dbconnect();
    $sql = "SELECT * FROM users WHERE username = '".$_SESSION["user"]."' AND count >= 40";
    $result = $dbh->query($sql);
        if ($result->rowCount() != 0){
            redirect("check.php");
                if ($_SERVER['REQUEST_URI'] != "check.php"){
                    session_destroy();
                }
        }
}
?>