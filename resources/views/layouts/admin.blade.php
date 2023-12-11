<!DOCTYPE html>
<html lang="en">
    <head>
        @include('inc.head')
    </head>
    <body class="sidebar-noneoverflow">

        <!-- BEGIN LOADER -->
        <div id="load_screen"> <div class="loader"> <div class="loader-content">
            <div class="spinner-grow align-self-center"></div>
        </div></div></div>
        <!--  END LOADER -->
        @include('inc.header')

        <!--  BEGIN MAIN CONTAINER  -->
        <div class="main-container" id="container">

            <div class="overlay"></div>
            <div class="search-overlay"></div>
                @include('inc.sidebar')
                <!--  BEGIN CONTENT AREA  -->
                <div id="content" class="main-content">
                    @yield('content')

                    @include('inc.footer')
                </div>
                <!--  END CONTENT AREA  -->
        </div>
        <!-- END MAIN CONTAINER -->
    @include('inc.scripts')
    </body>
</html>