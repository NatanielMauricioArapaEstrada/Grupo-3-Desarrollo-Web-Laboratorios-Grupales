<?php
if ($_SESSION["nivel"]==1)
{
    echo "usted no esta autorizado a realizar esta operación";
    ?>
    <?php
    die();
}
?>