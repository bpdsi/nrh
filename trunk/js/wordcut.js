var myGlobalHandler = {
	onCreate: function() {
		Element.show('working');	
		Element.hide('cuttext');
	},
	onComplete: function() {
		if(Ajax.activeRequestCount == 0) {
			Element.hide('working');
			Element.show('cuttext');
		}
	}
};

Ajax.Responders.register(myGlobalHandler);

function create_ajax()
{
   var xmlHttp;
   try {
      xmlHttp = new XMLHttpRequest();
      if (xmlHttp.overrideMimeType) {
         xmlHttp.overrideMimeType('text/xml');
      }
   } catch (e){ // IE
      try {
         xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
      } catch (e) {
         try {
            xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
         } catch (e) {
            alert("Your browser does not support AJAX!");
            return false;
         }
      }
   }
   
   return xmlHttp;
}
function thaicut(text)
{
	xmlHttp = create_ajax();
    var pars = 'tg_format=json' + '&text=' + text;
	var url;
    url='http://naist.cpe.ku.ac.th/cutstring';
    //url = url + '?' + pars;
    //var x=document.getElementByID(cuttext)
      xmlHttp.onreadystatechange = function() {
         if (xmlHttp.readyState==4) {
            if (xmlHttp.status==200) {
			  // alert("bb"+x[0]);
               alert(xmlHttp.responseText);
            } else {
               alert('There was a problem with soudex service. [' + xmlHttp.status + ']');
            }
         }
      }

      xmlHttp.open("post",url,true);     
      xmlHttp.send(pars);
	  /*xmlhttp.open("POST","ajax_test.asp",true);
	 xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	 xmlhttp.send("fname=Henry&lname=Ford");*/
}

function requestCutString(text) {
//alert(text);
	var pars = 'tg_format=json' + '&text=' + text;
	var url = 'http://naist.cpe.ku.ac.th/cutstring';
	var myAjax = new Ajax.Request(url,
		{
			method: 'post',
			parameters: pars,
			onComplete: showResult
		});
}

function requestCutTagString(text) {
	var pars = 'tg_format=json' + '&text=' + text;
	//var pars = 'tg_format=json' + '&text=' + $F('text');
	var url = 'http://naist.cpe.ku.ac.th/cut_tag_string';
	var myAjax = new Ajax.Request(url,
		{
			method: 'post',
			parameters: pars,
			onComplete: showResult
		});
}

function showResult(originalRequest)
{
	var response = originalRequest.responseText;
	var json_object = eval('(' + response + ')');

	var x =  H1(null,"Output");
	var currentlines = map(line_display, json_object['outputs']);
	
	replaceChildNodes("cuttext", currentlines);
}

function line_display(line)
{
	return P(null, line);
}

function clearText()
{
	$('text').value = '';
	replaceChildNodes("cuttext",'');
	Element.hide('cuttext');
}
