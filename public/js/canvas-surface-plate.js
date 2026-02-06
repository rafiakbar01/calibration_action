// ============================================
// CANVAS SURFACE PLATE - FIXED VERSION
// ============================================

console.log('🎯 CANVAS SURFACE PLATE - Fixed Version');

// Variables
let canvas, ctx;
let drawing = false;
let lastX = 0, lastY = 0;
let dots = [];
let lines = [];
let currentLine = null;
let isInitialized = false;
let observer = null;
let checkTimeout = null;

// DEBOUNCE FUNCTION
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// OBSERVER DENGAN DEBOUNCE
function setupCanvasObserver() {
    console.log('👀 Setting up canvas observer...');
    
    checkForCanvasOnce();
    
    observer = new MutationObserver(debounce(function(mutations) {
        let shouldCheck = false;
        
        mutations.forEach(function(mutation) {
            if (mutation.addedNodes.length > 0) {
                mutation.addedNodes.forEach(function(node) {
                    if (node.nodeType === 1) {
                        if (node.tagName === 'CANVAS' || 
                            (node.querySelector && (
                                node.querySelector('#drawCanvas') ||
                                node.querySelector('canvas.drawing-canvas') ||
                                node.querySelector('.canvas-wrapper') ||
                                node.querySelector('.drawing-container')
                            ))) {
                            shouldCheck = true;
                        }
                    }
                });
            }
        });
        
        if (shouldCheck && !isInitialized) {
            // console.log('🔄 DOM changed, checking for canvas...');
            checkForCanvasOnce();
        }
    }, 300));
    
    observer.observe(document.body, {
        childList: true,
        subtree: true
    });
    
    console.log('✅ Canvas observer activated');
}

function checkForCanvasOnce() {
    if (checkTimeout) {
        clearTimeout(checkTimeout);
        checkTimeout = null;
    }
    
    checkTimeout = setTimeout(() => {
        performCanvasCheck();
    }, 100);
}

function performCanvasCheck() {
    if (isInitialized) {
        // console.log('⏹️ Already initialized, skipping check');
        return;
    }
    
    // console.log('🔍 Checking for canvas...');
    
    canvas = document.getElementById('drawCanvas');
    if (!canvas) canvas = document.querySelector('canvas.drawing-canvas');
    if (!canvas) canvas = document.querySelector('.canvas-wrapper canvas');
    
    if (!canvas) {
        // console.log('📭 Canvas not found yet');
        return;
    }
    
    // console.log('✅ Canvas found! Initializing...');
    
    if (observer) {
        observer.disconnect();
        observer = null;
        // console.log('🛑 Observer stopped');
    }
    
    initializeCanvas();
}

// INITIALIZATION
function initializeCanvas() {
    if (isInitialized) {
        // console.warn('⚠️ Already initialized!');
        return;
    }
    
    // console.log('🔧 Initializing canvas...');
    
    ctx = canvas.getContext('2d');
    if (!ctx) {
        console.error('Cannot get 2D context');
        return;
    }
    
    setupCanvas();
    addTools();
    
    isInitialized = true;
    
    // console.log('✅ Canvas initialized successfully!');
    // showNotification('Canvas Surface Plate siap digunakan!');
}

function setupCanvas() {
    const container = canvas.parentElement;
    if (container && container.clientWidth > 0) {
        canvas.width = container.clientWidth;
    } else {
        canvas.width = 400;
    }
    canvas.height = 280;
    
    // Reset canvas styling
    canvas.style.border = '1px solid #000';
    canvas.style.background = '#fff';
    canvas.style.cursor = 'crosshair';
    canvas.style.width = '100%';
    
    // Setup context dengan settings yang benar
    ctx = canvas.getContext('2d', {
        alpha: true, // Aktifkan alpha channel
        desynchronized: false,
        willReadFrequently: false
    });
    
    // Reset context
    ctx.globalCompositeOperation = 'source-over';
    ctx.globalAlpha = 1.0;
    ctx.imageSmoothingEnabled = true;
    ctx.imageSmoothingQuality = 'high';
    
    // Clear dengan putih
    ctx.fillStyle = '#FFFFFF';
    ctx.fillRect(0, 0, canvas.width, canvas.height);
    
    setupCanvasEvents();
    redraw();
}

function addTools() {
    const tools = document.querySelector('.simple-tools');
    if (!tools) {
        console.warn('Tools container not found');
        return;
    }
    
    if (document.getElementById('canvasTools')) {
        // console.log('Tools already exist');
        return;
    }
    
    const toolsDiv = document.createElement('div');
    toolsDiv.id = 'canvasTools';
    toolsDiv.style.cssText = `
        display: inline-block;
        margin-right: 15px;
        padding: 5px;
        background: #f5f5f5;
        border-radius: 4px;
        border: 1px solid #ddd;
    `;
    
    toolsDiv.innerHTML = `
    <span style="
        font-weight: 600;
        color: #333;
        font-size: 14px;
        white-space: nowrap;
    ">
        🎨 Tools:
    </span>
    
    <button id="canvasDrawBtn" style="
        padding: 6px 12px;
        background: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-weight: 600;
        font-size: 12px;
        height: 32px;
        flex-shrink: 0;
        white-space: nowrap;
    ">
        ✏️ Garis
    </button>
    
    <button id="canvasDotBtn" style="
        padding: 6px 12px;
        background: #28a745;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-weight: 400;
        font-size: 12px;
        height: 32px;
        flex-shrink: 0;
        white-space: nowrap;
    ">
        🔘 Titik
    </button>
    
    <button id="canvasClearBtn" style="
        padding: 6px 12px;
        background: #dc3545;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-weight: 400;
        font-size: 12px;
        height: 32px;
        flex-shrink: 0;
        white-space: nowrap;
    ">
        🗑️ Hapus Semua
    </button>
`;
    
    tools.insertBefore(toolsDiv, tools.firstChild);
    
    // PERBAIKAN: Gunakan event listener yang benar
    document.getElementById('canvasDrawBtn').addEventListener('click', function(e) {
        e.preventDefault(); // Mencegah submit form
        e.stopPropagation(); // Mencegah event bubbling
        setTool('draw');
        // showNotification('Mode: Gambar Garis • Klik dan drag untuk menggambar');
    });
    
    document.getElementById('canvasDotBtn').addEventListener('click', function(e) {
        e.preventDefault(); // Mencegah submit form
        e.stopPropagation(); // Mencegah event bubbling
        setTool('dot');
        // showNotification('Mode: Tambah Titik • Klik: tambah titik • Shift+Klik: hapus titik');
    });
    
    document.getElementById('canvasClearBtn').addEventListener('click', function(e) {
        e.preventDefault(); // Mencegah submit form
        e.stopPropagation(); // Mencegah event bubbling
        clearAll();
    });
    
    // console.log('✅ Tools added');
}

function setTool(toolType) {
    if (!isInitialized) return;
    
    // Update button styles
    const btnDraw = document.getElementById('canvasDrawBtn');
    const btnDot = document.getElementById('canvasDotBtn');
    
    if (btnDraw && btnDot) {
        if (toolType === 'draw') {
            btnDraw.style.background = '#007bff';
            btnDraw.style.fontWeight = 'bold';
            btnDot.style.background = '#28a745';
            btnDot.style.fontWeight = 'normal';
            canvas.style.cursor = 'crosshair';
        } else {
            btnDraw.style.background = '#007bff';
            btnDraw.style.fontWeight = 'normal';
            btnDot.style.background = '#28a745';
            btnDot.style.fontWeight = 'bold';
            canvas.style.cursor = 'pointer';
        }
    }
    
    // Set current tool
    window.currentTool = toolType;
    
    // Setup drawing style
    if (toolType === 'draw') {
        ctx.lineWidth = 2;
        ctx.lineCap = 'round';
        ctx.lineJoin = 'round';
        ctx.strokeStyle = '#000000';
        ctx.fillStyle = '#000000';
    }
}

function setupCanvasEvents() {
    // Clear existing events
    const newCanvas = canvas.cloneNode(true);
    canvas.parentNode.replaceChild(newCanvas, canvas);
    canvas = document.getElementById('drawCanvas') || document.querySelector('canvas.drawing-canvas');
    ctx = canvas.getContext('2d');
    
    // Re-apply styles
    canvas.style.border = '1px solid #000';
    canvas.style.background = '#fff';
    canvas.style.cursor = 'crosshair';
    
    // Add event listeners
    canvas.addEventListener('mousedown', handleMouseDown);
    canvas.addEventListener('mousemove', handleMouseMove);
    canvas.addEventListener('mouseup', handleMouseUp);
    canvas.addEventListener('mouseout', handleMouseOut);
    
    // Start with draw tool
    setTool('draw');
}

function handleMouseDown(e) {
    e.preventDefault(); // PERBAIKAN: Mencegah default behavior
    e.stopPropagation(); // Mencegah event bubbling
    
    const rect = canvas.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;
    
    if (window.currentTool === 'draw') {
        // Mulai menggambar garis
        drawing = true;
        lastX = x;
        lastY = y;
        
        currentLine = {
            points: [{x: x, y: y}],
            color: '#000000',
            width: 2
        };
        
        ctx.beginPath();
        ctx.moveTo(x, y);
        
    } else if (window.currentTool === 'dot') {
        // Mode titik
        if (e.shiftKey) {
            // Shift + klik: hapus titik
            removeDotAt(x, y);
        } else {
            // Klik biasa: tambah titik
            dots.push({
                x: x,
                y: y,
                id: Date.now() + Math.random()
            });
        }
        redraw();
    }
}

function handleMouseMove(e) {
    e.preventDefault();
    
    if (!drawing || window.currentTool !== 'draw') return;
    
    const rect = canvas.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;
    
    // Gambar garis sementara
    ctx.lineTo(x, y);
    ctx.stroke();
    
    // Tambahkan titik ke garis saat ini
    if (currentLine) {
        currentLine.points.push({x: x, y: y});
    }
    
    lastX = x;
    lastY = y;
}

function handleMouseUp(e) {
    if (e) {
        e.preventDefault();
        e.stopPropagation();
    }
    
    if (drawing && window.currentTool === 'draw' && currentLine) {
        drawing = false;
        
        // Simpan garis yang sudah selesai
        if (currentLine.points.length > 1) {
            lines.push({
                points: [...currentLine.points],
                color: currentLine.color,
                width: currentLine.width
            });
        }
        
        currentLine = null;
        ctx.beginPath();
    }
}

function handleMouseOut(e) {
    if (e) {
        e.preventDefault();
    }
    
    if (drawing) {
        handleMouseUp();
    }
}

function removeDotAt(x, y) {
    for (let i = 0; i < dots.length; i++) {
        const dot = dots[i];
        const distance = Math.sqrt(Math.pow(dot.x - x, 2) + Math.pow(dot.y - y, 2));
        if (distance < 10) {
            dots.splice(i, 1);
            redraw();
            // showNotification('Titik dihapus');
            return;
        }
    }
}

function redraw() {
    if (!isInitialized) return;
    
    // Clear canvas dengan putih
    ctx.fillStyle = '#FFFFFF';
    ctx.fillRect(0, 0, canvas.width, canvas.height);
    
    // Set ulang composite operation
    ctx.globalCompositeOperation = 'source-over';
    
    // Gambar semua garis
    lines.forEach(line => {
        if (line.points.length > 1) {
            ctx.beginPath();
            ctx.moveTo(line.points[0].x, line.points[0].y);
            
            for (let i = 1; i < line.points.length; i++) {
                ctx.lineTo(line.points[i].x, line.points[i].y);
            }
            
            ctx.strokeStyle = '#000000'; // Warna hitam
            ctx.lineWidth = 2;
            ctx.lineCap = 'round';
            ctx.lineJoin = 'round';
            ctx.stroke();
        }
    });
    
    // Gambar garis yang sedang dibuat
    if (drawing && currentLine && currentLine.points.length > 1) {
        ctx.beginPath();
        ctx.moveTo(currentLine.points[0].x, currentLine.points[0].y);
        
        for (let i = 1; i < currentLine.points.length; i++) {
            ctx.lineTo(currentLine.points[i].x, currentLine.points[i].y);
        }
        
        ctx.strokeStyle = '#000000';
        ctx.lineWidth = 2;
        ctx.stroke();
    }
    
    // Gambar titik-titik (TANPA ANGKA)
    drawDots();
    
    // Gambar border canvas
    ctx.strokeStyle = '#000000';
    ctx.lineWidth = 1;
    ctx.strokeRect(0, 0, canvas.width, canvas.height);
    
    // Hapus semua text/title yang tidak perlu
    // Hanya canvas kosong dengan gambar saja
}

function drawDots() {
    dots.forEach((dot) => {
        // Gambar titik hitam SIMPLE tanpa angka
        ctx.beginPath();
        ctx.arc(dot.x, dot.y, 4, 0, Math.PI * 2); // Radius 4px
        
        // Warna hitam solid
        ctx.fillStyle = '#000000';
        ctx.fill();
        
        // Border tipis hitam
        ctx.strokeStyle = '#000000';
        ctx.lineWidth = 1;
        ctx.stroke();
        
        // TIDAK ADA ANGKA/LABEL
    });
}



function clearAll() {
    if (!isInitialized) return;
    
    if (confirm('Hapus semua garis dan titik?')) {
        lines = [];
        dots = [];
        currentLine = null;
        drawing = false;
        redraw();
        // showNotification('Semua garis dan titik telah dihapus');
    }
}

function showNotification(message) {
    const existing = document.getElementById('canvasNotification');
    if (existing) existing.remove();
    
    const notification = document.createElement('div');
    notification.id = 'canvasNotification';
    notification.style.cssText = `
        position: fixed;
        top: 10px;
        right: 10px;
        background: #333;
        color: white;
        padding: 10px 15px;
        border-radius: 4px;
        z-index: 10000;
        font-size: 12px;
        animation: fadeIn 0.3s;
    `;
    
    const style = document.createElement('style');
    style.textContent = `
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    `;
    document.head.appendChild(style);
    
    notification.textContent = message;
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.opacity = '0';
        notification.style.transition = 'opacity 0.5s';
        setTimeout(() => notification.remove(), 500);
    }, 3000);
}

// PERBAIKAN: Prevent form submission dari tombol canvas
document.addEventListener('DOMContentLoaded', function() {
    // Cegah form submission kalau ada form di halaman
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            // Cek jika submit berasal dari tombol canvas
            const activeElement = document.activeElement;
            if (activeElement && 
                (activeElement.id === 'canvasDrawBtn' || 
                 activeElement.id === 'canvasDotBtn' || 
                 activeElement.id === 'canvasClearBtn')) {
                e.preventDefault();
                e.stopPropagation();
                return false;
            }
        }, true);
    });
});

// STARTUP
window.addEventListener('DOMContentLoaded', function() {
    // console.log('📄 DOM loaded, setting up canvas detection...');
    
    setupCanvasObserver();
    
    setInterval(() => {
        if (!isInitialized) {
            // console.log('⏰ Periodic check for canvas...');
            checkForCanvasOnce();
        }
    }, 5000);
});

// Global functions
window.clearCanvas = clearAll;
window.initializeCanvas = initializeCanvas;
window.setTool = setTool;

// console.log('🚀 Canvas Surface Plate Fixed script loaded');