/*+++++++ CHECKED AND UNCHECK +++++++*/
function selectChk(obj,nme){
 
		var eles=obj.form.elements; 
		for (var zxc0=0;zxc0<eles.length;zxc0++){
		if (eles[zxc0].name&&eles[zxc0].name==nme) eles[zxc0].checked=obj.checked;
		}
}//end fun
/*+++++++ Empty PROCESS +++++++*/
function empty_pro(frm,chkname,act,obj){
			eles=document.forms[frm].elements;
			for (var i=0;i<eles.length;i++){
				if (eles[i].name&&eles[i].name==chkname){
					if(eles[i].checked==true){
						if(confirm("Are you sure?")){
							submitForm(frm,act)
							return;
						}else{return;}
					}
					else nocheck=true;
				}
			}//end for
			if(nocheck==true)alert ("Please select "+obj+" from the list to empty");
}//end fun
/*+++++++ PROCESS SEARCH +++++++*/
function pro_search(target,fsearch,vsearch){
	if(vsearch!=""){
	location.href=target+"&fsearch="+fsearch+"&vsearch="+vsearch;
	}
	else{
		alert("Please enter a keyword for searching");
	}
}//end