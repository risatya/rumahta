	 function clearAnswers() {				
		clearAnswer($("#year"), $("#yearHidden"));
		clearAnswer($("#day"), $("#birthdateEntered"));
		clearAnswer($("#sqaAnswerGeneric"), $("#sqaAnswerGenericHidden"));
		unmaskMonthDropdownAndSelect($("#month"), "00");
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

	function concatenateDateValues(monthId, dayId, birthdateId) {

	    if($(monthId).val() != null ) {
	    	var monthVal = $(monthId).val().replace("Month", "");
	    	var dayVal = pad2($(dayId).val());
	    	var birthdateVal = $(birthdateId).val();
	
	    	if(monthVal != "" || dayVal != "") {
	    		if(monthVal != "**********" && dayVal != "**") {
	    			$(birthdateId).val(monthVal + dayVal);
	    		} else if(monthVal != "**********") {
	    			$(birthdateId).val(monthVal + birthdateVal.substring(2,4));
	    		} else if(dayVal != "**") {
	    			$(birthdateId).val(birthdateVal.substring(0,2) + dayVal);
	    		}



	    	}
	    }
	}
	
	
	function isLegacy(question) {
	    if(question == "01" || question == "02" || question == "03" || question == "04" || question == "05" || question == "06" || question == "07") {
			return true;
	    } else {
	        return false;		
		}
	}
	
	function pad2(number) {
		return ((number < 10 && number > 0 && number.length < 2) ? '0' : '') + number;	
	}

	function set_title(monthId, dayId, yearId, answerId, questionId)
	{
	    var question = $(questionId).val();
		switch (question) {
			case "08" :
				$(monthId).attr("title", "Mother's birth date: Month");
				$(dayId).attr("title", "Mother's birth date: Day");
				break;
			case "09" :
				$(monthId).attr("title", "Father's birth date: Month");
				$(dayId).attr("title", "Father's birth date: Day");
			    break;
			case "10" :
				$(yearId).attr("title", "Date of high school graduation");
			    break;
			case "11" :
				$(answerId).attr("title", "Last four digits of your cell phone number");
				break;
			case "12" :
				$(answerId).attr("title", "Last four digits of your drivers license number");
				break;
			case "13" :
				$(answerId).attr("title", "Last four digits of your favorite credit card number");
				break;
			default :
				$(answerId).attr("title", "Answer to Security Question");

		}
	}
	
	function populate_answer(questionId, valueId, answerId, answerIdHidden, monthId, dayId, yearId, yearIdHidden, birthdateId) {
	    var question = $(questionId).val();
	    if(question == "08" || question == "09")
	    {		   	
	    	$(monthId).val($(valueId).val().substring(0,2));
		   	$(dayId).val($(valueId).val().substring(2,4));
			maskMyDate(monthId, dayId, birthdateId);
			maskDay(monthId, dayId, birthdateId);
	    } else if (question=="10")
	    {
	    	$(yearId).val($(valueId).val());
	    		maskYear();			
		} else {
	    	$(answerId).val($(valueId).val());
			maskAnswerSqa(answerId, answerIdHidden);
		}
		show_answer(questionId)
	}
	
	function maskAnswer(question, answerId, answerIdHidden, monthId, dayId, yearId, yearIdHidden, birthdateId) {
	    if(question == "08" || question == "09")
	    {		   	
			$("#month option:selected").text("**********");
			$(dayId).val("**");	
	    } else if (question=="10")
	    {
			$(yearId).val("****");			
		} else {
			$(answerId).val("****");
		}
	}
	
	function show_answer(questionId) {
		$("div.errorMessage").remove();
	    var question = $(questionId).val();
		hide_show_answer(question);
	}
	
	function show_answer_with_delay(questionValue) {
		$("div.errorMessage").remove();
		setTimeout(function() {
			hide_show_answer(questionValue);
		}, 100);
	}
	
	function handleQuestionChangeAndClear(questionId) {
		handleQuestionChange(questionId);
		clearAnswers();
		setYearDayMasking('#year', '#day');	
	}
	
	function handleQuestionChange(questionId) {
		set_title('#month', '#day', '#year', '#sqaAnswerGeneric', questionId); 
		var question = $(questionId).val();
		hide_show_answer(question);
		setYearDayMasking('#year', '#day');	
		
	}
	
	function hasValue(field, hiddenField) {				
		if (hiddenField ==  "") {
			return false;
		} else {
			return true;
		}
	}
	  
	function hide_show_answer(questionValue) {
	    if(questionValue == "08" || questionValue == "09")
	    {
	        $("#row1").show();
	        $("#row2").hide();
	        $("#row3").hide();
	        $("#row4").hide();
	        $("#SAS").hide();
	    }
	    else if (questionValue=="10")
	    {
	        $("#row1").hide();
	        $("#row2").show();
	        $("#row3").hide();
	        $("#row4").hide();
	        $("#SAS").hide();
	    } else if (questionValue=="11" || questionValue=="12" || questionValue=="13" || questionValue==""){
	        $("#row1").hide();
	        $("#row2").hide();
	        $("#row3").show();
	        $("#row4").hide();
	        $("#SAS").hide();
		} else 
		{
	        $("#row1").hide();
	        $("#row2").hide();
	        $("#row3").hide();
	        $("#row4").show();			
		}	
	}
	
	function selectFocus(questionValue){
		if(questionValue == "08" || questionValue == "09")
	    {
	        $("#month").focus();
	    }
	    else if (questionValue=="10")
	    {
	        $("#year").focus();
	    } else if (questionValue=="11" || questionValue=="12" || questionValue=="13" || questionValue==""){
	        $("#sqaAnswerGeneric").focus();
		} else 
		{
	        $("#sqaAnswerLegacy").focus();
		}	
		
		
	}

	function setYearDayMasking(yearId, dayId) {
		if ($(yearId).val() == "") {
			$(yearId).val("YYYY");			
		}
		if ($(dayId).val() == "") {
			$(dayId).val("DD");			
		}
	}

	function setAnswer(monthId, dayId, yearId, yearHidden, birthdateId, answerId, hiddenAnswerId, answerGeneric) {
		if($(monthId).is(":visible")) {
			concatenateDateValues(monthId, dayId, birthdateId);
			$(hiddenAnswerId).val($(birthdateId).val());
		} else if($(yearId).is(":visible")) {
			$(hiddenAnswerId).val($(yearHidden).val());
		} else if($(answerGeneric).is(":visible")) {
			$(hiddenAnswerId).val($(answerId).val());
		}

	}

	function setLegacyAnswer(legacyAnswer, hiddenAnswerId) {
		$(hiddenAnswerId).val($(legacyAnswer).val());
	}
	
	var maskedMonthValues = {'00':'Month', '01':'January', '02':'February', 
			'03':'March', '04':'April', '05':'May', '06':'June', 
			'07':'July', '08':'August', '09':'September', '10':'October',
			'11':'November', '12':'December'};
	
	function maskMyDate(monthId, dayId, birthdateId) {		
		if ($("#month option:selected").val() != "00") {
			concatenateDateValues(monthId, dayId, birthdateId);
			$("#month option:selected").text("**********");
		}
	}

	function unmaskMyDate(monthId, dayId, birthdateId) {
	   $("#month option:selected").text(monthMap.getValue($("#month").val()));
	}

	function maskAnswerSqa()	{
		var answerField = $('#sqaAnswerGeneric');
		var hiddenAnswerField = $('#sqaAnswerGenericHidden');
		if ($(answerField).val() != "****") {
			$(hiddenAnswerField).val($(answerField).val());	
		}
		if ($(answerField).val() != "") {
			$(answerField).val("****");
		}
	}

	function unmaskAnswerSqa()
	{
		var answerField = $('#sqaAnswerGeneric');
		var hiddenAnswerField = $('#sqaAnswerGenericHidden');	
	   	$(answerField).val($(hiddenAnswerField).val());
	}

	function maskDay(monthId, dayId, birthdateId)
	{	
		concatenateDateValues(monthId, dayId, birthdateId);
		if ($(dayId).val() == "" || $(dayId).val() == "DD") {
			$(dayId).val("DD");
		} else {
			$(dayId).val("**");			
		}
	}

	function unmaskDay(answerField, hiddenAnswerField)
	{	   	
		var test = $(hiddenAnswerField).val();
		if ($(answerField).val() == "**") {
			$(answerField).val(test.substring(2,4));
		}
	}
	
	function clearAnswer(field, copyField)
	{
		$(field).val("");
		$(copyField).val("");
	}
	
	function unmaskMonthDropdownAndSelect(monthField, monthValue)
	{
		$('#month option').each(function(index, option)
		{
			$(option).remove();
		});
		monthMap.populateSelectMonths("#month");
		monthField.val(monthValue);
	}

	function unmaskMonthDropdown(monthField)
	{
		for(var i = 0; i < monthField.options.length; ++i) {
			monthField.options[i].text = maskedMonthValues[monthField.options[i].value];
		}
	}	
	
	function maskMonthDay() {
		maskDay('#month','#day','#birthdateEntered');
		maskMyDate('#month','#day','#birthdateEntered');
	}
	
	function unmaskMonthDay() {


		unmaskMyDate('#month','#day','#birthdateEntered');
		unmaskDay('#day','#birthdateEntered');	
	}

	function maskYear()	{
		var answerField = $('#year');
		var hiddenAnswerField = $('#yearHidden');
		if ($(answerField).val() != "****") {
			$(hiddenAnswerField).val($(answerField).val());	
		}
		if ($(answerField).val() != "" && $(answerField).val() != "YYYY") {
			$(answerField).val("****");
		}
}

	function unmaskYear()
{
		var answerField = $('#year');
		var hiddenAnswerField = $('#yearHidden');
		if ($(answerField).val() != "YYYY") {			
			$(answerField).val($(hiddenAnswerField).val());
		}
}
	
	function setAnswerFocus(questionValue) {
		if(questionValue == "08" || questionValue == "09") {
			$("#month").focus().select();
		}
		else if (questionValue=="10") {
			$("#year").focus().select();
		} else if (questionValue=="11" || questionValue=="12" || questionValue=="13" || questionValue==""){
			$("#sqaAnswerGeneric").focus().select();
		} else {
			$("#sqaAnswerGeneric").focus().select();		
		}	
	}
	
	function setHiddenAnswer(answerField, hiddenAnswerField) {
		if ($(answerField).val() != "****") {
			$(hiddenAnswerField).val($(answerField).val());	
		}
	}
	
	function setHiddenDateAnswer(monthId, dayId, birthdateId) {
		if ($("#month option:selected").val() != "00") {
			concatenateDateValues(monthId, dayId, birthdateId);
		}
	}
	
	function setValidationFocus(form,validator) {
		//This focuses to the first field with an error.  Weird bug when first input field/enter key are used require
		//that we save the error entry and re-add it as it got killed
		var errorElement = validator.errorList[0].element;
		var saveErrorEntry = validator.errorList[0];
		var saveValidator = validator.errorList;
		
		//Get ID that we are currently focused on and fire focusout event for it, ie masking
		if ($(document.activeElement).attr("id") && $(document.activeElement).attr("id") != "") {
			var focusedId = "#".concat($(document.activeElement).attr("id"));
			$(focusedId).trigger("focusout");
		}
		
		//set focus to first error element
		$(errorElement).focus();
		validator.errorList = saveValidator;
		
		//force focusin event to fire for first error element, ie unmask
		var elementId = "#".concat($(errorElement).attr("id"));
		$(elementId).trigger("focusin");
		
}

	function removeDropdownErrors(questionId) {
		$("div.errorMessage").remove();	
		$(questionId).parent().parent().removeClass("errorInputRow");
		$(questionId).parent().parent().parent().parent().parent().parent().removeClass("errorInputRow");
		$(questionId).parent().parent().siblings().removeClass("errorInputRow");
			if($(questionId).siblings("div.errorMessage").length)
		{
			$(questionId).siblings("div.errorMessage").remove();
		}
		if($(questionId).parent().parent().siblings().find("div.errorMessage").length)
		{
			$(questionId).parent().parent().siblings().find("div.errorMessage").remove();
		}
	}
	
	function unmaskDayKeyUp(monthField, dayField, copyField) {
		if($(dayField).val() == "**")
		{
			unmaskDay(dayField,copyField);	
		}	
	}

	function unmaskYearKeyUp(yearField, copyField) {
		if($(yearField).val() == "****")
		{
			unmaskYear();	
		}	
	}

	function unmaskAnswerKeyUp(answerField) {
		if($(answerField).val() == "****")
		{	
			unmaskAnswerSqa();
		}	
	}
	
	function setupSqaFunctions(questionId) {

		$("#sqaAnswerGeneric").focusin(unmaskAnswerSqa);
		$("#sqaAnswerGeneric").focusout(maskAnswerSqa);		
		$("#year").focusin(unmaskYear);
		$("#year").focusout(maskYear);			
		$("#year").keyup(concatenateDateValues("#month", "#day", "#birthdateEntered"));
		$("#year").click(clearYearMasking);
		$("#day").focusin(unmaskMonthDay);
		$("#day").focusout(maskMonthDay);
		$("#day").keyup(concatenateDateValues("#month", "#day", "#birthdateEntered"));
		$("#day").focusin(clearDayMasking);
		$("#month").focusin(unmaskMonthDay);
		$("#month").focusout(maskMonthDay);	
		$("#month").change(concatenateDateValues("#month", "#day", "#birthdateEntered"));

		$("#day").keypress(function(event) {
			if ( event.which == 13 ) {
				setHiddenDateAnswer("#month", "#day", "#birthdateEntered");
			}
		});	
		
		$("#day").keyup(function(event) {
			unmaskDayKeyUp("#month", "#day", "#birthdateEntered");
		});	
		
		$("#year").keypress(function(event) {
			if ( event.which == 13 ) {
				setHiddenAnswer('#year', '#yearHidden');
			}
		});	
		
		$("#year").keyup(function(event) {
			unmaskYearKeyUp('#year', '#yearHidden');
		});	
		
		$("#sqaAnswerGeneric").keypress(function(event) {
			if ( event.which == 13 ) {
				setHiddenAnswer('#sqaAnswerGeneric', '#sqaAnswerGenericHidden');
			}
		});		

		
		$("#sqaAnswerGeneric").keyup(function(event) {
			unmaskAnswerKeyUp('#sqaAnswerGeneric');
		});	
		
		$(questionId).keyup(function() {	
			handleQuestionChange(questionId);
		});
		
		//IE handling since change events do not bubble up
		$(questionId).keydown(function(e) {			
			//IE handling since arrow keys don't fire keydown, etc..			
			var keyCode = e.keyCode || e.which,
			arrow = {left: 37, up: 38, right: 39, down: 40 };
			$(questionId).attr("title", "");
			switch (keyCode) {
			    case arrow.left:
					removeDropdownErrors(questionId);
					handleQuestionChangeAndClear(questionId);	
					break;
				case arrow.up:
					removeDropdownErrors(questionId);
					handleQuestionChangeAndClear(questionId);	
					break;
				case arrow.right:
					removeDropdownErrors(questionId);
					handleQuestionChangeAndClear(questionId);	
					break;
				case arrow.down:
					removeDropdownErrors(questionId);
					handleQuestionChangeAndClear(questionId);	
				break;
			}	
			
		});
		
		//IE handling since change events do not bubble up
		$("#month").keydown(function(e) {	
			//IE handling since arrow keys don't fire keydown, etc..
			var keyCode = e.keyCode || e.which,
			arrow = {left: 37, up: 38, right: 39, down: 40 };
			$("#month").attr("title", "");
			switch (keyCode) {
			    case arrow.left:
					removeDropdownErrors("#month");
					break;
				case arrow.up:
					removeDropdownErrors("#month");
					break;
				case arrow.right:
					removeDropdownErrors("#month");
					break;
				case arrow.down:
					removeDropdownErrors("#month");	
				break;
			}	
			
		});		

		$(questionId).live("change", function(){
		    removeDropdownErrors(questionId);
			handleQuestionChangeAndClear(questionId);	  
		});
		
		$('#month').live("change", function(){
		    removeDropdownErrors("#month");  
		});
		
		$('body').delegate(questionId + " select","change", function() {
            removeDropdownErrors(questionId);
                handleQuestionChangeAndClear(questionId);
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
		$("input[type=password]").keyup( function (e) {
            if(e.keyCode == 13 || e.keyCode == 9) {
              return false;
            }
            $(this).attr("title", "");
        });
}
	
