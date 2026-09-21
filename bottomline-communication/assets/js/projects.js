(() => {
'use strict';
  // Filter
  const filterBtns = document.querySelectorAll('.filter-btn');
  filterBtns.forEach(b => b.addEventListener('click', () => {
    filterBtns.forEach(x => x.classList.remove('active'));
    b.classList.add('active');
    const f = b.dataset.filter;
    document.querySelectorAll('.pl-col').forEach(c => {
      const filters = c.dataset.filters.split(' ');
      c.classList.toggle('hide', f !== 'all' && !filters.includes(f));
    });
  }));

  // Sticky filter bar shadow
  const fb = document.getElementById('filterBar');
  const fbTop = fb.offsetTop;
  window.addEventListener('scroll', () => {
    fb.classList.toggle('stuck', window.scrollY > fbTop - 2);
    document.getElementById('nav').classList.toggle('scrolled', window.scrollY > 30);
  });


})();
