import Chart from 'chart.js/auto';
import Sortable from 'sortablejs';
import axios from 'axios';
import { io } from 'socket.io-client';

document.addEventListener('DOMContentLoaded', () => {

    // ====================================================
    // 1. Admin Realtime Engine Connection
    // ====================================================
    const socketUrl = import.meta.env.VITE_REALTIME_SERVER_URL || 'http://localhost:3000';
    try {
        const socket = io(socketUrl);
        const adminVisitorCount = document.getElementById('adminLiveVisitorCount');

        socket.on('connect', () => {
            console.log('Connected to admin realtime engine');
        });

        socket.on('visitorCountUpdate', (count) => {
            if (adminVisitorCount) adminVisitorCount.textContent = count;
        });

        socket.on('newMessage', (data) => {
            console.log('New message received via Socket.io:', data);
            const notifList = document.getElementById('notificationsList');
            if (notifList) {
                if (window.location.pathname.includes('messages') || window.location.pathname.includes('notifications')) {
                    window.location.reload();
                }
            }
        });

    } catch (error) {
        console.warn('Real-time engine offline:', error);
    }

    // ====================================================
    // 2. Traffic Bar Chart (Visitors Last 7 Days)
    // ====================================================
    const trafficCanvas = document.getElementById('trafficChart');
    if (trafficCanvas) {
        let rawData = [];
        try {
            rawData = JSON.parse(trafficCanvas.dataset.stats || '[]');
        } catch(e) { rawData = []; }

        // Normalize: handle both array-of-objects and flat key-value from old format
        let labels, dataValues;
        if (Array.isArray(rawData)) {
            labels      = rawData.map(item => item.date  ?? item[0] ?? '');
            dataValues  = rawData.map(item => item.views ?? item[1] ?? 0);
        } else {
            // Object format fallback { "Mon": 5, ... }
            labels     = Object.keys(rawData);
            dataValues  = Object.values(rawData);
        }

        // If all zeroes, show placeholder bars so canvas isn't blank
        const hasData = dataValues.some(v => v > 0);
        const displayData = hasData ? dataValues : [120, 190, 150, 220, 300, 280, 210];
        const displayLabels = labels.length ? labels : ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'];

        new Chart(trafficCanvas, {
            type: 'bar',
            data: {
                labels: displayLabels,
                datasets: [{
                    label: hasData ? 'Visitors' : 'Sample Data',
                    data: displayData,
                    backgroundColor: 'rgba(99, 102, 241, 0.7)',
                    hoverBackgroundColor: 'rgba(99, 102, 241, 1)',
                    borderRadius: 6,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: 'rgba(10, 10, 20, 0.95)',
                        titleColor: '#ffffff',
                        bodyColor: '#a0a0b0',
                        padding: 12,
                        cornerRadius: 8,
                        displayColors: false,
                        callbacks: {
                            title: (items) => items[0].label,
                            label: (item) => `${item.raw} visitors${!hasData ? ' (sample)' : ''}`,
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { color: '#888899', font: { size: 12 } },
                        border: { display: false }
                    },
                    y: {
                        grid: { color: 'rgba(255, 255, 255, 0.04)', drawBorder: false },
                        ticks: { color: '#888899', font: { size: 12 } },
                        border: { display: false },
                        beginAtZero: true,
                    }
                }
            }
        });
    }

    // ====================================================
    // 3. Device Doughnut Chart
    // ====================================================
    const deviceCanvas = document.getElementById('deviceChart');
    if (deviceCanvas) {
        let rawData = [];
        try {
            rawData = JSON.parse(deviceCanvas.dataset.stats || '[]');
        } catch(e) { rawData = []; }

        let labels, dataValues;
        if (Array.isArray(rawData) && rawData.length > 0) {
            labels     = rawData.map(item => item.device_type ?? item.device ?? 'Unknown');
            dataValues = rawData.map(item => item.total       ?? item.count  ?? 0);
        } else {
            // Fallback sample when no visitors yet
            labels     = ['Desktop', 'Mobile', 'Tablet'];
            dataValues = [58, 34, 8];
        }

        const hasData = Array.isArray(rawData) && rawData.length > 0;

        new Chart(deviceCanvas, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: dataValues,
                    backgroundColor: [
                        '#6366f1',  // Desktop — indigo
                        '#10b981',  // Mobile  — emerald
                        '#f59e0b',  // Tablet  — amber
                        '#0ea5e9',  // Other   — sky
                    ],
                    borderWidth: 0,
                    hoverOffset: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#a0a0b0',
                            usePointStyle: true,
                            pointStyleWidth: 10,
                            padding: 16,
                            font: { size: 12 },
                            generateLabels: (chart) => {
                                const data = chart.data;
                                return data.labels.map((label, i) => {
                                    const total = data.datasets[0].data.reduce((a,b) => a+b, 0);
                                    const val   = data.datasets[0].data[i];
                                    const pct   = total ? Math.round(val / total * 100) : 0;
                                    return {
                                        text: `${label} ${pct}%${!hasData ? ' (sample)' : ''}`,
                                        fillStyle: data.datasets[0].backgroundColor[i],
                                        strokeStyle: 'transparent',
                                        pointStyle: 'circle',
                                        index: i
                                    };
                                });
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(10, 10, 20, 0.95)',
                        titleColor: '#ffffff',
                        bodyColor: '#a0a0b0',
                        padding: 12,
                        cornerRadius: 8,
                    }
                }
            }
        });
    }

    // ====================================================
    // 4. SortableJS for Projects
    // ====================================================
    const projectsSortable = document.getElementById('projectsSortable');
    if (projectsSortable) {
        Sortable.create(projectsSortable, {
            handle: '.drag-handle',
            animation: 150,
            ghostClass: 'bg-primary',
            onEnd: function () {
                const url = projectsSortable.dataset.url;
                const rows = Array.from(projectsSortable.querySelectorAll('tr'));
                const newOrder = rows.map((row, index) => ({
                    id: row.dataset.id,
                    order: index + 1
                }));

                axios.post(url, { order: newOrder })
                    .then(response => console.log('Reorder saved', response.data))
                    .catch(error => {
                        console.error('Error saving sort order', error);
                        alert('Could not save new order. Please refresh and try again.');
                    });
            }
        });
    }
});
