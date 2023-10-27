<?php

// MODIFICAR NUMEROS DESPUES DE extract_bolas_bombo
	function buscar_numero_en_jugador(&$jugadores_aciertos, $jugadores, $nombre, $num){
			
			$canto_bingo = false;
			
			for($cartones = 0; $cartones < 3; $cartones++){
				// 8# Busco X numero del bolo en la cartulina Y de los jugadores Z. Si encuentra el número, el índice lo indicará
				$indice = array_search($num, $jugadores[$nombre][$cartones]);
				if($indice !== false){
					// 9# Mientras que el índice no retorne un boolean False, entro en la condición
						$jugadores_aciertos[$nombre][$cartones][$indice] = "X";
							
							// 10# Si un jugador llegase a tener en un cartón 15 marcas de X (aciertos), entonces canta bingo
							if(array_count_values($jugadores_aciertos[$nombre][$cartones])["X"] == 15){
								echo "<br>".$nombre." cantó bingo en el cartón ".$cartones."!<br>";
								return 1; // Bingo !
							}
				}
				
			}
			
			
			return 0;
		}
		
		
		
		
		function extract_bolas_bombo($jugadores, $jugadores_aciertos){
			$cantidad_jugadores = count($jugadores);
			$cantar_bingo = false;
			
			// 5# Creo los numeros y altero aleatoriamente sus posiciones
			$bombo = range(1,60);
			shuffle($bombo);
			
			for($i=0; $i<count($bombo); $i++){
				$numero = $bombo[$i];
				
				// Muestra las bolas
				echo "<img src='images/".$numero.".png'/>";
				
				
				// 6# Saco un número del bombo y a la vez muestro la imagen de dicho número en pantalla.
				
				for($jugador=0; $jugador < $cantidad_jugadores; $jugador++){
					$nombre_jugador = "jugador".$jugador;
					if(buscar_numero_en_jugador($jugadores_aciertos, $jugadores, $nombre_jugador,$numero)){
						
						// 7# Cada numero que saco, llevo a comparar a las cartulinas del jugadorX.
						// Si retorna 1, dicho jugador dió BINGO
						$cantar_bingo = true;
					}
				}
			}
			if(!$cantar_bingo){
				echo "Nadie cantó bingo ;(";
			}
			
		}
		
		
		
		
		function crear_jugadores_y_cartones($cantidad_jugadores, &$jugadores_aciertos){
			$jugadores; // [JUGADOR] [CARTON] [NUMEROS]
			$valores = range(1,60);
			
			for($jugador=0; $jugador<$cantidad_jugadores; $jugador++){
				
				for($carton=0; $carton<3; $carton++){
					
					$cont = 0;
					shuffle($valores);
					
							for($numero=0; $numero<15; $numero++){
								
								// 3# Añadimos por cada jugador, 3 cartones y cada uno tendrá 15 numeros sin repetir
								$numero_aleatorio = $valores[$cont];
								$cont++;
								
								
								//Se puede repetir X numero en diferentes cartones, pero no en el mismo
								$jugadores["jugador".$jugador][$carton][$numero] = $numero_aleatorio;
								$jugadores_aciertos["jugador".$jugador][$carton][$numero] = "-"; // - indica numero no acertadoo, y X indica acertado
							}
				}
			}
			
			
			return $jugadores;
		}
?>