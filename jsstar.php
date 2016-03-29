<script>

if(document.getElementById("memberID").value!=""){
	document.getElementById("star1").title="1";
	document.getElementById("star2").title="2";
	document.getElementById("star3").title="3";
	document.getElementById("star4").title="4";
	document.getElementById("star5").title="5";
}

function starOver(starID){

	if(document.getElementById("memberID").value!=""){
	document.getElementById(starID).src="img/star-dark.png";
	}
	
}
function starOut(starID){
	if(document.getElementById("memberID").value!=""){
	var starImg=document.getElementById(starID).alt;
	document.getElementById(starID).src="img/star"+starImg+".png";
	}
	
}


function calRating(point,pid){
	var mem=document.getElementById("memberID").value;
	if(document.getElementById("memberID").value==""){
	
	}
	else{
		//window.alert("ratingg.php?point=" +point+"&mem="+mem+"&pid="+pid);
		if (window.XMLHttpRequest) {
	    // code for IE7+, Firefox, Chrome, Opera, Safari
	    xmlhttp=new XMLHttpRequest();
		} else {  // code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function() {
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {        	
					var rate=parseFloat(xmlhttp.responseText);
					rate=rate.toFixed(2); 
						
if(4.75<=rate&&rate<=5){

document.getElementById("star1").src="img/starnew.png";
document.getElementById("star2").src="img/starnew.png";
document.getElementById("star3").src="img/starnew.png";
document.getElementById("star4").src="img/starnew.png";
document.getElementById("star5").src="img/starnew.png";

document.getElementById("star1").alt="new";
document.getElementById("star2").alt="new";
document.getElementById("star3").alt="new";
document.getElementById("star4").alt="new";
document.getElementById("star5").alt="new";

}
else if(3.75<=rate&&rate<4.75){
document.getElementById("star1").src="img/starnew.png";
document.getElementById("star2").src="img/starnew.png";
document.getElementById("star3").src="img/starnew.png";
document.getElementById("star4").src="img/starnew.png";

document.getElementById("star1").alt="new";
document.getElementById("star2").alt="new";
document.getElementById("star3").alt="new";
document.getElementById("star4").alt="new";

if(rate-4>=0.25){ document.getElementById("star5").src="img/starhalf.png"; document.getElementById("star5").alt="half"; }
else { document.getElementById("star5").src="img/star.png"; document.getElementById("star5").alt=""; }
}
else if(2.75<=rate&&rate<3.75){
document.getElementById("star1").src="img/starnew.png";
document.getElementById("star2").src="img/starnew.png";
document.getElementById("star3").src="img/starnew.png";

document.getElementById("star1").alt="new";
document.getElementById("star2").alt="new";
document.getElementById("star3").alt="new";

if(rate-3>=0.25) { document.getElementById("star4").src="img/starhalf.png";document.getElementById("star4").alt="half";}
else {document.getElementById("star4").src="img/star.png"; document.getElementById("star4").alt=""; }

document.getElementById("star5").src="img/star.png";
document.getElementById("star5").alt="";
}
else if(1.75<=rate&&rate<2.75){
document.getElementById("star1").src="img/starnew.png";
document.getElementById("star2").src="img/starnew.png";

document.getElementById("star1").alt="new";
document.getElementById("star2").alt="new";

if(rate-2>=0.25) { document.getElementById("star3").src="img/starhalf.png"; document.getElementById("star3").alt="half"; }
else { document.getElementById("star3").src="img/star.png"; document.getElementById("star3").alt=""; }

document.getElementById("star4").src="img/star.png";
document.getElementById("star5").src="img/star.png";

document.getElementById("star4").alt="";
document.getElementById("star5").alt="";
}
else if(0.75<=rate&&rate<1.75){
document.getElementById("star1").src="img/starnew.png";
document.getElementById("star1").alt="new";

if(rate-1>=0.5){  document.getElementById("star2").src="img/starhalf.png";document.getElementById("star2").alt="half";}
else { document.getElementById("star2").src="img/star.png";document.getElementById("star2").alt="";}

document.getElementById("star3").src="img/star.png";
document.getElementById("star4").src="img/star.png";
document.getElementById("star5").src="img/star.png";

document.getElementById("star3").alt="";
document.getElementById("star4").alt="";
document.getElementById("star5").alt="";
}
else if(0<=rate&&rate<0.75){
if(rate-1>=0.25){ document.getElementById("star1").src="img/starhalf.png"; document.getElementById("star1").alt="half";}
else { document.getElementById("star1").src="img/star.png"; document.getElementById("star1").alt="";}

document.getElementById("star2").src="img/star.png";
document.getElementById("star3").src="img/star.png";
document.getElementById("star4").src="img/star.png";
document.getElementById("star5").src="img/star.png";

document.getElementById("star2").alt="";
document.getElementById("star3").alt="";
document.getElementById("star4").alt="";
document.getElementById("star5").alt="";
}
					
			    
			}
		}
	xmlhttp.open("GET","ratingg.php?point=" +point+"&mem="+mem+"&pid="+pid,false);
	xmlhttp.send();
		
	}
}

/*
*/
</script>
