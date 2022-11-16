gsap.registerPlugin(ScrollTrigger);


$('body').css('overflow', 'hidden');



if($('.scroll-top-btn')[0]) {
    let scrollBtnStart = gsap.timeline({
        scrollTrigger: {
          trigger: ".hero",
          scrub: 1,
          start: "bottom 350px",
          end: "bottom top",
        },
    });
    
    scrollBtnStart.to(".scroll-top-btn", {
        y: 0,
        opacity: 1,
        stagger: 0.2,
    });
}

window.addEventListener('load', function(){

    $('body').css('overflow', 'unset');
    $('#loading').fadeOut('fast');

    init();
});

function init() {
    gsap.from('.navbar',{
        opacity: 0,
        y: -50,
        duration: 1,
        stagger: 0.4,
        autoAlpha: 0
    });

    if($(".hero-image")[0]) {
        gsap.from('.hero-image',{
            opacity: 0,
            y: -100,
            duration: 1,
            stagger: 0.5,
            autoAlpha: 0
        });
    }

    if($(".hero-content")[0]) {
        gsap.from('.hero-content > div',{
            opacity: 0,
            y: -150,
            duration: 1.6,
            stagger: 0.2,
            autoAlpha: 0
        });
    }
    if($(".hero-content > div > h1 > span")[0]) {
        gsap.from('.hero-content > div > h1 > span',{
            opacity: 0,
            y: -40,
            duration: 1,
            stagger: 0.35
        });
    }

    if($('.quick-plans > a')[0]) {
        gsap.from('.quick-plans > a',{
            scale: 0,
            duration: 1,
            autoAlpha: 0
        });
    }

    if($('.contact-bg')[0]) {
        gsap.from('.contact-bg', {
            xPercent: 100,
            duration: 0.6,
            stagger: 1,
            autoAlpha: 0,
            ease: Power2.easeOut
        });
        gsap.from('.wrapper .contact-overlay', {
            height: "100%",
            duration: 0.8,
            delay: 0.2,
            stagger: -0.3
        });
    }
    // Animation for plans page
    if($('.plans')[0]) {
        gsap.utils.toArray(".title").forEach(title => {
            let tl = gsap.timeline({
                scrollTrigger: {
                    trigger: title,
                    toggleActions: "play none none none",
                    start: "top 85%",
                    markers: false
                }
            });
            
            tl.from(title, {
                duration: 0.8,
                opacity: 0,
                x: -200,
                stagger: 2,
            });
        });

        gsap.utils.toArray(".image").forEach(title => {
            console.log(title);
            let tl = gsap.timeline({
                scrollTrigger: {
                    trigger: $(title).prev()[0],
                    toggleActions: "play none none none",
                    start: "bottom 70%",
                    markers: false
                }
            });
            
            tl.from(title, {
                duration: 0.8,
                delay: 0.2,
                opacity: 0,
                scale: 0,
            });
        });
    }

    
    if($('.left-block')[0] && $('.right-block')[0]) {
        gsap.utils.toArray('.left-block').forEach(leftBlock => {
            let tl = gsap.timeline({
                scrollTrigger: {
                    trigger: leftBlock,
                    markers: false,
                    start: 'top 75%',
                }
            });
            tl.from(leftBlock, {
                duration: 0.5,
                x: -200,
                opacity: 0
            });
        });
        gsap.utils.toArray('.right-block').forEach(rightBlock => {
            let tl = gsap.timeline({
                scrollTrigger: {
                    trigger: rightBlock,
                    start: 'top 75%',
                }
            });
            tl.from(rightBlock, {
                duration: 0.5,
                x: 200,
                opacity: 0
            });
        });
    }
}

$(document).ready(function () {

    // Scroll to top btn
    $(".scroll-top-btn > a").click(function (e) {
        e.preventDefault();

        let hash = $(".hero");
        $("html, body").animate(
        {
            scrollTop: hash.offset().top,
        },
        200
        );
    });
});