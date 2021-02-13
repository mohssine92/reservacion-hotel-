<?php

session_destroy();    /* => destruir variables session y rederriccina a pagina princiapal */

echo '<script>

window.location= "'.$ruta.'";

</script>';


