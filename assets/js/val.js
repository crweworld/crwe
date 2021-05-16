(function($,W,D)
{
    var JQUERY4U = {};
 
    JQUERY4U.UTIL =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $("#register-form").validate({
                rules: {
                    name: {
						 required: true,
					 lettersonly: true,
					},
                    
                    email: {
                        required: true,
                        email: true
                    },
                    phone: {
                        required: true,
						number:true,
                        minlength: 10,
						maxlength: 10
						
                    },
                    car: {
                        required: true,
                       
                    },
                },
               
                submitHandler: function(form) {
                    form.submit();
                }
            });
        }
    }
 
    //when the dom has loaded setup form validation rules
    $(D).ready(function($) {
        JQUERY4U.UTIL.setupFormValidation();
    });
	jQuery.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^[a-z]+$/i.test(value);
}, "Letters only please"); 
 
})(jQuery, window, document);