
(function($) {
    $.fn.extend({
        shows: function(divs) {
            var w = this.width(),
                h = this.height(),
                xpos = w / 2,
                ypos = h / 2,
                eventType = "",
                direct = "";
            this.css({
                "overflow": "hidden",
                "position": "relative"
            });
            divs.css({
                "position": "absolute",
                "top": this.width()
            });
            this.on("mouseenter mouseleave", function(e) {
                var oe = e || event;
                var x = oe.offsetX;
                var y = oe.offsetY;
                var angle = Math.atan((x - xpos) / (y - ypos)) * 180 / Math.PI;
                if (angle > -45 && angle < 45 && y > ypos) {
                    direct = "down";
                }
                if (angle > -45 && angle < 45 && y < ypos) {
                    direct = "up";
                }
                if (((angle > -90 && angle < -45) || (angle > 45 && angle < 90)) && x > xpos) {
                    direct = "right";
                }
                if (((angle > -90 && angle < -45) || (angle > 45 && angle < 90)) && x < xpos) {
                    direct = "left";
                }
                move(e.type, direct)
            });

            function move(eventType, direct) {
                if (eventType == "mouseenter") {
                    switch (direct) {
                        case "down":
                            divs.css({
                                "left": "0px",
                                "top": h
                            }).stop(true, true).animate({
                                "top": "0px"
                            }, "fast");
                            break;
                        case "up":
                            divs.css({
                                "left": "0px",
                                "top": -h
                            }).stop(true, true).animate({
                                "top": "0px"
                            }, "fast");
                            break;
                        case "right":
                            divs.css({
                                "left": w,
                                "top": "0px"
                            }).stop(true, true).animate({
                                "left": "0px"
                            }, "fast");
                            break;
                        case "left":
                            divs.css({
                                "left": -w,
                                "top": "0px"
                            }).stop(true, true).animate({
                                "left": "0px"
                            }, "fast");
                            break;
                    }
                } else {
                    switch (direct) {
                        case "down":
                            divs.stop(true, true).animate({
                                "top": h
                            }, "fast");
                            break;
                        case "up":
                            divs.stop(true, true).animate({
                                "top": -h
                            }, "fast");
                            break;
                        case "right":
                            divs.stop(true, true).animate({
                                "left": w
                            }, "fast");
                            break;
                        case "left":
                            divs.stop(true, true).animate({
                                "left": -w
                            }, "fast");
                            break;
                    }
                }
            }
        }
    });
})(jQuery)

var wrap = $('.case .list-wrap .wrap');
$(".case li .list").each(function(i){
    $(this).shows(wrap.eq(i));
});
