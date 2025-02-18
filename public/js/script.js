$(document).ready(function() {
    // Sadece API endpoint'lerinde JSON parse işlemi yap
    if (window.location.pathname.startsWith('/api/') || window.location.pathname.startsWith('/user/')) {
        try {
            const rawContent = document.body.textContent.trim();
            if (rawContent) {
                const jsonData = JSON.parse(rawContent);
                document.body.innerHTML = '<pre class="json-response">' + JSON.stringify(jsonData, null, 2) + '</pre>';
            }
        } catch (e) {
            console.error('JSON parse hatası:', e);
        }
    }
}); 