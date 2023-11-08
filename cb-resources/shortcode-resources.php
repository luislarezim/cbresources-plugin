<?php
function cb_resources_shortcode() {
    ob_start(); // Inicia el almacenamiento en buffer.
    include 'includes/resources-filter-template.php'; // Asegúrate de que esta ruta esté bien.
    return ob_get_clean(); // Devuelve el contenido del buffer y limpia el buffer.
}
add_shortcode('cb-resources', 'cb_resources_shortcode');

?>
