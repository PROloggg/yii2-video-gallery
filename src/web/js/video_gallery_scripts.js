if (typeof prologgg == "undefined" || !prologgg) {
    var prologgg = {};
}
prologgg.video_gallery = {
    init: function () {
        var $thisObj = prologgg.video_gallery;
        $('[data-role = add-video]').on('click', function (e) {
            var data = {
                Video: {
                    name: $('[name="Video[name]"]').val(),
                    url: $('[name="Video[url]"]').val(),
                    date: $('[name="Video[date]"]').val(),
                    description: $('[name="Video[description]"]').val(),
                    owner: $('[data-role="add-video"]').data('owner-model'),
                    ownerId: $('[data-role="add-video"]').data('owner-model-id'),
                }
            }
            var url = $('[data-role="add-video"]').data('url'),
                listBlock = $('[data-role="video-list"]');
            $thisObj.addVideo(url, data, listBlock);
        });
    },

    addVideo: function (url, data, listBlock) {
        $.ajax({
            url: url,
            type: "post",
            data: data,
            success: function (VideoId) {
                if (VideoId !== 'error') {
                    listBlock.append(
                        "<a href='" + data['Video']['url'] + "' target='_blank'>" + data['Video']['name'] + " | " + data['Video']['date'] + "</a>"
                        +
                        '<a class="delete" href="/backend/web/video_gallery/video/delete?id=' + VideoId + '">✖</a>'
                    );
                }
            },
            error: function () {
                alert("Ajax doesn't work");
            }
        });
    }
};

$(function () {
    prologgg.video_gallery.init();
});