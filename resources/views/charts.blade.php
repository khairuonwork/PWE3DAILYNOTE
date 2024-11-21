<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="icon" href="/notepad.png" type="image/x-icon">
    <title>Charts</title>
    <style>
        .chart-row {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 30px;
        }
    </style>
</head>
<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Charts') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="chart-row">
                        <!-- Chart 1 -->
                        <canvas id="completedChart" width="300" height="300"></canvas>

                        <!-- Chart 2 -->
                        <canvas id="progressChart" width="300" height="300"></canvas>

                        <!-- Chart 3 -->
                        <canvas id="pendingChart" width="300" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>

    <script>
        // Data for the charts
        const completedCount = @json($chartcompleted); // Count of 'Completed'
        const progressCount = @json($chartprogress); // Count of 'Progress'
        const pendingCount = @json($chartpending); // Count of 'Pending'

        // Common y-axis configuration
        const yAxisConfig = {
            min: 0,
            max: 10,
            stepSize: 1,
        };

        // Create the completed chart
        const completedChartCtx = document.getElementById('completedChart').getContext('2d');
        new Chart(completedChartCtx, {
            type: 'line',
            data: {
                labels: ['Completed'],
                datasets: [{
                    label: 'Number of Completed Tasks',
                    data: [completedCount],
                    backgroundColor: ['rgba(75, 192, 192, 0.2)'],
                    borderColor: ['rgba(75, 192, 192, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: false,
                maintainAspectRatio: true,
                scales: {
                    y: yAxisConfig
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    },
                }
            }
        });

        // Create the progress chart
        const progressChartCtx = document.getElementById('progressChart').getContext('2d');
        new Chart(progressChartCtx, {
            type: 'line',
            data: {
                labels: ['Progress'],
                datasets: [{
                    label: 'Number of Progress Tasks',
                    data: [progressCount],
                    backgroundColor: ['rgba(192, 192, 75, 0.2)'],
                    borderColor: ['rgba(192, 192, 75, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: false,
                maintainAspectRatio: true,
                scales: {
                    y: yAxisConfig
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    },
                }
            }
        });

        // Create the pending chart
        const pendingChartCtx = document.getElementById('pendingChart').getContext('2d');
        new Chart(pendingChartCtx, {
            type: 'line',
            data: {
                labels: ['Pending'],
                datasets: [{
                    label: 'Number of Pending Tasks',
                    data: [pendingCount],
                    backgroundColor: ['rgba(192, 75, 75, 0.2)'],
                    borderColor: ['rgba(192, 75, 75, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: false,
                maintainAspectRatio: true,
                scales: {
                    y: yAxisConfig
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    },
                }
            }
        });
    </script>
</body>
</html>
