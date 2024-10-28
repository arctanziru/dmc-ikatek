<?php

$areasofworks = [
  "Disaster Risk Reduction" => [
    [
      "name" => "Capacity Building",
      "id" => "capacity-building",
      "desc" => "Training to enhance DMC IKATEK-UNHAS members' and volunteers' skills for better effectiveness."

    ],
    [
      "name" => "Mitigation of Disaster Risk Areas",
      "id" => "mitigation",
      "desc" => "Stakeholder collaboration to reduce risks in vulnerable areas through a pentahelix approach."
    ],
    [
      "name" => "Disaster Literacy Education",
      "id" => "literacy-edu",
      "desc" => "Education to boost community preparedness, including the Gen-T program for students."
    ],
    [
      "name" => "Emergency Response Simulation",
      "id" => "emergency-simulation",
      "desc" => "Simulations with various parties to strengthen disaster response skills and readiness."
    ],
    [
      "name" => "Set Up Village for Disaster Response",
      "id" => "village-setup",
      "desc" => "The PRBBK program builds disaster-ready villages to enhance community resilience."
    ]
  ],

  "Emergency Response Plan" => [
    [
      "name" => "Emergency Response Plan",
      "id" => "emergency-plan",
      "desc" => "Quick DMC responses including rescue, evacuation, and housing support during emergencies."
    ],
    [
      "name" => "Rehabilitation & Reconstruction",
      "id" => "rehabilitation",
      "desc" => "Post-disaster recovery to restore communities, covering social and economic resilience."
    ]
  ],

  "Education And Technology" => [
    [
      "name" => "Scholarship",
      "id" => "scholarship",
      "desc" => "Scholarships for underprivileged students, supporting education and fostering achievement."
    ],
    [
      "name" => "Management System Training",
      "id" => "mst",
      "desc" => "Training on Industry 4.0 and ISO concepts for students entering the industrial workforce."
    ]
  ]
];


?>




<main class="flex flex-col w-screen justify-center gap-0">
  <main id="hero-section" class="relative p-16 max-h-screen flex justify-center items-center overflow-hidden">
    <!-- Background image -->
    <img src="images/hero.jpg" class="absolute top-0 left-0 w-full h-full object-cover -z-10" />

    <!-- Semi-transparent overlay -->
    <div class="absolute top-0 left-0 w-full h-full bg-[rgba(11,20,47,0.8)] -z-5"></div>
    <div
      class="absolute w-[856px] ight-[-428px] bottom-[-246px] rounded-[50%] blur-[200px]  bg-[rgba(220,134,48,0.33)] -z-5">
    </div>

    <!-- Content container (overlay on top of the background) -->
    <div id="hero-content" class="flex flex-col items-start gap-8 w-full z-10 max-w-[1440px] ">
      <!-- Main Content -->
      <section class="flex flex-col gap-3">
        <div class="flex gap-3 items-center">
          <div class="w-9 h-9 bg-secondary rounded-md"></div>
          <p class="text-[18px] text-white">
            DMC IKATEK-UH
          </p>
        </div>
        <div class="flex gap-3  items-center">
          <div class="w-[6px] h-[100px] bg-primary rounded-[10px_1px_1px_10px]">
          </div>
          <div class="flex flex-col ">
            <p class="text-[48px] font-poppins leading-[62px] font-semibold text-white">
              EXPLORE
            </p>
            <p class="text-[48px] font-poppins leading-[62px] font-semibold text-primary">
              OUR WORKS
            </p>
          </div>
        </div>

      </section>
    </div>
  </main>

  <main class="flex flex-col w-full items-center bg-white-dark/20">
    <main class="flex flex-col gap-4 px-16 pt-16 w-full max-w-[1440px]">
      <!-- Accordion sections -->
      <section class="flex flex-col w-full border-b border-gray-300">
        <!-- Accordion Header -->
        <div class=" flex justify-between w-full">
          <section class="flex flex-col">
            <div class="flex w-full justify-between">
              <p class="text-[32px] font-bold">Area of Works</p>
            </div>
          </section>
          <x-button variant="ghost" color="primary" size="medium" class="flex gap-2 items-center transition text-left"
            onclick="toggleAccordion('area-of-work')">
            <p class="text-[14px] font-semibold underline">Expand </p>
            <p class="transition-transform transform rotate-0" id="area-of-work-icon">
              ▼
            </p>
          </x-button>
        </div>
        <!-- Accordion Content (Initially Hidden) -->
        <div id="area-of-work"
          class="accordion-content max-h-0 overflow-hidden transition-all duration-500 ease-in-out  bg-gray-50">
          <!-- show this when expand -->
          <main class="p-8">

            <section class="flex flex-col gap-6">
              @foreach ($areasofworks as $category => $tasks)
          <div div class="flex flex-col gap-2">
          <div class="flex gap-2 items-center ">
            <img src="icons/check.svg" />
            <p class="text-[16px] uppercase font-semibold underline">{{ str_replace('_', ' ', $category) }}:</p>
          </div>

          <div class="grid grid-cols-2 gap-2 pl-8">
            @foreach ($tasks as $task)
        <div class="flex gap-2 text-dark hover:text-primary cursor-pointer"
        onclick="scrollToIdWithOffset('{{ $task['id'] }}')">
        <div class="flex flex-col gap-1">
          <p class="text-[16px] font-medium">{{ $task['name'] }}</p>
          <p class="text-[14px] font-light">{{ $task['desc'] }}</p>
        </div>
        </div>
      @endforeach

            <script>
            function scrollToIdWithOffset(id) {
              const element = document.getElementById(id);
              const yOffset = -100; // Adjust this value based on your navbar height
              const y = element.getBoundingClientRect().top + window.pageYOffset + yOffset;

              window.scrollTo({ top: y, behavior: 'smooth' });
            }
            </script>

          </div>
          </div>
        @endforeach

            </section>
          </main>
        </div>

      </section>
      <div class="flex gap-1">
        @foreach ($areasofworks as $category => $tasks)
      <x-button variant="ghost" color="dark" size="small"
        @click="document.getElementById('{{ strtolower(str_replace(' ', '-', $category)) }}').scrollIntoView({ behavior: 'smooth' })">
        <p class="capitalize text-[14px] font-medium">
        {{ $category }}
        </p>
      </x-button>
    @endforeach

      </div>
    </main>

  </main>

  <script>
    function toggleAccordion(id) {
      const content = document.getElementById(id);
      const icon = document.getElementById(id + '-icon');

      // Toggle max-height and rotate icon
      if (content.classList.contains('max-h-0')) {
        content.classList.remove('max-h-0');
        content.classList.add('max-h-screen');
        icon.classList.add('rotate-180');
      } else {
        content.classList.add('max-h-0');
        content.classList.remove('max-h-screen');
        icon.classList.remove('rotate-180');
      }
    }
  </script>


  <main class="flex flex-col w-full items-center bg-white-dark/20" id="disaster-risk-reduction">
    <section class="flex p-16 w-full max-w-[1440px]">
      <div class="h-full flex w-full justify-between ">
        <div class="flex  min-w-[520px]">
          <div class="h-full flex-1">
            <img src="images/placeholder.webp" class="rounded-md h-full object-cover grow shrink basis-0" />
          </div>
          <div class="w-[90px] h-full"></div>
        </div>

        <div class="flex flex-col gap-6  self-stretch justify-start flex-grow">
          <div class="flex flex-col gap-2">
            <p class="text-primary font-medium">DISASTER RISK REDUCTION</p>

            <p class="font-bold text-[32px]">We Proactively Reduce Risk to Protect Lives and Secure Our Future.</p>
          </div>
          <p>
            We take a proactive approach to reduce disaster risks. By providing training, educating communities,
            mitigating high-risk areas, and running emergency simulations, we empower local communities to respond
            effectively to crises and build resilience for the future.
            <br />
            Our approach to disaster risk reduction focuses on proactive steps to protect lives and strengthen
            communities.
          </p>
          <div class="flex flex-wrap gap-2">
            <div class="flex gap-2 items-center text-dark cursor-pointer hover:underline hover:text-primary">
              <div class="h-[10px] w-[10px] rounded-[50%] bg-primary"></div>
              <p class="text-[16px] font-medium">Capacity Building</p>
            </div>
            <div class="flex gap-2 items-center text-dark cursor-pointer hover:underline hover:text-primary">
              <div class="h-[10px] w-[10px] rounded-[50%] bg-primary"></div>
              <p class="text-[16px] font-medium">Mitigation of Disaster Risk Areas</p>
            </div>
            <div class="flex gap-2 items-center text-dark cursor-pointer hover:underline hover:text-primary">
              <div class="h-[10px] w-[10px] rounded-[50%] bg-primary"></div>
              <p class="text-[16px] font-medium">Disaster Literacy Education</p>
            </div>
            <div class="flex gap-2 items-center text-dark cursor-pointer hover:underline hover:text-primary">
              <div class="h-[10px] w-[10px] rounded-[50%] bg-primary"></div>
              <p class="text-[16px] font-medium">Emergency Response Simulation</p>
            </div>
            <div class="flex gap-2 items-center text-dark cursor-pointer hover:underline hover:text-primary">
              <div class="h-[10px] w-[10px] rounded-[50%] bg-primary"></div>
              <p class="text-[16px] font-medium">Disaster Response Village Set Up</p>
            </div>
          </div>
          <div>
            <x-button variant="outlined" color="primary" size="medium" rounded="none" class="flex items-center gap-2">
              <p class="text-[14px]">
                Read More
              </p>
            </x-button>
          </div>
        </div>
      </div>
    </section>

  </main>


  <!-- Emergency Response -->
  <main class="flex relative flex-col w-full items-center" id="emergency-response-plan">
    <img src="images/hero.jpg" class="absolute top-0 left-auto  w-[30%] max-w-[480px] h-full object-cover -z-10" />
    <div class="absolute top-0 left-0 w-full h-full bg-white-dark/20 -z-[15]"></div>
    <div class="absolute w-[856px] h-[720px] right-[-428px] bottom-[-246px] rounded-[50%] blur-[200px] -z-5">
    </div>
    <main class="grid grid-cols-2 gap-16 p-16 w-full max-w-[1440px] z-20 ">

      <section class="flex flex-col  gap-8 mb-12">
        <div class="max-w-[60%] flex-col flex gap-4">

          <p class="font-medium text-primary">EMERGENCY RESPONSE PLAN</p>
          <p class="font-bold text-[32px] leading-[40px]  text-dark">Ready to respond, restore, and rebuild when
            disaster strikes</p>
        </div>
        <div class="bg-white/90 rounded-lg p-12 flex flex-col gap-4">
          <p class="font-medium text-secondary capitalize" id="emergency-plan">emergency response plan</p>
          <p class="font-bold text-[24px]  text-dark">We're Committed to swift action—providing aid, securing
            communities, and
            reducing emergency impacts.</p>
          <p class="text-dark text-[16px]">DMC IKATEK-UNHAS focuses on Rescue, Evacuation, Body Searching (REBS), WASH,
            Food and
            Nutrition, and Shelter. The primary goal is to address safety, health, and property threats quickly and
            effectively, providing immediate aid and minimizing the impact of emergencies.
            <br />
            To date, the DMC IKATEK-UNHAS Rapid Response Team has conducted emergency response operations in 13 disaster
            locations across 8 provinces.
          </p>
          <div>
            <x-button variant="fill" color="primary">
              <p class="text-[14px]">
                View Our Reach
              </p>
            </x-button>
          </div>
        </div>
      </section>

      <section class="bg-white/90 rounded-lg p-12 h-max flex flex-col gap-4">
        <p class="font-medium text-secondary capitalize" id="rehabilitation">Rehabilitation & Reconstruction</p>
        <p class="font-bold text-[24px]  text-dark">We're here to restore and strengthen communities, creating safer,
          more resilient lives after disaster. </p>
        <p class="text-dark text-[16px]">DMC IKATEK-UNHAS is committed to post-disaster Rehabilitation and
          Reconstruction to help affected communities recover and achieve better conditions than before.
        </p>
        <p class="font-semibold underline ">Our Key Goals Include:</p>
        <div class="w-full grid grid-cols-2">
          <div class="flex gap-2 items-start">
            <img src="icons/check.svg" class="h-5 w-5 mt-1" />
            <p class="font-light text-[14px]">Reducing post-disaster risks</p>
          </div>
          <div class="flex gap-2 items-start">
            <img src="icons/check.svg" class="h-5 w-5 mt-1" />
            <p class="font-light text-[14px]">Assisting economic recovery</p>
          </div>
          <div class="flex gap-2 items-start">
            <img src="icons/check.svg" class="h-5 w-5 mt-1" />
            <p class="font-light text-[14px]">Restoring safe, livable conditions</p>
          </div>
          <div class="flex gap-2 items-start">
            <img src="icons/check.svg" class="h-5 w-5 mt-1" />
            <p class="font-light text-[14px]">Social rehabilitation and recovery</p>
          </div>
          <div class="flex gap-2 items-start">
            <img src="icons/check.svg" class="h-5 w-5 mt-1" />
            <p class="font-light text-[14px]">Ensuring equality and sustainability</p>
          </div>
          <div class="flex gap-2 items-start">
            <img src="icons/check.svg" class="h-5 w-5 mt-1" />
            <p class="font-light text-[14px]">Supporting sustainable development</p>
          </div>
          <div class="flex gap-2 items-start">
            <img src="icons/check.svg" class="h-5 w-5 mt-1" />
            <p class="font-light text-[14px]">Strengthening community resilience</p>
          </div>
          <div class="flex gap-2 items-start">
            <img src="icons/check.svg" class="h-5 w-5 mt-1" />
            <p class="font-light text-[14px]">Enhancing disaster resilience</p>
          </div>
          <div class="flex gap-2 items-start">
            <img src="icons/check.svg" class="h-5 w-5 mt-1" />
            <p class="font-light text-[14px]">Building community capacity in disaster-prone areas.</p>
          </div>
        </div>
      </section>
    </main>
  </main>

  <!-- Education and Technology -->
  <main class="flex flex-col bg-white-dark/20">

    <main id="education-and-technology" class="flex w-full justify-center ">
      <section class=" p-16 grid grid-cols-2 gap-16 w-full max-w-[1440px] ">

        <section class="flex flex-col gap-6">
          <div class="flex flex-col gap-2">
            <p class="text-primary font-medium">EDUCATION & TECHNOLOGY</p>

            <p class="font-bold text-[32px]">We Empower Communities Through Knowledge and Innovation for a Resilient
              Future.</p>
          </div>
          <p>
            Our Education & Technology initiatives aim to empower individuals and communities with the knowledge and
            skills needed to face disasters. Through scholarships, specialized training programs, and innovative tools,
            we help build a culture of preparedness and resilience, equipping people to respond effectively to
            challenges.
            <br />
            By equipping communities with these resources, we are building a culture of readiness and resilience,
            ensuring a safer, more informed future for all.
          </p>

        </section>

        <section class="grid grid-cols-2 gap-4 ">
          <div class="flex flex-col h-full ">
            <div class="h-16 w-full">
            </div>
            <div class="h-full ">
              <img src="images/MST.webp" class="h-full object-cover rounded-lg" />
            </div>
          </div>
          <div class="flex flex-col h-full ">
            <div class="h-full ">
              <img src="images/Scholar.webp" class="h-full object-cover rounded-lg" />
            </div>
            <div class="h-16 w-full">
            </div>
          </div>
        </section>
      </section>
    </main>

    <main class="flex w-full justify-center">
      <main class="flex w-full max-w-[1440px]">

        <section class=" px-16 pb-16 grid grid-cols-2 gap-8 w-full max-w-[1440px] ">
          <section class="bg-white/90 rounded-lg p-12 h-max flex flex-col gap-4  ">
            <p class="font-bold text-[24px] text-dark" id="scholarship">Scholarship Program</p>
            <p class="text-[14px] leading-relaxed">
              Education is a key focus for DMC IKATEK-UNHAS in supporting the government's SDGs. Our scholarship program
              aims to provide educational opportunities for underserved communities and foster human resource
              development.
            </p>
            <div class="flex flex-col space-y-4 ">
              <p class="font-semibold underline text-[14px]">Our Key Goals Include:</p>
              <div class="w-full grid grid-cols-2 gap-y-2">
                <div class="flex gap-2 items-start">
                  <img src="icons/check.svg" class="h-4 w-4 " />
                  <p class="font-light text-[12px]">Providing educational access to low-income families.</p>
                </div>
                <div class="flex gap-2 items-start">
                  <img src="icons/check.svg" class="h-4 w-4 " />
                  <p class="font-light text-[12px]">Developing human resources.</p>
                </div>
                <div class="flex gap-2 items-start">
                  <img src="icons/check.svg" class="h-4 w-4 " />
                  <p class="font-light text-[12px]">Supporting academic achievement.</p>
                </div>
                <div class="flex gap-2 items-start">
                  <img src="icons/check.svg" class="h-4 w-4 " />
                  <p class="font-light text-[12px]">Enhancing specialized skills for students.</p>
                </div>
              </div>
              <p class="font-semibold border-t-2 border-gray-200 pt-4 mt-4 underline text-[14px]">Expected Outcomes:</p>
              <div class="w-full grid grid-cols-2 gap-y-2">
                <div class="flex gap-2 items-start">
                  <img src="icons/check.svg" class="h-4 w-4 " />
                  <p class="font-light text-[12px]">Improved access to education.</p>
                </div>
                <div class="flex gap-2 items-start">
                  <img src="icons/check.svg" class="h-4 w-4 " />
                  <p class="font-light text-[12px]">Increased career opportunities.</p>
                </div>
                <div class="flex gap-2 items-start">
                  <img src="icons/check.svg" class="h-4 w-4 " />
                  <p class="font-light text-[12px]">Contribution to social and economic development.</p>
                </div>
                <div class="flex gap-2 items-start">
                  <img src="icons/check.svg" class="h-4 w-4 " />
                  <p class="font-light text-[12px]">Individual empowerment.</p>
                </div>
                <div class="flex gap-2 items-start">
                  <img src="icons/check.svg" class="h-4 w-4 " />
                  <p class="font-light text-[12px]">Encouragement of innovation and research.</p>
                </div>
                <div class="flex gap-2 items-start">
                  <img src="icons/check.svg" class="h-4 w-4 " />
                  <p class="font-light text-[12px]">Building networks and connections.</p>
                </div>
                <div class="flex gap-2 items-start">
                  <img src="icons/check.svg" class="h-4 w-4 " />
                  <p class="font-light text-[12px]">Recognition of achievement and potential.</p>
                </div>
              </div>

            </div>
          </section>

          <section class="bg-white/90 rounded-lg p-12 h-max flex flex-col gap-4">
            <p class="font-bold text-[24px] text-dark" id="mst">Management System Training</p>
            <p class="text-[14px] leading-relaxed">
              Through our “DMC IKATEK-UNHAS Teaching” program, we train vocational students and university students in
              management systems (All ISO series & SMK3) to prepare them for the skills and competencies needed in
              Industry 4.0.
            </p>

            <div class="flex flex-col space-y-4">
              <p class="font-semibold underline text-[14px]">Our Program Outcomes:</p>
              <div class="w-full grid grid-cols-2 gap-y-2">
                <div class="flex gap-2 items-start">
                  <img src="icons/check.svg" class="h-4 w-4 " />
                  <p class="font-light text-[12px]">Understanding management system principles.</p>
                </div>
                <div class="flex gap-2 items-start">
                  <img src="icons/check.svg" class="h-4 w-4 " />
                  <p class="font-light text-[12px]">Improving operational efficiency and effectiveness.</p>
                </div>
                <div class="flex gap-2 items-start">
                  <img src="icons/check.svg" class="h-4 w-4 " />
                  <p class="font-light text-[12px]">Enhancing work quality and compliance.</p>
                </div>
                <div class="flex gap-2 items-start">
                  <img src="icons/check.svg" class="h-4 w-4 " />
                  <p class="font-light text-[12px]">Risk management and leadership skills.</p>
                </div>
                <div class="flex gap-2 items-start">
                  <img src="icons/check.svg" class="h-4 w-4 " />
                  <p class="font-light text-[12px]">Boosting communication, collaboration, and adaptability.</p>
                </div>
              </div>

              <p class="text-[14px]">
                With these training concepts, DMC IKATEK-UNHAS aims to create a roadmap to success for students
                and future professional
              </p>
            </div>
          </section>
        </section>
      </main>


    </main>
  </main>
</main>