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
</x-guest-layout>
