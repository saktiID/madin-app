 <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
 <script src="{{ asset('assets/js/libs/jquery-3.1.1.min.js') }}"></script>
 <script src="{{ asset('bootstrap/js/popper.min.js') }}"></script>
 <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>

 <!-- END GLOBAL MANDATORY SCRIPTS -->
 <script src="{{ asset('assets/js/authentication/form-2.js') }}"></script>

 {{-- BEGIN PLUGIN --}}
 <script src="{{ asset('feather/feather.min.js') }}"></script>
 <script>
     feather.replace();

 </script>

 @yield('script')
 {{-- END BEGIN PLUGIN --}}
