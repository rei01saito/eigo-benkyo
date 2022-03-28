window.onload = onClick;

function onClick() {

  const button = document.querySelector('#time-button');
  const timer = document.querySelector('#setTimer');
  console.log('gda')

  if (button === null) {
    return false;
  }
  button.addEventListener('click', function() {
      const spin = document.querySelector('#spin');
      spin.classList.toggle('animate-spin');
  }, false);

  timer.addEventListener('click', event => {
      let task_id = event.currentTarget.getAttribute('data-task-id');
      let url = "/home/" + task_id;
      let timer = document.querySelector('.timer');
      
      fetch(url, {
        
      })
      .then(response => response.json())
      .then(data => {
          timer.textContent = data["timer"];
      })
      .catch(err => {
          alert('通信に失敗しました。')
      })
  });
}