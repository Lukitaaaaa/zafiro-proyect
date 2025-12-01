const ICONS = {
  home:   { off:'bi bi-house-door',  on:'bi bi-house-door-fill' },
  search: { off:'bi bi-search',      on:'bi bi-search' },
  heart:  { off:'bi bi-heart',       on:'bi bi-heart-fill' },
  plus:   { off:'bi bi-plus-lg',     on:'bi bi-plus-lg' },
  bell:   { off:'bi bi-bell',        on:'bi bi-bell-fill' },
  gear:   { off:'bi bi-gear',        on:'bi bi-gear-fill' },
};

function ensureProgressBar(){
  let bar = document.querySelector('.nav-progress-bar');
  if(!bar){
    bar = document.createElement('div');
    bar.className='nav-progress-bar';
    document.body.prepend(bar);
  }
  return bar;
}

function setActiveNav(route){
  document.querySelectorAll('.nav-link').forEach(a=>{
    const iconKey = a.dataset.icon;
    const i = a.querySelector('i');
    const isActive = a.dataset.route === route;
    a.classList.toggle('active', isActive);
    if (iconKey && i) i.className = isActive ? ICONS[iconKey].on : ICONS[iconKey].off;
  });
}

function showProgress(){
  const bar = ensureProgressBar();
  bar.classList.add('active'); bar.style.width='0%';
  let pct=0; clearInterval(bar._timer);
  bar._timer=setInterval(()=>{ pct+=Math.random()*15; if(pct>85)pct=85; bar.style.width=pct+'%'; },150);
}

function hideProgress(){
  const bar = document.querySelector('.nav-progress-bar');
  if(!bar) return; clearInterval(bar._timer); bar.style.width='100%';
  setTimeout(()=>{ bar.classList.remove('active'); bar.style.width='0%'; },400);
}

export function routeTo(event, route){
  console.log('Routing to:', route);
  event && event.preventDefault();
  showProgress();
  if (typeof $ === 'undefined') {
    // Fallback to fetch when jQuery is unavailable
    fetch(route, { headers: { 'X-Requested-With':'XMLHttpRequest' }})
      .then(resp=>resp.text())
      .then(html=>{
        const temp = document.createElement('div'); temp.innerHTML = html;
        const newMain = temp.querySelector('main');
        if(newMain){ document.querySelector('main').replaceWith(newMain); }
        history.pushState({}, '', route);
        setActiveNav(route);
      })
      .catch(()=>{ window.location.href = route; })
      .finally(hideProgress);
    return;
  }
  $.ajax({
    url: route,
    type: 'GET',
    headers: { 'X-Requested-With':'XMLHttpRequest' },
    success: function(response) {
      const $resp = $(response);
      $('main').replaceWith($resp.find('main'));
      history.pushState({}, '', route);
      setActiveNav(route);
    },
    error: function(){ window.location.href = route; },
    complete: hideProgress
  });
}

function bindBannerLinks(){
  document.querySelectorAll('.nav-link[data-route]').forEach(a=>{
    a.addEventListener('click', (e)=> routeTo(e, a.dataset.route));
  });
  const profileLink = document.querySelector('.dropdown-item[href*="dashboard.profile"]');
  if(profileLink){ profileLink.addEventListener('click', (e)=> routeTo(e, profileLink.getAttribute('href'))); }
}

function initNav(){
  ensureProgressBar();
  bindBannerLinks();
  setActiveNav(location.href);
  window.addEventListener('popstate', ()=> routeTo(null, location.href));
}

document.addEventListener('DOMContentLoaded', initNav);
