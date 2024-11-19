<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="/notepad.png" type="image/x-icon">

    <title>Dashboard Daily Note</title>
</head>
<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div id="clock" class="text-3xl font-semibold"></div> <!-- Added clock display element -->
                        
                        <script>
                            function currentTime() {
                                let date = new Date(); 
                                let hh = date.getHours();
                                let mm = date.getMinutes();
                                let ss = date.getSeconds();
                                let session = "AM";

                                if (hh == 0) {
                                    hh = 12;
                                }
                                if (hh > 12) {
                                    hh = hh - 12;
                                    session = "PM";
                                }

                                hh = (hh < 10) ? "0" + hh : hh;
                                mm = (mm < 10) ? "0" + mm : mm;
                                ss = (ss < 10) ? "0" + ss : ss;
                                    
                                let time = hh + ":" + mm + ":" + ss + " " + session;
                                document.getElementById("clock").innerText = time; 
                                
                                setTimeout(currentTime, 1000); // Replaced function() with currentTime
                            }

                            currentTime(); // Initial call to start the clock
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>    
</body>
</html>
