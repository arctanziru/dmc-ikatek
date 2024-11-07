@php

@endphp

<main class="p-4 md:p-8 lg:p-12 flex flex-col items-center justify-center bg-white-dark/20">
    <main class="w-full flex max-w-[1440px] gap-4 flex-col">
        <div class="w-full flex gap-4 md:gap-6 lg:gap-8 flex-col lg:flex-row ">
            <section class="w-full flex flex-col gap-4">
                <div class="w-full relative h-[180px] rounded-md md:h-[360px] bg-secondary/30 flex overflow-hidden ">
                    <img src="{{ $news->image }}" class="w-full h-full object-cover" />
                    <div
                        class="absolute w-full flex-col h-full bg-transparent md:bg-dark/40 top-0 left-0 p-8 hidden md:flex justify-end items-start">
                        <p class="text-[36px] max-w-[640px] font-bold text-white">
                            {{ $news->title }}
                        </p>
                        <p class="text-white font-light md:text-[14px] lg:text-[16px] flex items-center gap-2">
                            <x-bladewind::icon name="calendar-days" class="!h-4 !w-4" />
                            @if ($news->created_at->eq($news->updated_at))
                                {{ $news->created_at->format('d M Y - H:i') }}
                            @else
                                {{ $news->created_at->format('d M Y - H:i') }} (Last edited:
                                {{ $news->updated_at->format('d M Y - H:i') }})
                            @endif
                        </p>
                    </div>
                </div>
                <p class="text-[24px] md:text-[30px] lg:text-[36px] max-w-[640px] font-bold text-dark inline md:hidden">
                    {{ $news->title }}
                </p>
                <div class="w-full flex flex-col justify-between">

                    <div class="prose max-w-full text-[14px] md:text-[16px]">
                        <x-bladewind::icon name="user-circle" class="!h-5 !w-5" />

                        {!! $news->author !!}
                    </div>
                    <p
                        class="text-dark font-light text-[12px] md:hidden md:text-[14px] lg:text-[16px] flex items-start gap-2">
                        <x-bladewind::icon name="calendar-days" class="!h-5 !w-5" />
                        @if ($news->created_at->eq($news->updated_at))
                            {{ $news->created_at->format('d M Y - H:i') }}
                        @else
                            {{ $news->created_at->format('d M Y - H:i') }} (Last edited:
                            {{ $news->updated_at->format('d M Y - H:i') }})
                        @endif
                    </p>
                </div>
                <div class="prose max-w-full text-[16px]">

                    <p class="text-[16px] md:text-[20px] font-bold">
                        Description :
                    </p>

                    <p class="text-[12px] md:text-[16px]">
                        {!! $news->description !!}
                    </p>
                </div>
                <article class="max-w-full text-[12px] md:text-[16px] md:text-left text-justify">
                    <p class="text-[16px] md:text-[20px] font-bold">Article :</p>
                    <article>
                        {!! $news->content !!}
                    </article>
                </article>
                <section class="flex flex-col gap-4 w-full">
                    <div class="font-medium text-[16px] lg:text-[20px] w-fit flex gap-4 items-center">
                        <div class="w-1 min-h-8 lg:min-h-12 h-full bg-primary">

                        </div>
                        <p class=" text-dark">
                            See Latest News
                        </p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 w-full gap-1">
                        @foreach ($recentNews as $posts)
                            <a
                                class="hover:bg-dark/20 p-2 md:p-4 shadow-[0px_0px_1px_0px] lg:shadow-none shadow-dark/20 lg:p-2 cursor-pointer rounded-sm flex-col flex gap-2">
                                <div class="w-full h-[160px] bg-dark/20 rounded-md overflow-hidden">
                                    <img src={{ asset($posts->image) }} class="w-full h-full object-cover" />
                                </div>
                                <div class="flex flex-col">
                                    <p class="text-[12px] font-light text-ellipsis line-clamp-2">
                                        {{$posts->author}}
                                    </p>
                                    <p class="text-ellipsis line-clamp-2">
                                        {{$posts->title}}
                                    </p>
                                    <p class="text-[10px] font-light flex gap-1 items-center ">
                                        <x-bladewind::icon name="calendar-days" class="!h-3 !w-3" />
                                        {{ $posts->created_at->format('d M Y - H:i') }}
                                    </p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </section>
            </section>
            <section class="sticky top-[80px] flex flex-col w-full h-fit lg:w-fit">
                <aside class="lg:w-[320px] flex flex-col gap-4 w-full">
                    <div
                        class="font-medium text-[16px] lg:text-[20px] w-fit flex gap-4 lg:bg-dark lg:w-full items-center">
                        <div class="w-1 min-h-8 lg:min-h-12 h-full bg-primary"></div>
                        <p class="lg:text-white text-dark">
                            Author's Recent Works
                        </p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 w-full lg:flex lg:flex-col gap-1">
                        @if ($recentAuthorPosts->isEmpty())
                            <div
                                class="hover:bg-dark/20 p-2 md:p-4 shadow-[0px_0px_1px_0px] lg:shadow-none shadow-dark/20 lg:p-2 cursor-pointer rounded-sm flex-col lg:flex-row flex gap-2">
                                <div>
                                    No Other Post
                                </div>
                            </div>
                        @else
                            @foreach ($recentAuthorPosts as $posts)
                                <a href="/news/{{$posts->id}}"
                                    class="hover:bg-dark/20 p-2 md:p-4 shadow-[0px_0px_1px_0px] lg:shadow-none shadow-dark/20 lg:p-2 cursor-pointer rounded-sm flex-col lg:flex-row flex gap-2">
                                    <div
                                        class="w-full h-[160px] md:h-[160px] lg:!w-16 lg:!h-16 bg-dark/20 rounded-md overflow-hidden">
                                        <img src="{{ asset($posts->image) }}" class="w-full h-full object-cover" />
                                    </div>
                                    <div class="flex flex-col">
                                        <p class="text-[12px] font-light text-ellipsis line-clamp-2">
                                            {{ $posts->author }}
                                        </p>
                                        <p class="text-ellipsis line-clamp-2">
                                            {{ $posts->title }}
                                        </p>
                                        <p class="text-[10px] font-light flex gap-1 items-center">
                                            <x-bladewind::icon name="calendar-days" class="!h-3 !w-3" />
                                            {{ $posts->created_at->format('d M Y - H:i') }}
                                        </p>
                                    </div>
                                </a>
                            @endforeach
                        @endif
                    </div>
                </aside>
            </section>

        </div>

    </main>
</main>