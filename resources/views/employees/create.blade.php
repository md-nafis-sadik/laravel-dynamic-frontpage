<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Employee') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-8 px-12">
        <h1 class="text-2xl font-semibold text-gray-700 mb-6">Add Employee</h1>



        <!-- Display Success Message -->
        @if (session('success'))
            <div class="p-4 mb-4 text-green-700 bg-green-100 border border-green-400 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                    value="{{ old('name') }}" required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md" value="{{ old('email') }}" required>
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="position" class="block text-sm font-medium text-gray-700">Position</label>
                <input type="text" name="position" id="position"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md" value="{{ old('position') }}"
                    required>
                @error('position')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="salary" class="block text-sm font-medium text-gray-700">Salary</label>
                <input type="number" name="salary" id="salary"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md" value="{{ old('salary') }}"
                    required>
                @error('salary')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700">Employee Image</label>
                <input type="file" name="image" id="image"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Display Validation Errors -->
            @if ($errors->any())
                <div class="p-4 px-8 mb-4 text-red-700 bg-red-100 border border-red-400 rounded">
                    <ul class="list-disc">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-4">
                <button type="submit" class="bg-blue-500 text-white p-2 rounded-md">Save Employee</button>
            </div>
        </form>
    </div>

    <script>
        document.querySelector('form').addEventListener('submit', function (e) {
            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const position = document.getElementById('position').value.trim();
            const salary = document.getElementById('salary').value.trim();

            let errorMessage = "";

            if (!name) errorMessage += "Name is required.\n";
            if (!email || !/^\S+@\S+\.\S+$/.test(email)) errorMessage += "Valid email is required.\n";
            if (!position) errorMessage += "Position is required.\n";
            if (!salary || isNaN(salary) || salary <= 0) errorMessage += "Valid salary is required.\n";

            if (errorMessage) {
                e.preventDefault(); // Prevent form submission
                alert(errorMessage); // Show error messages
            }
        });
    </script>
</x-app-layout>
