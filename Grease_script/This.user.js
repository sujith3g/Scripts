// ==UserScript==
// @name        This
// @namespace   http://127.0.0.1/
// @description bla
// @include     http://www.mca.gov.in/DCAPortalWeb/dca/AuthorizedSignDtls.do?method=getdtls
// @include     http://www.mca.gov.in/DCAPortalWeb/dca/MyMCALogin.do?method=setDefaultProperty&mode=39
// @include     http://www.mca.gov.in/MCA21/Master_data.html
// @include     http://www.mca.gov.in/DCAPortalWeb/dca/MyMCALogin.do?method=setDefaultProperty&mode=31
// @version     1
// ==/UserScript==
if(window.self==window.top) {
	if(String(document.location) == "http://www.mca.gov.in/MCA21/Master_data.html") {
	GM_setValue("count", "0");
	document.location = " http://www.mca.gov.in/DCAPortalWeb/dca/MyMCALogin.do?method=setDefaultProperty&mode=39";
	//alert(parseInt(GM_getValue("count"))+1);
	}
	if(String(document.location) == "http://www.mca.gov.in/DCAPortalWeb/dca/AuthorizedSignDtls.do?method=getdtls") {
		var tr = document.getElementsByTagName('tr');
		var cin_num = document.getElementById('companyCIN').value;
		var c_name = document.getElementById('companyName').value;
		if(tr.length == 2){
			document.location ="http://www.mca.gov.in/DCAPortalWeb/dca/MyMCALogin.do?method=setDefaultProperty&mode=39";
		}else{
		flag=0;
			for(i=0;i<tr.length;i++){
				if(tr[i].className == "RowData" || tr[i].className == "RowDataS"){
					flag = 1;
					var td = tr[i].getElementsByTagName('td');
					//var td1 = tr[i].getElementsByTagName('td');
					
					//alert(td1[0].innerHTML+td1[1].innerHTML+td1[2].innerHTML+td1[3].innerHTML+td1[4].innerHTML+td1[5].innerHTML);
					GM_xmlhttpRequest({
					method:"POST",
					url:"http://localhost/roop/add.php",
					data:"CIN="+cin_num+"&cname="+c_name+"&din="+td[0].innerHTML+"&fname="+td[1].innerHTML+"&address="+escape(td[2].innerHTML)+"&designation="+td[3].innerHTML+"&date="+escape(td[4].innerHTML)+"&dsc="+escape(td[5].innerHTML)+"&expiry="+escape(td[6].innerHTML),
					headers:{ "Content-Type":"application/x-www-form-urlencoded" },
					
					});
					//alert(c_name+td[0].innerHTML+td[1].innerHTML+td[2].innerHTML+td[3].innerHTML+"=>"+td[4].innerHTML.length+td[5].innerHTML+td[6].innerHTML);
					
				}
			}
			if(flag==0){
			//alert("To be removed");
				GM_setValue("count",parseInt(GM_getValue("count"))+1);
				window.setTimeout('document.location="http://www.mca.gov.in/DCAPortalWeb/dca/MyMCALogin.do?method=setDefaultProperty&mode=39"', 3000);
			}else{
				GM_setValue("count",parseInt(GM_getValue("count"))+1);
				window.setTimeout('document.location="http://www.mca.gov.in/DCAPortalWeb/dca/MyMCALogin.do?method=setDefaultProperty&mode=39"', 3000);
			}
		}	
	}
	if(String(document.location)=="http://www.mca.gov.in/DCAPortalWeb/dca/MyMCALogin.do?method=setDefaultProperty&mode=39") {
		var cin = document.getElementById("companyCIN");
		var button = document.getElementById("Default");
		var lines;
		GM_xmlhttpRequest({ method:"GET", url:"http://localhost/roop/LIST.txt",
onload: function(response) {
	var txt = response.responseText;
	lines = txt.split(/\r\n|\r|\n/);
	var count =parseInt(GM_getValue("count"));
	//alert(lines[count]);
	
	cin.value=lines[count];
	button.click();
}});		
		
}
}
