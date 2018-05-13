/**
 * Created by imesh on 2017-04-02.
 */

$(document).ready(function() {
    var brand = document.getElementById('logo-id');
    brand.className = 'attachment_upload';
    brand.onchange = function() {

        document.getElementById('fakeUploadLogo').value = this.value;
    };

    // Source: http://stackoverflow.com/a/4459419/6396981
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('.img-preview').attr('src', e.target.result);
                //alert($('.img-preview').attr('src'));

            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#logo-id").change(function() {
        readURL(this);
    });
});
