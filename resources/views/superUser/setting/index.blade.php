@extends('layouts.main')

@section('main')
    <div class="custom-container">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Update Account</h3>
            </div>
            <form action="{{ asset('/super-user/setting/akun/'.$SuperUser->id) }}" method="POST">
                @csrf

                <div class="card-body">
                      @if (session()->has('error'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                @if (session()->has('success'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('success') }}
                                    </div>
                                @endif
                    <div class="form-group">
                        <label for="exampleInputUsername">Username</label>
                        <input type="text" class="form-control" id="exampleInputUsername" placeholder="username" value="{{ $SuperUser->userid }}" name="username">
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" placeholder="Password"
                                name="password">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="confirmPassword">Confirm Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                                placeholder="Confirm Password">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <script>
                        var togglePassword = document.getElementById("togglePassword");
                        var toggleConfirmPassword = document.getElementById("toggleConfirmPassword");
                        var passwordInput = document.getElementById("password");
                        var confirmPasswordInput = document.getElementById("confirmPassword");

                        togglePassword.addEventListener("click", function() {
                            var type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
                            passwordInput.setAttribute("type", type);
                            this.querySelector("i").classList.toggle("fa-eye");
                            this.querySelector("i").classList.toggle("fa-eye-slash");
                        });

                        toggleConfirmPassword.addEventListener("click", function() {
                            var type = confirmPasswordInput.getAttribute("type") === "password" ? "text" : "password";
                            confirmPasswordInput.setAttribute("type", type);
                            this.querySelector("i").classList.toggle("fa-eye");
                            this.querySelector("i").classList.toggle("fa-eye-slash");
                        });
                    </script>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>

    </div>

    <script>
        const passwordInput = document.getElementById('exampleInputPassword1');
        const confirmPasswordInput = document.getElementById('exampleInputConfirmPassword1');
        const checkbox = document.getElementById('exampleCheck1');

        passwordInput.addEventListener('input', checkPasswordValidity);
        confirmPasswordInput.addEventListener('input', checkPasswordValidity);

        function checkPasswordValidity() {
            const password = passwordInput.value;
            const confirmPassword = confirmPasswordInput.value;

            if (password.length >= 8 && /[A-Z]/.test(password) && password === confirmPassword) {
                checkbox.checked = true;
            } else {
                checkbox.checked = false;
            }
        }
    </script>
@endsection
