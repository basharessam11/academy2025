<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>

    <link href="https://unpkg.com/tailwindcss@3.4.1/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('web') }}/style.css">

</head>

<body>
    <section>
        <div class="grid md:grid-cols-5 gap-4">
            <div class="col-span-3 sign hidden md:flex justify-center items-center text-center min-h-screen">
                <h2 class="font-bold text-7xl text-white">اكاديميه الايمان</h2>
            </div>
            <div class="col-span-5 min-h-[74vh] md:col-span-2 signup2 py-8 lg:py-28">
                <div class="flex justify-center items-center px-5 lg:px-8 h-full">
                    <div class="h-full flex flex-col justify-center w-full">
                        <h2 class="text-center text-3xl font-semibold mb-12">
                            تسجيل دخول
                        </h2>
                        <form class="space-y-4" method="POST" action="{{ route('customer.login1') }}">
                            @csrf

                            <!-- Email Input -->
                            <div>
                                <input id="email" type="email"
                                    class="w-full p-3 mt-2 border border-gray-800 bg-[#D9D9D966] rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600"
                                    placeholder="البريد الالكتروني" name="email">
                            </div>

                            <!-- Password Input -->
                            <div>
                                <input id="password" type="password"
                                    class="w-full p-3 mt-2 border border-gray-800 bg-[#D9D9D966] rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600"
                                    placeholder="كلمه المرور" name="password">
                            </div>

                            <!-- Displaying Errors -->
                            @if ($errors->any())
                                <div class="bg-red-500 text-white p-3 rounded-md mb-4">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Submit Button -->
                            <div class="my-20">
                                <button type="submit"
                                    class="w-full py-4 my-8 bg-[#0A2640] text-white text-xl rounded-md">
                                    تسجيل الدخول
                                </button>
                            </div>
                        </form>

                        <!-- Links -->
                        <div class="text-center">
                            <p class="text-sm">
                                ليس لدي حساب
                                <a href="{{ route('customer.register') }}" class="hover:underline font-bold">انشاء
                                    حساب</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
