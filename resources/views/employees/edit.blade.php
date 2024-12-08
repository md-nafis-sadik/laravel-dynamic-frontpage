<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Employee') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-8 px-12">
        <h1 class="text-2xl font-semibold text-gray-700 mb-6">Edit Employee</h1>
        <form action="{{ route('employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" value="{{ $employee->name }}"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ $employee->email }}"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="position" class="block text-sm font-medium text-gray-700">Position</label>
                <input type="text" name="position" id="position" value="{{ $employee->position }}"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                @error('position')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="salary" class="block text-sm font-medium text-gray-700">Salary</label>
                <input type="number" name="salary" id="salary" value="{{ $employee->salary }}"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                @error('salary')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700">Employee Image</label>
                <input type="file" name="image" id="image"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md" onchange="previewImage(event)">
                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            @if($employee->image)
                <div class="mb-4" id="image-preview-container">
                    <img src="{{ Storage::url($employee->image) }}" alt="Employee Image"
                        class="w-32 h-32 object-cover rounded-md" id="image-preview">
                </div>
            @else
                <div class="mb-4" id="image-preview-container"></div>
            @endif


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
                <button type="submit" class="bg-blue-500 text-white p-2 rounded-md">Update Employee</button>
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


        function previewImage(event) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                const previewContainer = document.getElementById('image-preview-container');
                previewContainer.innerHTML = ''; // Clear any previous image preview

                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('w-32', 'h-32', 'object-cover', 'rounded-md');
                previewContainer.appendChild(img);
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>

</x-app-layout>
