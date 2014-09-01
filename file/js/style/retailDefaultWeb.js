function ofPopWinVideo(theURL) {
    newWindow = window.open(theURL,'subWindowVideo','toolbar=no,location=no,scrollbars=no,status=no,menubar=no,resizable=yes,fullscreen=no,left=    80,top=80,height=380,width=617')
    newWindow.focus()
}

function ofPopWin1024(theURL) {
    newWindow = window.open(theURL,'subWindow1024','toolbar=no,location=no,scrollbars=yes,status=no,menubar=no,resizable=yes,fullscreen=no,left=80,top=80,height=556,width=808')
    newWindow.focus()
}


function openMediumWindow(page)
{
    helpWin=window.open(page,"Fidelity","width=722,height=480,left=80,top=80,scrollbars=yes,resizable=yes,toolbar=no,location=no,status=yes,menubar=no");
    helpWin.focus();
}


/*Begin pop up div script */
var lastFocusID;
function showPopupDiv(caller, target, focusID) {
    var caller = document.getElementById(caller);
    var target = document.getElementById(target);
    target.style.display = 'block';
    lastFocusID = caller;
    if(focusID)
        document.getElementById(focusID).focus();
}

function hidePopupDiv(target) {
    document.getElementById(target).style.display = "none";
    lastFocusID.focus();
}
    /*End pop up div script */


//SAVED ID##########################
//$(document).ready(function(){
//    if($(".showHide").length != 0){
//        $(".showHide").hide();
//    }
//});


//sets hidden value for savedId
$("#Login").submit(function(){
	
	var savedId = $("#confirm");
	if (savedId.is(':checked')) {
		$("#SavedIdInd").val("Y");
	} else {
		$("#SavedIdInd").val("N");
	}
	
//	$("#notSet").remove();
	
	return true;
});

$("#userId").change(function() {
    if($(this).val() == "new")
    {
        $(".showHide").show();

        $("#userId").removeAttr("required");
        $("#userId").removeAttr("data-reset-text");

        $("#userId").attr("name","savedIdNotSet");
        $("#userId").attr("id","savedIdNotSet");
        $("#savedIdNotSet").hide();

        $("#notSet").attr("name","SSN-visible");
        $("#notSet").attr("id","userId");
        $("#userId").attr("data-error-empty","Please enter your username");
        $("#userId").attr("data-error-invalid","This field is not properly formatted");
        $("#userId").attr("required","required");
        $("#userId").focus();
        $('#Login').append($('<input id="SSN" type="hidden" name="SSN"/>'));
        
        $('#confirm').prop('checked', false);
    }
});

$("#useSavedId").click(function() {
    $("#userId").removeAttr("required");
    $("#userId").removeAttr("data-error-empty");
    $("#userId").removeAttr("ata-error-invalid");

    $("#userId").attr("name","notSet");
    $("#userId").attr("id","notSet");

    $("#savedIdNotSet").attr("name","SSN");
    $("#savedIdNotSet").attr("id","userId");
    $("#userId").attr("data-reset-text", "$customProperties.get('username_reset_text')");
    $("#userId").attr("required","required");
    $("#userId").show();
    
    $('#userId option')[0].selected = true;//sets option to first index
    $('#confirm').prop('checked', true);
    
    $(".showHide").hide();    
    $("#SSN").remove();
});