<div class="flex flex-col justify-center items-center">
    <img src="{{ asset('assets/images/illustration/empty-data.svg') }}" alt="" class="w-64">
    <div class="text-primary-90 font-bold mt-3">
        {{ json_encode($message) }}
    </div>
</div>
