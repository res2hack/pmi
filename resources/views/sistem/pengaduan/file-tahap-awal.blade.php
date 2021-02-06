

<div  class="table-responsive mb-2">
    <div class="ml-2 mb-3">
        <h6 class="border-bottom mb-0 pb-2">Unggah Berkas Tahap Awal
            <small class="font-11 text-danger ml-2">*Ukuran File Max: 2MB.</small>
        </h6>
    </div>
    
    <table class="table"  id="table_awal" style="width:100%;">
       
        <tbody>
            
            @if(count($file_awal) > 0)

                @php $i=1 @endphp
                
                @foreach($file_awal as $awal)

                <tr>
                    <td class="pl-2 "> 
                        <input type="hidden" value="1" name="cekEditBaruAwal[]">
                        <input type="hidden" id="nmIdEditAwal" name="nmIdEditAwal[]" class="nmIdEditAwal" value="{{ $awal->id }}">
                        
                        <div class="border-bottom">
                            <a target="_blank" class="font-weight-bold" href="{{ url('/uploads/file/pengaduan/awal') }}/{{ $awal->nmfile }}">
                                {{ $awal->nmfile }} <i class="fas fa-file ml-2"></i>
                            </a>
                        </div>
                    </td>
                    <td class="py-2 text-center"><a name="removeFileAwalEdit" 
                        class="text-danger removeFileAwalEdit ml-0" style="cursor:pointer;">
                        <i class="fas fa-times font-20"></i></a>
                    </td>
                </tr>

                @php $i++ @endphp
                @endforeach

            @endif 

            <tr>
                <td class="pl-2 "> 
                    <input id="nmFileTahapAwal1" name="nmFileTahapAwal[]" type="file" 
                    class="h-45  form-control border-form bg-form " onchange="cekSize();">
                </td>

                <td class="">
                    <a type="button" name="addFileAwal" class="addFileAwal font-weight-bold align-top mr-2 " 
                    title="Tambah Lampiran">
                    <i class="fas fa-plus text-success font-18"></i>
                </a>
                </td>
            </tr>
        </tbody>
        
    </table>
    
</div>


<table id="tabel_hapus_awal" class="d-none">

</table>