<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit plan') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-8 px-12">
        <h1 class="text-2xl font-semibold text-gray-700 mb-6">Edit plan</h1>
        <form action="{{ route('plans.update', $plan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" value="{{ $plan->name }}"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                <input type="number" name="price" id="price" value="{{ $plan->price }}"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                @error('price')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="icon" class="block text-sm font-medium text-gray-700">Icon</label>
                <input type="text" name="icon" id="icon" value="{{ $plan->icon }}"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                @error('icon')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="features" class="block text-sm font-medium text-gray-700">Features</label>
                <div id="features-wrapper">
                    @foreach(json_decode($plan->features) as $feature)
                        <div class="feature-input mb-2 flex">
                            <input type="text" name="features[]" class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                                value="{{ $feature }}" placeholder="Enter a feature" required>
                            <button type="button" class="ml-2 bg-red-500 text-white p-2 rounded-md remove-feature">Remove</button>
                        </div>
                    @endforeach
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
                <button type="submit" class="bg-blue-500 text-white p-2 rounded-md">Update plan</button>
            </div>
        </form>
    </div>

    <script>
        document.querySelector('form').addEventListener('submit', function (e) {
            const name = document.getElementById('name').value.trim();
            const price = document.getElementById('price').value.trim();
            const icon = document.getElementById('icon').value.trim();
            const features = document.querySelectorAll('input[name="features[]"]');
            let errorMessage = "";

            if (!name) errorMessage += "Name is required.\n";
            if (!icon) errorMessage += "Icon is required.\n";
            if (!features.length) errorMessage += "At least one feature is required.\n";
            features.forEach(function(input) {
                if (!input.value.trim()) {
                    errorMessage += "Feature cannot be empty.\n";
                }
            });
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
    </script>

</x-app-layout>
