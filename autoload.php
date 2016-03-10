<?php
function class_loader($class) {
    require('classes/' . $class . '.php');
}
spl_autoload_register('class_loader');
?>