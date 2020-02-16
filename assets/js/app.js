function getRequiredInfo() {
    var dateTime = new Date();
    getLocation();
    $('#data').val(dateTime.toLocaleDateString());
    $('#ora').val(dateTime.toLocaleTimeString());
    $('#dataalert').val(dateTime.toLocaleDateString());
    $('#oraalert').val(dateTime.toLocaleTimeString());
}

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    }
}

function showPosition(position) {
    $('#lat').val(position.coords.latitude);
    $('#lng').val(position.coords.longitude);
    $('#latalert').val(position.coords.latitude);
    $('#lngalert').val(position.coords.longitude);
}
