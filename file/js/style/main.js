(function(f,e,s,j){var n=f("html"),m=f("body"),l=d("main.js"),b="click",a={},o=false,g=true,p=null;if(e.location.hash==""){e.scrollTo(0,1)}f.ajaxSetup({cache:true});var i=navigator.userAgent.match(/(iPad).*OS\s([\d_]+)/),k=navigator.userAgent.match(/TouchPad/),h=navigator.userAgent.match(/PlayBook/),c=navigator.userAgent.match(/KFOT/);var r=(i||k||h||c)?"ipad":"";n.addClass(r);if("ontouchstart" in e||"createTouch" in s){b="touchend";
/*! A fix for the iOS orientationchange zoom bug. Script by @scottjehl, rebound by @wilto.MIT License.*/
}(function(G){function v(){E.setAttribute("content",B),A=!0}function u(){E.setAttribute("content",C),A=!1}function t(H){w=H.accelerationIncludingGravity,z=Math.abs(w.x),y=Math.abs(w.y),x=Math.abs(w.z),(!G.orientation||G.orientation===180)&&(z>7||(x>6&&y<8||x<8&&y>6)&&z>5)?A&&u():A||v()}if(!(/iPhone|iPad|iPod/.test(navigator.platform)&&navigator.userAgent.indexOf("AppleWebKit")>-1)){return}var F=G.document;if(!F.querySelector){return}var E=F.querySelector("meta[name=viewport]"),D=E&&E.getAttribute("content"),C=D+",maximum-scale=1",B=D+",maximum-scale=10",A=!0,z,y,x,w;if(!E){return}G.addEventListener("orientationchange",v,!1),G.addEventListener("devicemotion",t,!1)})(this);a.input={attributes:(function(v){var u={},t=s.createElement("input");f.each(v,function(x,w){u[w]=!!("hasOwnProperty" in t&&t.hasOwnProperty(w))});if(u.list){u.list=!!(s.createElement("datalist")&&e.HTMLDataListElement)}return u})("autocomplete autofocus list placeholder max min multiple pattern required step".split(" "))};if(!a.input.attributes.pattern||!a.input.attributes.required||(a.input.attributes.pattern&&a.input.attributes.required&&(j.indexOf("android")!=-1||(j.indexOf("applewebkit")!=-1&&j.indexOf("chrome")==-1)))){f.getScript(l+"plugins/validation.js",function(){f("form").validate()})}else{f("input,select,textarea").bind("invalid",function(){var t=f(this),u="";if(this.validity.valueMissing){u=t.data("error-empty")||t.closest("form").data("error-empty")}else{if(!this.validity.valid){u=t.data("error-invalid")||t.closest("form").data("error-invalid")}}this.setCustomValidity(u)}).bind("change",function(){this.setCustomValidity("")})}if(!a.input.attributes.autofocus){f("[autofocus]").eq(0).focus()}m.on("focus","input.obfuscate",function(){var t=f(this),v=f("input[name="+t.attr("name").replace("-visible","")+"]"),u;if(v.length&&(u=v.val())!=""){t.val(u)}}).on("blur","input.obfuscate",function(){var u=f(this),v=u.val(),t;f("input[name="+u.attr("name").replace("-visible","")+"]").val(v);if(v.length>3){v=v.split("");t=v.length-3;while(t--){v[t]="*"}u.val(v.join(""))}}).find("input.obfuscate").each(function(){var v=f(this),u=v.attr("name"),t=v.clone().hide().removeClass("obfuscate").attr("name",u).removeAttr("id").removeAttr("required");if(t.is("[pattern]")){t.removeAttr("pattern")}v.attr("name",u+"-visible").after(t).blur()}).end().find("label").attr("onclick","");(function(t){if(t.length){t.each(function(z,v){var y=f(v),u=y.parent(),x=f('<button type="button" class="reset-username text"></button>').text(y.data("reset-text")||"Use a saved username"),w=y.attr("name"),B=f('<input class="obfuscate" type="text" id="username" name="'+w+'-visible" data-error-empty="Please enter your username" data-error-invalid="This field is not properly formatted" required="" maxlength="15"/>'),A=f('<input type="hidden" name="'+w+'"/>');u.on("change",t.selector,function(){if(y.val()=="new"){y.blur().remove();u.append(B.focus()).append(A).find("label").append(x)}}).on(b,"button.reset-username",function(){B.add(A).add(x).remove();u.append(y.val(""))})})}})(f("select#username"));if(!f("html.ipad").length){var q=f('<p class="buttons"><a class="button dial"><b/></a></p>');f("a.tel").each(function(){var t=f(this);q.clone(true).find("a").attr("href",t.attr("href")).end().find("b").text(t.text()+(t.hasClass("tty")?" TTY":"")).end().appendTo(t.closest(".sample,section,details,.notice"))})}(function(){var u="details",v="summary",t=f(u);if(t.length){f.getScript(l+"plugins/details.js",function(){var w="open";n.addClass("detailed");t.details().bind("open.details",function(){f(this).addClass(w).find("[style]").removeAttr("style").end().siblings(u+"."+w).find(v).click().end().end().find(v).focus().end()}).bind("close.details",function(){f(this).removeClass(w)})})}})();function d(t){var w=o,v=new RegExp("^(.*)"+t+"$"),u=f("script[src]").filter(function(){return f(this).attr("src").match(v)});if(u.length){w=u.attr("src").replace(v,"$1")}return w}if("add_deviceprint" in e){f("form").each(function(){f(this).append(f('<input type="hidden" name="DEVICE_PRINT"/>').val(add_deviceprint()))});
/*! Page Tracking & Back */
}(function(){var t=m.find("h1[data-back]");if(t.length){t.eq(0).before(f('<a class="button back">Return to Previous Page</a>').attr("href","javascript:history.go(-1)"))}}())})(jQuery,window,document,navigator.userAgent.toLowerCase());










//(function(h,i,m,k){var e=h("html"),g=h("body"),n=l("main.js"),a="click",c={},j=false,d=true,f=null;if(i.location.hash==""){i.scrollTo(0,1)}h.ajaxSetup({cache:true});if("ontouchstart" in i||"createTouch" in m){a="touchend";
///* A fix for the iOS orientationchange zoom bug. Script by @scottjehl, rebound by @wilto.MIT License.*/
//}(function(B){function q(){z.setAttribute("content",w),v=!0}function p(){z.setAttribute("content",x),v=!1}function o(C){r=C.accelerationIncludingGravity,u=Math.abs(r.x),t=Math.abs(r.y),s=Math.abs(r.z),(!B.orientation||B.orientation===180)&&(u>7||(s>6&&t<8||s<8&&t>6)&&u>5)?v&&p():v||q()}if(!(/iPhone|iPad|iPod/.test(navigator.platform)&&navigator.userAgent.indexOf("AppleWebKit")>-1)){return}var A=B.document;if(!A.querySelector){return}var z=A.querySelector("meta[name=viewport]"),y=z&&z.getAttribute("content"),x=y+",maximum-scale=1",w=y+",maximum-scale=10",v=!0,u,t,s,r;if(!z){return}B.addEventListener("orientationchange",q,!1),B.addEventListener("devicemotion",o,!1)})(this);c.input={attributes:(function(q){var p={},o=m.createElement("input");h.each(q,function(s,r){p[r]=!!("hasOwnProperty" in o&&o.hasOwnProperty(r))});if(p.list){p.list=!!(m.createElement("datalist")&&i.HTMLDataListElement)}return p})("autocomplete autofocus list placeholder max min multiple pattern required step".split(" "))};if(!c.input.attributes.pattern||!c.input.attributes.required||(c.input.attributes.pattern&&c.input.attributes.required&&(k.indexOf("android")!=-1||(k.indexOf("applewebkit")!=-1&&k.indexOf("chrome")==-1)))){h.getScript(n+"plugins/validation.js",function(){h("form").validate()})}else{h("input,select,textarea").bind("invalid",function(){var o=h(this),p="";if(this.validity.valueMissing){p=o.data("error-empty")||o.closest("form").data("error-empty")}else{if(!this.validity.valid){p=o.data("error-invalid")||o.closest("form").data("error-invalid")}}this.setCustomValidity(p)}).bind("change",function(){this.setCustomValidity("")})}if(!c.input.attributes.autofocus){h("[autofocus]").eq(0).focus()}g.on("focus","input.obfuscate",function(){var o=h(this),q=h("input[name="+o.attr("name").replace("-visible","")+"]"),p;if(q.length&&(p=q.val())!=""){o.val(p)}}).on("blur","input.obfuscate",function(){var p=h(this),q=p.val(),o;h("input[name="+p.attr("name").replace("-visible","")+"]").val(q);if(q.length>3){q=q.split("");o=q.length-3;while(o--){q[o]="*"}p.val(q.join(""))}}).find("input.obfuscate").each(function(){var q=h(this),p=q.attr("name"),o=q.clone().hide().removeClass("obfuscate").attr("name",p).removeAttr("id").removeAttr("required");if(o.is("[pattern]")){o.removeAttr("pattern")}q.attr("name",p+"-visible").after(o).blur().focus()}).end().find("label").attr("onclick","");(function(o){if(o.length){o.each(function(u,q){var t=h(q),p=t.parent(),s=h('<button type="button" class="reset-username text"></button>').text(t.data("reset-text")||"Use a saved username"),r=t.attr("name"),w=h('<input class="obfuscate" type="text" id="username" name="'+r+'-visible" data-error-empty="Please enter your username" data-error-invalid="This field is not properly formatted" required="" maxlength="15"/>'),v=h('<input type="hidden" name="'+r+'"/>');p.on("change",o.selector,function(){if(t.val()=="new"){t.blur().remove();p.append(w.focus()).append(v).find("label").append(s)}}).on(a,"button.reset-username",function(){w.add(v).add(s).remove();p.append(t.val(""))})})}})(h("select#username"));if(!h("html.ipad").length){var b=h('<p class="buttons"><a class="button dial"><b/></a></p>');h("a.tel").each(function(){var o=h(this);b.clone(true).find("a").attr("href",o.attr("href")).end().find("b").text(o.text()+(o.hasClass("tty")?" TTY":"")).end().appendTo(o.closest(".sample,section,details,.notice"))})}(function(){var p="details",q="summary",o=h(p);if(o.length){h.getScript(n+"plugins/details.js",function(){var r="open";e.addClass("detailed");o.details().bind("open.details",function(){h(this).addClass(r).find("[style]").removeAttr("style").end().siblings(p+"."+r).find(q).click().end().end().find(q).focus().end()}).bind("close.details",function(){h(this).removeClass(r)})})}})();function l(o){var r=j,q=new RegExp("^(.*)"+o+"$"),p=h("script[src]").filter(function(){return h(this).attr("src").match(q)});if(p.length){r=p.attr("src").replace(q,"$1")}return r}if("add_deviceprint" in i){h("form").each(function(){h(this).append(h('<input type="hidden" name="DEVICE_PRINT"/>').val(add_deviceprint()))});
///* Page Tracking & Back */
//}(function(){var o=g.find("h1[data-back]");if(o.length){o.eq(0).before(h('<a class="button back">Return to Previous Page</a>').attr("href","javascript:history.go(-1)"))}}())})(jQuery,window,document,navigator.userAgent.toLowerCase());



/*****************************/
/**** POPUP WINDOWs ****/
/*****************************/
var helpWin = "";
var lastPopupName = "";

function openFooterPopup(page, popupName, popupWidth, popupHeight)
{
	if (helpWin && !helpWin.closed)
	{
		if (lastPopupName ==  popupName) {
			{helpWin.focus(); return;}
		} else {
			helpWin.close();
		}
	 }
	 helpWin=window.open(page,"Fidelity" + popupName,"width=" + popupWidth + ",height=" + popupHeight + ",left=80,top=80,scrollbars=yes,resizable=yes,toolbar=no,location=no,status=no,menubar=no");
	 lastPopupName = popupName;
	 helpWin.focus();
}

function openMediumWindow(page)
{
	helpWin=window.open(page,"Fidelity","width=722,height=480,left=80,top=80,scrollbars=yes,resizable=yes,toolbar=no,location=no,status=yes,menubar=no");
	helpWin.focus();
}

function ofPopWin1024(theURL) {
  newWindow = window.open(theURL,'subWindow1024','toolbar=no,location=no,scrollbars=yes,status=no,menubar=no,resizable=yes,fullscreen=no,left=80,top=80,height=556,width=808')
  newWindow.focus()
}

function ofPopWinVideo(theURL) 
{
	  newWindow = window.open(theURL,'subWindowVideo','toolbar=no,location=no,scrollbars=no,status=no,menubar=no,resizable=yes,fullscreen=no,left=    80,top=80,height=380,width=617')
	  newWindow.focus()
}

/*****************************/
/** END POPUP WINDOWs **/
/*****************************/



$('#Login').submit(function() {
    //this strips out duplicate ssn input fields on submit
    if($("input[type='text'][name='SSN']").length > 0 && $("select[name='SSN']").length > 0){
        $("input[type='text'][name='SSN']").remove();
    }
        
    if($("#SetLoginDefaults").is(':checked')){
        var act = $("#Login").attr("action");
        var actplus = act + "?AuthRedUrl=https://webxpress.fidelity.com/ftgw/webxpress/DefaultPage?SetLoginDefaults=Y";
        $("#Login").attr("action", actplus);
    }
    
    //validation for default web on chrome browsers
    $.browser.chrome = /chrome/.test(navigator.userAgent.toLowerCase());
    if($.browser.chrome){
        var ERROR = 'error',
        EMPTY = 'error-empty',
        INVALID = 'error-invalid';

        var $form	= $(this),
        $error	= $('<strong/>'),
        empty	= $form.data(EMPTY) || 'This field cannot be left blank',
        invalid = $form.data(INVALID) || 'This field is not properly formatted',
        error	= false; // optimism

        $form
        // cleanup
        .find('li.error')
        .children('strong')
        .remove()
        .end()
        .removeClass(ERROR)
        .end()
        // validation
        .find('input,select,textarea')
        .each(function(){
            var $el = $(this),
            $li	= $el.closest('form > ol > li'),
            val	= $el.val(),
            r,
            e;

            if ( $el.is('[required]') &&
                val == '' )
                {
                e = $el.data(EMPTY) || empty;
                $error
                .clone()
                .text(e)
                .appendTo(
                    $li.addClass(ERROR)
                    );
                error = true;
            }
            // not required or not empty
            else
            {
                if ( $el.is('[pattern]') )
                {
                    r = new RegExp( $el.attr('pattern') );
                    e = $el.data(INVALID) || invalid;
                    if ( ! val.match( r ) )
                    {
                        $error
                        .clone()
                        .text(e)
                        .appendTo(
                            $li.addClass(ERROR)
                            );
                        error = true;
                    }
                }
            }
        });
        
        if($('#Login').length != 0 && ! error){
        	$('button:submit').attr("disabled", true);
        	
        	//sets the correct posted ssn name
            if($('#Login').length != 0 && $('#realSSN').length != 0 && $('#realPIN').length != 0){
                var realSSN = $('#realSSN').val();
                var realPIN = $('#realPIN').val();

                if(realSSN != 'SSN'){
                    $('[name="SSN"]').attr('name', realSSN)
                }
                if(realPIN != 'PIN'){
                    $('#password').attr('name', realPIN)
                }
            }
            //end
        }

        return ! error;
    }
});


if($('#credentialCodeForm').length != 0){
    $('button').click(function(){
        var $form = $('#credentialCodeForm');
        var ERROR = 'matchError';

        $('#alert').html('<p><strong>Error:</strong> The security code you entered is invalid. You may need to reset your credential.</p>');

        $form
        // cleanup
        .find('li.matchError')
        .removeClass(ERROR)
        .end()
    });
}

$('#credentialCodeForm').submit(function() {
    var error = false;
    var $form = $(this);
    var ERROR = 'matchError';
    var $error = $('<li/>');

    $form
    // cleanup
    .find('li.matchError')
    .removeClass(ERROR)
    .end()
    // validation
    .find('#credentialCode, #credentialCode2')
    .each(function(){
        var $el = $(this),
        $li	= $el.closest('form > ol > li');

        if($('#credentialCode').val() == $('#credentialCode2').val()){

            $('#alert').html('<p><strong>Error:</strong> The two Security Codes you entered are the same. Please enter two unique security codes to reset your credential.</p>');

            $error
            .appendTo($li.addClass(ERROR));
            error = true;
        }
    });

    return ! error;
});
//gets called on page load
$(document).ready(function (){	
    // Netbenefits upgrade page is called within a frame, we do not want to bust it 
    if($("#userId").length > 0){
    	$("#userId").focus();
    }    
});