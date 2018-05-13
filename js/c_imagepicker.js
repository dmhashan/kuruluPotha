$(document).ready(function () {
    $("#selectImage").imagepicker({
        hide_select: true
    });

    var $container = $('.image-picker');
    // initialize
    $container.imagesLoaded(function () {
        $container.masonry({
            columnWidth: 30,
            itemSelector: '.thumbnail'
        });
    });
});