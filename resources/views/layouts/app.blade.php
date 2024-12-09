<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])


        <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
 </head>


    <body class="h-full font-sans antialiased">


    <!-- Sidebar Sub Menu Item -->
    <nav
        class="flex justify-end sticky top-0 bg-gray-50 dark:bg-slate-800 w-full shadow-md justify-between py-3 px-3 lg:px-5 lg:pl-3 z-40">
        <div class="flex">

            <span id="sidebar-toggle" onclick="toggleItem('dashboard-sidebar')"
                class="cursor-pointer p-2 text-xl my-auto mr-4">
                <i class="fa-solid fa-bars-staggered text-gray-700 dark:text-white"></i>

            </span>

            <span class="cursor-pointer my-auto p-2 text-xl">
            <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>

            </span>






        </div>


        <div class="flex text-center">


            <!-- Bell icon div -->
            <span class="cursor-pointer p-2 text-xl  my-auto">
                <i class="fa-solid fa-bell text-gray-700 dark:text-white"></i>
            </span>

            <!-- Settings icon div -->
            <span id="ui-setting" onclick="toggleItem('ui-div')" class="cursor-pointer p-2 text-xl  my-auto">
                <i class="fa-solid fa-gear text-gray-700 dark:text-white"></i>
            </span>

            <!-- Profile icon div -->

            @include('layouts.navigation')

        </div>
    </nav>



    <div class="w-full flex dark:bg-slate-900 bg-gray-200 space-between ">


        <!-- Sidebar Start  -->

        <section id="dashboard-sidebar"
            class="hidden lg:block font-semibold sidebar-main px-3 py-3 h-full bg-gray-50 dark:bg-slate-800 text-gray-900 dark:text-white hover-scrollbar fixed top-0 left-0 flex-col flex-shrink-0 pt-16 h-full duration-200 lg:flex transition-width z-10  lg:w-64">

            <!-- Sidebar Menu  -->

            <ul id="dashboard">


                <!-- Sidebar Menu Items -->
                <li class="mt-4 w-56 pt-2">
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    <div onclick="toggleSearch('dashboard-sub')"
                        class="flex active cursor-pointer justify-between dark:hover:text-gray-900   dark:hover:bg-gray-300 active:bg-white rounded-md ">
                        <div class="flex items-center justify-center">
                            <span
                                class="stroke-none shadow-lg mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center p-2.5 text-center text-black">
                                <i class="fa-solid fa-store text-sm text-gray-700"></i>
                            </span>
                            <span class="pl-2 hidden lg:block dash-hide"> {{ __('Dashboard') }}                    </span>
                        </div>
                    </div>



                    </x-responsive-nav-link>
                </li>




                <!-- Sidebar Menu Items -->
                <li class="mt-0.5 w-56 pt-2">

                <x-responsive-nav-link :href="route('employees.index')" :active="request()->routeIs('employees.*')">

                    <div onclick="toggleSearch('teams-sub')"
                        class="flex active cursor-pointer justify-between dark:hover:text-gray-900  dark:hover:bg-gray-300 active:bg-white rounded-md ">
                        <div class="flex items-center justify-center">
                            <span
                                class="stroke-none shadow-lg mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center p-2.5 text-center text-black">
                                <i class="fa-solid fa-user-group text-sm text-gray-700"></i>
                            </span>
                            <span class="pl-2 hidden lg:block dash-hide">
{{ __('Employees') }}        </span>
                        </div>

                    </div>
                    </x-responsive-nav-link>
                </li>



                <!-- Sidebar Menu Items -->
                <li class="w-56 pt-2">
                <x-responsive-nav-link :href="route('plans.index')" :active="request()->routeIs('plans.*')">

                    <div
                        class="flex active cursor-pointer justify-between dark:hover:text-gray-900  dark:hover:bg-gray-300 active:bg-white rounded-md ">
                        <div class="flex items-center justify-center">
                            <span
                                class="stroke-none shadow-lg mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center p-2.5 text-center text-black  text-gray-700 dark:text-white dark:hover:text-gray-900">
                                <i class="fa-solid fa-user-plus text-sm text-gray-700"></i>
                            </span>
                            <span class="pl-2 hidden lg:block dash-hide">{{ __('Plans') }}</span>
                        </div>

                    </div>
                    </x-responsive-nav-link>
                </li>










            </ul>
        </section>


        <!-- Dashboard Main Section -->
        <section id="main-div" class="h-screen w-full bg-white relative overflow-y-auto dark:bg-slate-800 lg:ml-64"  >






            {{ $slot }}

        </section>









    </div>


    <div fixed-plugin-card="" id="ui-div"
        class="hidden z-50 dark:bg-gray-950/80 z-sticky shadow-soft-3xl w-96 ease-soft fixed top-0 left-auto flex h-full min-w-0 flex-col break-words rounded-none border-0 bg-white/80 bg-clip-border px-2.5 backdrop-blur-2xl backdrop-saturate-200 duration-200 right-0">
        <div class="px-6 pt-4 pb-0 mb-0 border-b-0 rounded-t-2xl">
            <div class="float-left">
                <h5 class="mt-4 mb-0 dark:text-white">Soft UI Configurator</h5>
                <p class="dark:text-white dark:opacity-60">See our dashboard options.</p>
            </div>
            <div class="float-right mt-6">
                <button fixed-plugin-close-button=""
                    class="inline-block p-0 mb-4 font-bold text-center uppercase align-middle transition-al border-0 rounded-lg shadow-none cursor-pointer hover:scale-102 leading-pro text-xs ease-soft-in tracking-tight-soft bg-150 bg-x-25 active:opacity-85 text-slate-700 dark:text-white">
                    <i onclick="toggleItem('ui-div')" class="fa fa-close p-2" aria-hidden="true"></i>
                </button>
            </div>

        </div>
        <hr class="h-px mx-0 my-1 bg-gradient-to-r  dark:bg-gradient-to-r ">
        <div class="flex-auto p-6 pt-0 sm:pt-4">



            <div class="mt-4">
                <span class="text-center pr-4">Light / Dark</span>

            </div>
            <div class="min-h-6 mb-0.5 block pl-0">
                <label class="switch">
                    <input type="checkbox" id="toggleSwitch" class="">
                    <span class="slider"></span>
                </label>
            </div>
            <hr class="h-px mt-6 mb-1 bg-gradient-to-r  dark:bg-gradient-to-r ">
            <div class="mt-4">
                <h6 class="mb-0 dark:text-white">Navbar Fixed</h6>
            </div>
            <div class="min-h-6 mb-0.5 block pl-0">
                <input navbar-fixed-toggle=""
                    class="rounded-10 duration-250 ease-soft-in-out after:rounded-circle after:shadow-soft-2xl after:duration-250 checked:after:translate-x-5.3 h-5 relative float-left mt-1 ml-auto w-10 cursor-pointer appearance-none border border-solid border-gray-200 bg-slate-800/10 bg-none bg-contain bg-left bg-no-repeat align-top transition-all after:absolute after:top-px after:h-4 after:w-4 after:translate-x-px after:bg-white after:content-[''] checked:border-slate-800/95 checked:bg-slate-800/95 checked:bg-none checked:bg-right"
                    type="checkbox" checked="true">
            </div>
            <hr class="h-px mt-4 mb-1 bg-gradient-to-r  dark:bg-gradient-to-r ">
            <div class="mt-2">
                <h6 class="mb-0 dark:text-white">Sidenav Mini</h6>
            </div>
            <div class="min-h-6 mb-0.5 block pl-0">
                <input sidenav-mini-toggle=""
                    class="rounded-10 duration-250 ease-soft-in-out after:rounded-circle after:shadow-soft-2xl after:duration-250 checked:after:translate-x-5.3 h-5 relative float-left mt-1 ml-auto w-10 cursor-pointer appearance-none border border-solid border-gray-200 bg-slate-800/10 bg-none bg-contain bg-left bg-no-repeat align-top transition-all after:absolute after:top-px after:h-4 after:w-4 after:translate-x-px after:bg-white after:content-[''] checked:border-slate-800/95 checked:bg-slate-800/95 checked:bg-none checked:bg-right"
                    type="checkbox">
            </div>
            <hr class="h-px mt-4 mb-1 bg-gradient-to-r  dark:bg-gradient-to-r ">
            <!-- Sidebar Profile  -->





            <a class="inline-block w-full px-6 py-3 mt-4 mb-4 font-bold text-center text-white uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer leading-pro text-xs ease-soft-in hover:shadow-soft-xs hover:scale-102 active:opacity-85 tracking-tight-soft shadow-soft-md bg-gradient-to-br from-purple-500 to-violet-800 shadow-md shadow-gray-300 dark:shadow-gray-800 "
                href="https://www.creative-tim.com/product/soft-ui-dashboard-pro-tailwind" target="_blank">Buy Now</a>
            <a class="inline-block w-full px-6 py-3 mb-4 font-bold text-center text-white uppercase align-middle transition-all bg-transparent border border-transparent border-solid rounded-lg cursor-pointer leading-pro text-xs ease-soft-in hover:shadow-soft-xs hover:scale-102 active:opacity-85 tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-to-tl from-gray-900 to-slate-800 dark:bg-gradient-to-tl dark:from-slate-850 dark:to-gray-850 dark:border-white dark:text-white"
                href="https://www.creative-tim.com/product/soft-ui-dashboard-tailwind" target="_blank">Free Demo</a>
        </div>
    </div>




    <script>

          // Function to set the theme based on localStorage
  function setTheme(theme) {
    if (theme === 'dark') {
      document.documentElement.classList.add('dark');
      document.body.classList.add('bg-gray-900', 'text-white');
      document.body.classList.remove('bg-gray-100', 'text-black');
    } else {
      document.documentElement.classList.remove('dark');
      document.body.classList.add('bg-gray-100', 'text-black');
      document.body.classList.remove('bg-gray-900', 'text-white');
    }
  }

  // Check the theme on initial load
  if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    document.getElementById('toggleSwitch').checked = true;
    setTheme('dark');
  } else {
    setTheme('light');
  }

  // Add event listener for the toggle switch
  document.getElementById('toggleSwitch').addEventListener('change', function() {
    if (this.checked) {
      localStorage.theme = 'dark';
      setTheme('dark');
    } else {
      localStorage.theme = 'light';
      setTheme('light');
    }
  });


  window.toggleItem = (toggleId) => {
    const hideItems = document.querySelectorAll('.dash-hide');
    const changeMargin = document.getElementById('main-div');
  const toggleDiv = document.getElementById(toggleId);
  const sidebarDiv = document.getElementById('dashboard-sidebar')

  console.log(changeMargin)

  if (toggleDiv.classList.contains('hidden')) {
    toggleDiv.classList.remove('hidden');
    toggleDiv.classList.add('block');
  } else {
    toggleDiv.classList.remove('block');
    toggleDiv.classList.add('hidden');
  }


  hideItems.forEach((item) => {
    if (item.classList.contains('block')) {
      item.classList.remove('block');
      item.classList.add('hidden');
    }
    else {
      item.classList.remove('hidden');
      item.classList.add('block');
    }
  });

  changeMargin.classList.toggle('lg:ml-20');
  changeMargin.classList.toggle('lg:ml-64');

  sidebarDiv.classList.toggle('lg:w-64');
  sidebarDiv.classList.toggle('lg:w-20');



}

window.toggleSearch = (toggleId) => {
  const toggleDiv = document.getElementById(toggleId);

  toggleDiv.classList.toggle('hidden');
  toggleDiv.classList.toggle('block');

}

    </script>
</body>
</html>
