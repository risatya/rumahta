/**
 * Maps an context/post login to a cancel link.
 */
var cancelLinkMap = {
		"RtlCust" 			: "https://login.fidelity.com/ftgw/Fas/Fidelity/RtlCust/Logout/Init?AuthRedUrl=http://personal.fidelity.com/accounts/services/content/pinchange2.shtml.cvsr?refhp=c",
		"CgfCust" 			: "https://login.fidelity.com/ftgw/Fas/Fidelity/CgfCust/Login/Init",
		"NBPart" 				: "https://login.fidelity.com/ftgw/Fas/Fidelity/NBPart/Login/Init",
		"eWPEmp" 				: "https://login.fidelity.com/ftgw/Fas/Fidelity/eWPEmp/Login/Init",
		"RtlCust.PostLogin"	: "https://login.fidelity.com/ftgw/Fas/Fidelity/RtlCust/Verify/Response?AuthRedUrl=https%3A%2F%2Fscs.fidelity.com%2Fcustomeronly%2Fprofilelanding.shtml",
		"CgfCust.PostLogin"	: "https://login.fidelity.com/ftgw/Fas/Fidelity/CgfCust/Verify/Response",
		"NBPart.PostLogin"	: "https://login.fidelity.com/ftgw/Fas/Fidelity/NBPart/Verify/Response?AuthRedUrl=https%3A%2F%2Fnetbenefits.fidelity.com%2FNBTransfer%2F%3Foption%3DLoginPrefOverview",
		"eWPEmp.PostLogin"	: "https://login.fidelity.com/ftgw/Fas/Fidelity/eWPEmp/Verify/Response"

};

cancelLinkMap.setLink= function(context) {
	var link = null;
	if( context != null && context !== "" )	{			
		link = cancelLinkMap[context];
	}	
	return link;
};


