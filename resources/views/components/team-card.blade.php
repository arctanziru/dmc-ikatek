<main>
    <div class="w-[240px] h-[240px] relative bg-purple-200 rounded-md overflow-hidden">
        <img src="{{ $img }}" class="w-full h-full object-cover object-center" alt="{{ $name }}" />
        <div
            class="absolute top-0 flex justify-center items-center left-0 w-full h-full opacity-0 hover:opacity-100 bg-primary/40 duration-200 cursor-pointer">
            <div class="flex gap-2">
                @if($socialMedia['x'])
                    <x-button variant="fill" color="white" size="nopad" rounded="[50%]">
                        <a href="{{ $socialMedia['x'] }}" target="_blank" rel="noopener noreferrer">
                            <div class="w-[36px] h-[36px] flex p-2 justify-center items-center">
                                <img src="icons/x.svg" class="w-full h-full object-cover" />
                            </div>
                        </a>
                    </x-button>
                @endif
                @if($socialMedia['instagram'])
                    <x-button variant="fill" color="white" size="nopad" rounded="[50%]">
                        <a href="{{ $socialMedia['instagram'] }}" target="_blank" rel="noopener noreferrer">
                            <div class="w-[36px] h-[36px] flex p-2 justify-center items-center">
                                <img src="icons/instagram.svg" class="w-full h-full object-cover" />
                            </div>
                        </a>
                    </x-button>
                @endif
                @if($socialMedia['email'])
                    <x-button variant="fill" color="white" size="nopad" rounded="[50%]">
                        <a href="mailto:{{ $socialMedia['email'] }}">
                            <div class="w-[36px] h-[36px] flex p-2 justify-center items-center">
                                <img src="icons/email.svg" class="w-full h-full object-cover" />
                            </div>
                        </a>
                    </x-button>
                @endif
                @if($socialMedia['facebook'])
                    <x-button variant="fill" color="white" size="nopad" rounded="[50%]">
                        <a href="{{ $socialMedia['facebook'] }}" target="_blank" rel="noopener noreferrer">
                            <div class="w-[36px] h-[36px] flex p-2 justify-center items-center">
                                <img src="icons/fb.svg" class="w-full h-full object-cover" />
                            </div>
                        </a>
                    </x-button>
                @endif
            </div>
        </div>
    </div>
    <div class="text-center mt-2">
        <h3 class="text-lg font-semibold">{{ $name }}</h3>
        <p class="text-sm text-gray-600">{{ $position }}</p>
    </div>
</main>