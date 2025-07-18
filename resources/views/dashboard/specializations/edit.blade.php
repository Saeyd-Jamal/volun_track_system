<x-dashboard-layout>
    <form action="{{route('dashboard.specializations.update',$specialization->id)}}" method="post" class="col-12">
        @csrf
        @method('put')
        @include("dashboard.specializations._form")
    </form>
</x-dashboard-layout>
