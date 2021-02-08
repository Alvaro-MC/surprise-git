//Llenado de datos de modal
function previsualizar(video, panel) {
    pop = document.getElementById('video-popup-pre')

    if (panel == 5 || panel == 6) {
        switch (video) {
            case 1:
                pintar_pre(pop, 'css/video/videos-amor/spots/panel-amistad.mp4')
                break;
            case 2:
                pintar_pre(pop, 'css/video/videos-amor/spots/panel-amor-1.mp4')
                break;
            case 3:
                pintar_pre(pop, 'css/video/videos-amor/spots/panel-amor-2.mp4')
                break;
        }
    } else {
        switch (video) {
            case 1:
                pintar_pre(pop, 'css/video/videos-amor/spots/portico-amistad.mp4')
                break;
            case 2:
                pintar_pre(pop, 'css/video/videos-amor/spots/portico-amor-1.mp4')
                break;
            case 3:
                pintar_pre(pop, 'css/video/videos-amor/spots/portico-amor-2.mp4')
                break;
        }
    }
}

function pintar_pre(pop, vid) {
    pop.src = vid
    document.getElementById('btn-prev').click()
}