const START_COORDS = {
    'lat' : -33.45694,
    'long' : -70.64827
}

let coordsSelectedAddress={
    'lat' : "",
    'lon' : ""
}

const map = L.map('map').setView([START_COORDS.lat, START_COORDS.long], 10);

L.tileLayer('https://maps.geoapify.com/v1/tile/osm-carto/{z}/{x}/{y}.png?apiKey=9dc09b92542b4915b4423edcb47b100c', {
  attribution: 'Powered by <a href="https://www.geoapify.com/" target="_blank">Geoapify</a> | © OpenStreetMap <a href="https://www.openstreetmap.org/copyright" target="_blank">contributors</a>',
  maxZoom: 20, id: 'osm-bright'
}).addTo(map);

L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {attribution: 'OSM'}).addTo(map);

const myMarker = L.marker([START_COORDS.lat, START_COORDS.long], {title: "COOOOOORDS", alt: "COOOOOORDS", draggable: true})
.addTo(map).on('dragend', function() {
    const lat = myMarker.getLatLng().lat.toFixed(8);
    const lon = myMarker.getLatLng().lng.toFixed(8);
    map.setView([lat,lon]); 
    document.getElementById('lat').value = lat;
    document.getElementById('lon').value = lon;
  
});

function chooseAddr(lat,lon){
    myMarker.closePopup();
    map.setView([lat, lon],17);
    myMarker.setLatLng([lat, lon]);
    lat = lat.toFixed(8);
    lon = lon.toFixed(8); 
}


async function addr_search()
{
    let direccion =  $('#dirInput').val();
    var requestOptions = {
        method: 'GET',
    };
    const url = `https://api.geoapify.com/v1/geocode/search?text=${direccion}&lang=es&format=json&country=Chile&apiKey=8e0fb22db799417cb70ea1a4a0fb3ff1` 
    console.log(direccion)
    console.log(url)
      
    // fetch(`https://api.geoapify.com/v1/geocode/search?text=${direccion}&apiKey=8e0fb22db799417cb70ea1a4a0fb3ff1`, requestOptions)
    fetch(url, requestOptions)
    .then(response => response.json())
    .then(response => {
        console.log(response)
        const lat = response.results[0].lat
        const lon = response.results[0].lon
        coordsSelectedAddress.lat = lat;
        coordsSelectedAddress.lon = lon;
        chooseAddr(lat, lon);
    })
    .catch(error => console.log('error', error));
}



$('#dirInput').on('blur',function(){
    if($(this).val() !== ""){
        addr_search();
    }
})


