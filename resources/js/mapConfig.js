// mapConfig.js

export const mapOptions = (currentPosition, initialHeading) => ({
    center: currentPosition,
    zoom: 17,
    tilt: 67.5,
    heading: initialHeading,
    disableDefaultUI: true,
    gestureHandling: "none",
    keyboardShortcuts: false,
    mapId: "9a7cacbaabe775f",
    draggable: false,
    mapTypeControl: false,
    streetViewControl: false,
    rotateControl: true,
    zoomControl: false,
    zoomControlOptions: {
        position: google.maps.ControlPosition.RIGHT_TOP
    },
    fullscreenControl: false,
});
