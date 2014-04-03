$(document).ready(function(){
	$('.posts').fadeIn(750);
	
	
});

function checkPass(p1, field) {
	var p2 = field.val();
	if (p1 != p2 || p1 == '' || p2 == '') {
		alert(unescape("Die eingegebenen Passw%F6rter stimmen nicht %FCberein%21"));
    } else {
       field.parent().parent().find('input.button').removeAttr('disabled');
    }
}