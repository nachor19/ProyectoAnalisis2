var controlarNavbar = function(){
    window.onscroll = function() {
        stickyNav()
    };
    var navbar = document.getElementById("navbar");
    var sticky = navbar.offsetTop;
    // agregar las clases
    function stickyNav() {
        if (window.pageYOffset >= sticky) {
            navbar.classList.add("sticky")
        } else {
            navbar.classList.remove("sticky");
        }
    } 
}
