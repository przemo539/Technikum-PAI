function sprawdz(){
	var od_liczba=parseInt(document.getElementById("od_liczba").value);
	var do_liczba=parseInt(document.getElementById("do_liczba").value);
	if(od_liczba < do_liczba){
		for(i = od_liczba; i<=do_liczba; i++){
			document.write(i+", ");
		}
	}else{
		for(i = od_liczba; i>=do_liczba; i--){
			document.write(i+", ");
		}
	}
}
