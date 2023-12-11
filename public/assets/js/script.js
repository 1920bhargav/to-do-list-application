function readURL(input, preview_field) {

    if (input.files && input.files[0]) {

        var reader = new FileReader();
        reader.onload = function(e) {
            $(preview_field).attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}