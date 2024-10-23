@includeIf('admin.admin_layout.scripts.header.custom.top') {{--Custom top header code can be added here.--}}
<link rel="stylesheet" href="{{ asset('assets/admiko/vendors/select2/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admiko/vendors/data-tables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admiko/vendors/dropzone/dropzone.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admiko/vendors/datetime-flatpickr/flatpickr.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admiko/vendors/cropperjs/cropper.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admiko/css/theme')}}/{{auth()->user()->theme}}/theme.css">
<link rel="stylesheet" href="{{ asset('assets/admiko/css/custom.css') }}"> {{--Used to add custom css.--}}
@includeIf('admin.admin_layout.scripts.header.custom.bottom') {{--Custom bottom header code can be added here.--}}
