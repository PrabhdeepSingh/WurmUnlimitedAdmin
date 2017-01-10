/*!
 * OneApp 1.0.0 (https://github.com/PrabhdeepSingh/OneApp)
 * Copyright 2016 Prabhdeep Singh.
 * Licensed under the MIT license
 */
 
if (typeof jQuery === 'undefined') {
  throw new Error('AppPicker requires jQuery')
}
 
$(function() {
	/**
	 * 
	 * Application configuration
	 *
	 */
	
	// Title of the page
	var pageTitle = 'Server Selection';
	
	// Theme style Default 'light'
	// Options: light or dark
	var theme = 'light';
	
	// How many apps to show per row. Default 2
	// Options: 1, 2, 3, 4, or 6
	var grid = 2;
	
	// List of apps to show on page
	var apps = listOfServers;
	
	/**
	 *
	 * Application logic
	 *
	 */
	
	// Set page title
	$(document).prop('title', pageTitle);
	
	// Set theme
	if (theme === 'light') {
		$('head').append( $('<link rel="stylesheet" type="text/css" />').attr('href', './css/light.css') );
	} else {
		$('head').append( $('<link rel="stylesheet" type="text/css" />').attr('href', './css/dark.css') );
	}
	
	var appHtml = '';
	
	if (apps.length == 0) {
		appHtml = '<div class="col-md-6 col-md-offset-3"><div class="box"><div class="box-body text-center"><p style="margin-top:25px;">You don\'t have any apps setup right now.</p><p>To setup apps go to js/apps.js and add new apps in the apps variable.</p></div></div></div>';
	}
	
	var bootstrapGrid = '';
	var bootstrapDefaultOffset = '';
	var bootstrapAppOffset = '';
	
	switch (grid) {
		case 1:
			bootstrapGrid = 'col-md-12';
		break;
		case 2:
			bootstrapGrid = 'col-md-6';
			bootstrapDefaultOffset = 'col-md-offset-3';
		break;
		case 3:
			bootstrapGrid = 'col-md-4';
			bootstrapDefaultOffset = 'col-md-offset-4';
		break;
		case 4:
			bootstrapGrid = 'col-md-3';
			bootstrapDefaultOffset = 'col-md-offset-4';
		break;
		case 6:
			bootstrapGrid = 'col-md-2';
			bootstrapDefaultOffset = 'col-md-offset-4';
		break;
	}
	
	if (apps.length < grid) {
		var number = (grid - apps.length) + 1;
		number = (number > 4) ? 4 : number;
		bootstrapAppOffset = 'col-md-offset-' + number;
	}

	for(var i = 0; i < apps.length; i++) {
		if (apps.length === 1) {
			appHtml = '<div class="' + bootstrapGrid + ' ' + bootstrapDefaultOffset + '"><a href="' + apps[i].url + '"><div class="box box-center"><div class="box-body">' + apps[i].name + '</div></div></a></div>';
		} else if (grid > 2 && apps.length < grid && i === 0) {
			appHtml += '<div class="' + bootstrapGrid + ' ' + bootstrapAppOffset + '"><a href="' + apps[i].url + '"><div class="box box-center"><div class="box-body">' + apps[i].name + '</div></div></a></div>';
		} else {
			appHtml += '<div class="' + bootstrapGrid + '"><a href="' + apps[i].url + '"><div class="box box-center"><div class="box-body">' + apps[i].name + '</div></div></a></div>';
		}
	}
	
	$('#appList').html(appHtml);
	
});
