@section('title')
Halaman Tidak Bisa Diakses
@endsection

@section('subheader')
@endsection

@section('breadcrumb')
@endsection

@section('content')
<div class="hero bg-white border-top5 shadow border-danger text-danger">
    <div class="hero-inner">
        <h2>Halaman Tidak Bisa diakses!</h2>
        <p class="lead font-weight-500 text-dark">Maaf, Anda Tidak Memiliki Hak Akses Untuk Membuka Halaman Ini.</p>
        <div class="mt-4">
            <a href="{{ route('dashboard')}}" class="btn btn-dark btn-lg">
                <i class="fas fa-th-large mr-3"></i>Kembali Ke Dashboard
            </a>
        </div>
    </div>
</div>
@endsection

@section('script')
@endsection