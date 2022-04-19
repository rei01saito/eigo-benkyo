export function TagEvent() {
  $('.tag-plus').each(function(index, element) {
    $(element).on('click', function() {
      if ($('.tag-plus').length > 10) {
        if ($('#tag-msg')) {
          $('#tag-msg').remove();
        }
        $('.tag').before('<p class="text-red-500" id="tag-msg">タグは最大10個までです。<p>');
        return false;
      }
      let hiddenTag = $('.hidden-tag').clone(true);
      $('.tag').append(hiddenTag);
      hiddenTag.removeClass('hidden hidden-tag');
    })
  })
  $('.tag-minus').each(function(index, element) {
    $(element).on('click', function() {
      if ($('.tag-minus').length === 2) {
        return false;
      }
      $(this).parent().parent().remove();
    })
  })
}