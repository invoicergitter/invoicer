var mobile = false;
var show = false;

function mode_mobile()
{
	if (!mobile)
		{
			$( '.widget' ).attr('class','widget_mobile');
			$( 'nav img' ).attr('class','img_mobile');
			$( 'nav' ).css('position','relative');
			$( 'footer' ).attr('class','footer_mobile');
			$( '.button_menu' ).css('display','block');
			$( '.item_menu' ).css('display','none');
			mobile = true;
		}
	
	
	
}
function mode_large()
{
	if (mobile)
	{
		$( '.widget_mobile' ).attr('class','widget');
		$( 'nav img' ).attr('class','');
		$( 'footer' ).attr('class','');
		$( 'nav' ).css('position','fixed');
		$( '.button_menu' ).css('display','none');
		$( '.item_menu' ).css('display','');
		mobile = false;
	}
	
}


$( document ).ready(function() {
	
	($( window ).width() < 700)?mode_mobile():mode_large();
	
	$( window ).resize(function() {
		if ($( window ).width() < 700)
			{
				mode_mobile();
			}
		else
			{
				mode_large();
			}
		});
	
	
	$( '.button_menu' ).on(
			{ 
				click :
				function (e) 
				{
					if (mobile)
					{
						if(show)
						{
							$( '.item_menu' ).css('display','none');
							$( 'nav' ).css('height','40px');
							show = false;
						}
						else
						{
							$( '.item_menu' ).css('display','block');
							$( 'nav' ).css('height','auto');
							show=true;
						}
						
					}
				}
			}
	);
	
});