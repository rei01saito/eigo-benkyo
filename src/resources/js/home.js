window.onload = onClick;

function onClick() {
  const button = document.querySelector('#time-button');
  if (button === null) {
    return false;
  }
  button.addEventListener('click', function() {
      const spin = document.querySelector('#spin');
      spin.classList.toggle('animate-spin');
  }, false);
}