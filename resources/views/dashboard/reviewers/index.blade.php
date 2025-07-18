<x-dashboard-layout>
    <!-- Bordered Table -->
    <div class="card">
        <h5 class="card-header">طلبات التطوع</h5>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الاسم</th>
                            <th>البريد الالكتروني</th>
                            <th>المدينة</th>
                            <th>التخصص</th>
                            <th>مكان التطوع</th>
                            <th>الحالة</th>
                            <th>الحدث</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($applications as $app)
                            <tr id="row-{{ $app->id }}">
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>{{ $app->full_name }}</td>
                                <td>{{ $app->email }}</td>
                                <td>{{ $app->city }}</td>
                                <td>{{ $app->specialization->name }}</td>
                                <td>{{ $app->volunteer_place }}</td>
                                <td>
                                    @if ($app->status == 'pending')
                                        <span class="badge bg-label-warning me-1">قيد الانتظار</span>
                                    @elseif ($app->status == 'approved')
                                        <span class="badge bg-label-success me-1">تم الموافقة عليها</span>
                                    @elseif ($app->status == 'rejected')
                                        <span class="badge bg-label-danger me-1">تم رفضها</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary"
                                        onclick="openApplication({{ $app->id }})">
                                        <i class="ti ti-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="applicationModal" class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content" id="applicationDetails">
                
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            function openApplication(id) {
                $.ajax({
                    url: `{{ route('dashboard.reviewers.show', ':id') }}`.replace(':id', id),
                    type: 'GET',
                    success: function(html) {
                        $('#applicationDetails').html(html);
                        $('#applicationModal').modal('show');
                    }
                });
            }

            function closeModal() {
                $('#applicationModal').modal('hide');
            }
            $('#rejectButton').on('click', function() {
                const id = $(this).data('id');
                decisionSubmit('reject', id);
            });
            $('#approveButton').on('click', function() {
                const id = $(this).data('id');
                decisionSubmit('approve', id);
            });

            function decisionSubmit(type, id) {
                $.ajax({
                    url: `{{ route('dashboard.reviewers.decision', ':id') }}`.replace(':id', id),
                    type: 'POST',
                    data: {
                        decision: type,
                        reason: $('#reason').val(),
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(result) {
                        $(`#row-${id}`).remove();
                        closeModal();
                    },
                    error: function() {
                        alert('فشل الاتصال بالخادم.');
                    }
                });
            }
        </script>
    @endpush
</x-dashboard-layout>
