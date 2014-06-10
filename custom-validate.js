// JavaScript Document validation functions


// check start and end places
function formchecker()
{
// Check the value of the element named text_name from the form named text_form
	if (document.mainForm.start.value == "")
	{
	  
	  // If null display and alert box
	   alert("Please fill in the Start Place.");
	   
	  // Place the cursor on the field for revision
	   document.mainForm.start.focus();
	  // return false to stop further processing
	   return (false);
	}
	if (document.mainForm.end.value == "")
	{
	  
	  // If null display and alert box
	   alert("Please fill in the Destination.");
	   
	  // Place the cursor on the field for revision
	   document.mainForm.end.focus();
	  // return false to stop further processing
	   return (false);
	}
	return true;
}
//#####......................
