/**
 * Maps an error code to an error message.
 */
var errorMap = {
		NoMatchFound 			: "<strong>Error:</strong> One or more of your entries did not match our records.  Please try again.",
		IdNotAvailable 			: "<strong>Error:</strong> The username you selected is not available.  Please enter a new username.",
		CurrentPinWrong 		: "<strong>Error:</strong> The current password you have entered is incorrect.  Please try again.",
		PinHasRepeatingDigits	: "<strong>Error:</strong> Passwords cannot contain more than five instances of a single number and/or letter (e.g. 111111, AAAAAA).  Please enter a new password.",
		PinHasSequence 			: "<strong>Error:</strong> Passwords cannot contain more than five sequential digits (e.g., 123456, 9876543).  Please enter a new password.",
		PinHasSsn 				: "<strong>Error:</strong> A new password cannot contain your Social Security number, Tax Identification number, G-number, or username.  Please enter a new password.",
		PinHasAci 				: "<strong>Error:</strong> Passwords cannot contain your username. Please enter a new password.",
		PinHasDob 				: "<strong>Error:</strong> Passwords cannot contain your date of birth.  Please enter a new password.",
		PinIsWeak 				: "<strong>Error:</strong> A Password should be at least 6 characters long. Please enter a new password.",
		RppAnswerWrong			: "<strong>Error:</strong> Your security question answer did not match the answer we have on file.  Please enter the answer you provided when you originally selected this question.",
		SQAAnsInvalid			: "<strong>Error:</strong> Your security question answer did not match the answer we have on file.  Please enter the answer you provided when you originally selected this question.",
		ChallengeAnswerInvalid	: "<strong>Error:</strong> Your security question answer did not match the answer we have on file.  Please enter the answer you provided when you originally selected this question.",
		EmailInvalid			: "<strong>Error:</strong> The email address you have entered is invalid.  Please try again.",
		OldPINInvalid			: "<strong>Error:</strong> The Password you have entered is invalid.  Please try again.",
		SQAAnsLenInvalid		: "<strong>Error:</strong> A security answer must be between 3 and 31 letters and/or numbers.  Please enter a new answer that is between 3 and 31 letters and/or numbers.",
		SQAAnsChrInvalid		: "<strong>Error:</strong> The answer to the security question cannot contain special characters (*,$,_,/,%).  Please enter a new answer.",
		RPPAnsInvalid			: "<strong>Error:</strong> A security answer must be between 3 and 31 letters and/or numbers.  Please enter a new answer that is between 3 and 31 letters and/or numbers.",
		MissingValue			: "<strong>Error:</strong> All required fields must be completed to continue.",
		SQAAnsNumInvalid		: "<strong>Error:</strong> The answer you have entered must be numeric characters only. Please try again.",
		SQAAnsForbidden			: "<strong>Error:</strong> The answer you provided is not allowed.  Please enter a new answer.",
		AciHasPin				: "<strong>Error:</strong> Your username cannot contain your password.  Please enter a new username.",
		AciNotValid				: "<strong>Error:</strong> The username you selected is not available.  Please enter a new username.",
		AciAlphaLengthErr		: "<strong>Error:</strong> Usernames of 9 to 11 characters must include at least two letters.  Please enter a new username.",
		AciHasInvalidChar		: "<strong>Error:</strong> Enter a new username that does not contain special characters (e.g., #,%,/,*).",
		NotUniqueId				: "<strong>Error:</strong> The username you selected is not available.  Please enter a new username.",
		NewPinBad				: "<strong>Error:</strong> The New Password you have entered is invalid.  Please try again.",
		RequiredEmailMissing	: "<strong>Error:</strong> Please enter an email.",
		InvalidContent			: "<strong>Error:</strong> Password must contain at least one uppercase letter, one lowercase letter, and one number.   Please enter a new password.",
		InvalidReusePin			: "<strong>Error:</strong> This password has already been used. Please enter a new password.",
		InvalidDictionary		: "<strong>Error:</strong> The password you selected is too common.  For your security, please enter a stronger password.",
		InvalidSpechrRequired	: "<strong>Error:</strong> Password must contain at least one special character.   Please enter a new password.",
		InvalidUpcaseRequired	: "<strong>Error:</strong> Password must contain at least one uppercase letter.   Please enter a new password.",
		InvalidLowercaseRequired	: "<strong>Error:</strong> Password must contain at least one lowercase letter.   Please enter a new password.",	
		InvalidDigitsRequired	: "<strong>Error:</strong> Password must contain at least one number.   Please enter a new password."	

};
var headerErrorMap = {
		PinHasSequence 			: "We're sorry. One or more of your entries did not match our records.",
		NoMatchFound 			: "Please correct the following:",
		IdNotAvailable 			: "Please correct the following:",
		CurrentPinWrong 		: "Please correct the following:",
		PinHasRepeatingDigits	: "Please correct the following:",
		PinHasSequence 			: "Please correct the following:",
		PinHasSsn 				: "Please correct the following:",
		PinHasAci 				: "Please correct the following:",
		PinHasDob 				: "Please correct the following:",
		PinIsWeak 				: "Please correct the following:",
		RppAnswerWrong			: "Please correct the following:",
		SQAAnsInvalid			: "Please correct the following:",
		ChallengeAnswerInvalid	: "Please correct the following:",
		EmailInvalid			: "Please correct the following:",
		OldPINInvalid			: "Please correct the following:",
		SQAAnsLenInvalid		: "Please correct the following:",
		SQAAnsChrInvalid		: "Please correct the following:",
		RPPAnsInvalid			: "Please correct the following:",
		MissingValue			: "Please correct the following:",
		SQAAnsNumInvalid		: "Please correct the following:",
		SQAAnsForbidden			: "Please correct the following:",
		AciHasPin				: "Please correct the following:",
		AciNotValid				: "Please correct the following:",
		AciAlphaLengthErr		: "Please correct the following:",
		AciHasInvalidChar		: "Please correct the following:",
		NotUniqueId				: "Please correct the following:",
		NewPinBad				: "Please correct the following:",
		RequiredEmailMissing	: "Please correct the following:",
		InvalidContent			: "Please correct the following:",
		InvalidReusePin			: "Please correct the following:",
		InvalidDictionary		: "Please correct the following:",
		InvalidSpechrRequired	: "Please correct the following:",
		InvalidUpcaseRequired	: "Please correct the following:",
		InvalidLowercaseRequired	: "Please correct the following:",	
		InvalidDigitsRequired	: "Please correct the following:"	
		
};

errorMap.getValue= function(errorCode) {
	var errorMsg = null;
	if( errorCode != null && errorCode !== "" )	
	{				
		errorMsg = errorMap[errorCode];
	}	
	return errorMsg;
};

errorMap.getHeaderValue= function(errorCode) {
	var errorMsg = null;
	if( errorCode != null && errorCode !== "" )	
	{				
		errorMsg = headerErrorMap[errorCode];
	}	
	return errorMsg;
};
