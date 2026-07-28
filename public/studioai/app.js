document.addEventListener('DOMContentLoaded', () => {
    // UI Elements - Navigation & Auth Header (present on all pages via header.php)
    const btnNavLogins = document.querySelectorAll('.btn-nav-login');
    const btnLogouts = document.querySelectorAll('.btn-logout');
    
    const mobileProfileBadge = document.querySelector('.mobile-profile-badge');
    const desktopProfileBadge = document.querySelector('.desktop-profile-badge');
    const mobileCreditCount = document.querySelector('.mobile-credit-count');
    const desktopCreditCount = document.querySelector('.desktop-credit-count');
    const usernameDisplays = document.querySelectorAll('.username-display');

    const navLinkLanding = document.getElementById('nav-link-landing');
    const navLinkStudio = document.getElementById('nav-link-studio');
    const navLinkGallery = document.getElementById('nav-link-gallery');
    const navLinkTopup = document.getElementById('nav-link-topup');
    const navLinkReview = document.getElementById('nav-link-review');
    const navLinkProfile = document.getElementById('nav-link-profile');

    // UI Elements - Authentication Forms (login.php & register.php)
    const formLogin = document.getElementById('form-login');
    const loginEmailInput = document.getElementById('login-email');
    const loginPasswordInput = document.getElementById('login-password');
    
    const formRegister = document.getElementById('form-register');
    const registerEmailInput = document.getElementById('register-email');
    const registerPasswordInput = document.getElementById('register-password');
    const registerWhatsappInput = document.getElementById('register-whatsapp');

    const btnGoogleLogin = document.getElementById('btn-google-login');

    // UI Elements - Dropzone & Workspace (studio.php)
    const productDropzone = document.getElementById('product-dropzone');
    const productFileInput = document.getElementById('product-file');
    const productCard = document.getElementById('product-upload-card');
    const optionalNoteInput = document.getElementById('optional-note');
    const generateBtn = document.getElementById('generate-btn');

    // Viewport Output Elements (studio.php)
    const viewportPlaceholder = document.getElementById('viewport-placeholder');
    const viewportLoading = document.getElementById('viewport-loading');
    const viewportResult = document.getElementById('viewport-result');
    const statusBar = document.getElementById('status-bar');
    const statusHeading = document.getElementById('status-heading');
    const statusDesc = document.getElementById('status-desc');
    const spinnerPercent = document.querySelector('.spinner-text');
    const resultImg = document.getElementById('result-img');
    const btnDownload = document.getElementById('btn-download');
    const btnSaveToGallery = document.getElementById('btn-save-to-gallery');
    const btnEdit = document.getElementById('btn-edit');

    // UI Elements - Gallery (gallery.php)
    const galleryGrid = document.getElementById('gallery-grid');
    const galleryEmptyState = document.getElementById('gallery-empty-state');
    const btnClearGallery = document.getElementById('btn-clear-gallery');

    // UI Elements - Reviews Carousel (index.php)
    const reviewsCarousel = document.getElementById('reviews-carousel');

    // UI Elements - Write Review (review.php)
    const formReview = document.getElementById('form-review');
    const starRatingContainer = document.getElementById('star-rating-container');
    const reviewNameInput = document.getElementById('review-name');
    const reviewRoleInput = document.getElementById('review-role');
    const reviewTextInput = document.getElementById('review-text');

    // UI Elements - Profile Settings (profile.php)
    const formProfile = document.getElementById('form-profile');
    const profileAvatarWrapper = document.getElementById('profile-avatar-wrapper');
    const profileAvatarInitial = document.getElementById('profile-avatar-initial');
    const profileAvatarPreview = document.getElementById('profile-avatar-preview');
    const profileAvatarInput = document.getElementById('profile-avatar-input');
    const btnUploadTrigger = document.getElementById('btn-upload-trigger');
    const profileNameInput = document.getElementById('profile-name');
    const profileEmailInput = document.getElementById('profile-email');
    const profileWhatsappInput = document.getElementById('profile-whatsapp');
    const profileCreditsCount = document.getElementById('profile-credits-count');

    // (Extra signup elements removed)

    // Toast Element (present on all pages)
    const toast = document.getElementById('toast');

    // State variables
    let productUrl = null;
    let isUploadingProduct = false;
    let pollIntervalId = null;
    let progressIntervalId = null;
    let selectedSize = '1:1'; // Aspect ratio state
    let isEditMode = false;
    let lastGeneratedUrl = null;
    
    // Auth & Credit States (Synced with LocalStorage)
    let isLoggedIn = localStorage.getItem('poyo_logged_in') === 'true';
    let userEmail = localStorage.getItem('poyo_email') || '';
    let credits = parseInt(localStorage.getItem('poyo_credits') || '15', 10);
    let savedImages = JSON.parse(localStorage.getItem('poyo_saved_images') || '[]');
    let customReviews = JSON.parse(localStorage.getItem('poyo_custom_reviews') || '[]');
    let authMode = 'signin'; // 'signin' or 'signup'
    

    
    // Write review star rating state
    let selectedRating = 0;

    // Baseline reviews list (5 elements, shorter, and compact)
    const defaultReviews = [
        { name: "Budi Santoso", role: "Toko Kopi Lokal", text: "Sangat menghemat budget! Cukup unggah foto HP, hasilnya langsung siap tayang di Instagram.", rating: 5, avatar: "B" },
        { name: "Dewi Lestari", role: "Kosmetik Herbal", text: "Detail kemasannya 100% akurat. Pantulan cahaya dan bayangan sangat halus seperti asli.", rating: 5, avatar: "D" },
        { name: "Roni Wijaya", role: "Digital Marketer", text: "Proses pembuatan cepat sekali. Kualitas rasionya mantap untuk membuat banner iklan Shopee.", rating: 5, avatar: "R" },
        { name: "Siti Rahma", role: "Owner Hijab Brand", text: "Latar studio estetik sekali. Warna latar belakang sangat serasi dengan warna produk hijab saya.", rating: 5, avatar: "S" },
        { name: "Andi Pratama", role: "Snack Distributor", text: "Pencahayaannya mantap. Sangat membantu membuat aset promosi katalog produk baru.", rating: 5, avatar: "A" }
    ];

    // Initialize Page States & Multi-page Auth Routing
    function initApp() {
        updateAuthStateUI();
        handlePageRouting();
        
        // Render gallery if on gallery page
        if (galleryGrid) {
            renderGallery();
        }

        // Render reviews if on landing page
        if (reviewsCarousel) {
            renderReviews();
        }

        // Initialize star selector listeners if on review form page
        if (starRatingContainer) {
            setupStarRatingSelector();
        }

        // Initialize user profile settings if on profile page
        if (formProfile) {
            setupProfilePage();
        }

        // Initialize mobile menu toggle drawer
        const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
        const mobileMenuDrawer = document.getElementById('mobile-menu-drawer');
        const menuToggleIcon = document.getElementById('menu-toggle-icon');

        if (mobileMenuToggle && mobileMenuDrawer) {
            mobileMenuToggle.addEventListener('click', () => {
                const isCurrentlyHidden = mobileMenuDrawer.classList.contains('hidden') || mobileMenuDrawer.style.display === 'none' || mobileMenuDrawer.style.display === '';
                
                if (isCurrentlyHidden) {
                    mobileMenuDrawer.classList.remove('hidden');
                    mobileMenuDrawer.style.display = 'flex';
                    if (menuToggleIcon) menuToggleIcon.className = 'bi bi-x text-xl';
                } else {
                    mobileMenuDrawer.style.display = 'none';
                    if (menuToggleIcon) menuToggleIcon.className = 'bi bi-list text-xl';
                }
            });
        }
    }



    // Multi-page Route Protection & Nav Link Highlighting
    function handlePageRouting() {
        const path = window.location.pathname;
        const pageName = path.split('/').pop() || 'index.php';

        // Highlight Active Link based on filename for both mobile and desktop
        const allNavLinks = document.querySelectorAll('.nav-link-landing, .nav-link-studio, .nav-link-gallery, .nav-link-topup, .nav-link-review, .nav-link-profile');
        allNavLinks.forEach(link => {
            link.classList.remove('active-nav');
        });

        if (pageName === 'index.php' || pageName === '') {
            document.querySelectorAll('.nav-link-landing').forEach(el => el.classList.add('active-nav'));
        } else if (pageName === 'studio.php') {
            document.querySelectorAll('.nav-link-studio').forEach(el => el.classList.add('active-nav'));
        } else if (pageName === 'gallery.php') {
            document.querySelectorAll('.nav-link-gallery').forEach(el => el.classList.add('active-nav'));
        } else if (pageName === 'topup.php') {
            document.querySelectorAll('.nav-link-topup').forEach(el => el.classList.add('active-nav'));
        } else if (pageName === 'review.php') {
            document.querySelectorAll('.nav-link-review').forEach(el => el.classList.add('active-nav'));
        } else if (pageName === 'profile.php') {
            document.querySelectorAll('.nav-link-profile').forEach(el => el.classList.add('active-nav'));
        }

        // Protected Pages: No redirects in design phase
        // const protectedPages = ['studio.php', 'gallery.php', 'topup.php', 'review.php', 'profile.php'];
        // if (protectedPages.includes(pageName) && !isLoggedIn) {
        //     window.location.href = 'login.php';
        // }
    }

    // Sync Auth State to DOM elements (Shared navbar header)
    function updateAuthStateUI() {
        if (isLoggedIn) {
            // Hide login buttons, show badges
            btnNavLogins.forEach(btn => btn.classList.add('hidden'));
            
            if (mobileProfileBadge) {
                mobileProfileBadge.classList.remove('hidden');
                mobileProfileBadge.classList.add('flex');
            }
            if (desktopProfileBadge) {
                desktopProfileBadge.classList.remove('hidden');
                desktopProfileBadge.classList.add('flex');
            }
            
            const displayName = localStorage.getItem('poyo_name') || userEmail.split('@')[0] || 'User';
            usernameDisplays.forEach(el => el.textContent = displayName);
            
            // Sync mobile/desktop avatar badges
            const storedAvatar = localStorage.getItem('poyo_avatar');
            const mobileAvatarImg = document.querySelector('.mobile-avatar-img');
            const mobileAvatarInitial = document.querySelector('.mobile-avatar-initial');
            const desktopAvatarImg = document.querySelector('.desktop-avatar-img');
            const desktopAvatarInitial = document.querySelector('.desktop-avatar-initial');
            
            const initialChar = displayName.charAt(0).toUpperCase() || 'U';

            if (storedAvatar) {
                if (mobileAvatarImg) {
                    mobileAvatarImg.src = storedAvatar;
                    mobileAvatarImg.classList.remove('hidden');
                }
                if (mobileAvatarInitial) mobileAvatarInitial.classList.add('hidden');
                if (desktopAvatarImg) {
                    desktopAvatarImg.src = storedAvatar;
                    desktopAvatarImg.classList.remove('hidden');
                }
                if (desktopAvatarInitial) desktopAvatarInitial.classList.add('hidden');
            } else {
                if (mobileAvatarImg) mobileAvatarImg.classList.add('hidden');
                if (mobileAvatarInitial) {
                    mobileAvatarInitial.textContent = initialChar;
                    mobileAvatarInitial.classList.remove('hidden');
                }
                if (desktopAvatarImg) desktopAvatarImg.classList.add('hidden');
                if (desktopAvatarInitial) {
                    desktopAvatarInitial.textContent = initialChar;
                    desktopAvatarInitial.classList.remove('hidden');
                }
            }
            
            if (mobileCreditCount) mobileCreditCount.textContent = credits;
            if (desktopCreditCount) desktopCreditCount.textContent = credits;
        } else {
            // Show login buttons, hide badges
            btnNavLogins.forEach(btn => btn.classList.remove('hidden'));
            
            if (mobileProfileBadge) {
                mobileProfileBadge.classList.add('hidden');
                mobileProfileBadge.classList.remove('flex');
            }
            if (desktopProfileBadge) {
                desktopProfileBadge.classList.add('hidden');
                desktopProfileBadge.classList.remove('flex');
            }
        }
    }

    // Toast Notification helper
    function showToast(message, type = 'info') {
        if (!toast) return;
        toast.querySelector('.toast-message').textContent = message;
        toast.className = 'fixed bottom-6 right-6 bg-white dark:bg-zinc-900 border text-zinc-900 dark:text-zinc-50 rounded-lg p-4 shadow-xl z-50 flex items-center gap-3 min-w-[280px] max-w-sm transition-all duration-300';

        const icon = toast.querySelector('.toast-icon');
        icon.className = 'toast-icon bi text-base';

        if (type === 'success') {
            toast.classList.add('border-emerald-500/20');
            icon.classList.add('bi-check-circle-fill', 'text-emerald-500');
        } else if (type === 'error') {
            toast.classList.add('border-red-500/20');
            icon.classList.add('bi-exclamation-triangle-fill', 'text-red-500');
        } else {
            toast.classList.add('border-zinc-200 dark:border-zinc-800');
            icon.classList.add('bi-info-circle-fill', 'text-zinc-500');
        }

        toast.classList.remove('hidden');
        setTimeout(() => {
            toast.classList.add('hidden');
        }, 4000);
    }

    // Form sign-in logic (login.php)
    if (formLogin) {
        formLogin.addEventListener('submit', (e) => {
            e.preventDefault();
            const email = loginEmailInput.value.trim();
            
            isLoggedIn = true;
            userEmail = email;
            credits = 15; // baseline free credits
            
            localStorage.setItem('poyo_logged_in', 'true');
            localStorage.setItem('poyo_email', email);
            localStorage.setItem('poyo_credits', credits.toString());
            if (!localStorage.getItem('poyo_name')) {
                localStorage.setItem('poyo_name', email.split('@')[0]);
            }
            updateAuthStateUI();
            window.location.href = 'studio.php';
        });
    }

    // Form sign-up logic (register.php)
    if (formRegister) {
        formRegister.addEventListener('submit', (e) => {
            e.preventDefault();
            const email = registerEmailInput.value.trim();
            const whatsapp = registerWhatsappInput ? registerWhatsappInput.value.trim() : '';
            
            isLoggedIn = true;
            userEmail = email;
            credits = 15; // baseline free credits
            
            localStorage.setItem('poyo_logged_in', 'true');
            localStorage.setItem('poyo_email', email);
            localStorage.setItem('poyo_credits', credits.toString());
            localStorage.setItem('poyo_name', email.split('@')[0]);
            localStorage.setItem('poyo_whatsapp', whatsapp);
            localStorage.setItem('poyo_avatar', ''); // default profile empty
            updateAuthStateUI();
            window.location.href = 'studio.php';
        });
    }

    // Google Login button simulation (login.php)
    if (btnGoogleLogin) {
        btnGoogleLogin.addEventListener('click', () => {
            isLoggedIn = true;
            userEmail = 'google.user@gmail.com';
            credits = 15;
            
            localStorage.setItem('poyo_logged_in', 'true');
            localStorage.setItem('poyo_email', userEmail);
            localStorage.setItem('poyo_credits', credits.toString());
            
            updateAuthStateUI();
            
            // Redirect to studio
            window.location.href = 'studio.php';
        });
    }

    // Logout logic (Shared header navbar)
    btnLogouts.forEach(btn => {
        btn.addEventListener('click', () => {
            isLoggedIn = false;
            userEmail = '';
            localStorage.removeItem('poyo_logged_in');
            localStorage.removeItem('poyo_email');
            
            updateAuthStateUI();
            window.location.href = 'index.php';
        });
    });

    // Form Validation state control (studio.php)
    function validateForm() {
        if (!generateBtn) return;
        const productUploaded = productUrl !== null;
        const noneUploading = !isUploadingProduct;
        generateBtn.disabled = !(productUploaded && noneUploading);
    }

    // File Upload handling via proxy (studio.php)
    function uploadFile(file, type, card, dropzone, onSuccess, onError) {
        const progressBarContainer = card.querySelector('.progress-bar-container');
        const progressBar = card.querySelector('.progress-bar');
        const progressLabel = card.querySelector('.progress-label');
        const previewContainer = dropzone.querySelector('.preview-container');
        const previewImg = previewContainer.querySelector('.img-preview');
        const dropzoneContent = dropzone.querySelector('.dropzone-content');

        progressBarContainer.classList.remove('hidden');
        progressBar.style.width = '0%';
        progressLabel.textContent = '0%';

        isUploadingProduct = true;
        validateForm();

        const formData = new FormData();
        formData.append('file', file);

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'proxy.php?action=upload', true);

        xhr.upload.onprogress = (e) => {
            if (e.lengthComputable) {
                const percent = Math.round((e.loaded / e.total) * 100);
                progressBar.style.setProperty('--progress', `${percent}%`);
                progressLabel.textContent = `${percent}%`;
            }
        };

        xhr.onload = () => {
            isUploadingProduct = false;
            validateForm();

            if (xhr.status === 200) {
                try {
                    const res = JSON.parse(xhr.responseText);
                    if (res && res.success && res.data && res.data.file_url) {
                        progressBarContainer.classList.add('hidden');

                        const reader = new FileReader();
                        reader.onload = (event) => {
                            previewImg.src = event.target.result;
                            previewContainer.classList.remove('hidden');
                            dropzoneContent.classList.add('hidden');
                        };
                        reader.readAsDataURL(file);

                        onSuccess(res.data.file_url);
                        showToast(`Foto Produk berhasil diunggah`, 'success');
                    } else {
                        throw new Error(res.msg || 'Struktur respon server tidak valid');
                    }
                } catch (err) {
                    progressBarContainer.classList.add('hidden');
                    onError(err.message);
                }
            } else {
                progressBarContainer.classList.add('hidden');
                try {
                    const errRes = JSON.parse(xhr.responseText);
                    onError(errRes.error || errRes.detail || `Unggah gagal dengan status ${xhr.status}`);
                } catch (e) {
                    onError(`Unggah gagal dengan status ${xhr.status}`);
                }
            }
        };

        xhr.onerror = () => {
            isUploadingProduct = false;
            validateForm();
            progressBarContainer.classList.add('hidden');
            onError('Koneksi jaringan bermasalah saat mengunggah');
        };

        xhr.send(formData);
    }

    // Set up Dropzones (studio.php)
    function setupDropzone(dropzone, fileInput, card, type, onUrlReceived, onReset) {
        if (!dropzone) return;
        
        dropzone.addEventListener('click', (e) => {
            if (e.target.closest('.remove-btn')) return;
            fileInput.click();
        });

        fileInput.addEventListener('change', () => {
            if (fileInput.files.length > 0) {
                const file = fileInput.files[0];
                uploadFile(file, type, card, dropzone, onUrlReceived, (errorMsg) => {
                    showToast(errorMsg, 'error');
                    resetDropzone(dropzone, fileInput, onReset);
                });
            }
        });

        ['dragenter', 'dragover'].forEach(eventName => {
            dropzone.addEventListener(eventName, (e) => {
                e.preventDefault();
                e.stopPropagation();
                dropzone.classList.add('dragover');
            }, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropzone.addEventListener(eventName, (e) => {
                e.preventDefault();
                e.stopPropagation();
                dropzone.classList.remove('dragover');
            }, false);
        });

        dropzone.addEventListener('drop', (e) => {
            const dt = e.dataTransfer;
            const files = dt.files;
            if (files.length > 0) {
                const file = files[0];
                if (file.type.startsWith('image/')) {
                    uploadFile(file, type, card, dropzone, onUrlReceived, (errorMsg) => {
                        showToast(errorMsg, 'error');
                        resetDropzone(dropzone, fileInput, onReset);
                    });
                } else {
                    showToast('Harap unggah berkas gambar (PNG, JPG, WEBP)', 'error');
                }
            }
        });

        const removeBtn = dropzone.querySelector('.remove-btn');
        if (removeBtn) {
            removeBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                resetDropzone(dropzone, fileInput, onReset);
            });
        }
    }

    function resetDropzone(dropzone, fileInput, onReset) {
        fileInput.value = '';
        dropzone.querySelector('.preview-container').classList.add('hidden');
        dropzone.querySelector('.dropzone-content').classList.remove('hidden');
        onReset();
    }

    // Initialize Dropzones (studio.php)
    if (productDropzone) {
        setupDropzone(
            productDropzone,
            productFileInput,
            productCard,
            'product',
            (url) => { productUrl = url; validateForm(); },
            () => { 
                productUrl = null; 
                validateForm(); 
                exitEditMode(); 
            }
        );
    }

    function exitEditMode() {
        isEditMode = false;
        const editContainer = document.getElementById('edit-instruction-container');
        if (editContainer) {
            editContainer.classList.add('hidden');
            const editTextarea = document.getElementById('edit-instruction');
            if (editTextarea) editTextarea.value = '';
        }
        if (generateBtn) {
            generateBtn.innerHTML = '<i class="bi bi-magic"></i> Generate Desain (8 Gelas Kopi)';
        }
    }

    if (optionalNoteInput) {
        optionalNoteInput.addEventListener('input', validateForm);
    }

    // Handle Generation Action (studio.php)
    if (generateBtn) {
        generateBtn.addEventListener('click', () => {
            if (!productUrl) return;

            // Check user credits - requires 6 credits in edit mode, 8 otherwise
            const requiredCredits = isEditMode ? 6 : 8;
            if (credits < requiredCredits) {
                showToast(`Gelas kopi Anda tidak mencukupi untuk membuat desain (memerlukan ${requiredCredits} gelas kopi). Silakan isi saldo!`, 'error');
                setTimeout(() => {
                    window.location.href = 'topup.php';
                }, 1500);
                return;
            }

            // Switch viewport state
            viewportPlaceholder.style.display = 'none';
            viewportResult.style.display = 'none';
            viewportLoading.style.display = 'flex';

            statusBar.style.width = '5%';
            spinnerPercent.textContent = '5%';
            statusHeading.textContent = 'Mengirimkan Tugas Desain...';
            statusDesc.textContent = 'Menghubungi backend proxy retcehStudio AI.';

            const payload = {
                optional_note: optionalNoteInput.value.trim(),
                image_urls: isEditMode ? [lastGeneratedUrl] : [productUrl],
                size: '1:1'
            };

            if (isEditMode) {
                const editInst = document.getElementById('edit-instruction');
                if (editInst) {
                    payload.edit_instruction = editInst.value.trim();
                }
            }

            fetch('proxy.php?action=submit', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(payload)
            })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(err => { throw new Error(err.error || err.detail || 'Gagal mengirim tugas ke server'); });
                    }
                    return response.json();
                })
                .then(res => {
                    if (res && res.code === 200 && res.data && res.data.task_id) {
                        // Successful submit: consume required credits
                        credits -= requiredCredits;
                        localStorage.setItem('poyo_credits', credits.toString());
                        updateAuthStateUI();

                        const taskId = res.data.task_id;
                        statusBar.style.width = '10%';
                        spinnerPercent.textContent = '10%';
                        statusHeading.textContent = 'Tugas Berhasil Dikirim';

                        let desc = `Tugas ID: ${taskId}`;
                        if (res.debug && res.debug.product_desc) {
                            desc += `<br><span style="font-size:0.8rem; display:block; margin-top:5px; opacity:0.8;">Produk Teridentifikasi: <strong>${res.debug.product_desc}</strong></span>`;
                        }
                        statusDesc.innerHTML = desc;
                        startPolling(taskId);
                    } else {
                        throw new Error('Tidak ada tanda pengenal tugas yang diterima dari server');
                    }
                })
                .catch(err => {
                    showToast(err.message, 'error');
                    resetViewportToPlaceholder();
                });
        });
    }

    // Polling Status Logic (studio.php)
    function startPolling(taskId) {
        if (pollIntervalId) clearTimeout(pollIntervalId);
        if (progressIntervalId) clearInterval(progressIntervalId);

        let attempts = 0;
        const maxAttempts = 120;
        let pollInterval = 3000;

        let fakeProgress = 10;
        statusBar.style.width = '10%';
        spinnerPercent.textContent = '10%';

        progressIntervalId = setInterval(() => {
            if (fakeProgress < 95) {
                if (fakeProgress < 40) {
                    fakeProgress += Math.floor(Math.random() * 3) + 2;
                } else if (fakeProgress < 75) {
                    fakeProgress += Math.floor(Math.random() * 2) + 1;
                } else {
                    fakeProgress += (Math.random() > 0.6 ? 1 : 0);
                }
                statusBar.style.width = `${fakeProgress}%`;
                spinnerPercent.textContent = `${fakeProgress}%`;
            }
        }, 1000);

        function poll() {
            attempts++;
            if (attempts > maxAttempts) {
                if (progressIntervalId) {
                    clearInterval(progressIntervalId);
                    progressIntervalId = null;
                }
                showToast('Waktu pembuatan desain habis. Harap ulangi kembali.', 'error');
                resetViewportToPlaceholder();
                return;
            }

            fetch(`proxy.php?action=status&task_id=${taskId}`)
                .then(response => {
                    if (response.status === 429) {
                        console.warn('retcehStudio AI Status Rate Limited (429). Backing off...');
                        pollInterval = Math.min(pollInterval * 1.5, 12000);
                        statusDesc.innerHTML = `Tugas ID: ${taskId}<br><span style="color:#ffbb00; font-size:0.85rem; display:block; margin-top:5px;">Terbatasi batas API. Menunda cek status ke ${Math.round(pollInterval / 1000)} detik...</span>`;
                        pollIntervalId = setTimeout(poll, pollInterval);
                        return null;
                    }
                    if (!response.ok) {
                        return response.json()
                            .then(err => { throw new Error(err.error || err.detail || `Masalah server (HTTP ${response.status})`); })
                            .catch(() => { throw new Error(`Masalah jaringan (HTTP ${response.status})`); });
                    }
                    return response.json();
                })
                .then(res => {
                    if (!res) return;

                    // Robust response normalization
                    const data = (res.code !== undefined) ? res.data : res;
                    const code = (res.code !== undefined) ? res.code : 200;

                    if (code === 200 && data) {
                        const rawStatus = data.status ? String(data.status).toLowerCase() : 'running';

                        viewportPlaceholder.style.display = 'none';
                        viewportResult.style.display = 'none';
                        viewportLoading.style.display = 'flex';

                        if (rawStatus === 'not_started' || rawStatus === 'pending' || rawStatus === 'queued') {
                            statusHeading.textContent = 'Dalam Antrean';
                            statusDesc.textContent = 'Menunggu antrean pembuatan di server...';
                            pollInterval = Math.max(pollInterval - 500, 3000);
                            pollIntervalId = setTimeout(poll, pollInterval);
                        } else if (rawStatus === 'running' || rawStatus === 'processing') {
                            statusHeading.textContent = 'Memproses Desain';
                            statusDesc.textContent = `Memproses detail latar belakang (Kemajuan: ${fakeProgress}%).`;
                            pollInterval = Math.max(pollInterval - 500, 3000);
                            pollIntervalId = setTimeout(poll, pollInterval);
                        } else if (rawStatus === 'finished' || rawStatus === 'succeed' || rawStatus === 'success' || rawStatus === 'completed') {
                            if (progressIntervalId) {
                                clearInterval(progressIntervalId);
                                progressIntervalId = null;
                            }
                            statusBar.style.width = '100%';
                            spinnerPercent.textContent = '100%';

                            // Robust image url extraction
                            let finalUrl = null;
                            if (data.files && data.files.length > 0) {
                                const resultFile = data.files.find(f => f.file_type === 'image') || data.files[0];
                                finalUrl = resultFile.file_url;
                            } else if (data.output && data.output.url) {
                                finalUrl = data.output.url;
                            } else if (data.file_url) {
                                finalUrl = data.file_url;
                            } else if (data.url) {
                                finalUrl = data.url;
                            }

                            if (finalUrl) {
                                setTimeout(() => {
                                    resultImg.src = finalUrl;
                                    btnDownload.href = finalUrl;
                                    lastGeneratedUrl = finalUrl; // Store the last generated URL for editing

                                    // Enable save button
                                    btnSaveToGallery.disabled = false;
                                    btnSaveToGallery.innerHTML = '<i class="bi bi-bookmark-fill"></i> Simpan ke Galeri';

                                    viewportLoading.style.display = 'none';
                                    viewportResult.style.display = 'flex';

                                    showToast('Desain foto produk berhasil dibuat!', 'success');
                                }, 500);
                            } else {
                                throw new Error('Status selesai diterima tetapi URL hasil gambar tidak ditemukan');
                            }
                        } else if (rawStatus === 'failed' || rawStatus === 'error') {
                            if (progressIntervalId) {
                                clearInterval(progressIntervalId);
                                progressIntervalId = null;
                            }
                            throw new Error(data.error_message || data.error || 'Pembuatan desain gagal di server');
                        } else {
                            // Unrecognized status, keep polling defensively
                            console.warn('Unrecognized status received:', rawStatus);
                            pollIntervalId = setTimeout(poll, pollInterval);
                        }
                    } else {
                        throw new Error((data && (data.error || data.error_message)) || 'Respon status tidak valid dari server');
                    }
                })
                .catch(err => {
                    if (progressIntervalId) {
                        clearInterval(progressIntervalId);
                        progressIntervalId = null;
                    }
                    showToast(err.message, 'error');
                    resetViewportToPlaceholder();
                });
        }

        pollIntervalId = setTimeout(poll, pollInterval);
    }

    function resetViewportToPlaceholder() {
        if (pollIntervalId) {
            clearTimeout(pollIntervalId);
            pollIntervalId = null;
        }
        if (progressIntervalId) {
            clearInterval(progressIntervalId);
            progressIntervalId = null;
        }
        exitEditMode();
        if (viewportLoading) viewportLoading.style.display = 'none';
        if (viewportResult) viewportResult.style.display = 'none';
        if (viewportPlaceholder) viewportPlaceholder.style.display = 'flex';
    }

    if (btnEdit) {
        btnEdit.addEventListener('click', () => {
            isEditMode = true;

            // Show edit instruction form container
            const editContainer = document.getElementById('edit-instruction-container');
            if (editContainer) {
                editContainer.classList.remove('hidden');
            }

            // Change Generate button label
            if (generateBtn) {
                generateBtn.innerHTML = '<i class="bi bi-magic"></i> Edit Desain (6 Gelas Kopi)';
            }

            // Scroll parameter controls card into view
            const controlCard = document.getElementById('product-upload-card');
            if (controlCard) {
                controlCard.scrollIntoView({ behavior: 'smooth' });
            }

            showToast('Mode Edit Aktif! Tulis instruksi perubahan di kolom kiri.', 'info');
        });
    }

    // Save Image to Gallery Handler (studio.php)
    if (btnSaveToGallery) {
        btnSaveToGallery.addEventListener('click', () => {
            const imageUrl = resultImg.src;
            if (!imageUrl) return;

            if (savedImages.some(img => img.url === imageUrl)) {
                showToast('Gambar sudah tersimpan di galeri!', 'info');
                return;
            }

            const newImage = {
                id: Date.now(),
                url: imageUrl,
                timestamp: new Date().toLocaleDateString('id-ID', { month: 'short', day: 'numeric', year: 'numeric' })
            };
            
            savedImages.unshift(newImage);
            localStorage.setItem('poyo_saved_images', JSON.stringify(savedImages));

            showToast('Berhasil disimpan ke Galeri!', 'success');
            btnSaveToGallery.disabled = true;
            btnSaveToGallery.innerHTML = '<i class="bi bi-check-circle-fill"></i> Tersimpan';
        });
    }

    // Gallery Render function (gallery.php)
    function renderGallery() {
        if (!galleryGrid) return;
        
        galleryGrid.innerHTML = '';
        
        if (savedImages.length === 0) {
            galleryGrid.classList.add('hidden');
            if (galleryEmptyState) galleryEmptyState.classList.remove('hidden');
            if (btnClearGallery) btnClearGallery.classList.add('hidden');
        } else {
            galleryGrid.classList.remove('hidden');
            if (galleryEmptyState) galleryEmptyState.classList.add('hidden');
            if (btnClearGallery) btnClearGallery.classList.remove('hidden');

            savedImages.forEach(img => {
                const card = document.createElement('div');
                card.className = 'group relative rounded-xl overflow-hidden border border-zinc-200 bg-white aspect-square flex items-center justify-center p-2 shadow-sm transition-colors duration-300';
                card.innerHTML = `
                    <img src="${img.url}" alt="Saved Render" class="max-w-full max-h-full object-contain">
                    <span class="absolute bottom-2 left-2 px-2 py-0.5 bg-black/75 text-white rounded-full text-[8px] font-medium z-10">${img.timestamp}</span>
                    
                    <!-- Hover actions -->
                    <div class="absolute inset-0 bg-black/40 flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200 z-20">
                        <a href="${img.url}" target="_blank" download="product-render.jpg" class="w-8 h-8 rounded-full bg-white text-zinc-900 flex items-center justify-center hover:bg-zinc-100 transition cursor-pointer" title="Download">
                            <i class="bi bi-download"></i>
                        </a>
                        <button type="button" data-id="${img.id}" class="btn-delete-gallery-img w-8 h-8 rounded-full bg-red-600 text-white flex items-center justify-center hover:bg-red-700 transition cursor-pointer" title="Delete">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                `;
                galleryGrid.appendChild(card);
            });

            // Bind delete button listeners
            document.querySelectorAll('.btn-delete-gallery-img').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const idToDelete = parseInt(e.currentTarget.dataset.id, 10);
                    savedImages = savedImages.filter(img => img.id !== idToDelete);
                    localStorage.setItem('poyo_saved_images', JSON.stringify(savedImages));
                    showToast('Gambar dihapus dari galeri', 'info');
                    renderGallery();
                });
            });
        }
    }

    // Clear Gallery Logic (gallery.php)
    if (btnClearGallery) {
        btnClearGallery.addEventListener('click', () => {
            if (confirm('Apakah Anda yakin ingin menghapus seluruh riwayat desain di galeri?')) {
                savedImages = [];
                localStorage.removeItem('poyo_saved_images');
                showToast('Galeri dibersihkan', 'info');
                renderGallery();
            }
        });
    }

    // Credit Purchase / Top-Up Simulation (topup.php)
    document.querySelectorAll('.btn-purchase-credits').forEach(btn => {
        btn.addEventListener('click', (e) => {
            const addedCredits = parseInt(e.currentTarget.dataset.credits, 10);
            
            const originalText = e.currentTarget.innerHTML;
            e.currentTarget.disabled = true;
            e.currentTarget.innerHTML = '<i class="bi bi-arrow-repeat animate-spin"></i> Memproses pembayaran...';

            setTimeout(() => {
                credits += addedCredits;
                localStorage.setItem('poyo_credits', credits.toString());
                updateAuthStateUI();

                e.currentTarget.disabled = false;
                e.currentTarget.innerHTML = originalText;

                showToast(`Pembayaran berhasil! Menambahkan ${addedCredits} gelas kopi ke akun Anda.`, 'success');
                setTimeout(() => {
                    window.location.href = 'studio.php';
                }, 1000);
            }, 1500);
        });
    });

    // Render Dynamic Reviews Carousel list (index.php)
    function renderReviews() {
        if (!reviewsCarousel) return;
        reviewsCarousel.innerHTML = '';

        // Combine custom feedback submissions and default ones
        const allReviews = [...customReviews, ...defaultReviews];

        allReviews.forEach(rev => {
            const card = document.createElement('div');
            // Premium styled white cards with custom border and shadow transitions
            card.className = 'p-5 border border-zinc-200 bg-white rounded-3xl space-y-4 shadow-sm snap-center min-w-[260px] sm:min-w-[280px] max-w-[280px] flex-shrink-0 flex flex-col justify-between transition-all duration-300 hover:shadow-md hover:-translate-y-1 hover:border-zinc-300 relative group';
            
            // Build star ratings
            let starsHTML = '';
            for (let i = 1; i <= 5; i++) {
                if (i <= rev.rating) {
                    starsHTML += '<i class="bi bi-star-fill text-amber-500"></i>';
                } else {
                    starsHTML += '<i class="bi bi-star text-zinc-300"></i>';
                }
            }

            card.innerHTML = `
                <div class="space-y-3 relative">
                    <!-- Decorative Quote Icon -->
                    <span class="absolute -top-2 -left-2 text-zinc-100 text-5xl font-serif select-none pointer-events-none group-hover:text-wise-green/30 transition-colors duration-300">“</span>
                    <div class="flex items-center gap-0.5 text-xs text-amber-500 relative z-10">
                        ${starsHTML}
                    </div>
                    <p class="text-xs text-zinc-650 leading-relaxed italic relative z-10">
                        "${rev.text}"
                    </p>
                </div>
                <div class="flex items-center gap-3 pt-3 border-t border-zinc-100">
                    <div class="w-8 h-8 rounded-full bg-wise-green text-forest flex items-center justify-center text-xs font-black shadow-sm flex-shrink-0 ring-2 ring-zinc-50">
                        ${rev.avatar || rev.name.charAt(0).toUpperCase()}
                    </div>
                    <div class="min-w-0">
                        <h4 class="text-xs font-bold text-zinc-900 truncate">${rev.name}</h4>
                        <p class="text-[10px] text-zinc-400 truncate">${rev.role}</p>
                    </div>
                </div>
            `;
            reviewsCarousel.appendChild(card);
        });
    }

    // Set up interactive Star Rating Selector (review.php)
    function setupStarRatingSelector() {
        const starBtns = starRatingContainer.querySelectorAll('.star-select-btn');
        
        starBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                selectedRating = parseInt(e.currentTarget.dataset.value, 10);
                updateStarSelectionUI();
            });

            btn.addEventListener('mouseenter', (e) => {
                const hoverValue = parseInt(e.currentTarget.dataset.value, 10);
                highlightStars(hoverValue);
            });
        });

        starRatingContainer.addEventListener('mouseleave', () => {
            updateStarSelectionUI();
        });

        function highlightStars(val) {
            starBtns.forEach(btn => {
                const btnVal = parseInt(btn.dataset.value, 10);
                if (btnVal <= val) {
                    btn.className = 'bi bi-star-fill star-select-btn cursor-pointer text-amber-500 transition scale-110';
                } else {
                    btn.className = 'bi bi-star star-select-btn cursor-pointer text-zinc-300 dark:text-zinc-700 transition';
                }
            });
        }

        function updateStarSelectionUI() {
            highlightStars(selectedRating);
        }
    }

    // Submit Custom Review (review.php)
    if (formReview) {
        formReview.addEventListener('submit', (e) => {
            e.preventDefault();

            if (selectedRating === 0) {
                showToast('Silakan pilih nilai kepuasan bintang terlebih dahulu!', 'error');
                return;
            }

            const name = reviewNameInput.value.trim();
            const role = reviewRoleInput.value.trim();
            const text = reviewTextInput.value.trim();

            const newReview = {
                name: name,
                role: role,
                text: text,
                rating: selectedRating,
                avatar: name.charAt(0).toUpperCase()
            };

            customReviews.unshift(newReview);
            localStorage.setItem('poyo_custom_reviews', JSON.stringify(customReviews));

            // Reset Form & Rating
            formReview.reset();
            selectedRating = 0;
            if (starRatingContainer) {
                starRatingContainer.querySelectorAll('.star-select-btn').forEach(btn => {
                    btn.className = 'bi bi-star star-select-btn cursor-pointer text-zinc-300 dark:text-zinc-700 transition';
                });
            }

            showToast('Ulasan Anda berhasil dikirim! Terima kasih.', 'success');

            // Redirect back to landing page after brief delay
            setTimeout(() => {
                window.location.href = 'index.php';
            }, 1000);
        });
    }

    // User Profile settings sync and form controller
    function setupProfilePage() {
        if (!formProfile) return;

        const storedEmail = localStorage.getItem('poyo_email') || '';
        const storedName = localStorage.getItem('poyo_name') || storedEmail.split('@')[0] || 'User';
        const storedWhatsapp = localStorage.getItem('poyo_whatsapp') || '';
        const storedAvatar = localStorage.getItem('poyo_avatar') || '';

        profileEmailInput.value = storedEmail;
        profileNameInput.value = storedName;
        profileWhatsappInput.value = storedWhatsapp;
        profileCreditsCount.textContent = credits;

        // Render initial avatar previews
        renderProfileAvatar(storedName, storedAvatar);

        // Click trigger hooks
        const triggerInput = () => {
            if (profileAvatarInput) profileAvatarInput.click();
        };
        if (profileAvatarWrapper) profileAvatarWrapper.addEventListener('click', triggerInput);
        if (btnUploadTrigger) btnUploadTrigger.addEventListener('click', triggerInput);

        // Upload Preview reader
        if (profileAvatarInput) {
            profileAvatarInput.addEventListener('change', (e) => {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (event) => {
                        const avatarBase64 = event.target.result;
                        if (profileAvatarPreview) {
                            profileAvatarPreview.src = avatarBase64;
                            profileAvatarPreview.classList.remove('hidden');
                            profileAvatarPreview.dataset.base64 = avatarBase64;
                        }
                        if (profileAvatarInitial) profileAvatarInitial.classList.add('hidden');
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        // Submit Profile Save
        formProfile.addEventListener('submit', (e) => {
            e.preventDefault();
            const newName = profileNameInput.value.trim();
            const newWhatsapp = profileWhatsappInput.value.trim();
            
            let finalAvatar = localStorage.getItem('poyo_avatar') || '';
            if (profileAvatarPreview && profileAvatarPreview.dataset.base64) {
                finalAvatar = profileAvatarPreview.dataset.base64;
            }

            localStorage.setItem('poyo_name', newName);
            localStorage.setItem('poyo_whatsapp', newWhatsapp);
            localStorage.setItem('poyo_avatar', finalAvatar);

            updateAuthStateUI();
            showToast('Profil Anda berhasil diperbarui!', 'success');
        });
    }

    function renderProfileAvatar(name, avatar) {
        if (!profileAvatarPreview) return;
        const initial = name.charAt(0).toUpperCase() || 'U';
        if (avatar) {
            profileAvatarPreview.src = avatar;
            profileAvatarPreview.classList.remove('hidden');
            if (profileAvatarInitial) profileAvatarInitial.classList.add('hidden');
        } else {
            profileAvatarPreview.classList.add('hidden');
            if (profileAvatarInitial) {
                profileAvatarInitial.textContent = initial;
                profileAvatarInitial.classList.remove('hidden');
            }
        }
    }

    // Handle mobile card carousel 3D rotation coverflow effect
    const deckCarousel = document.getElementById('deck-carousel');
    if (deckCarousel) {
        const updateDeckTransforms = () => {
            const items = deckCarousel.querySelectorAll('.carousel-deck-item');
            
            if (window.innerWidth >= 768) {
                // Reset styling properties on desktop grid
                items.forEach(item => {
                    const wrapper = item.querySelector('.deck-wrapper');
                    if (wrapper) {
                        wrapper.style.transform = '';
                        wrapper.style.opacity = '';
                    }
                });
                return;
            }
            
            const carouselRect = deckCarousel.getBoundingClientRect();
            const carouselCenter = carouselRect.left + carouselRect.width / 2;
            
            items.forEach(item => {
                const itemRect = item.getBoundingClientRect();
                const itemCenter = itemRect.left + itemRect.width / 2;
                const distanceFromCenter = itemCenter - carouselCenter;
                const maxDistance = carouselRect.width / 2;
                
                // Normalize distance between -1 and 1
                let ratio = distanceFromCenter / maxDistance;
                ratio = Math.max(-1, Math.min(1, ratio));
                
                // Calculate 3D rotation and scale based on scroll distance
                const rotationY = ratio * -25; // sweeps around on Y-axis
                const scale = 1 - Math.abs(ratio) * 0.12; 
                const translateZ = -Math.abs(ratio) * 80;
                const opacity = 1 - Math.abs(ratio) * 0.35;
                
                const wrapper = item.querySelector('.deck-wrapper');
                if (wrapper) {
                    wrapper.style.transform = `rotateY(${rotationY}deg) scale(${scale}) translateZ(${translateZ}px)`;
                    wrapper.style.opacity = opacity;
                }
            });
        };
        
        deckCarousel.addEventListener('scroll', updateDeckTransforms);
        window.addEventListener('resize', updateDeckTransforms);
        
        // Tap/click trigger for flipping/swapping cards (both desktop and mobile)
        const wrappers = deckCarousel.querySelectorAll('.deck-wrapper');
        wrappers.forEach(wrapper => {
            wrapper.addEventListener('click', (e) => {
                wrapper.classList.toggle('is-flipped');
            });
        });
        
        // Delay to allow initial client paint before computing offsets
        setTimeout(updateDeckTransforms, 150);
    }

    // Start App init
    initApp();
});
