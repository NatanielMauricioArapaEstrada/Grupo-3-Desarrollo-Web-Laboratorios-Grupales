<?php
if (!isset($_SESSION["correo"]))
{
    echo "acceso no autorizado"
    ?>
    <meta http-equiv="refresh" content="2;url=login.html">
    <?php
    die();
}
?>