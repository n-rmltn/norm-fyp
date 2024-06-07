<x-app-layout>

        <!-- Content-->
        <section class="container-fluid">
            
        <!-- Page Title -->
        @include('partials.header')
            <div class="row g-4">
              @if (count($partials)>1)
              <div class="col-12 col-md-6">
                @include($partials[0])
              </div>
              <div class="col-12 col-md-6">
                @foreach ($partials as $partial)
                  @if ($loop->first) @continue @endif
                    @include($partial)
                @endforeach
              </div>
              @else
              <div class="col-12 col-md-6">
                    @include($partials[0])
              </div>
              @endif
                
            </div>

            <!-- Sidebar Menu Overlay-->
            <div class="menu-overlay-bg"></div>
            <!-- / Sidebar Menu Overlay-->

</x-app-layout>
