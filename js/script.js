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

document.addEventListener('DOMContentLoaded', function() {
    const testimonials = document.querySelectorAll('.testimonial');
    const testimonialsContainer = document.querySelector('.testimonials');
    let currentTestimonial = 0;

    function showTestimonial(index) {
        testimonials.forEach((testimonial, i) => {
            testimonial.classList.remove('active');
            if (i === index) {
                testimonial.classList.add('active');
            }
        });

        const offset = testimonials[index].offsetLeft - (testimonialsContainer.clientWidth / 2) + (testimonials[index].clientWidth / 2);
        testimonialsContainer.scrollTo({
            left: offset,
            behavior: 'smooth'
        });
    }

    function nextTestimonial() {
        currentTestimonial = (currentTestimonial + 1) % testimonials.length;
        showTestimonial(currentTestimonial);
    }

    setInterval(nextTestimonial, 2000); // Change testimonial every 5 seconds
    showTestimonial(currentTestimonial);
});

document.addEventListener("DOMContentLoaded", function () {
    const faqItems = document.querySelectorAll(".faq-question");
    const backButton = document.getElementById("backButton");

    faqItems.forEach(item => {
        item.addEventListener("click", function () {
            const faq = this.parentElement;
            faq.classList.toggle("active");

            // Toggle icon change
            const icon = this.querySelector(".arrow");
            if (faq.classList.contains("active")) {
                icon.textContent = "➖"; // Minus sign when open
            } else {
                icon.textContent = "➕"; // Plus sign when closed
            }
        });
    });

    // Back Button Functionality
    backButton.addEventListener("click", function () {
        window.history.back(); // Go to previous page
    });
});

        function toggleUserType(userType) {
            let buttons = document.querySelectorAll('.tabs button');
            let studentForm = document.getElementById('student-form');
            let instructorForm = document.getElementById('instructor-form');

            buttons.forEach(btn => btn.classList.remove('active'));

            studentForm.classList.remove('active');
            instructorForm.classList.remove('active');

            if (userType === 'student') {
                studentForm.classList.add('active');
                buttons[0].classList.add('active');
            } else {
                instructorForm.classList.add('active');
                buttons[1].classList.add('active');
            }
        }

        document.getElementById('student-form').classList.add("active");

        function logout() {
           window.alert("You have been logged out!");
           window.location.href = "login.html";
        }