<?php
session_start();
include "../config.php";
if (isset($_SESSION["id"])) {
    ?>
<h2>profile de <?php
echo $_SESSION["pseudo"];
?>
</h2>
<h3>votre adresse email est: <?php
echo $_SESSION["mail"];
?>
</h3>
<?php
$admin = "";
if ($_SESSION["admin"] == 1) {
    $admin = "administrateur";
} else {
    $admin = "membre";
}
?>
<p>vous avez un compte
<?php
echo $admin;
?>
</p>
<?php
}
  ?>

<a href="index.php">Retourner a la liste des articles</a>