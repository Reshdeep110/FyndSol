//  JAVASCRIPT 
    
        let slideIndex = 0;

        function getSlidesPerView() {
            return 1;
        }

        function initSlider() {
            slideIndex = 0;
            showSlides(slideIndex);

            window.addEventListener('resize', initSlider);
        }

        window.changeSlide = function (n) {
            const slides = document.querySelectorAll('#slides-wrapper .slide');
            const totalSlides = slides.length;
            const slidesPerView = getSlidesPerView();

            slideIndex += n;

            if (slideIndex < 0) {
                slideIndex = totalSlides - slidesPerView;
            } else if (slideIndex > totalSlides - slidesPerView) {
                slideIndex = 0;
            }

            showSlides(slideIndex);
        }

        function showSlides(n) {
            const wrapper = document.getElementById('slides-wrapper');
            if (!wrapper) return;

            const slidesPerView = getSlidesPerView();
            const slides = wrapper.querySelectorAll('.slide');
            const totalSlides = slides.length;

            if (totalSlides === 0) return;

            let actualIndex = n;
            if (n > totalSlides - slidesPerView) {
                actualIndex = Math.max(0, totalSlides - slidesPerView);
            } else if (n < 0) {
                actualIndex = 0;
            }
            slideIndex = actualIndex;

            let translateValue = -(slideIndex * (100 / slidesPerView));

            wrapper.style.transform = `translateX(${translateValue}%)`;
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', () => {
            initSlider();

            // Mobile Menu
            document.getElementById('mobile-menu-btn').addEventListener('click', () => {
                document.getElementById('mobile-menu').classList.toggle('hidden');
            });
        });
   



//  Scroll Animation Script 

document.addEventListener("DOMContentLoaded", () => {

    const animatedItems = document.querySelectorAll(".animate-on-scroll");

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {

                    entry.target.classList.add(
                        "opacity-100",
                        "translate-y-0"
                    );

                    entry.target.classList.remove(
                        "opacity-0",
                        "translate-y-10"
                    );

                    observer.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.2 }
    );

    animatedItems.forEach((item) => observer.observe(item));
});



