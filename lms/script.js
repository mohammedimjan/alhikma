function toggleSidebar() {
	var sidebar = document.getElementById("mySidebar");
	if (sidebar.style.left === "-250px") {
		sidebar.style.left = "0";
		document.getElementsByClassName("openbtn")[0].innerHTML = "&times;";
	} else {
		sidebar.style.left = "-250px";
		document.getElementsByClassName("openbtn")[0].innerHTML = "&#9776;";
	}
}

const header = document.querySelector("header");

window.addEventListener("scroll",function(){
    header.classList.toggle("sticky",this.window.scrollY > 0);
});



