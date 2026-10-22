// ============================================
// CANVAS SURFACE PLATE - MOBILE & PC FIXED
// ============================================

console.log('🎯 CANVAS SURFACE PLATE - Mobile Fix Loaded');

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
let canvasHasContent = false; 

function isCanvasEmpty() {
    if (lines.length > 0 || dots.length > 0) return false;
    if (currentLine && currentLine.points.length > 1) return false;
    return true;
}

function markCanvasHasContent() {
    if (!isCanvasEmpty()) {
        canvasHasContent = true;
        console.log('🎨 Canvas has content detected');
    }
}

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
            checkForCanvasOnce();
        }
    }, 300));
    
    observer.observe(document.body, { childList: true, subtree: true });
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
    if (isInitialized) return;
    
    canvas = document.getElementById('drawCanvas');
    if (!canvas) canvas = document.querySelector('canvas.drawing-canvas');
    if (!canvas) canvas = document.querySelector('.canvas-wrapper canvas');
    
    if (!canvas) {
        console.log('📭 Canvas not found yet');
        return;
    }
    
    console.log('✅ Canvas found! Initializing...');
    if (observer) {
        observer.disconnect();
        observer = null;
    }
    initializeCanvas();
}

// INITIALIZATION
function initializeCanvas() {
    if (isInitialized) return;
    
    console.log('🔧 Initializing canvas...');
    ctx = canvas.getContext('2d');
    if (!ctx) {
        console.error('Cannot get 2D context');
        return;
    }
    
    setupCanvas();
    addTools();
    
    isInitialized = true;
    console.log('✅ Canvas initialized successfully!');
    loadExistingImageToCanvas();
}

function setupCanvas() {
    const container = canvas.parentElement;
    if (container && container.clientWidth > 0) {
        canvas.width = container.clientWidth;
    } else {
        canvas.width = 400;
    }
    canvas.height = 280;
    
    canvas.style.border = '1px solid #000';
    canvas.style.background = '#fff';
    canvas.style.cursor = 'crosshair';
    canvas.style.width = '100%';
    
    // 🔥 PENTING UNTUK MOBILE: Mencegah layar scroll saat menggambar
    canvas.style.touchAction = 'none'; 
    
    ctx = canvas.getContext('2d', {
        alpha: true,
        desynchronized: false,
        willReadFrequently: false
    });
    
    ctx.globalCompositeOperation = 'source-over';
    ctx.globalAlpha = 1.0;
    ctx.imageSmoothingEnabled = true;
    ctx.imageSmoothingQuality = 'high';
    
    ctx.fillStyle = '#FFFFFF';
    ctx.fillRect(0, 0, canvas.width, canvas.height);
    
    setupCanvasEvents();
    redraw();
}

function loadExistingImageToCanvas() {
    console.log('🔍 loadExistingImageToCanvas called');
    const existingImage = document.getElementById('existingImage');
    const hiddenInput = document.getElementById('keteranganGambar');
    
    if (hiddenInput && hiddenInput.value && hiddenInput.value.startsWith('data:image')) {
        console.log('🖼️ Loading image from hidden input, length:', hiddenInput.value.length);
        const img = new Image();
        img.onload = function() {
            console.log('✅ Image loaded successfully from hidden input');
            ctx.fillStyle = '#FFFFFF';
            ctx.fillRect(0, 0, canvas.width, canvas.height);
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
            canvasHasContent = true;
            lines = [];
            dots = [];
        };
        img.onerror = function() {
            console.error('❌ Failed to load image from hidden input');
            canvasHasContent = false;
        };
        img.src = hiddenInput.value;
    }
    else if (existingImage && existingImage.src && existingImage.src !== window.location.href && existingImage.src !== '') {
        console.log('🖼️ Loading image from folder:', existingImage.src);
        const img = new Image();
        img.crossOrigin = "Anonymous";
        img.onload = function() {
            console.log('✅ Image loaded successfully from folder');
            ctx.fillStyle = '#FFFFFF';
            ctx.fillRect(0, 0, canvas.width, canvas.height);
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
            canvasHasContent = true;
            lines = [];
            dots = [];
            if (hiddenInput) {
                hiddenInput.value = canvas.toDataURL('image/png');
            }
        };
        img.onerror = function() {
            console.error('❌ Failed to load image from folder:', existingImage.src);
            canvasHasContent = false;
        };
        img.src = existingImage.src;
    } else {
        console.log('ℹ️ No existing image found');
        canvasHasContent = false;
        ctx.fillStyle = '#FFFFFF';
        ctx.fillRect(0, 0, canvas.width, canvas.height);
        lines = [];
        dots = [];
    }
}

function saveCanvasToHidden() {
    console.log('💾 saveCanvasToHidden called');
    const hiddenInput = document.getElementById('keteranganGambar');
    if (!hiddenInput || !canvas) return false;
    
    if (isCanvasEmpty()) {
        console.log('🖼️ Canvas is EMPTY (all white), NOT saving image');
        hiddenInput.value = '';
        return false;
    }
    
    try {
        const imageData = canvas.toDataURL('image/png');
        hiddenInput.value = imageData;
        canvasHasContent = true;
        console.log('✅ Canvas saved to hidden input, length:', imageData.length);
        return true;
    } catch (error) {
        console.error('❌ Error saving canvas:', error);
        return false;
    }
}

function addTools() {
    const tools = document.querySelector('.simple-tools');
    if (!tools || document.getElementById('canvasTools')) return;
    
    const toolsDiv = document.createElement('div');
    toolsDiv.id = 'canvasTools';
    toolsDiv.style.cssText = `display: inline-block; margin-right: 15px; padding: 5px; background: #f5f5f5; border-radius: 4px; border: 1px solid #ddd;`;
    
    toolsDiv.innerHTML = `
        <span style="font-weight: 600; color: #333; font-size: 14px; white-space: nowrap;">🎨 Tools:</span>
        <button id="canvasDrawBtn" style="padding: 6px 12px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: 600; font-size: 12px; height: 32px; flex-shrink: 0; white-space: nowrap;">✏️ Garis</button>
        <button id="canvasDotBtn" style="padding: 6px 12px; background: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: 400; font-size: 12px; height: 32px; flex-shrink: 0; white-space: nowrap;">🔘 Titik</button>
        <button id="canvasClearBtn" style="padding: 6px 12px; background: #dc3545; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: 400; font-size: 12px; height: 32px; flex-shrink: 0; white-space: nowrap;">🗑️ Hapus Semua</button>
    `;
    
    tools.insertBefore(toolsDiv, tools.firstChild);
    
    document.getElementById('canvasDrawBtn').addEventListener('click', function(e) { e.preventDefault(); setTool('draw'); });
    document.getElementById('canvasDotBtn').addEventListener('click', function(e) { e.preventDefault(); setTool('dot'); });
    document.getElementById('canvasClearBtn').addEventListener('click', function(e) { e.preventDefault(); clearAll(); });
}

function setTool(toolType) {
    if (!isInitialized) return;
    
    const btnDraw = document.getElementById('canvasDrawBtn');
    const btnDot = document.getElementById('canvasDotBtn');
    
    if (btnDraw && btnDot) {
        if (toolType === 'draw') {
            btnDraw.style.fontWeight = 'bold';
            btnDot.style.fontWeight = 'normal';
            canvas.style.cursor = 'crosshair';
        } else {
            btnDraw.style.fontWeight = 'normal';
            btnDot.style.fontWeight = 'bold';
            canvas.style.cursor = 'pointer';
        }
    }
    
    window.currentTool = toolType;
    
    if (toolType === 'draw') {
        ctx.lineWidth = 2;
        ctx.lineCap = 'round';
        ctx.lineJoin = 'round';
        ctx.strokeStyle = '#000000';
        ctx.fillStyle = '#000000';
    }
}

function setupCanvasEvents() {
    const newCanvas = canvas.cloneNode(true);
    canvas.parentNode.replaceChild(newCanvas, canvas);
    canvas = document.getElementById('drawCanvas') || document.querySelector('canvas.drawing-canvas');
    ctx = canvas.getContext('2d');
    
    canvas.style.border = '1px solid #000';
    canvas.style.background = '#fff';
    canvas.style.cursor = 'crosshair';
    canvas.style.touchAction = 'none'; // 🔥 PENTING UNTUK MOBILE
    
    // 🔥 EVENT MOUSE (LAPTOP)
    canvas.addEventListener('mousedown', handleMouseDown);
    canvas.addEventListener('mousemove', handleMouseMove);
    canvas.addEventListener('mouseup', handleMouseUp);
    canvas.addEventListener('mouseout', handleMouseOut);
    
    // 🔥 EVENT TOUCH (HP / TABLET)
    canvas.addEventListener('touchstart', handleTouchStart, { passive: false });
    canvas.addEventListener('touchmove', handleTouchMove, { passive: false });
    canvas.addEventListener('touchend', handleTouchEnd, { passive: false });
    canvas.addEventListener('touchcancel', handleTouchEnd, { passive: false });
    
    setTool('draw');
}

// ==========================================
// 🔥 FUNGSI BANTUAN KOORDINAT (MOUSE & TOUCH)
// ==========================================
function getCanvasCoords(e) {
    const rect = canvas.getBoundingClientRect();
    let clientX, clientY;
    
    if (e.touches && e.touches.length > 0) {
        clientX = e.touches[0].clientX;
        clientY = e.touches[0].clientY;
    } else if (e.changedTouches && e.changedTouches.length > 0) {
        clientX = e.changedTouches[0].clientX;
        clientY = e.changedTouches[0].clientY;
    } else {
        clientX = e.clientX;
        clientY = e.clientY;
    }
    
    return {
        x: clientX - rect.left,
        y: clientY - rect.top
    };
}

// ==========================================
// 🔥 HANDLER UNTUK MOUSE (LAPTOP)
// ==========================================
function handleMouseDown(e) {
    e.preventDefault();
    e.stopPropagation();
    const pos = getCanvasCoords(e);
    
    if (window.currentTool === 'draw') {
        drawing = true;
        lastX = pos.x;
        lastY = pos.y;
        currentLine = { points: [{x: pos.x, y: pos.y}], color: '#000000', width: 2 };
        ctx.beginPath();
        ctx.moveTo(pos.x, pos.y);
    } else if (window.currentTool === 'dot') {
        if (e.shiftKey) {
            removeDotAt(pos.x, pos.y);
        } else {
            dots.push({ x: pos.x, y: pos.y, id: Date.now() + Math.random() });
        }
        redraw();
        markCanvasHasContent();
    }
}

function handleMouseMove(e) {
    if (!drawing || window.currentTool !== 'draw') return;
    e.preventDefault();
    const pos = getCanvasCoords(e);
    
    ctx.lineTo(pos.x, pos.y);
    ctx.stroke();
    
    if (currentLine) currentLine.points.push({x: pos.x, y: pos.y});
    lastX = pos.x;
    lastY = pos.y;
}

function handleMouseUp(e) {
    if (e) { e.preventDefault(); e.stopPropagation(); }
    if (drawing && window.currentTool === 'draw' && currentLine) {
        drawing = false;
        if (currentLine.points.length > 1) {
            lines.push({ points: [...currentLine.points], color: currentLine.color, width: currentLine.width });
        }
        currentLine = null;
        ctx.beginPath();
        markCanvasHasContent();
    }
}

function handleMouseOut(e) {
    if (e) e.preventDefault();
    if (drawing) handleMouseUp();
}

// ==========================================
// 🔥 HANDLER UNTUK TOUCH (HP)
// ==========================================
function handleTouchStart(e) {
    e.preventDefault(); // Mencegah layar scroll
    e.stopPropagation();
    const pos = getCanvasCoords(e);
    
    if (window.currentTool === 'draw') {
        drawing = true;
        lastX = pos.x;
        lastY = pos.y;
        currentLine = { points: [{x: pos.x, y: pos.y}], color: '#000000', width: 2 };
        ctx.beginPath();
        ctx.moveTo(pos.x, pos.y);
    } else if (window.currentTool === 'dot') {
        dots.push({ x: pos.x, y: pos.y, id: Date.now() + Math.random() });
        redraw();
        markCanvasHasContent();
    }
}

function handleTouchMove(e) {
    if (!drawing || window.currentTool !== 'draw') return;
    e.preventDefault(); // Mencegah layar scroll saat menarik garis
    e.stopPropagation();
    const pos = getCanvasCoords(e);
    
    ctx.lineTo(pos.x, pos.y);
    ctx.stroke();
    
    if (currentLine) currentLine.points.push({x: pos.x, y: pos.y});
    lastX = pos.x;
    lastY = pos.y;
}

function handleTouchEnd(e) {
    if (e) { e.preventDefault(); e.stopPropagation(); }
    if (drawing && window.currentTool === 'draw' && currentLine) {
        drawing = false;
        if (currentLine.points.length > 1) {
            lines.push({ points: [...currentLine.points], color: currentLine.color, width: currentLine.width });
        }
        currentLine = null;
        ctx.beginPath();
        markCanvasHasContent();
    }
}

// ==========================================
// FUNGSI LAINNYA
// ==========================================
function removeDotAt(x, y) {
    for (let i = 0; i < dots.length; i++) {
        const dot = dots[i];
        const distance = Math.sqrt(Math.pow(dot.x - x, 2) + Math.pow(dot.y - y, 2));
        if (distance < 10) {
            dots.splice(i, 1);
            redraw();
            markCanvasHasContent();
            return;
        }
    }
}

function redraw() {
    if (!isInitialized) return;
    
    ctx.fillStyle = '#FFFFFF';
    ctx.fillRect(0, 0, canvas.width, canvas.height);
    ctx.globalCompositeOperation = 'source-over';
    
    lines.forEach(line => {
        if (line.points.length > 1) {
            ctx.beginPath();
            ctx.moveTo(line.points[0].x, line.points[0].y);
            for (let i = 1; i < line.points.length; i++) {
                ctx.lineTo(line.points[i].x, line.points[i].y);
            }
            ctx.strokeStyle = '#000000';
            ctx.lineWidth = 2;
            ctx.lineCap = 'round';
            ctx.lineJoin = 'round';
            ctx.stroke();
        }
    });
    
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
    
    drawDots();
}

function drawDots() {
    dots.forEach((dot) => {
        ctx.beginPath();
        ctx.arc(dot.x, dot.y, 4, 0, Math.PI * 2);
        ctx.fillStyle = '#000000';
        ctx.fill();
        ctx.strokeStyle = '#000000';
        ctx.lineWidth = 1;
        ctx.stroke();
    });
}

function clearAll() {
    if (!isInitialized) return;
    
    if (confirm('Hapus semua garis dan titik?')) {
        lines = [];
        dots = [];
        currentLine = null;
        drawing = false;
        ctx.fillStyle = '#FFFFFF';
        ctx.fillRect(0, 0, canvas.width, canvas.height);
        canvasHasContent = false;
        console.log('🗑️ Canvas cleared, hasContent set to false');
        
        const hiddenInput = document.getElementById('keteranganGambar');
        if (hiddenInput) hiddenInput.value = '';
    }
}

// AUTO SAVE BEFORE FORM SUBMIT
document.addEventListener('submit', function(e) {
    console.log('📤 Form submit detected');
    const form = e.target.closest('form');
    if (form) {
        const hiddenInput = document.getElementById('keteranganGambar');
        if (!isCanvasEmpty() && canvasHasContent) {
            console.log('Canvas has content, saving before submit...');
            saveCanvasToHidden();
        } else {
            console.log('📝 Canvas is empty, clearing hidden input');
            if (hiddenInput) hiddenInput.value = '';
        }
    }
});

// PREVENT FORM SUBMISSION FROM CANVAS BUTTONS
document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const activeElement = document.activeElement;
            if (activeElement && 
                (activeElement.id === 'canvasDrawBtn' || 
                 activeElement.id === 'canvasDotBtn' || 
                 activeElement.id === 'canvasClearBtn' ||
                 activeElement.id === 'saveCanvasBtn')) {
                e.preventDefault();
                e.stopPropagation();
                return false;
            }
        }, true);
    });
});

// STARTUP
window.addEventListener('DOMContentLoaded', function() {
    console.log('📄 DOMContentLoaded - starting canvas setup');
    setupCanvasObserver();
    
    setInterval(() => {
        if (!isInitialized) checkForCanvasOnce();
    }, 5000);
});

// Global functions
window.clearCanvas = clearAll;
window.initializeCanvas = initializeCanvas;
window.setTool = setTool;
window.saveCanvasToHidden = saveCanvasToHidden;

console.log('🚀 Canvas Surface Plate Mobile Fix Loaded');