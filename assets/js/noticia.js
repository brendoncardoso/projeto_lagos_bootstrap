(function() {

    'use strict';
  
    // define variables
    var items = document.querySelectorAll(".noticia");
  
    // check if an element is in viewport
    // http://stackoverflow.com/questions/123999/how-to-tell-if-a-dom-element-is-visible-in-the-current-viewport
    function isElementInViewport(el) {
      var rect = el.getBoundingClientRect();
      return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
      );
    }
  
    function callbackFunc() {
      var timeout = 10;
      for (var i = 0; i < items.length; i++) {
        if (isElementInViewport(items[i])) {
          setTimeout(addClass.bind(null, items[i]), ( timeout + i * 100 ) );
        }
      }
    }

    function addClass( element ){
        element.classList.remove("hide-o");
        element.classList.add("flipInX");
    }
  
    // listen for events
    window.addEventListener("load", callbackFunc);
    window.addEventListener("resize", callbackFunc);
    window.addEventListener("scroll", callbackFunc);
  
  })();