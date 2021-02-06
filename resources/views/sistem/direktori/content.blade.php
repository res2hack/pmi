@include('global.notifikasi')
<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-body">
                <div class="mt-2 table-responsive ">
                    @yield('tombol-baru')
                    <table id="dt-direktori" class="table w-100">
                        <thead>
                            <tr>
                                <th style="width:5%;">#</th>
                                <th class="font-15" style="width:30%;">Nama
                                    @if($tipe === "blk") BLK @elseif($tipe === "disnaker") Dinas
                                    @elseif($tipe === "p3mi") P3MI @else KBRI @endif
                                </th>
                                <th class="font-15" style="width:23%;">Alamat</th>
                                <th class="font-15" style="width:22%;">Kontak</th>
                                <th class="font-15">Tampil</th>
                                <th class="font-15">@if($tipe === "blk") Legal @else Valid @endif</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>