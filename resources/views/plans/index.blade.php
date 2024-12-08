<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('plans') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="container mx-auto p-8">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-semibold text-gray-700">plans</h1>
                        <a href="{{ route('plans.create') }}"
                            class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                            Add plan
                        </a>
                    </div>

                    <div class=" shadow-md rounded-md overflow-x-scroll ">
                        <table class="min-w-full table-auto w-full  border-collapse">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 text-left">SL</th>
                                    <th class="px-4 py-2 text-left">Name</th>
                                    <th class="px-4 py-2 text-left">Price</th>
                                    <th class="px-4 py-2 text-left">Icon</th>
                                    <th class="px-4 py-2 text-left">Features</th>
                                    <th class="px-4 py-2 text-left w-[150px]">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @foreach ($plans as $index => $plan)
                                    <tr>
                                    <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                        <td class="px-4 py-2">{{ $plan->name }}</td>

                                        <td class="px-4 py-2">৳{{ number_format($plan->price, 1) }}</td>
                                        <td class="px-4 py-2">{{ $plan->icon }}</td>
                                        <td class="px-4 py-2">@foreach (json_decode($plan->features) as $feature)
    <p>{{ $feature }}</p>
@endforeach
</td>


                                        <td class="px-4 py-2">
                                            <a href="{{ route('plans.edit', $plan->id) }}"
                                                class="text-blue-600">Edit</a>
                                            |
                                            <form action="{{ route('plans.destroy', $plan->id) }}" method="POST"
                                            onsubmit="return confirmDelete()" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this plan?");
    }
</script>

</x-app-layout>
