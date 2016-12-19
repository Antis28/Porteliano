/**
 * Created by Antis on 22.11.2016.
 */

//
(function($){
    var viewUL = $(".running-ribbon  div.view")
            .css("overflow", "hidden")
            .children("ul"),
        imgs = viewUL.find("a"), 	    // коллекция картинок
        imgW = 234,						// ширина одной картинки
        imgsCount = imgs.length, 		// общее колличество картинок
        totalImgsW = imgsCount * imgW,  // общая ширина
        current = 1; 					// текушая картинка(позиция)
        //console.log('imgsCount = ' + imgsCount);
       // console.log('current = ' + current);
       // console.log('totalImgsW = ' + totalImgsW);
    $(".running-ribbon > div.show")
        .show()
        .find("button").on("click", function(){
        var direction = $(this).attr("id");
        moveRibbon(direction);
        clearTimeout(timerId);
    } );

    function moveRibbon(direction){
        var   position = imgW;
        //var direction = $(this).data("param"); // для html 5
        ///////////////////////////////////////////////////////
        if(direction == "next")
            current ++;
        else
            current --;
        if(current == 0){
            current = imgsCount; // поставить последнюю картинку
            direction = "next";
            position = totalImgsW-imgW;
        }else if(current-1 == imgsCount){
            current = 1;			// поставить первую картинку
            position = 0
        }
        doIt(viewUL, position, direction);
    }
    function doIt(container, position, direction){
        //console.log('current = ' + current);
        //console.log('imgsCount = ' + imgsCount);
        var sign; // "-=" or "+="
        if(direction && position != 0){
            sign = (direction == "next") ? "-=" : "+=";
        }
        var shift = {"margin-left": sign  ? (sign + position) : position};
        var duration ={};
        if(position == 0 || position == imgW*(imgsCount-1)){
            duration = {duration: 0};
        }
        container.animate(shift, duration);

    }

    //TODO регулировка таймера бегущей ленты
    // начать двигать ленту с интервалом ... сек
    var timerId =
    setInterval(function() {
        moveRibbon('next');
    }, 3000);
})(jQuery);