

<div  class="">
    <table  id="table_foto" style="width:100%;">
        <thead>
            <tr>
                <th style="width:90%;"></th>
                <th style="width:10%;"></th>
            </tr>
        </thead>
        <tbody>

            @if(count($file_foto) > 0)

                @php $i=1 @endphp
                
                @foreach($file_foto as $foto)
                    <tr>
                        <td class="pl-2 "> 
                            <input type="hidden" value="1" name="cekEditBaruFoto[]">
                            <input type="hidden" id="nmIdEditFoto" name="nmIdEditFoto[]" class="nmIdEditFoto" value="{{ $foto->id }}">
                            
                            <div class="border-bottom">
                                <a target="_blank" class="font-weight-bold" href="{{ url('/uploads/file/pengaduan/foto') }}/{{ $foto->nmfile }}">
                                    {{ $foto->nmfile }} <i class="fas fa-file ml-2"></i>
                                </a>
                            </div>
                        </td>
                        <td class="py-2 text-center"><a name="removeFileFotoEdit" 
                            class="text-danger removeFileFotoEdit ml-0" style="cursor:pointer;">
                            <i class="fas fa-times font-20"></i></a>
                        </td>
                    </tr>
                @php $i++ @endphp
                @endforeach

            @endif
            <tr>
                <td class="pl-0 pt-3 pb-2" > 
                    <input id="nmFileTahapFoto1" name="nmFileTahapFoto[]" type="file" 
                    class="h-45  form-control border-form bg-form " onchange="cekSize();">
                </td>

                <td class="text-right pt-3 pb-2" >
                    <a type="button" name="addFileFoto" class="font-weight-bold align-top mr-2 addFileFoto " 
                        title="Tambah Lampiran">
                        <i class="fas fa-plus text-success font-18"></i>
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
    
</div>


<table id="tabel_hapus_foto" class="d-none">

</table>