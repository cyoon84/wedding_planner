$(function(){  
   $("#attending").change(function() {
        var val = document.getElementById("attending").value;
        if (!val) {
        	document.getElementById("vegetarian").disabled = "disabled";
        } else {
        	document.getElementById("vegetarian").disabled = "";
        }
   });
}); 