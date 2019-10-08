$(document).ready(function() {


// CONTACT form validation 	
	if (jQuery().validate) {
	    	$("#admin_form").validate({
				rules: {
					password: "required",
					conpass: {
					  equalTo: "#password"
					}
				  },
			 	messages:{
					//password: "required",
					conpass: {
						equalTo:"Password not match, type the same password"
					}
				}
				});	 
	};   
	
	
	
// END
});