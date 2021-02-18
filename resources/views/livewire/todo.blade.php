<div>
    <h4 class="uppercase text-indigo-900 mb-3">Todos</h4>
    <form class="mb-4 flex flex-justify items-center mb-2" wire:submit.prevent="save">
        <input type="text" wire:model="title" class="py-2 px-2 mr-2" placeholder="Enter a Todo Title">
        <input type="text" wire:model="description" class="py-2 px-2 mr-2" placeholder="Describe Todo">
        <button type="submit" class="bg-indigo-900 text-indigo-100 py-2 px-4 rounded-lg">Submit</button>
    </form>
    <div class="bg-blue-200 w-full p-8 flex flex-col">
        @foreach ($todos as $item)
        <div class="rounded bg-gray-200 w-full p-2 m-1 ">
            <div class="flex justify-between">
                <h3 class="text-sm">{{ $item->title }} 
                </h3>
                <input type="checkbox"
                wire:change="toggleTodo({{ $item->id }})" {{ $item->is_completed ? 'checked' : '' }}>
            </div>
            <div class="text-sm mt-2">
                <div class="bg-white p-2 rounded mt-1 border-b border-grey cursor-pointer hover:bg-gray-100" wire:click="edit({{ $item->id }})">
                {{ $item->description }}
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
