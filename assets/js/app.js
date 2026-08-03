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
