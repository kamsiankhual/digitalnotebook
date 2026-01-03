
    <!-- Toastr Notification -->
    <script src="{{ asset('assets/libs/jquery/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/libs/toastr-master/toastr-master/build/toastr.min.js') }}"></script>

    @if(session('success'))
        <script>toastr.success("{{ session('success') }}","Success!",{timeOut:3000})</script>
    @endif
    
    @if($errors)
        @foreach($errors->all() as $error)
            <script>toastr.error("{{ $error }}","Failed!",{timeOut:3000})</script>
        @endforeach
    @endif

        <!-- update password error -->
    @if($errors->hasBag('updatePassword'))
            @foreach($errors->updatePassword->all() as $error)
                <script>toastr.error("{{ $error }}","Password Error!",{timeOut:3000})</script>
            @endforeach
    @endif

    <!-- account delete error -->
    @if($errors->hasBag('userDeletion'))
            @foreach($errors->userDeletion->all() as $error)
                <script>toastr.error("{{ $error }}","Account Error!",{timeOut:3000})</script>
            @endforeach
    @endif
</body>
</html>
