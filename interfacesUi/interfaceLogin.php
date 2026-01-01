<?php
session_start();
require_once "header.php";
if(isset($_POST['submit'])){
if($_POST['role'] === "admin"){
    header("location:adminDash.php");
    $_SESSION['role'] = "admin";
}elseif($_POST['role']  === "journaliste"){
    header("location:journaliste.php");
    $_SESSION['role'] = "journaliste";
}else{
    header("location:visiteur.php");
    $_SESSION['role'] = "visiteur";
}

}

?>

<!-- MAIN -->
<div class="wrapper">
    <div class="card">
        <h2>Choisir le mode d’accès</h2>
        <p>Sélectionnez votre rôle pour entrer dans la plateforme</p>

        <form action="#" method="post">
            <div class="role-box">
                <label class="role-option">
                    <input type="radio" name="role" value="admin" required>
                    Administrateur
                </label>

                <label class="role-option">
                    <input type="radio" name="role" value="journaliste">
                    Journaliste
                </label>

                <label class="role-option">
                    <input type="radio" name="role" value="visiteur">
                    Visiteur
                </label>
            </div>

            <button type="submit" name = "submit">Entrer</button>
        </form>
    </div>
</div>

<?php
require_once "footer.php";
?>
