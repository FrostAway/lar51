$(document).ready(function () {
    $('.item-delete').click(function (e) {
        var conf = confirm('Bạn chắc chắn xóa?');
        if (conf) {
            return true;
        } else {
            return false;
        }
    });

    $('.field-date').datepicker({
        dateFormat: 'dd/mm/yy',
        changeYear: true
    });

    $('.checkall').click(function () {
        if ($(this).is(':checked')) {
            $('.checkitem').prop('checked', true);
        } else {
            $('.checkitem').prop('checked', false);
        }
    });

    $('.checkitem').change(function () {
        if ($('.checkitem:checked').size() === $('.checkitem').size()) {
            $('.checkall').prop('checked', true);
        } else {
            $('.checkall').prop('checked', false);
        }
    });

    $('.list-media li a').click(function (e) {
        e.preventDefault();
        var src = $(this).attr('href');
        var name = $(this).attr('data-name');
        $('#select #file-name').val(name);
        $('#select #url').val(src);
    });

    $('#file-select').change(function () {
        $('#file-name').val($(this).val());
    });

    $('.select-tags').select2({
        tags: true
    });

    tinymce.init({
        selector: '.editor',
        plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "save table contextmenu directionality emoticons template paste textcolor responsivefilemanager"
        ],
        image_advtab: true,
        relative_urls: false,
        toolbar: "insertfile undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | forecolor backcolor | responsivefilemanager",
        external_filemanager_path: "/lar51/public/plugin/filemanager/",
        filemanager_title: "Quản lý file upload",
        external_plugins: {"filemanager": "/lar51/public/plugin/filemanager/plugin.min.js"}
    });
    
    $('.media-choose .media-select').click(function(){
        $('#popupModal .modal-body').html('<iframe class="upload-iframe" frameborder="0" src="'+url+'/public/plugin/filemanager/dialog.php?type=0&field_id=media-url"></iframe>');
    });
    
    $('.media-container').html('<iframe style="width: 100%; min-height: 500px;" frameborder="0" src="'+url+'/public/plugin/filemanager/dialog.php?type=0&field_id=media-url"></iframe>');

});

function responsive_filemanager_callback(field_id){
	var url=$('#'+field_id).val();
	$('.media-image').attr('src', url);
        
//        $.ajax({
//           url: ajax_url,
//           type: 'POST',
//           data: {
//               action: 'media_upload',
//               _token: $('#post_token').val(),
//               url: url
//           },
//           success: {
//               
//           }
//        });
}