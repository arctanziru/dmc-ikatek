<main class="w-full flex justify-center">
  <main class="max-w-[1440px] flex gap-12 flex-col p-4 md:p-8 lg:p-12 ">

    <section
      class="w-full flex justify between sm:gap-4 md:gap-8 lg:gap-24 md:flex-start lg:items-end  flex-col lg:flex-row">

      <p class=" text-[48px] leading-[56px] font-bold text-secondary flex-1 min-w-[240px] ">
        Where We <br /> Work
      </p>
      <p class="text-[16px] lg:text-[18px] text-secondary">
        DMC IKATEK-UH operates across {{ $totalCities }} regions within {{ $totalProvinces }} provinces, providing
        critical assistance in times of
        disaster
        and working to build sustainable and resilient communities. We deliver life-saving support during emergencies
        and engage in long-term efforts to strengthen disaster preparedness and risk reduction, striving to create safer
        and more resilient environments.
      </p>
    </section>
    <section class="w-full justify-center flex">
      <div class="flex gap-2 md:gap-4 lg:gap-8 items-center ">
        <p class="text-dark font-poppins text-[24px] md:text-[36px] lg:text-[48px] font-normal">
          <span class="text-[24px] md:text-[36px] lg:text-[48px] font-bold">{{ $totalProvinces }}</span>
          Province{{ $totalProvinces > 1 ? 's' : '' }}
        </p>
        <div class="self-stretch w-[2px] bg-dark"></div>
        <p class="text-dark font-poppins text-[24px] md:text-[36px] lg:text-[48px] font-normal">
          <span class="text-[24px] md:text-[36px] lg:text-[48px] font-bold">{{ $totalCities }}</span>
          Region{{ $totalCities > 1 ? 's' : '' }}
        </p>
      </div>
    </section>
    <section class=" w-full flex">
      <iframe title="Rescue and Relief Distribution Map" aria-label="Map" id="datawrapper-chart-wAZge"
        src="https://datawrapper.dwcdn.net/wAZge/1/" scrolling="no" frameborder="0"
        style="width: 100%; min-width: 100% !important; border: none;" height="256" data-external="1"></iframe>
      <script type="text/javascript">
        ! function () {
          "use strict";
          window.addEventListener("message", (function (a) {
            if (void 0 !== a.data["datawrapper-height"]) {
              var e = document.querySelectorAll("iframe");
              for (var t in a.data["datawrapper-height"])
                for (var r = 0; r < e.length; r++)
                  if (e[r].contentWindow === a.source) {
                    var i = a.data["datawrapper-height"][t] + "px";
                    e[r].style.height = i
                  }
            }
          }))
        }();
      </script>
    </section>

    <section id="our-region" class="flex flex-col gap-2 md:gap-4 lg:gap-8">
      <div class="flex gap-4 w-full justify-center md:justify-start text-primary">
        <p>
          <span class="text-[20px] md:text-[24px] w-full font-bold">Our Regions :</span>
        </p>
      </div>
      <main class=" md:px-4 lg:px-0 overflow-hidden transition-all duration-500 ease-in-out ">
        <!-- Content to show when expanded -->
        <main class="">
          <section class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 lg:gap-6">
            @foreach($provincesWithCities as $province => $cities)
        <div class="flex flex-col lg:gap-2">
          <div class="flex gap-2 items-center">
          <img src="icons/check.svg" class="hidden lg:inline" />
          <p class="text-[14px] lg:text-[18px] uppercase font-bold">{{ $province }}:</p>
          </div>

          <div class="flex-flex-col gap-2 pl-2 md:pl-4 lg:pl-8">
          @foreach($cities as $city)
        <div class="flex gap-2 text-dark hover:text-primary cursor-pointer"
        wire:click="redirectToPrograms({{ $city['covered_area_id'] }})">
        <div class="flex flex-col gap-1">
        <p class="text-[12px] lg:text-[16px] font-normal">
          <!-- City ID: {{ $city['city_id'] }} -->
          - {{ $city['name'] }}
        </p>
        </div>
        </div>
      @endforeach
          </div>
        </div>
      @endforeach


          </section>
        </main>
      </main>

    </section>


  </main>
</main>