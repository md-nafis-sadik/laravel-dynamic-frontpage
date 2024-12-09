<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add plan') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-8 px-12">
        <h1 class="text-2xl font-semibold text-gray-700 mb-6">Add plan</h1>



        <!-- Display Success Message -->
        @if (session('success'))
            <div class="p-4 mb-4 text-green-700 bg-green-100 border border-green-400 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('plans.store') }}" method="POST" enctype="multipart/form-data">
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
                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                <input type="number" name="price" id="price"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md" value="{{ old('price') }}" required>
                @error('price')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
    <label for="icon" class="block text-sm font-medium text-gray-700">Icon</label>
    <select name="icon" id="icon"
        class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
        <option value="bi bi-box" {{ old('icon') == 'bi bi-box' ? 'selected' : '' }}>Box</option>
        <option value="bi bi-send" {{ old('icon') == 'bi bi-send' ? 'selected' : '' }}>Send</option>
        <option value="bi bi-airplane" {{ old('icon') == 'bi bi-airplane' ? 'selected' : '' }}>Airplane</option>
        <option value="bi bi-rocket" {{ old('icon') == 'bi bi-rocket' ? 'selected' : '' }}>Rocket</option>
    </select>
    @error('icon')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>


<div class="mb-4">
    <label for="color" class="block text-sm font-medium text-gray-700">Color</label>
    <select name="color" id="color"
        class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
        <option value="#20c997" {{ old('color') == '#20c997' ? 'selected' : '' }}>Green (#20c997)</option>
        <option value="#0dcaf0" {{ old('color') == '#0dcaf0' ? 'selected' : '' }}>Cyan (#0dcaf0)</option>
        <option value="#fd7e14" {{ old('color') == '#fd7e14' ? 'selected' : '' }}>Orange (#fd7e14)</option>
        <option value="#0d6efd" {{ old('color') == '#0d6efd' ? 'selected' : '' }}>Blue (#0d6efd)</option>
    </select>
    @error('color')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>



            <div class="mb-4">
    <label for="features" class="block text-sm font-medium text-gray-700">Features</label>
    <div id="features-wrapper">
        <div class="feature-input mb-2 flex">
            <input type="text" name="features[]" maxlength="100" class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                placeholder="Enter a feature" required>
            <button type="button" class="ml-2 bg-red-500 text-white p-2 rounded-md remove-feature">Remove</button>
        </div>
    </div>
    <button type="button" id="add-feature" class="bg-green-500 text-white p-2 rounded-md mt-2">Add Feature</button>
    @error('features')
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
                <button type="submit" class="bg-blue-500 text-white p-2 rounded-md">Save plan</button>
            </div>
        </form>
    </div>

    <script>
       document.querySelector('form').addEventListener('submit', function (e) {
    const name = document.getElementById('name').value.trim();
    const price = document.getElementById('price').value.trim();
    const icon = document.getElementById('icon').value.trim();
    const featureInputs = document.querySelectorAll('[name="features[]"]');
    let featuresValid = true;

    // Check if at least one feature is filled out
    featureInputs.forEach(function(input) {
        if (input.value.trim() === "") {
            featuresValid = false;
        }
    });

    let errorMessage = "";

    if (!name) errorMessage += "Name is required.\n";
    if (!icon) errorMessage += "Icon is required.\n";
    if (!featuresValid) errorMessage += "At least one feature is required.\n";
    if (!price || isNaN(price) || price <= 0) errorMessage += "Valid price is required.\n";

    if (errorMessage) {
        e.preventDefault(); // Prevent form submission
        alert(errorMessage); // Show error messages
    }
});


        document.getElementById('add-feature').addEventListener('click', function () {
        const wrapper = document.getElementById('features-wrapper');
        const featureInput = document.createElement('div');
        featureInput.classList.add('feature-input', 'mb-2', 'flex');
        featureInput.innerHTML = `
            <input type="text" name="features[]" class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                placeholder="Enter a feature" required>
            <button type="button" class="ml-2 bg-red-500 text-white p-2 rounded-md remove-feature">Remove</button>
        `;
        wrapper.appendChild(featureInput);
    });

    document.getElementById('features-wrapper').addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-feature')) {
            e.target.closest('.feature-input').remove();
        }
    });

    document.getElementById('features-wrapper').addEventListener('input', function (e) {
    if (e.target.name === 'features[]') {
        const maxLength = 100;
        const currentLength = e.target.value.length;

        if (currentLength > maxLength) {
            e.target.value = e.target.value.substring(0, maxLength); // Truncate to 100 characters
            alert('Feature description cannot exceed 100 characters.');
        }
    }
});

    </script>
</x-app-layout>
