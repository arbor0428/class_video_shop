$(function(){
    gsap.registerPlugin(ScrollTrigger); 
    
    $(window).scroll(function(){
        ScrollTrigger.matchMedia({
            "(max-width: 1920px)": function () {
                ScrollTrigger.create({
                    trigger: ".subWrap .detail_right",
                    start: "top 200px", 
                    end: "bottom 50px",
                    pin: ".subWrap .detail_right .pin_box",
                    //markers: true
                });

            },
        })
    });
});