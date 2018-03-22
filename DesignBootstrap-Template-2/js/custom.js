/*global $, jQuery, alert*/
/*
# Clear js
#
# 1) global ...
# 2) 
function () {
    -- code here --    
    ---------------
        # 3) Tab
}
# 4) "use strict" in each global function like => [$(document).ready()] or [$(window).load()], etc ...
# 5) no unspected space
# 6) clean code (space between parm1 and parm2) like => [eq(0).css("backgroundColor", "#E41B17")]
# 7) declare all var in one place
*/
$(document).ready(function () {

    "use strict";

    // start Nice Scroll
    // code to get selected color theme, to use in NiceScroll.js when the user refresh page
    var currentColor = localStorage.getItem('selectedColor');
    (currentColor === null) ? currentColor = "#E41B17" : currentColor;

    $("html").niceScroll({
        zindex: 9999,
        cursorcolor: currentColor,
        cursorwidth: "10px",
        horizrailenabled: false
    });
    // End Nice Scroll

    $('.carousel').carousel({
        interval: 5000
    });

    // Show Color Option Div When Click On The Geat
    $(".gear-check").on("click", function () {
    	$(".color-option").fadeToggle();
    });

    // Start Change Theme Color On click
    // # Caching the [li]s of color option element
    var colorLi = $(".color-option ul li");
    colorLi
    	.eq(0).css("backgroundColor", "#E41B17").end()
    	.eq(1).css("backgroundColor", "green").end()
    	.eq(2).css("backgroundColor", "purple").end()
    	.eq(3).css("backgroundColor", "yellow").end()
    	.eq(4).css("backgroundColor", "#0895D1");

    colorLi.on("click", function () {
    	$("link[href*='-theme.css']").attr("href", $(this).attr("data-value"));

        // code to get selected theme, to use it when the user refresh page
        var selectedTheme = $("link[href*='-theme.css']").attr("href");
        localStorage.setItem('selectedTheme', selectedTheme);

        // code to get selected color theme, to use in NiceScroll.js when the user refresh page
        var selectedColor = $(this).css("backgroundColor");
        localStorage.setItem("selectedColor", selectedColor);
        location.reload(false);
    });

    // code to set selected theme, to use it when the user refresh page
    var currentTheme = localStorage.getItem('selectedTheme');
    (currentTheme === null) ? currentTheme = "css/default-theme.css" : currentTheme;
    $("link[href*='-theme.css']").attr("href", currentTheme);
    // End Change Theme Color On click
	

    // Start Scroll to The Top
    // # Caching the scroll top element
    var scrollButton = $("#scroll-up");
    var screenHeight = $(window).height();

    $(window).scroll(function () {
    	($(this).scrollTop() > screenHeight) ? scrollButton.show() : scrollButton.fadeOut();
    });
    // Click On Button To Scroll Top
	scrollButton.on("click", function () {
		$("html, body").animate({ scrollTop: 0}, 600);
	});
    // End Scroll to The Top


});

// Loading Screen
$(window).load(function () {

    "use strict";

	// Loading Elements
	$(".loading-overlay .cssload-loader").fadeOut(1500, function () {
		// Show The Scroll
		$("body").css("overflow", "auto");

		$(this).parent().fadeOut(100, function () {
			$(this).remove();
		});

	});
});