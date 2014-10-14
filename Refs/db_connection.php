<?php
function dbconnect()
    {
        try {
            $db_host = 'localhost';  //  hostname
            $db_name = 'ref';  //  databasename
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

function logged_in() { // temp
    $username = $_POST['username'];
    $host  = $_SERVER['HTTP_HOST'];
    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $extra = 'member.php';
    $_SESSION['user']=$username;
    redirect("http://$host$uri/$extra");
}

function redirect($url) // dirty redirect fiz
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

function not_logged_in() {
    $host  = $_SERVER['HTTP_HOST'];
    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $extra = 'index.php';
    if (!isset($_SESSION["user"])){
        redirect("destroy.php");
    die();
    }
}


    ?>