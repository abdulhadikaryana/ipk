<!DOCTYPE html>
<html>
<head>
  <title>Indeks Pembangunan Kebudayaan</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="<?php echo base_url();?>assets/leaflet/leaflet.js"></script>
  <script src="<?php echo base_url();?>assets/js/leaflet.groupedlayercontrol.js"></script>
 
  <!-- <script src="source/js/L.Control.Sidebar.js"></script> -->
  <!-- <link rel="stylesheet" href="source/js/L.Control.Sidebar.css" /> -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/leaflet.groupedlayercontrol.css" />
  <link rel="stylesheet" href="<?php echo base_url();?>assets/leaflet/leaflet.css" />
  <style type="text/css">
    #map{ position: absolute; top:0; bottom:0; right:0; left:0; }
    #map{ z-index:1; }
    #modal{ z-index:2; }
    .info { padding: 6px 8px; font: 14px/16px Arial, Helvetica, sans-serif; background: white; background: rgba(255,255,255,0.8); box-shadow: 0 0 15px rgba(0,0,0,0.2); border-radius: 5px; } .info h4 { margin: 0 0 5px; color: #777; }
  </style>
<!-- TEMPAT MANGGIL DATA DARI JS, MEMUNGKINKAN UNTUK DIPANGGIL JADI SATU-->
  <script src="<?php echo base_url();?>assets/js/IPK_Indonesia.js"> </script>    
 
</head>
<body>

  <div id="map"></div>

   <script type="text/javascript">
//Membuat Canvas peta dan menentukan titik dan zoom level
  var map = L.map('map').setView([-1.5, 117], 5);


// MEMBUAT TOGGLE LAYER di pojok kanan atas
  var controlLayers = L.control.layers( null, null, {
    position: "topright",
    collapsed: true // false = open by default
  }).addTo(map);

var info = L.control({position: 'bottomright'});
  info.onAdd = function (map) {
    this._div = L.DomUtil.create('div', 'info');
    this.update();
    return this._div;
  };

  info.update = function (props) {
    this._div.innerHTML = '<h4>Indeks Pemajuan Kebudayaan</h4>' +  (props ?
      '<b>' + props.IPK_Provin + '</b><br /> dengan nilai ' + props.DIM1 + ' '
      : 'Hover over a state');
  };

  info.addTo(map);


/* MENAMBAHKAN BASEMAP */

  var OpenStreetMap = L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 18,
    attribution: 'Map data &copy; <a href="http://openstreetmap.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(map);
  controlLayers.addBaseLayer( OpenStreetMap, 'OpenStreetMap');

  var OpenTopoMap = L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
    maxZoom: 20,
    attribution: 'Map data: &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, <a href="http://viewfinderpanoramas.org">SRTM</a> | Map style: &copy; <a href="https://opentopomap.org">OpenTopoMap</a> (<a href="https://creativecommons.org/licenses/by-sa/3.0/">CC-BY-SA</a>)'
  }).addTo(map);
  controlLayers.addBaseLayer( OpenTopoMap, 'OpenTopoMap');

  var Esri_WorldTopoMap = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Topo_Map/MapServer/tile/{z}/{y}/{x}', {
    attribution: 'Tiles &copy; Esri &mdash; Esri, DeLorme, NAVTEQ, TomTom, Intermap, iPC, USGS, FAO, NPS, NRCAN, GeoBase, Kadaster NL, Ordnance Survey, Esri Japan, METI, Esri China (Hong Kong), and the GIS User Community'
  }).addTo(map);
  controlLayers.addBaseLayer( Esri_WorldTopoMap, 'World_Topo_Map');


//STYLING

function setStyleDIM(d) {
  return d > 100 ? '#FC4E2A' :
    d > 50 ? '#FD8D3C' :
    d > 20 ? '#FEB24C' :
    d > 10 ? '#FED976' :
    '#FFEDA0';
}

function StyleDIM1(feature) {
  return {
    fillColor: setStyleDIM(feature.properties.DIM1),
    weight: 2,
    opacity: 1,
    color: 'white',
    dashArray: '3',
    fillOpacity: 0.7
  };
}

  function highlightFeature(e) {
    var layer = e.target;
    layer.setStyle({
      weight: 5,
      color: '#666',
      dashArray: '',
      fillOpacity: 0.7
    });
    if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
      layer.bringToFront();
    }
    info.update(layer.feature.properties);
  }

  function resetHighlight(e) {
    layerIPK.resetStyle(e.target);
    info.update();
  }


  function zoomToFeature(e) {
    map.fitBounds(e.target.getBounds());
  }

var layerIPK = L.geoJSON(IPK_Indonesia, {
    style: StyleDIM1,
    onEachFeature: function (feature, layer) {
      layer.on ({
      mouseover: highlightFeature,
      mouseout: resetHighlight,
        click: function() {
          paketData = feature.properties
        }
      }),
      layer.bindPopup(
        '<b>'+feature.properties.IPK_Provin+
        '</br><b>Nilai DIM1:</b> '+feature.properties.DIM1+
        '</br><b>Nilai DIM2:</b> '+feature.properties.DIM2+
        '</br><b>Nilai DIM3:</b> '+feature.properties.DIM3+
        '</br><b>Nilai DIM4:</b> '+feature.properties.DIM4+
        '</br><b>Nilai DIM5:</b> '+feature.properties.DIM5+
        '</br><b>Nilai DIM6:</b> '+feature.properties.DIM6+
        '</br><a target="_parent" href=detail/'+feature.properties.IPK_KODE_P+'>Detail</a></br>'
      );
    }
  }).addTo(map);

controlLayers.addOverlay(layerIPK, 'Ekonomi Budaya');
controlLayers.addOverlay(layerIPK, 'Pendidikan');
controlLayers.addOverlay(layerIPK, 'Ketahanan Sosial Budaya');
controlLayers.addOverlay(layerIPK, 'Warisan Budaya');
controlLayers.addOverlay(layerIPK, 'Ekspresi Budaya');
controlLayers.addOverlay(layerIPK, 'Budaya Literasi');
controlLayers.addOverlay(layerIPK, 'Gender');



  var groups = {
    cities: new L.LayerGroup(),
    restaurants: new L.LayerGroup(),
    dogs: new L.LayerGroup(),
    cats: new L.LayerGroup()
  };

  window.ExampleData = {
    LayerGroups: groups,
    Basemaps: basemaps
  };
  </script>
</body>
</html>
