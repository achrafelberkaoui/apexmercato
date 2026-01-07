<?php
session_start();
require_once "../autloading/Autloading.php";

use Bd\BaseDonne;
use Heritage\Coach;

if (!isset($_SESSION['role']) || $_SESSION['role'] !== "admin") {
    header("Location: interfaceLogin.php");
    exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID manquant");
}

$id = intval($_GET['id']);

$con = BaseDonne::database();

$coach = new Coach($con, null, null, null, null, null, null);

if ($coach->delete($id)) {
    $_SESSION['msg'] = "coach a ete supprime";
    header("Location: adminDash.php");
    exit;
} else {
    echo "Erreur la suppression du coach";
}
