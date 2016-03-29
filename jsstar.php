<script>
if(document.getElementById("memberID").value!=""){
	document.getElementById("star1").title="1";
	document.getElementById("star2").title="2";
	document.getElementById("star3").title="3";
	document.getElementById("star4").title="4";
	document.getElementById("star5").title="5";
}

function calRating(point,pid){
	//var x=1.55555;
	//window.alert(x.toFixed(2));
//window.alert(document.getElementById("userID").value );
	var mem=document.getElementById("memberID").value;
	//window.alert(mem );
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
				    	var rate=parseFloat (xmlhttp.responseText);  
					//window.alert(xmlhttp.responseText );
					rate=rate.toFixed(2);
					if(4.75<=rate&&rate<=5){
					document.getElementById("star1").src="img/starnew.png";
					document.getElementById("star2").src="img/starnew.png";
					document.getElementById("star3").src="img/starnew.png";
					document.getElementById("star4").src="img/starnew.png";
					document.getElementById("star5").src="img/starnew.png";
				}
				else if(3.75<=rate&&rate<4.75){
					document.getElementById("star1").src="img/starnew.png";
					document.getElementById("star2").src="img/starnew.png";
					document.getElementById("star3").src="img/starnew.png";
					document.getElementById("star4").src="img/starnew.png";
					if(rate-4>=0.25) document.getElementById("star5").src="img/starhalf.png";
					else document.getElementById("star5").src="img/star.png";
				}
				else if(2.75<=rate&&rate<3.75){
					document.getElementById("star1").src="img/starnew.png";
					document.getElementById("star2").src="img/starnew.png";
					document.getElementById("star3").src="img/starnew.png";
					if(rate-3>=0.25) document.getElementById("star4").src="img/starhalf.png";
					else document.getElementById("star4").src="img/star.png";
					document.getElementById("star5").src="img/star.png";
				}
				else if(1.75<=rate&&rate<2.75){
					document.getElementById("star1").src="img/starnew.png";
					document.getElementById("star2").src="img/starnew.png";
					if(rate-2>=0.25) document.getElementById("star3").src="img/starhalf.png";
					else document.getElementById("star3").src="img/star.png";
					document.getElementById("star4").src="img/star.png";
					document.getElementById("star5").src="img/star.png";
				}
				else if(0.75<=rate&&rate<1.75){
					document.getElementById("star1").src="img/starnew.png";
					if(rate-1>=0.5) document.getElementById("star2").src="img/starhalf.png";
					else document.getElementById("star2").src="img/star.png";
					document.getElementById("star3").src="img/star.png";
					document.getElementById("star4").src="img/star.png";
					document.getElementById("star5").src="img/star.png";
				}
				else if(0<=rate&&rate<0.75){
					if(rate-1>=0.25) document.getElementById("star1").src="img/starhalf.png";
					else document.getElementById("star1").src="img/star.png";
					document.getElementById("star2").src="img/star.png";
					document.getElementById("star3").src="img/star.png";
					document.getElementById("star4").src="img/star.png";
					document.getElementById("star5").src="img/star.png";
				}
				/*var x=1+parseInt(document.getElementById("count").value);
				document.getElementById("showText").style.color="green";
				document.getElementById("id").innerHTML=rate;
				document.getElementById("showText").innerHTML="คะแนนเฉลี่ย : "+rate;*/
					
				
				
				}
			}
		xmlhttp.open("GET","ratingg.php?point=" +point+"&mem="+mem+"&pid="+pid,false);
		xmlhttp.send();		
		
		
	}
}
</script>
