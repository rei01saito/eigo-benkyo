export function TagEvent() {
  $('.tag-plus').each(function(index, element) {
    $(element).on('click', function() {
      if ($('.tag-plus').length > 10) {
        if ($('.tag-msg')) {
          $('.tag-msg').remove();
        }
        $('.tag').before('<p class="text-sm text-red-500 tag-msg">タグは最大10個までです。</p>');
        return false;
      }
      let hiddenTag = $('.hidden-tag').clone(true);
      $('.tag').append(hiddenTag);
      hiddenTag.removeClass('hidden hidden-tag');
      hiddenTag.find('input[name="tag[]"]').addClass('tag-items');
    })
  })

  $('.tag-minus').each(function(index, element) {
    $(element).on('click', function() {
      if ($('.tag-minus').length === 2) {
        if (confirm('削除してもよろしいですか？')) {
          location.href="/mypage/tag/delete";
        }
        return false;
      }
      $(this).parent().parent().remove();
    })
  })

  $('#tag-submit').on('click', function(e) {
    e.preventDefault();
    let flag = true;
    $('.tag-items').each(function(index, element) {
      if (!$(element).val()) {
        if ($('.tag-msg')) {
          $('.tag-msg').remove();
          $('.tag').before('<p class="text-sm text-red-500 tag-msg">タグを入力して下さい。</p>');
        } else {
          $('.tag').before('<p class="text-sm text-red-500 tag-msg">タグを入力して下さい。</p>');
        }
        flag = false;
      }
    })
    if (flag) {
      $('#tag-form').submit();
    }
    return false;
  })
}