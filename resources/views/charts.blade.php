<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Charts</title>
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
                    <div class="flex justify-center">
                        <!-- Explicitly set the width and height -->
                        <canvas id="completedChart" width="400" height="400"></canvas>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex justify-center">
                        <!-- Explicitly set the width and height -->
                        <canvas id="progressChart" width="400" height="400"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>

    <script>
        // Data for the chart
        const completedCount = @json($chartcompleted); // Count of 'Completed'
        const progressCount = @json($chartprogress); // Count of 'Progress'
        
        // Create the completed chart
        const completedChartCtx = document.getElementById('completedChart').getContext('2d');
        new Chart(completedChartCtx, {
            type: 'line',
            data: {
                labels: ['Completed'], // Single label for the pie chart
                datasets: [{
                    label: 'Number of Completed Tasks',
                    data: [completedCount], // The count from the database
                    backgroundColor: ['white'],
                    borderColor: ['rgba(75, 192, 192, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: false, // Disable responsiveness to control size
                maintainAspectRatio: true, // Keep 1:1 aspect ratio
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
                labels: ['Progress'], // Single label for the pie chart
                datasets: [{
                    label: 'Number of Progress Tasks',
                    data: [progressCount], // The correct count for progress
                    backgroundColor: ['white'],
                    borderColor: ['rgba(75, 192, 192, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: false, // Disable responsiveness to control size
                maintainAspectRatio: true, // Keep 1:1 aspect ratio
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
