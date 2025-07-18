<div class="modal-header">
    <h5 class="modal-title" id="modalCenterTitle">تفاصيل طلب التطوع</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="mb-3 row">
        <div class="col">
            <label class="form-label">الاسم الكامل</label>
            <input type="text" class="form-control" value="{{ $app->full_name }}" readonly>
        </div>
        <div class="col">
            <label class="form-label">البريد الإلكتروني</label>
            <input type="email" class="form-control" value="{{ $app->email }}" readonly>
        </div>
    </div>
    
    <div class="mb-3 row">
        <div class="col">
            <label class="form-label">الجنس</label>
            <input type="text" class="form-control" value="{{ $app->gender == 'male' ? 'ذكر' : 'أنثى' }}" readonly>
        </div>
        <div class="col">
            <label class="form-label">تاريخ الميلاد</label>
            <input type="text" class="form-control" value="{{ $app->birth_date }}" readonly>
        </div>
    </div>
    
    <div class="mb-3 row">
        <div class="col">
            <label class="form-label">الجامعة</label>
            <input type="text" class="form-control" value="{{ $app->university }}" readonly>
        </div>
        <div class="col">
            <label class="form-label">التخصص الأكاديمي</label>
            <input type="text" class="form-control" value="{{ $app->major }}" readonly>
        </div>
    </div>
    
    <div class="mb-3 row">
        <div class="col">
            <label class="form-label">السنة الدراسية</label>
            <input type="text" class="form-control" value="{{ $app->academic_year }}" readonly>
        </div>
        <div class="col">
            <label class="form-label">رقم الهاتف</label>
            <input type="text" class="form-control" value="{{ $app->phone }}" readonly>
        </div>
    </div>
    
    <div class="mb-3 row">
        <div class="col">
            <label class="form-label">المدينة</label>
            <input type="text" class="form-control" value="{{ $app->city }}" readonly>
        </div>
        <div class="col">
            <label class="form-label">مكان التطوع</label>
            <input type="text" class="form-control" value="{{ $app->volunteer_place }}" readonly>
        </div>
    </div>
    
    <div class="mb-3 row">
        <div class="col">
            <label class="form-label">التخصص المطلوب</label>
            <input type="text" class="form-control" value="{{ $app->specialization->name }}" readonly>
        </div>
        <div class="col">
            @php
                $status = '';
                if ($app->status == 'pending') {
                    $status = 'قيد الانتظار';
                } elseif ($app->status == 'approved') {
                    $status = 'تم الموافقة عليها';
                } elseif ($app->status == 'rejected') {
                    $status = 'تم رفضها';
                }
            @endphp
            <label class="form-label">حالة الطلب</label>
            <input type="text" class="form-control" value="{{ $status }}" readonly>
        </div>
    </div>
    
    @if ($app->motivation)
        <div class="mb-3">
            <label class="form-label">الدافع للتطوع</label>
            <textarea class="form-control" rows="2" readonly>{{ $app->motivation }}</textarea>
        </div>
    @endif
    
    @if ($app->skills)
        <div class="mb-3">
            <label class="form-label">المهارات</label>
            <div class="form-control bg-light" readonly>
                {{ $app->skills }}
            </div>
        </div>
    @endif
    
    @if ($app->previous_experience)
        <div class="mb-3">
            <label class="form-label">الخبرة السابقة</label>
            <textarea class="form-control" rows="2" readonly>{{ $app->previous_experience }}</textarea>
        </div>
    @endif
    
    @if ($app->availability)
        <div class="mb-3">
            <label class="form-label">متى متاح؟</label>
            <input type="text" class="form-control" value="{{ $app->availability }}" readonly>
        </div>
    @endif
    
    @if ($app->notes)
        <div class="mb-3">
            <label class="form-label">ملاحظات</label>
            <textarea class="form-control" rows="2" readonly>{{ $app->notes }}</textarea>
        </div>
    @endif
    
    @if ($app->file)
        <div class="mb-3">
            <label class="form-label">السيرة الذاتية</label>
            <a href="{{ asset('storage/' . $app->file) }}" target="_blank" class="btn btn-outline-primary btn-sm">عرض الملف</a>
        </div>
    @endif
    
    
    <div class="mb-3">
        <label class="form-label">سبب الرفض (إذا تم رفض الطلب)</label>
        <textarea class="form-control" id="reason" rows="2" @if ($app->status == 'pending') readonly @endif>{{ $app->rejection_reason }}</textarea>
    </div>
    
</div>
<div class="modal-footer" id="modalFooter">
    @if ($app->status == 'pending')
        <button type="button" id="rejectButton" data-id="{{ $app->id }}" class="btn btn-label-secondary"
            data-bs-dismiss="modal">
            رفض
        </button>
        <button type="button" id="approveButton" data-id="{{ $app->id }}" class="btn btn-primary">موافقة</button>
    @else
        <span class="badge bg-label-success me-1">تم الموافقة عليها</span>
    @endif
</div>