document.addEventListener('DOMContentLoaded', function () {
  if (window.AOS) {
    AOS.init({ duration: 700, once: true, easing: 'ease-out-cubic' });
  }

  document.querySelectorAll('[data-bs-toggle="collapse"]').forEach(function (button) {
    button.addEventListener('click', function () {
      const target = document.querySelector(button.getAttribute('data-bs-target'));
      if (target) {
        target.classList.toggle('show');
      }
    });
  });
});
