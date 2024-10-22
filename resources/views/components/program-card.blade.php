@php
    $raised = 7500000;
    $goals = 15000000;
    $percentage = ceil(($raised / $goals) * 100); // Correct function is ceil(), not cell()

    // Format the numbers as currency (Rp)
    $raisedFormatted = number_format($raised, 0, ',', '.');
    $goalsFormatted = number_format($goals, 0, ',', '.');
@endphp

<main
    class="p-3 bg-white shadow-[0_0_2px_0_rgba(0,0,0,0.80)] flex flex-col items-start justify-center gap-3 max-w-[264px]">
    <img src="images/img.jpeg" class="w-[240px] h-[140px] object-cover" />
    <section class="flex justify-between w-full">
        <p class="uppercase text-primary text-[10px] font-bold">fundraising</p>
        <div class="flex gap-1">
            <img src="icons/date.svg" />
            <p class="text-[10px] text-black font-medium">
                24 Dec 2024
            </p>
        </div>
    </section>
    <section class="flex justify-between w-full flex-col gap-1">
        <div class="p-[1px] w-full bg-white-dark rounded-[20px] items-center justify-start flex">
            <div class=" w-[{{ $percentage }}%] bg-primary rounded-[20px] h-[6px]">
            </div>
        </div>
        <section class="flex justify-between w-full">
            <p class=" text-black text-[8px] ">Raised: Rp.{{ $raisedFormatted }}</p>

            <p class="text-[8px] text-black ">
                Goals: Rp.{{ $goalsFormatted }} </p>
            </div>
        </section>
        <section class="min-h-[120px] self-stretch flex-1 ">
            <p class="text-[16px] text-black max-w-max line-clamp-2">
                Financial Helps for the Poor, Help Needy Family in
                asdsadasdas</p>
            <p class="text-[12px] font-light text-dark line-clamp-3">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus aspernatur quod ut, est debitis quos
                eveniet iste nulla. Alias ex suscipit numquam perferendis
            </p>
        </section>
        <section  class=" grid grid-cols-2 gap-3">
            <x-button rounded="none">
                <p class="text-[12px]">
                    View Detail
                </p>
            </x-button>
            <x-button rounded="none" color="dark">
                <p class="text-[12px]">
                    Donate Now
                </p>
            </x-button>
        </section>
    </section>
</main>