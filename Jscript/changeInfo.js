/**
 * <input type='hidden' name='var' value="<?php echo "$var"; />
 * transform: rotate(45deg);
 */
function changeInfo(id, picId){
	var pic = document.getElementById(picId);
	var container = document.getElementById(id);
	if(pic.alt == "change"){
		pic.setAttribute('alt', "remove");
		$(pic).css('transform', 'rotate(45deg)');
		var f = document.createElement("form");
		f.setAttribute('id', id+"change");
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
	    //container.appendChild(document.createElement("br"));
	    f.appendChild(input);
	    f.appendChild(hidden);
	    f.appendChild(submit);
	    container.appendChild(f);
	}
	else {
		var removeId =id+"change";
		container.removeChild(document.getElementById(removeId));
		pic.setAttribute('alt', "change");
		$(pic).css('transform', 'rotate(0deg)');
	}
}