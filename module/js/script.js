$(function(){
    gsap.registerPlugin(ScrollTrigger); 
    
    $(window).scroll(function(){
        ScrollTrigger.matchMedia({
            "(max-width: 1920px)": function () {
                ScrollTrigger.create({
                    trigger: ".subWrap .pc_detail_wrap",
                    start: "top 50px", 
                    end: "bottom 50px",
                    pin: ".subWrap .pc_detail_wrap .pin_box",
                    //markers: true
                });

            },"(min-width: 600px)": function () {
                ScrollTrigger.create({
                    trigger: ".test_answer",
                    start: "top 50px", 
                    end: "bottom 50px",
                    pin: ".test_answer .test_answer_pin_box",
                    //markers: true
                });
            },
        })
    });
});