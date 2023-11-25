<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" :setting="$setting"/>
            </a>
        </x-slot>
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
            atau klik <a class="text-primary" target="_blank" href="https://api.whatsapp.com/send?phone={{$telp}}&text=Halo admin saya melakukan pendaftaran akun serasi, mohon diaktifkan akun saya. Terimakasih"><strong>disini</strong></a>
            @php
            Session::forget('success');
            @endphp
            
        </div>
        @endif

        <form method="POST" action="{{ route('register-user') }}" enctype="multipart/form-data">
            @csrf

            <div class="text-center">
                <h4
                    class="
                    text-3xl
                    font-normal
                    text-white
                    relative
                    inline-flex
                    "
                    >
                    Registration Form
                </h4>
            </div>

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- skpd -->
            <div class="mt-4">
                <x-label for="skpd_id" :value="__('SKPD')" />

                <select name="skpd_id" id="skpd_id" class="hover:opacity-100 focus:opacity-100 opacity-50 form-control @error('skpd_id') is-invalid @enderror" required>
                    <option value="" disabled selected>Pilih SKPD</option>
                    @foreach ($skpds as $s)
                    <option value="{{ $s->id }}" {{ old('category') == $s->id ? 'selected' : ''}}>{{ $s->nama }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Username -->
            <div class="mt-4">
                <x-label for="username" :value="__('Username')" />

                <x-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                type="password"
                name="password"
                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                type="password"
                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-white" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.bootstrap4.min.css" integrity="sha512-ht3CSPjgWsxdbLti7wtKNEk5hLoGtP2J8C40muB5/PCWwNw9M/NMJpyvHdeko7ADC60SEOiCenU5pg+kJiG9lg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js" integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
    $('#skpd_id').selectize({
        sortField: 'text'
    });
    $('.selectize-control').click(function() {
        $('.selectize-dropdown').removeClass('opacity-50');
    });
</script>
</x-guest-layout>
