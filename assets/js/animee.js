// anime({
//   targets: '.test',
//   translateX: 250,
//   direction: 'alternate',
//   loop: true,
//   easing: 'easeInCirc'
// });

// Wrap every letter in a span
$('.ml3').each(function(){
  $(this).html($(this).text().replace(/([^\x00-\x80]|\w)/g, "<span class='letter'>$&</span>"));
});

anime.timeline({loop: false})
  .add({
    targets: '.ml3 .letter',
    opacity: [0,1],
    easing: "easeInOutQuad",
    duration: 300,
    delay: function(el, i) {
      return 150 * (i+1)
    }
  }).add({
    targets: '.ml3',
    opacity: 100,
    duration: 1000,
    easing: "easeOutExpo",
    delay: 1000,
  });
