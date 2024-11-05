@php
  $teamMembers = [
    [
    'name' => 'John Doe',
    'position' => 'Leader',
    'img' => 'https://upload.wikimedia.org/wikipedia/commons/7/7f/Hashimoto_Kanna_at_Opening_Ceremony_of_the_30th_TIFF_2017_trim_01.jpg',
    'social_media' => [
      'x' => 'https://x.com/johndoe',
      'facebook' => 'https://facebook.com/johndoe',
      'instagram' => 'https://www.instagram.com/dmcikatek.uh/',
      'email' => 'johndoe@example.com'
    ]
    ],
    [
    'name' => 'John Doe',
    'position' => 'High Officer',
    'img' => 'https://upload.wikimedia.org/wikipedia/commons/7/7f/Hashimoto_Kanna_at_Opening_Ceremony_of_the_30th_TIFF_2017_trim_01.jpg',
    'social_media' => [
      'x' => 'https://x.com/johndoe',
      'facebook' => 'https://facebook.com/johndoe',
      'instagram' => 'https://www.instagram.com/dmcikatek.uh/',
      'email' => 'johndoe@example.com'
    ]
    ],
    [
    'name' => 'John Doe',
    'position' => 'High Officer',
    'img' => 'https://upload.wikimedia.org/wikipedia/commons/7/7f/Hashimoto_Kanna_at_Opening_Ceremony_of_the_30th_TIFF_2017_trim_01.jpg',
    'social_media' => [
      'x' => 'https://x.com/johndoe',
      'facebook' => 'https://facebook.com/johndoe',
      'instagram' => 'https://www.instagram.com/dmcikatek.uh/',
      'email' => 'johndoe@example.com'
    ]
    ],
    [
    'name' => 'John Doe',
    'position' => 'High Officer',
    'img' => 'https://upload.wikimedia.org/wikipedia/commons/7/7f/Hashimoto_Kanna_at_Opening_Ceremony_of_the_30th_TIFF_2017_trim_01.jpg',
    'social_media' => [
      'x' => 'https://x.com/johndoe',
      'facebook' => 'https://facebook.com/johndoe',
      'instagram' => 'https://www.instagram.com/dmcikatek.uh/',
      'email' => 'johndoe@example.com'
    ]
    ],
    [
    'name' => 'John Doe',
    'position' => 'Member',
    'img' => 'https://upload.wikimedia.org/wikipedia/commons/7/7f/Hashimoto_Kanna_at_Opening_Ceremony_of_the_30th_TIFF_2017_trim_01.jpg',
    'social_media' => [
      'x' => 'https://x.com/johndoe',
      'facebook' => 'https://facebook.com/johndoe',
      'instagram' => 'https://www.instagram.com/dmcikatek.uh/',
      'email' => 'johndoe@example.com'
    ]
    ],
    [
    'name' => 'John Doe',
    'position' => 'Member',
    'img' => 'https://upload.wikimedia.org/wikipedia/commons/7/7f/Hashimoto_Kanna_at_Opening_Ceremony_of_the_30th_TIFF_2017_trim_01.jpg',
    'social_media' => [
      'x' => 'https://x.com/johndoe',
      'facebook' => 'https://facebook.com/johndoe',
      'instagram' => 'https://www.instagram.com/dmcikatek.uh/',
      'email' => 'johndoe@example.com'
    ]
    ],
    [
    'name' => 'John Doe',
    'position' => 'Member',
    'img' => 'https://upload.wikimedia.org/wikipedia/commons/7/7f/Hashimoto_Kanna_at_Opening_Ceremony_of_the_30th_TIFF_2017_trim_01.jpg',
    'social_media' => [
      'x' => 'https://x.com/johndoe',
      'facebook' => 'https://facebook.com/johndoe',
      'instagram' => 'https://www.instagram.com/dmcikatek.uh/',
      'email' => 'johndoe@example.com'
    ]
    ]
  ];


@endphp

<main class="flex flex-col w-full max-w-[1440px] p-4 md:p-8 lg:p-12">

  <section id="the-team" class="w-full flex flex-col gap-12">
    <div class="flex flex-col gap-2">
      <p class="text-[48px] font-bold text-dark w-full text-center">
        Organization & <span class="text-[48px] font-bold text-primary">
          Leadership
        </span>
      </p>
      <p class="text-[24px] font-semibold text-dark w-full text-center">
        MEET THE TEAM
      </p>
    </div>
    <div class="w-full flex flex-col gap-4 items-center">
      <!-- Leader Section -->
      <section class="w-full flex justify-center">
        @foreach ($teamMembers as $member)
      @if ($member['position'] === 'Leader')
      <x-team-card :name="$member['name']" :position="$member['position']" :img="$member['img']"
      :social-media="$member['social_media']" />
    @endif
    @endforeach
      </section>

      <!-- High Officer Section -->
      <section class="w-max gap-12 grid grid-cols-3" id="high-rank">
        @foreach ($teamMembers as $member)
      @if ($member['position'] === 'High Officer')
      <x-team-card :name="$member['name']" :position="$member['position']" :img="$member['img']"
      :social-media="$member['social_media']" />
    @endif
    @endforeach
      </section>

      <!-- Member Section -->
      <section class="w-max gap-12 grid grid-cols-3 justify-center" id="member">
        @foreach ($teamMembers as $member)
      @if ($member['position'] === 'Member')
      <x-team-card :name="$member['name']" :position="$member['position']" :img="$member['img']"
      :social-media="$member['social_media']" />
    @endif
    @endforeach
      </section>
    </div>


  </section>
</main>