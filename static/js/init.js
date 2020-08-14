(function($){
    $(function(){

        $('.sidenav').sidenav();
        $('.parallax').parallax();

        var time = 5000;
        $('.carousel.carousel-slider').carousel({
            fullWidth: true,
            indicators: true
        }, setTimeout(autoplay, time));
        function autoplay(){
            $('.carousel').carousel('next');
            setTimeout(autoplay, time);
        }   

        $('select').formSelect();
        $('.slider').slider();
        $('.dropdown-trigger').dropdown();
        $('.modal').modal();
        $('.tabs').tabs();
        $('.tooltipped').tooltip();
        $('.fixed-action-btn').floatingActionButton();
        $('.collapsible').collapsible();

    }); // end of document ready
})(jQuery); // end of jQuery name space