<x-app-layout>
    {{-- <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div> --}}

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" class="w-[400px] mx-auto p-6 my-16" action="{{ route('password.email') }}">
        @csrf

        <h2 class="text-2xl font-semibold text-center mb-5">
            Enter your Email to reset password 
          </h2>
          <p class="text-center text-gray-500 mb-6">
            or
            <a
              href="{{route('login') }}"
              class="text-purple-600 hover:text-purple-500"
              >login with existing account</a
            >
          </p>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-app-layout>
