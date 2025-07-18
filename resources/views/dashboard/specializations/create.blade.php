<x-dashboard-layout>
    <form action="{{route('dashboard.specializations.store')}}" method="post" class="col-12">
        @csrf
        @include("dashboard.specializations._form")
    </form>
</x-dashboard-layout>
