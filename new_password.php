<?php require_once 'includes/header_password.php'?>




    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    
                                    <div class="card-header">
                                    <?php if(isset($message)) echo $message?>    
                                    <h4 class="text-center font-weight-light my-4">Veuillez choisir un nouveau mot de passe</h4></div>
                                    <div class="card-body">
                                        
                                        <form action="new_password.php" method="post">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" type="email" name="password" />
                                                <label for="inputEmail">Mot de passe</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" type="email" name="confir_password" />
                                                <label for="inputEmail">Confirmation mot de passe</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="login.php">Connexion</a>
                                                <input type="submit" name="forget_password" class="btn btn-primary" value="Valider">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
<?php require_once 'includes/footer.php'?>
