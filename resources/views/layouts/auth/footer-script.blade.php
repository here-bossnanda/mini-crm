<script src="{{ asset('storage/assets/auth/js/libscripts.bundle.js')}}"></script>
  <script src="{{ asset('storage/assets/auth/js/vendorscripts.bundle.js')}}"></script>
  <script src="{{ asset('storage/assets/auth/js/mainscripts.bundle.js')}}"></script>
  <script src="{{asset('storage/assets/auth/js/toastr/toastr.js')}}"></script>

  <script>
    $(function() {
      if ('{{session('errors')}}') {
        var audio = new Audio("storage/assets/audio/toast_sound.mp3");
        audio.play();
        toastr.options.timeOut = "10000";
        toastr.options.closeButton = true;
        toastr.options.positionClass = 'toast-top-right';
        toastr['errors']('{{ session('errors') }}');
      }
    });
  </script>