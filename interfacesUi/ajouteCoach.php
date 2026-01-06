<?php
require_once "header.php";
use Heritage\Coach;
use Bd\BaseDonne;



$con = BaseDonne::database();
$errors = [];
if(isset($_POST['submit'])){
if(empty(trim($_POST['name']))){
    $errors['name'] = "Veuillez entrer name de coach";
}else{
    $name = trim($_POST['name']);
}
if(empty(trim($_POST['email']))){
    $errors['email'] = "Veuillez entrer email de coach";
}elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    $errors ['email']= "email no valide";
}else{
    $email = trim($_POST['email']);
}

if(empty(trim($_POST['nationalite']))){
    $errors['nationalite'] = "Veuillez entrer la nationalite de Joueur";
}else{
    $nationalite = trim($_POST['nationalite']);
}

    if(empty($_POST['style'])){
        $errors['style'] = "Veuillez choisir le style de coaching";
    }else{
        $style = $_POST['style'];
    }

    if(empty($_POST['experience']) || $_POST['experience'] <= 0){
        $errors['experience'] = "Veuillez entrer annees des experiences par mois";
    }else{
        $experience = $_POST['experience'];
    }

        $id_equip = $_POST['id_equip'];

    if(empty($errors)){
    $data = [
        "name" => $name,
        "email" => $email,
        "nationalite" => $nationalite,
        "style_coach" => $style,
        "annee_Experience" => $experience,
        "equipe_id" => $id_equip
    ];
        $coach = new Coach($con, $name, $email,  $nationalite, $experience, $style, $id_equip);
            if(!$coach->equipeExists($id_equip)){
            echo "aucun equipe id";
            exit;
            }

        $coach->creatNew($data);
        echo "<p style='color:green'>Coach ajoutée avec succès</p>";
        header("refresh:2, url=adminDash.php");
    }else{
        foreach ($errors as $err) {
             echo "<p style='color:red'>$err</p>";
            }
            exit;
    };
}
?>

<div class="form-container">
    <h2>Ajouter un Coach</h2>
    <form action="ajouteCoach.php" id="addCoachForm" method= "POST">
        <label>Nom :</label>
        <input type="text" name="name" required>

        <label>Style de Coaching :</label>
        <input type="text" name="style" required>
        
        <label>Email :</label>
        <input type="email" name="email" placeholder = "example@gmail.com" required>

        <label>Id Equipe :</label>
        <input type="number" name="id_equip" required>

        <label>Années d'expérience :</label>
        <input type="number" name="experience"  placeholder = "24 Mois" required>

        <label>Nationalité :</label>
        <input type="text" name="nationalite" required>

        <button type="submit" name = "submit">Ajouter Coach</button>
    </form>
</div>

<?php
require_once "footer.php";
?>