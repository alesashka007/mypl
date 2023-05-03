@if(session('alert'))
    <div class="mt-3 alert alert-{{session()->pull('a_status')}}" role="alert">
        {{session()->pull('alert')}}
    </div>
@endif
