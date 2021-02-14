// ------------------------------------- Image ------------------------------------

var triggerUpload = document.getElementById('triggerUpload'),
    upInput = document.getElementById('filePicker'),
    preview = document.querySelector('.preview');

triggerUpload.onclick = function () {
    upInput.click();
};

upInput.onchange = function (e) {

    var uploaded = this.value,
        ext = uploaded.substring(uploaded.lastIndexOf('.') + 1),
        ext = ext.toLowerCase(),
        fileName = uploaded.substring(uploaded.lastIndexOf("\\") + 1),
        accepted = ["jpg", "png", "gif", "jpeg"];

    function showPreview() {
        preview.innerHTML = "<div class='loadingLogo'></div>";
        preview.innerHTML += '<img id="img-preview" />';
        var reader = new FileReader();
        reader.onload = function () {
            var img = document.getElementById('img-preview');
            img.src = reader.result;
        };
        reader.readAsDataURL(e.target.files[0]);
        preview.removeChild(document.querySelector('.loadingLogo'));
        document.querySelector('.fileName').innerHTML = fileName;
    };

    //only do if supported image file
    if (new RegExp(accepted.join("|")).test(ext)) {
        showPreview();
    } else {
        preview.innerHTML = "";
        document.querySelector('.fileName').innerHTML = "Hey! Upload an image file, not a <b>." + ext + "</b> file!";
    }


}


// ------------------------------------- Icon ------------------------------------

var triggerUpload_icon = document.getElementById('triggerUpload-icon'),
    upInput_icon = document.getElementById('filePicker-icon'),
    preview_icon = document.querySelector('.preview-icon');

triggerUpload_icon.onclick = function () {
    upInput_icon.click();
};


upInput_icon.onchange = function (e) {

    var uploaded_icon = this.value,
        ext_icon = uploaded_icon.substring(uploaded_icon.lastIndexOf('.') + 1),
        ext_icon = ext_icon.toLowerCase(),
        fileName_icon = uploaded_icon.substring(uploaded_icon.lastIndexOf("\\") + 1),
        accepted_icon = ["jpg", "png", "gif", "jpeg"];

    function showPreviewicon() {
        preview_icon.innerHTML = "<div class='loadingLogo-icon'></div>";
        preview_icon.innerHTML += '<img id="icon-preview" />';
        var reader_icon = new FileReader();
        reader_icon.onload = function () {
            var icon = document.getElementById('icon-preview');
            icon.src = reader_icon.result;
        };
        reader_icon.readAsDataURL(e.target.files[0]);
        preview_icon.removeChild(document.querySelector('.loadingLogo-icon'));
        document.querySelector('.fileName-icon').innerHTML = fileName_icon;
    };

    //only do if supported image file
    if (new RegExp(accepted_icon.join("|")).test(ext_icon)) {
        showPreviewicon();
    } else {
        preview_icon.innerHTML = "";
        document.querySelector('.fileName-icon').innerHTML = "Pls Upload an image file, not a <b>." + ext_icon + "</b> file";
    }

}

// ----------------------------------- Modal ----------------------------------------------







