<?php
if ($_SESSION["estado"]==0)
{
    echo "Cuenta desactivada";
    ?>
    <meta http-equiv="refresh" content="2;url=login.html">
    <?php
    die();
}
?>