<a href="/disaster/{{$item->id}}"
    class="flex shadow-sm overflow-hidden shadow-dark/20 cursor-pointer flex-col hover:bg-white-light transition-[200ms] hover:transition-[200ms]">

    <div class="flex flex-col justify-between p-3 gap-2">
        <div class="w-full">
            <img src="{{ asset('storage/' . $item->image) }}" loading="lazy" class="h-[120px] w-full object-cover"
                onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';" />

        </div>
        <div class="flex justify-between gap-2">
            <p class="line-clamp-1 flex-1 font-bold capitalize">{{$item->name}} </p>
            <p class="line-clamp-1 min-w-fit font-semibold text-[14px] uppercase text-primary">
                {{$item->status}}
            </p>
        </div>
        <p class="text-dark text-[12px] line-clamp-2">{{ $item['description'] }}</p>
        <div class="flex justify-between w-full">
            <div class="flex gap-2 items-center flex-1 min-w-max justify-start text-right">
                <x-bladewind::icon name="map-pin" class="!h-4 !w-4" />
                <p class="text-dark font-light text-[12px] line-clamp-1"
                    name="  {{ ucwords(strtolower($item->city->name)) }},{{ucwords(strtolower($item->city->province->name)) }}">
                    {{ ucwords(strtolower($item->city->name)) }},
                    {{ucwords(strtolower($item->city->province->name)) }}
                </p>
            </div>
        </div>
        <div class="flex gap-2 items-center flex-1 min-w-max justify-between text-right">
            <div class="flex gap-1">
                <x-bladewind::icon name="user" class="!h-4 !w-4" />
                <p class="text-dark font-light text-[12px]">
                    {{$item->reporter_name ?? $item->user->name}}
                </p>
            </div>
            <div class="flex gap-1">
                <x-bladewind::icon name="calendar-days" class="!h-4 !w-4" />
                <p class="text-dark font-light text-[12px]">
                    {{ $item['time_of_disaster'] ? (new DateTime($item['time_of_disaster']))->format('d M Y') : 'N/A' }}
                </p>
            </div>
        </div>

    </div>
</a>