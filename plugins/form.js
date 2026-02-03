function submitform(vform)
{
vform.submit() ;
}

function setCount(target,vform,url){
 
// the next 3 lines are the main lines of this script
//remember to leave action field blank when defining the form 
if(target == 0) vform.action=url;
}

function confirmSubmit(msg) 
{
var agree=confirm(msg);
if (agree)
	return true ;
else
	return false ;
}

function itemChanged(menu,tr1,nilai) 
{
if (menu.options[menu.selectedIndex].value==nilai) 
	{ 
	tr1.style.display = ''; 
	}   
else 
	{
	tr1.style.display = 'none'; 
	}
}
