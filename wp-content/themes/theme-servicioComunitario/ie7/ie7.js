/* To avoid CSS expressions while still supporting IE 7 and IE 6, use this script */
/* The script tag referencing this file must be placed before the ending body tag. */

/* Use conditional comments in order to target IE 7 and older:
	<!--[if lt IE 8]><!-->
	<script src="ie7/ie7.js"></script>
	<!--<![endif]-->
*/

(function() {
	function addIcon(el, entity) {
		var html = el.innerHTML;
		el.innerHTML = '<span style="font-family: \'icomoon\'">' + entity + '</span>' + html;
	}
	var icons = {
		'icon-phone': '&#xe606;',
		'icon-edit': '&#xe605;',
		'icon-edit3': '&#xe607;',
		'icon-envelop': '&#xe945;',
		'icon-user': '&#xe971;',
		'icon-key': '&#xe98d;',
		'icon-earth': '&#xe9ca;',
		'icon-enter': '&#xea13;',
		'icon-exit': '&#xea14;',
		'icon-facebook2': '&#xea8d;',
		'icon-twitter': '&#xea91;',
		'icon-Cat_and_Dog_Vector': '&#xe600;',
		'icon-Cat_Vector': '&#xe601;',
		'icon-Dog_Vector': '&#xe602;',
		'icon-Lupa_Vector': '&#xe603;',
		'icon-Pata_vector': '&#xe604;',
		'0': 0
		},
		els = document.getElementsByTagName('*'),
		i, c, el;
	for (i = 0; ; i += 1) {
		el = els[i];
		if(!el) {
			break;
		}
		c = el.className;
		c = c.match(/icon-[^\s'"]+/);
		if (c && icons[c[0]]) {
			addIcon(el, icons[c[0]]);
		}
	}
}());
