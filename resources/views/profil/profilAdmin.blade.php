<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi Magang | Profil</title>
    <link rel="icon" href="{{asset('assets/image/ds.png')}}" type="image/x-icon">
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
    @include('admins.layouts.head')
</head>
<body>
    @include('admins.layouts.navbar')
    <div class="relative w-full h-screen flex flex-col items-center justify-center mt-[60px]">
        <div class="container xl:ps-96 flex items-center justify-start">
            <p class="text-black Poppins text-[24px] font-semibold">Profil</p>
        </div>
        <div class="flex items-start flex-col sm:flex-row justify-center z-10 p-5">
            <div class="w-full sm:w-auto flex items-center justify-center">
                <div class="rounded-full overflow-hidden flex items-center justify-center w-[248px] h-[248px] me-0 sm:me-[80px] md:me-[111px]">
                    <img src="{{asset('assets/image/UserImg.png')}}" alt="">
                </div>
            </div>
            <div class="flex flex-col items-start justify-center">
                <div class="relative">
                    <i class="fa-solid fa-user absolute text-color1 right-1 top-10 w-[20px] h-[20px]"></i>
                    <label for="" class="text-[16px] Inter font-normal text-color1">username</label>
                    <input type="text" name="" value="{{ auth()->user()->username }}" id="" class="w-full rounded-[10px] bg-white border border-color1 Inter font-normal text-[16px] text-color2 px-[20px] py-[10px]" placeholder="User">
                </div>
                <div class="relative my-4">
                    <i class="fa-solid fa-eye absolute text-color1 right-1 top-10 w-[20px] h-[20px]"></i>
                    <label for="" class="text-[16px] Inter font-normal text-color1">Password</label>
                    <input type="password" value="............" name="" id="" class="w-full rounded-[10px] bg-white border border-color1 Inter font-normal text-[16px] text-color2 px-[20px] py-[10px]" placeholder="">
                </div>
                <div onclick="window.location.href='/logout';" style="cursor: pointer" class="rounded-[10px] bg-color1 px-16 py-4 text-white Poppins text-[19px] font-medium">
                    Logout
                </div>
            </div>

        </div>
    </div>

    <!-- jQuery -->
<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('assets/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('assets/plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('assets/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('assets/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('assets/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('assets/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE for demo purposes -->
{{-- <script src="{{asset('assets/dist/js/demo.js')}}"></script> --}}
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('assets/dist/js/pages/dashboard.js')}}"></script>
    
</body>
</html>