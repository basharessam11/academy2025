<!DOCTYPE html>
<html lang="en">

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
            <div class="col-span-3 sign hidden md:flex justify-center items-center text-center ">
                <h2 class="font-bold  text-7xl text-white">اكاديميه الايمان</h2>
            </div>
            <div class="col-span-5 md:col-span-2 signup2 py-8 lg:py-28">
                <div class="flex justify-center items-center px-5 lg:px-16">
                    <div class="   w-full">
                        <h2 class="text-center text-3xl font-semibold my-6">
                            انشاء حساب
                        </h2>
                        <form class="space-y-4" method="POST" action="{{ route('customer.register1') }}">
                            @csrf

                            <div>
                                <input id="username" name="name" value="{{ old('name') }}" type="text"
                                    class="w-full p-3 mt-2 border border-gray-800 bg-[#D9D9D966] rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600"
                                    placeholder="اسم المستخدم" />
                            </div>
                            <div>
                                <input id="email" name="email" type="email" value="{{ old('email') }}"
                                    class="w-full p-3 mt-2 border border-gray-800 bg-[#D9D9D966] rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600"
                                    placeholder="البريد الالكتروني" />
                            </div>



                            <div>
                                <input id="password" type="password" name="password" value="{{ old('password') }}"
                                    class="w-full p-3 mt-2 border border-gray-800 bg-[#D9D9D966] rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600"
                                    placeholder="كلمه المرور" />
                            </div>

                            <div>
                                <input id="confirm-password" name="password_confirmation" type="password"
                                    value="{{ old('password_confirmation') }}"
                                    class="w-full p-3 mt-2 border border-gray-800 bg-[#D9D9D966] rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600"
                                    placeholder="اعادة كلمه المرور" />
                            </div>
                            <div>
                                <input id="username" name="phone" type="text" value="{{ old('phone') }}"
                                    class="w-full p-3 mt-2 border border-gray-800 bg-[#D9D9D966] rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600"
                                    placeholder="الهاتف" />
                            </div>
                            <div>
                                <select id="country" name="country_id"
                                    class="w-full p-3 mt-2 border border-gray-800 bg-[#D9D9D966] rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
                                    <option value="" disabled {{ old('country_id') ? '' : 'selected' }}>الدولة
                                    </option>
                                    @foreach ($country as $c)
                                        <option value="{{ $c->id }}"
                                            {{ old('country_id') == $c->id ? 'selected' : '' }}>
                                            {{ $c->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                            <div>
                                <select id="user-type" name="user_type"
                                    class="w-full p-3 mt-2 border border-gray-800 bg-[#D9D9D966] rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
                                    <option value="">النوع</option>
                                    <option value="1" {{ old('user_type') == '1' ? 'selected' : '' }}>ذكر</option>
                                    <option value="2" {{ old('user_type') == '2' ? 'selected' : '' }}>أنثى
                                    </option>
                                </select>
                            </div>


                            @if ($errors->any())
                                <div class="bg-red-500 text-white p-3 rounded-md mb-4">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="mt-6">
                                <button type="submit" class="w-full py-4 bg-[#0A2640] text-white text-xl rounded-md">
                                    انشاء حساب
                                </button>
                            </div>
                        </form>

                        <div class="mt-4 text-center">
                            <p class="text-sm">
                                لدي حساب
                                <a href="{{ route('customer.login') }}" class=" hover:underline font-bold">
                                    , تسجيل الدخول

                                </a>

                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
