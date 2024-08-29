async function fetchNews() {
    const response = await fetch('/api/news');
    const articles = await response.json();
    const container = document.getElementById('newsContainer');
    container.innerHTML = '';
    articles.forEach(article => {
        const div = document.createElement('div');
        div.className = 'article';
        div.innerHTML = `<h2>${article.title}</h2><p>${article.content}</p>`;
        container.appendChild(div);
    });
}

document.addEventListener('DOMContentLoaded', fetchNews);
