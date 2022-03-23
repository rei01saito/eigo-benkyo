window.onload = onClick;

function onClick() {
  const button = document.querySelector('button');
  
  button.addEventListener('click', function() {
      const spin = document.querySelector('#spin');
      console.log(spin);
      spin.classList.toggle('animate-spin');
  }, false);
}