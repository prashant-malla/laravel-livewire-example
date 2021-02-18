@if (Session::has('error'))
<div class="-m-2 text-center">
<div class="p-2">
    <div class="inline-flex items-center bg-white leading-none text-pink-600 rounded-full p-2 shadow text-teal text-sm">
    <span class="inline-flex px-2">{{ session('success') }}</span>
    </div>
</div>
</div>
@endif
@if (Session::has('success'))
<div class="-m-2 text-center">
<div class="p-2">
    <div class="inline-flex items-center bg-white leading-none text-indigo-600 rounded-full p-2 shadow text-teal text-sm">
    <span class="inline-flex px-2">{{ session('success') }}</span>
    </div>
</div>
</div>
@endif