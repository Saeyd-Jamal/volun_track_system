<x-dashboard-layout>
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5 class="mb-0 card-title">جدول التخصصات</h5>
            <div class="d-flex align-items-center">
                @can('create', 'App\\Models\Specialization')
                    <a class="btn btn-success" href="{{route('dashboard.specializations.create')}}">
                        <i class="fa-solid fa-plus"></i>
                    </a>
                @endcan
            </div>
        </div>
        <style>
            td{
                color: #000 !important;
            }
        </style>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>التخصص</th>
                            <th>الحالة</th>
                            <th>عدد المراحل</th>
                            <th>الحدث</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($specializations as $specialization)
                        <tr>
                            <td style="width: 10px">{{ $loop->iteration - 1 }}</td>
                            <td>{{$specialization->name}}</td>
                            <td>
                                @if($specialization->is_active)
                                <span class="badge bg-label-success me-1">نشط</span>
                                @else
                                <span class="badge bg-label-danger me-1">غير نشط</span>
                                @endif
                            </td>
                            <td>{{$specialization->approvalHierarchies->count()}}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="p-0 btn dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="ti ti-dots-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        @can('update', 'App\\Models\Specialization')
                                        <a class="dropdown-item" style="margin: 0.5rem -0.75rem; text-align: right;" href="{{route('dashboard.specializations.edit',$specialization->id)}}">
                                            <i class="ti ti-pencil me-1"></i>تعديل
                                        </a>
                                        @endcan
                                        @can('delete', 'App\\Models\Specialization')
                                        <form action="{{route('dashboard.specializations.destroy',$specialization->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="dropdown-item" style="margin: 0.5rem -0.75rem; text-align: right;">
                                                <i class="ti ti-trash me-1"></i>حذف
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-dashboard-layout>
