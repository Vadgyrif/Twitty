"use strict"

console.log('hello');


document.addEventListener('DOMContentLoaded', function() {
    const twittsContainer = document.querySelector('.twitts');
    const twitts = document.querySelectorAll('.twitt');

    // Додаємо подію при скролінгу
    twittsContainer.addEventListener('scroll', function() {
        const containerTop = twittsContainer.getBoundingClientRect().top;

        twitts.forEach(function(twitt) {
            const twittTop = twitt.getBoundingClientRect().top;

            // Чим ближче верх твіта до верху контейнера, тим більше він зникає
            if (twittTop < containerTop + 100) {
                let opacity = (twittTop - containerTop) / 100; // Зменшення прозорості
                twitt.style.opacity = Math.max(opacity, 0); // Забезпечуємо мінімум 0
            } else {
                twitt.style.opacity = 1; // Повертаємо до 1, коли нижче за верхню границю
            }
        });
    });
});
