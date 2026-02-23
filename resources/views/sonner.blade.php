<div id="sonner-toaster" data-position="{{ $position }}" data-theme="{{ $theme }}" data-duration="{{ $duration }}" data-dismissible="{{ $dismissible ? '1' : '0' }}"></div>
@php($__sonnerQueue = session('sonner.toasts', []))
@php(session()->forget('sonner.toasts'))
<script>
(function(){
  const d = document;
  const container = d.getElementById('sonner-toaster');
  if(!container) return;
  const queue = {!! json_encode($__sonnerQueue) !!};
  const pos = container.dataset.position || 'bottom-right';
  const duration = parseInt(container.dataset.duration || '4000', 10);
  const theme = container.dataset.theme || 'system';
  const dismissible = container.dataset.dismissible === '1';
  const root = (function(container, pos, theme){ const div = d.createElement('div'); div.className = 'ai-sonner-root ' + pos + ' ' + theme; container.appendChild(div); return div; })(container, pos, theme);
  function renderToast(root, t) { const el = d.createElement('div'); el.className = 'ai-sonner-toast ' + (t.type || 'info'); const title = d.createElement('div'); title.className = 'ai-sonner-title'; title.textContent = t.title || ''; el.appendChild(title); if (t.description) { const desc = d.createElement('div'); desc.className = 'ai-sonner-desc'; desc.textContent = t.description; el.appendChild(desc); } if (dismissible) { const btn = d.createElement('button'); btn.className = 'ai-sonner-close'; btn.textContent = '×'; btn.addEventListener('click', function(){ el.remove(); }); el.appendChild(btn); } root.appendChild(el); setTimeout(function(){ el.remove(); }, t.duration || duration); }
  queue.forEach(function(t){ renderToast(root, t); });
  window.Sonner = {
    toast: function(message, options){ renderToast(root, { type: 'info', title: message, description: options && options.description, duration: options && options.duration ? options.duration : duration }); },
    success: function(message, options){ renderToast(root, { type: 'success', title: message, description: options && options.description, duration: options && options.duration ? options.duration : duration }); },
    error: function(message, options){ renderToast(root, { type: 'error', title: message, description: options && options.description, duration: options && options.duration ? options.duration : duration }); },
    warning: function(message, options){ renderToast(root, { type: 'warning', title: message, description: options && options.description, duration: options && options.duration ? options.duration : duration }); },
    info: function(message, options){ renderToast(root, { type: 'info', title: message, description: options && options.description, duration: options && options.duration ? options.duration : duration }); },
    promise: function(p, messages){ const loadingEl = d.createElement('div'); loadingEl.className = 'ai-sonner-toast loading'; loadingEl.textContent = (messages && messages.loading) ? messages.loading : 'Loading...'; root.appendChild(loadingEl); p.then(function(){ loadingEl.remove(); renderToast(root, { type: 'success', title: (messages && messages.success) ? messages.success : 'Done', duration: duration }); }).catch(function(){ loadingEl.remove(); renderToast(root, { type: 'error', title: (messages && messages.error) ? messages.error : 'Failed', duration: duration }); }); }
  };
})();
</script>
<style>
.ai-sonner-root { position: fixed; inset: 0; pointer-events: none }
.ai-sonner-root.bottom-right { display: flex; align-items: flex-end; justify-content: flex-end; padding: 16px }
.ai-sonner-root.bottom-left { display: flex; align-items: flex-end; justify-content: flex-start; padding: 16px }
.ai-sonner-root.bottom-center { display: flex; align-items: flex-end; justify-content: center; padding: 16px }
.ai-sonner-root.top-right { display: flex; align-items: flex-start; justify-content: flex-end; padding: 16px }
.ai-sonner-root.top-left { display: flex; align-items: flex-start; justify-content: flex-start; padding: 16px }
.ai-sonner-root.top-center { display: flex; align-items: flex-start; justify-content: center; padding: 16px }
.ai-sonner-toast { pointer-events: auto; background: #111; color: #fff; border-radius: 10px; padding: 12px 14px; margin: 8px; box-shadow: 0 10px 20px rgba(0,0,0,.25); transform: translateY(0); transition: transform .4s ease, opacity .4s ease; display: inline-flex; flex-direction: column; position: relative; min-width: 240px }
.ai-sonner-toast.success { background: #0c3 }
.ai-sonner-toast.error { background: #d33 }
.ai-sonner-toast.warning { background: #d9822b }
.ai-sonner-toast.info { background: #2b6cb0 }
.ai-sonner-toast.loading { background: #333 }
.ai-sonner-title { font-weight: 600; margin-bottom: 4px }
.ai-sonner-desc { opacity: .9 }
.ai-sonner-close { position: absolute; right: 8px; top: 6px; border: 0; background: transparent; color: inherit; font-size: 20px; line-height: 1; cursor: pointer }
@media (prefers-color-scheme: light) {
  .ai-sonner-root.system .ai-sonner-toast { background: #fff; color: #111; box-shadow: 0 10px 20px rgba(0,0,0,.12) }
  .ai-sonner-root.system .ai-sonner-toast.success { background: #dcfce7 }
  .ai-sonner-root.system .ai-sonner-toast.error { background: #fee2e2 }
  .ai-sonner-root.system .ai-sonner-toast.warning { background: #fef3c7 }
  .ai-sonner-root.system .ai-sonner-toast.info { background: #eff6ff }
}
.ai-sonner-root.dark .ai-sonner-toast { background: #1f2937; color: #fff }
.ai-sonner-root.light .ai-sonner-toast { background: #fff; color: #111 }
</style>
