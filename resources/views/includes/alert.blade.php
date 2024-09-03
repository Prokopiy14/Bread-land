@if($alert = session()->pull('alert'))
    <div class="text-green-800 mb-0 rounded-0 bg-green-50 text-center text-sm py-2" role="alert">
        <span class="font-medium">{{ $alert }}</span>
    </div>
@endif
