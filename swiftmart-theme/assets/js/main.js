// SwiftMart theme JS
(function(){
  const toggle = document.querySelector('.menu-toggle');
  const nav    = document.getElementById('primary-nav');
  if(toggle && nav){
    toggle.addEventListener('click', function(){
      const open = nav.classList.toggle('open');
      toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    });
  }
})();
