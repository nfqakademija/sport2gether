var is_processing = false;
var last_page = false;
var page = 1;

function addMoreElements() {
    is_processing = true;

    var offset = 12 * page - 12 + 1;

    $.ajax({
        type: "GET",
        url: '/showNewestEvents',
        data: {
            offset: offset
        },
        success: function (data) {
            if(data === null) {
                last_page = true;
            }

            $('.eventList').append(data);

            is_processing = false;
            page += 1;

        },
        error: function (data) {
            is_processing = false;
        }
    });
};

// list scroll with AJAX
$(function () {
    $(window).scroll(function () {
        var wintop = $(window).scrollTop(), docheight = $(document).height(), winheight = $(window).height();

        var scrolltrigger = 0.80;
        if ((wintop / (docheight - winheight)) > scrolltrigger) {

            if (last_page === false && is_processing === false) {
                    addMoreElements();
            }
        }
    });
});