function addInput(liName){
	var newli = document.createElement('li');
	newli.innerHTML = "<input type='text' maxlength='2' required name='speed[]' /><input type='text' maxlength='20' required name='trackedObject[]' /><input type='file' name='icon[]' required />"
	elem(liName).appendChild(newli);
}
function show(selection){
	elem('step1').style.display = "none";
	elem('step2').style.display = "none";
	elem(selection).style.display = "block";
}	
function elem(elemId) {
    return document.getElementById(elemId);
}
function checkPass()
{
	var pass1 = elem('passwd');
	var pass2 = elem('conpasswd');
	var message = elem('confirmMessage');
	var goodColor = "#66CC66";
	var badColor = "#FF6666";
	if(pass1.value == pass2.value){
		pass2.style.backgroundColor = goodColor;
		message.style.color = goodColor;
		message.innerHTML = "Passwords Match!"
	}else{
		pass2.style.backgroundColor = badColor;
		message.style.color = badColor;
		message.innerHTML = "Passwords Do Not Match!"
	}
}
function validatePass()
{
	var pass1 = elem('passwd');
}
