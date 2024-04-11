<div class="bg-gray-50 dark:bg-gray-900 h-screen">
    <div class="flex justify-end px-6 py-6">
        @if (Auth::user())
            <button wire:click.prevent="logout" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Logout</button>
        @else
            <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Login</a>
        @endif
    </div>
    <div class="flex flex-col px-6 py-8 mx-auto md:h-screen lg:py-0">
        @if (session()->has('message'))
            <div class="bg-green-500 rounded text-white font-bold px-4 py-3 w-full mb-3" role="alert">
                {{ session('message') }}
            </div>
        @endif

        <div class="relative overflow-x-auto w-full">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mt-5">
                @if (Auth::user())
                    <caption class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                        <div class="flex justify-between">
                            <span class="text-gray-900 font-bold text-xl mb-2 text-white">Welcome {{ Auth::user()->name }}</span>
                            <a href="{{ route('addCompany') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Company</a>
                        </div>
                    </caption>
                @endif
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Name</th>
                        <th scope="col" class="px-6 py-3">Description</th>
                        <th scope="col" class="px-6 py-3">Address</th>
                        <th scope="col" class="py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($companies as $company)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $company->name }}
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ \Illuminate\Support\Str::limit($company->description, 50) }}
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $company->address }}
                                </td>
                                <td scope="row" class="py-3 font-medium text-gray-900">
                                    <a href="{{ route('viewCompany', $company->slug) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">View Company</a>
                                </td>
                        </tr>
                    @empty
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500 italic">
                                No companies found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $companies->links() }}
        </div>
    </div>
</div>
