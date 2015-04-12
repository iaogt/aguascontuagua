		var popup;
		var popup2;
    	var view;
    	var map;
    	var marker;
    	var listadoF;
    	var selclick;
    	var dataimg = "";
		$(document).ready(function(){
			$('#infoPrin').modal('show');
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
		       	//alert(data);
				window.dataimg = data;
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
			  zoom: 11
			});   
			
			// creating the map
			map = new ol.Map({
			  layers: [
			    new ol.layer.Tile({
			      source: new ol.source.MapQuest({layer: 'sat'})
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
			
			popup2 = new ol.Overlay({
			  element: document.getElementById('popup2')
			});
			map.addOverlay(popup2);
			
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
				$('#txtcargando').html('ubicacion encontrada ...');
			  var position = geolocation.getPosition();
			  var accuracy = geolocation.getAccuracy();
			  var heading = geolocation.getHeading() || 0;
			  var speed = geolocation.getSpeed() || 0;
			  var m = Date.now();
			  marker.setPosition(position);
			  /*var pan = ol.animation.pan({
			    duration: 2000,
			    source: /** @type {ol.Coordinate}  (view.getCenter())
			  });
			  map.beforeRender(pan);*/
			  view.setCenter(position);
				cargarCuencas();
			});
			geolocation.on('error',function(evt){
				alert('error');
			})
			geolocation.setTracking(true);
			$('#txtcargando').html('buscando ubicación...');
			
			$('#geolocation_marker').click(function(){
				var element = popup.getElement();
				$(element).popover('destroy');
				popup.setPosition(marker.getPosition());
				var coordes = ol.proj.transform(marker.getPosition(),'EPSG:3857','EPSG:4326');
				$('#corde1').html('Lat:'+coordes[0]+'<br/>Lan:'+coordes[1]);
				$(element).popover({
				  'placement': 'top',
				  'html': true,
				  'content': $('#popup1').html()
				});
				$(element).popover('show');
				return false;
			});
		});
		
function quitarPopups(){
	var element = popup.getElement();
	$(element).popover('destroy');
	element = popup2.getElement();
	$(element).popover('destroy');
}

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
			$('#txtcargando').html('cargando rios ...');
			$.get('api.php',{'data':'rios'},function(data){
				if(data){
					var arrFeatures=new Array();
					var feature;
					var rows = data.rows;
					var format = new ol.format.GeoJSON();
					var arrGeos = [];
					for(var i=0;i<rows.length;i++){
						var json = rows[i];
						var geos = json[0];
						var dataHtml = json[1];
						var posIni = dataHtml.indexOf('>nombre</span>');
						var posFin = dataHtml.indexOf('</li>',posIni);
						var rio = dataHtml.substr(posIni+14,(posFin-posIni)+2);
						rio = rio.replace('</p>','');
						rio = rio.replace(':','');
						rio = rio.replace('</strong>','');
						rio = rio.replace('<li></li>','');
						for(var j=0;j<geos.geometries.length;j++){
							var objeto=null;
							var objGeo = format.readGeometry(geos.geometries[j]);
							objGeo.transform('EPSG:4326','EPSG:3857');
							if(objGeo.intersectsExtent(listadoF.getExtent())){
								var objFeature = new ol.Feature({'geometry':objGeo,'name':rio});
								arrFeatures.push(objFeature);
							}
						}
						/*feature = new ol.Feature({
							geometry:(new ol.geom.GeometryCollection({"geometries":arrGeos})),
							name:':D'
						});	//{'name':json[0],'geometry':json[1]}*/
						arrGeos=[];
					}
					if(arrFeatures.length>0){
						var listadoF2 = new ol.source.Vector({'features':arrFeatures});
						var layer = new ol.layer.Vector({
							source:listadoF2
						});
						map.addLayer(layer);
					}
					
					selclick = new ol.interaction.Select({
  						condition: ol.events.condition.click
					});
					
					map.addInteraction(selclick);
					map.on("click",function(e){
						cantFeaturesEnc=0;
						map.forEachFeatureAtPixel(e.pixel,function(feature,layer){
							cantFeaturesEnc=cantFeaturesEnc+1;
							if((feature.getGeometry().getType()=="Point")||(feature.getGeometry().getType()=="LineString")){
								var element = popup2.getElement();
								//$(element).popover('destroy');
								popup2.setPosition(feature.getGeometry().getCoordinates());
								$('#nomrio').html(feature.get('name'));
								$(element).popover({
								  'placement': 'top',
								  'html': true,
								  'content': $('#popup-1').html()
								});
								$(element).popover('show');
							}
						});
						if(cantFeaturesEnc==0){
							quitarPopups();
						}
					});
				}
				$('#txtcargando').html('');
				$('#cargando').css('display','none');
			},'json');  
		}
var cantFeaturesEnc=0;
		/**
		 *	Carga los rios
		 * */
		function cargarCuencas(){
			var pos = ol.proj.transform(marker.getPosition(),'EPSG:3857','EPSG:4326');
			$('#txtcargando').html('cargando cuencas ...');
			$.get('api.php',{'data':'cuencas','x':pos[0],'y':pos[1]},function(data){
				if(data){
					var arrFeatures=new Array();
					var feature;
					var rows = data.rows;
					var format = new ol.format.GeoJSON();
					var arrGeos = [];
					for(var i=0;i<rows.length;i++){
						var json = rows[i];
						var geos = json[1]; 
						var dataHtml = json[0];
						var posIni = dataHtml.indexOf('>CUENCA</span>');
						var posFin = dataHtml.indexOf('</li>',posIni);
						var cuenca = dataHtml.substr(posIni+14,(posFin-posIni)+2);
						cuenca = cuenca.replace('</span>','');
						cuenca = cuenca.replace(':','');
						cuenca = cuenca.replace('</strong>','');
						cuenca = cuenca.replace('<li></li>','');
						posIni = dataHtml.indexOf('>SUBCUEN</span>',posIni);
						posFin = dataHtml.indexOf('</li>',posIni);
						var subcuenca = dataHtml.substr(posIni+13,(posFin-posIni));
						subcuenca = subcuenca.replace('</span>','');
						subcuenca = subcuenca.replace(':','');
						subcuenca = subcuenca.replace('</strong>','');
						subcuenca = subcuenca.replace('<li></li>','');
						var posIni = dataHtml.indexOf('>MICROCUE</span>',posIni);
						var posFin = dataHtml.indexOf('</li>',posIni);
						var microcuenca = dataHtml.substr(posIni+14,(posFin-posIni));
						microcuenca = microcuenca.replace('</span>','');
						microcuenca = microcuenca.replace(':','');
						microcuenca = microcuenca.replace('</strong>','');
						microcuenca = microcuenca.replace('<li></li>','');
						for(var j=0;j<geos.geometries.length;j++){
							var objeto=null;
							var objGeo = format.readGeometry(geos.geometries[j]);
							objGeo.transform('EPSG:4326','EPSG:3857');
							arrFeatures.push(new ol.Feature({'geometry':objGeo,'name':json[0]}));
							$('#nomcuenca').html(cuenca+subcuenca+microcuenca);
						}
						/*feature = new ol.Feature({
							geometry:(new ol.geom.GeometryCollection({"geometries":arrGeos})),
							name:':D'
						});	//{'name':json[0],'geometry':json[1]}*/
						arrGeos=[];
					}
					if(arrFeatures.length>0){
						listadoF = new ol.source.Vector({'features':arrFeatures});
						var layerCuenca = new ol.layer.Vector({
							source:listadoF
						});
						map.addLayer(layerCuenca);
						cargarRios();
					}
				}
			},'json');
		}
		
		function evaluarRio(){
			quitarPopups();
			$('#formRio').modal('toggle');
		}
		
		function evaluarCuenca(){
			quitarPopups();
			$('#formDeforest').modal('toggle');
		}
