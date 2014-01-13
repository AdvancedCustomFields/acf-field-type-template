(function ( $ ) {

	/*
	*  acf/setup_fields
	*
	*  This event is triggered when ACF adds any new elements to the DOM.
	*
	*  @type  function
	*  @since 1.0.0
	*
	*  @param e An event object. This can be ignored.
	*  @param postbox An element which contains the new HTML.
	*
	*  @return	N/A
	*/

	$( document ).live( 'acf/setup_fields', function ( e, postbox ) {

		$( postbox ).find( '.my-field-class' ).each( function () {

			// Initiate JS on my field!
			// $( this ).add_awesome_stuff();

		} );

	} );

} ) ( jQuery );
