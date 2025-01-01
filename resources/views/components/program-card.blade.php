@php
$percentage = $target > 0 ? ceil(($totalDonation / $target) * 100) : 0; // Prevent zero division error
$totalDonationFormatted = number_format($totalDonation, 0, ',', '.');
$targetFormatted = $target > 0 ? number_format($target, 0, ',', '.') : 'N/A'; // Display 'N/A' if no target

$widthClass = $fullwidth ? "w-full" : "max-w-[224px]";
$imageCl = $fullwidth ? "w-full" : "w-[200px]";
@endphp


<a href="/programs/{{$id}}"
    class="p-3 shadow-[0_0_2px_0_rgba(0,0,0,0.80)] z-20 rounded-sm bg-white hover:bg-white-dark duration-200 flex {{$widthClass}} flex-col items-start gap-2 justify-center overflow-hidden">
    <img src="{{ $image }}" class=" {{$imageCl}} h-[100px] object-cover" />
    <section class="flex justify-between w-full gap-2">
        <p class="uppercase text-primary text-[10px] font-bold text-ellipsis line-clamp-1">{{ $category }}</p>
        <p class="uppercase text-primary text-[10px] font-bold">{{ $status }}</p>
    </section>
    <section class="flex flex-col gap-2 w-full">
        @if ($target > 0)
        <div class="p-[1px] w-full bg-white-dark rounded-[20px] items-center justify-start flex">
            <div class="w-[{{ $percentage }}%] bg-primary rounded-[20px] h-[6px]"></div>
        </div>
        @endif
        <section class="grid grid-cols-2 w-full">
            <div>
                <p class="text-black text-[10px]">Raised: Rp.{{ $totalDonationFormatted }}</p>
            </div>
            <div class="flex justify-end">
                <p class="text-[10px] text-black">Goals: Rp.{{ $targetFormatted }}</p>
            </div>
        </section>
    </section>
    <section class="self-stretch flex-1 flex flex-col">
        <div class="flex">
            @if ($location)
            <p class="text-[12px] text-secondary capitalize">
                {{ ucwords(strtolower($location)) }}
            </p>
            @else

            @endif
        </div>
        <p class="text-[16px] text-black max-w-max line-clamp-2">{{ $name }}</p>
        <p class="text-[12px] font-light text-dark line-clamp-3">{{ $desc }}</p>
    </section>
    <div class="flex w-full justify-between items-center">

        <div class="flex">

            <x-bladewind::icon name="calendar-days" class="h-[14px]" />
            <p class="text-[10px] text-black font-medium">
                {{ $createdAt }}
            </p>
        </div>
    </div>
</a>