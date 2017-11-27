function firstFunction() {
	var addMore = document.getElementById("add_more");
	addMore.addEventListener('click',addField,false);
}

var i = 0;
function addField() {
	i++;

	var text = '';
	text += '<div class="ingredients_each_'+ i +'">';
	text += '<input class="item" type="text" name="ingredient[]" placeholder="Item" required>';
	text += '<input class="amount" type="text" name="amount[]" placeholder="Amount" required>';
	text += '<button type="button" class="remove_button" onclick="removeField('+ i +')">X</button>';
	text += '</div>';

	$("#ingredients").append(text);
}

function removeField(i) {
	$(".ingredients_each_" + i + "").remove();
}

window.addEventListener('load',firstFunction,false);