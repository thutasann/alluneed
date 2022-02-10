$('#name').on('keyup',function(){
    var name = this.value.toLowerCase().trim();
    slugInput = $('#url'),
    theSlug = name.replace(/&/g,'-and-')
    .replace(/[^a-z0-9-]+/g,'-')
    .replace(/\-\-+/g,'-')
    .replace(/^-+|-+&/g,'-');

    slugInput.val(theSlug);
});

