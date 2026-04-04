import './bootstrap';
import * as bootstrap from 'bootstrap';
import { io } from 'socket.io-client';
import AOS from 'aos';
import { gsap } from 'gsap';

window.bootstrap = bootstrap;

// Initialize AOS
AOS.init({
    once: true,
    offset: 50,
});

// Configure Axios
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

document.addEventListener('DOMContentLoaded', () => {
    // 1. Theme Toggle
    const themeToggle = document.getElementById('themeToggle');
    const htmlEl = document.documentElement;
    
    if (themeToggle) {
        // Load saved theme
        const savedTheme = localStorage.getItem('theme') || 'dark';
        htmlEl.setAttribute('data-bs-theme', savedTheme);
        updateThemeIcon(savedTheme);

        themeToggle.addEventListener('click', () => {
            const current = htmlEl.getAttribute('data-bs-theme');
            const next = current === 'dark' ? 'light' : 'dark';
            htmlEl.setAttribute('data-bs-theme', next);
            localStorage.setItem('theme', next);
            updateThemeIcon(next);
        });
    }

    function updateThemeIcon(theme) {
        if (!themeToggle) return;
        const icon = themeToggle.querySelector('i');
        if (theme === 'dark') {
            icon.className = 'bi bi-moon-stars-fill text-warning';
        } else {
            icon.className = 'bi bi-sun-fill text-warning';
        }
    }

    // 2. Realtime Visitors (Socket.io)
    // Connect to Node.js backend
    const socketUrl = import.meta.env.VITE_REALTIME_SERVER_URL || 'http://localhost:3000';
    try {
        const socket = io(socketUrl);
        const visitorBadge = document.getElementById('liveVisitorBadge');
        const visitorCount = document.getElementById('liveVisitorCount');

        socket.on('connect', () => {
            console.log('Connected to realtime engine');
            if (visitorBadge) visitorBadge.style.display = 'inline-flex';
            
            // Register pageview context (if we are on project page)
            const path = window.location.pathname;
            socket.emit('pageView', { path });
        });

        socket.on('visitorCountUpdate', (count) => {
            if (visitorCount) visitorCount.textContent = count;
        });

        socket.on('disconnect', () => {
            if (visitorBadge) visitorBadge.style.display = 'none';
        });
    } catch (error) {
        console.warn('Real-time engine offline:', error);
    }

    // 3. Contact Form AJAX
    const contactForm = document.getElementById('contactForm');
    const submitBtn   = document.getElementById('submitBtn');
    const formMessage = document.getElementById('formMessage');

    if (contactForm) {
        contactForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            // Loading state
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.textContent = 'Sending…';
            }
            if (formMessage) {
                formMessage.className = 'mt-3 text-center rounded p-3';
                formMessage.classList.add('d-none');
            }

            try {
                const formData = new FormData(contactForm);
                const response = await axios.post(contactForm.action, formData);

                // Success
                contactForm.reset();
                if (formMessage) {
                    formMessage.textContent = response.data.message || 'Message sent successfully!';
                    formMessage.style.cssText = 'background:rgba(16,185,129,0.1);color:#10b981;border:1px solid rgba(16,185,129,0.25);border-radius:8px;padding:0.75rem;margin-top:0.75rem;display:block;';
                }

            } catch (error) {
                const msg = error.response?.data?.message || 'Failed to send message. Please try again.';
                if (formMessage) {
                    formMessage.textContent = msg;
                    formMessage.style.cssText = 'background:rgba(239,68,68,0.1);color:#ef4444;border:1px solid rgba(239,68,68,0.25);border-radius:8px;padding:0.75rem;margin-top:0.75rem;display:block;';
                }
            } finally {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Send Message';
                }
            }
        });
    }

    // GSAP Intro animation for hero
    if (document.querySelector('.hero-btn')) {
        gsap.fromTo('.hero-btn', 
            { y: 20, opacity: 0 }, 
            { y: 0, opacity: 1, duration: 0.8, stagger: 0.2, ease: "power2.out", delay: 0.5 }
        );
    }
});
