String.prototype.capitalize = function() {
	return this.charAt(0).toUpperCase() + this.slice(1);
};

function showHome() {
	$("html").addClass("bg");
	$("#logo").hide();
	$("#sidebar").show().removeClass("grey-background");
	$("#wrapper").hide();
	$(".footer").hide();
	$('#blurb').empty();
}

function showPage() {
	$("html").removeClass("bg");
	$("#logo").removeClass("hidden").show();
	$('#sidebar').addClass("grey-background").show();
	$(".footer").removeClass("hidden").show();
	$("#wrapper").show();
	$('#blurb').show();
}

function setContentTitle(title) {
	$('#title').text(title);
}

function loadAbout() {
	console.log("here");
	$('#text').load("text/content/about.txt")
	$('#text').addClass("leftdiv");
	$('#gallery').addClass("rightdiv");
}

function loadBlurb(page) {
	switch (page) {
		case "home":
		case "about":
		case "contact":
			$('#blurb').empty();
			break;
		default:
			$('#blurb').load("text/blurbs/"+page+".txt");
	}
}

function loadContentText(page) {
	switch (page) {
		case "about":
			loadAbout();
			break;
		default:
			$('#gallery').removeClass("rightdiv");
			$('#text').empty().removeClass("leftdiv");
	}
}

function navigate(clickedElm, push_on_history) {
	if (history.state != clickedElm) {
		history.pushState(clickedElm, null, clickedElm);
	}
	if (clickedElm === 'home') {
		showHome();
	}
	else {
		$('#gallery').load("php/images.php?page="+clickedElm, function() {
			setContentTitle(clickedElm.capitalize());
			loadBlurb(clickedElm);
			loadContentText(clickedElm);
			showPage();
			initGallery();
		});
	}
}

window.onpopstate = function(event) {
    if(event && event.state) {
        navigate(event.state);
    }
}

function initClick(page) {
	$('#'+page).click(function() {
		navigate(page);
	});
}

function initPortfolioHover(page) {
	$('#'+page).click(function() {
		$('#portfoliolinks').toggleClass("no-display");
	});
}

/* PREFETCHING CACHE OPTIMIZATION */
function preloadImages(array) {
    for (i in array) {
        (new Image()).src = array[i];
    }
}

/* TESTING */
// $(function() {
// 	$(window).keypress(function(e) {
// 		var key = e.which;
// 		console.log(key);
// 	});
// });

/* GALLERY */
function initGallery() {
	initImageTitles();
	var prev = null;
	$('.image').click(function(){
		if (prev) {
			$(prev).removeClass("scaled");
		}
		$(this).addClass("scaled");
		prev = this;
	});
}

function initImageTitles() {
	$('.image-div').hover(function() {
		$title = ($(this).children('.img-title'));
		$($title).removeClass("hidden");
	}, 
	function() {
		$title = ($(this).children('.img-title'));
		$($title).addClass("hidden");
	});
}

function fetch() {
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "./php/listing.php",
        success: function(data) {
            preloadImages(data["images"]);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            console.log("Status: " + textStatus + " " + "Error: " + errorThrown);
        }  
    });
}

window.onload = function() {
	var links =["home", "about", "illustrations", "paintings", 
				"printmaking", "commissions", "contact"];
	for (i in links) {
		initClick(links[i]);
	}
	initPortfolioHover("portfolio");
	fetch();
};