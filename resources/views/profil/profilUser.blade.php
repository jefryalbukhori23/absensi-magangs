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
</head>
<body>

    <div class="relative w-full h-screen flex items-center justify-center">
        <div class="absolute top-0 left-0 w-full z-[-5]">
            <div class="w-full">
                <img src="{{asset('assets/image/vTop.png')}}" alt="">
            </div>
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
                    <input type="text" value="{{ auth()->user()->username }}" name="" id="" class="w-full rounded-[10px] bg-white border border-color1 Inter font-normal text-[16px] text-color2 px-[20px] py-[10px]" placeholder="User">
                </div>
                <div class="relative my-4">
                    <i class="fa-solid fa-eye absolute text-color1 right-1 top-10 w-[20px] h-[20px]"></i>
                    <label for="" class="text-[16px] Inter font-normal text-color1">Password</label>
                    <input type="password" value=".........." name="" id="" class="w-full rounded-[10px] bg-white border border-color1 Inter font-normal text-[16px] text-color2 px-[20px] py-[10px]" placeholder="User">
                </div>
                <div onclick="window.location.href='/logout';" style="cursor: pointer" class="rounded-[10px] bg-color1 px-16 py-4 text-white Poppins text-[19px] font-medium">
                    Logout
                </div>
            </div>

        </div>
        <div class="absolute bottom-0 right-0 w-full z-[-5]">
            <img src="{{asset('assets/image/vBot.png')}}" class="float-end" alt="">
        </div>
    </div>
    
</body>
</html>