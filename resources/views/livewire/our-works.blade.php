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




<main class="flex flex-col w-screen justify-center gap-0 p-4 md:p-8 lg:p-12 items-center bg-white md:bg-white-dark/20 ">
  <div class="w-full max-w-[1440px]">


    <main class="flex flex-col w-full items-center ">
      <main class="flex flex-col gap-4 w-full">
        <!-- Accordion sections -->
        <section class="flex flex-col w-full border-b border-gray-300">
          <!-- Accordion Header -->
          <div class=" flex justify-between w-full">
            <section class="flex flex-col">
              <div class="flex w-full justify-between">
                <p class="text-[24px] md:text-[32px] font-bold">Area of Works</p>
              </div>
            </section>
            <x-button variant="ghost" color="primary" size="medium" class="flex gap-2 items-center transition text-left"
              onclick="toggleAccordion('area-of-work')">
              <p class="text-[10px] md:text-[14px] font-semibold underline">Expand </p>
              <p class="transition-transform text-[10px] md:text-[14px] transform rotate-0" id="area-of-work-icon">
                ▼
              </p>
            </x-button>
          </div>
          <!-- Accordion Content (Initially Hidden) -->
          <div id="area-of-work"
            class="accordion-content max-h-0 overflow-hidden transition-all duration-500 ease-in-out  bg-gray-50">
            <!-- show this when expand -->
            <main class="p-4 md:p-6 lg:p-8">

              <section class="flex flex-col gap-6">
                @foreach ($areasofworks as $category => $tasks)
          <div div class="flex flex-col gap-2">
            <div class="flex gap-2 items-center ">
            <img src="icons/check.svg" class="hidden lg:inline" />
            <p class="text-[14px] lg:text-[16px] uppercase font-semibold underline">
              {{ str_replace('_', ' ', $category) }}:
            </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 pl-8">
            @foreach ($tasks as $task)
        <div class="flex gap-2 text-dark hover:text-primary cursor-pointer"
          onclick="scrollToIdWithOffset('{{ $task['id'] }}')">
          <div class="flex flex-col gap-1">
          <p class="text-[14px] lg:text-[16px] font-medium">{{ $task['name'] }}</p>
          <p class="md:inline hidden md:text-[12px] lg:text-[14px] font-light">{{ $task['desc'] }}</p>
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
        <p class="capitalize text-[8px] md:text-[14px] font-medium">
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
    <!-- paste -->

    <main class="flex flex-col w-full items-center pt-4 gap-4 md:gap-6 lg:gap-8" id="disaster-risk-reduction">

      <section class="flex w-full max-w-[1440px]">
        <div class="h-full flex flex-col gap-4 md:gap-8 lg:gap-0 lg:flex-row w-full justify-between  ">
          <div class="flex lg:min-w-[360px]">
            <div class="h-full  lg:h-full md:h-[360px]  lg:w-fit flex overflow-hidden">
              <img src="/images/disaster risk.JPG"
                class="rounded-md h-fit w-full lg:w-[360px] object-cover grow shrink basis-0" />
            </div>
            <div class="hidden lg:inline lg:w-[90px] h-full"></div>
          </div>

          <div class="flex flex-col md:gap-2 lg:gap-6 flex-1 self-stretch justify-start flex-grow">
            <div class="flex flex-col gap-2">
              <p class="text-primary font-medium">DISASTER RISK REDUCTION</p>

              <p class="font-bold text-[24px] md:text-[32px]">We Proactively Reduce Risk to Protect Lives and Secure Our
                Future.</p>
            </div>
            <p class="text-[12px] md:text-[14px] lg:text-[16px]">
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
                <p class="text-[12px] md:text-[14px] lg:text-[16px] font-medium">Capacity Building</p>
              </div>
              <div class="flex gap-2 items-center text-dark cursor-pointer hover:underline hover:text-primary">
                <div class="h-[10px] w-[10px] rounded-[50%] bg-primary"></div>
                <p class="text-[12px] md:text-[14px] lg:text-[16px] font-medium">Mitigation of Disaster Risk Areas</p>
              </div>
              <div class="flex gap-2 items-center text-dark cursor-pointer hover:underline hover:text-primary">
                <div class="h-[10px] w-[10px] rounded-[50%] bg-primary"></div>
                <p class="text-[12px] md:text-[14px] lg:text-[16px] font-medium">Disaster Literacy Education</p>
              </div>
              <div class="flex gap-2 items-center text-dark cursor-pointer hover:underline hover:text-primary">
                <div class="h-[10px] w-[10px] rounded-[50%] bg-primary"></div>
                <p class="text-[12px] md:text-[14px] lg:text-[16px] font-medium">Emergency Response Simulation</p>
              </div>
              <div class="flex gap-2 items-center text-dark cursor-pointer hover:underline hover:text-primary">
                <div class="h-[10px] w-[10px] rounded-[50%] bg-primary"></div>
                <p class="text-[12px] md:text-[14px] lg:text-[16px] font-medium">Disaster Response Village Set Up</p>
              </div>
            </div>
            <div>
            </div>
          </div>
        </div>
      </section>
      <!-- Emergency Response -->
      <section class="flex relative flex-col gap-4 md:gap-0  w-full items-center  overflow-hidden"
        id="emergency-response-plan">
        <img src="images/responseplan.JPG"
          class="static md:absolute top-0 left-auto w-full flex-1 h-full rounded-sm lg:rounded-none md:w-[30%] max-w-[480px] object-cover z-20  md:-z-10" />
        <main class="grid lg:grid-cols-2 gap-4 md:gap-8 lg:gap-16 w-full max-w-[1440px] z-20 ">

          <section class="flex flex-col  gap-8 lg:mb-12">
            <div class="md:max-w-[30%] lg:max-w-[60%] flex-col flex gap-2 md:gap-4">

              <p class="font-medium text-primary">EMERGENCY RESPONSE PLAN</p>
              <p class="font-bold  text-[24px] lg:text-[32px]  text-dark">Ready to respond, restore, and rebuild when
                disaster strikes</p>
            </div>
            <div class="rounded-lg md:bg-white/90 md:p-4 lg:p-12 flex flex-col gap-4">
              <p class="font-medium text-secondary capitalize" id="emergency-plan">emergency response plan</p>
              <p class="font-bold text-[16px] md:text-[24px]  text-dark">We're Committed to swift action—providing aid,
                securing
                communities, and
                reducing emergency impacts.</p>
              <p class="text-dark text-[16px]">DMC IKATEK-UNHAS focuses on Rescue, Evacuation, Body Searching (REBS),
                WASH,
                Food and
                Nutrition, and Shelter. The primary goal is to address safety, health, and property threats quickly and
                effectively, providing immediate aid and minimizing the impact of emergencies.
                <br />
                To date, the DMC IKATEK-UNHAS Rapid Response Team has conducted emergency response operations in 13
                disaster
                locations across 8 provinces.
              </p>
              <div class="md:w-fit w-full flex justify-center">
                <a href="/our-reach">
                  <x-button variant="fill" color="primary">
                    <p class="text-[10px] md:text-[12px] lg:text-[14px]">
                      View Our Reach
                    </p>
                  </x-button>
                </a>
              </div>
            </div>
          </section>

          <section class="md:bg-white/90 rounded-lg md:p-4 lg:p-12 h-max flex flex-col gap-2 md:gap-4">
            <p class="font-medium text-secondary capitalize" id="rehabilitation">Rehabilitation & Reconstruction</p>
            <p class="font-bold text-[16px] md:text-[24px]  text-dark">We're here to restore and strengthen communities,
              creating
              safer,
              more resilient lives after disaster. </p>
            <p class="text-dark text-[14px] md:text-[16px]">DMC IKATEK-UNHAS is committed to post-disaster
              Rehabilitation and
              Reconstruction to help affected communities recover and achieve better conditions than before.
            </p>
            <p class="font-semibold underline text-[14px] md:text-[16px] ">Our Key Goals Include:</p>
            <div class="w-full grid md:grid-cols-2">
              <div class="flex gap-1 md:gap-2 items-center md:items-start">
                <img src="icons/check.svg" class="h-3 w-3 md:h-5 md:w-5 md:mt-1" />
                <p class="font-light text-[10px] md:text-[14px]">Reducing post-disaster risks</p>
              </div>
              <div class="flex gap-1 md:gap-2 items-center md:items-start">
                <img src="icons/check.svg" class="h-3 w-3 md:h-5 md:w-5 md:mt-1" />
                <p class="font-light text-[10px] md:text-[14px]">Assisting economic recovery</p>
              </div>
              <div class="flex gap-1 md:gap-2 items-center md:items-start">
                <img src="icons/check.svg" class="h-3 w-3 md:h-5 md:w-5 md:mt-1" />
                <p class="font-light text-[10px] md:text-[14px]">Restoring safe, livable conditions</p>
              </div>
              <div class="flex gap-1 md:gap-2 items-center md:items-start">
                <img src="icons/check.svg" class="h-3 w-3 md:h-5 md:w-5 md:mt-1" />
                <p class="font-light text-[10px] md:text-[14px]">Social rehabilitation and recovery</p>
              </div>
              <div class="flex gap-1 md:gap-2 items-center md:items-start">
                <img src="icons/check.svg" class="h-3 w-3 md:h-5 md:w-5 md:mt-1" />
                <p class="font-light text-[10px] md:text-[14px]">Ensuring equality and sustainability</p>
              </div>
              <div class="flex gap-1 md:gap-2 items-center md:items-start">
                <img src="icons/check.svg" class="h-3 w-3 md:h-5 md:w-5 md:mt-1" />
                <p class="font-light text-[10px] md:text-[14px]">Supporting sustainable development</p>
              </div>
              <div class="flex gap-1 md:gap-2 items-center md:items-start">
                <img src="icons/check.svg" class="h-3 w-3 md:h-5 md:w-5 md:mt-1" />
                <p class="font-light text-[10px] md:text-[14px]">Strengthening community resilience</p>
              </div>
              <div class="flex gap-1 md:gap-2 items-center md:items-start">
                <img src="icons/check.svg" class="h-3 w-3 md:h-5 md:w-5 md:mt-1" />
                <p class="font-light text-[10px] md:text-[14px]">Enhancing disaster resilience</p>
              </div>
              <div class="flex gap-1 md:gap-2 items-center md:items-start">
                <img src="icons/check.svg" class="h-3 w-3 md:h-5 md:w-5 md:mt-1" />
                <p class="font-light text-[10px] md:text-[14px]">Building community capacity in disaster-prone areas.
                </p>
              </div>
            </div>
          </section>
        </main>
      </section>



      <!-- Education and Technology -->
      <section class="flex flex-col lg:gap-4 gap-8">

        <main id="education-and-technology" class="flex w-full justify-center ">
          <section class="flex flex-col-reverse  lg:grid lg:grid-cols-2 md:gap-8 lg:gap-16 w-full max-w-[1440px] ">

            <section class="flex flex-col gap-6">
              <div class="flex flex-col gap-2">
                <p class="text-primary font-medium">EDUCATION & TECHNOLOGY</p>

                <p class="font-bold text-[24px] md:text-[32px]">We Empower Communities Through Knowledge and Innovation
                  for a Resilient
                  Future.</p>
              </div>
              <p>
                Our Education & Technology initiatives aim to empower individuals and communities with the knowledge and
                skills needed to face disasters. Through scholarships, specialized training programs, and innovative
                tools,
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
                  <img src="images/management.jpeg" class="h-full object-cover rounded-lg" />
                </div>
              </div>
              <div class="flex flex-col h-full ">
                <div class="h-full ">
                  <img src="images/scholar.JPG" class="h-full object-cover rounded-lg" />
                </div>
                <div class="h-16 w-full">
                </div>
              </div>
            </section>
          </section>
        </main>

        <main class="flex w-full justify-center">
          <main class="flex w-full">

            <section class=" lg:px-16 lg:pb-16 grid grid-cols-1 md:grid-cols-2 md:gap-4 lg:gap-8 w-full ">
              <section class="md:bg-white/90 rounded-lg md:p-4 lg:p-12 h-max flex flex-col gap-4  ">
                <p class="font-bold text-[24px] text-dark" id="scholarship">Scholarship Program</p>
                <p class="text-[14px] leading-relaxed">
                  Education is a key focus for DMC IKATEK-UNHAS in supporting the government's SDGs. Our scholarship
                  program
                  aims to provide educational opportunities for underserved communities and foster human resource
                  development.
                </p>
                <div class="flex flex-col space-y-4 ">
                  <p class="font-semibold underline text-[14px]">Our Key Goals Include:</p>
                  <div class="w-full grid grid-cols-2 gap-y-2">
                    <div class="flex gap-2 items-start">
                      <img src="icons/check.svg" class="h-4 w-4 " />
                      <p class="font-light text-[10px] md:text-[12px]">Providing educational access to low-income
                        families.</p>
                    </div>
                    <div class="flex gap-2 items-start">
                      <img src="icons/check.svg" class="h-4 w-4 " />
                      <p class="font-light text-[10px] md:text-[12px]">Developing human resources.</p>
                    </div>
                    <div class="flex gap-2 items-start">
                      <img src="icons/check.svg" class="h-4 w-4 " />
                      <p class="font-light text-[10px] md:text-[12px]">Supporting academic achievement.</p>
                    </div>
                    <div class="flex gap-2 items-start">
                      <img src="icons/check.svg" class="h-4 w-4 " />
                      <p class="font-light text-[10px] md:text-[12px]">Enhancing specialized skills for students.</p>
                    </div>
                  </div>
                  <p class="font-semibold border-t-2 border-gray-200 pt-4 mt-4 underline text-[14px]">Expected Outcomes:
                  </p>
                  <div class="w-full grid grid-cols-2 gap-y-2">
                    <div class="flex gap-2 items-start">
                      <img src="icons/check.svg" class="h-4 w-4 " />
                      <p class="font-light text-[10px] md:text-[12px]">Improved access to education.</p>
                    </div>
                    <div class="flex gap-2 items-start">
                      <img src="icons/check.svg" class="h-4 w-4 " />
                      <p class="font-light text-[10px] md:text-[12px]">Increased career opportunities.</p>
                    </div>
                    <div class="flex gap-2 items-start">
                      <img src="icons/check.svg" class="h-4 w-4 " />
                      <p class="font-light text-[10px] md:text-[12px]">Contribution to social and economic development.
                      </p>
                    </div>
                    <div class="flex gap-2 items-start">
                      <img src="icons/check.svg" class="h-4 w-4 " />
                      <p class="font-light text-[10px] md:text-[12px]">Individual empowerment.</p>
                    </div>
                    <div class="flex gap-2 items-start">
                      <img src="icons/check.svg" class="h-4 w-4 " />
                      <p class="font-light text-[10px] md:text-[12px]">Encouragement of innovation and research.</p>
                    </div>
                    <div class="flex gap-2 items-start">
                      <img src="icons/check.svg" class="h-4 w-4 " />
                      <p class="font-light text-[10px] md:text-[12px]">Building networks and connections.</p>
                    </div>
                    <div class="flex gap-2 items-start">
                      <img src="icons/check.svg" class="h-4 w-4 " />
                      <p class="font-light text-[10px] md:text-[12px]">Recognition of achievement and potential.</p>
                    </div>
                  </div>

                </div>
              </section>

              <section class="rounded-lg md:bg-white/90 md:p-4 lg:p-12 h-max flex flex-col gap-4">
                <p class="font-bold text-[24px] text-dark" id="mst">Management System Training</p>
                <p class="text-[14px] leading-relaxed">
                  Through our “DMC IKATEK-UNHAS Teaching” program, we train vocational students and university students
                  in
                  management systems (All ISO series & SMK3) to prepare them for the skills and competencies needed in
                  Industry 4.0.
                </p>

                <div class="flex flex-col space-y-4">
                  <p class="font-semibold underline text-[14px]">Our Program Outcomes:</p>
                  <div class="w-full grid grid-cols-2 gap-y-2">
                    <div class="flex gap-2 items-start">
                      <img src="icons/check.svg" class="h-4 w-4 " />
                      <p class="font-light text-[10px] md:text-[12px]">Understanding management system principles.</p>
                    </div>
                    <div class="flex gap-2 items-start">
                      <img src="icons/check.svg" class="h-4 w-4 " />
                      <p class="font-light text-[10px] md:text-[12px]">Improving operational efficiency and
                        effectiveness.</p>
                    </div>
                    <div class="flex gap-2 items-start">
                      <img src="icons/check.svg" class="h-4 w-4 " />
                      <p class="font-light text-[10px] md:text-[12px]">Enhancing work quality and compliance.</p>
                    </div>
                    <div class="flex gap-2 items-start">
                      <img src="icons/check.svg" class="h-4 w-4 " />
                      <p class="font-light text-[10px] md:text-[12px]">Risk management and leadership skills.</p>
                    </div>
                    <div class="flex gap-2 items-start">
                      <img src="icons/check.svg" class="h-4 w-4 " />
                      <p class="font-light text-[10px] md:text-[12px]">Boosting communication, collaboration, and
                        adaptability.</p>
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
      </section>

    </main>
  </div>
</main>