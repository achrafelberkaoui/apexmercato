<?php
require_once "header.php";
require_once "../bd/baseDonne.php";
require_once "../heritage/player.php";

$errors = [];
if(isset($_POST['submit'])){
if(empty(trim($_POST['name']))){
    $errors['name'] = "Veuillez entrer Pseudo de Joueur";
}else{
    $name = trim($_POST['name']);
}
if(empty(trim($_POST['email']))){
    $errors['email'] = "Veuillez entrer email de Joueur";
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

    if(empty($_POST['role'])){
        $errors['role'] = "Veuillez choisir le rôle";
    }else{
        $role = $_POST['role'];
    }

    if(empty($_POST['valeur_marches']) || $_POST['valeur_marches'] <= 0){
        $errors['valeur_marches'] = "Veuillez entrer une valeur valide";
    }else{
        $valeur = $_POST['valeur_marches'];
    }

    $id_equip = $_POST['id_equip'];



    if(empty($errors)){
    $data = [
        "name" => $name,
        "email" => $email,
        "nationalite" => $nationalite,
        "role" => $role,
        "valeur_marches" => $valeur,
        "equipe_id" => $id_equip
    ];

        $jouer = new Player($con, $name, $email,  $nationalite, $role, $valeur,$id_equip);
            if(!$jouer->equipeExists($id_equip)){
            echo "aucun equipe id";
            exit;
            }


        $jouer->creatNew($data);
        echo "<p style='color:green'>Joueur ajoutée avec succès</p>";
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
    <h2>Ajouter un Joueur</h2>
    <form action="ajouteJou.php" id="addPlayerForm" method= "POST">
        <label>Pseudo :</label>
        <input type="text" name="name" required>
        <label>Email :</label>
        <input type="email" name="email" required>

        <label>Rôle :</label>
        <select name="role" required>
            <option value="">Sélectionner le rôle</option>
            <option value="Top">Top</option>
            <option value="Jungle">Jungle</option>
            <option value="Mid">Mid</option>
            <option value="ADC">ADC</option>
            <option value="Support">Support</option>
        </select>

        <label>Nationalité :</label>
        <input type="text" name="nationalite" required>
        
        <label>Id Equipe :</label>
        <input type="number" name="id_equip" required>

        <label>Valeur Marchande (€) :</label>
        <input type="number" name="valeur_marches" required>

        <button type="submit" name="submit">Ajouter Joueur</button>
    </form>


</div>

<?php
require_once "footer.php";
?>
