<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width">
	<style>
		.Cuadro
		{
			height:10%; 
			width:100%;
			font-size: 20px; 
			line-height: 20px;
			text-align: center;
			/*overflow:auto; */
			float: center;
		}
		.Cuadroimagen
		{
			width:100%; 
			height:50%;
			float: center;
		}
		.Cuadroicono
		{
			width:50%; 
			height:50%;
			float: left;
		}
		.Cuadro3
		{
			height:40%; 
			width:100%;
			font-size: 20px; 
			line-height: 20px;
			float: center;
			text-align: center;
		}
		.botonGato
		{
			height: 20px;
			width: 20px;
		}
		.CuadroA1
		{
			font-size: 40px; 
			height:80px;
			border-right:2px solid gray;
			border-bottom: 2px solid gray;
			text-align: center;
			float: center;
		}
		.CuadroA2
		{
			font-size: 40px; 
			height:80px;
			border-bottom: 2px solid gray;
			text-align: center;
			float: center;
		}
		.CuadroA3
		{
			font-size: 40px; 
			height:80px;
			border-right: 2px solid gray;
			text-align: center;
			float: center;
		}
		.CuadroA4
		{
			font-size: 40px; 
			height:80px;
			text-align: center;
			float: center;
		}		
		.CuadroLimpiar
		{
			font-size: 40px; 
			height:80px;
			text-align: center;
			float: center;
		}		
	</style>
	<title></title>
	<link rel="stylesheet" href="css/jquery.mobile-1.4.5.css"/>
  	<script type ="text/javascript" src="js/jquery-1.11.1.js"></script>
	<script type ="text/javascript" src="js/jquery.mobile-1.4.5.js"></script>

	<script type="text/javascript">
		$(document).ready(function(){
			$.mobile.defaultPageTransition="slide";
			var turno = 1;
			var player = 1;
			var contadorJ1 = 0;
			var contadorJ2 = 0;
			var contadorEm = 0;
			$("#lblJugador").html("Jugador 1");
			$("#li_Jugador1").html("Jugador 1    " + contadorJ1 + " Juegos");
			$("#li_Jugador2").html("Jugador 2    " + contadorJ2 + " Juegos");
			$("#li_Empates").html(contadorEm + "    Empates");

			$(".CuadroA1,.CuadroA2,.CuadroA3,.CuadroA4").click(function(event)
				{
					if($(this).html()=="")
					{
						if(turno == 1){
							$(this).html("X");
							$("#lblJugador").html("Jugador 2");
							player = 1;
							$("div",this).animate({opacity: 1},1500);
							turno=0;
						}else{
							$(this).html("O");
							$("#lblJugador").html("Jugador 1");
							$("div",this).animate({opacity: 1},1500);
							turno=1;
							player = 2;
						}
						$id=$(this).html();
						Evaluar($id,player);
					}
					else
					{
						alert("Casilla ocupada");
					}
				}
			);

			function Evaluar(opcion,jugadorid)
			{
				if(
						($("#A1").html()==opcion&&$("#A2").html()==opcion&&$("#A3").html()==opcion)||
						($("#B1").html()==opcion&&$("#B2").html()==opcion&&$("#B3").html()==opcion)||
						($("#C1").html()==opcion&&$("#C2").html()==opcion&&$("#C3").html()==opcion)||
						($("#A1").html()==opcion&&$("#B1").html()==opcion&&$("#C1").html()==opcion)||
						($("#A2").html()==opcion&&$("#B2").html()==opcion&&$("#C2").html()==opcion)||
						($("#A3").html()==opcion&&$("#B3").html()==opcion&&$("#C3").html()==opcion)||
						($("#A1").html()==opcion&&$("#B2").html()==opcion&&$("#C3").html()==opcion)||
						($("#A3").html()==opcion&&$("#B2").html()==opcion&&$("#C1").html()==opcion)
					)
				{
					if(jugadorid == 1)
					{
						contadorJ1 += 1;
						$("#li_Jugador1").html("Jugador 1    " + contadorJ1 + " Juegos");
					}
					else
					{
						contadorJ2 += 1;
						$("#li_Jugador2").html("Jugador 2    " + contadorJ2 + " Juegos");
					}
					$("#divGanador").html("Jugador " + jugadorid +  " con " + opcion);
					$.mobile.changePage( "#ganador", { transition: "slideup", changeHash: true });
					//alert("Ganó Jugador " + jugadorid);
					LimpiarGato();
				}
				else
				{
					if(
							($("#A1").html()!=""&&$("#A2").html()!=""&&$("#A3").html()!="")&&
							($("#B1").html()!=""&&$("#B2").html()!=""&&$("#B3").html()!="")&&
							($("#C1").html()!=""&&$("#C2").html()!=""&&$("#C3").html()!="")&&
							($("#A1").html()!=""&&$("#B1").html()!=""&&$("#C1").html()!="")&&
							($("#A2").html()!=""&&$("#B2").html()!=""&&$("#C2").html()!="")&&
							($("#A3").html()!=""&&$("#B3").html()!=""&&$("#C3").html()!="")&&
							($("#A1").html()!=""&&$("#B2").html()!=""&&$("#C3").html()!="")&&
							($("#A3").html()!=""&&$("#B2").html()!=""&&$("#C1").html()!="")
						)
					{
						contadorEm += 1;
						$("#li_Empates").html(contadorEm + "    Empates");
						$("#divGanador").html("Empate!");
						$.mobile.changePage( "#ganador", { transition: "slideup", changeHash: true });
						//alert("Ganó Jugador " + jugadorid);
						LimpiarGato();
					}
				}
			}

			$( document ).on( "pageshow", "#juego", function( event ) {
				LimpiarGato();
			});

			$("#divLimpiar").click(function(event)
				{
					var res = confirm("¿Está seguro(a) de limpiar el juego?");
					if (res == true) {
						LimpiarGato();
					}
					$("#panelConfiguracion").panel("close");
				}
			);

			function LimpiarGato()
			{
				$(".CuadroA1,.CuadroA2,.CuadroA3,.CuadroA4").html("");
				turno = 1;
				player = 1;
				$("#lblJugador").html("Jugador 1");					
			}

		});
	</script>
</head>
<body>
	<section id="principal" data-role="page">
		<header data-role="header">
			<h1>GATO</h1>
		</header><!-- /header -->
		<article data-role="content">
			<div class="Cuadro"><p>Juego del</p></div>
			<div class="Cuadroimagen" align="center">
				<img src="css/images/images-5.jpeg">
			</div>
			<div class="Cuadro"><p>Da clic en <font color="Blue">Jugar</font> para comenzar</p></div>
		</article><!-- /content -->
		<footer data-role="footer" data-position="fixed">
			<div data-role="navbar">
			    <ul>
					<li> <a href="#juego" class="ui-btn-active" data-icon="grid">Jugar</a></li>
					<li> <a href="#info" data-icon="info">Informacion</a></li>
			    </ul>
			</div><!-- /navbar -->
		</footer><!-- /footer -->
	</section><!-- /page -->

	<section id="juego" data-role="page">
		<div data-role="panel" id="opanelMarcador" data-position="left" data-display="push">
			<ul data-role="listview">
				<li>Marcador</li>
				<li></li>
				<li id="li_Jugador1">Jugador 1</li>
				<li id="li_Jugador2">Jugador 2</li>
				<li></li>
				<li id="li_Empates">Empates</li>
			</ul>
		</div>
		<div data-role="panel" id="panelConfiguracion" data-position="right" data-display="push">
			<div class="Cuadroicono" align="center">
				<div>Limpiar Juego</div>
			</div>
			<div class="Cuadroicono" align="center" id="divLimpiar">
				<img src="css/images/descarga.jpeg">
			</div>
		</div>
		<header data-role="header">
			<a href="#opanelMarcador" class="ui-btn-active" data-icon="star">Marcador</a>
			<h1>GATO</h1>
			<a href="#panelConfiguracion" class="ui-btn-active" data-icon="gear">Config.</a>
		</header><!-- /header -->
		<article data-role="content">
			<div class="Cuadro3"><div id="lblJugador" class="Cuadro">Jugador</div>
			<div class="ui-grid-b">
				<div class="ui-block-a"><div class="CuadroA1" id="A1"></div></div>
				<div class="ui-block-b"><div class="CuadroA1" id="A2"></div></div>
				<div class="ui-block-c"><div class="CuadroA2" id="A3"></div></div>
			</div>
			<div class="ui-grid-b">
				<div class="ui-block-a"><div class="CuadroA1" id="B1"></div></div>
				<div class="ui-block-b"><div class="CuadroA1" id="B2"></div></div>
				<div class="ui-block-c"><div class="CuadroA2" id="B3"></div></div>
			</div>
			<div class="ui-grid-b">
				<div class="ui-block-a"><div class="CuadroA3" id="C1"></div></div>
				<div class="ui-block-b"><div class="CuadroA3" id="C2"></div></div>
				<div class="ui-block-c"><div class="CuadroA4" id="C3"></div></div>
			</div>
		</article><!-- /content -->
		<footer data-role="footer" data-position="fixed">
			<div data-role="navbar">
			    <ul>
					<li> <a href="#principal" class="ui-btn-active" data-icon="home">Regresar</a></li>
			    </ul>
			</div><!-- /navbar -->
		</footer><!-- /footer -->
	</section><!-- /page -->

	<section id="ganador" data-role="page" data-dialog="true">
		<header data-role="header">
			<h1>GANADOR</h1>
		</header><!-- /header -->
		<article data-role="content">
			<div id="divGanador">Jugador</div>
		</article><!-- /content -->
		<footer data-role="footer" data-position="fixed">
		</footer><!-- /footer -->
	</section><!-- /page -->

</body>
</html>