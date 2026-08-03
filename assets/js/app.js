/**
 * Shortcuts
 */

const $ = window.jQuery;
window.$ = $;
window.jQuery = $;

// Back to Top
(function () {
  var btn = document.getElementById('back-to-top');
  if (!btn) return;

  var onScroll = function () {
    if (window.scrollY > 400) {
      btn.classList.add('visible');
    } else {
      btn.classList.remove('visible');
    }
  };

  window.addEventListener('scroll', onScroll, { passive: true });

  btn.addEventListener('click', function () {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });
})();
// Search Overlay
(function () {
  var overlay = document.getElementById('searchOverlay');
  var toggle = document.querySelector('.search-toggle');
  if (!overlay || !toggle) return;

  var close = overlay.querySelector('.search-overlay-close');
  var input = overlay.querySelector('input[type="search"]');

  function show() {
    overlay.classList.add('active');
    document.body.style.overflow = 'hidden';
    setTimeout(function () { input.focus(); }, 120);
  }

  function hide() {
    overlay.classList.remove('active');
    document.body.style.overflow = '';
    if (input === document.activeElement) input.blur();
  }

  toggle.addEventListener('click', show);
  close.addEventListener('click', hide);

  overlay.addEventListener('click', function (e) {
    if (e.target === overlay) hide();
  });

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && overlay.classList.contains('active')) hide();
  });
})();

