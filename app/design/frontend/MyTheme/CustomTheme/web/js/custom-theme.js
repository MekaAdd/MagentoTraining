require([
    'jquery' // Assuming you need jQuery
], function ($) {
    $(document).ready(function () {
        $(".block.newsletter").detach().prependTo('.newsletter-socials');
    });
});