(() => {
'use strict';

  // ============ PRELOADER ============
  const preloader = document.getElementById('preloader');
  const PRELOAD_MS = 2700;
  function finishPreload(){
    preloader.classList.add('done');
    document.body.classList.remove('locked');
    document.body.classList.add('loaded');
    setTimeout(() => preloader.style.display = 'none', 900);
  }
  // Skip the intro on deep-links (e.g. #services) and on repeat visits this session
  if (window.location.hash || sessionStorage.getItem('bl_intro_seen')) {
    preloader.classList.add('done');
    document.body.classList.remove('locked');
    document.body.classList.add('loaded');
    preloader.style.display = 'none';
    if (window.location.hash) {
      requestAnimationFrame(() => {
        try { const t = document.querySelector(window.location.hash); if (t) t.scrollIntoView(); } catch (e) {}
      });
    }
  } else {
    sessionStorage.setItem('bl_intro_seen', '1');
    if (document.readyState === 'complete') {
      setTimeout(finishPreload, PRELOAD_MS);
    } else {
      window.addEventListener('load', () => setTimeout(finishPreload, PRELOAD_MS));
    }
  }

  // ============ NAV + SCROLL PROGRESS ============
  const nav = document.getElementById('nav');
  const scrollProg = document.getElementById('scrollProgress');
  function onScroll(){
    const y = window.scrollY;
    nav.classList.toggle('scrolled', y > 40);
    const total = document.documentElement.scrollHeight - window.innerHeight;
    scrollProg.style.width = (y / total * 100) + '%';
  }
  window.addEventListener('scroll', onScroll, {passive:true});

  // ============ SCROLL REVEAL ============
  const io = new IntersectionObserver((entries) => {
    entries.forEach(e => {
      if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); }
    });
  }, { threshold: 0.12 });
  document.querySelectorAll('.reveal, .reveal-stagger').forEach(el => io.observe(el));

  // ============ COUNTERS ============
  function runCounter(el){
    const target = +el.dataset.count;
    const duration = 1800;
    const start = performance.now();
    const suffix = (el.dataset.suffix != null) ? el.dataset.suffix : (target >= 6 ? '+' : '');
    const tick = (t) => {
      const p = Math.min((t - start) / duration, 1);
      const eased = 1 - Math.pow(1 - p, 3);
      el.textContent = Math.floor(eased * target) + suffix;
      if (p < 1) requestAnimationFrame(tick);
      else el.textContent = target + suffix;
    };
    requestAnimationFrame(tick);
  }
  // Stat counters below the hero: count up when in view — but only START watching
  // AFTER the intro reveals the page, so the count-up animates where the user can
  // see it (otherwise it runs hidden behind the preloader and finishes unseen).
  const countIO = new IntersectionObserver((entries) => {
    entries.forEach(e => {
      if (!e.isIntersecting) return;
      runCounter(e.target);
      countIO.unobserve(e.target);
    });
  }, { threshold: 0.5 });
  function startCounters(){
    document.querySelectorAll('[data-count]').forEach(c => countIO.observe(c));
  }
  if (document.body.classList.contains('loaded')) {
    requestAnimationFrame(startCounters);             // intro already skipped this load
  } else {
    const loadObs = new MutationObserver(() => {
      if (document.body.classList.contains('loaded')) {
        loadObs.disconnect();
        setTimeout(startCounters, 700);               // let the intro finish clearing
      }
    });
    loadObs.observe(document.body, { attributes:true, attributeFilter:['class'] });
  }

  // ============ MAGNETIC BUTTONS ============
  document.querySelectorAll('.magnetic').forEach(btn => {
    btn.addEventListener('mousemove', (e) => {
      const r = btn.getBoundingClientRect();
      const x = e.clientX - r.left - r.width/2;
      const y = e.clientY - r.top - r.height/2;
      btn.style.transform = `translate(${x * 0.25}px, ${y * 0.35}px)`;
    });
    btn.addEventListener('mouseleave', () => { btn.style.transform = ''; });
  });

  // ============ 3D CARD TILT ============
  document.querySelectorAll('.tilt').forEach(card => {
    card.addEventListener('mousemove', (e) => {
      const r = card.getBoundingClientRect();
      const x = (e.clientX - r.left) / r.width - 0.5;
      const y = (e.clientY - r.top) / r.height - 0.5;
      card.style.transform = `perspective(900px) rotateX(${y * -5}deg) rotateY(${x * 5}deg) translateY(-6px)`;
    });
    card.addEventListener('mouseleave', () => { card.style.transform = ''; });
  });

  // ============ PROCESS SCROLL HIGHLIGHT ============
  const steps = document.querySelectorAll('.step');
  const procFill = document.getElementById('procFill');
  function updateProcess(){
    const vh = window.innerHeight;
    let lastActive = -1;
    steps.forEach((s, i) => {
      const r = s.getBoundingClientRect();
      const center = r.top + r.height / 2;
      if (center < vh * 0.65) lastActive = i;
    });
    steps.forEach((s, i) => s.classList.toggle('active', i <= lastActive));
    if (procFill && steps.length) {
      const pct = lastActive < 0 ? 0 : ((lastActive + 1) / steps.length) * 100;
      procFill.style.height = pct + '%';
    }
  }
  window.addEventListener('scroll', updateProcess, {passive:true});
  updateProcess();


})();
