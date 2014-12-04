$(document).ready(function() {
    // var container = document.querySelector('#notebook');
    // var masonry = new Masonry(container, {
    //     columnWidth: 50,
    //     itemSelector: '.note'
    // });
    //Display tooltip on hover
    $('[data-toggle="tooltip"]').tooltip();
    //Fade out alert messages
    $().alert('close');
    //Switch between ListView and GridView
    
    $('#view-control > button').on('click', function(e) {
        var elem = $('.note');
        //Change grid view icon to list view icon
        if ($(this).hasClass('gridview')) {
            $(this).removeClass('gridview').addClass('listview');
            $(this).children('span').removeClass('glyphicon-th-list').addClass('glyphicon-th');
            // elem = $('div').hasClass('col-md-4');
            elem.fadeOut(100, function() {
                elem.removeClass('col-md-4').addClass('col-md-12').css("padding", "0");
                if($('#filter-normal').hasClass('active')) {
                    $('.normal').fadeIn(100);
                }
                else if($('#filter-trash').hasClass('active')) {
                    $('.trash').fadeIn(100);
                }                
            });
        }
        //Change list view icon to grid view icon
        else if ($(this).hasClass('listview')) {
            $(this).removeClass('listview').addClass('gridview');
            $(this).children('span').removeClass('glyphicon-th').addClass('glyphicon-th-list');
            elem.fadeOut(100, function() {
                elem.removeClass('col-md-12').addClass('col-md-4').css({
                    'padding': '10px',
                });
                $('.panel-body').css({
                    // 'height': '300px',
                    'max-height': '300px',
                    'overflow-y': 'auto',
                });
                if($('#filter-normal').hasClass('active')) {
                    $('.normal').fadeIn(100);
                }
                else if($('#filter-trash').hasClass('active')) {
                    $('.trash').fadeIn(100);
                }                
            });
        }
    });
    //End switch between ListView and GridView
    //Filter
    $('#filter-normal').click(function(e) {
        $(this).removeClass('btn-default').addClass('btn-primary').addClass('active');
        $('#filter-trash').removeClass('btn-primary').removeClass('active').addClass('btn-default');
        $('.trash').fadeOut(100, function() {
            $('.normal').css("display", "block");
            $('.trash').css("display", "none");
            // elem.fadeIn(100);
        });
    });
    $('#filter-trash').click(function(e) {
        $(this).removeClass('btn-default').addClass('btn-primary').addClass('active');
        $('#filter-normal').removeClass('btn-primary').removeClass('active').addClass('btn-default');
        $('.normal').fadeOut(100, function() {
            $('.normal').css("display", "none");
            $('.trash').css("display", "block");
            // elem.fadeIn(100);
        });
    });
    //End filter
    //Toggle Sidebar
    $("#menu-close").click(function(e) {
        e.preventDefault();
        $("#menu-toggle").fadeIn(500).css("display", "inline-block");
        $("#desktop-search-bar").css("padding-left", "15px");
        $("body").toggleClass("toggled");
        $(".footer").toggleClass("toggled");
        $("#sidebar-wrapper").toggleClass("toggled");
        $("#nav").toggleClass("toggled");
        // $("#toolbar").toggleClass("toggled");
    });
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#menu-toggle").fadeOut(500).css("display", "none");
        $("#desktop-search-bar").css("padding-left", "0");
        $("body").toggleClass("toggled");
        $(".footer").toggleClass("toggled");
        $("#sidebar-wrapper").toggleClass("toggled");
        $("#nav").toggleClass("toggled");
        // $("#toolbar").toggleClass("toggled");
    });
    //End toggle sidebar
    // $(function() {
    //     $('.sortable').sortable();
    //     //                $('.handles').sortable({
    //     //                    handle: 'span'
    //     //                });
    // });
    //            $('.panel-title').click(function(e) {
    //                $(this).css({
    //                    'max-height': ''
    //                });
    //            });
});