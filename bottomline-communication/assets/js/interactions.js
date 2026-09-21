/* Enhancements only: all page copy, cards and project details are rendered in PHP. */
(() => {
  'use strict';
  const nav = document.getElementById('nav');
  const menu = document.querySelector('.menu-btn');
  if (nav && menu) {
    menu.setAttribute('aria-expanded', 'false');
    menu.addEventListener('click', () => menu.setAttribute('aria-expanded', String(nav.classList.toggle('mobile-open'))));
    nav.querySelectorAll('a').forEach(link => link.addEventListener('click', () => { nav.classList.remove('mobile-open'); menu.setAttribute('aria-expanded', 'false'); }));
  }
  let panel = null;
  let trigger = null;
  const backdrop = document.getElementById('panelBackdrop');
  function close() {
    if (!panel) return;
    panel.classList.remove('open');
    panel.setAttribute('aria-hidden', 'true');
    panel = null;
    backdrop?.classList.remove('open');
    document.body.classList.remove('panel-open');
    trigger?.focus();
  }
  document.querySelectorAll('[data-project]').forEach(card => {
    const button = card.querySelector('[role="button"]') || card;
    button.setAttribute('tabindex', '0');
    button.setAttribute('role', 'button');
    button.setAttribute('aria-controls', 'project-' + card.dataset.project);
    function open(event) {
      if (event.type === 'keydown' && !['Enter', ' '].includes(event.key)) return;
      const target = document.getElementById('project-' + card.dataset.project);
      if (!target) return;
      event.preventDefault();
      close();
      trigger = button;
      panel = target;
      panel.scrollTop = 0;
      panel.classList.add('open');
      panel.setAttribute('aria-hidden', 'false');
      backdrop?.classList.add('open');
      document.body.classList.add('panel-open');
      panel.querySelector('.panel-close')?.focus();
    }
    card.addEventListener('click', open);
    button.addEventListener('keydown', open);
  });
  document.querySelectorAll('.panel-close, .panel-footer a').forEach(el => el.addEventListener('click', close));
  backdrop?.addEventListener('click', close);
  document.addEventListener('keydown', event => {
    if (!panel) return;
    if (event.key === 'Escape') close();
    if (event.key !== 'Tab' || !panel) return;
    const items = panel.querySelectorAll('button, a[href], input, select, textarea, [tabindex="0"]');
    const first = items[0], last = items[items.length - 1];
    if (event.shiftKey && document.activeElement === first) { event.preventDefault(); last.focus(); }
    else if (!event.shiftKey && document.activeElement === last) { event.preventDefault(); first.focus(); }
  });
})();
