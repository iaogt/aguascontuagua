<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Aguas con el Aguas</title>
	<link rel="stylesheet" href="http://openlayers.org/en/v3.4.0/css/ol.css" type="text/css">
	<link href="css/bootstrap.min.css" type="text/css" rel="stylesheet" />
	<link href="css/uploadfile.css" rel="stylesheet" type="text/css"> 
	<link href="css/style.css" rel="stylesheet" type="text/css">
	<script src="js/jquery-1.10.2.js"></script>
	<script src="js/jquery-ui-1.10.4.custom.min.js"></script>
	<script src="http://openlayers.org/en/v3.4.0/build/ol.js" type="text/javascript"></script>
	<script src="js/jquery.uploadfile.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>	
<body>
						<!-- menu para pantallas medianas y grandes -->
	<nav class="navbar navbar-default hidden-xs hidden-sm">
	   	<div class="navbar-header">
	   		<a class="navbar-brand" href="#">
	   		<img alt="logo" src="images/logo1.png" width="100" height="90" class="logo">
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
		<p id="cargando" style="margin-bottom:10px;"></p>
	<div class="tab-content" style="position: relative; bottom: 30px;">
		<div role="tabpanel" class="tab-pane active container-fluid contenedor" id="mapa">
		    <div id="map" class="map"></div>
			    <a id="geolocation_marker" href="#"><img src="geolocation_marker.png" /></a>
			<div id="popup" title="Ubicación Actual"></div>
		</div>
		<div role="tabpanel" class="tab-pane" id="reportes">
		  	<div class="row-fluid">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<button style="margin-top: 15px;" class="btn btn-default pull-right" data-toggle="modal" data-target="#formReport"> Agrega tu Comentario <span class="glyphicon glyphicon-plus"></span></button>
				</div>
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="panel panel-default" style="margin-top: 15px;">
						<div class="panel-body">
					    	<div class="row aporte">
					    		<div class="col-sm-8 col-md-8 col-lg-8">
					    			comentario numero 1
					    		</div>
					    		<div class="col-sm-4 col-md-4 col-lg-4">
					    				<img src="images/Imagen_Satelital_Oeste_Mundo.jpg" height="100px" class="fotoCom">
					    		</div>
					    	</div>
					    	<div class="row aporte">
					    		<div class="col-sm-8 col-md-8 col-lg-8">
					    			comentario numero 1
					    		</div>
					    		<div class="col-sm-8 col-md-4 col-lg-4">
					    				<img src="images/mapa.jpg" height="100px" class="fotoCom"/>
					    		</div>
					    	</div>
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
		    <div class="container">
				<div class="row">
					<div class="col-md-6 col-sm-6 col-xs-12 col-lg-6">
						<form>
							<div class="form-group">
								<label>Comentario <span class="glyphicon glyphicon-comment"></span> :</label>
							    <textarea class="form-control" rows="3" placeholder="Dejanos tu comentario aqui..........."></textarea>
							</div>
							<div class="form-group">
							  	<label>Fotografía <span class="glyphicon glyphicon-camera"></span> :</label>
								<div id="mulitplefileuploader">Cargar Imagen</div>
								<div id="status"></div>
						  	</div>
							<button type="submit" class="btn btn-primary pull-right">Enviar</button>
						</form>
					</div>
				</div>
			</div>
	 	</div>
	</div>
	<script>
		var popup;
    	var view;
    	var map;
    	var marker;
		$(document).ready(function(){
			//interfaz
			var movil= $('#menuMapa').parent();
			if(movil){
				$('#menuMapa').addClass('active');
			}
			$('#reportes').hide();
			$('#maPrincip, #menuMapa').click(function(){
				$('#princiReport').removeClass('visitado1');
				var activo = $(this).addClass('visitado');
				if(activo){
					$('#menuReport').removeClass('active');
					$('#menuMapa').addClass('active');
				}
				$('#reportes').hide();
				$('#mapa').show();
			});
			$('#princiReport, #menuReport').click(function(){
				$('#maPrincip').removeClass('visitado');
				var activo = $(this).addClass('visitado1');
				if(activo){
					$('#menuMapa').removeClass('active');
					$('#menuReport').addClass('active');
				}
				$('#mapa').hide();
				$('#reportes').show();
			});
			//================formulario=====================//
			var settings = {
		    url: "upload1.php",
		    dragDrop:true,
		    fileName: "myfile",
		    allowedTypes:"jpg,png,gif,doc,pdf,zip",	
		    //returnType:"json",
			 onSuccess:function(files,data,xhr)
		    {
		       	alert(files+data);
	
		    },
		    //showDelete:false,
		    deleteCallback: function(data,pd)
			{
		    for(var i=0;i<data.length;i++)
		    {
		        $.post("delete.php",{op:"delete",name:data[i]},
		        function(resp, textStatus, jqXHR)
		        {	
		            //Show Message  
		            $("#status").append("<div>Archivo Eliminado</div>");
		                 
		        });
		     }      
		    pd.statusbar.hide(); //You choice to hide/not.
		
			}
			}
			var uploadObj = $("#mulitplefileuploader").uploadFile(settings);
				
		view = new ol.View({
			  center: ol.proj.transform([-90.190436,15.485556], 'EPSG:4326', 'EPSG:3857'),
			  zoom: 4
			});   
			
			// creating the map
			map = new ol.Map({
			  layers: [
			    new ol.layer.Tile({
			      source: new ol.source.OSM()
			    })
			  ],
			  target: 'map',
			  controls: ol.control.defaults({
			    attributionOptions: /** @type {olx.control.AttributionOptions}  */({
			      collapsible: false
			    })
			  }),
			  view: view
			});
			
			// Geolocation marker
			var markerEl = document.getElementById('geolocation_marker');
			marker = new ol.Overlay({
			  positioning: 'center-center',
			  element: markerEl,
			  stopEvent: false
			});
			map.addOverlay(marker);
			
			popup = new ol.Overlay({
			  element: document.getElementById('popup')
			});
			map.addOverlay(popup);
			
	// Geolocation Control
			var geolocation = new ol.Geolocation(/** @type {olx.GeolocationOptions} */({
			  projection: view.getProjection(),
			  trackingOptions: {
			    maximumAge: 10000,
			    enableHighAccuracy: true,
			    timeout: 600000
			  }
			}));
			
			// Listen to position changes
			geolocation.on('change', function(evt) {
			  var position = geolocation.getPosition();
			  var accuracy = geolocation.getAccuracy();
			  var heading = geolocation.getHeading() || 0;
			  var speed = geolocation.getSpeed() || 0;
			  var m = Date.now();
			  marker.setPosition(position);
				$('#cargando').html('');
				cargarRios();
				cargarCuencas();
			});
			geolocation.on('error',function(evt){
				alert('error');
			})
			geolocation.setTracking(true);
			$('#cargando').html('buscando ubicación... <img src="images/ajax-loader.gif" />');
			
			$('#geolocation_marker').click(function(){
				var element = popup.getElement();
				$(element).popover('destroy');
				popup.setPosition(marker.getPosition());
				$(element).popover({
				  'placement': 'top',
				  'html': true,
				  'content': '<div>Coordenadas: <span style="font-size:10px">'+marker.getPosition()+'</span><br/>Cuenca:asdfasdf</div><div align="right"><a href="conta.php" class="btn btn-primary">Evaluar</a></div>'
				});
				$(element).popover('show');
				return false;
			});
		});

var image = new ol.style.Circle({
  radius: 25,
  fill: null,
  stroke: new ol.style.Stroke({color: 'red', width: 1})
});

var styles = {
  'Point': [new ol.style.Style({
    image: image
  })],
  'LineString': [new ol.style.Style({
    stroke: new ol.style.Stroke({
      color: 'green',
      width: 5
    })
  })],
  'MultiLineString': [new ol.style.Style({
    stroke: new ol.style.Stroke({
      color: 'green',
      width: 1
    })
  })],
  'MultiPoint': [new ol.style.Style({
    image: image
  })],
  'MultiPolygon': [new ol.style.Style({
    stroke: new ol.style.Stroke({
      color: 'yellow',
      width: 1
    }),
    fill: new ol.style.Fill({
      color: 'rgba(255, 255, 0, 0.1)'
    })
  })],
  'Polygon': [new ol.style.Style({
    stroke: new ol.style.Stroke({
      color: 'blue',
      lineDash: [4],
      width: 3
    }),
    fill: new ol.style.Fill({
      color: 'rgba(0, 0, 255, 0.1)'
    })
  })],
  'GeometryCollection': [new ol.style.Style({
    stroke: new ol.style.Stroke({
      color: 'magenta',
      width: 2
    }),
    fill: new ol.style.Fill({
      color: 'magenta'
    }),
    image: new ol.style.Circle({
      radius: 10,
      fill: null,
      stroke: new ol.style.Stroke({
        color: 'magenta'
      })
    })
  })],
  'Circle': [new ol.style.Style({
    stroke: new ol.style.Stroke({
      color: 'red',
      width: 2
    }),
    fill: new ol.style.Fill({
      color: 'rgba(255,0,0,0.2)'
    })
  })]
};

var styleFunction = function(feature, resolution) {
  return styles[feature.getGeometry().getType()];
};

function hola(feature){
	alert('jeje');
}

function dump(arr,level) {
	var dumped_text = "";
	if(!level) level = 0;
	
	//The padding given at the beginning of the line.
	var level_padding = "";
	for(var j=0;j<level+1;j++) level_padding += "    ";
	
	if(typeof(arr) == 'object') { //Array/Hashes/Objects 
		for(var item in arr) {
			var value = arr[item];
			
			if(typeof(value) == 'object') { //If it is an array,
				dumped_text += level_padding + "'" + item + "' ...\n";
				dumped_text += dump(value,level+1);
			} else {
				dumped_text += level_padding + "'" + item + "' => \"" + value + "\"\n";
			}
		}
	} else { //Stings/Chars/Numbers etc.
		dumped_text = "===>"+arr+"<===("+typeof(arr)+")";
	}
	return dumped_text;
}
		
		/**
		 *	Carga los rios
		 * */
		function cargarRios(){
			alert('cargando rios');
			$.get('api.php',{'data':'rios'},function(data){
				if(data){
					var arrFeatures=new Array();
					var feature;
					var rows = data.rows;
					var format = new ol.format.GeoJSON();
					var arrGeos = [];
					for(var i=0;i<rows.length;i++){
						var json = rows[i];
						var geos = json[1]; 
						for(var j=0;j<geos.geometries.length;j++){
							var objeto=null;
							var objGeo = format.readGeometry(geos.geometries[j]);
							objGeo.transform('EPSG:4326','EPSG:3857');
							arrFeatures.push(new ol.Feature(objGeo));
						}
						/*feature = new ol.Feature({
							geometry:(new ol.geom.GeometryCollection({"geometries":arrGeos})),
							name:':D'
						});	//{'name':json[0],'geometry':json[1]}*/
						arrGeos=[];
					}
					if(arrFeatures.length>0){
						var listadoF = new ol.source.Vector({'features':arrFeatures});
						var layer = new ol.layer.Vector({
							source:listadoF
						});
						map.addLayer(layer);
					}
				}
			},'json');
		}
		
		/**
		 *	Carga los rios
		 * */
		function cargarCuencas(){
			alert('cargando cuencas...');
			$.get('api.php',{'data':'cuencas'},function(data){
				alert('cuencas cargadas');
				if(data){
					var arrFeatures=new Array();
					var feature;
					var rows = data.rows;
					var format = new ol.format.GeoJSON();
					var arrGeos = [];
					for(var i=0;i<rows.length;i++){
						var json = rows[i];
						var geos = json[1]; 
						for(var j=0;j<geos.geometries.length;j++){
							var objeto=null;
							var objGeo = format.readGeometry(geos.geometries[j]);
							objGeo.transform('EPSG:4326','EPSG:3857');
							arrFeatures.push(new ol.Feature(objGeo));
						}
						/*feature = new ol.Feature({
							geometry:(new ol.geom.GeometryCollection({"geometries":arrGeos})),
							name:':D'
						});	//{'name':json[0],'geometry':json[1]}*/
						arrGeos=[];
					}
					if(arrFeatures.length>0){
						var listadoF = new ol.source.Vector({'features':arrFeatures});
						var layer = new ol.layer.Vector({
							source:listadoF
						});
						map.addLayer(layer);
					}
				}
			},'json');
		}
	</script>
</body>
</html>