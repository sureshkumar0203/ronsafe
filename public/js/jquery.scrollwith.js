
jQuery.fn.scrollWith = function(options)
{
    if(!document.querySelectorAll) return this;

   
    options = jQuery.extend({
        distanceToTop: 0,
        distanceToBottom: 0
    }, options);

    
    var $win = jQuery(window),
        $doc = jQuery(document);

    return this.each(function(index, ele)
    {
        var
            $ele = jQuery(ele),                         
            $aside = $ele.parent(),                     
            $content = $aside.parent(),                
            asideH = $aside.outerHeight(true),              
            asideMT = parseInt($aside.css('marginTop')),    
            asideMB = parseInt($aside.css('marginBottom')), 
            eleH = $ele.outerHeight(),                  
            eleHT = eleH + options.distanceToTop,       
            eleTop = $ele.offset().top,                
            positionTop = eleTop,                       
            stateNum = 0,                               
            isLast = ("nextElementSibling" in ele ? ele.nextElementSibling : ele.nextSibling) === null, 
            bodyH = $win.height(),
            conH, conTop, conB2Top;

        $aside.css("position") === "static" && ($aside.css("position", "relative"));

       
        !isLast && (positionTop = eleTop = $aside.offset().top + $aside.height());

        
        eleHT > bodyH && (positionTop += eleH - bodyH);

        $win.bind({
            "scroll": doFollow,
            "resize": function(){
                var height = $win.height();
                if(bodyH !== height){
                    bodyH = height;
                    eleHT > bodyH && (positionTop = eleTop + eleH - bodyH);
                    doFollow();
                }
            }
        });
        doFollow();

       
        function doAdjust()
        {
            conH = $content.outerHeight();  
            conTop = $content.offset().top; 
            conB2Top = conTop + conH;      
            setAsideHeight();
        }

       
        function setAsideHeight()
        {
            var height = asideH, temp;
            $aside.siblings().each(function(i, ele){
                height = (temp = $(ele).outerHeight(true)) > height ? temp : height;
            });
            $aside.height(height - asideMT - asideMB);
        }

       
        function doFollow()
        {
            var bodyST = $doc.scrollTop(),             
                conB2Bottom,                            
                eleB2Bottom;                            

            doAdjust();

           
            if(bodyST <= positionTop){
                if(!isLast && stateNum === 1){
                    stateNum = 0;
                }
                $ele.css({position: "static"});
                return;
            }

            conB2Bottom = $doc.height() - conB2Top;
            eleB2Bottom = (eleB2Bottom = options.distanceToBottom - conB2Bottom) > 0 ? eleB2Bottom : 0;

            
            if(eleHT <= bodyH){
                (bodyST + eleHT > conB2Top - eleB2Bottom) ?
                    $ele.css({position: "absolute", top: "auto", bottom: eleB2Bottom + "px"}) :
                    $ele.css({position: "fixed", top: (options.distanceToTop - parseInt($ele.css("marginTop"))) + "55px", bottom: "auto"});
            }
            
            else{
                if(bodyST + bodyH > conB2Top - eleB2Bottom){
                    $ele.css({position: "absolute", top: "auto", bottom: eleB2Bottom + "px"});
                }
                else if(bodyST + bodyH > eleTop + eleH){
                    $ele.css({position: "fixed", top: "auto", bottom: "0"});
                }
            }

           
            if(!isLast && stateNum === 0){
                $ele.hide().stop().fadeIn();
                stateNum = 1;
            }
        }
    });
};