<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Taste The Code Toolbox')</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
          integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body class="bg-gray-200 font-sans leading-normal tracking-normal">

<nav id="header" class="bg-gray-900 fixed w-full z-10 top-0 shadow border-b border-gray-400">
    <div class="w-full container mx-auto flex flex-wrap items-center mt-0 pt-3 pb-3">
        <div class="w-1/2 pl-2 md:pl-0">
            <a class="text-gray-100 text-base xl:text-xl no-underline hover:no-underline font-bold" href="/">
                <i class="fas fa-moon text-blue-400 pr-3"></i>
                <span class="hidden md:inline">Taste The Code Toolbox</span>
                <span class="md:hidden">TTC Toolbox</span>
            </a>
        </div>
        <div class="w-1/2 pr-0">
            <div class="flex relative inline-block float-right">
                <div class="relative text-sm text-gray-100 px-2 pt-1">
                    <a href="https://www.tastethecode.com">Main Site</a>
                </div>
                <div class="block md:hidden pr-4">
                    <button id="nav-toggle"
                            class="flex items-center px-3 py-2 border rounded text-gray-500 border-gray-600 hover:text-gray-100 hover:border-teal-500 appearance-none focus:outline-none">
                        <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>
                                Menu</title>
                            <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/>
                        </svg>
                    </button>
                </div>
            </div>

        </div>


        <div class="w-full flex-grow md:flex md:items-center md:w-auto hidden md:block mt-2 md:mt-0 bg-gray-900 z-20"
             id="nav-content">
            <ul class="list-reset md:flex flex-1 items-center px-4 md:px-0">
                <li class="mr-6 my-2 md:my-0">
                    <a href="/"
                       class="block py-1 md:py-3 pl-1 align-middle no-underline hover:text-gray-100 border-b-2 {{ request()->is('/') ? 'text-blue-400 border-blue-400' : 'text-gray-500 border-gray-900'  }} hover:border-blue-400">
                        <i class="fas fa-home fa-fw mr-3"></i><span
                                class="pb-1 md:pb-0 text-sm">Home</span>
                    </a>
                </li>
                <li class="mr-6 my-2 md:my-0">
                    <a href="{{ route('youtube-sight.index') }}"
                       class="block py-1 md:py-3 pl-1 align-middle no-underline hover:text-gray-100 border-b-2 {{ request()->routeIs('youtube-sight.*') ? 'text-blue-400 border-blue-400' : 'text-gray-500 border-gray-900'  }}  hover:border-red-400">
                        <i class="fab fa-youtube fa-fw mr-3"></i><span class="pb-1 md:pb-0 text-sm">YouTube Sight</span>
                    </a>
                </li>
            </ul>
        </div>

    </div>
</nav>
<div class="container w-full mx-auto pt-20">
    <div class="w-full px-4 md:px-0 md:mt-8 mb-16 md:mb-40 text-gray-800 leading-normal">
        @yield('content')
    </div>
</div>
<footer class="bg-gray-900 border-t border-gray-400 shadow md:fixed md:bottom-0 w-full">
    <div class="container mx-auto flex py-4">
        <div class="w-full mx-auto flex flex-wrap">
            <div class="flex w-full md:w-1/2 ">
                <div class="px-4">
                    <h3 class="font-bold font-bold text-gray-100">About Me</h3>
                    <p class="py-2 text-gray-600 text-sm">
                        I’m a software developer with a passion for making and electronics. I run a YouTube channel called
                        <a  class="text-blue-400 hover:text-blue-600" href="https://www.youtube.com/tastethecode">Taste The Code</a> where I post new videos every week. Check out the links to my social pages to see what I do. If you like what you see, consider <a class="text-blue-400 hover:text-blue-600" href="https://www.paypal.com/paypalme2/bkolicoski">buying me a beer</a>.
                    </p>
                </div>
            </div>
            <div class="flex w-full md:w-1/2">
                <div class="px-4">
                    <h3 class="font-bold font-bold text-gray-100">Find me elsewhere</h3>
                    <ul class="list-reset inline-block py-2">
                        <li class="inline p-2 pl-0 md:p-1 md:pl-0">
                            <a href="https://www.youtube.com/tastethecode" title="YouTube">
                            <span class="fa-stack fa-lg">
                              <i class="fas fa-circle fa-stack-2x"></i>
                              <i class="fab fa-youtube fa-stack-1x fa-inverse"></i>
                            </span>
                            </a>
                        </li>
                        <li class="inline p-2 md:p-1">
                            <a href="https://twitter.com/taste_the_code" title="Twitter">
                            <span class="fa-stack fa-lg">
                              <i class="fas fa-circle fa-stack-2x"></i>
                              <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                            </span>
                            </a>
                        </li>
                        <li class="inline p-2 md:p-1">
                            <a href="https://www.facebook.com/tastethecode/" title="Facebook">
                            <span class="fa-stack fa-lg">
                              <i class="fas fa-circle fa-stack-2x"></i>
                              <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                            </span>
                            </a>
                        </li>
                        <li class="inline p-2 md:p-1">
                            <a href="https://www.instagram.com/taste_the_code/" title="Instagram">
                            <span class="fa-stack fa-lg">
                              <i class="fas fa-circle fa-stack-2x"></i>
                              <i class="fab fa-instagram fa-stack-1x fa-inverse"></i>
                            </span>
                            </a>
                        </li>
                        <li class="inline p-2 md:p-1">
                            <a href="https://github.com/bkolicoski" title="GitHub">
                            <span class="fa-stack fa-lg">
                              <i class="fas fa-circle fa-stack-2x"></i>
                              <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                            </span>
                            </a>
                        </li>
                        <li class="inline p-2 md:p-1">
                            <a href="https://www.instructables.com/member/taste_the_code/instructables/"
                               title="Instructables">
                            <span class="fa-stack fa-lg">
                              <i class="fas fa-circle fa-stack-2x"></i>
                              <i class="fas fa-robot fa-stack-1x fa-inverse"></i>
                            </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<script>
  var navMenuDiv = document.getElementById("nav-content");
  var navMenu = document.getElementById("nav-toggle");

  document.onclick = check;

  function check(e) {
    var target = (e && e.target) || (event && event.srcElement);

    //Nav Menu
    if (!checkParent(target, navMenuDiv)) {
      // click NOT on the menu
      if (checkParent(target, navMenu)) {
        // click on the link
        if (navMenuDiv.classList.contains("hidden")) {
          navMenuDiv.classList.remove("hidden");
        } else {
          navMenuDiv.classList.add("hidden");
        }
      } else {
        // click both outside link and outside menu, hide menu
        navMenuDiv.classList.add("hidden");
      }
    }

  }

  function checkParent(t, elm) {
    while (t.parentNode) {
      if (t == elm) {
        return true;
      }
      t = t.parentNode;
    }
    return false;
  }


</script>
</body>
</html>
