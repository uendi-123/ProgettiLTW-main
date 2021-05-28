<?php
    session_start();
    $marchioNome =  $_POST['marchioNome'];

    if(isset($_SESSION["sessionAuto"][$marchioNome])){
        $autoValue = $_SESSION["sessionAuto"][$marchioNome];
        //Connetto al DB, se errore chiama die(...)
        $db = pg_connect("host=localhost port=5432 dbname=userDB user=postgres password=password") or die("Could not connect: " . pg_last_error());
        //Esegue la query
        $result = pg_query($db, "insert into ordini(iduser, idcar, citta, datada, dataa)
                       values(". $_SESSION["user"]["idUser"] .", ". $autoValue["idcar"] .", '". $_SESSION["cittaNoleggio"] ."', '". $_SESSION["dataDa"] ."', '". $_SESSION["dataA"] ."');");
        //Controlla che l'esecuzione della query sia andata a buon fine, altrimenti orderError sara mostrato.
        if($result){
            $_SESSION["orderOK"] = "Grazie per averci scelto, ordine confermato: </br>
            <b>Utente</b>: " . $_SESSION["user"]["nome"] . " " . $_SESSION["user"]["cognome"] . " </br>
            <b>Auto</b>: " . $autoValue["marchio"] . " " . $autoValue["nome"] . " </br>
            <b>Citta</b>: " . $_SESSION["cittaNoleggio"] . " </br>
            <b>Inizio Noleggio</b>: " . $_SESSION["dataDa"] . " </br>
            <b>Fine Noleggio</b>: " . $_SESSION["dataA"] . " </br>
            <p class='px-0 mx-0 mt-2'>Troverai questo resoconto nella tua sezione 'I miei Ordini' nella NavBar.</p>"; 
        } else {
            $_SESSION["orderError"] = "Qualcosa e' andato storto, ordine non inserito!";
        }
    } else {
        // Dovrei mettere un msg di errore
        $_SESSION["orderError"] = "Qualcosa e' andato storto, ordine non inserito! " . 
json_encode($_SESSION["sessionAuto"][$marchioNome]) . "marchio: " . $marchio . " nome: " . $nome;
    }
    pg_close($db);
    session_write_close();
?>