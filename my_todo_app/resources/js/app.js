import './bootstrap';

// Bubble Animation
function createBubbles() {
    const container = document.querySelector('.bubble-container');
    if (!container) return;

    const bubbleCount = 12;
    
    for (let i = 0; i < bubbleCount; i++) {
        const bubble = document.createElement('div');
        bubble.className = 'bubble';
        
        // Random properties
        const size = Math.random() * 40 + 20; // 20-60px
        const left = Math.random() * 100; // 0-100%
        const duration = Math.random() * 48 + 12; // 12-60s
        const delay = Math.random() * 2; // 0-2s
        
        bubble.style.width = `${size}px`;
        bubble.style.height = `${size}px`;
        bubble.style.left = `${left}%`;
        bubble.style.animationDuration = `${duration}s`;
        bubble.style.animationDelay = `${delay}s`;
        
        container.appendChild(bubble);
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', () => {
    createBubbles();
});