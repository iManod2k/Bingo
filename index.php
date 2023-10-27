<html>
	<body>
	
	
		<?php
		/*
		- variables globales NO													X
		- funciones en fichero aparte											X
		- gestión de aciertos (puede haber +1 BINGO en la misma persona)		X
		- que no se eliminen las bolas del bingo								X
		- puede haber mas de un canto BINGO										X
		- un numero X no puede repetirsre en los 3 cartones						X
		- re-organizar los pasos porque están desordenados -> SEGUIR POR EL 6# 	X
		*/
		
		require "funciones.php";
		
		
			// 1# Indico cuántos jugadores participarán
			$cantidad_jugadores = 4;
			
			// 2# Creo cada jugador con sus respectivos cartones
			$jugadores_aciertos;
			$jugadores = crear_jugadores_y_cartones($cantidad_jugadores,$jugadores_aciertos);
			
			// 4# Creo el bombo y extraigo las bolas
			extract_bolas_bombo($jugadores, $jugadores_aciertos);
			
			foreach($jugadores as $key => $value){
				echo "<br>";
				echo "<br>";
				print($key);
				print_r($value);
				echo "<br>";
			}
			
		?>
	</body>
</html>