@props([
    'sidebars' => \App\Facades\SidebarFacade::get(),
])


<div class="page-container">
    @if(Route::currentRouteName() == 'livewirePageGroup.scheduledConference.pages.home')
        <x-tempest::layouts.banner/>
    @endif
    <div class="mt-5 mb-20">    
        {{ $slot }}
    </div>

    @php
        $showCountdown = \App\Facades\Plugin::getPlugin('Tempest')->getSetting('show_countdown');
    @endphp
    
    @if($showCountdown)
    <script>
        let previousValues = {
            days: '00',
            hours: '00', 
            minutes: '00',
            seconds: '00'
        };

        function flipNumber(type, newValue) {
            const currentEl = document.getElementById(`${type}-current`);
            const nextEl = document.getElementById(`${type}-next`);
            const flipEl = document.getElementById(`${type}-flip`);
            
            if (currentEl && nextEl && flipEl && previousValues[type] !== newValue) {
                nextEl.textContent = newValue;
                flipEl.classList.add('flipping');
                
                setTimeout(() => {
                    currentEl.textContent = newValue;
                    flipEl.classList.remove('flipping');
                    previousValues[type] = newValue;
                }, 300);
            } else if (currentEl && !previousValues[type]) {
                currentEl.textContent = newValue;
                previousValues[type] = newValue;
            }
        }

    
        function updateCountdown() {
            const endDate = new Date("{{ $currentScheduledConference->date_start->format('Y-m-d H:i:s') }}").getTime();
            const now = new Date().getTime();
            const timeLeft = endDate - now;

            const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
            const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

            const newValues = {
                days: days.toString().padStart(2, '0'),
                hours: hours.toString().padStart(2, '0'),
                minutes: minutes.toString().padStart(2, '0'),
                seconds: seconds.toString().padStart(2, '0')
            };

            flipNumber('days', newValues.days);
            flipNumber('hours', newValues.hours);
            flipNumber('minutes', newValues.minutes);
            flipNumber('seconds', newValues.seconds);

            if (timeLeft < 0) {
                clearInterval(countdownTimer);
                document.querySelector('.countdown-con').innerHTML = `
                <div class="cd-passed p-2 sm:p-3 text-center rounded-lg shadow-lg">
                    <h2 class="text-white text-3xl sm:text-4xl md:text-5xl font-bold mb-2 sm:mb-4 animate__animated animate__fadeIn">
                        Conference has passed!
                    </h2>
                    <p class="text-gray-200 text-base sm:text-lg">
                        Thank you for your interest!
                    </p>
                </div>
                `;
            }
        }

        const countdownTimer = setInterval(updateCountdown, 1000);
        updateCountdown(); // Initial call

    </script>
    @endif
</div>