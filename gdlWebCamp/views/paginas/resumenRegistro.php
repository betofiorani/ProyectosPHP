<h2>Resumen Registro</h2>
<?php
    if($resultado === 'completed'){
        echo "<div class='resultado correcto'>";
        echo "<p>Pago Exitoso</p>";
        
        echo "<p>el ID del pago es {$paymentId}</p>";
        echo "</div>";
    } else {
        echo "<div class='resultado fracaso'>";
        echo "<p>Algo salió Mal</p>";
        echo "</div>";
    } 
?>
       