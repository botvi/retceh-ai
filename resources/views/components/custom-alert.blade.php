{{-- Standalone Custom Toast & Modal Component (Works on both Tailwind & Non-Tailwind pages) --}}
<style id="custom-alert-styles">
    /* Toast Container */
    #custom-toast-container {
        position: fixed !important;
        top: 85px !important;
        right: 24px !important;
        z-index: 2147483647 !important;
        display: flex !important;
        flex-direction: column !important;
        gap: 12px !important;
        max-width: 360px !important;
        width: calc(100% - 48px) !important;
        pointer-events: none !important;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif !important;
    }

    /* Individual Toast Card */
    .custom-toast-card {
        pointer-events: auto !important;
        background: rgba(255, 255, 255, 0.95) !important;
        backdrop-filter: blur(12px) !important;
        -webkit-backdrop-filter: blur(12px) !important;
        border: 1px solid #e4e4e7 !important;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1) !important;
        border-radius: 16px !important;
        padding: 14px 16px !important;
        display: flex !important;
        align-items: flex-start !important;
        gap: 12px !important;
        position: relative !important;
        overflow: hidden !important;
        animation: customToastSlideIn 0.35s cubic-bezier(0.16, 1, 0.3, 1) forwards !important;
        box-sizing: border-box !important;
    }

    .custom-toast-card.slide-out {
        animation: customToastSlideOut 0.25s cubic-bezier(0.16, 1, 0.3, 1) forwards !important;
    }

    /* Icon Container */
    .custom-toast-icon-box {
        width: 34px !important;
        height: 34px !important;
        border-radius: 50% !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        flex-shrink: 0 !important;
        font-size: 16px !important;
    }

    /* Toast Types */
    .custom-toast-success .custom-toast-icon-box {
        background: #ecfdf5 !important;
        border: 1px solid #a7f3d0 !important;
        color: #059669 !important;
    }

    .custom-toast-error .custom-toast-icon-box,
    .custom-toast-danger .custom-toast-icon-box {
        background: #fff1f2 !important;
        border: 1px solid #fecdd3 !important;
        color: #e11d48 !important;
    }

    .custom-toast-warning .custom-toast-icon-box {
        background: #fffbeb !important;
        border: 1px solid #fde68a !important;
        color: #d97706 !important;
    }

    .custom-toast-info .custom-toast-icon-box {
        background: #eff6ff !important;
        border: 1px solid #bfdbfe !important;
        color: #2563eb !important;
    }

    /* Text */
    .custom-toast-content {
        flex-grow: 1 !important;
        text-align: left !important;
    }

    .custom-toast-title {
        font-size: 11px !important;
        font-weight: 800 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.05em !important;
        color: #163300 !important;
        margin: 0 0 2px 0 !important;
        line-height: 1.2 !important;
    }

    .custom-toast-message {
        font-size: 12px !important;
        font-weight: 500 !important;
        color: #454745 !important;
        margin: 0 !important;
        line-height: 1.4 !important;
    }

    /* Close Button */
    .custom-toast-close {
        background: transparent !important;
        border: none !important;
        color: #a1a1aa !important;
        cursor: pointer !important;
        padding: 2px !important;
        font-size: 14px !important;
        line-height: 1 !important;
        flex-shrink: 0 !important;
        transition: color 0.15s ease !important;
    }

    .custom-toast-close:hover {
        color: #27272a !important;
    }

    /* Custom Confirmation Modal Overlay */
    #custom-confirm-modal {
        position: fixed !important;
        inset: 0 !important;
        top: 0 !important;
        left: 0 !important;
        width: 100vw !important;
        height: 100vh !important;
        background: rgba(14, 15, 12, 0.6) !important;
        backdrop-filter: blur(8px) !important;
        -webkit-backdrop-filter: blur(8px) !important;
        z-index: 2147483647 !important;
        display: none;
        align-items: center !important;
        justify-content: center !important;
        padding: 16px !important;
        box-sizing: border-box !important;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif !important;
    }

    #custom-confirm-modal.active {
        display: flex !important;
    }

    .custom-modal-card {
        background: #ffffff !important;
        border: 1px solid #e4e4e7 !important;
        border-radius: 24px !important;
        padding: 24px !important;
        max-width: 380px !important;
        width: 100% !important;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25) !important;
        text-align: center !important;
        position: relative !important;
        overflow: hidden !important;
        animation: customModalScaleUp 0.3s cubic-bezier(0.16, 1, 0.3, 1) forwards !important;
        box-sizing: border-box !important;
    }

    .custom-modal-icon-circle {
        width: 60px !important;
        height: 60px !important;
        border-radius: 50% !important;
        margin: 0 auto 16px auto !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        font-size: 26px !important;
    }

    .custom-modal-warning .custom-modal-icon-circle {
        background: #fffbeb !important;
        border: 1px solid #fde68a !important;
        color: #d97706 !important;
    }

    .custom-modal-danger .custom-modal-icon-circle {
        background: #fff1f2 !important;
        border: 1px solid #fecdd3 !important;
        color: #e11d48 !important;
    }

    .custom-modal-info .custom-modal-icon-circle {
        background: #f4f6f2 !important;
        border: 1px solid #9fe870 !important;
        color: #163300 !important;
    }

    .custom-modal-title {
        font-size: 16px !important;
        font-weight: 800 !important;
        color: #163300 !important;
        text-transform: uppercase !important;
        letter-spacing: -0.01em !important;
        margin: 0 0 8px 0 !important;
    }

    .custom-modal-text {
        font-size: 13px !important;
        font-weight: 500 !important;
        color: #52525b !important;
        line-height: 1.5 !important;
        margin: 0 0 20px 0 !important;
    }

    .custom-modal-actions {
        display: flex !important;
        gap: 10px !important;
    }

    .custom-modal-btn {
        flex: 1 !important;
        padding: 10px 16px !important;
        border-radius: 9999px !important;
        font-size: 11px !important;
        font-weight: 800 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.05em !important;
        cursor: pointer !important;
        border: none !important;
        transition: all 0.2s ease !important;
    }

    .custom-modal-btn-cancel {
        background: #ffffff !important;
        border: 1px solid #e4e4e7 !important;
        color: #3f3f46 !important;
    }

    .custom-modal-btn-cancel:hover {
        background: #f4f4f5 !important;
    }

    .custom-modal-btn-confirm-danger {
        background: #e11d48 !important;
        color: #ffffff !important;
    }

    .custom-modal-btn-confirm-danger:hover {
        background: #be123c !important;
    }

    .custom-modal-btn-confirm-primary {
        background: #9fe870 !important;
        color: #163300 !important;
    }

    .custom-modal-btn-confirm-primary:hover {
        background: #8cd85d !important;
    }

    /* Animations */
    @keyframes customToastSlideIn {
        from {
            opacity: 0;
            transform: translateX(50px) scale(0.95);
        }

        to {
            opacity: 1;
            transform: translateX(0) scale(1);
        }
    }

    @keyframes customToastSlideOut {
        from {
            opacity: 1;
            transform: translateX(0) scale(1);
        }

        to {
            opacity: 0;
            transform: translateX(50px) scale(0.95);
        }
    }

    @keyframes customModalScaleUp {
        from {
            opacity: 0;
            transform: scale(0.9) translateY(12px);
        }

        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }
</style>

<!-- Global Toast Container -->
<div id="custom-toast-container"></div>

<!-- Global Custom Modal Confirmation Dialog -->
<div id="custom-confirm-modal">
    <div class="custom-modal-card custom-modal-info" id="custom-modal-card">
        <div class="custom-modal-icon-circle">
            <i id="custom-modal-icon" class="bi bi-info-circle-fill"></i>
        </div>
        <h3 id="custom-modal-title" class="custom-modal-title">Konfirmasi</h3>
        <p id="custom-modal-text" class="custom-modal-text">Apakah Anda yakin ingin melanjutkan tindakan ini?</p>
        <div class="custom-modal-actions">
            <button type="button" id="custom-modal-btn-cancel"
                class="custom-modal-btn custom-modal-btn-cancel">Batal</button>
            <button type="button" id="custom-modal-btn-confirm"
                class="custom-modal-btn custom-modal-btn-confirm-primary">Ya, Lanjutkan</button>
        </div>
    </div>
</div>

<script>
    (function() {
        // ----------------------------------------------------
        // Toast Dispatcher
        // ----------------------------------------------------
        window.showCustomToast = function(message, type = 'info', title = null) {
            if (!message) return;

            let container = document.getElementById('custom-toast-container');
            if (!container) {
                container = document.createElement('div');
                container.id = 'custom-toast-container';
                document.body.appendChild(container);
            }

            const toast = document.createElement('div');
            const toastType = (type || 'info').toLowerCase();
            toast.className = `custom-toast-card custom-toast-${toastType}`;

            let iconClass = 'bi-info-circle-fill';
            let defaultTitle = 'Informasi';

            if (toastType === 'success') {
                iconClass = 'bi-check-circle-fill';
                defaultTitle = 'Berhasil';
            } else if (toastType === 'error' || toastType === 'danger') {
                iconClass = 'bi-exclamation-triangle-fill';
                defaultTitle = 'Gagal';
            } else if (toastType === 'warning') {
                iconClass = 'bi-exclamation-diamond-fill';
                defaultTitle = 'Peringatan';
            }

            const finalTitle = title || defaultTitle;

            toast.innerHTML = `
            <div class="custom-toast-icon-box">
                <i class="bi ${iconClass}"></i>
            </div>
            <div class="custom-toast-content">
                <div class="custom-toast-title">${finalTitle}</div>
                <div class="custom-toast-message">${message}</div>
            </div>
            <button type="button" class="custom-toast-close" title="Tutup">&times;</button>
        `;

            const closeBtn = toast.querySelector('.custom-toast-close');
            closeBtn.onclick = function() {
                toast.classList.add('slide-out');
                setTimeout(() => toast.remove(), 250);
            };

            container.appendChild(toast);

            // Auto remove after 5s
            setTimeout(() => {
                if (toast.parentElement) {
                    toast.classList.add('slide-out');
                    setTimeout(() => toast.remove(), 250);
                }
            }, 5000);
        };

        // Global Alias
        window.showToast = window.showCustomToast;

        // ----------------------------------------------------
        // Modal Dispatcher
        // ----------------------------------------------------
        let activeConfirmCallback = null;

        window.showCustomConfirm = function(options) {
            const modal = document.getElementById('custom-confirm-modal');
            const card = document.getElementById('custom-modal-card');
            const iconEl = document.getElementById('custom-modal-icon');
            const titleEl = document.getElementById('custom-modal-title');
            const textEl = document.getElementById('custom-modal-text');
            const btnConfirm = document.getElementById('custom-modal-btn-confirm');
            const btnCancel = document.getElementById('custom-modal-btn-cancel');

            if (!modal) return;

            titleEl.textContent = options.title || 'Konfirmasi';
            textEl.textContent = options.text || 'Apakah Anda yakin ingin melanjutkan?';
            btnConfirm.textContent = options.confirmText || 'Ya, Lanjutkan';
            btnCancel.textContent = options.cancelText || 'Batal';

            const iconType = (options.icon || 'warning').toLowerCase();
            if (iconType === 'danger' || iconType === 'error') {
                card.className = 'custom-modal-card custom-modal-danger';
                iconEl.className = 'bi bi-trash3-fill';
                btnConfirm.className = 'custom-modal-btn custom-modal-btn-confirm-danger';
            } else if (iconType === 'warning') {
                card.className = 'custom-modal-card custom-modal-warning';
                iconEl.className = 'bi bi-exclamation-triangle-fill';
                btnConfirm.className = 'custom-modal-btn custom-modal-btn-confirm-primary';
            } else {
                card.className = 'custom-modal-card custom-modal-info';
                iconEl.className = 'bi bi-info-circle-fill';
                btnConfirm.className = 'custom-modal-btn custom-modal-btn-confirm-primary';
            }

            activeConfirmCallback = options.onConfirm || null;
            modal.classList.add('active');
        };

        window.closeCustomModal = function() {
            const modal = document.getElementById('custom-confirm-modal');
            if (modal) modal.classList.remove('active');
            activeConfirmCallback = null;
        };

        // Init function that runs regardless of DOM ready timing
        function initCustomAlerts() {
            const btnConfirm = document.getElementById('custom-modal-btn-confirm');
            const btnCancel = document.getElementById('custom-modal-btn-cancel');

            if (btnConfirm) {
                btnConfirm.onclick = function() {
                    if (typeof activeConfirmCallback === 'function') {
                        activeConfirmCallback();
                    }
                    window.closeCustomModal();
                };
            }

            if (btnCancel) {
                btnCancel.onclick = function() {
                    window.closeCustomModal();
                };
            }

            // Auto bind delete-form submit handlers
            document.querySelectorAll('form.delete-form, form[data-confirm]').forEach(form => {
                form.onsubmit = function(e) {
                    if (form.dataset.confirmed === 'true') return true;

                    e.preventDefault();
                    const confirmMsg = form.dataset.confirm || 'Tindakan ini tidak dapat dibatalkan!';
                    const confirmTitle = form.dataset.title || 'Apakah Anda Yakin?';

                    window.showCustomConfirm({
                        title: confirmTitle,
                        text: confirmMsg,
                        icon: 'danger',
                        confirmText: 'Ya, Hapus!',
                        cancelText: 'Batal',
                        onConfirm: () => {
                            form.dataset.confirmed = 'true';
                            form.submit();
                        }
                    });
                    return false;
                };
            });

            // ----------------------------------------------------
            // Auto Parse All Laravel Sessions (Direct & SweetAlert Fallback)
            // ----------------------------------------------------
            @if (session('success'))
                window.showCustomToast(@json(session('success')), 'success');
            @endif

            @if (session('error'))
                window.showCustomToast(@json(session('error')), 'error');
            @endif

            @if (session('info'))
                window.showCustomToast(@json(session('info')), 'info');
            @endif

            @if (session('warning'))
                window.showCustomToast(@json(session('warning')), 'warning');
            @endif

            @if (session('status'))
                window.showCustomToast(@json(session('status')), 'info');
            @endif

            @if (session('sweetalert.config') || session('alert.config'))
                @php
                    $rawSwal = session('sweetalert.config') ?: session('alert.config');
                    $swal = is_array($rawSwal) ? $rawSwal : (is_string($rawSwal) ? json_decode($rawSwal, true) : null);
                @endphp
                @if ($swal && is_array($swal))
                    window.showCustomToast(
                        @json($swal['text'] ?? '' ?: $swal['title'] ?? ''),
                        @json($swal['icon'] ?? 'info'),
                        @json(($swal['title'] ?? '') !== ($swal['text'] ?? '') ? $swal['title'] ?? null : null)
                    );
                @endif
            @endif
        }

        if (document.readyState === 'complete' || document.readyState === 'interactive') {
            setTimeout(initCustomAlerts, 50);
        } else {
            document.addEventListener('DOMContentLoaded', initCustomAlerts);
        }
    })();
</script>

/* Mobile: toast full width on small screens */
@media (max-width: 480px) {
#custom-toast-container {
top: 75px !important;
right: 12px !important;
left: 12px !important;
max-width: 100% !important;
width: calc(100% - 24px) !important;
}
.custom-toast-card {
padding: 12px 14px !important;
border-radius: 14px !important;
}
.custom-modal-card {
margin: 0 12px !important;
padding: 20px !important;
}
}
