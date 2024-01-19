<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="icon" href="{{asset('assets/image/ds.png')}}" type="image/x-icon">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('assets/customUser.css')}}">
    <script>
        tailwind.config = {
            theme: {
                extend: {},
                colors: {
                    white: '#FFF',
                    color1: '#1D60A2',
                    color2: '#9E9E9E',
                    color3: '#76B5E3',
                }
            }
        }
    </script>
    <style>
        * {
            box-sizing: border-box;
        }
        .fullscreen-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
        }

        .loading-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: white;
            font-size: 20px;
        }
    </style>
</head>
<body>
    <div class="fullscreen-overlay" style="display: none;">
        <div class="loading-container">
            <img src="{{ asset('assets/image/puff.svg') }}" class="me-4" style="width: 3rem"
                alt="audio">
            Loading...
        </div>
    </div>
    <div class="flex h-screen items-center justify-center">
        <div class="hidden sm:flex w-[50%] h-full items-center justify-center">
            <div class="mx-[50px]">
                <img src="{{asset('assets/image/image1.png')}}" alt="">
            </div>
        </div>
        <div class="w-full sm:w-[50%] h-full flex flex-col items-center justify-center bg-color3">
            <p class="text-color1 text-[36px] font-bold Poppins mb-[70px]">Login</p>
            <form id="form-login" action="" class="w-[90%] lg:w-[60%] flex flex-col items-center justify-center">
                @csrf
                <div class="relative w-full flex flex-col mb-4">
                    <div class="absolute bottom-5 text right-3">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <label for="" class="Inter text-[16px] text-color1 mb-2">Masukkan Email</label>
                    <input class="p-3 w-full Inter font-normal border border-color1 bg-white outline-none focus:outline-offset-0 focus:outline-color1 h-[64px] rounded-[10px]" placeholder="Username" type="email" name="email" id="email">
                </div>
                <div class="relative w-full flex flex-col mb-4">
                    <div class="absolute bottom-5 text right-3">
                        <i style="cursor:pointer" class="fa-solid fa-eye"></i>
                    </div>
                    <label for="" class="Inter text-[16px] text-color1 mb-2">Masukkan password</label>
                    <input class="p-3 w-full Inter font-normal border border-color1 bg-white outline-none focus:outline-offset-0 focus:outline-color1 h-[64px] rounded-[10px]" placeholder="Password" type="password" name="password" id="password">
                </div>
                <button type="submit" class="w-full bg-color1 py-4 text-[19px] font-medium text-white rounded-[10px]">
                    Login
                </button>
            </form>
        </div>
    </div>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    <script>
        $(document).ready(function() {
            var passwordVisible = false;
            // Tambahkan event listener untuk ikon mata
        $('.fa-eye').on('click', function() {
            // Ubah tipe input password sesuai dengan status saat ini
            passwordVisible = !passwordVisible;
            var passwordInput = $('#password');
            passwordInput.attr('type', passwordVisible ? 'text' : 'password');

            // Ganti ikon mata sesuai dengan status saat ini
            var eyeIcon = $(this);
            eyeIcon.toggleClass('fa-eye-slash', passwordVisible);
        });

            $('#form-login').submit(function(event) {
                event.preventDefault();

                var overlay = $('.fullscreen-overlay');
                var loadingIcon = $('.loading-container');

                overlay.show(); // Menampilkan layar penuh
                loadingIcon.show(); // Menampilkan indikator loading

                var tombolKirim = $(this).find('button[type="submit"]');

                const formData = new FormData(this);

                $.ajax({
                    type: 'POST',
                    url: '/masuk',
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        if (data.success) {
                            console.log(data.user)
                            const user = data.user;
                            // toastr.success(`Selamat datang, ${data.user.name}`);
                            if (data.user.role == 'admin') {
                                window.location.href = '/dashboard';
                            } else if (data.user.role == 'student') {
                                window.location.href ='/cameraScan';
                            }
                            // Redirect or handle successful login
                        } else {
                            // Handle validation errors and display toast alerts
                            const errors = data.errors;
                            for (const [field, messages] of Object.entries(errors)) {
                                for (const message of messages) {
                                    toastr.error(message);
                                }
                            }
                        }
                    },
                    error: function(error) {
                        console.error('Error:', error);
                        toastr.error('Email Atau Password Salah !');
                    },
                    complete: function() {
                        overlay.hide();
                        loadingIcon.hide();
                    }
                });
            });
        });
    </script>
</body>
</html>