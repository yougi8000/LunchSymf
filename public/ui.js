$('.btn-like').on('click',function() {
  $(this).removeClass('show')
  $('.btn-dislike').addClass('show')
})

$('.btn-dislike').on('click',function() {
    $(this).removeClass('show')
    $('.btn-like').addClass('show')
})
