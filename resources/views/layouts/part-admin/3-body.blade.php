<!-- Main Content -->
<div class="main-content">
    <section class="section">
        
        <div class=" mt-2 ">
            <div class="row">
                <div class="col-md-6 mb-4">
                    @yield('subheader')
                </div>
                <div class="col-md-6 text-right mb-4">
                    @yield('breadcrumb')
                </div>
            </div>
        </div>
        

        <div class="section-body">
            @yield('content')
        </div>
    </section>
    
    @yield('modal')
</div>