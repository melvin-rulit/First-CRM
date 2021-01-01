$(document).ready(function(){
    let links = $('.menu_link');

    links.on("click", function(){
        alert("The paragraph was clicked.");
    });

    links.on('click', function(){
        links.removeClass('active');
        $(this).addClass('active');
    });
});
