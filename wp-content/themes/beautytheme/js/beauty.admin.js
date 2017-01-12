jQuery(document).ready(function ($) {
    var mediaUploader;

    $('#upload-button').on('click',function (e) {
        e.preventDefault();
        if (mediaUploader){
            mediaUploader.open();
            return;
        }
        mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Выберите изображение',
            button: {
                text: 'Выберите изображение'
            },
            multiple: false
        });
        mediaUploader.on('select', function () {
           attachment = mediaUploader.state().get('selection').first().toJSON();
            $('#profile_picture').val(attachment.url);
            $('#profile_picture_preview').css('background-image', 'url(' + attachment.url +')');
        });

        mediaUploader.open();
    });

    $('#remove-button').on('click',function (e) {
        e.preventDefault();
        var answer = confirm('Вы уверены что хотите удалить изображение?');
        if(answer == true){
            $('#profile_picture').val('');
            $('#profile_picture_preview').css('background-image', 'url()');
        }

    });
});