export function DeleteConfirmEvent() {
  $('#delete-account').on('click', function(e) {
    e.preventDefault();
    if (confirm('アカウントを削除しますが、本当によろしいですか？\n削除したアカウントは復元できません。')) {
      location.href = "/mypage/destroy";
    }
  })
}