// nav menu
let menuBtn = document.getElementById('menuBtn')
let subMenu = document.getElementById('subMenu')

function closeMenu() {
    subMenu.classList.remove('open')
    menuBtn.classList.remove('open')
}

menuBtn.addEventListener('mouseenter', () => {
    subMenu.classList.add('open')
    menuBtn.classList.add('open')
})

menuBtn.addEventListener('mouseleave', closeMenu)

subMenu.addEventListener('mouseenter', () => {
    menuBtn.classList.add('open')
    subMenu.classList.add('open')
})
subMenu.addEventListener('mouseleave', closeMenu)

// mobile
let mobileMenuBtn = document.getElementById('mobile-menu-btn')
let mobileMenu = document.getElementById('mobile-menu')

mobileMenuBtn.addEventListener('click', () => {
    mobileMenu.classList.toggle('mb-open')
})
// mobile
let closeBtnNav = document.getElementById('closeBtnNav')
let mbContent = document.getElementById('mbContent')
let openBtnNav = document.getElementById('openBtnNav')
closeBtnNav.addEventListener('click', () => {
    mbContent.classList.remove('show')
})
openBtnNav.addEventListener('click', () => {
    mbContent.classList.add('show')
})
// nav menu end



// sliders
let swiperHero = new Swiper('.swiper-hero', {
    slidesPerView: 1,
    autoplay: {
        delay: 5000,
        disableOnInteraction: true,
    },
    pagination: {
        el: '.custom-pagination', // Use your custom pagination selector
        clickable: true, // Enable bullet click
    },
})

let swiperMarka = new Swiper('.swiper-marka', {
    spaceBetween: 20,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    autoplay: {
        delay: 3000,
        disableOnInteraction: true,
    },
    breakpoints: {
        1080: {
            slidesPerView: 5,
        },
        760: {
            slidesPerView: 2,
        },
        0: {
            slidesPerView: 1,
        }
    }
})

let swiperFertilizerMini = new Swiper(".swiper-fertilizer-mini", {
    spaceBetween: 12,
    clickable: true,
    slideToClickedSlide: true,
    breakpoints: {
        760: {
            slidesPerView: 4,
        },
        0: {
            slidesPerView: 2,
        },
    },
});
let swiperFertilizer = new Swiper(".swiper-fertilizer", {
    slidesPerView: 1,
    spaceBetween: 10,
});

swiperFertilizerMini.controller.control = swiperFertilizer;
swiperFertilizer.controller.control = swiperFertilizerMini;

$(document).ready(function () {
    $('[data-fancybox="gallery"]').fancybox({
        loop: true, // Enable looping through the gallery
    });
});
$(".fancybox").fancybox({
    type: "iframe",
})



function cookieAcceptWhatsapp() {
    createCookie('wp-cookie', '1', 5);
}

function createCookie(name, value, days) {
    var expires;
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    } else {
        expires = "";
    }
    document.cookie = encodeURIComponent(name) + "=" + encodeURIComponent(value) + expires + "; path=/";
}

function readCookie(name) {
    var nameEQ = encodeURIComponent(name) + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) === ' ')
            c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) === 0)
            return decodeURIComponent(c.substring(nameEQ.length, c.length));
    }
    return null;
}

var yesCookie = readCookie('p-cookie');
if (yesCookie == 1) {
    $('.cookie-policy').hide();
}


const firstSession = readCookie('wp-cookie')
$(document).on("click", "#whatsapp-popup", function () {

    $(".whatsapp-wrapper").toggleClass("hide-whatsapp show-whatsapp");
    setTimeout(function () {
        $('.loading-animation').hide();
        $('.whatsapp-message-wrapper').css("display", "flex").hide().fadeIn("slow");
    }, 1000)
});
$(document).on("click", ".close_whatsapp", function () {
    $("#whatsapp-chat")
    $(".whatsapp-wrapper").toggleClass("hide-whatsapp show-whatsapp");
});

document.addEventListener('DOMContentLoaded', function () {
    const formBtn = document.querySelector('.form-btn-mobile');
    const formBtnClose = document.querySelector('.close-btn-form');
    const formContent = document.querySelector('.uzmanina-sor-mobil');

    formBtn.addEventListener('click', function () {
        formContent.style.display = 'block';
        formContent.style.opacity = 1;
    });

    formBtnClose.addEventListener('click', function () {
        formContent.style.display = 'none';
        formContent.style.opacity = 0;
    });
    window.onclick = function (event) {
        if (event.target == formContent) {
            formContent.style.display = "none";
            formContent.style.opacity = 0;
        }
    }
});
Fancybox.bind("[data-fancybox]", {
});





window.addEventListener('scroll', function () {
    const nav = document.getElementById('nav-scroll');
    if (window.scrollY > 0) {
        nav.classList.add('nav-scroll', 'fixed', 'top-0', 'w-full', 'z-50', 'transition-all', 'bg-white');
    } else {
        nav.classList.remove('nav-scroll', 'fixed', 'top-0', 'w-full', 'z-50', 'transition-all', 'bg-white');
    }
});

