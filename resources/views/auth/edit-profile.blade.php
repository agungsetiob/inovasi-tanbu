<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-white" :setting="$setting"/>
            </a>
        </x-slot>
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
            @php
                Session::forget('success');
            @endphp
        </div>
        @endif

        <form method="POST" action="{{ route('update.profile', $user->id) }}" enctype="multipart/form-data">
            @csrf

            <div class="text-center">
            <h4
                  class="
                    text-3xl
                    font-normal
                    text-body-color
                    relative
                    inline-flex
                  "
                >
                  Update Profile
                </h4>
            </div>
            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ old('name', $user->name) }}" required autofocus />
            </div>

            <!-- Username -->
            <div class="mt-4">
                <x-label for="username" :value="__('Username')" />

                <x-input id="username" class="block mt-1 w-full" type="text" name="username" value="{{ old('username', $user->username) }}" required autofocus />
            </div>

            <!-- skpd uptd -->
                <div class="mt-4">
                    <x-label for="skpd_id" :value="__('SKPD/UPTD')" />
                    <select name="skpd_id" id="skpd_id" class="hover:opacity-100 focus:opacity-100 opacity-50 text-gray-700 form-control @error('skpd_id') is-invalid @enderror" required>
                        <option class="opacity-100" value="" disabled selected>Pilih SKPD/UPTD</option>
                        @foreach ($skpds as $s)
                        <option class="opacity-100" value="{{ $s->id }}" @selected($user->skpd_id == $s->id)>{{ $s->nama }}</option>
                        @endforeach
                    </select>
                </div>

            <!-- profile photo -->
            <div class="form-group mt-4">
                <x-label for="username" :value="__('Profile photo')" />
                <div class="input-group">
                    <label class="input-group-btn">
                        <span class="btny btn-outline-light">Browse
                            <input accept="image/*" id="avatar" type="file" style="display: none;" multiple name="avatar">
                        </span>
                    </label>
                        <input id="uploadFile" type="text" class="bg-gray-400 form-control @error('image') is-invalid @enderror" readonly placeholder="Choose an image">
                </div>
                @error('image')
                <div class="alert alert-danger mt-2">
                    {{ $message }}
                </div>
                @enderror  
            </div>
            <script type="text/javascript">
                document.getElementById("avatar").onchange = function ()
                {
                    document.getElementById("uploadFile").value = this.value;
                }
            </script>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('Save') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.bootstrap5.min.css" integrity="sha512-Ars0BmSwpsUJnWMw+KoUKGKunT7+T8NGK0ORRKj+HT8naZzLSIQoOSIIM3oyaJljgLxFi0xImI5oZkAWEFARSA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
