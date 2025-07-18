<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="pt-4 card-body">
                <div class="row">
                    <div class="mb-4 col-md-6">
                        <x-form.input label="الاسم" :value="$specialization->name" name="name" placeholder="محمد ...." required
                            autofocus />
                    </div>
                    <div class="mb-4 col-md-6">
                        <label for="is_active">الحالة</label>
                        <select name="is_active" id="is_active" class="form-select">
                            <option value="" disabled>اختر</option>
                            <option value="0" @selected($specialization->is_active == 0)>غير نشط</option>
                            <option value="1" @selected($specialization->is_active == 1)>نشط</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-2 card">
            <div class="pt-4 card-body">
                <h5>الهيكل التنظيمي *</h5>
                <button type="button" id="add-step-btn" class="mt-3 btn btn-sm btn-success">
                    + إضافة مرحلة
                </button>
                <div id="approval-steps-wrapper">
                    @foreach ($specialization->approvalHierarchies ?? [] as $i => $hierarchy)
                        <div class="p-3 mb-3 rounded border row approval-step position-relative bg-light-subtle">
                            <div class="mb-2 col-md-4">
                                <x-form.input label="اسم الدور" :value="$hierarchy->role_name" name="hierarchies[{{$i}}][role_name]" required />
                            </div>                
                            <div class="mb-2 col-md-4">
                                <x-form.select :optionsid="$users" :value="$hierarchy->user_id" name="hierarchies[{{$i}}][user_id]" label="المشرف" />
                            </div>
                            <div class="flex gap-1 items-center mb-2 col-md-3">
                                <span class="text-sm text-muted">الترتيب: <span class="step-order-label">{{ $i + 1 }}</span></span>
                                <button type="button" class="btn btn-light btn-sm move-up">⬆️</button>
                                <button type="button" class="btn btn-light btn-sm move-down">⬇️</button>
                                <input type="hidden" name="hierarchies[{{$i}}][order_sequence]" class="order-sequence-input" value="{{ $i + 1 }}">
                            </div>   
                            <div class="col-md-1 d-flex align-items-center">
                                <button type="button" class="btn btn-sm btn-danger remove-step">×</button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <script type="text/template" id="approval-step-template">
                    <div class="p-3 mb-3 rounded border row approval-step position-relative bg-light-subtle">
                        <div class="mb-2 col-md-4">
                            <x-form.input label="اسم الدور" name="hierarchies[__index__][role_name]" required />
                        </div>                
                        <div class="mb-2 col-md-4">
                            <x-form.select :optionsid="$users" name="hierarchies[__index__][user_id]" label="المشرف" />
                        </div>
                        <div class="flex gap-1 items-center mb-2 col-md-3">
                            <span class="text-sm text-muted">الترتيب: <span class="step-order-label">1</span></span>
                            <button type="button" class="btn btn-light btn-sm move-up">⬆️</button>
                            <button type="button" class="btn btn-light btn-sm move-down">⬇️</button>
                            <input type="hidden" name="hierarchies[__index__][order_sequence]" class="order-sequence-input" value="1">
                        </div>   
                        <div class="col-md-1 d-flex align-items-center">
                            <button type="button" class="btn btn-sm btn-danger remove-step">×</button>
                        </div>
                    </div>
                </script>
            </div>
        </div>
        <div class="mt-2 card">
            <div class="pt-4 card-body">
                <div>
                    <button type="submit" class="btn btn-primary me-3">
                        {{ $btn_label ?? 'أضف' }}
                    </button>
                </div>
            </div>
        </div>
    </div>
    @php $lastIndex = isset($specialization->hierarchies) ? count($specialization->hierarchies) : 0; @endphp
    @push('scripts')
        <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
        <script>
            $(document).ready(function() {
                // عند تغيير حالة Master Checkbox
                $('.master-checkbox').on('change', function() {
                    // الحصول على المجموعة المرتبطة بـ Master Checkbox
                    const targetClass = $(this).data('target');

                    // تحديد/إلغاء تحديد جميع الخيارات الفرعية
                    $(`.${targetClass}`).prop('checked', $(this).prop('checked'));
                });
            });
        </script>
        <script>
            let stepIndex = {{ $lastIndex ?? 0 }};
        
            function updateStepOrders() {
                $('#approval-steps-wrapper .approval-step').each(function(index) {
                    $(this).find('.order-sequence-input').val(index + 1);
                    $(this).find('.step-order-label').text(index + 1);
                });
            }

            $(document).on('click', '.move-up', function() {
                const step = $(this).closest('.approval-step');
                const prev = step.prev('.approval-step');
                if (prev.length) {
                    step.insertBefore(prev);
                    updateStepOrders();
                }
            });

            $(document).on('click', '.move-down', function() {
                const step = $(this).closest('.approval-step');
                const next = step.next('.approval-step');
                if (next.length) {
                    step.insertAfter(next);
                    updateStepOrders();
                }
            });

        
            // ✅ إضافة مرحلة جديدة
            $('#add-step-btn').on('click', function () {
                const template = $('#approval-step-template').html().replace(/__index__/g, stepIndex);
                $('#approval-steps-wrapper').append(template);
                stepIndex++;
                updateStepOrders();
            });
        
            // ✅ حذف مرحلة
            $(document).on('click', '.remove-step', function () {
                $(this).closest('.approval-step').remove();
                updateStepOrders();
            });
        
        </script>
    @endpush
</div>
