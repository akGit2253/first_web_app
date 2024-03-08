<?php
if (isset($_GET["aboudi"])) {
    if ($_GET["aboudi"] == "68feYRoHuSiD5Zw6QRMC6v7Ap8PPM167quQVJ20QPN0ZedoMcX") {

        include_once "head.php";

        include_once "header.php";

?>

        <main class="main">

            <?php

            include_once "menu.php";

            include_once "article.php";

            ?>

        </main>

<?php

        include_once "end_page.php";
    } else {
        header("location:../home");
    }
} else {
    header("location:../home");
}
?>