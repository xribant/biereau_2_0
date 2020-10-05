var element = document.getElementById('dateNaissance');

$('element').focus(function() {
    $(this).attr('placeholder', 'Date de naissance')
}).blur(function() {
    $(this).attr('placeholder', 'JJ-MM-AAAA')
})