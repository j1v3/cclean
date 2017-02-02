/**
 * Created by j1v3 on 01/02/17.
 */
function drop_ad(data) {
    if (data.ads[0].description && data.ads[0].statlink) {
        $('.bsa-apiads').html('<a href="'+data.ads[0].statlink+'" target="_blank">'+data.ads[0].description+'</a>');
        if (data.ads[0].pixel) {
            $('.bsa-apiads').append('<img height=1 width=1 src="'+data.ads[0].pixel+'"/>');
        }
    }
}