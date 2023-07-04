<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg w-[1600px]">

                <div class="flex flex-col">
                    @foreach ($data as $item)
                      <div class="bg-white rounded-lg shadow-lg p-6 my-4">
                        <h3 class="text-xl font-semibold text-indigo-600 mb-2">Site id:{{ $item->site_id }}</h3>
                        <p class="text-gray-700">{{ $item->token }}</p>
                        <a href="/send" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Send
                          </a>
                      </div>

                    @endforeach
                  </div>

                {{-- @foreach ($data as $item)
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-gray-200">Site id:{{ $item->site_id }}</div>
                        <div class="bg-gray-200">Token:{{ $item->token }}</div>
                    </div>
                @endforeach --}}
            </div>
        </div>
    </div>
</x-app-layout>
