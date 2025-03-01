function toggleMenu() {
    let menu = document.querySelector(".nav-links");
    menu.classList.toggle("active");

    document.addEventListener("click", function(event) {
        if (!menu.contains(event.target) && !event.target.closest(".menu-icon")) {
            menu.classList.remove("active");
        }
    });
}

window.addEventListener("scroll", function() {
    let navbar = document.querySelector(".navbar");
    if (window.scrollY > 50) {
        navbar.classList.add("scrolled");
    } else {
        navbar.classList.remove("scrolled");
    }
});

window.addEventListener('scroll', function() {
    const navbar = document.querySelector('.navbar');
    const hero = document.querySelector('.hero');
    const heroHeight = hero.offsetHeight;

    if (window.scrollY > heroHeight) {
        navbar.classList.add('scrolled');
        navbar.classList.remove('white');
    } else {
        navbar.classList.remove('scrolled');
        navbar.classList.add('white');
    }
});