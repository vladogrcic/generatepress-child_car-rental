<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>
<script>
	jQuery('.entry-content').on('click', '.products-by-category > ul > li', function (e) {
		jQuery(this).data("order");
		var cList = jQuery('#car-info-popup > .modal > .description > .info');
		var car = carInfo[jQuery(this).data("order")];
		cList.find('ul.item-list').remove();
		jQuery('#car-info-popup > .modal > .title > h2').text(car.title);
		jQuery('#car-info-popup > .modal > .description > a.link-to-item').attr('href', car.itemLink);
		jQuery('#car-info-popup > .modal > .image > div').css('background-image', 'url('+car.image+')');
        jQuery('#car-info-popup-wrapper').show();
		var ul = '<ul class="item-list">';
		var iconsList = jQuery('#car-info-popup .icons li'),iconsListName;
		var className = '';
		var removeIcon = [];
		var removeIconUpper = [];
		iconsListName=[];
		iconsListNameOld=[];
		for (var j=0; j<iconsList.length; j++) {
			iconsListName.push((jQuery(iconsList[j]).attr('class').substring(4, jQuery(iconsList[j]).attr('class').length)));
			iconsListNameOld.push((jQuery(iconsList[j]).attr('class').substring(4, jQuery(iconsList[j]).attr('class').length)));
		}
		for (var key in car.data) {
            if (car.data.hasOwnProperty(key)) {
				removeIcon.push(car.data[key].name.toLowerCase().replace(/ /g,"-"));
				removeIconUpper.push(car.data[key].name);
            }
		}
		removeIcon.push('price');
		removeIconUpper.push('Price');
		iconsListName.sort(function(a, b){
			return removeIcon.indexOf(a) - removeIcon.indexOf(b);
		});
		for (let u = 0; u < iconsListName.length; u++) {
			jQuery('#car-info-popup .icons').insertAt(u, jQuery('#car-info-popup .icons li.img-'+iconsListName[u]));
		}
        for (var key in removeIconUpper) {
            if (removeIconUpper.hasOwnProperty(key)) {
				ul = ul + '<li>' + removeIconUpper[key] + '</li>';
            }
		}
		for (var i=0; i<iconsList.length; i++) {
				var element = jQuery(iconsList[i]);
				var className = element.attr('class').substring(4, element.attr('class').length);
				if(jQuery.inArray( className, removeIcon )==-1) jQuery( '#car-info-popup .icons .img-'+className.toLowerCase().replace(/ /g,"-") ).hide();
				else jQuery( '#car-info-popup .icons .img-'+className.toLowerCase().replace(/ /g,"-") ).show();
		}
        cList.append(ul);
		ul = '<ul class="item-list">';
        if (typeof car.data.isArray === 'undefined') var length = Object.keys(car.data).length;
        else var length = car.data.length;
        for (let i = 0; i < length + 1; i++) {
            ul = ul + '<li>:</li>'
        }
        cList.append(ul);
        ul = '<ul class="item-list">';
        for (var key in car.data) {
            if (car.data.hasOwnProperty(key)) {
                ul = ul + '<li>' + car.data[key].value + '</li>'
            }
        }
        ul = ul + '<li>' + car.price + '</li>'
        ul += '</ul>';
        cList.append(ul);
    });
    jQuery('.entry-content').on('click', '.overlay', function (e) {
		e.stopPropagation();
        jQuery('#car-info-popup-wrapper').hide();
    });
</script>
<?php if (!isset($image[0])) {
    $image[0] = wc_placeholder_img_src('woocommerce_single');
}
?>
<div id="car-info-popup-wrapper" class="" style="display: none">
	<div class="overlay" style=""></div>
	<div id="car-info-popup" class="" style="">
		<div class="modal">
			<div class="image">
				<div style="background-image: url(<?php echo $image[0]; ?>);height: 100%; background-size: contain;"></div>
			</div>
			<div class="title">
				<h2>Fiat Bravo</h2>
			</div>
			<div class="description">
				<div class="title">
					<h2>Description</h2>
				</div>
				<div class="info clearfix">
					<ul class="icons">
						<li class="img-engine">
							<img width="36" src="<?php echo get_stylesheet_directory_uri() . '/img/piston.svg' ?>" alt="">
						</li>
						<li class="img-seats">
							<img width="36" src="<?php echo get_stylesheet_directory_uri() . '/img/seat.svg' ?>" alt="">
						</li>
						<li class="img-air-conditioning">
							<img width="36" src="<?php echo get_stylesheet_directory_uri() . '/img/air-conditioner.svg' ?>" alt="">
						</li>
						<li class="img-price">
							<img width="36" src="<?php echo get_stylesheet_directory_uri() . '/img/coins.svg' ?>" alt="">
						</li>
					</ul>
				</div>
				<a class="link-to-item" href="">Rent It! 🡆</a>
				<p>*the price stated is valid for long term rentals 30+ days</p>
			</div>
		</div>
	</div>
</div>
