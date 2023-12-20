<?php
require_once 'includes/header_login.php';
?>

<?php
    if (isset($_POST['connexion'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        require_once 'includes/bdd.php';

        $requete = $bdd->prepare('SELECT * FROM webcms.utilisateurs WHERE email_utilisateur = :email');
        $requete->execute(array('email'=>$email));
        $result = $requete->fetch();

        if(!$result){
            $message = "Aucun compte associé à cette adresse email, merci de saisir une adresse valide !";
        }elseif($result['validattion_email_utilisateur'] == 0){
            //Generation du token
            require_once "includes/token.php";
            // Mise à jour du token
            $update = $bdd->prepare('UPDATE webcms.utilisateurs SET token_utilisateur = :token WHERE email_utilisateur=:email');
            $update->bindValue(':token', $token);
            $update->bindValue(':email', $_POST['email']);
            $update->execute();

            //Envoi de l'email de validation d'adresse
            require_once "includes/PHPMailer/sendmail.php";
            
        }else{
            // Verification de l'égalité entre les deux mots de passes
           $passwordIsOk = password_verify($_POST['password'], $result['password_utilisateur']);

           if($passwordIsOk){
                session_start();

                $_SESSION['id_utilisateur'] = $result['id_utilisateur'];
                $_SESSION['username'] = $result['username'];
                $_SESSION['email_utilisateur'] = $email;
                $_SESSION['role_uyilisateur'] = $result['role_utilisateur'];

                if(isset($_POST['sesouvenir'])){
                    setcookie("email", $_POST['email'], time()+3600*24*365);
                    setcookie('password', $_POST['password'], time()+3600*24*365);
                }else{
                    if (isset($_COOKIE['email'])) {
                        setcookie($_COOKIE['email'],"");
                    }
                    if (isset($_COOKIE['password'])) {
                        setcookie($_COOKIE['password'],"");
                    }
                }

                // Redirection à la page d'accueil(index.php)
                header('location:index.php');
            }else{
                $message = "Veuillez saisir un mot de passe valide";
            }
        }
        
    }
?>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                <?php if (isset($message)) echo $message;?>
                                    <h3 class="text-center font-weight-light my-4">Connexion</h3>
                                </div>
                                <div class="card-body">
                                    <form action="login.php" method="post">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputEmail" type="email" name="email" value="<?php if(isset($_COOKIE['email'])) echo $_COOKIE['email'];?>"/>
                                            <label for="inputEmail">Adresse Email</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputPassword" type="password" name="password" value="<?php if(isset($_COOKIE['password'])) echo $_COOKIE['password'];?>"/>
                                            <label for="inputPassword">Mot de passe</label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" name="sesouvenir"/>
                                            <label class="form-check-label" for="inputRememberPassword">Rester connecter</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small" href="password.php">Mot de passe oublié?</a>
                                            <input type="submit" name="connexion" value="Connexion" class="btn btn-primary" href="index.html">
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="register.php">Avez-vous besoin d'un compte? Enregistrez-vous!</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <?php
        require_once 'includes/footer.php';
        ?>
</body>

</html>