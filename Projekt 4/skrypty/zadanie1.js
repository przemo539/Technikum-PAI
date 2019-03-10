function sprawdz(){
	var liczba = parseInt(document.getElementById("liczba").value);
	
		if(liczba>0){
			alert("Liczba jest dodatnia");
			return false;
		}else if(liczba == 0){
			alert("Liczba jest równa 0");
			return false;
		}else if(liczba<0){
			alert("Liczba jest ujemna");
			return false;
		}
}