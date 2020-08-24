jQuery(document).ready(function ($) {
	var $grid = $('.grid').isotope({
		itemSelector: '.element-item',
		layoutMode: 'fitRows'
	});

	var filters = {};

	$('.filters').on( 'click', 'li.btn-item', function( event ) {
		var $button = $( event.currentTarget );
		var $buttonGroup = $button.parents('.button-group');
		var filterGroup = $buttonGroup.attr('data-filter-group');
		filters[ filterGroup ] = $button.attr('data-filter');
		var filterValue = concatValues( filters );
		$grid.isotope({ filter: filterValue });
	});

// change is-checked class on buttons
$('.button-group').each( function( i, buttonGroup ) {
	var $buttonGroup = $( buttonGroup );
	$buttonGroup.on( 'click', 'li.btn-item', function( event ) {
		$buttonGroup.find('.is-checked').removeClass('is-checked');
		var $button = $( event.currentTarget );
		$button.addClass('is-checked');
	});
});

// flatten object by concatting values
function concatValues( obj ) {
	var value = '';
	for ( var prop in obj ) {
		value += obj[ prop ];
	}
	return value;
}
$(function() {
	$('[data-popup-open]').on('click', function(e) {
		var targeted_popup_class = jQuery(this).attr('data-popup-open');
		$('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);

		e.preventDefault();
	});

	//----- CLOSE
	$('[data-popup-close]').on('click', function(e) {
		var targeted_popup_class = jQuery(this).attr('data-popup-close');
		$('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);
		e.preventDefault();
	});
});
$('.plugin-list').each(function() {
	var $this = $(this);
	$this.find( ".install_plugin" ).click(function() {
		var current_parent = $(this);
		var action = 'utdi_plugin_install';
		var p_slug =$(this).data('slug');
		var p_filename =$(this).data('pfilename');
		var p_source =$(this).data('plink');
		var btn_process =$(this).data('process');
		var uni = $('.install_plugin[data-slug="'+ p_slug +'"]');
		var data ={
			'action': action,
			'p_slug': p_slug,
			'p_filename': p_filename,
			'p_source': p_source,
		};
		$.ajax({
			type: "POST",
			dataType: "json",
			url: ajaxurl,
			data: data,
			beforeSend:function(xhr){
				current_parent.html(btn_process);
				current_parent.addClass('process-class');
			},success: function(data){
				uni.html("Activated");
				uni.attr('data-process', 'Activated');
				current_parent.removeClass('process-class');
				uni.addClass('btn-disable');
				uni.removeClass('activate-now');
			},error: function(errorThrown){
				alert('Plugin Slug not matched');
			} 
		});
		return false;
	});
});
});