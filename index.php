<html>
	<body>
		<?php
		
			// 1# Indico cuántos jugadores participarán
			$cantidad_jugadores = 4;
			
			// 2# Creo cada jugador con sus respectivos cartones
			crear_jugadores_y_cartones();
			
			// 4# Creo el bombo y extraigo las bolas
			extract_bolas_bombo();
			
			
			
			
			
		// MODIFICAR NUMEROS DESPUES DE extract_bolas_bombo
		function buscar_numero_en_jugador($nombre, $num){
			
			global $jugadores;
			
			for($cartones = 1; $cartones <= 3; $cartones++){
				// 8# Busco X numero del bolo en la cartulina de los jugadores
				$indice = array_search($num, $jugadores[$nombre][$cartones]);
				if($indice !== false){
					//echo $nombre." tiene el numero ".$num." en el indice ".$indice;
					//echo "<br>";
					//print_r ($jugadores[$nombre][$cartones]);
					// 9# Si dicho valor coincide dentro de Y cartulina, lo eliminamos
						unset($jugadores[$nombre][$cartones][$indice]);
						$jugadores[$nombre][$cartones] = array_values($jugadores[$nombre][$cartones]);
							
							// 10# Si un jugador llegase a tener un cartón de tamaño 0, sería BINGO
							if(count($jugadores[$nombre][$cartones]) <= 0){
								return 1;	// 10# Retorna 1 al haber elimniado todos sus numeros un cartón
							}
					//echo "<br>";
					//echo "<br>";
					//echo "<br>";
				}
			}
			return 0;
		}
		
		function extract_bolas_bombo(){
			global $cantidad_jugadores;
			$cantar_bingo = false;
			
			// 5# Altero aleatoriamente la posición de los numeros
			$bombo = range(1,60);
			shuffle($bombo);
			
			do{
				$numero = $bombo[0];
				unset($bombo[0]);
				$bombo = array_values($bombo);
				
				// Muestra las bolas con "algo" de estética
				echo "<img src='images/".$numero.".png'/>";
				
				
				// 6# Saco un numero del bombo. Se queda un hueco, asigno cada uno de los valores al mismo array para
				// llenar huecos
				
				for($jugador=1; $jugador <= $cantidad_jugadores; $jugador++){
					$nombre_jugador = "jugador".$jugador;
					if(buscar_numero_en_jugador($nombre_jugador,$numero)){
						
						// 7# Cada numero que saco, llevo a comparar a las cartulinas del jugadorX.
						// Si retorna 1, dicho jugador dió BINGO
						$cantar_bingo = true;
						echo $nombre_jugador." CANTÓ BINGOOOOO !!!!!!!";
						break 2; // Me salgo de 2 loops, del FOR y del DO_WHILE
					}
				}
			}while(count($bombo) > 0);
			
			
			
			if(!$cantar_bingo){
				echo "Nadie cantó bingo ;(";
			}
		}
		
		function crear_jugadores_y_cartones(){
			global $cantidad_jugadores;
			global $jugadores; // [JUGADOR] [CARTON] [NUMEROS]
			
			for($jugador=1; $jugador<=$cantidad_jugadores; $jugador++){
				
				for($carton=1; $carton<=3; $carton++){
					
					for($numero=1; $numero<=15; $numero++){
						
						// 3# Añadimos por cada jugador, 3 cartones y cada uno tendrá 15 numeros
						$numero_aleatorio = rand(0,60);
						// SEGUIR -> Se puede repetir X numero en diferentes cartones, pero no en el mismo
						$jugadores["jugador".$jugador][$carton][$numero] = $numero_aleatorio;
						
					}
				}
			}
		}
			
		?>
	</body>
</html>