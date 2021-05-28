<?php
  session_start();

  // initializing variables
  $nome = "";
  $cognome = "";
  $indirizzo = "";
  $civico = "";
  $dataNascita = "";
  $email = "";
  $pass = "";


  // connect to the database
  $db = pg_connect("host=localhost port=5432 dbname=userDB user=postgres password=password") or die("Could not connect: " . pg_last_error()); 

  // REGISTER USER
  if (isset($_POST["reg_user"])){

    $nome = $_POST["nomeSU"];
    $cognome = $_POST["cognomeSU"];
    $indirizzo = $_POST["indirizzoSU"];
    $civico = $_POST["civicoSU"];
    $dataNascita = $_POST["dataNascitaSU"]; 
    $email = $_POST["emailSU"] . "@studenti.uniroma1.it";
    $pass = $_POST["pass1SU"];

    //query per ricercare eventuale mail gia presente nel DB
    $query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    
    //Eseguo la query
    $result = pg_query($query) or die('Query failed: ' . pg_last_error());
    if ($result){
      $values = array("nome" => $nome, "cognome" => $cognome, "indirizzo" => $indirizzo, "civico" => $civico, "datanascita" => $dataNascita, "email" => $email, "password" => $pass);
      if(pg_insert($db, "users", $values)){
        $_SESSION['successReg'] = 'Benvenuto su RentACar.com, accedi per continuare!';
      } else {
        $_SESSION['errorReg'] = 'Mail gia in uso o errore generale, riprova!';
      }
    }
    pg_close($db);
    session_write_close();
    header("location: ./index.php");
  }
?>