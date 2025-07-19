<x-front-layout>
    @push('styles')
        <style>
            body {
                background-color: #f0f2f5;
                font-family: 'Segoe UI', sans-serif;
            }
            .confirmation-box {
                max-width: 600px;
                margin: 80px auto;
                background: #fff;
                border: 1.5px solid #dee2e6;
                padding: 40px;
                border-radius: 10px;
                box-shadow: 0 0 15px rgba(0,0,0,0.05);
                text-align: center;
            }
            .confirmation-title {
                background-color: #6c63ff;
                color: #fff;
                padding: 20px;
                font-size: 1.5rem;
                font-weight: bold;
                border-radius: 10px 10px 0 0;
                margin-bottom: 30px;
            }
            .confirmation-message {
                font-size: 1.2rem;
                color: #333;
                margin-bottom: 15px;
            }
            .confirmation-sub {
                color: #777;
            }
        </style>
    @endpush

    <div class="confirmation-box">
        <div class="confirmation-title">نموذج التسجيل للتطوع</div>
        @if($msg_type == 'done')
            <div class="confirmation-message">✅ تم إرسال ردك بنجاح!</div>
            <div class="confirmation-sub">شكراً لتسجيلك.</div>
        @elseif($msg_type == 'close')
            <div class="confirmation-message">❌ تم إغلاق النموذج</div>
            <div class="confirmation-sub">
                يرجى المحاولة مرة أخرى أو الاتصال بنا مباشرة.
            </div>
        @endif
    </div>
</x-front-layout>

