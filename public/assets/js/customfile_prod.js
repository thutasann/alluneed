// ------------------------------------- prod_image ------------------------------------

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


// ------------------------------------- prod_image_1 ------------------------------------

var triggerUpload_1 = document.getElementById('triggerUpload_1'),
    upInput_1 = document.getElementById('filePicker_1'),
    preview_1 = document.querySelector('.preview_1');

triggerUpload_1.onclick = function () {
    upInput_1.click();
};

upInput_1.onchange = function (e) {

    var uploaded_1 = this.value,
        ext_1 = uploaded_1.substring(uploaded_1.lastIndexOf('.') + 1),
        ext_1 = ext_1.toLowerCase(),
        fileName_1 = uploaded_1.substring(uploaded_1.lastIndexOf("\\") + 1),
        accepted_1 = ["jpg", "png", "gif", "jpeg"];

    function showPreview_1() {
        preview_1.innerHTML = "<div class='loadingLogo_1'></div>";
        preview_1.innerHTML += '<img id="img-preview_1" />';
        var reader_1 = new FileReader();
        reader_1.onload = function () {
            var img_1 = document.getElementById('img-preview_1');
            img_1.src = reader_1.result;
        };
        reader_1.readAsDataURL(e.target.files[0]);
        preview_1.removeChild(document.querySelector('.loadingLogo_1'));
        document.querySelector('.fileName_1').innerHTML = fileName_1;
    };

    //only do if supported image file
    if (new RegExp(accepted_1.join("|")).test(ext_1)) {
        showPreview_1();
    } else {
        preview_1.innerHTML = "";
        document.querySelector('.fileName_1').innerHTML = "Pls Upload an image file, not a <b>." + ext_1 + "</b> file";
    }

}

// ------------------------------------- prod_image_2 ------------------------------------

var triggerUpload_2 = document.getElementById('triggerUpload_2'),
    upInput_2 = document.getElementById('filePicker_2'),
    preview_2 = document.querySelector('.preview_2');

triggerUpload_2.onclick = function () {
    upInput_2.click();
};

upInput_2.onchange = function (e) {

    var uploaded_2 = this.value,
        ext_2 = uploaded_2.substring(uploaded_2.lastIndexOf('.') + 1),
        ext_2 = ext_2.toLowerCase(),
        fileName_2 = uploaded_2.substring(uploaded_2.lastIndexOf("\\") + 1),
        accepted_2 = ["jpg", "png", "gif", "jpeg"];

    function showPreview_2() {
        preview_2.innerHTML = "<div class='loadingLogo_2'></div>";
        preview_2.innerHTML += '<img id="img-preview_2" />';
        var reader_2 = new FileReader();
        reader_2.onload = function () {
            var img_2 = document.getElementById('img-preview_2');
            img_2.src = reader_2.result;
        };
        reader_2.readAsDataURL(e.target.files[0]);
        preview_2.removeChild(document.querySelector('.loadingLogo_2'));
        document.querySelector('.fileName_2').innerHTML = fileName_2;
    };

    //only do if supported image file
    if (new RegExp(accepted_2.join("|")).test(ext_2)) {
        showPreview_2();
    } else {
        preview_2.innerHTML = "";
        document.querySelector('.fileName_2').innerHTML = "Pls Upload an image file, not a <b>." + ext_2 + "</b> file";
    }

}

// ------------------------------------- prod_image_2 ------------------------------------

var triggerUpload_3 = document.getElementById('triggerUpload_3'),
    upInput_3 = document.getElementById('filePicker_3'),
    preview_3 = document.querySelector('.preview_3');

triggerUpload_3.onclick = function () {
    upInput_3.click();
};

upInput_3.onchange = function (e) {

    var uploaded_3 = this.value,
        ext_3 = uploaded_3.substring(uploaded_3.lastIndexOf('.') + 1),
        ext_3 = ext_3.toLowerCase(),
        fileName_3 = uploaded_3.substring(uploaded_3.lastIndexOf("\\") + 1),
        accepted_3 = ["jpg", "png", "gif", "jpeg"];

    function showPreview_3() {
        preview_3.innerHTML = "<div class='loadingLogo_3'></div>";
        preview_3.innerHTML += '<img id="img-preview_3" />';
        var reader_3 = new FileReader();
        reader_3.onload = function () {
            var img_3 = document.getElementById('img-preview_3');
            img_3.src = reader_3.result;
        };
        reader_3.readAsDataURL(e.target.files[0]);
        preview_3.removeChild(document.querySelector('.loadingLogo_3'));
        document.querySelector('.fileName_3').innerHTML = fileName_3;
    };

    //only do if supported image file
    if (new RegExp(accepted_3.join("|")).test(ext_3)) {
        showPreview_3();
    } else {
        preview_3.innerHTML = "";
        document.querySelector('.fileName_3').innerHTML = "Pls Upload an image file, not a <b>." + ext_3 + "</b> file";
    }

}


// -------------------------------------- Modal Images --------------------------------
$(document).ready(function () {

    // prod_image
    var modal = document.getElementById("myModal-img");
    var img = document.getElementById("img-preview");
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption-img");

    img.onclick = function () {
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
    }

    var span = document.getElementsByClassName("close-img")[0];

    span.onclick = function () {
        modal.style.display = "none";
    }

    // prod_image_1
    var modal_1 = document.getElementById("myModal-img_1");
    var img_1 = document.getElementById("img-preview_1");
    var modalImg_1 = document.getElementById("img01_1");
    var captionText_1 = document.getElementById("caption-img_1");

    img_1.onclick = function () {
        modal_1.style.display = "block";
        modalImg_1.src = this.src;
        captionText_1.innerHTML = this.alt;
    }

    var span_1 = document.getElementsByClassName("close-img_1")[0];

    span_1.onclick = function () {
        modal_1.style.display = "none";
    }

    // prod_image_2
    var modal_2 = document.getElementById("myModal-img_2");
    var img_2 = document.getElementById("img-preview_2");
    var modalImg_2 = document.getElementById("img01_2");
    var captionText_2 = document.getElementById("caption-img_2");

    img_2.onclick = function () {
        modal_2.style.display = "block";
        modalImg_2.src = this.src;
        captionText_2.innerHTML = this.alt;
    }

    var span_2 = document.getElementsByClassName("close-img_2")[0];

    span_2.onclick = function () {
        modal_2.style.display = "none";
    }

    // prod_image_3
    var modal_3 = document.getElementById("myModal-img_3");
    var img_3 = document.getElementById("img-preview_3");
    var modalImg_3 = document.getElementById("img01_3");
    var captionText_3 = document.getElementById("caption-img_3");

    img_3.onclick = function () {
        modal_3.style.display = "block";
        modalImg_3.src = this.src;
        captionText_3.innerHTML = this.alt;
    }

    var span_3 = document.getElementsByClassName("close-img_3")[0];

    span_3.onclick = function () {
        modal_3.style.display = "none";
    }


});










