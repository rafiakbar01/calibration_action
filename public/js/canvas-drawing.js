// ============================================
// CANVAS DRAWING SCRIPT - PHP COMPATIBLE
// ============================================

console.log('🎨 CANVAS DRAWING SCRIPT LOADED - PHP COMPATIBLE');

// Global variables
let currentColor = 'black';
let currentSize = 3;
let ctx = null;
let canvas = null;
let drawing = false;
let lastX = 0;
let lastY = 0;

// ============================================
// DEBUGGING FUNCTIONSf
// ============================================

function debugLog(message, type = 'info') {
    const timestamp = new Date().toLocaleTimeString();
    const logMessage = `[${timestamp}] ${message}`;
    
    switch(type) {
        case 'error':
            console.error(`❌ ${logMessage}`);
            break;
        case 'warning':
            console.warn(`⚠️ ${logMessage}`);
            break;
        case 'success':
            console.log(`✅ ${logMessage}`);
            break;
        default:
            console.log(`📝 ${logMessage}`);
    }
}

// ============================================
// WAIT FOR ELEMENT FUNCTION
// ============================================

function waitForElement(selector, timeout = 5000) {
    return new Promise((resolve, reject) => {
        const startTime = Date.now();
        
        function check() {
            const element = document.querySelector(selector);
            if (element) {
                resolve(element);
                return;
            }
            
            if (Date.now() - startTime > timeout) {
                reject(new Error(`Element ${selector} not found after ${timeout}ms`));
                return;
            }
            
            setTimeout(check, 100);
        }
        
        check();
    });
}

// ============================================
// MAIN INITIALIZATION
// ============================================

async function initializeCanvas() {
    debugLog('🔄 Initializing canvas for PHP-generated table...');
    
    try {
        // 1. Tunggu sampai tabel muncul (PHP selesai render)
        debugLog('⏳ Waiting for table to be rendered by PHP...');
        
        // Tunggu elemen tabel atau canvas
        const canvasElement = await waitForElement('#drawCanvas, canvas.drawing-canvas, .drawing-container canvas, table canvas, .keterangan-cell canvas');
        
        debugLog(`✅ Canvas found: ${canvasElement.tagName} ${canvasElement.id || canvasElement.className}`);
        canvas = canvasElement;
        
        // 2. Get canvas context
        ctx = canvas.getContext('2d');
        if (!ctx) {
            throw new Error('Could not get 2D context');
        }
        
        // 3. Setup canvas dimensions
        const container = canvas.parentElement;
        if (container) {
            const containerWidth = container.clientWidth;
            if (containerWidth > 0) {
                canvas.width = containerWidth;
                canvas.style.width = '100%';
            }
        }
        
        // 4. Initialize drawing
        initCanvasDrawing();
        
        // 5. Setup tools
        setupToolButtons();
        
        debugLog('🎉 Canvas initialization SUCCESS!');
        showSuccessMessage('');
        
        // Update debug panel jika ada
        updateDebugPanel();
        
    } catch (error) {
        debugLog(`❌ Initialization failed: ${error.message}`, 'error');
        
        // Emergency fallback - create canvas manually
        createEmergencyCanvas();
    }
}

function initCanvasDrawing() {
    debugLog('🎨 Initializing canvas drawing...');
    
    // Clear canvas with white background
    ctx.fillStyle = 'white';
    ctx.fillRect(0, 0, canvas.width, canvas.height);
    
    // Set drawing styles
    ctx.lineJoin = 'round';
    ctx.lineCap = 'round';
    ctx.strokeStyle = currentColor;
    ctx.lineWidth = currentSize;
    
    // Add red border for visibility
    ctx.strokeStyle = '#ff0000';
    ctx.lineWidth = 2;
    ctx.strokeRect(0, 0, canvas.width, canvas.height);
    ctx.strokeStyle = currentColor;
    ctx.lineWidth = currentSize;
    
    // Add event listeners
    setupDrawingEvents();
    
    debugLog('✅ Canvas drawing initialized');
}

function setupDrawingEvents() {
    // Mouse events
    canvas.addEventListener('mousedown', startDrawing);
    canvas.addEventListener('mousemove', draw);
    canvas.addEventListener('mouseup', stopDrawing);
    canvas.addEventListener('mouseout', stopDrawing);
    
    // Touch events for mobile
    canvas.addEventListener('touchstart', handleTouchStart, { passive: false });
    canvas.addEventListener('touchmove', handleTouchMove, { passive: false });
    canvas.addEventListener('touchend', handleTouchEnd);
    
    debugLog('✅ Drawing events registered');
}

function setupToolButtons() {
    debugLog('🛠️ Setting up tool buttons...');
    
    // Tunggu sebentar untuk memastikan buttons sudah ada
    setTimeout(() => {
        // Clear button
        const clearBtn = document.getElementById('clearBtn');
        if (clearBtn) {
            clearBtn.addEventListener('click', clearCanvas);
            debugLog('✅ Clear button registered');
        } else {
            // Cari dengan selector lain
            const clearButton = document.querySelector('.tool-btn, button[onclick*="clear"], button:contains("Hapus")');
            if (clearButton) {
                clearButton.addEventListener('click', clearCanvas);
                clearButton.id = 'clearBtn'; // Tambah ID
                debugLog('✅ Clear button found by selector');
            }
        }
        
        // Color buttons
        const colorButtons = document.querySelectorAll('.color-btn, span[data-color], span[style*="background"]');
        colorButtons.forEach((btn, index) => {
            btn.addEventListener('click', function() {
                const color = this.getAttribute('data-color') || 
                             this.style.backgroundColor || 
                             'black';
                setColor(color);
            });
            // Tambah ID jika belum ada
            if (!btn.id) {
                btn.id = `colorBtn${index}`;
            }
        });
        debugLog(`✅ ${colorButtons.length} color buttons registered`);
        
        // Size buttons
        const sizeButtons = document.querySelectorAll('.size-btn, button[data-size]');
        sizeButtons.forEach((btn, index) => {
            btn.addEventListener('click', function() {
                const size = parseInt(this.getAttribute('data-size') || '3');
                setSize(size);
            });
        });
        debugLog(`✅ ${sizeButtons.length} size buttons registered`);
        
        // Set initial active states
        setColor(currentColor);
        setSize(currentSize);
        
    }, 300); // Tunggu 300ms untuk PHP render selesai
}

// ============================================
// DRAWING FUNCTIONS
// ============================================

function startDrawing(e) {
    e.preventDefault();
    drawing = true;
    
    const rect = canvas.getBoundingClientRect();
    lastX = e.clientX - rect.left;
    lastY = e.clientY - rect.top;
    
    ctx.beginPath();
    ctx.moveTo(lastX, lastY);
}

function draw(e) {
    if (!drawing) return;
    
    e.preventDefault();
    const rect = canvas.getBoundingClientRect();
    const currentX = e.clientX - rect.left;
    const currentY = e.clientY - rect.top;
    
    // Draw line
    ctx.lineTo(currentX, currentY);
    ctx.stroke();
    
    // Update last position
    lastX = currentX;
    lastY = currentY;
    
    // Save to hidden input
    saveCanvasData();
}

function stopDrawing() {
    drawing = false;
    ctx.beginPath();
}

function handleTouchStart(e) {
    if (e.touches.length === 1) {
        e.preventDefault();
        const touch = e.touches[0];
        const mouseEvent = new MouseEvent('mousedown', {
            clientX: touch.clientX,
            clientY: touch.clientY
        });
        canvas.dispatchEvent(mouseEvent);
    }
}

function handleTouchMove(e) {
    if (e.touches.length === 1) {
        e.preventDefault();
        const touch = e.touches[0];
        const mouseEvent = new MouseEvent('mousemove', {
            clientX: touch.clientX,
            clientY: touch.clientY
        });
        canvas.dispatchEvent(mouseEvent);
    }
}

function handleTouchEnd(e) {
    e.preventDefault();
    const mouseEvent = new MouseEvent('mouseup', {});
    canvas.dispatchEvent(mouseEvent);
}

// ============================================
// TOOL FUNCTIONS
// ============================================

function setColor(color) {
    debugLog(`🎨 Setting color to: ${color}`);
    currentColor = color;
    
    if (ctx) {
        ctx.strokeStyle = currentColor;
    }
    
    // Update UI
    document.querySelectorAll('.color-btn, span[data-color]').forEach(btn => {
        const btnColor = btn.getAttribute('data-color') || btn.style.backgroundColor;
        if (btnColor && (btnColor.includes(color) || color.includes(btnColor))) {
            btn.classList.add('active');
        } else {
            btn.classList.remove('active');
        }
    });
}

function setSize(size) {
    debugLog(`📏 Setting size to: ${size}`);
    currentSize = size;
    
    if (ctx) {
        ctx.lineWidth = currentSize;
    }
    
    // Update UI
    document.querySelectorAll('.size-btn, button[data-size]').forEach(btn => {
        const btnSize = parseInt(btn.getAttribute('data-size'));
        if (btnSize === size) {
            btn.classList.add('active');
        } else {
            btn.classList.remove('active');
        }
    });
}

function clearCanvas() {
    if (confirm('Apakah Anda yakin ingin menghapus gambar?')) {
        debugLog('🧹 Clearing canvas');
        
        // Clear with white background
        ctx.fillStyle = 'white';
        ctx.fillRect(0, 0, canvas.width, canvas.height);
        
        // Reset drawing styles
        ctx.strokeStyle = currentColor;
        ctx.lineWidth = currentSize;
        
        // Add red border
        ctx.strokeStyle = '#ff0000';
        ctx.lineWidth = 2;
        ctx.strokeRect(0, 0, canvas.width, canvas.height);
        ctx.strokeStyle = currentColor;
        ctx.lineWidth = currentSize;
        
        // Clear hidden input
        const hiddenInput = document.getElementById('gambarData');
        if (hiddenInput) {
            hiddenInput.value = '';
        }
        
        debugLog('✅ Canvas cleared');
        showSuccessMessage('Canvas telah dibersihkan');
    }
}

function saveCanvasData() {
    try {
        const imageData = canvas.toDataURL('image/png');
        const hiddenInput = document.getElementById('gambarData');
        if (hiddenInput) {
            hiddenInput.value = imageData;
        }
    } catch (error) {
        debugLog(`❌ Error saving canvas: ${error.message}`, 'error');
    }
}

// ============================================
// EMERGENCY FALLBACK
// ============================================

function createEmergencyCanvas() {
    debugLog('🚨 Creating emergency canvas...');
    
    // Cari tempat untuk canvas
    const container = document.querySelector('.keterangan-cell') || 
                     document.querySelector('.drawing-container') ||
                     document.querySelector('td[rowspan="11"]') ||
                     document.querySelector('table') ||
                     document.body;
    
    if (!container) {
        debugLog('❌ No container found for emergency canvas', 'error');
        return;
    }
    
    // Cek jika canvas sudah ada tapi tidak ditemukan script
    const existingCanvas = container.querySelector('canvas');
    if (existingCanvas) {
        canvas = existingCanvas;
        ctx = canvas.getContext('2d');
        debugLog('✅ Using existing canvas');
        initCanvasDrawing();
        return;
    }
    
    // Buat canvas baru
    const newCanvas = document.createElement('canvas');
    newCanvas.id = 'drawCanvas';
    newCanvas.className = 'drawing-canvas';
    newCanvas.width = 400;
    newCanvas.height = 280;
    newCanvas.style.cssText = `
        border: 2px solid red !important;
        background: white !important;
        cursor: crosshair !important;
        display: block !important;
        width: 100% !important;
        height: 280px !important;
    `;
    
    // Buat wrapper jika belum ada
    let wrapper = container.querySelector('.canvas-wrapper');
    if (!wrapper) {
        wrapper = document.createElement('div');
        wrapper.className = 'canvas-wrapper';
        wrapper.style.cssText = 'width: 100%; height: 280px; position: relative;';
        container.prepend(wrapper);
    }
    
    wrapper.appendChild(newCanvas);
    
    // Tambah hidden input jika belum ada
    let hiddenInput = document.getElementById('gambarData');
    if (!hiddenInput) {
        hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.id = 'gambarData';
        hiddenInput.name = 'gambar_data';
        wrapper.appendChild(hiddenInput);
    }
    
    // Buat tools jika belum ada
    let toolsContainer = container.querySelector('.simple-tools');
    if (!toolsContainer) {
        toolsContainer = document.createElement('div');
        toolsContainer.className = 'simple-tools';
        toolsContainer.innerHTML = `
            <button type="button" class="tool-btn" id="clearBtn">Hapus</button>
            <span style="margin-left: 10px;">Warna:</span>
            <span class="color-btn" style="background:black;" data-color="black"></span>
            <span class="color-btn" style="background:red;" data-color="red"></span>
            <span class="color-btn" style="background:blue;" data-color="blue"></span>
            <span class="color-btn" style="background:green;" data-color="green"></span>
            <span style="margin-left: 10px;">Ukuran:</span>
            <button class="size-btn" data-size="1">1</button>
            <button class="size-btn" data-size="3">3</button>
            <button class="size-btn" data-size="5">5</button>
        `;
        container.appendChild(toolsContainer);
    }
    
    canvas = newCanvas;
    ctx = canvas.getContext('2d');
    
    // Initialize
    initCanvasDrawing();
    setupToolButtons();
    
    debugLog('✅ Emergency canvas created and initialized');
    showSuccessMessage('Canvas emergency system activated!');
}

// ============================================
// HELPER FUNCTIONS
// ============================================

function showSuccessMessage(message) {
    // Buat toast notification
    const toast = document.createElement('div');
    toast.style.cssText = `
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: #4CAF50;
        color: white;
        padding: 15px;
        border-radius: 5px;
        z-index: 10000;
        box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        animation: fadeIn 0.3s;
    `;
    
    // Add CSS for animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    `;
    document.head.appendChild(style);
    
    toast.textContent = `✅ ${message}`;
    document.body.appendChild(toast);
    
    setTimeout(() => {
        toast.style.opacity = '0';
        toast.style.transition = 'opacity 0.5s';
        setTimeout(() => toast.remove(), 500);
    }, 3000);
}

function updateDebugPanel() {
    // Update debug panel jika ada
    const debugStatus = document.getElementById('debugStatus');
    const debugCanvas = document.getElementById('debugCanvas');
    const debugContext = document.getElementById('debugContext');
    
    if (debugStatus) debugStatus.textContent = 'READY ✓';
    if (debugCanvas) debugCanvas.textContent = `FOUND (${canvas.width}x${canvas.height})`;
    if (debugContext) debugContext.textContent = 'READY ✓';
}

// ============================================
// INITIALIZATION
// ============================================

// Start initialization when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', function() {
        debugLog('📄 DOM Content Loaded - Starting canvas initialization');
        setTimeout(initializeCanvas, 500); // Tunggu lebih lama untuk PHP
    });
} else {
    debugLog('📄 DOM already loaded - Starting canvas initialization');
    setTimeout(initializeCanvas, 500);
}

// Also try on window load
window.addEventListener('load', function() {
    debugLog('🪟 Window loaded - Final canvas check');
    setTimeout(() => {
        if (!ctx) {
            debugLog('⚠️ Canvas not initialized, retrying...', 'warning');
            initializeCanvas();
        }
    }, 1000);
});

// Make functions globally available
window.setColor = setColor;
window.setSize = setSize;
window.clearCanvas = clearCanvas;
window.initializeCanvas = initializeCanvas;

debugLog('🚀 Canvas script ready - PHP compatible');