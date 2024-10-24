const quotes = [
    "Success is stumbling from failure to failure with no loss of enthusiasm. — Winston S. Churchill",
    "The man who moves a mountain begins by carrying away small stones. — Confucius",
    "You cannot swim for new horizons until you have the courage to lose sight of the shore. — William Faulkner",
    "There is no greater agony than bearing an untold story inside you. — Maya Angelou",
    "Do not wait for the perfect moment, take the moment and make it perfect. — Unknown",
    "Don't wish it were easier. Wish you were better. — Jim Rohn",
    "What we fear doing most is usually what we most need to do. — Tim Ferriss",
    "Courage doesn't always roar, sometimes it's the quiet voice at the end of the day saying, 'I will try again tomorrow.' — Mary Anne Radmacher",
    "It is not the mountain we conquer, but ourselves. — Sir Edmund Hillary",
    "Be like a tree and let the dead leaves drop. — Rumi",
    "Act as if what you do makes a difference. It does. — William James",
    "It’s not whether you get knocked down, it’s whether you get up. — Vince Lombardi",
    "Happiness depends upon ourselves. — Aristotle",
    "The only way to do great work is to love what you do. — Steve Jobs",
    "Do what you can, with what you have, where you are. — Theodore Roosevelt",
    "It always seems impossible until it’s done. — Nelson Mandela",
    "Don’t count the days; make the days count. — Muhammad Ali",
    "Strive not to be a success, but rather to be of value. — Albert Einstein",
    "What lies behind us and what lies before us are tiny matters compared to what lies within us. — Ralph Waldo Emerson",
    "The best time to plant a tree was 20 years ago. The second-best time is now. — Chinese Proverb"
];

function getRandomQuote() {
    return quotes[Math.floor(Math.random() * quotes.length)];
}

function showQuote() {
    const quoteElement = document.getElementById('quote');
    const quoteContainer = document.querySelector('.quote-container');
    
    // greeting
    const greeting = "Hey Gokul, how are you today?";
    const quote = getRandomQuote();

    // Remove fade-in, change quote, and add fade-in back for smooth transition
    quoteElement.classList.remove('fade-in');
    setTimeout(() => {
        // icon, greeting, separator, and the quote
        quoteElement.innerHTML = `
            <span class="quote-icon">🌟</span>
            <span class="quote-greeting">${greeting}</span>
            <div class="separator"></div>
            <span class="quote-content">${quote}</span>
        `;
        quoteElement.classList.add('fade-in');
        quoteContainer.style.opacity = 1; // making container visible
    }, 100);
}

// Showing first quote immediately
showQuote();

// Automatically update the quote every 10 seconds
setInterval(showQuote, 10000);
