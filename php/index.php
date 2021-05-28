<?php 
    session_start();
    //Salvo sulla session la pagina corrente cosi da poterci tornare in caso di login da tale pagina
    $_SESSION['currentPage'] = 'index.php';

    unset($_SESSION['sessionAuto']);

    //Stampa la var $_SESSION (debug purpose)
    // echo '<pre>';
    // var_dump($_SESSION);
    // echo '</pre>';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>RentACar.com</title>

        <!-- JS Files -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" integrity="sha512-RXf+QSDCUQs5uwRKaDoXt55jygZZm2V++WUZduaU/Ui/9EGp3f/2KZVahFZBKGH0s774sd3HmrhUy+SgOFQLVQ==" crossorigin="anonymous"></script>
        
        <!-- CSS Files -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" />        
        <!-- My CSS and JS FILES -->
        <link href="../css/style.css" rel="stylesheet">
        <script src="../js/main.js"></script>
    </head>
    <body class="bg-dark text-light">
        <!-- NavBar -->
        <nav class="navbar navbar-dark bg-dark border border-0 border-bottom border-3 border-light">
            <div class="container-fluid pe-2">
                <a class="navbar-brand fs-2 logo text-center mx-0 px-0" href="index.php">RentACar.com</a>
                <!-- <div class="col-auto"></div>
                <div class="col-auto"> -->
                    <div class="justify-content-end d-inline-flex btn-group me-1">
                        <?php
                            if(!isset($_SESSION["user"])){
                                echo '<button class="btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#signUpModal">Sign up</button>';
                                echo '<button class="btn btn-outline-success" type="button" data-bs-toggle="modal" data-bs-target="#signInModal">Sign in</button>';
                            } else {
                                echo '<a class="btn btn-outline-danger" href="logout.php">Logout</a>';
                            }
                            //Post Registrazione
                            if(isset($_SESSION["errorReg"])){
                                destroySessionAndGoBack($_SESSION["errorReg"]);
                                unset($_SESSION["errorReg"]);
                            } else if(isset($_SESSION["successReg"])){
                                destroySessionAndGoBack($_SESSION["successReg"]);
                                unset($_SESSION["successReg"]);
                            }
                            //Post Login
                            if(isset($_SESSION["errorLogin"])){
                                destroySessionAndGoBack($_SESSION["errorLogin"]);
                                unset($_SESSION["errorLogin"]);
                            } else if(isset($_SESSION['successLogin'])){
                                echo "<script>alert('" . $_SESSION['successLogin'] . "')</script>";
                                unset($_SESSION["successLogin"]);
                            }
                        ?>
                    <!-- </div> -->
                    <button class="btn btn-outline-secondary navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>

                <!-- Parte collapse della NavBar -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Elementi della NavBar -->
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-inline-flex">
                        <li class="nav-item text-dark">
                            <a class="nav-link" href="#">I miei ordini</a>
                        </li>
                        <li class="nav-item text-dark">
                            <a class="nav-link" href="#">Il mio profilo</a>
                        </li>
                    </ul>
                </div>

                <?php 
                    if(isset($_SESSION['orderOK']) || isset($_SESSION['orderError'])){
                        if(isset($_SESSION['orderOK'])){
                            echo "<script>
                                $(document).ready(function(){
                                    $('#msgModal').modal('show');
                                });
                              </script>";
                        } else if(isset($_SESSION['orderError'])){
                            echo "<script>
                                $(document).ready(function(){
                                    $('#msgModal').modal('show');
                                });
                              </script>";
                        }
                        
                    }
                ?>
                <!-- Modal Msg -->
                <div class="modal" id="msgModal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">
                                <?php 
                                    if(isset($_SESSION["orderOK"])) echo '<p class="mx-0 text-success">Conferma Ordine</p>';
                                    if(isset($_SESSION["orderError"])) echo '<p class="mx-0 text-danger">Errore!</p>';
                                ?>
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-dark">
                                <?php 
                                    //Post Ordine
                                    if(isset($_SESSION["orderOK"])){
                                        echo $_SESSION['orderOK'];
                                        unset($_SESSION["orderOK"]);
                                    } else if(isset($_SESSION["orderError"])){
                                        echo $_SESSION['orderError'];
                                        unset($_SESSION["orderError"]);
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Sign Up --> 
                <div class="modal fade text-dark" id="signUpModal" tabindex="-2" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content border border-3 border-primary rounded-3">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Continua per registrarti!</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form id="SignUpForm" class="needs-validation" method="POST" action="../php/signUp.php" novalidate>
                                <div class="modal-body pt-1">
                                    <div class="row">
                                        <div class="col-sm">
                                            <label for="inputNome">Nome</label>
                                            <input type="text" name="nomeSU" class="form-control" id="inputNome">
                                        </div>
                                        <div class="col-sm">
                                            <label for="inputCognome">Cognome</label>
                                            <input type="text" name="cognomeSU" class="form-control" id="inputCognome">
                                        </div>
                                    </div>
                                    <div class="row mt-1">
                                        <div class="col-sm-9">
                                            <label for="inputIndirizzo">Indirizzo Via/Viale</label>
                                            <input type="text" name="indirizzoSU" class="form-control" id="inputIndirizzo">
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="inputCivico">N° Civico</label>
                                            <input type="text" name="civicoSU" class="form-control" id="inputCivico">
                                        </div>
                                    </div>
                                    <div class="row mt-1">
                                        <label for="inputNascita">Data Nascita</label>
                                        <div class="col input-group">
                                            <input type="text" name="dataNascitaSU" class="form-control" id="inputNascita" readonly title="format: dd/MM/y">
                                            <button class="btn btn-outline-secondary rounded-0 rounded-end input-group-text" type="button" id="signUpNascitaBtn">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                                                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                                            </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <label for="inputEmail" class="pt-0">Email</label>
                                        <div class="col input-group">
                                            <input type="text" id="inputEmail" class="form-control" name="emailSU" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                            <span class="input-group-text" id="basic-addon2">@studenti.uniroma1.it</span>
                                        </div>
                                    </div>
                                    <div class="row mt-1">
                                        <div class="col form-group">
                                            <label for="inputPasswordSignUpModal" class="col-sm col-form-label">Password</label>
                                            <div class="col input-group">
                                                <input type="password" class="form-control" id="inputPassSignUpModal" name="pass1SU">
                                                <button type="button" class="input-group-text" id="showHideBtnSignUp">
                                                    <svg xmlns="http://www.w3.org/2000/svg" id="hidePassIconSignUp" width="16" height="16" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16">
                                                        <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"/>
                                                        <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"/>
                                                        <path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z"/>
                                                    </svg>
                                                    <svg xmlns="http://www.w3.org/2000/svg" id="showPassIconSignUp" style="display: none;" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="col form-group">
                                            <label for="inputConfirmPasswordSignUpModal" class="col-sm col-form-label">Conferma Password</label>
                                            <div class="col input-group">
                                                <input type="password" class="form-control is-invalid" id="inputConfirmPassSignUpModal" name="pass2SU">
                                                <button type="button" class="input-group-text" id="showHideConfirmBtnSignUp">
                                                    <svg xmlns="http://www.w3.org/2000/svg" id="hideConfirmPassIconSignUp" width="16" height="16" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16">
                                                        <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"/>
                                                        <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"/>
                                                        <path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z"/>
                                                    </svg>
                                                    <svg xmlns="http://www.w3.org/2000/svg" id="showConfirmPassIconSignUp" style="display: none;" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                                    </svg>
                                                </button>
                                                <div class="invalid-feedback">
                                                    Le password non coincidono
                                                  </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer mt-1">
                                    <button id="SignUpSubmit" type="submit" class="btn btn-outline-primary" name="reg_user" onsubmit="if(checkSubmitSignUp())">Invio</button>
                                </div>
                            </form>
                        </div>
                    <!-- Modal Dialog -->
                    </div>
                <!-- Modal -->
                </div>
                
                <!-- Modal Sign In --> 
                <div class="modal fade text-dark" id="signInModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content border border-3 border-success rounded-3">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Continua per accedere!</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form id="signInForm" class="needs-validation" method="POST" action="../php/signIn.php" novalidate>
                                <div class="modal-body pt-0">
                                    <div class="row mb-1">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                                      <div class="col-sm-10 input-group">
                                        <input type="email" class="form-control" id="inputEmailSignIn" name="emailSI" aria-describedby="basic-addon2" required>
                                        <span class="input-group-text" id="basic-addon2">@studenti.uniroma1.it</span>
                                      </div>
                                    </div>
                                    <div class="row mb-3 form-group">
                                        <label for="inputPasswordSignInModal" class="col-sm-2 col-form-label">Password</label>
                                      <div class="col-sm-10 input-group">
                                        <input type="password" class="form-control" id="inputPassSignIn" name="passSI" required>
                                        <button type="button" class="input-group-text" id="showHideBtnSignIn">
                                            <svg xmlns="http://www.w3.org/2000/svg" id="hidePassIconSignIn" width="16" height="16" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16">
                                                <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"/>
                                                <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"/>
                                                <path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z"/>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" id="showPassIconSignIn" style="display: none;" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                            </svg>
                                        </button>
                                      </div>
                                    </div>
                                    <!-- <div class="col-10">
                                        <div class="form-check">
                                          <input class="form-check-input" type="checkbox" id="gridCheck">
                                          <label class="form-check-label" for="gridCheck">Remember me</label>
                                        </div>
                                    </div>-->
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-outline-success" id="submitBtn" name='login_user' onsubmit="checkSubmitSignUp()">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main div, comprende form per ricerca auto da noleggiare e Row delle card -->
        <div id="mainDiv" class="container">
            <!-- Box Ricerca -->
            <div class="row mx-lg-1 mx-md-1">
                <div class="col-6 container searchDiv mt-4 px-3 pb-3 pt-3">
                    <form action="../php/rentCatalogPage.php" method="POST" class="needs-validation" id="noleggioForm">
                        <div class="h2 row mb-2">
                            <p class="text-center text-light">Noleggiami! <br> Tutto piu semplice con RentACar.com</p>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <input type="text" class="form-control" name="cittaNoleggio" placeholder="Inserisci Citta" id="inputCittaNoleggio">
                            </div>
                        </div>
                        <div class="row">
                            <label class="text-light text-center mb-3">Periodo Noleggio</label>
                        </div>
                        <!-- Riga Input Date -->
                        <div class="row mb-1">
                            <div class='col-lg-5 col-md-6 col-sm-6'>
                                <div class="input-group mb-2">
                                    <input id="dateStart" type="text" name="dataDa" class="form-control" placeholder="Data inizio noleggio" aria-label="Data inizio noleggio" aria-describedby="basic-addon2">
                                    <button class="btn btn-outline-secondary rounded-0 rounded-end input-group-text" type="button" id="calendarIconStart">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                                        </svg>
                                    </button>
                                </div>
                                <div class="invalid-feedback">
                                    Immettere periodo di tempo coerente!
                                </div>
                            </div>
                            <div class='col-lg-5 col-md-6 col-sm-6'>
                                <div class="input-group mb-3">
                                    <input id="dateEnd" type="text" name="dataA" class="form-control date" placeholder="Data fine noleggio" aria-label="Data fine noleggio" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary rounded-0 rounded-end input-group-text" type="button" id="calendarIconEnd">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                                                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-12 col-md-12">
                                <button id='noleggioSubmitBtn' class="btn btn-success btnToSpread" type="submit" disabled>Cerca</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Box 3 Cose AJAX -->
            <div class="row rowCards text-dark mt-2 px-0 mx-lg-1 mx-md-1 justify-content-lg-center justify-content-md-center">
                <div id="offerteDiv" class="col card normalCard border border-2 activeCard">
                    <span class="text-center fs-2 normalSpanCard activeSpanCard">Scopri i nostri prezzi!</span>
                </div>
                <div class="col card normalCard border border-2">
                    <span class="text-center fs-4 normalSpanCard">Perche scegliere noi?</span>
                </div>
                <div class="col card normalCard border border-2">
                    <span class="text-center fs-4 normalSpanCard">Offerte del mese!</span>
                </div>
            </div>

            <div id="dinamicDiv" class="dinamicDiv text-center text-light"></div>
        </div>
        
        <!-- Newsletter Div -->
        <div class="col col-sm container border border-success me-auto ms-auto mt-4 newsletterDiv text-center ">
            <h2 class="mb-4 textbreak text-light">Rimani Aggiornato!</h1>
            <label for="inputNewsletter " class="textbreaak fw-light text-light">Inserisci la tua mail per iscriverti alla newsletter di RentACar.com!</p>
            <div class="input-group" id="inputNewsletter">
                <input type="text" class="form-control" placeholder="" aria-label="Recipient's username" aria-describedby="basic-addon2">
                <span class="input-group-text" id="basic-addon2">@studenti.uniroma1.it</span>
            </div>
        </div>
    </body>    
</html>

<?php 
    function destroySessionAndGoBack($msg){
        $_SESSION = array();
        session_destroy();
        echo '<script>alert("'.$msg.'");</script>';
        session_start(); 
    }
?>