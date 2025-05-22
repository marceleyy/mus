// Set current year in footer
document.getElementById('current-year').textContent = new Date().getFullYear();

// Mobile menu toggle
const menuBtn = document.querySelector('.menu-btn');
const navLinks = document.querySelector('.nav-links');

if (menuBtn) {
    menuBtn.addEventListener('click', () => {
        navLinks.classList.toggle('show');
        menuBtn.classList.toggle('active');
        
        // Toggle icon
        const icon = menuBtn.querySelector('i');
        if (icon.classList.contains('fa-bars')) {
            icon.classList.remove('fa-bars');
            icon.classList.add('fa-times');
        } else {
            icon.classList.remove('fa-times');
            icon.classList.add('fa-bars');
        }
    });
}

// Dark mode toggle
const themeToggle = document.getElementById('theme-toggle');
const body = document.body;

if (themeToggle) {
    const icon = themeToggle.querySelector('i');
    
    // Check for saved theme preference or use system preference
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark' || (!savedTheme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        body.classList.add('dark-mode');
        icon.classList.remove('fa-moon');
        icon.classList.add('fa-sun');
    } else {
        body.classList.remove('dark-mode');
        icon.classList.remove('fa-sun');
        icon.classList.add('fa-moon');
    }
    
    // Theme toggle functionality
    themeToggle.addEventListener('click', () => {
        body.classList.toggle('dark-mode');
        
        // Toggle icon
        if (body.classList.contains('dark-mode')) {
            icon.classList.remove('fa-moon');
            icon.classList.add('fa-sun');
            localStorage.setItem('theme', 'dark');
        } else {
            icon.classList.remove('fa-sun');
            icon.classList.add('fa-moon');
            localStorage.setItem('theme', 'light');
        }
    });
}

// Event slider navigation
const eventPrev = document.querySelector('.event-nav.prev');
const eventNext = document.querySelector('.event-nav.next');
const eventDots = document.querySelectorAll('.event-dot');
const eventCards = document.querySelectorAll('.event-card');
let currentEvent = 0;

if (eventPrev && eventNext && eventDots.length > 0 && eventCards.length > 0) {
    // Function to show a specific event
    const showEvent = (index) => {
        // Calculate scroll position
        const eventSlider = document.querySelector('.events-slider');
        const cardWidth = eventCards[0].offsetWidth + 32; // Card width + gap
        eventSlider.scrollTo({
            left: cardWidth * index,
            behavior: 'smooth'
        });
        
        // Update active dot
        eventDots.forEach((dot, i) => {
            dot.classList.toggle('active', i === index);
        });
        
        currentEvent = index;
    };
    
    // Event listeners for dots
    eventDots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            showEvent(index);
        });
    });
    
    // Event listeners for prev/next buttons
    eventPrev.addEventListener('click', () => {
        currentEvent = (currentEvent - 1 + eventCards.length) % eventCards.length;
        showEvent(currentEvent);
    });
    
    eventNext.addEventListener('click', () => {
        currentEvent = (currentEvent + 1) % eventCards.length;
        showEvent(currentEvent);
    });
}

// Booking steps navigation
const steps = document.querySelectorAll('.step');
const stepContents = document.querySelectorAll('.booking-step-content');
const nextButtons = document.querySelectorAll('.next-step');
const prevButtons = document.querySelectorAll('.prev-step');
let currentStep = 1;

if (steps.length > 0 && stepContents.length > 0) {
    // Function to show a specific step
    const showStep = (stepNumber) => {
        // Update step indicators
        steps.forEach(step => {
            const stepNum = parseInt(step.getAttribute('data-step'));
            step.classList.toggle('active', stepNum <= stepNumber);
        });
        
        // Show the current step content
        stepContents.forEach((content, index) => {
            content.classList.toggle('active', index === stepNumber - 1);
        });
        
        currentStep = stepNumber;
        
        // Scroll to top of the form
        const bookingForm = document.querySelector('.booking-form');
        if (bookingForm) {
            bookingForm.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    };
    
    // Event listeners for next buttons
    nextButtons.forEach(button => {
        button.addEventListener('click', () => {
            if (currentStep < steps.length) {
                showStep(currentStep + 1);
            }
        });
    });
    
    // Event listeners for prev buttons
    prevButtons.forEach(button => {
        button.addEventListener('click', () => {
            if (currentStep > 1) {
                showStep(currentStep - 1);
            }
        });
    });
    
    // Calendar day selection
    const days = document.querySelectorAll('.day:not(.disabled)');
    days.forEach(day => {
        day.addEventListener('click', () => {
            days.forEach(d => d.classList.remove('selected'));
            day.classList.add('selected');
            
            // Update time slots heading
            const selectedDate = `${day.textContent} Juin 2025`;
            document.querySelector('.time-slots h4').textContent = `Horaires disponibles pour le ${selectedDate}`;
        });
    });
    
    // Time slot selection
    const timeSlots = document.querySelectorAll('.time-slot');
    timeSlots.forEach(slot => {
        slot.addEventListener('click', () => {
            timeSlots.forEach(s => s.classList.remove('selected'));
            slot.classList.add('selected');
        });
    });
    
    // Quantity buttons
    const minusButtons = document.querySelectorAll('.quantity-btn.minus');
    const plusButtons = document.querySelectorAll('.quantity-btn.plus');
    
    minusButtons.forEach(button => {
        button.addEventListener('click', () => {
            const input = button.nextElementSibling;
            let value = parseInt(input.value);
            if (value > parseInt(input.min)) {
                input.value = value - 1;
                updateTotalPrice();
            }
        });
    });
    
    plusButtons.forEach(button => {
        button.addEventListener('click', () => {
            const input = button.previousElementSibling;
            let value = parseInt(input.value);
            if (value < parseInt(input.max)) {
                input.value = value + 1;
                updateTotalPrice();
            }
        });
    });
    
    // Option toggles
    const optionToggles = document.querySelectorAll('.option-toggle');
    optionToggles.forEach(toggle => {
        toggle.addEventListener('change', () => {
            updateTotalPrice();
        });
    });
    
    // Update total price in summary
    function updateTotalPrice() {
        // This is a simplified version - in a real application, you would calculate this based on actual selections
        const summaryTickets = document.querySelector('.summary-tickets');
        const summaryOptions = document.querySelector('.summary-options');
        const totalValue = document.querySelector('.total-value');
        
        if (summaryTickets && summaryOptions && totalValue) {
            // For demo purposes, we'll just keep the hardcoded values
            // In a real application, you would calculate this dynamically
        }
    }
    
    // Complete purchase button
    const completeButton = document.getElementById('complete-purchase');
    if (completeButton) {
        completeButton.addEventListener('click', (e) => {
            e.preventDefault();
            alert('Merci pour votre achat ! Vous allez recevoir un email de confirmation avec vos billets.');
            // In a real application, you would submit the form and process the payment
        });
    }
}