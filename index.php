<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Aguas | Con Tu Agua</title>
	<link rel="stylesheet" href="http://openlayers.org/en/v3.4.0/css/ol.css" type="text/css">
	<link href="css/bootstrap.min.css" type="text/css" rel="stylesheet" />
	<link href="css/uploadfile.css" rel="stylesheet" type="text/css"> 
	<link href="css/style.css" rel="stylesheet" type="text/css">
	<link href="css/lavish.css" rel="stylesheet" type="text/css">
	<script src="js/jquery-1.10.2.js"></script>
	<script src="js/jquery-ui-1.10.4.custom.min.js"></script>
	<script src="http://openlayers.org/en/v3.4.0/build/ol.js" type="text/javascript"></script>
	<script src="js/jquery.uploadfile.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/cargar_comentario.js"></script>
	<script src="js/registrar_cuestionario.js"></script>
	<script src="js/registra_deforestacion.js"></script>
	<style>
		#cargando{
			display:block;
		}
		.navbar-default {
			background-color:#085987;
		}
		.navbar-default .navbar-nav > li > a {
			color:#fff;
		}
		ul > li {
			background-color:#085987;
		}
	</style>
</head>	
<body>
						<!-- menu para pantallas medianas y grandes -->
	<nav class="navbar navbar-default hidden-xs hidden-sm">
	   	<div class="navbar-header">
	   		<a class="navbar-brand" href="#">
	   		<img alt="logo" src="images/_647112.png" width="50" class="logo">
	   		<p class="appli">!!Aguas!!<span> con tu agua.</span></p>
	   		</a>
	   	</div>
	   	<ul class="nav navbar-nav pull-right">
	   		<li><a id="maPrincip" href="#"><span class="glyphicon glyphicon-map-marker"></span><br />  Mapa</a></li> 
		    <li><a id="princiReport" href="#"><span class="glyphicon glyphicon-stats"><br />  Reportes</span></a></li> 
		</ul>
	</nav>
	<div class="container-fluid borderMenu hidden-xs hidden-sm"></div>
					<!-- menu para pantallas pequeñas -->
	<ul class="nav nav-tabs hidden-md hidden-lg"  style="margin-bottom: 20px; border-bottom-color:#fff;border-bottom-width:2px;">
	  	<li id="menuMapa"><a href="#" aria-controls="mapa" role="tab">Mapa</a></li>
	  	<li id="menuReport"><a href="#" aria-controls="reportes" role="tab">Reportes</a></li>
	</ul>
	<div class="container-fluid borderMenu hidden-md hidden-lg"></div>
		<div id="cargando" align="center"><p id="txtcargando" style="display:inline;"></p> <img src="images/ajax-loader.gif" width="20px"/></div>
	<div class="tab-content" style="position: relative;">
		<div role="tabpanel" class="tab-pane active container-fluid contenedor" id="mapa">
		    <div id="map" class="map"></div>
			    <a id="geolocation_marker" href="#"><img src="geolocation_marker.png" /></a>
			<div id="popup" title="Ubicación Actual"></div>
			<div id="popup2" title="Descripción de rio"></div>
		</div>
		<div role="tabpanel" class="tab-pane" id="reportes">
		  	<div class="row-fluid">
		  		<div class="col-xs-12 col-sm-12 col-md-12">
					<p align="center" style="font-size: 2rem; color:#f00;">COMUNIDAD (aportes)</p>
					<p align="center"><em>Puedes dejarnos tu comentario y colaborar reportando eventos de tu localidad.</em></p>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12">
					<button style="margin-top: 15px;" class="btn btn-default pull-right" data-toggle="modal" data-target="#formReport"> Agrega tu Comentario <span class="glyphicon glyphicon-plus"></span></button>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="panel panel-default" style="margin-top: 15px;">
						<div class="panel-body" id="panel_comentario">
					    
					 	</div>
					</div>
				</div>
			</div>
		  </div>
	</div>
	<!-- Modal formulario -->
	<div class="modal fade" id="formReport" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  	<div class="modal-dialog">
	    	<div class="modal-content">
			    <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color:#fff;">&times;</span></button>
			        <h4 class="modal-title" id="myModalLabel" align="center"> DANOS TU OPINION  <span class="glyphicon glyphicon-thumbs-up"></span></h4>
			    </div>
		    <div class="modal-body">
			    <div class="container-fluid">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
							<form>
								<div class="form-group">
									<label>Comentario <span class="glyphicon glyphicon-comment"></span> :</label>
								    <textarea id="comentario" class="form-control" rows="3" placeholder="Dejanos tu comentario aqui..........."></textarea>
								</div>
								<div class="form-group">
								  	<label>Fotografía <span class="glyphicon glyphicon-camera"></span> :</label>
									<div id="mulitplefileuploader">Cargar Imagen</div>
									<div id="status"></div>
							  	</div>
								<button type="submit" class="btn btn-primary pull-right" id="enviar">Enviar</button>
							</form>
						</div>
					</div>
				</div>
		 	</div>
		</div>
		</div>
	</div>
	<div id="popup1" style="display: none;"><div style="width:240px">Coordenadas: <span style="font-size:10px" id="corde1"></span><br/>Cuenca:<span id="nomcuenca"></span></div><div align="right"><a href="#" class="btn btn-primary" onclick="return evaluarCuenca()">Evaluar</a> <a href="#" class="btn btn-primary">Nacimiento de agua</a></div></div>
	<div><div id="popup-1" style="display:none;"><div style="width:200px"><p>Nombre:<span id="nomrio"></span>Contaminación: <span id="nivelconta">Media</span></p><a href="#" class="btn btn-primary" data-toggle="modal" onclick="return evaluarRio();">Evaluar</a></div></div></div>
	<script type="text/javascript" src="js/cargar.js"></script>
	<script type="text/javascript" src="js/registrar_comentario.js"></script>

	<!-- Modal formulario de deforestacion -->
	<div class="modal fade" id="formDeforest" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  	<div class="modal-dialog">
	    	<div class="modal-content">
			    <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color:#fff;">&times;</span></button>
			        <h3 class="modal-title" id="myModalLabel" align="center"><span class="glyphicon glyphicon-tree-deciduous"></span> AYUDANOS A CALIFICAR <span class="glyphicon glyphicon-tree-deciduous"></span></h3>
			    </div>
		    <div class="modal-body">
			    <div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<p align="center">Con base en las fotografías. ¿Cual es tu percepción de deforestación en el área? <br /> <em> El área oscura es bosque.</em></p>
						</div>
						<div class="col-md-12">
							<form>
								<div class="form-group">
									<div class="col-xs-12 col-sm-10 col-md-10">
										<select class="form-control" id="opcion">
											<option value="1" >BAJA</option>
											<option value="2">MEDIA</option>
											<option value="3">ALTA</option>
										</select>
									</div>
									<div class="col-md-2 pull-right">
										<button type="submit" class="btn btn-warning" name="enviar">Enviar</button>
									</div>
								</div>
							</form>
						</div>
						</div>
						<div class="row" style="margin-bottom: 15px;">
							<div class="col-md-6 col-sm-6 col-xs-6 galeria" align="center">
								<img src="images/Cobertura_forestal_2006.jpg" alt="paisaje1" width="100%"  class="img-responsive">
								<p align="center">2006</p>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-6  galeria" align="center">
								<img src="images/Cobertura_forestal_2010.jpg" alt="paisaje1" width="100%"  class="img-responsive">
								<p align="center">2010</p>
							</div>
						</div>	
					</div>
					
			 	</div>
			</div>
		</div>
	</div>
	<!-- Modal información aguas con tu agua -->
	<div class="modal fade" id="infoPrin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  	<div class="modal-dialog">
	    	<div class="modal-content">
			    <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color:#fff;">&times;</span></button>
			        <h3 class="modal-title" id="myModalLabel" align="center"> AGUAS CON TU AGUA </h3>
			    </div>
		    <div class="modal-body">
			    <div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<p align="center">
								El objetivo de la aplicación es buscar hacer conciencia sobre el cuidado del Medio Ambiente, principalmente sobre conservación del agua para consumo humano.
							</p>
							<p align="center">
								La aplicación muestra un mapa dinamico con datos de ríos y la cuenca en la que se ubica el usuario al momento de ingresar, permite la interacción y colaboración de los usuarios para la alimentación de los datos a través de lo siguiente:
							</p>
							<p align="center">
								<ol class="listado">
									<li>Comunidad (colaboradores)</li>
									<li>Evaluación niveles de deforestación</li>
									<li>Evaluación grado de contaminación</li>
								</ol>
							</p>
						</div>
					</div>						
			 	</div>
			</div>
		</div>
	</div>
	</div>
	<!-- Modal formulario de contaminacion -->
	<div class="modal fade" id="formRio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  	<div class="modal-dialog">
	    	<div class="modal-content">
			    <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" >&times;</span></button>
			        <h3 class="modal-title" id="myModalLabel" align="center" style="color:#fff;"><span class="glyphicon glyphicon-globe"></span> QUE OPINAS DE TU AGUA <span class="glyphicon glyphicon-globe"></span></h3>
			    </div>
		    <div class="modal-body">
			    <div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<form id="form2" action="" name="form2" method="post">
								<div class="col-xs-7">
									<label>¿Es bebible el agua del río que observas?
									</label>	
								</div>
								<div class="col-xs-5">
								<label>
									<div class="btn-group" data-toggle="buttons">
									  <label class="btn btn-primary active">
									    <input type="radio" name="options1" id="option1" value="1" autocomplete="off"> SI
									  </label>
									  <label class="btn btn-primary">
									    <input type="radio" name="options1" id="option01" value="2" autocomplete="off"> NO
									  </label>
									</div>
								</label>
								</div>
								
								<div class="col-xs-7">
									<label>¿Conoces el nacimiento del río que observas?</label>
									
								</div>
								<div class="col-xs-5">
									<label>
									<div class="btn-group" data-toggle="buttons">
									  <label class="btn btn-primary active">
									    <input type="radio" name="options2" id="option2" value="1" autocomplete="off"> SI
									  </label>
									  <label class="btn btn-primary">
									    <input type="radio" name="options2" id="option02" value="2" autocomplete="off"> NO
									  </label>
									</div>
								</label>
								</div>
								
								<div class="col-xs-7">
									<label>¿Observas cobertura forestal alrededor del río?</label>
									
								</div>
								<div class="col-xs-5">
								<label>							
									<div class="btn-group" data-toggle="buttons">
									  <label class="btn btn-primary active">
									    <input type="radio" name="options3" id="option3" value="1" autocomplete="off"> SI
									  </label>
									  <label class="btn btn-primary">
									    <input type="radio" name="options3" id="option03" value="2" autocomplete="off"> NO
									  </label>
									</div>
								</label>
								</div>		
								<div class="col-xs-7">
								<label>¿Existen drenajes que defoguen al río?</label>
								</div>
								<div class="col-xs-5">
								<label>
									<div class="btn-group" data-toggle="buttons">
									  <label class="btn btn-primary active">
									    <input type="radio" name="options4" id="option4" value="1" autocomplete="off"> SI
									  </label>
									  <label class="btn btn-primary">
									    <input type="radio" name="options4" id="option04" value="2" autocomplete="off"> NO
									  </label>
									</div>
								</label>
								</div>	
								<div class="col-xs-7">
								<label>¿Observas basura o residuos flotando en el río?</label>
								</div>
								<div class="col-xs-5">
								<label>
									<div class="btn-group" data-toggle="buttons">
									  <label class="btn btn-primary active">
									    <input type="radio" name="options5" id="option5" value="1" autocomplete="off"> SI
									  </label>
									  <label class="btn btn-primary">
									    <input type="radio" name="options5" id="option05" value="2" autocomplete="off"> NO
									  </label>
									</div>
								</label>
								</div>
								<br>
							<div class="col-xs-12 pull-right">
				        		<input class="btn btn-primary" type="submit" name="button1" id="button1" value=" Guardar"  />
			    	    		<input class="btn btn-primary" type="reset" name="button2" id="button2" value=" Cancelar"  />
			    	    	</div>
								</form>
							</div>	
						</div>	
					</div>
				</div>
				</div>
		 	</div>
		</div>
		</div>
	</div>
</body>
</html>