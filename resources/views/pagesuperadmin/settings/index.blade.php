@extends('template-admin.layout')

@section('content')
    <div class="pc-container">
        <div class="pc-content">
            {{-- Breadcrumb --}}
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="mb-0">Pengaturan Konfigurasi</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/dashboard-superadmin">Home</a></li>
                                <li class="breadcrumb-item" aria-current="page">Pengaturan</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Main Content --}}
            <div class="row">
                <div class="col-sm-12">
                    <form action="{{ route('manage-settings.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Card 1: POYO AI API --}}
                        <div class="card">
                            <div class="card-header">
                                <h5><i class="ti ti-sparkles me-2"></i> 1. Pengaturan Koneksi & API Key (POYO AI)</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">POYO Base URL</label>
                                        <input type="text" name="poyo_base_url" class="form-control"
                                            value="{{ $settings['poyo_base_url'] }}" required>
                                        <small class="text-muted">URL dasar endpoint POYO API. Contoh:
                                            <code>https://api.poyo.ai</code></small>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">POYO API Key</label>
                                        <input type="text" name="poyo_api_key" class="form-control"
                                            value="{{ $settings['poyo_api_key'] }}" required>
                                        <small class="text-muted">API key rahasia untuk otentikasi generasi gambar.</small>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Kualitas Gambar Default</label>
                                        <select name="default_quality" class="form-select">
                                            <option value="low"
                                                {{ $settings['default_quality'] == 'low' ? 'selected' : '' }}>Low (Cepat &
                                                Hemat)</option>
                                            <option value="medium"
                                                {{ $settings['default_quality'] == 'medium' ? 'selected' : '' }}>Medium
                                            </option>
                                            <option value="high"
                                                {{ $settings['default_quality'] == 'high' ? 'selected' : '' }}>High (Detil
                                                Tinggi)</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Kredit per Render (Gelas)</label>
                                        <input type="number" name="credits_per_generation" class="form-control"
                                            value="{{ $settings['credits_per_generation'] }}" min="0" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Card 2: AI PROMPTS --}}
                        <div class="card mt-4">
                            <div class="card-header">
                                <h5><i class="ti ti-brain me-2"></i> 2. Pengaturan Prompts Rekayasa AI</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Vision Identification Prompt</label>
                                    <textarea name="vision_prompt" class="form-control" rows="3" required>{{ $settings['vision_prompt'] }}</textarea>
                                    <small class="text-muted">Prompt Vision untuk mendeteksi nama produk utama sebelum
                                        merender studio.</small>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Secret System Prompt (Formula Latar Studio)</label>
                                    <textarea name="secret_prompt" class="form-control" rows="12" required>{{ $settings['secret_prompt'] }}</textarea>
                                    <small class="text-muted">Pastikan string <code>Please note that my current product
                                            photos are...</code> tetap dipertahankan di dalam prompt rahasia ini.</small>
                                </div>
                            </div>
                        </div>

                        {{-- Card 3: LANDING PAGE --}}
                        <div class="card mt-4">
                            <div class="card-header">
                                <h5><i class="ti ti-home me-2"></i> 3. Konten Teks Landing Page</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Hero Title Utama</label>
                                    <input type="text" name="landing_hero_title" class="form-control"
                                        value="{{ $settings['landing_hero_title'] }}" required>
                                    <small class="text-muted">Contoh: <code>Ubah Foto Produk</code></small>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Hero Subtitle / Deskripsi Utama</label>
                                    <textarea name="landing_hero_subtitle" class="form-control" rows="3" required>{{ $settings['landing_hero_subtitle'] }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Kata Geser Animasi (Hero Shifting Words)</label>
                                    <input type="text" name="landing_hero_words" class="form-control"
                                        value="{{ $settings['landing_hero_words'] }}" required>
                                    <small class="text-muted">Gunakan koma (<code>,</code>) sebagai pemisah. Contoh:
                                        <code>Berkelas.,Premium.,Menjual.,Estetik.</code></small>
                                </div>
                            </div>
                        </div>

                        {{-- Card 4: PAYMENT GATEWAY (QRIS) --}}
                        <div class="card mt-4">
                            <div class="card-header d-flex align-items-center gap-2">
                                <i class="ti ti-qrcode"></i>
                                <h5 class="mb-0">4. Konfigurasi Payment Gateway (QRIS KlikQris)</h5>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-info d-flex align-items-start gap-2 mb-4" role="alert"
                                    style="background: hsl(var(--muted)); border: 1px solid hsl(var(--border)); border-radius: var(--radius);">
                                    <i class="ti ti-info-circle mt-1 flex-shrink-0"></i>
                                    <div>
                                        <strong>Cara Penggunaan:</strong> Isi kredensial API dari dashboard
                                        <a href="https://klikqris.com" target="_blank" rel="noopener">KlikQris.com</a>.
                                        Setelah disimpan, sistem akan otomatis memproses pembayaran QRIS Dinamis saat user
                                        checkout.
                                        Pastikan <strong>Webhook URL</strong> di bawah sudah didaftarkan di pengaturan
                                        KlikQris Anda.
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">
                                            QRIS API Key
                                            <span class="badge bg-light-danger ms-1"
                                                style="font-size:0.65rem;">RAHASIA</span>
                                        </label>
                                        <div class="input-group">
                                            <input type="password" name="qris_api_key" id="qris_api_key_input"
                                                class="form-control font-monospace"
                                                value="{{ $settings['qris_api_key'] }}"
                                                placeholder="x-api-key dari KlikQris">
                                            <button class="btn btn-secondary" type="button" id="toggle-qris-key"
                                                title="Tampilkan/Sembunyikan">
                                                <i class="ti ti-eye" id="toggle-qris-icon"></i>
                                            </button>
                                        </div>
                                        <small class="text-muted">Header <code>x-api-key</code> untuk otentikasi ke API
                                            KlikQris.</small>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">QRIS Merchant ID</label>
                                        <input type="text" name="qris_merchant_id" class="form-control font-monospace"
                                            value="{{ $settings['qris_merchant_id'] }}"
                                            placeholder="id_merchant dari KlikQris">
                                        <small class="text-muted">Header <code>id_merchant</code> identitas merchant
                                            Anda.</small>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">
                                            Webhook / Callback URL
                                            <span class="badge bg-light-warning ms-1" style="font-size:0.65rem;">DAFTARKAN
                                                DI KLIKQRIS</span>
                                        </label>
                                        <div class="input-group">
                                            <input type="url" name="qris_webhook_url" id="qris_webhook_url_input"
                                                class="form-control font-monospace"
                                                value="{{ $settings['qris_webhook_url'] ?: url('/topup/webhook/qris') }}"
                                                placeholder="https://domain-anda.com/topup/webhook/qris">
                                            <button class="btn btn-secondary" type="button" id="btn-copy-webhook"
                                                title="Salin URL">
                                                <i class="ti ti-copy" id="copy-icon"></i>
                                            </button>
                                        </div>
                                        <small class="text-muted">
                                            URL ini harus didaftarkan sebagai <strong>Webhook/Callback URL</strong> di
                                            dashboard KlikQris Anda.
                                            URL harus dapat diakses dari internet publik (bukan <code>localhost</code>).
                                        </small>
                                    </div>
                                </div>

                                {{-- Status --}}
                                <div class="d-flex align-items-center gap-2 mt-2">
                                    @if ($settings['qris_api_key'] && $settings['qris_merchant_id'])
                                        <span class="badge bg-light-success d-flex align-items-center gap-1 px-3 py-2">
                                            <i class="ti ti-circle-check"></i> Payment Gateway Aktif & Terkonfigurasi
                                        </span>
                                    @else
                                        <span class="badge bg-light-secondary d-flex align-items-center gap-1 px-3 py-2">
                                            <i class="ti ti-circle-x"></i> Belum Dikonfigurasi — Sistem masih menggunakan
                                            mock checkout
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="d-flex justify-content-end mt-4 mb-5">
                            <button type="submit" class="btn btn-primary px-5">
                                <i class="ti ti-device-floppy me-1"></i> Simpan Semua Konfigurasi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.getElementById('toggle-qris-key')?.addEventListener('click', function() {
            const input = document.getElementById('qris_api_key_input');
            const icon = document.getElementById('toggle-qris-icon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.className = 'ti ti-eye-off';
            } else {
                input.type = 'password';
                icon.className = 'ti ti-eye';
            }
        });

        document.getElementById('btn-copy-webhook')?.addEventListener('click', function() {
            const val = document.getElementById('qris_webhook_url_input').value;
            navigator.clipboard.writeText(val).then(() => {
                document.getElementById('copy-icon').className = 'ti ti-check text-success';
                setTimeout(() => {
                    document.getElementById('copy-icon').className = 'ti ti-copy';
                }, 2000);
            });
        });
    </script>
@endsection
