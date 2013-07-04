// VARS
var urlShort = "http://goo.gl/8Lxp8";
var urlFbShare = "https://www.facebook.com/sharer/sharer.php";
var urlTwShare = "https://twitter.com/share";
var urlSeoCandyShare = "http://api.seocandy.co.uk/socialsignal/";

var popupFb = {};
var popupTw = {};

var pollTimerFb = {};
var pollTimerTw = {};

var ajaxShare = {};
var aborted = false;

// FUNCTIONS
(function($){
  $(window).load(function(){
    // Flex Slider code
    $(".flexslider").flexslider({
      animation: "fade", // "fade" or "slide"
      slideDirection: "horizontal",
      slideshow: true,
      slideshowSpeed: 3000,  
      animationDuration: 600,
      directionNav: true, //previous/next navigation
      controlNav: true,   // paging control of each slide
      keyboardNav: true,
      mousewheel: false,  // Requires jquery.mousewheel.js
      smoothHeight: true,
      randomize: false,       
      slideToStart: 0,
      animationLoop: true, 
      pauseOnAction: true,
      pauseOnHover: false,
      start: slideComplete,
      after: slideComplete
    });
    function slideComplete(args) {
      var caption = $(args.container).find('.flex-caption').attr('style', ''),
        thisCaption = $('.flexslider .slides > li.flex-active-slide').find('.flex-caption');
        thisCaption.animate({left:0, bottom:0, opacity:0.9}, 500);
    } 
    // Eof Flex Slider code      
  });
})(jQuery);

jQuery.sharedCount = function(url, fn) {
    url = encodeURIComponent(url || location.href);
    var arg = {
        url: "//" + (location.protocol == "https:" ? "sharedcount.appspot" : "api.sharedcount") + ".com/?url=" + url,
        cache: true,
        dataType: "json"
    };
    if ('withCredentials' in new XMLHttpRequest) {
        arg.success = fn;
    }
    else {
        var cb = "sc_" + url.replace(/\W/g, '');
        window[cb] = fn;
        arg.jsonpCallback = cb;
        arg.dataType += "p";
    }
    return jQuery.ajax(arg);
};

function countShares(){
  aborted = false;
  
  if (!$.isEmptyObject(ajaxShare)) {
    aborted = true;
    ajaxShare.abort();
  }
  if ( (urlAjax.indexOf("//") === -1) && (urlAjax.indexOf("http") === -1) && (urlAjax.indexOf("https") === -1) ) {
    ajaxShare = $.ajax({
      url: urlAjax+"share.php",
      type: 'GET',
      success: function (data) {
        var json = $.parseJSON(data);
        $("#nbFbShare").html(json.facebook);
        $("#nbTwShare").html(json.twitter);
      },
      error: function(e) {
        if (!aborted) {
          $("#nbFbShare").html(0);
          $("#nbTwShare").html(0);
        }
      }
    })
  }
}

jQuery(document).ready(function($){
  countShares();

  $("#nbFbShare").click(function() {
    var fbParams = "?u="+urlLong;
    popupFb = window.open(urlFbShare + fbParams, 'sharerFB', 'width=626,height=436');

    // Detect popup closed
    pollTimerFb = setInterval(function() {
      if (popupFb.closed !== false) { // !== is required for compatibility with Opera
          window.clearInterval(pollTimerFb);
          countShares();
      }
    }, 200);
  });
  $("#nbTwShare").click(function() {
    var twParams = "?url="+urlLong;
    twParams += "&via=SPAGENEVE";
    twParams += "&hashtags=rencontreunebete";
    twParams += "&lang=fr";
    popupTw = window.open(urlTwShare + twParams, 'sharerTW', 'width=626,height=436');

    // Detect popup closed
    pollTimerTw = window.setInterval(function() {
      if (popupTw.closed !== false) { // !== is required for compatibility with Opera
          window.clearInterval(pollTimerTw);
          countShares();
      }
    }, 200);
  });
});