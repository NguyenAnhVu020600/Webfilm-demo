$(document).ready(function() {
    $('.province').change(function() {
        var id_province = $('.province').val();
        console.log(id_province)
        $.post('data_district.php', { data_id_province: id_province }, function(data) {
            $('.district').html(data);
        });
    });
});