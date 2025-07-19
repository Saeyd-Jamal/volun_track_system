<x-dashboard-layout>

    <html lang="ar" dir="rtl">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>نظام تتبع طلبات التطوع</title>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <style>
            body {
                font-family: 'Cairo', sans-serif;
                text-align: center;
                background-color: #f9f9f9;
                padding: 2rem;
            }

            #chart-container {
                width: 400px;
                height: 400px;
                margin: auto;
                animation: spin 2s ease-out 1;
            }

            @keyframes spin {
                0% {
                    transform: rotate(0deg);
                }

                100% {
                    transform: rotate(360deg);
                }
            }
        </style>
    </head>

    <body>
        <h2>نظام تتبع طلبات التطوع</h2>
        <div id="chart-container">
            <canvas id="statusChart"></canvas>
        </div>

        <script>
            const ctx = document.getElementById('statusChart').getContext('2d');

            const data = {
                labels: ['قيد المراجعة', 'مقبول', 'مرفوض'],
                datasets: [{
                    label: 'نسبة الطلبات',
                    data: [
                        {{ $data['pending'] }},
                        {{ $data['approved'] }},
                        {{ $data['rejected'] }},
                    ], // يفضل جلبها من Laravel ديناميكيًا
                    backgroundColor: [
                        'rgba(255, 192, 203, 0.5)', // زهري شفاف
                        'rgba(138, 43, 226, 0.5)', // بنفسجي شفاف
                        'rgba(135, 206, 250, 0.5)' // أزرق شفاف
                    ],
                    borderColor: [
                        'rgba(255, 192, 203, 1)',
                        'rgba(138, 43, 226, 1)',
                        'rgba(135, 206, 250, 1)'
                    ],
                    borderWidth: 2
                }]
            };

            const config = {
                type: 'doughnut',
                data: data,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                font: {
                                    size: 16
                                }
                            }
                        }
                    },
                    cutout: '70%'
                }
            };

            new Chart(ctx, config);
        </script>
    </body>

    </html>

</x-dashboard-layout>
