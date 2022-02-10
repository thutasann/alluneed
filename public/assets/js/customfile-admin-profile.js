// ------------------------------------- Admin Profile Image ------------------------------------
var triggerUpload = document.getElementById('triggerUpload'),
upInput = document.getElementById('filePicker'),
preview = document.querySelector('.preview');

triggerUpload.onclick = function() {
upInput.click();
};


upInput.onchange = function(e) {

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

// ------------------------------------- Admin Profile Image Modal ------------------------------------

$(document).ready(function () {

var modal = document.getElementById("myModal-img");
var img = document.getElementById("img-preview");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption-img");

img.onclick = function(){
modal.style.display = "block";
modalImg.src = this.src;
captionText.innerHTML = this.alt;
}

var span = document.getElementsByClassName("close-img")[0];

span.onclick = function() { 
modal.style.display = "none";
}

});