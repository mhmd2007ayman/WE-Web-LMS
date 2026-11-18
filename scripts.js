// Typed.js
const typed = new Typed('#typed', {
    strings: ["مدرسة <span class='highlight text-light'>وي</span> للتكنولوجيا التطبيقية"],
    typeSpeed: 50,
    backSpeed: 30,
    loop: true, // لن تتكرر الكلمة
    showCursor: true // إخفاء المؤشر
});

// Particles.js
particlesJS.load('particles-js', 'particles.json', function() {
    console.log('Particles.js loaded!');
});

// GSAP Animations
gsap.from(".hero-title", { duration: 2, y: -50, ease: "power4.out" });
gsap.from(".hero-subtitle", { duration: 2, y: 50, delay: 1, ease: "power4.out" });
gsap.from(".btn", { duration: 2, y: 50, opacity: 0, delay: 2, ease: "power4.out" });

// شريط التقدم
window.onscroll = function() {
    const scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
    const scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
    const scrolled = (scrollTop / scrollHeight) * 100;
    document.getElementById("progressBar").style.width = scrolled + "%";
};

// زر العودة إلى الأعلى
const scrollToTopBtn = document.getElementById("scrollToTopBtn");

window.addEventListener("scroll", () => {
    if (window.scrollY > 300) {
        scrollToTopBtn.style.display = "block";
    } else {
        scrollToTopBtn.style.display = "none";
    }
});

scrollToTopBtn.addEventListener("click", () => {
    window.scrollTo({
        top: 0,
        behavior: "smooth"
    });
});

// تأثيرات صوتية
const buttons = document.querySelectorAll(".btn, .card");
buttons.forEach(button => {
    button.addEventListener("click", () => {
        const audio = new Audio("click-sound.mp3"); // أضف ملف صوتي
        audio.play();
    });
});