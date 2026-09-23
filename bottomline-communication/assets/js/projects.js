(() => {
'use strict';
  const nav = document.getElementById('nav');
  if (!nav) return;
  const updateNav = () => nav.classList.toggle('scrolled', window.scrollY > 30);
  window.addEventListener('scroll', updateNav, {passive: true});
  updateNav();
})();
