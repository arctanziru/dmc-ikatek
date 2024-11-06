@php
    $percentage = ceil(($totalDonation / $target) * 100);
    $totalDonationFormatted = number_format($totalDonation, 0, ',', '.');
    $targetFormatted = number_format($target, 0, ',', '.');
@endphp

<div
    class="p-3 shadow-[0_0_2px_0_rgba(0,0,0,0.80)] z-20 bg-white flex flex-col items-start gap-2 justify-center overflow-hidden w-[264px]">
    <img src="images/img.jpeg" class="w-[240px] h-[100px] object-cover" />
    <section class="flex justify-between w-full">
        <p class="uppercase text-primary text-[10px] font-bold">{{ $category }}</p>
        <div class="flex gap-1">
            <img src="icons/date.svg" alt="Date Icon" />
            <p class="text-[10px] text-black font-medium">
                {{ $createdAt }}
            </p>
        </div>
    </section>
    <section class="flex flex-col gap-2 w-full">
        <div class="p-[1px] w-full bg-white-dark rounded-[20px] items-center justify-start flex">
            <div class="w-[{{ $percentage }}%] bg-primary rounded-[20px] h-[6px]"></div>
        </div>
        <section class="grid grid-cols-2 w-full">
            <div>
                <p class="text-black text-[8px]">Raised: Rp.{{ $totalDonationFormatted }}</p>
            </div>
            <div class="flex justify-end">
                <p class="text-[8px] text-black">Goals: Rp.{{ $targetFormatted }}</p>
            </div>
        </section>
    </section>
    <section class="self-stretch flex-1 flex flex-col">
        <p class="text-[16px] text-black max-w-max line-clamp-2">{{ $name }}</p>
        <p class="text-[12px] font-light text-dark line-clamp-3">{{ $desc }}</p>
    </section>
    <section class="grid grid-cols-2 gap-3 w-full">
        <a>
            <x-button rounded="none" class="w-full">
                <p class="text-[12px]">View Detail</p>
            </x-button>
        </a>
        <a href="/donate">
            <x-button rounded="none" color="dark" class="w-full">
                <p class="text-[12px]">Donate Now</p>
            </x-button>
        </a>
    </section>
</div>