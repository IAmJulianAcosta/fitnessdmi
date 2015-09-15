jQuery (document).ready (
		function ($) {
			$ ('tr.event').click (
					function () {
						window.location = $ (this).find ('a').attr ('href');
					}
			);
		}
);