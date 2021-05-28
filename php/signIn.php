<?php
    session_start();
    if(isset($_SESSION['currentPage'])){
        $returnPage = $_SESSION['currentPage'];
    } else {
        $returnPage = 'index.php';
    }
    if (isset($_POST['login_user'])) {
        $db = pg_connect("host=localhost port=5432 dbname=userDB user=postgres password=password") or die("Could not connect: " . pg_last_error()); 

        $email = $_POST["emailSI"] . "@studenti.uniroma1.it";
        $pass = $_POST["passSI"];

        //query per ricercare eventuale mail gia presente nel DB
        $query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
        
        //Eseguo la query
        $result = pg_query($query) or die('Query failed: ' . pg_last_error());
        $row = pg_fetch_row($result);
        
        if ($row[7] == $pass){
            $_SESSION['user'] = array(
                'idUser' => $row[0],
                'nome' => $row[1],
                'cognome' => $row[2],
                'indirizzo' => $row[3],
                'civico' => $row[4],
                'datanascita' => $row[5],
                'email' => $row[6],
            );
            $_SESSION['successLogin'] = 'Bentornato '.$row[1].' '.$row[2].'!';
        } else {
            $_SESSION['errorLogin'] = 'Credenziali errate, riprova';
        }
        pg_close($db);
        session_write_close();
        header('location: ./'.$returnPage);
    }
?>