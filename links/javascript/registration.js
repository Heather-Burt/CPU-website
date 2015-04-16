function addInput(liName){
	var newli = document.createElement('li');
	newli.innerHTML = "<label for='speed[]'>Maximum Speed: </label><input type='text' maxlength='2' required name='speed[]' /><br /><label for='trackedObject[]'>Type of Object: </label><input type='text' maxlength='20' required name='trackedObject[]' /><br /><label for='icon[]'>Download Icon: </label><input type='file' name='icon[]' required />";
	elem(liName).appendChild(newli);
}
function show(selection){
	elem('step1').style.display = "none";
	elem('step2').style.display = "none";
	elem('step3').style.display = "none";
	elem(selection).style.display = "block";
	if(selection == "step3")
	{
		elem('map-canvas').style.display = "block";
	}
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
