export function TaskFormValidate(element) {
  
  element.on('submit', (e) => {

    if ($('.err-msg')) {
      $('.err-msg').remove();
    }
    let form = $($(e.currentTarget)[0]);
    let flag = true;

    // バリデーション
    // タイトル
    if (!form.find('input[name="title"]').val()) {
      form.find('input[name="title"]').after('<p class="err-msg text-sm text-red-600">タイトルを入力して下さい</p>');
      flag = false;
    } else if (form.find('input[name="title"]').val().length > 30) {
      form.find('input[name="title"]').after('<p class="err-msg text-sm text-red-600">タイトルは30文字以内で入力して下さい</p>');
      flag = false;
    }

    // 内容
    if (form.find('textarea[name="contents"]').val().length > 2000) {
      form.find('textarea[name="contents"]').after('<p class="err-msg text-sm text-red-600">内容は2000文字以内で入力して下さい</p>');
      flag = false;
    }

    // タイマー
    const pattern = /^([1-9]\d*|0)$/;
    if (!form.find('input[name="timer"]').val()) {
      form.find('input[name="timer"]').after('<p class="err-msg text-sm text-red-600">タイマー時間を入力して下さい</p>');
      flag = false;
    } else if (!pattern.test(form.find('input[name="timer"]').val()) || form.find('input[name="timer"]').val() < 1) {
      form.find('input[name="timer"]').after('<p class="err-msg text-sm text-red-600">タイマー時間には1以上の数字を入力して下さい</p>');
      flag = false;
    }

    if (flag) {
      form.submit();
    }

    return false;
  })

}