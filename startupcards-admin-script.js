window.addEventListener("load", function () {
	// store rtabs variables
	var tabs = document.querySelectorAll("ul.startupcard-admin-nav-tabs > li");

	for (i = 0; i < tabs.length; i++) {
		tabs[i].addEventListener("click", startupcards_switchTab);
	}

	function startupcards_switchTab(event) {
		event.preventDefault();
		document
			.querySelector(
				"ul.startupcard-admin-nav-tabs li.startupcard-admin-active"
			)
			.classList.remove("startupcard-admin-active");
		document
			.querySelector(".startupcard-admin-tab-pane.startupcard-admin-active")
			.classList.remove("startupcard-admin-active");

		var clickedTab = event.currentTarget;
		var anchor = event.target;
		var activePaneID = anchor.getAttribute("href");

		clickedTab.classList.add("startupcard-admin-active");
		document
			.getElementById(activePaneID)
			.classList.add("startupcard-admin-active");
	}
});
