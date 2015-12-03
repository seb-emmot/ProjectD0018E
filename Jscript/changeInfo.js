/**
 * <input type='hidden' name='var' value="<?php echo "$var"; />
 */
function changeInfo(id){
	var container = document.getElementById(id);
	var f = document.createElement("form");
	f.setAttribute('method',"post");
	f.setAttribute('action',"../SQLcalls/updateInfoProcess.php");
	var input = document.createElement("input");
	var submit = document.createElement("input");
	var hidden = document.createElement("input");
    input.type = "text";
    input.name = "changed";
    submit.type = "submit";
    submit.value = "change";
    hidden.type = "hidden";
    hidden.name = "var";
    hidden.value = id;
    container.appendChild(document.createElement("br"));
    f.appendChild(input);
    f.appendChild(hidden);
    f.appendChild(submit);
    container.appendChild(f);
}