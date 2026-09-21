(() => {
'use strict';

  // Nav scroll
  window.addEventListener('scroll', () => {
    document.getElementById('nav').classList.toggle('scrolled', window.scrollY > 30);
  });

  // Budget pill toggle
  const budgetPills = document.querySelectorAll('.budget-pill');
  budgetPills.forEach(p => p.addEventListener('click', () => {
    budgetPills.forEach(x => x.classList.remove('active'));
    p.classList.add('active');
    document.getElementById('budgetField').value = p.dataset.budget;
  }));

  // Smooth anchor scroll
  document.querySelectorAll('a[href^="#"]').forEach(a => {
    a.addEventListener('click', (e) => {
      const id = a.getAttribute('href');
      if (id.length > 1) {
        e.preventDefault();
        document.querySelector(id)?.scrollIntoView({ behavior: 'smooth' });
      }
    });
  });

})();
