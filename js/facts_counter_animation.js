


$(window).scroll(testScroll);
var viewed = false;

function isScrolledIntoView(elem) {
    var docViewTop = $(window).scrollTop();
    var docViewBottom = docViewTop + $(window).height();

    var elemTop = $(elem).offset().top;
    var elemBottom = elemTop + $(elem).height();

    return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
}

function testScroll() {
    
  if (isScrolledIntoView($(".facts")) && !viewed) {
      viewed = true;
      $('.number').each(function () {
      $(this).prop('Counter',0).animate({
          Counter: $(this).text()
      }, {
          duration: 1600,
          easing: 'swing',
          step: function (now) {
              $(this).text(Math.ceil(now));
          }
      });
    });
  }
}
/*

$(document).ready(function () {

  
    $(".number").each(function () {
        $(this).data('count', parseInt($(this).html(), 10));
        $(this).html('0');
        $(this).data("isCounting", false);
     });

   

    $(window).scroll(function () {
        startCount();
    });

    startCount();
});

function isScrolledIntoView($elem) {

    var docViewTop = $(window).scrollTop();
    var docViewBottom = docViewTop + $(window).height();
    var elemTop = $elem.offset().top;
    var elemBottom = elemTop + $elem.height();

    return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));

}

function count($this) {
   
    var current = parseInt($this.html(), 10);
    if (isScrolledIntoView($this) && !$this.data("isCounting") && current < $this.data('count')) {
        $this.html(++current);
        $this.data("isCounting", true);
        setTimeout(function () {
            $this.data("isCounting", false);
            count($this);
        }, 50);
    }
 }
 function startCount() {
    $(".number").each(function () {
        count($(this));
    });
};
*/