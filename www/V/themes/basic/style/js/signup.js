$( document ).ready(function() {
$( '#owner' ).on
('click',
	function (e)
	{
		$( '.owner' ).css('display','block');
		$( '.tenant' ).css('display','none');
	}
);

$( '#tenant' ).on
('click',
	function (e)
	{
		$( '.owner' ).css('display','none');
		$( '.tenant' ).css('display','block');
	}
);

});