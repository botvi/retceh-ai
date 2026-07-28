<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard | retcehStudio</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="retcehStudio Admin Dashboard.">
    <meta name="author" content="CodedThemes">

    <link rel="icon" href="{{ asset('env') }}/logo.jpg" type="image/x-icon">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap">
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/fonts/tabler-icons.min.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/fonts/feather.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/fonts/fontawesome.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/fonts/material.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/css/style.css" id="main-style-link">
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/css/style-preset.css">

    <style>
        /* ═══════════════════════════════════════════════════════════
           SHADCN-INSPIRED BLACK & WHITE THEME — RESPONSIVE DESIGN
           ═══════════════════════════════════════════════════════════ */

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        :root {
            --background: 0 0% 100%;
            --foreground: 240 10% 3.9%;
            --card: 0 0% 100%;
            --card-foreground: 240 10% 3.9%;
            --popover: 0 0% 100%;
            --popover-foreground: 240 10% 3.9%;
            --primary: 240 5.9% 10%;
            --primary-foreground: 0 0% 98%;
            --secondary: 240 4.8% 95.9%;
            --secondary-foreground: 240 5.9% 10%;
            --muted: 240 4.8% 95.9%;
            --muted-foreground: 240 3.8% 46.1%;
            --accent: 240 4.8% 95.9%;
            --accent-foreground: 240 5.9% 10%;
            --destructive: 0 84.2% 60.2%;
            --destructive-foreground: 0 0% 98%;
            --border: 240 5.9% 90%;
            --input: 240 5.9% 90%;
            --ring: 240 5.9% 10%;
            --radius: 0.5rem;
        }

        body,
        html {
            background-color: hsl(var(--background)) !important;
            color: hsl(var(--foreground)) !important;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif !important;
            font-feature-settings: "cv02", "cv03", "cv04", "cv11";
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* ══════════ SIDEBAR ══════════ */
        .pc-sidebar {
            background-color: hsl(var(--primary)) !important;
            border-right: 1px solid hsl(var(--border)) !important;
            box-shadow: none !important;
            width: 260px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .pc-sidebar .navbar-wrapper {
            background: transparent !important;
        }

        .pc-sidebar .m-header {
            border-bottom: 1px solid hsl(var(--border)) !important;
            padding: 1.25rem 1.5rem !important;
        }

        .pc-sidebar .b-brand span {
            color: hsl(var(--primary-foreground)) !important;
            font-size: 1rem !important;
            font-weight: 700 !important;
            letter-spacing: -0.02em;
        }

        .pc-sidebar .pc-mtext {
            color: hsl(var(--muted-foreground)) !important;
            font-size: 0.875rem !important;
            font-weight: 500 !important;
        }

        .pc-sidebar .pc-micon i {
            color: hsl(var(--muted-foreground)) !important;
            font-size: 1.125rem;
        }

        .pc-sidebar .pc-caption label {
            color: hsl(var(--muted-foreground)) !important;
            font-size: 0.75rem !important;
            font-weight: 600 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.05em !important;
            padding: 0.5rem 1rem;
        }

        .pc-sidebar .pc-caption {
            border-top: 1px solid hsl(var(--border)) !important;
        }

        .pc-sidebar .pc-item .pc-link {
            padding: 0.625rem 1rem !important;
            margin: 0.125rem 0.5rem !important;
            border-radius: var(--radius) !important;
            transition: all 0.15s ease !important;
        }

        .pc-sidebar .pc-item:hover>.pc-link {
            background-color: hsl(var(--accent)) !important;
        }

        .pc-sidebar .pc-item:hover .pc-mtext,
        .pc-sidebar .pc-item:hover .pc-micon i {
            color: hsl(var(--accent-foreground)) !important;
        }

        .pc-sidebar .pc-item.active>.pc-link {
            background-color: hsl(var(--secondary)) !important;
        }

        .pc-sidebar .pc-item.active .pc-mtext,
        .pc-sidebar .pc-item.active .pc-micon i {
            color: hsl(var(--accent-foreground)) !important;
            font-weight: 600 !important;
        }

        /* Mobile sidebar */
        @media (max-width: 1024px) {
            .pc-sidebar {
                transform: translateX(-260px);
            }

            .pc-sidebar.mob-sidebar-active {
                transform: translateX(0);
            }
        }

        /* ══════════ HEADER ══════════ */
        .pc-header {
            background-color: hsl(var(--background)) !important;
            border-bottom: 1px solid hsl(var(--border)) !important;
            box-shadow: none !important;
            padding: 0 1.5rem;
            height: 64px;
        }

        .pc-header a,
        .pc-header i,
        .pc-header span {
            color: hsl(var(--foreground)) !important;
        }

        .pc-header .dropdown-menu {
            background-color: hsl(var(--popover)) !important;
            border: 1px solid hsl(var(--border)) !important;
            border-radius: var(--radius) !important;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1) !important;
            padding: 0.5rem;
        }

        .pc-header .dropdown-item {
            color: hsl(var(--foreground)) !important;
            border-radius: calc(var(--radius) - 2px) !important;
            padding: 0.5rem 0.75rem !important;
            font-size: 0.875rem !important;
            margin: 2px 0;
        }

        .pc-header .dropdown-item:hover {
            background-color: hsl(var(--accent)) !important;
            color: hsl(var(--accent-foreground)) !important;
        }

        .pc-header .header-user-profile {
            background: transparent !important;
            border: none !important;
        }

        .user-avtar {
            width: 36px !important;
            height: 36px !important;
            object-fit: cover !important;
            border-radius: 9999px !important;
            border: 2px solid hsl(var(--border)) !important;
        }

        @media (max-width: 640px) {
            .pc-header {
                padding: 0 1rem;
            }
        }

        /* ══════════ MAIN CONTENT ══════════ */
        .pc-container {
            background-color: hsl(var(--background)) !important;
            min-height: calc(100vh - 64px) !important;
            margin-left: 260px;
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .pc-content {
            padding: 1.5rem !important;
            max-width: 1400px;
            margin: 0 auto;
        }

        @media (max-width: 1024px) {
            .pc-container {
                margin-left: 0 !important;
            }
        }

        @media (max-width: 640px) {
            .pc-content {
                padding: 1rem !important;
            }
        }

        /* ══════════ BREADCRUMB ══════════ */
        .page-header {
            margin-bottom: 1.5rem !important;
        }

        .page-header-title h5 {
            color: hsl(var(--foreground)) !important;
            font-weight: 700 !important;
            font-size: 1.5rem !important;
            letter-spacing: -0.02em;
            margin-bottom: 0.25rem;
        }

        .breadcrumb {
            background-color: transparent !important;
            padding: 0 !important;
            font-size: 0.875rem;
        }

        .breadcrumb-item a {
            color: hsl(var(--muted-foreground)) !important;
            text-decoration: none !important;
            transition: color 0.15s ease;
        }

        .breadcrumb-item a:hover {
            color: hsl(var(--foreground)) !important;
        }

        .breadcrumb-item.active {
            color: hsl(var(--foreground)) !important;
        }

        .breadcrumb-item+.breadcrumb-item::before {
            color: hsl(var(--muted-foreground)) !important;
        }

        @media (max-width: 640px) {
            .page-header-title h5 {
                font-size: 1.25rem !important;
            }
        }

        /* ══════════ CARDS ══════════ */
        .card {
            background-color: hsl(var(--card)) !important;
            border: 1px solid hsl(var(--border)) !important;
            border-radius: var(--radius) !important;
            box-shadow: none !important;
            color: hsl(var(--card-foreground)) !important;
            transition: all 0.2s ease !important;
        }

        .card:hover {
            box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1) !important;
        }

        .card-header {
            background-color: transparent !important;
            border-bottom: 1px solid hsl(var(--border)) !important;
            padding: 1rem 1.5rem !important;
        }

        .card-header h5 {
            color: hsl(var(--foreground)) !important;
            font-weight: 600 !important;
            font-size: 1rem !important;
            letter-spacing: -0.01em;
        }

        .card-body {
            padding: 1.5rem !important;
        }

        .card-footer {
            background-color: transparent !important;
            border-top: 1px solid hsl(var(--border)) !important;
            padding: 1rem 1.5rem !important;
        }

        @media (max-width: 640px) {

            .card-header,
            .card-body,
            .card-footer {
                padding-left: 1rem !important;
                padding-right: 1rem !important;
            }
        }

        /* ══════════ TABLES ══════════ */
        .table {
            color: hsl(var(--foreground)) !important;
            border-color: hsl(var(--border)) !important;
        }

        .table thead th {
            background-color: hsl(var(--muted)) !important;
            color: hsl(var(--muted-foreground)) !important;
            border-bottom: 1px solid hsl(var(--border)) !important;
            font-weight: 600 !important;
            font-size: 0.75rem !important;
            text-transform: uppercase !important;
            letter-spacing: 0.05em !important;
            padding: 0.75rem 1rem !important;
        }

        .table tbody td {
            background-color: transparent !important;
            color: hsl(var(--foreground)) !important;
            border-bottom: 1px solid hsl(var(--border)) !important;
            font-size: 0.875rem !important;
            padding: 1rem !important;
        }

        .table-hover tbody tr:hover td {
            background-color: hsl(var(--muted) / 0.5) !important;
        }

        .table-striped tbody tr:nth-of-type(odd) td {
            background-color: hsl(var(--muted) / 0.3) !important;
        }

        /* Responsive table */
        @media (max-width: 768px) {
            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .table thead th,
            .table tbody td {
                padding: 0.5rem !important;
                font-size: 0.813rem !important;
            }
        }

        /* ══════════ DATATABLES ══════════ */
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            color: hsl(var(--muted-foreground)) !important;
            font-size: 0.875rem !important;
        }

        .dataTables_wrapper .dataTables_filter input {
            background-color: hsl(var(--background)) !important;
            border: 1px solid hsl(var(--input)) !important;
            color: hsl(var(--foreground)) !important;
            border-radius: var(--radius) !important;
            padding: 0.5rem 0.75rem !important;
        }

        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: hsl(var(--ring)) !important;
            outline: none !important;
            box-shadow: 0 0 0 2px hsl(var(--ring) / 0.2) !important;
        }

        .dataTables_wrapper .dataTables_length select {
            background-color: hsl(var(--background)) !important;
            border: 1px solid hsl(var(--input)) !important;
            border-radius: var(--radius) !important;
            padding: 0.375rem 0.75rem !important;
        }

        /* ══════════ PAGINATION ══════════ */
        .page-item.disabled .page-link {
            background-color: hsl(var(--muted)) !important;
            border-color: hsl(var(--border)) !important;
            color: hsl(var(--muted-foreground)) !important;
        }

        .page-link {
            background-color: hsl(var(--background)) !important;
            border: 1px solid hsl(var(--border)) !important;
            color: hsl(var(--foreground)) !important;
            border-radius: var(--radius) !important;
            margin: 0 2px !important;
            font-size: 0.875rem !important;
            font-weight: 500 !important;
            padding: 0.5rem 0.75rem;
        }

        .page-link:hover {
            background-color: hsl(var(--accent)) !important;
            color: hsl(var(--accent-foreground)) !important;
            border-color: hsl(var(--border)) !important;
        }

        .page-item.active .page-link {
            background-color: hsl(var(--primary)) !important;
            border-color: hsl(var(--primary)) !important;
            color: hsl(var(--primary-foreground)) !important;
        }

        /* ══════════ FORM CONTROLS ══════════ */
        .form-control,
        .form-select,
        select,
        textarea {
            background-color: hsl(var(--background)) !important;
            border: 1px solid hsl(var(--input)) !important;
            color: hsl(var(--foreground)) !important;
            border-radius: var(--radius) !important;
            padding: 0.5rem 0.75rem !important;
            font-size: 0.875rem !important;
            transition: all 0.15s ease !important;
        }

        .form-control:focus,
        .form-select:focus,
        select:focus,
        textarea:focus {
            border-color: hsl(var(--ring)) !important;
            box-shadow: 0 0 0 2px hsl(var(--ring) / 0.2) !important;
            outline: none !important;
        }

        .form-label,
        label {
            color: hsl(var(--foreground)) !important;
            font-weight: 500 !important;
            font-size: 0.875rem !important;
            margin-bottom: 0.5rem !important;
        }

        .text-muted,
        .text-muted * {
            color: hsl(var(--muted-foreground)) !important;
        }

        /* ══════════ BUTTONS ══════════ */
        .btn {
            border-radius: var(--radius) !important;
            font-weight: 500 !important;
            font-size: 0.875rem !important;
            padding: 0.5rem 1rem !important;
            transition: all 0.15s ease !important;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background-color: hsl(var(--primary)) !important;
            border: 1px solid hsl(var(--primary)) !important;
            color: hsl(var(--primary-foreground)) !important;
        }

        .btn-primary:hover {
            background-color: hsl(var(--primary) / 0.9) !important;
            color: hsl(var(--primary-foreground)) !important;
        }

        .btn-secondary {
            background-color: hsl(var(--secondary)) !important;
            border: 1px solid hsl(var(--border)) !important;
            color: hsl(var(--secondary-foreground)) !important;
        }

        .btn-secondary:hover {
            background-color: hsl(var(--secondary) / 0.8) !important;
            color: hsl(var(--secondary-foreground)) !important;
        }

        .btn-outline-primary {
            background-color: transparent !important;
            border: 1px solid hsl(var(--input)) !important;
            color: hsl(var(--foreground)) !important;
        }

        .btn-outline-primary:hover {
            background-color: hsl(var(--accent)) !important;
            color: hsl(var(--accent-foreground)) !important;
        }

        .btn-danger {
            background-color: hsl(var(--destructive)) !important;
            border: 1px solid hsl(var(--destructive)) !important;
            color: hsl(var(--destructive-foreground)) !important;
        }

        .btn-danger:hover {
            background-color: hsl(var(--destructive) / 0.9) !important;
            color: hsl(var(--destructive-foreground)) !important;
        }

        .btn-outline-danger {
            background-color: transparent !important;
            border: 1px solid hsl(var(--destructive)) !important;
            color: hsl(var(--destructive)) !important;
        }

        .btn-outline-danger:hover {
            background-color: hsl(var(--destructive)) !important;
            color: hsl(var(--destructive-foreground)) !important;
        }

        .btn-success {
            background-color: #22c55e !important;
            border: 1px solid #22c55e !important;
            color: white !important;
        }

        .btn-success:hover {
            background-color: #16a34a !important;
            color: white !important;
        }

        .btn-warning {
            background-color: #f59e0b !important;
            border: 1px solid #f59e0b !important;
            color: white !important;
        }

        .btn-warning:hover {
            background-color: #d97706 !important;
            color: white !important;
        }

        .btn-info {
            background-color: #3b82f6 !important;
            border: 1px solid #3b82f6 !important;
            color: white !important;
        }

        .btn-info:hover {
            background-color: #2563eb !important;
            color: white !important;
        }

        .btn-sm {
            padding: 0.375rem 0.75rem !important;
            font-size: 0.813rem !important;
        }

        @media (max-width: 640px) {
            .btn {
                padding: 0.5rem 0.875rem !important;
                font-size: 0.813rem !important;
            }
        }

        /* ══════════ BADGES ══════════ */
        .badge {
            font-weight: 500 !important;
            font-size: 0.75rem !important;
            padding: 0.25rem 0.625rem !important;
            border-radius: 9999px !important;
            display: inline-flex;
            align-items: center;
        }

        .bg-light-primary {
            background-color: hsl(var(--muted)) !important;
            color: hsl(var(--foreground)) !important;
            border: 1px solid hsl(var(--border)) !important;
        }

        .bg-light-success {
            background-color: rgba(34, 197, 94, 0.1) !important;
            color: #16a34a !important;
            border: 1px solid rgba(34, 197, 94, 0.2) !important;
        }

        .bg-light-warning {
            background-color: rgba(245, 158, 11, 0.1) !important;
            color: #d97706 !important;
            border: 1px solid rgba(245, 158, 11, 0.2) !important;
        }

        .bg-light-danger {
            background-color: rgba(239, 68, 68, 0.1) !important;
            color: #dc2626 !important;
            border: 1px solid rgba(239, 68, 68, 0.2) !important;
        }

        .bg-light-secondary {
            background-color: hsl(var(--muted)) !important;
            color: hsl(var(--muted-foreground)) !important;
        }

        /* ══════════ MODAL ══════════ */
        .modal-content {
            background-color: hsl(var(--card)) !important;
            border: 1px solid hsl(var(--border)) !important;
            border-radius: var(--radius) !important;
            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1) !important;
        }

        .modal-header {
            border-bottom: 1px solid hsl(var(--border)) !important;
            padding: 1rem 1.5rem !important;
        }

        .modal-footer {
            border-top: 1px solid hsl(var(--border)) !important;
            padding: 1rem 1.5rem !important;
        }

        .modal-title {
            color: hsl(var(--foreground)) !important;
            font-weight: 600 !important;
        }

        /* ══════════ FOOTER ══════════ */
        .pc-footer {
            background-color: hsl(var(--background)) !important;
            border-top: 1px solid hsl(var(--border)) !important;
            color: hsl(var(--muted-foreground)) !important;
            padding: 1rem !important;
            margin-left: 260px !important;
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @media (max-width: 1024px) {
            .pc-footer {
                margin-left: 0 !important;
            }
        }

        .pc-footer a {
            color: hsl(var(--muted-foreground)) !important;
            text-decoration: none !important;
        }

        .pc-footer a:hover {
            color: hsl(var(--foreground)) !important;
        }

        /* ══════════ SCROLLBAR ══════════ */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: hsl(var(--muted));
        }

        ::-webkit-scrollbar-thumb {
            background: hsl(var(--muted-foreground) / 0.3);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: hsl(var(--muted-foreground) / 0.5);
        }

        /* ══════════ UTILITIES ══════════ */
        .fw-500 {
            font-weight: 500 !important;
        }

        .fw-600 {
            font-weight: 600 !important;
        }

        .fw-700 {
            font-weight: 700 !important;
        }

        .fw-800 {
            font-weight: 800 !important;
        }

        .text-xs {
            font-size: 0.75rem !important;
        }

        .text-sm {
            font-size: 0.875rem !important;
        }

        .text-base {
            font-size: 1rem !important;
        }

        .text-lg {
            font-size: 1.125rem !important;
        }

        .text-xl {
            font-size: 1.25rem !important;
        }

        /* Responsive grid adjustments */
        @media (max-width: 768px) {
            .row.g-3 {
                gap: 0.75rem !important;
            }
        }

        /* Preloader */
        .loader-bg {
            background: hsl(var(--background)) !important;
        }

        .loader-fill {
            background: hsl(var(--primary)) !important;
        }
    </style>
    @yield('style')
</head>

<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->


    <!-- [ Sidebar Menu ] start -->
    @include('template-admin.navbar')
    <!-- [ Sidebar Menu ] end -->

    <!-- [ Header Topbar ] start -->
    @include('template-admin.header')
    <!-- [ Header ] end -->

    <!-- [ Main Content ] start -->
    @yield('content')
    <!-- [ Main Content ] end -->

    <footer class="pc-footer">
        <div class="footer-wrapper container-fluid">
            <div class="row">
                <div class="col-sm my-1">
                    <p class="m-0">retcehStudio <i class="ti ti-heart-filled text-danger ms-1"></i></p>
                </div>
                <div class="col-auto my-1">
                    <ul class="list-inline footer-link mb-0">
                        <li class="list-inline-item"><a href="/dashboard-superadmin">Home</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- Required Js -->
    <script src="{{ asset('admin') }}/assets/js/plugins/popper.min.js"></script>
    <script src="{{ asset('admin') }}/assets/js/plugins/simplebar.min.js"></script>
    <script src="{{ asset('admin') }}/assets/js/plugins/bootstrap.min.js"></script>
    <script src="{{ asset('admin') }}/assets/js/fonts/custom-font.js"></script>
    <script src="{{ asset('admin') }}/assets/js/pcoded.js"></script>
    <script src="{{ asset('admin') }}/assets/js/plugins/feather.min.js"></script>
    <script src="{{ asset('admin') }}/assets/js/plugins/apexcharts.min.js"></script>

    @yield('script')

    <script>
        layout_change('light');
        change_box_container('false');
        layout_rtl_change('false');
        preset_change("preset-1");
    </script>

    <!-- datatable Js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('admin') }}/assets/js/plugins/jquery.dataTables.min.js"></script>
    <script src="{{ asset('admin') }}/assets/js/plugins/dataTables.bootstrap5.min.js"></script>
    <script>
        $('#simpletable').DataTable();
        $('#order-table').DataTable({
            order: [
                [3, 'desc']
            ]
        });
        $('#multi-colum-dt').DataTable({
            columnDefs: [{
                    targets: [0],
                    orderData: [0, 1]
                },
                {
                    targets: [1],
                    orderData: [1, 0]
                },
                {
                    targets: [4],
                    orderData: [4, 0]
                }
            ]
        });
        $('#complex-dt').DataTable();
        $('#DOM-dt').DataTable({
            dom: '<"top"i>rt<"bottom"flp><"clear">'
        });
        $('#alt-pg-dt').DataTable({
            pagingType: 'full_numbers'
        });
        $('#scr-vrt-dt').DataTable({
            scrollY: '200px',
            scrollCollapse: true,
            paging: false
        });
        $('#scr-vtr-dynamic').DataTable({
            scrollY: '50vh',
            scrollCollapse: true,
            paging: false
        });
        $('#lang-dt').DataTable({
            language: {
                decimal: ',',
                thousands: '.'
            }
        });
    </script>

    @include('components.custom-alert')
</body>

</html>
