<x-web-layout>

    <!-- Hero Section -->
    <section class="flex items-center pt-[180px] lg:pt-[230px]">
        <div class="container 2xl:max-w-screen-2xl mx-auto px-4 h-full">
            <div
                class=""
                data-aos="zoom-in"
                data-aos-duration="1000"
                data-aos-easing="linear"
            >
                <img class="mx-auto" src="./images/calendar-globe.png" alt="" />
            </div>
        </div>
    </section>
    <!-- Hero Section -->

    <!-- Lets Talk -->
    <section class="pt-8 lg:pt-24">
        <div class="container mx-auto px-4 2xl:max-w-[1530px]">
            <div
                style="background-image: url(./images/lets-talk-bg.png)"
                class="h-80 md:h-[270px] overflow-hidden relative bg-right bg-no-repeat bg-cover w-full"
                data-aos="fade-up" data-aos-duration="1000" data-aos-easing="linear"
            >
                <div
                    style="
              background: linear-gradient(
                269.98deg,
                rgba(90, 81, 78, 0.89) 0.02%,
                rgba(90, 81, 78, 0.89) 100.56%,
                rgba(90, 81, 78, 0) 100.23%,
                rgba(90, 81, 78, 0.89) 99.98%,
                rgba(90, 81, 78, 0) 99.99%
              );
              transform: matrix(-1, 0, 0, 1, 0, 0);
            "
                    class="positi absolute top-0 left-0 right-0 bottom-0 z-0 w-full h-full"
                ></div>
                <div
                    class="absolute z-[1] sm:bottom-10 pr-4 bottom-4 left-4 sm:left-10"
                >
                    <div class="flex gap-3 sm:gap-5 items-center">
                        <h1 class="text-white text-xl sm:text-[40px]">
                            Hello Lets talk !!
                        </h1>
                        <img
                            class="sm:w-auto w-[30px]"
                            src="./images/Hand-shake.png"
                            alt=""
                        />
                    </div>
                    <p class="text-sm sm:text-[18px] mt-2 leading-10 text-[#F5EFE7]">
                        We offer a range of services that are sure to meet your needs,
                        whether you're looking for a <br />
                        one-time service or a recurring service, we're here to help and
                        available 24 hours a day.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- Lets Talk -->

    <!-- Main Content -->
    <section class="mt-8">
        <div class="container mx-auto px-4 2xl:max-w-[1530px]">
            <div class="flex lg:flex-row flex-col gap-8 h-full w-full">
                <div class="w-full lg:w-8/12"  data-aos="fade-left" data-aos-duration="1000" data-aos-easing="linear">
                    <div>
                        <form action="{{ route('booking.store') }}" method="post" class="space-y-4">
                            @csrf
                            <input type="hidden" name="slot_id" value="{{ $slot_id }}">
                            <div class="space-y-1">
                                <label for="name" class="text-[#5F5F5F] text-sm font-semibold">Name</label>
                                <input type="text" name="client_name" id="name" class="bg-[#ece6de73] block p-3.5 w-full z-20 text-sm text-gray-900 border border-transparent focus:ring-[#F5931E] focus:border-[#F5931E]" required>
                            </div>

                            <div class="space-y-1">
                                <label for="email" class="text-[#5F5F5F] text-sm font-semibold">Email</label>
                                <input type="email" id="email" name="client_email" class="bg-[#ece6de73] block p-3.5 w-full z-20 text-sm text-gray-900 border border-transparent focus:ring-[#F5931E] focus:border-[#F5931E]" required>
                            </div>

                            <div class="space-y-1">
                                <label for="message" class="text-[#5F5F5F] text-sm font-semibold">Add Guests Email (s) </label>
                                <textarea id="message" name="guest_emails" rows="4" class="bg-[#ece6de73] block p-3.5 w-full z-20 text-sm text-gray-900 border border-transparent focus:ring-[#F5931E] focus:border-[#F5931E]" required></textarea>
                                <p class="ml-auto text-sm text-[#5f5f5f78]">Notify up to 10 additional guests of the scheduled event.</p>
                            </div>

                            <div class="">
                                <div x-data="{ countryCode: '+1', isDropdownOpen: false, countryFlags: { '+1': 'us', '+44': 'gb-eng', '+91': 'in' } }" @click.away="isDropdownOpen = false" >
                                    <div class="relative space-y-1" class="">
                                        <label for="message" class="text-[#5F5F5F] text-sm font-semibold">Phone Number</label>
                                        <div class="flex items-center bg-[#ece6de73] ">
                                            <div class="relative max-w-[130px] w-full">
                                                <button x-on:click="isDropdownOpen = !isDropdownOpen" type="button" class="p-3.5 bg-[#ece6de73]  border-primary flex justify-between items-center gap-2 w-full">
                                                    <div>
                                                        <span class=" flag-icon" :class="'flag-icon-' + countryFlags[countryCode]"></span>
                                                        <span  x-text="countryCode"></span>
                                                        <input type="hidden" name="country_code" x-model="countryCode">
                                                    </div>

                                                    <span class="">
                                                <svg class="w-2.5 h-2.5 text-[#5a514e9e]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                                                    </svg>
                                            </span>
                                                </button>
                                                <div x-show="isDropdownOpen" x-transition:enter="fade" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="fade" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute z-[99] w-64 mt-2 overflow-y-auto bg-white rounded-md shadow-lg">
                                                    <ul class="max-h-40 overflow-y-auto">
                                                        <li x-on:click="countryCode = '+1'; isDropdownOpen = false" class="flex items-center p-2 cursor-pointer transition-all duration-300 hover:bg-gray-200">
                                                            <span class="flag-icon flag-icon-us mr-2"></span>
                                                            +1 (USA)
                                                        </li>
                                                        <li x-on:click="countryCode = '+44'; isDropdownOpen = false" class="flex items-center p-2 cursor-pointer transition-all duration-300 hover:bg-gray-200">
                                                            <span class="flag-icon flag-icon-gb-eng mr-2"></span>
                                                            +44 (UK)
                                                        </li>
                                                        <li x-on:click="countryCode = '+91'; isDropdownOpen = false" class="flex items-center p-2 cursor-pointer transition-all duration-300 hover:bg-gray-200">
                                                            <span class="flag-icon flag-icon-in mr-2"></span>
                                                            +91 (India)
                                                        </li>

                                                        <!-- Add more country options as needed -->
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="bg-[#DEDEDE] w-0.5 h-5">
                                            </div>
                                            <input type="number" name="client_number" id="search-dropdown" class="bg-[#ece6de73] block p-3.5 w-full z-20 text-sm text-gray-900 border border-transparent focus:ring-[#F5931E] focus:border-[#F5931E]" placeholder="Number" required>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="flex justify-end items-center">
                                <button type="submit" class="inline-flex items-center gap-2 group text-[#5A514E] font-bold bg-[#F5931E] border border-[#F5931E] hover:bg-transparent focus:ring-4 focus:outline-none focus:ring-[#F5931E] rounded text-base px-8 py-4 text-center" style="box-shadow: 0px 18px 20px rgba(0, 150, 216, 0.1)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="#5A514E">
                                        <path d="M11.5 0.273438H7L12 8.14649L7 16.0195H11.5L16.5 8.14649L11.5 0.273438Z"></path>
                                        <path d="M4.5 0.273438H0L5 8.14649L0 16.0195H4.5L9.5 8.14649L4.5 0.273438Z"></path>
                                    </svg>
                                    Schedule Event
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="w-full lg:w-4/12"  data-aos="fade-right" data-aos-duration="1000" data-aos-easing="linear">
                    <div
                        class="border-[#F5931E] h-full px-5  pb-10 border bg-[#F4EFE6]"
                        style="box-shadow: 0px 4px 50px 5px rgba(245, 147, 30, 0.2)"
                    >
                        <h1 class="text-[#5A514E] text-[32px] font-bold mt-20">
                            Meeting with me
                        </h1>
                        <div class="mt-[30px] space-y-5">
                            <div class="flex gap-7 items-center">
                                <div
                                    class="px-2.5 py-1.5"
                                    style="
                        background: #f4efe6;
                        box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
                        border-radius: 5px;
                        "
                                >
                                    <i
                                        class="fa-regular text-[20px] text-[#F5931E] fa-clock"
                                    ></i>
                                </div>
                                <h6 class="text-[#5A514E] font-semibold">20min</h6>
                            </div>
                            <div class="flex gap-7 items-center">
                                <div
                                    class="px-2.5 py-1.5"
                                    style="
                        background: #f4efe6;
                        box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
                        border-radius: 5px;
                        "
                                >
                                    <i
                                        class="fa-regular text-[20px] text-[#F5931E] fa-phone"
                                    ></i>
                                </div>
                                <h6 class="text-[#5A514E] font-semibold">135-124-124</h6>
                            </div>
                        </div>
                        <div class="mt-9 space-y-6">
                            <div class="flex gap-4 items-center">
                                <i class="fa-solid text-[20px] text-[#F5931E] fa-check"></i>
                                <h6 class="text-[#5A514E] font-semibold text-sm">
                                    Talk about your company needs
                                </h6>
                            </div>
                            <div class="flex gap-4 items-center">
                                <i class="fa-solid text-[20px] text-[#F5931E] fa-check"></i>
                                <h6 class="text-[#5A514E] font-semibold text-sm">
                                    3PL services needed
                                </h6>
                            </div>
                            <div class="flex gap-4 items-center">
                                <i class="fa-solid text-[20px] text-[#F5931E] fa-check"></i>
                                <h6 class="text-[#5A514E] font-semibold text-sm">
                                    How to start working with us
                                </h6>
                            </div>
                            <div class="flex gap-4 items-center">
                                <i class="fa-solid text-[20px] text-[#F5931E] fa-check"></i>
                                <h6 class="text-[#5A514E] font-semibold text-sm">
                                    Q&A about our services
                                </h6>
                            </div>
                            <div class="flex gap-4 items-center">
                                <i class="fa-solid text-[20px] text-[#F5931E] fa-check"></i>
                                <h6 class="text-[#5A514E] font-semibold text-sm">
                                    Volume of Item expected / Shipments needed per month
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Main Content -->

</x-web-layout>
