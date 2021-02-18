<div>
    <h2 class="mb-4">Users </h2>
    {{-- <button class="border-4 px-4 py-2 bg-green-800 rounded-full"><span class="text-white font-bold">+</span></button> --}}
    <div class="flex h-screen">
        <table class="table-auto bg-gray-100 w-1/2">
            <thead class="">
                <tr>
                    <th class="py-4 px-2">SN</th>
                    <th class="py-4 px-2">Name</th>
                    <th class="py-4 px-2">Email</th>
                    <th class="py-4 px-2">Image</th>
                    <th class="py-4 px-2">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white text-center">
                @foreach ($users as $key => $value)
                <tr class=" border-b-2">
                    <td class="py-4 px-2">{{ $key+1 }}</td>
                    <td class="py-4 px-2">{{ $value->name }}</td>
                    <td class="py-4 px-2">{{ $value->email }}</td>
                    <td class="py-4 px-2"><img class="h-16 w-16 rounded-full object-cover " src="{{ asset('storage/users/'.$value->image) }}" alt="{{ $value->name }}"></td>
                    <td class="py-4 px-2">
                        <button href="" class="border-2 shadow-lg rounded-full p-2 bg-green-700 text-green-100 font-bold" wire:click="edit({{ $value->id }})">Edt</button>
                        <button class="border-2 shadow rounded-full p-2 bg-red-700 text-green-100 font-bold" wire:click="delete({{ $value->id }})" onclick="confirm('Are you sure you want to delete?') || event.stopImmediatePropagation()">Del</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <form action="" class="w-1/2 ml-8" wire:submit.prevent="save">
            <h4 class="font-gray-500 font-black mb-2">Fill Your Form</h4>

            @include('components.flash_message')

            <input type="hidden" wire:model="user_id">

            <label for="name" class="">Name</label>
            <input type="text" wire:model="name" id="name" class="py-2 px-4 w-full mb-2 text-sm focus:bg-gray-100 focus:text-gray-500 lowercase" placeholder="Enter your full name">
            <div class="mb-1">@error('name') <span class="text-red-900">{{ $message }}</span> @enderror</div>

            <label for="email" class="">Email Address</label>
            <input type="email" wire:model="email" id="email" class="py-2 px-4 w-full mb-2 text-sm focus:bg-gray-100 focus:text-gray-500 lowercase" placeholder="Enter your email address">
            <div class="mb-1">@error('email') <span class="text-red-900">{{ $message }}</span> @enderror</div>

            <label for="description" class="">Description</label>
            <textarea wire:model="description" id="description" rows="3" class="py-2 px-4 w-full mb-2 text-sm focus:bg-gray-100 focus:text-gray-500 lowercase" placeholder="Enter your description"></textarea>

            <div class="m-3">
                <label>Upload Image
                <input type="file" wire:model="image" class="w-full">
                </label>
                @if ($image)
                    Image Preview:
                    <img src="{{ $image->temporaryUrl() }}">
                @endif
            </div>

            <button class="block bg-green-800 border-2 px-4 py-2 rounded-lg text-green-100" type="submit">Save</button>
        </form>
    </div>
</div>
