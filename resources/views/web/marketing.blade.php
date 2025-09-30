@php
    use App\Models\Setting;
    use App\Models\Meta;

    use App\Models\Visit;
    use Illuminate\Support\Facades\Http;
    use App\Models\Countries;
    $locale = App::currentLocale();
    $settings = Setting::find(1);
    $page = Route::currentRouteName();
    $meta = Meta::first();

    $metaData = $meta->getMeta($page, $locale);
    $ip_address = request()->ip();
    // $ip_address = '135.220.200.174';

    // احصل على بيانات الدولة من API تحديد الموقع الجغرافي
    $response = Http::get("https://ipwhois.app/json/{$ip_address}");
    // dd($response->json('country'));
    $country_code = strtolower($response->json('country_code')); // مثل "US" أو "EG"

    // البحث عن الدولة في جدول countries
    $country = Countries::where('code', $country_code)->first();
    $country_id = $country ? $country->id : 1; // إذا لم يتم العثور على الدولة، اجعلها null

    $visit = Visit::where('ip_address', $ip_address)->first();

    if ($visit) {
        $visit->increment('visit_count');
        $visit->update(['country_id' => $country_id]);
    } else {
        $referer = request()->headers->get('referer');
        Visit::create([
            'referer' => $referer,
            'ip_address' => $ip_address,
            'visit_count' => 1,
            'country_id' => $country_id,
        ]);
    }
@endphp

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings->name }}</title>

    <link href="https://unpkg.com/tailwindcss@3.4.1/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('web/style.css') }}">
    <!-- تحديد اللغة -->
    <meta http-equiv="content-language" content="{{ $locale }}">

    <!-- أيقونة الموقع (Favicon) -->
    <link rel="icon" type="image/png"
        href="{{ asset('images') }}/{{ $settings->photo != null ? $settings->photo : 'no-image.png' }}">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon"
        href="{{ asset('images') }}/{{ $settings->photo != null ? $settings->photo : 'no-image.png' }}">

    <!-- Canonical URL لمنع تكرار المحتوى -->
    <link rel="canonical" href="{{ route('home') }}">


    <meta property="og:site_name" content="{{ $settings->name }}">
    <meta property="og:title" content="{{ $settings->name }} - {{ $metaData['title'] }}">
    <meta property="og:description" content="{{ $metaData['description'] }}">
    <meta property="og:image"
        content="{{ asset('images') }}/{{ $settings->photo != null ? $settings->photo : 'no-image.png' }}">



    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('web') }}/build/css/bootstrap.min.css">
</head>

<body class="bg-gray-50">

    <section class="min-h-screen flex flex-col md:flex-row">
        <!-- التفاصيل -->
        <div class="md:w-1/2 bg-[#0A2640] text-white flex flex-col justify-center p-10">
            <div class="login-banner flex justify-center items-center my-6">
                <img src="{{ asset('images') }}/{{ $settings->photo != null ? $settings->photo : 'no-image.png' }}"
                    class="w-40 h-auto" alt="Logo">
            </div>

            {!! $settings->marketing_contant !!}
        </div>
        </div>

        <!-- الفورم -->
        <div class="md:w-1/2 flex justify-center items-center p-8">

            <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-8">

                <h2 class="text-2xl font-semibold text-center mb-6">📋 سجل بياناتك الآن</h2>
                {{-- --------------------------------------------------------------Alert-------------------------------------------------------------------- --}}


                @if (session('success'))
                    <div id="success-message" class="alert alert-success alert-dismissible fade show text-center"
                        role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div id="danger-message" class="alert alert-danger alert-dismissible fade show text-center"
                        role="alert">
                        {{ session('error') }}
                    </div>
                @endif



                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            {{-- @dd($errors) --}}
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {{-- --------------------------------------------------------------End Alert-------------------------------------------------------------------- --}}


                <form method="POST" action="{{ route('client.form.store') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium mb-1">الاسم الثلاثي</label>
                        <input type="text" name="name" class="w-full border rounded-md p-3" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">الدولة / المحافظة</label>
                        <input type="text" name="location" class="w-full border rounded-md p-3" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">رقم الهاتف</label>
                        <div class="flex gap-2">
                            <!-- إدخال رقم الهاتف -->
                            <input type="text" name="phone" placeholder="1000000000" minlength="10" maxlength="11"
                                class="w-2/3 border rounded-md p-3 text-left" pattern="^[0-9]{10,11}$"
                                title="رقم الهاتف يجب أن يكون 10 أو 11 رقم" required>

                            <!-- اختيار الدولة -->
                            <select name="country" id="country" class="w-1/3 border rounded-md p-3 text-center">
                                <option value="+20">🇪🇬 +20</option> <!-- مصر -->
                                <option value="+966">🇸🇦 +966</option> <!-- السعودية -->
                                <option value="+971">🇦🇪 +971</option> <!-- الإمارات -->
                                <option value="+965">🇰🇼 +965</option> <!-- الكويت -->
                                <option value="+968">🇴🇲 +968</option> <!-- عمان -->
                                <option value="+974">🇶🇦 +974</option> <!-- قطر -->
                                <option value="+973">🇧🇭 +973</option> <!-- البحرين -->
                                <option value="+962">🇯🇴 +962</option> <!-- الأردن -->
                                <option value="+961">🇱🇧 +961</option> <!-- لبنان -->
                                <option value="+963">🇸🇾 +963</option> <!-- سوريا -->
                                <option value="+964">🇮🇶 +964</option> <!-- العراق -->
                                <option value="+967">🇾🇪 +967</option> <!-- اليمن -->
                                <option value="+218">🇱🇾 +218</option> <!-- ليبيا -->
                                <option value="+212">🇲🇦 +212</option> <!-- المغرب -->
                                <option value="+213">🇩🇿 +213</option> <!-- الجزائر -->
                                <option value="+216">🇹🇳 +216</option> <!-- تونس -->
                                <option value="+249">🇸🇩 +249</option> <!-- السودان -->
                                <option value="+222">🇲🇷 +222</option> <!-- موريتانيا -->
                                <option value="+252">🇸🇴 +252</option> <!-- الصومال -->
                                <option value="+269">🇰🇲 +269</option> <!-- جزر القمر -->
                                <option value="+970">🇵🇸 +970</option> <!-- فلسطين -->
                            </select>


                        </div>
                    </div>


                    <div>
                        <label class="block text-sm font-medium mb-1">طريقة التواصل</label>
                        <select name="contact_method" class="w-full border rounded-md p-3">
                            <option value="1">واتساب</option>
                            <option value="2">مكالمة هاتفية</option>
                            <option value="3">الاثنان متاح</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">المؤهل الدراسي
                        </label>
                        <input type="text" name="education" class="w-full border rounded-md p-3" required>
                    </div>

                    <div>

                        <input type="hidden" name="user_id" value="{{ $user_id }}"
                            class="w-full border rounded-md p-3" required>
                    </div>

                    <button type="submit"
                        class="w-full bg-[#0A2640] text-white py-3 rounded-md font-semibold hover:bg-[#133a63] transition">
                        ارسال البيانات
                    </button>
                </form>
            </div>
        </div>
    </section>

</body>

</html>
