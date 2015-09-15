jQuery (document).ready (
		function ($) {
			$ ('tr.event').click (
					function () {
						var url = $ (this).find ('a').attr ('href');
						window.open(url, '_blank');
					}
			);
		}
);