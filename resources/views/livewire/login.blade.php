<div class="bg-gray-50 dark:bg-gray-900">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl text-center font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Sign in to your account
                </h1>
                @if (session()->has('error'))
                    <div class="bg-red-500 rounded text-white font-bold px-4 py-3" role="alert">
                        <p>{{ session('error') }}</p>
                    </div>
                @endif
                @if (session()->has('message'))
                    <div class="bg-green-500 rounded text-white font-bold px-4 py-3" role="alert">
                        <p>{{ session('message') }}</p>
                    </div>
                @endif
                <form class="space-y-4 md:space-y-6" action="#">
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="email" wire:model="email" name="email" id="email" class="bg-gray-50 border @error('email') dark:border-red-500 @enderror border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                        <input type="password" wire:model="password" name="password" id="password" class="bg-gray-50 border @error('password') dark:border-red-500 @enderror border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @error('password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <button wire:click.prevent="login" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        <div wire:loading class="flex items-center space-x-2 text-white">
                            <span>Loading...</span>
                        </div>
                        <span wire:loading.remove>Sign In</span>
                    </button>
                    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                        Create an account. <a href="{{ route('register') }}" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Sign up</a>
                    </p>
                    <div>
                        <a href="{{ route('dashboard') }}" class="text-white">
                            <div class="flex">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
                                </svg>

                                <span class="ml-2">Back</span>
                            </div>
                          </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
