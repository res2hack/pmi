@if (session('success'))
    <div class="alert alert-success alert-dismissible show fade">
        <div class="alert-body">
        <button class="close" data-dismiss="alert">
            <span>×</span>
        </button>
        <i class="far fa-check-circle mr-2"></i> {{ session('success') }}
        </div>
    </div>
@endif

@if (count($errors) > 0)
    <div class="alert alert-danger alert-dismissible show fade">
        <div class="alert-body">
        <button class="close" data-dismiss="alert">
            <span>×</span>
        </button>
        Ada Kesalahan - Data Tidak Bisa Disimpan
        </div>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible show fade">
        <div class="alert-body">
        <button class="close" data-dismiss="alert">
            <span>×</span>
        </button>
        <i class="far fa-check-circle mr-2"></i> {{ session('error') }}
        </div>
    </div>
@endif
