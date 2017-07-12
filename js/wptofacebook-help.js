jQuery( document ).ready( function( $ ) {
	var icons = {
			header: "ui-icon-circle-arrow-e",
			headerSelected: "ui-icon-circle-arrow-s"
		};
		
	$( "#accordion" ).accordion({
		autoHeight: false,
		navigation: true,
		collapsible: true,
		icons: icons
	});
});