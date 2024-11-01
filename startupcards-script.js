function startupcards_open_frontend_tab(evt, tabName) {
	// Declare all variables
	var i, tabContent, tabLinks;

	// Get all elements with class="tabcontent" and hide them
	tabContent = document.getElementsByClassName("startupcards-tab");
	for (i = 0; i < tabContent.length; i++) {
		tabContent[i].style.display = "none";
	}

	// Get all elements with class="tablinks" and remove the class "active"
	tabLinks = document.getElementsByClassName("startupcards--tab");
	for (i = 0; i < tabLinks.length; i++) {
		tabLinks[i].className = tabLinks[i].className.replace(
			" startupcards-active-tab",
			""
		);
	}

	// Show the current tab, and add an "startupcards-active-tab" class to the button that opened the tab
	document.getElementById(tabName).style.display = "block";
	evt.currentTarget.className += " startupcards-active-tab";
}
