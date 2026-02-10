document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('ov-template-search-input');
    const templateCards = document.querySelectorAll('.inner-cards');

    searchInput.addEventListener('input', function() {
        const query = this.value.trim().toLowerCase();
        let anyVisible = false;
    
        templateCards.forEach(card => {
            const title = card.getAttribute('data-title');
            if (title.includes(query)) {
                card.style.display = '';
                anyVisible = true;
            } else {
                card.style.display = 'none';
            }
        });
    
        document.getElementById('no-templates-found').style.display = anyVisible ? 'none' : 'block';
    });
});