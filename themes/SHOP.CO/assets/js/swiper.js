document.addEventListener("DOMContentLoaded", () => {
    const swiperEl = document.querySelector(".mySwiper");
    if (!swiperEl) return;

    new Swiper(swiperEl, {
        grabCursor: true,
        slidesPerView: 3,
        spaceBetween: 20,
        loop: true,

        navigation: {
            nextEl: ".btn-right",
            prevEl: ".btn-left",
        },

        breakpoints: {
            768: { slidesPerView: 2 },
            1024: { slidesPerView: 3 }
        }
    });
})