/**
 * Maps an error code to an error message.
 */
var pageTitleMap = {
		RtlCust 			: "| Fidelity Investments",
		CgfCust 			: "| Fidelity Charitable Gift Fund",
		NBPart 				: "| Fidelity NetBenefits",
		eWPEmp 				: "| Fidelity eWorkplace"

};

pageTitleMap.getTitle= function(context, currTitle) {
	var title = null;
	if( context != null && context !== "" )	
	{				
		title = pageTitleMap[context];
	}	
	return currTitle + title;
};


