$('.btn-like').on('click',function() {
  $(this).removeClass('show')
  $('.btn-dislike').addClass('show')
  $idisLiked = $('.btn-like').data("like")
  $.get("http://127.0.0.1:8000/api/isLiked", function(data) {
console.log(data)  
  });

})

$('.btn-dislike').on('click',function() {
    $(this).removeClass('show')
    $('.btn-like').addClass('show')
})

console.log($('.btn-like').data("like"))