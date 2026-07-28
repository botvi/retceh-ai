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
                                <h5 class="mb-0">API WhatsApp</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/dashboard-superadmin">Home</a></li>
                                <li class="breadcrumb-item" aria-current="page">API WhatsApp</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Main Content --}}
            <div class="row justify-content-center">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>Konfigurasi Access Token</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('whatsapp-api.storeorupdate') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Access Token</label>
                                    <input type="text" name="access_token" class="form-control"
                                        placeholder="Masukkan Access Token WhatsApp"
                                        value="{{ $whatsappApi->access_token ?? '' }}" required>
                                    <small class="text-muted">Token akses untuk mengirim notifikasi WhatsApp
                                        otomatis.</small>
                                </div>
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ti ti-device-floppy me-1"></i> Simpan
                                    </button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
