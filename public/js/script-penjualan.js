// =======================================================
// 📜 FUNGSI GLOBAL (Dapat diakses di mana saja oleh DOMContentLoaded)
// =======================================================

const CART_STORAGE_KEY = 'guswarung_cart';

// Fungsi untuk format Rupiah
function formatRupiah(number) {
    // Memastikan angka yang diformat adalah hasil pembulatan dan format ID yang benar
    return "Rp " + Math.round(number).toLocaleString('id-ID'); 
}

// Fungsi untuk menghitung total cepat (tanpa PPN/Ongkir untuk modal Quick Edit)
function calculateQuickTotals(cart) {
    let subtotal = 0;
    cart.forEach(item => {
        subtotal += item.price * item.quantity;
    });
    return { subtotal, total: subtotal }; 
}

function loadCart() {
    const cartJson = localStorage.getItem(CART_STORAGE_KEY);
    try {
        return cartJson ? JSON.parse(cartJson) : [];
    } catch (e) {
        console.error("Error parsing cart data from Local Storage", e);
        return [];
    }
}

function updateCartBadge(cart = loadCart()) {
    const totalQuantity = cart.reduce((sum, item) => sum + item.quantity, 0);
    const badge = document.querySelector('.cart-badge');
    
    if (badge) {
        badge.textContent = totalQuantity;
        badge.style.display = totalQuantity > 0 ? 'block' : 'none';
    }
}

function saveCartAndRender(cart) {
    localStorage.setItem(CART_STORAGE_KEY, JSON.stringify(cart));
    updateCartBadge(cart);
}

function showToast(message, className) {
    const toast = document.getElementById("toast");
    const toastMessage = document.getElementById("toastMessage");
    
    if (toast && toastMessage) {
        toast.className = 'toast ' + className; 
        toastMessage.textContent = message;
        toast.style.display = "block";
        
        setTimeout(() => {
            toast.style.display = "none";
        }, 3000);
    }
}

function addToCart(item) {
    let cart = loadCart();
    const existingItemIndex = cart.findIndex(i => i.id === item.id);
    
    if (item.stok <= 0) {
        showToast(`❌ Stok ${item.name} habis!`, 'bg-danger');
        return; 
    }

    if (existingItemIndex > -1) {
        if (cart[existingItemIndex].quantity < item.stok) {
             cart[existingItemIndex].quantity += 1;
             showToast(`⬆️ ${item.name} ditambah (Total: ${cart[existingItemIndex].quantity})`, 'bg-info');
        } else {
             showToast(`⚠️ Kuantitas ${item.name} sudah maksimal (${item.stok})!`, 'bg-warning');
             return;
        }
    } else {
        cart.push({
            id: item.id,
            name: item.name,
            price: item.price,
            image: item.image,
            unit: item.unit,
            stok: item.stok,
            quantity: 1
        });
        showToast(`✅ ${item.name} berhasil ditambahkan!`, 'bg-success');
    }

    saveCartAndRender(cart);
}


/**
 * MENGURANGI / MENAMBAH KUANTITAS ITEM (Digunakan di Quick Cart Modal)
 */
function updateItemQuantity(event) {
    const button = event.currentTarget;
    const index = parseInt(button.dataset.index);
    const action = button.dataset.action;
    let cart = loadCart();

    if (cart[index]) {
        if (action === 'increment') {
            if (cart[index].quantity < cart[index].stok) {
                cart[index].quantity += 1;
            } else {
                showToast(`⚠️ Stok ${cart[index].name} maksimal!`, 'bg-warning');
            }
        } else if (action === 'decrement') {
            cart[index].quantity -= 1;
        } 
        // Logic untuk menghapus item jika kuantitas kurang dari atau sama dengan 0
        if (cart[index].quantity <= 0 || action === 'delete') { 
             cart.splice(index, 1);
        }

        saveCartAndRender(cart);
        // Memastikan modal diperbarui setelah perubahan kuantitas/hapus
        renderQuickCart(); 
    }
}


/**
 * Merender isi keranjang ke dalam Modal Quick Edit.
 */
function renderQuickCart() {
    const cart = loadCart();
    const listContainer = document.getElementById('quick-cart-items-list');
    const subtotalDisplay = document.getElementById('quick-cart-subtotal');
    const totalDisplay = document.getElementById('quick-cart-total');

    listContainer.innerHTML = '';

    if (cart.length === 0) {
        listContainer.innerHTML = `<p class="text-center text-muted m-4">Keranjang kosong.</p>`;
        subtotalDisplay.textContent = formatRupiah(0);
        totalDisplay.textContent = formatRupiah(0);
        return;
    }
    
    // Render Items
    cart.forEach((item, index) => {
        const itemTotal = item.price * item.quantity;
        const itemRow = document.createElement('div');
        itemRow.className = 'quick-edit-item-row';
        itemRow.innerHTML = `
            <img src="${item.image}" alt="${item.name}" />
            <div class="flex-grow-1">
                <div class="fw-bold text-truncate">${item.name}</div>
                <div class="quick-edit-item-price">${formatRupiah(itemTotal)}</div>
            </div>
            
            <div class="quick-edit-controls me-2">
                <button class="btn btn-sm btn-outline-danger" data-index="${index}" data-action="decrement">-</button>
                <span class="qty-display">${item.quantity}</span>
                <button class="btn btn-sm btn-outline-success" data-index="${index}" data-action="increment">+</button>
            </div>
            
            <button class="btn btn-sm btn-link text-danger btn-remove-item" data-index="${index}" data-action="delete">
                <span class="material-symbols-outlined fs-5">delete</span>
            </button>
        `;
        listContainer.appendChild(itemRow);
    });

    // Pasang Event Listeners (menggunakan updateItemQuantity untuk semua kontrol)
    listContainer.querySelectorAll('.btn-remove-item').forEach(btn => {
        btn.addEventListener('click', updateItemQuantity); 
    });
    listContainer.querySelectorAll('.quick-edit-controls button').forEach(btn => {
        btn.addEventListener('click', updateItemQuantity); 
    });
    
    // Hitung dan tampilkan total
    const { subtotal, total } = calculateQuickTotals(cart);
    subtotalDisplay.textContent = formatRupiah(subtotal);
    totalDisplay.textContent = formatRupiah(total);
}


// =======================================================
// 🚀 INISIALISASI DOM (Wajib ada di sini)
// =======================================================

document.addEventListener("DOMContentLoaded", () => {
    
    // Variabel DOM (didefinisikan di dalam DOMContentLoaded)
    const filterContainer = document.getElementById('menu-filters');
    const menuItems = document.querySelectorAll('.menu-item');
    const searchInput = document.getElementById("searchInput");
    const resultContainer = document.getElementById("searchResults");
    const quickCartModalEl = document.getElementById('quickCartModal');

    // 1. Inisialisasi Quick Cart Modal Event (PENTING!)
    if (quickCartModalEl && typeof bootstrap !== 'undefined' && bootstrap.Modal) {
        // Ketika modal dibuka, render isi keranjang
        quickCartModalEl.addEventListener('show.bs.modal', renderQuickCart);
    }
    
    // 2. Inisialisasi Badge Keranjang saat halaman dimuat
    updateCartBadge();
    
    // 3. Inisialisasi Carousel (Minuman)
    var myCarousel = document.getElementById("drinkCarousel");
    if (myCarousel && typeof bootstrap !== 'undefined' && bootstrap.Carousel) { 
        new bootstrap.Carousel(myCarousel, {
            interval: 5000, 
        });
    }
    
    // ... (lanjutan logika Pencarian dan Filter yang sudah benar) ...

    const getActiveFilter = () => filterContainer.querySelector('.btn.active')?.getAttribute('data-filter') || 'all';

    const passesCurrentFilter = (item, activeFilter) => {
        const itemKategori = item.getAttribute('data-kategori');
        const itemPopuler = item.getAttribute('data-populer');
        const isDiskon = item.querySelector('.discount-badge');
        
        if (activeFilter === 'all') return true;
        if (activeFilter === 'populer') return itemPopuler === 'yes';
        if (activeFilter === 'diskon') return isDiskon !== null;
        
        return itemKategori === activeFilter;
    };
    
    function searchProduct() {
        const query = searchInput.value.toLowerCase().trim();
        resultContainer.innerHTML = ""; 
        const activeFilter = getActiveFilter(); 

        if (!query) {
            resultContainer.style.display = "none";
            
            menuItems.forEach(item => {
                const shouldShow = passesCurrentFilter(item, activeFilter);
                item.style.display = shouldShow ? 'block' : 'none';
                if (shouldShow) item.setAttribute('data-aos', 'zoom-in');
            });
            if (typeof AOS !== 'undefined' && AOS.refresh) AOS.refresh();
            return;
        }

        const results = [];
        
        menuItems.forEach((item) => {
            const title = item.querySelector(".card-title")?.textContent.toLowerCase() || '';
            const desc = item.querySelector(".card-text")?.textContent.toLowerCase() || '';
            
            const isMatch = title.includes(query) || desc.includes(query);
            const passesFilter = passesCurrentFilter(item, activeFilter);

            if (isMatch && passesFilter) {
                item.style.display = 'block';
                item.setAttribute('data-aos', 'zoom-in');
                
                const imgEl = item.querySelector(".card-img-top");
                const priceEl = item.querySelector(".discount-price") || item.querySelector(".fw-bold.text-warning");
                
                results.push({
                    title: item.querySelector(".card-title").textContent,
                    desc: item.querySelector(".card-text")?.textContent || '',
                    img: imgEl ? imgEl.src : '',
                    price: priceEl ? priceEl.textContent : '',
                    isMatch: true
                });
            } else {
                item.style.display = 'none';
                item.removeAttribute('data-aos');
            }
        });
        
        resultContainer.style.display = "block";
        if (results.length === 0) {
            resultContainer.innerHTML = `<p class="text-center text-muted m-2">Produk tidak ditemukan 😞</p>`;
        } else {
            results.forEach((item) => {
                const resultItem = document.createElement("div");
                resultItem.classList.add("search-item");
                resultItem.innerHTML = `
                    <img src="${item.img}" alt="${item.title}">
                    <div>
                        <h6>${item.title}</h6>
                        <p>${item.price}</p>
                    </div>
                `;
                resultItem.addEventListener("click", () => {
                    const targetCard = [...document.querySelectorAll(".card")].find(
                        (c) => c.querySelector(".card-title").textContent === item.title
                    );
                    if (targetCard)
                        targetCard.scrollIntoView({
                            behavior: "smooth",
                            block: "center",
                        });
                });
                resultContainer.appendChild(resultItem);
            });
        }
        if (typeof AOS !== 'undefined' && AOS.refresh) AOS.refresh();
    }
    
    if (document.getElementById("searchButton")) {
        document.getElementById("searchButton").addEventListener("click", searchProduct);
    }
    if (searchInput) {
        searchInput.addEventListener("input", searchProduct);
    }
    
    document.addEventListener("click", (e) => {
        const input = document.getElementById("searchInput");
        if (resultContainer && input) {
            if (!resultContainer.contains(e.target) && !input.contains(e.target)) {
                resultContainer.style.display = "none";
            }
        }
    });

    if (filterContainer) {
        filterContainer.addEventListener('click', (event) => {
            const target = event.target;
            if (target.tagName === 'BUTTON') {
                
                filterContainer.querySelectorAll('button').forEach(btn => {
                    btn.classList.remove('active', 'btn-warning');
                    btn.classList.add('btn-outline-warning');
                });
                target.classList.add('active', 'btn-warning');
                target.classList.remove('btn-outline-warning');

                const filterValue = target.getAttribute('data-filter');

                menuItems.forEach(item => {
                    const shouldShow = passesCurrentFilter(item, filterValue);
                    
                    if (shouldShow) {
                        item.style.display = 'block'; 
                        item.setAttribute('data-aos', 'zoom-in'); 
                    } else {
                        item.style.display = 'none'; 
                        item.removeAttribute('data-aos');
                    }
                });
                
                if (typeof AOS !== 'undefined' && AOS.refresh) AOS.refresh(); 
            }
        });
    }

    const buburForm = document.getElementById("buburForm");
    const buburModalEl = document.getElementById("buburModal");

    if (buburForm && buburModalEl && typeof bootstrap !== 'undefined' && bootstrap.Modal) {
        const modal = new bootstrap.Modal(buburModalEl);

        buburForm.addEventListener("submit", function (e) {
            e.preventDefault();
            const selectedRadio = document.querySelector('input[name="buburVariant"]:checked');

            if (!selectedRadio) {
                showToast('Pilih varian bubur terlebih dahulu!', 'bg-danger');
                return;
            }

            const selected = selectedRadio.value;
            modal.hide();
            showToast(`✅ Varian ${selected} berhasil ditambahkan ke keranjang!`, 'bg-success');
            selectedRadio.checked = false;
        });
    }
});