$(function(){

	'use strict';


	//Hide placeholder on form focus
	$('[placeholder]').focus(function(){

		$(this).attr('data-text', $(this).attr('placeholder'));

		$(this).attr('placeholder', '');

	}).blur(function(){

		$(this).attr('placeholder', $(this).attr('data-text'));
	});
	

	// Convert Password Field To Text Field On Hover
	var passField = $('.password');

	$('.show-pass').hover(function(){

		passField.attr('type' , 'text');

	}, function(){

		passField.attr('type' , 'password');

	});


});


	