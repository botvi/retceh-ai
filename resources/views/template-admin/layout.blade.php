<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
    <title>Dashboard | retcehStudio</title>
    <!-- [Meta] -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description"
        content="retcehStudio Admin Dashboard.">
    <meta name="author" content="CodedThemes">

    <!-- [Favicon] icon -->
    <link rel="icon" href="{{ asset('env') }}/logo.jpg" type="image/x-icon">
    <!-- [Google Font] Family -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
        id="main-font-link">
    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/fonts/tabler-icons.min.css">
    <!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/fonts/feather.css">
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/fonts/fontawesome.css">
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/fonts/material.css">
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/css/style.css" id="main-style-link">
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/css/style-preset.css">

    <style>
        /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
           PREMIUM ADMIN STYLESHEET — retcehStudio
           ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */

        *, *::before, *::after { box-sizing: border-box; }

        body, html {
            background-color: #f5f6fa !important;
            color: #1a1a2e !important;
            font-family: 'Inter', 'Public Sans', sans-serif !important;
        }

        /* ── Sidebar ──────────────────────────────── */
        .pc-sidebar {
            background: linear-gradient(180deg, #1a1a2e 0%, #16213e 60%, #0f3460 100%) !important;
            border-right: none !important;
            box-shadow: 4px 0 24px rgba(0,0,0,0.18) !important;
        }
        .pc-sidebar .navbar-wrapper {
            background: transparent !important;
        }
        .pc-sidebar .m-header {
            border-bottom: 1px solid rgba(255,255,255,0.08) !important;
            padding: 18px 20px !important;
        }
        .pc-sidebar .b-brand span {
            color: #ffffff !important;
            font-size: 1rem !important;
            font-weight: 800 !important;
        }
        .pc-sidebar .pc-mtext {
            color: rgba(255,255,255,0.65) !important;
            font-size: 0.83rem !important;
            font-weight: 500 !important;
        }
        .pc-sidebar .pc-micon i {
            color: rgba(255,255,255,0.5) !important;
        }
        .pc-sidebar .pc-caption label {
            color: rgba(255,255,255,0.35) !important;
            font-size: 0.65rem !important;
            font-weight: 700 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.1em !important;
        }
        .pc-sidebar .pc-caption {
            border-top-color: rgba(255,255,255,0.08) !important;
        }
        .pc-sidebar .pc-item:hover > .pc-link,
        .pc-sidebar .pc-item.pc-trigger > .pc-link {
            background: rgba(255,255,255,0.08) !important;
            border-radius: 10px !important;
            margin: 0 10px !important;
        }
        .pc-sidebar .pc-item:hover .pc-mtext,
        .pc-sidebar .pc-item:hover .pc-micon i {
            color: #ffffff !important;
        }
        .pc-sidebar .pc-item.active > .pc-link {
            background: linear-gradient(135deg, #667eea, #764ba2) !important;
            border-radius: 10px !important;
            margin: 0 10px !important;
            box-shadow: 0 4px 15px rgba(102,126,234,0.4) !important;
        }
        .pc-sidebar .pc-item.active .pc-mtext,
        .pc-sidebar .pc-item.active .pc-micon i {
            color: #ffffff !important;
        }

        /* ── Header ───────────────────────────────── */
        .pc-header {
            background: rgba(255,255,255,0.88) !important;
            backdrop-filter: blur(16px) saturate(180%) !important;
            -webkit-backdrop-filter: blur(16px) saturate(180%) !important;
            border-bottom: 1px solid rgba(0,0,0,0.07) !important;
            box-shadow: 0 2px 20px rgba(0,0,0,0.06) !important;
        }
        .pc-header a, .pc-header i, .pc-header span, .pc-header h5 {
            color: #1a1a2e !important;
        }
        .pc-header .dropdown-menu {
            background-color: #ffffff !important;
            border: 1px solid #e8e8ef !important;
            border-radius: 14px !important;
            box-shadow: 0 12px 40px rgba(0,0,0,0.12) !important;
        }
        .pc-header .dropdown-item {
            color: #52525b !important;
            border-radius: 8px !important;
            margin: 2px 8px !important;
            width: calc(100% - 16px) !important;
            font-size: 0.83rem !important;
        }
        .pc-header .dropdown-item:hover {
            background: rgba(102,126,234,0.08) !important;
            color: #667eea !important;
        }
        .pc-header .header-user-profile {
            background: transparent !important;
            border: none !important;
            box-shadow: none !important;
        }
        .pc-header .header-user-profile span {
            color: #1a1a2e !important;
            font-weight: 600 !important;
        }
        .user-avtar {
            width: 36px !important;
            height: 36px !important;
            object-fit: cover !important;
            border-radius: 50% !important;
            border: 2px solid rgba(102,126,234,0.4) !important;
            flex-shrink: 0 !important;
        }

        /* ── Main Workspace ───────────────────────── */
        .pc-container {
            background-color: #f5f6fa !important;
            min-height: calc(100vh - 70px) !important;
        }
        .pc-content {
            background-color: #f5f6fa !important;
            padding: 1.5rem !important;
        }

        /* ── Breadcrumb ───────────────────────────── */
        .page-header { margin-bottom: 1.5rem !important; }
        .page-header-title h5 {
            color: #1a1a2e !important;
            font-weight: 800 !important;
            font-size: 1.25rem !important;
        }
        .page-header-title h2 { color: #1a1a2e !important; font-weight: 800 !important; }
        .breadcrumb { background-color: transparent !important; padding: 0 !important; }
        .breadcrumb-item a {
            color: #667eea !important;
            text-decoration: none !important;
            font-size: 0.8rem !important;
        }
        .breadcrumb-item a:hover { opacity: 0.8 !important; }
        .breadcrumb-item.active { color: #52525b !important; font-size: 0.8rem !important; }
        .breadcrumb-item + .breadcrumb-item::before { color: #a1a1aa !important; }

        /* ── Cards ────────────────────────────────── */
        .card {
            background-color: #ffffff !important;
            border: 1px solid #eaeaf0 !important;
            border-radius: 16px !important;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04) !important;
            color: #1a1a2e !important;
            transition: box-shadow 0.2s ease !important;
        }
        .card:hover { box-shadow: 0 4px 20px rgba(0,0,0,0.08) !important; }
        .card-header {
            background-color: transparent !important;
            border-bottom: 1px solid #f0f0f7 !important;
            padding: 1.1rem 1.5rem !important;
        }
        .card-header h5 {
            color: #1a1a2e !important;
            font-weight: 700 !important;
            font-size: 0.95rem !important;
        }
        .card-footer {
            background-color: transparent !important;
            border-top: 1px solid #f0f0f7 !important;
            padding: 0.85rem 1.5rem !important;
        }

        /* ── Tables ───────────────────────────────── */
        .table { color: #27272a !important; border-color: #eaeaf0 !important; }
        .table thead th {
            background-color: #f8f8fc !important;
            color: #52525b !important;
            border-bottom: 2px solid #eaeaf0 !important;
            font-weight: 700 !important;
            font-size: 0.71rem !important;
            text-transform: uppercase !important;
            letter-spacing: 0.07em !important;
            padding: 12px 16px !important;
        }
        .table tbody td {
            background-color: #ffffff !important;
            color: #27272a !important;
            border-bottom: 1px solid #f3f3f8 !important;
            font-size: 0.85rem !important;
            vertical-align: middle !important;
            padding: 12px 16px !important;
        }
        .table-hover tbody tr:hover td { background-color: #f8f8ff !important; }
        .table-striped tbody tr:nth-of-type(odd) td { background-color: #fafafd !important; }
        .table-bordered, .table-bordered th, .table-bordered td { border: 1px solid #eaeaf0 !important; }

        /* ── DataTables ───────────────────────────── */
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_processing,
        .dataTables_wrapper .dataTables_paginate { color: #71717a !important; font-size: 0.82rem !important; }
        .dataTables_wrapper .dataTables_filter input {
            background-color: #fff !important;
            border: 1.5px solid #e4e4e7 !important;
            color: #1a1a2e !important;
            border-radius: 10px !important;
            padding: 6px 12px !important;
        }
        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #667eea !important;
            box-shadow: 0 0 0 3px rgba(102,126,234,0.1) !important;
            outline: none !important;
        }
        .dataTables_wrapper .dataTables_length select {
            background-color: #fff !important;
            border: 1.5px solid #e4e4e7 !important;
            border-radius: 8px !important;
            padding: 4px 8px !important;
        }

        /* ── Pagination ───────────────────────────── */
        .page-item.disabled .page-link {
            background-color: #fafafd !important;
            border-color: #eaeaf0 !important;
            color: #c4c4cc !important;
        }
        .page-link {
            background-color: #fff !important;
            border-color: #eaeaf0 !important;
            color: #52525b !important;
            border-radius: 8px !important;
            margin: 0 2px !important;
            font-size: 0.82rem !important;
            font-weight: 600 !important;
        }
        .page-link:hover {
            background-color: #f5f6fa !important;
            color: #667eea !important;
            border-color: #667eea !important;
        }
        .page-item.active .page-link {
            background: linear-gradient(135deg, #667eea, #764ba2) !important;
            border-color: #667eea !important;
            color: #ffffff !important;
            box-shadow: 0 4px 12px rgba(102,126,234,0.35) !important;
        }

        /* ── Form Controls ────────────────────────── */
        .form-control, .form-select, select, textarea {
            background-color: #fff !important;
            border: 1.5px solid #e4e4e7 !important;
            color: #1a1a2e !important;
            border-radius: 10px !important;
            padding: 10px 14px !important;
            font-size: 0.85rem !important;
            transition: border-color 0.2s, box-shadow 0.2s !important;
        }
        .form-control:focus, .form-select:focus, select:focus, textarea:focus {
            border-color: #667eea !important;
            box-shadow: 0 0 0 3px rgba(102,126,234,0.12) !important;
            color: #1a1a2e !important;
        }
        .form-label, label {
            color: #1a1a2e !important;
            font-weight: 600 !important;
            font-size: 0.8rem !important;
            letter-spacing: 0.02em !important;
            margin-bottom: 6px !important;
        }
        .text-muted, .text-muted * { color: #71717a !important; }

        /* ── Buttons ──────────────────────────────── */
        .btn {
            border-radius: 10px !important;
            font-weight: 600 !important;
            font-size: 0.82rem !important;
            padding: 9px 18px !important;
            transition: all 0.2s ease !important;
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea, #764ba2) !important;
            border: none !important;
            color: #fff !important;
            box-shadow: 0 4px 15px rgba(102,126,234,0.35) !important;
        }
        .btn-primary:hover, .btn-primary:focus {
            background: linear-gradient(135deg, #5a6fd8, #6a3f96) !important;
            box-shadow: 0 6px 20px rgba(102,126,234,0.45) !important;
            transform: translateY(-1px) !important;
            color: #fff !important;
        }
        .btn-secondary {
            background-color: #fff !important;
            border: 1.5px solid #e4e4e7 !important;
            color: #52525b !important;
        }
        .btn-secondary:hover {
            background-color: #f5f6fa !important;
            border-color: #667eea !important;
            color: #667eea !important;
        }
        .btn-warning {
            background-color: #f59e0b !important;
            border: none !important;
            color: #fff !important;
            box-shadow: 0 4px 12px rgba(245,158,11,0.3) !important;
        }
        .btn-warning:hover { background-color: #d97706 !important; transform: translateY(-1px) !important; color: #fff !important; }
        .btn-danger {
            background-color: #ef4444 !important;
            border: none !important;
            color: #fff !important;
            box-shadow: 0 4px 12px rgba(239,68,68,0.3) !important;
        }
        .btn-danger:hover { background-color: #dc2626 !important; transform: translateY(-1px) !important; color: #fff !important; }
        .btn-success {
            background-color: #22c55e !important;
            border: none !important;
            color: #fff !important;
            box-shadow: 0 4px 12px rgba(34,197,94,0.3) !important;
        }
        .btn-success:hover { background-color: #16a34a !important; transform: translateY(-1px) !important; color: #fff !important; }
        .btn-info {
            background-color: #3b82f6 !important;
            border: none !important;
            color: #fff !important;
        }
        .btn-info:hover { background-color: #2563eb !important; color: #fff !important; }
        .btn-outline-primary {
            border: 1.5px solid #667eea !important;
            color: #667eea !important;
            background: transparent !important;
        }
        .btn-outline-primary:hover {
            background: linear-gradient(135deg, #667eea, #764ba2) !important;
            color: #fff !important;
        }
        .btn-outline-danger {
            border: 1.5px solid #ef4444 !important;
            color: #ef4444 !important;
            background: transparent !important;
        }
        .btn-outline-danger:hover { background: #ef4444 !important; color: #fff !important; }

        /* ── Badges ───────────────────────────────── */
        .badge {
            font-weight: 700 !important;
            font-size: 0.7rem !important;
            padding: 4px 10px !important;
            border-radius: 999px !important;
        }
        .bg-light-primary {
            background: rgba(102,126,234,0.1) !important;
            color: #667eea !important;
            border: 1px solid rgba(102,126,234,0.2) !important;
        }
        .bg-light-success {
            background-color: rgba(34,197,94,0.1) !important;
            color: #16a34a !important;
            border: 1px solid rgba(34,197,94,0.2) !important;
        }
        .bg-light-warning {
            background-color: rgba(245,158,11,0.1) !important;
            color: #d97706 !important;
            border: 1px solid rgba(245,158,11,0.2) !important;
        }
        .bg-light-danger {
            background-color: rgba(239,68,68,0.1) !important;
            color: #dc2626 !important;
            border: 1px solid rgba(239,68,68,0.2) !important;
        }
        .bg-light-secondary {
            background-color: rgba(82,82,91,0.08) !important;
            color: #71717a !important;
            border: 1px solid rgba(82,82,91,0.15) !important;
        }

        /* ── Modal ────────────────────────────────── */
        .modal-content {
            background-color: #fff !important;
            border: 1px solid #eaeaf0 !important;
            border-radius: 18px !important;
            box-shadow: 0 25px 50px rgba(0,0,0,0.15) !important;
        }
        .modal-header { border-bottom: 1px solid #f0f0f7 !important; padding: 1.25rem 1.5rem !important; }
        .modal-footer { border-top: 1px solid #f0f0f7 !important; }
        .modal-title { color: #1a1a2e !important; font-weight: 800 !important; }
        .btn-close { filter: none !important; }

        /* ── Footer ───────────────────────────────── */
        .pc-footer {
            background-color: #fff !important;
            border-top: 1px solid #eaeaf0 !important;
            color: #71717a !important;
            padding: 15px 0 !important;
            margin-left: 260px !important;
        }
        @media (max-width: 1024px) { .pc-footer { margin-left: 0 !important; } }
        .pc-footer a { color: #71717a !important; text-decoration: none !important; }
        .pc-footer a:hover { color: #667eea !important; }

        /* ── Preloader ────────────────────────────── */
        .loader-bg { background: #ffffff !important; }
        .loader-fill { background: linear-gradient(135deg, #667eea, #764ba2) !important; }

        /* ── Scrollbar ────────────────────────────── */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #f5f6fa; }
        ::-webkit-scrollbar-thumb { background: #c4c4cc; border-radius: 99px; }
        ::-webkit-scrollbar-thumb:hover { background: #667eea; }

        /* ── Utils ────────────────────────────────── */
        .fw-600 { font-weight: 600 !important; }
        .fw-700 { font-weight: 700 !important; }
        .fw-800 { font-weight: 800 !important; }
        .pc-sidebar .b-brand .font-weight-black { color: #ffffff !important; }
    </style>@yield('style')

</head>
<!-- [Head] end -->
<!-- [Body] Start -->

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
	
	
    <!-- [ Sidebar Menu ] end --> <!-- [ Header Topbar ] start -->
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
    <!--end switcher-->

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
    </script>




    <script>
        change_box_container('false');
    </script>



    <script>
        layout_rtl_change('false');
    </script>


    <script>
        preset_change("preset-1");
    </script>


    <script>
        font_change("Public-Sans");
    </script>

 <!-- [Page Specific JS] start -->
    <!-- datatable Js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('admin') }}/assets/js/plugins/jquery.dataTables.min.js"></script>
    <script src="{{ asset('admin') }}/assets/js/plugins/dataTables.bootstrap5.min.js"></script>
    <script>
      // [ Zero Configuration ] start
      $('#simpletable').DataTable();

      // [ Default Ordering ] start
      $('#order-table').DataTable({
        order: [[3, 'desc']]
      });

      // [ Multi-Column Ordering ]
      $('#multi-colum-dt').DataTable({
        columnDefs: [
          {
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

      // [ Complex Headers ]
      $('#complex-dt').DataTable();

      // [ DOM Positioning ]
      $('#DOM-dt').DataTable({
        dom: '<"top"i>rt<"bottom"flp><"clear">'
      });

      // [ Alternative Pagination ]
      $('#alt-pg-dt').DataTable({
        pagingType: 'full_numbers'
      });

      // [ Scroll - Vertical ]
      $('#scr-vrt-dt').DataTable({
        scrollY: '200px',
        scrollCollapse: true,
        paging: false
      });

      // [ Scroll - Vertical, Dynamic Height ]
      $('#scr-vtr-dynamic').DataTable({
        scrollY: '50vh',
        scrollCollapse: true,
        paging: false
      });

      // [ Language - Comma Decimal Place ]
      $('#lang-dt').DataTable({
        language: {
          decimal: ',',
          thousands: '.'
        }
      });
    </script>
    @include('components.custom-alert')
</body>
<!-- [Body] end -->

</html>
