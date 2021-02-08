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


//Llenado de datos de modal
function previsualizarPanel(panel) {
    pop = document.getElementById('video-popup-panel')

    switch (panel) {
        case 1:
            pintar_pan(pop, 'css/video/videos-paneles/portico-huanchaco.mp4')
            break;
        case 2:
            pintar_pan(pop, 'css/video/videos-paneles/paradero-laesperanza02.mp4')
            break;
        case 3:
            pintar_pan(pop, 'css/video/videos-paneles/paradero-laesperanza02.mp4')
            break;
        case 4:
            pintar_pan(pop, 'css/video/videos-paneles/portico-mall.mp4')
            break;
        case 5:
            pintar_pan(pop, 'css/video/videos-paneles/paradero-elgolf.mp4')
            break;
        case 6:
            pintar_pan(pop, 'css/video/videos-paneles/paradero-larco.mp4')
            break;
        case 7:
            pintar_pan(pop, 'css/video/videos-paneles/portico-realplaza.mp4')
            break;
        case 8:
            pintar_pan(pop, 'css/video/videos-paneles/portico-elporvenir.mp4')
            break;
    }

}

function pintar_pan(pop, vid) {
    pop.src = vid
    document.getElementById('btn-pre-pan').click()
}