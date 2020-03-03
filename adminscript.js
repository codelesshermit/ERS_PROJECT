
//getting data from the first aid edip panel

document.getElementById('firstaidedit').addEventListener('submit', makeChange);

function makeChange(e){
e.preventDefault();

var title = getInputVal('issue');
var subtitle = getInputVal('subissue');
var detail = getInputVal('details');

console.log(title, subtitle, detail);
}
//function to get form values

function getInputVal(id){
return document.getElementById(id).value;
}
