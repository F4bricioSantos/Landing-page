document.addEventListener('DOMContentLoaded', function() { 
    const prevBtn = document.querySelector('.prev-btn');
    const nextBtn = document.querySelector('.next-btn');
    const carrosel = document.querySelector('.carrosel');
    const items = document.querySelectorAll('.carrosel-item');
    const indicatorsContainer = document.querySelector('.indicators');
    const title = document.getElementById('title');
    const description = document.getElementById('description');

    let index = 0;
    const totalItems = items.length;

    function updateIndicators() {
        const indicators = indicatorsContainer.querySelectorAll('span');
        indicators.forEach((indicator, i) => {
            indicator.classList.toggle('active', i === index);
        });
    }

    function updateContent() {
        const currentItem = items[index];
        title.textContent = currentItem.getAttribute('data-title');
        description.textContent = currentItem.getAttribute('data-description');
    }

    function moveToIndex(newIndex) {
        if (newIndex < 0) {
            newIndex = totalItems - 1; 
        }
        if (newIndex >= totalItems) {
            newIndex = 0; 
        }

        carrosel.style.transform = `translateX(-${newIndex * 100}%)`;
        index = newIndex;

        updateIndicators();
        updateContent();
    }

    items.forEach((_, i) => {
        const indicator = document.createElement('span');
        if (i === 0) indicator.classList.add('active');
        indicator.addEventListener('click', () => moveToIndex(i));
        indicatorsContainer.appendChild(indicator);
    });

    prevBtn.addEventListener('click', () => moveToIndex(index - 1));
    nextBtn.addEventListener('click', () => moveToIndex(index + 1));

    updateContent();
});

document.querySelectorAll('.carrosel-item').forEach(item => {
    item.addEventListener('mouseover', () => {
        document.getElementById('description').textContent = item.getAttribute('data-description');
    });
});


const filterButtons = document.querySelectorAll('.filter-buttons button');
const cards = document.querySelectorAll('.cards .card');

filterButtons.forEach(button => {
    button.addEventListener('click', () => {
        const category = button.textContent;

        cards.forEach(card => {
            const cardCategory = card.querySelector('p:nth-of-type(2)').textContent; 
            
            if (category === 'TODOS' || cardCategory.includes(category)) {
                card.style.display = 'flex'; 
            } else {
                card.style.display = 'none'; 
            }
        });
    });
});


