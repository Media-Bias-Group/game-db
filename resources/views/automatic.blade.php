<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="content-container p-6 bg-white border-b border-gray-200">
                   <form action="/automatic"
                   enctype="multipart/form-data"
                   method="POST">
                   @csrf
                   <input type="file" name="import_file">
                   <br/>
                   
                <div class="mb-6">
                    <button type="submit"

                            class="m-2 bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500"
                    >
                        Submit
                    </button>
                </div>
@if(session()->has('success'))
    <div style="color:red;">
        {{ session()->get('success') }}
    </div>
@endif
                   </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
