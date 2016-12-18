$("#button-toggle").click(function(){
	$('ul.navbar.navbar-nav').slideToggle(200);
});

$('ul.navbar.navbar-nav > li').delegate('a', 'click', function(){
	$('ul.navbar.navbar-nav').slideToggle(100);
});