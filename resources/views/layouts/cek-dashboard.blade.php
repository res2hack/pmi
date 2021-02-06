
@if(Auth::user()->dashboard === 0)
    @include('layouts.admin') 
@else
    @include('layouts.user')  
@endif