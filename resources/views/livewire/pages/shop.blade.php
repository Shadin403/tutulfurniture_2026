@section('title', 'Shop')

@push('styles')
<style>
    /* ===== SHOP PAGE PREMIUM STYLES ===== */
    :root {
        --shop-primary: #2c3e50;
        --shop-accent: #e67e22;
        --shop-accent-light: #f39c12;
        --shop-bg: #f8f9fa;
        --shop-card-bg: #ffffff;
        --shop-border: #e8ecef;
        --shop-text: #2d3748;
        --shop-text-muted: #718096;
        --shop-shadow: 0 4px 24px rgba(0,0,0,0.08);
        --shop-shadow-hover: 0 16px 48px rgba(0,0,0,0.15);
        --shop-radius: 16px;
        --shop-radius-sm: 10px;
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* ===== BREADCRUMB ===== */
    .shop-breadcrumb-wrap {
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
        padding: 28px 0;
        position: relative;
        overflow: hidden;
    }
    .shop-breadcrumb-wrap::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(230,126,34,0.08) 0%, transparent 60%);
        animation: breadcrumbPulse 4s ease-in-out infinite;
    }
    @keyframes breadcrumbPulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }
    .shop-breadcrumb-wrap .container {
        position: relative;
        z-index: 1;
    }
    .shop-page-title {
        font-size: 2rem;
        font-weight: 800;
        color: #ffffff;
        margin: 0 0 6px;
        letter-spacing: -0.5px;
    }
    .shop-breadcrumb-nav {
        display: flex;
        align-items: center;
        gap: 8px;
        margin: 0;
        padding: 0;
        list-style: none;
    }
    .shop-breadcrumb-nav a {
        color: rgba(255,255,255,0.65);
        text-decoration: none;
        font-size: 0.875rem;
        font-weight: 500;
        transition: var(--transition);
    }
    .shop-breadcrumb-nav a:hover { color: var(--shop-accent-light); }
    .shop-breadcrumb-nav .sep {
        color: rgba(255,255,255,0.3);
        font-size: 0.75rem;
    }
    .shop-breadcrumb-nav .current {
        color: var(--shop-accent-light);
        font-size: 0.875rem;
        font-weight: 600;
    }

    /* ===== MAIN SHOP SECTION ===== */
    .shop-section {
        background: var(--shop-bg);
        padding: 40px 0 60px;
        min-height: 70vh;
    }

    /* ===== TOOLBAR ===== */
    .shop-toolbar {
        background: var(--shop-card-bg);
        border-radius: var(--shop-radius);
        box-shadow: var(--shop-shadow);
        padding: 20px 28px;
        margin-bottom: 28px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 16px;
        border: 1px solid var(--shop-border);
    }
    .toolbar-left {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }
    .toolbar-count-main {
        font-size: 0.8rem;
        color: var(--shop-text-muted);
        font-weight: 500;
    }
    .toolbar-count-main strong {
        color: var(--shop-accent);
        font-weight: 700;
    }
    .toolbar-count-found {
        font-size: 1rem;
        font-weight: 700;
        color: var(--shop-text);
    }
    .toolbar-count-found strong {
        color: var(--shop-accent);
    }
    .toolbar-right {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .toolbar-divider {
        width: 1px;
        height: 32px;
        background: var(--shop-border);
    }

    /* ===== PREMIUM DROPDOWN ===== */
    .premium-dropdown {
        position: relative;
        display: inline-block;
    }
    .premium-dropdown-toggle {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 9px 16px;
        border-radius: 10px;
        border: 1.5px solid var(--shop-border);
        background: var(--shop-card-bg);
        color: var(--shop-text);
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        white-space: nowrap;
        user-select: none;
    }
    .premium-dropdown-toggle:hover {
        border-color: var(--shop-accent);
        background: #fff8f3;
        color: var(--shop-accent);
    }
    .premium-dropdown-toggle i.toggle-icon {
        font-size: 0.7rem;
        transition: transform 0.3s ease;
        color: var(--shop-text-muted);
    }
    .premium-dropdown-toggle .label-icon {
        color: var(--shop-accent);
        font-size: 0.9rem;
    }
    .premium-dropdown-options {
        position: absolute;
        right: 0;
        top: calc(100% + 8px);
        background: var(--shop-card-bg);
        border-radius: var(--shop-radius-sm);
        box-shadow: 0 12px 40px rgba(0,0,0,0.15);
        border: 1px solid var(--shop-border);
        list-style: none;
        margin: 0;
        padding: 6px;
        min-width: 140px;
        z-index: 1000;
        display: none;
        animation: dropdownFadeIn 0.2s ease;
    }
    @keyframes dropdownFadeIn {
        from { opacity: 0; transform: translateY(-8px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .premium-dropdown-options.open { display: block; }
    .premium-dropdown-options li {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 9px 14px;
        border-radius: 7px;
        font-size: 0.85rem;
        font-weight: 500;
        color: var(--shop-text);
        cursor: pointer;
        transition: var(--transition);
    }
    .premium-dropdown-options li:hover {
        background: #fff8f3;
        color: var(--shop-accent);
    }
    .premium-dropdown-options li .check-icon {
        color: var(--shop-accent);
        font-size: 0.75rem;
    }

    /* ===== FILTER PANEL ===== */
    .filter-panel {
        background: var(--shop-card-bg);
        border-radius: var(--shop-radius);
        box-shadow: var(--shop-shadow);
        border: 1px solid var(--shop-border);
        margin-bottom: 28px;
        overflow: hidden;
    }
    .filter-panel-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 18px 24px;
        cursor: pointer;
        border-bottom: 1px solid var(--shop-border);
        transition: var(--transition);
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
    }
    .filter-panel-header:hover {
        background: linear-gradient(135deg, #16213e 0%, #0f3460 100%);
    }
    .filter-panel-title {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 1rem;
        font-weight: 700;
        color: #ffffff;
        margin: 0;
    }
    .filter-panel-title i {
        color: var(--shop-accent);
        font-size: 1rem;
    }
    .filter-toggle-icon {
        color: rgba(255,255,255,0.7);
        font-size: 1rem;
        transition: transform 0.3s ease;
    }
    .filter-toggle-icon.rotated { transform: rotate(180deg); }

    .filter-panel-body {
        padding: 24px;
    }
    .filter-row {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 20px;
    }

    /* Filter Widget */
    .filter-widget {
        background: #fafbfc;
        border-radius: var(--shop-radius-sm);
        border: 1px solid var(--shop-border);
        overflow: hidden;
    }
    .filter-widget-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 14px 18px;
        cursor: pointer;
        border-bottom: 1px solid var(--shop-border);
        transition: var(--transition);
    }
    .filter-widget-header:hover { background: #f0f2f5; }
    .filter-widget-title {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.875rem;
        font-weight: 700;
        color: var(--shop-text);
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .filter-widget-title i { color: var(--shop-accent); font-size: 0.85rem; }
    .filter-widget-toggle {
        color: var(--shop-text-muted);
        font-size: 0.75rem;
        transition: transform 0.3s ease;
    }
    .filter-widget-toggle.rotated { transform: rotate(180deg); }
    .filter-widget-body {
        padding: 16px 18px;
        max-height: 220px;
        overflow-y: auto;
    }
    .filter-widget-body::-webkit-scrollbar { width: 4px; }
    .filter-widget-body::-webkit-scrollbar-track { background: #f5f5f5; }
    .filter-widget-body::-webkit-scrollbar-thumb { background: #ddd; border-radius: 2px; }

    /* Filter Category Item */
    .filter-cat-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 8px 0;
        border-bottom: 1px solid #f0f2f5;
        transition: var(--transition);
    }
    .filter-cat-item:last-child { border-bottom: none; }
    .filter-cat-item:hover { padding-left: 4px; }
    .filter-cat-img {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid var(--shop-border);
    }
    .filter-cat-label {
        flex: 1;
        font-size: 0.85rem;
        color: var(--shop-text);
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 6px;
    }
    .filter-cat-label:hover { color: var(--shop-accent); }
    .filter-cat-count {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #f0f2f5;
        color: var(--shop-text-muted);
        font-size: 0.7rem;
        font-weight: 600;
        padding: 2px 7px;
        border-radius: 20px;
        min-width: 24px;
    }

    .filter-checkbox {
        width: 16px;
        height: 16px;
        accent-color: var(--shop-accent);
        cursor: pointer;
        flex-shrink: 0;
    }

    .filter-see-more {
        display: inline-block;
        margin-top: 10px;
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--shop-accent);
        cursor: pointer;
        text-decoration: none;
        transition: var(--transition);
    }
    .filter-see-more:hover { color: #d35400; }

    /* Price Range Widget */
    .price-range-widget {
        padding: 16px 18px;
    }
    .price-inputs {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 12px;
    }
    .price-input {
        flex: 1;
        padding: 8px 12px;
        border: 1.5px solid var(--shop-border);
        border-radius: 8px;
        font-size: 0.85rem;
        color: var(--shop-text);
        transition: var(--transition);
        background: white;
    }
    .price-input:focus {
        outline: none;
        border-color: var(--shop-accent);
        box-shadow: 0 0 0 3px rgba(230,126,34,0.1);
    }
    .price-sep {
        color: var(--shop-text-muted);
        font-weight: 600;
        font-size: 0.85rem;
    }

    /* ===== PRODUCTS GRID ===== */
    .products-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
    }
    @media (max-width: 991px) { .products-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 575px) { .products-grid { grid-template-columns: repeat(2, 1fr); gap: 14px; } }
    @media (max-width: 375px) { .products-grid { grid-template-columns: 1fr; } }

    /* ===== PRODUCT CARD ===== */
    .product-card {
        background: var(--shop-card-bg);
        border-radius: var(--shop-radius);
        border: 1px solid var(--shop-border);
        overflow: hidden;
        box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        transition: var(--transition);
        position: relative;
        display: flex;
        flex-direction: column;
    }
    .product-card:hover {
        box-shadow: var(--shop-shadow-hover);
        transform: translateY(-6px);
        border-color: rgba(230,126,34,0.2);
    }

    /* Card Image Area */
    .product-card-img-wrap {
        position: relative;
        overflow: hidden;
        aspect-ratio: 4/3;
        background: #f8f9fa;
    }
    .product-card-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        display: block;
    }
    .product-card-img.hover-img {
        position: absolute;
        top: 0; left: 0;
        opacity: 0;
        transition: opacity 0.4s ease, transform 0.5s ease;
    }
    .product-card:hover .product-card-img.default-img {
        transform: scale(1.06);
        opacity: 0;
    }
    .product-card:hover .product-card-img.hover-img {
        opacity: 1;
        transform: scale(1.06);
    }
    .product-card:hover .product-card-img.default-img:not(:only-child) {
        opacity: 0;
    }

    /* Card Badge */
    .product-card-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        z-index: 2;
    }
    .badge-sale {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }
    .badge-instock {
        background: linear-gradient(135deg, #11998e, #38ef7d);
        color: white;
    }
    .badge-outofstock {
        background: linear-gradient(135deg, #f093fb, #f5576c);
        color: white;
    }
    .badge-discount {
        background: linear-gradient(135deg, var(--shop-accent), var(--shop-accent-light));
        color: white;
        margin-top: 5px;
    }

    /* Card Action Buttons */
    .product-card-actions {
        position: absolute;
        top: 12px;
        right: 12px;
        z-index: 3;
        display: flex;
        flex-direction: column;
        gap: 8px;
        opacity: 0;
        transform: translateX(12px);
        transition: var(--transition);
    }
    .product-card:hover .product-card-actions {
        opacity: 1;
        transform: translateX(0);
    }
    @media (max-width: 600px) {
        .product-card-actions {
            opacity: 1;
            transform: translateX(0);
        }
    }
    .card-action-btn {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: white;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(0,0,0,0.12);
        transition: var(--transition);
        text-decoration: none;
        color: var(--shop-text);
        font-size: 0.85rem;
    }
    .card-action-btn:hover {
        background: var(--shop-accent);
        color: white;
        box-shadow: 0 6px 20px rgba(230,126,34,0.4);
        transform: scale(1.1);
    }
    .card-action-btn.active-wishlist {
        background: #fff0f3;
        color: #e53e3e;
    }
    .card-action-btn.active-wishlist:hover {
        background: #e53e3e;
        color: white;
    }

    /* Card Content */
    .product-card-body {
        padding: 16px 18px 20px;
        display: flex;
        flex-direction: column;
        flex: 1;
        gap: 6px;
    }
    .product-card-cats {
        display: flex;
        flex-wrap: wrap;
        gap: 4px;
    }
    .product-card-cat-tag {
        font-size: 0.7rem;
        font-weight: 600;
        color: var(--shop-accent);
        background: rgba(230,126,34,0.08);
        padding: 2px 8px;
        border-radius: 4px;
        text-decoration: none;
        transition: var(--transition);
        text-transform: uppercase;
        letter-spacing: 0.3px;
        cursor: pointer;
        border: none;
    }
    .product-card-cat-tag:hover {
        background: var(--shop-accent);
        color: white;
    }
    .product-card-name {
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--shop-text);
        text-decoration: none;
        line-height: 1.35;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        transition: var(--transition);
    }
    .product-card-name:hover { color: var(--shop-accent); }

    /* Rating */
    .product-card-rating {
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .rating-stars {
        display: flex;
        gap: 2px;
    }
    .rating-stars i {
        font-size: 0.7rem;
        color: #ddd;
    }
    .rating-stars i.filled { color: #f6ad55; }
    .rating-value {
        font-size: 0.75rem;
        color: var(--shop-text-muted);
        font-weight: 600;
    }

    /* Price */
    .product-card-price {
        display: flex;
        align-items: baseline;
        gap: 8px;
        margin-top: auto;
    }
    .price-current {
        font-size: 1.1rem;
        font-weight: 800;
        color: var(--shop-text);
        letter-spacing: -0.3px;
    }
    .price-old {
        font-size: 0.8rem;
        font-weight: 500;
        color: #a0aec0;
        text-decoration: line-through;
    }
    .price-save {
        font-size: 0.7rem;
        font-weight: 700;
        color: #38a169;
        background: #f0fff4;
        padding: 2px 6px;
        border-radius: 4px;
    }

    /* Add to Cart Button */
    .product-card-footer {
        padding: 0 18px 18px;
    }
    .btn-add-to-cart {
        width: 100%;
        padding: 11px 20px;
        border-radius: var(--shop-radius-sm);
        border: 2px solid var(--shop-accent);
        background: transparent;
        color: var(--shop-accent);
        font-size: 0.85rem;
        font-weight: 700;
        letter-spacing: 0.3px;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        text-decoration: none;
    }
    .btn-add-to-cart:hover {
        background: var(--shop-accent);
        color: white;
        box-shadow: 0 6px 20px rgba(230,126,34,0.35);
        transform: translateY(-1px);
    }
    .btn-add-to-cart.in-cart {
        background: linear-gradient(135deg, #11998e, #38ef7d);
        border-color: transparent;
        color: white;
    }
    .btn-add-to-cart.in-cart:hover {
        box-shadow: 0 6px 20px rgba(56,239,125,0.35);
    }

    /* ===== EMPTY STATE ===== */
    .empty-state {
        text-align: center;
        padding: 80px 40px;
        background: var(--shop-card-bg);
        border-radius: var(--shop-radius);
        border: 1px solid var(--shop-border);
        grid-column: 1 / -1;
    }
    .empty-state-icon {
        font-size: 4rem;
        color: #e2e8f0;
        margin-bottom: 16px;
    }
    .empty-state h3 {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--shop-text);
        margin-bottom: 8px;
    }
    .empty-state p {
        color: var(--shop-text-muted);
        font-size: 0.9rem;
    }

    /* ===== PAGINATION ===== */
    .shop-pagination {
        margin-top: 40px;
        display: flex;
        justify-content: center;
    }
    .shop-pagination .pagination {
        gap: 6px;
    }
    .shop-pagination .page-link {
        border-radius: 10px !important;
        border: 1.5px solid var(--shop-border) !important;
        color: var(--shop-text) !important;
        font-weight: 600;
        font-size: 0.875rem;
        padding: 8px 14px;
        transition: var(--transition);
        background: white;
    }
    .shop-pagination .page-link:hover,
    .shop-pagination .page-item.active .page-link {
        background: var(--shop-accent) !important;
        border-color: var(--shop-accent) !important;
        color: white !important;
        box-shadow: 0 4px 12px rgba(230,126,34,0.3);
    }

    /* ===== MODAL PREMIUM ===== */
    .shop-modal .modal-content {
        border-radius: 20px;
        border: none;
        box-shadow: 0 24px 80px rgba(0,0,0,0.2);
        overflow: hidden;
    }
    .shop-modal .modal-header {
        background: linear-gradient(135deg, #1a1a2e, #16213e);
        border-bottom: none;
        padding: 20px 28px;
    }
    .shop-modal .modal-title {
        color: white;
        font-weight: 700;
        font-size: 1.1rem;
    }
    .shop-modal .btn-close {
        filter: invert(1) opacity(0.7);
    }
    .shop-modal .modal-body { padding: 28px; }
    .shop-modal .modal-img {
        border-radius: 14px;
        width: 100%;
        height: 280px;
        object-fit: cover;
        box-shadow: 0 8px 24px rgba(0,0,0,0.1);
    }
    .shop-modal .modal-footer {
        border-top: 1px solid var(--shop-border);
        padding: 18px 28px;
    }
    .modal-premium-badge {
        display: inline-block;
        background: linear-gradient(135deg, var(--shop-accent), var(--shop-accent-light));
        color: white;
        font-size: 0.7rem;
        font-weight: 700;
        padding: 4px 12px;
        border-radius: 20px;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        margin-bottom: 10px;
    }
    .modal-product-price {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--shop-text);
    }
    .modal-product-price-old {
        font-size: 1rem;
        color: #a0aec0;
        text-decoration: line-through;
        margin-left: 8px;
    }
    .modal-meta-item {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px 0;
        border-bottom: 1px solid #f0f2f5;
        font-size: 0.875rem;
    }
    .modal-meta-item:last-child { border-bottom: none; }
    .modal-meta-label {
        font-weight: 700;
        color: var(--shop-text);
        min-width: 90px;
    }
    .modal-meta-value { color: var(--shop-text-muted); }
    .btn-modal-cart {
        background: linear-gradient(135deg, var(--shop-accent), var(--shop-accent-light));
        border: none;
        color: white;
        font-weight: 700;
        padding: 12px 24px;
        border-radius: 12px;
        width: 100%;
        transition: var(--transition);
        font-size: 0.95rem;
        letter-spacing: 0.3px;
    }
    .btn-modal-cart:hover {
        box-shadow: 0 8px 24px rgba(230,126,34,0.4);
        transform: translateY(-2px);
    }

    /* Filter Row mobile */
    @media (max-width: 991px) {
        .filter-row { grid-template-columns: 1fr 1fr; }
    }
    @media (max-width: 575px) {
        .filter-row { grid-template-columns: 1fr; }
        .shop-toolbar { padding: 16px; }
        .toolbar-right { flex-wrap: wrap; }
        .shop-page-title { font-size: 1.5rem; }
    }

    /* Loading overlay */
    .loading-indicator {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 10px 16px;
        color: var(--shop-text-muted);
        font-size: 0.85rem;
        gap: 8px;
    }
    .loading-indicator img { width: 24px; height: 24px; }
</style>
@endpush

<div>
    {{-- ===== BREADCRUMB ===== --}}
    <div class="shop-breadcrumb-wrap">
        <div class="container">
            <h1 class="shop-page-title">Our Collection</h1>
            <ul class="shop-breadcrumb-nav">
                <li><a href="{{ url('/') }}"><i class="fas fa-home"></i> Home</a></li>
                <li><span class="sep"><i class="fas fa-chevron-right" style="font-size:0.6rem"></i></span></li>
                <li><span class="current">Shop</span></li>
            </ul>
        </div>
    </div>

    {{-- ===== MAIN SECTION ===== --}}
    <section class="shop-section">
        <div class="container">

            {{-- ===== TOOLBAR ===== --}}
            <div class="shop-toolbar">
                <div class="toolbar-left">
                    <span class="toolbar-count-main">
                        <strong>{{ $products_count }}</strong> total products in store
                    </span>
                    <span class="toolbar-count-found">
                        Showing <strong>{{ count($products) }}</strong> results
                    </span>
                </div>
                <div class="toolbar-right">
                    {{-- Show Per Page --}}
                    <div wire:loading wire:target="perPageValueChange" class="loading-indicator">
                        <img src="https://api.iconify.design/eos-icons:bubble-loading.svg" alt="loading">
                    </div>
                    <div wire:loading.remove wire:target="perPageValueChange" class="premium-dropdown" id="showDropdown">
                        <div class="premium-dropdown-toggle" onclick="togglePremiumDropdown('showDropdownOptions', this)">
                            <i class="fas fa-th label-icon"></i>
                            <span>Show: {{ $parPageValue }}</span>
                            <i class="fas fa-chevron-down toggle-icon"></i>
                        </div>
                        <ul class="premium-dropdown-options" id="showDropdownOptions">
                            @foreach([12, 24, 36, 50] as $num)
                                <li onclick="event.stopPropagation()" wire:click.prevent="perPageValueChange({{ $num }})">
                                    <span>{{ $num }} items</span>
                                    @if($parPageValue == $num)
                                        <i class="fas fa-check check-icon"></i>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="toolbar-divider"></div>

                    {{-- Sort By --}}
                    <div wire:loading wire:target="shortByValueChange" class="loading-indicator">
                        <img src="https://api.iconify.design/eos-icons:bubble-loading.svg" alt="loading">
                    </div>
                    <div wire:loading.remove wire:target="shortByValueChange" class="premium-dropdown" id="sortDropdown">
                        <div class="premium-dropdown-toggle" onclick="togglePremiumDropdown('sortDropdownOptions', this)">
                            <i class="fas fa-sort-amount-down label-icon"></i>
                            <span>Sort: {{ ucfirst(str_replace('_', ' ', $shortBy)) }}</span>
                            <i class="fas fa-chevron-down toggle-icon"></i>
                        </div>
                        <ul class="premium-dropdown-options" id="sortDropdownOptions">
                            @foreach(['latest' => 'Latest Date', 'oldest' => 'Oldest Date', 'featured' => 'Featured', 'price_low_to_high' => 'Price: Low to High', 'price_high_to_low' => 'Price: High to Low'] as $val => $label)
                                <li onclick="event.stopPropagation()" wire:click.prevent="shortByValueChange('{{ $val }}')">
                                    <span>{{ $label }}</span>
                                    @if($shortBy == $val)
                                        <i class="fas fa-check check-icon"></i>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            {{-- ===== FILTER PANEL ===== --}}
            <div x-data="{ open: false }" class="filter-panel">
                <div class="filter-panel-header" @click="open = !open">
                    <h5 class="filter-panel-title">
                        <i class="fas fa-sliders-h"></i>
                        Advanced Filters
                    </h5>
                    <i class="fas fa-chevron-down filter-toggle-icon" :class="{ 'rotated': open }"></i>
                </div>

                <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform -translate-y-2"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     class="filter-panel-body">
                    <div class="filter-row">

                        {{-- Categories Widget --}}
                        <div x-data="{ open: @entangle('openC') }" class="filter-widget">
                            <div class="filter-widget-header" @click="open = !open">
                                <h6 class="filter-widget-title">
                                    <i class="fas fa-tags"></i>
                                    Categories
                                </h6>
                                <i class="fas fa-chevron-down filter-widget-toggle" :class="{ 'rotated': open }"></i>
                            </div>
                            <div x-show="open" x-cloak class="filter-widget-body">
                                @forelse($visibleCategories as $category)
                                    <div class="filter-cat-item" wire:key="cat-{{ $category->id }}">
                                        @if($category->image)
                                            <img class="filter-cat-img"
                                                 src="{{ asset('storage/uploads/categories/' . $category->image) }}"
                                                 alt="{{ $category->name }}">
                                        @else
                                            <div style="width:36px;height:36px;border-radius:50%;background:#f0f2f5;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                                <i class="fas fa-folder" style="color:#a0aec0;font-size:0.8rem;"></i>
                                            </div>
                                        @endif
                                        <input type="checkbox"
                                               class="filter-checkbox"
                                               wire:model.live="selectedCategories"
                                               id="cat{{ $category->id }}"
                                               value="{{ $category->id }}">
                                        <label class="filter-cat-label" for="cat{{ $category->id }}">
                                            {{ $category->name }}
                                            <span class="filter-cat-count">{{ $category->product->count() }}</span>
                                        </label>
                                    </div>
                                @empty
                                    <div style="text-align:center;padding:20px;color:#a0aec0;font-size:0.85rem;">
                                        <i class="fas fa-info-circle"></i> No categories
                                    </div>
                                @endforelse

                                @if($visibleCountC < $categories->count())
                                    <a class="filter-see-more" wire:click="loadMore">
                                        <i class="fas fa-plus-circle"></i> See More
                                    </a>
                                @else
                                    <a class="filter-see-more" wire:click="seeLess">
                                        <i class="fas fa-minus-circle"></i> See Less
                                    </a>
                                @endif
                            </div>
                        </div>

                        {{-- Sub Categories Widget --}}
                        <div x-data="{ open: @entangle('openSC') }" class="filter-widget">
                            <div class="filter-widget-header" @click="open = !open">
                                <h6 class="filter-widget-title">
                                    <i class="fas fa-layer-group"></i>
                                    Sub Categories
                                </h6>
                                <i class="fas fa-chevron-down filter-widget-toggle" :class="{ 'rotated': open }"></i>
                            </div>
                            <div x-show="open" x-cloak class="filter-widget-body">
                                @forelse($visibleSubCategories as $category)
                                    <div class="filter-cat-item" wire:key="subcat-{{ $category->id }}">
                                        @if($category->image)
                                            <img class="filter-cat-img"
                                                 src="{{ asset('storage/uploads/sub-categories/' . $category->image) }}"
                                                 alt="{{ $category->name }}">
                                        @else
                                            <div style="width:36px;height:36px;border-radius:50%;background:#f0f2f5;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                                <i class="fas fa-folder-open" style="color:#a0aec0;font-size:0.8rem;"></i>
                                            </div>
                                        @endif
                                        <input type="checkbox"
                                               class="filter-checkbox"
                                               wire:model.live="selectedSubCategories"
                                               id="subcat{{ $category->id }}"
                                               value="{{ $category->id }}">
                                        <label class="filter-cat-label" for="subcat{{ $category->id }}">
                                            {{ $category->name }}
                                            <span class="filter-cat-count">{{ $category->products->count() }}</span>
                                        </label>
                                    </div>
                                @empty
                                    <div style="text-align:center;padding:20px;color:#a0aec0;font-size:0.85rem;">
                                        <i class="fas fa-info-circle"></i> No sub categories
                                    </div>
                                @endforelse

                                @if($visibleCountSC < $sub_categories->count())
                                    <a class="filter-see-more" wire:click="loadMoreSC">
                                        <i class="fas fa-plus-circle"></i> See More
                                    </a>
                                @else
                                    <a class="filter-see-more" wire:click="seeLessSC">
                                        <i class="fas fa-minus-circle"></i> See Less
                                    </a>
                                @endif
                            </div>
                        </div>

                        {{-- Price Range Widget --}}
                        <div x-data="{ open: false }" class="filter-widget">
                            <div class="filter-widget-header" @click="open = !open">
                                <h6 class="filter-widget-title">
                                    <i class="fas fa-taka-sign"></i>
                                    Price Range
                                </h6>
                                <i class="fas fa-chevron-down filter-widget-toggle" :class="{ 'rotated': open }"></i>
                            </div>
                            <div x-show="open" x-cloak class="price-range-widget">
                                <div wire:ignore>
                                    <div id="slider-range"></div>
                                </div>
                                <div class="price-inputs">
                                    <input type="text" class="price-input" id="amount" name="price" placeholder="Min ৳">
                                    <span class="price-sep">—</span>
                                    <input type="text" class="price-input" placeholder="Max ৳">
                                </div>
                                <button href="javascript:void(0)" class="btn-add-to-cart" style="margin-top:14px;" onclick="return false;">
                                    <i class="fas fa-filter"></i> Apply Filter
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            {{-- ===== PRODUCTS GRID ===== --}}
            <div class="products-grid">
                @forelse($products as $product)
                    @if($product->is_active == 1)
                        @php
                            $uniqueId = 'furnitureModal_' . $product->id;
                            $hasDiscount = $product->productDetail->discount_price;
                            $currentPrice = $hasDiscount ? $product->productDetail->discount_price : $product->productDetail->regular_price;
                            $images = $product->gallery_images;
                            $averageRating = round($product->reviews->avg('rating'));
                            $inCart = Cart::instance('cart')->content()->where('id', $product->id)->count() > 0;
                            $inWishlist = Cart::instance('wishlist')->content()->where('id', $product->id)->count() > 0;
                            if ($hasDiscount && $product->productDetail->regular_price > 0) {
                                $savePercent = round((($product->productDetail->regular_price - $hasDiscount) / $product->productDetail->regular_price) * 100);
                            } else {
                                $savePercent = 0;
                            }
                        @endphp

                        <div class="product-card" wire:key="product-{{ $product->id }}" wire:preserve-scroll>

                            {{-- Image Area --}}
                            <div class="product-card-img-wrap">
                                <a href="{{ route('product.details', ['slug' => $product->slug]) }}" wire:navigate>
                                    <img class="product-card-img default-img"
                                         src="{{ asset('storage/uploads/products/' . $product->image) }}"
                                         alt="{{ $product->name }}">
                                    @if($images)
                                        @foreach($images as $image)
                                            <img class="product-card-img hover-img"
                                                 src="{{ asset('storage/uploads/products/gallery/' . $image) }}"
                                                 alt="{{ $product->name }}">
                                        @endforeach
                                    @endif
                                </a>

                                {{-- Badge --}}
                                <div class="product-card-badge">
                                    @if($product->stock_status == 'instock')
                                        <span class="badge-sale badge-instock">
                                            <i class="fas fa-check-circle" style="font-size:0.65rem"></i> In Stock
                                        </span>
                                    @elseif($product->stock_status == 'outofstock')
                                        <span class="badge-sale badge-outofstock">
                                            <i class="fas fa-times-circle" style="font-size:0.65rem"></i> Out of Stock
                                        </span>
                                    @endif
                                    @if($hasDiscount && $savePercent > 0)
                                        <br>
                                        <span class="badge-sale badge-discount" style="margin-top:5px">
                                            -{{ $savePercent }}%
                                        </span>
                                    @endif
                                </div>

                                {{-- Action Buttons --}}
                                <div class="product-card-actions">
                                    <a href="{{ route('product.details', ['slug' => $product->slug]) }}" wire:navigate
                                       class="card-action-btn" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a class="card-action-btn wishlist-toggle {{ $inWishlist ? 'active-wishlist' : '' }}"
                                       data-id="{{ $product->id }}"
                                       data-rowid="{{ Cart::instance('wishlist')->content()->where('id', $product->id)->first()?->rowId ?? null }}"
                                       data-name="{{ $product->name }}"
                                       data-slug="{{ $product->slug }}"
                                       data-price="{{ $currentPrice }}"
                                       data-image="{{ $product->image }}"
                                       title="{{ $inWishlist ? 'Remove from Wishlist' : 'Add to Wishlist' }}">
                                        @if($inWishlist)
                                            <i class="fa-solid fa-heart"></i>
                                        @else
                                            <i class="fa-regular fa-heart"></i>
                                        @endif
                                    </a>
                                </div>
                            </div>

                            {{-- Card Body --}}
                            <div class="product-card-body">
                                {{-- Categories --}}
                                <div class="product-card-cats">
                                    @if($product->category)
                                        <button class="product-card-cat-tag"
                                                wire:click.prevent="filterByCategory({{ $product->category->id }})">
                                            {{ $product->category->name }}
                                        </button>
                                    @endif
                                    @if($product->subCategory)
                                        <button class="product-card-cat-tag"
                                                wire:click.prevent="filterBySubCategory({{ $product->subCategory->id }})">
                                            {{ $product->subCategory->name }}
                                        </button>
                                    @endif
                                </div>

                                {{-- Name --}}
                                <a href="{{ route('product.details', ['slug' => $product->slug]) }}" wire:navigate
                                   class="product-card-name" title="{{ $product->name }}">
                                    {{ Str::limit($product->name, 45) }}
                                </a>

                                {{-- Rating --}}
                                <div class="product-card-rating">
                                    <div class="rating-stars">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fa fa-star {{ $i <= $averageRating ? 'filled' : '' }}"></i>
                                        @endfor
                                    </div>
                                    <span class="rating-value">
                                        {{ number_format($product->reviews->avg('rating') ?? 0, 1) }}
                                        <span style="color:#cbd5e0">({{ $product->reviews->count() }})</span>
                                    </span>
                                </div>

                                {{-- Price --}}
                                <div class="product-card-price">
                                    <span class="price-current">৳{{ number_format($currentPrice, 0) }}</span>
                                    @if($hasDiscount)
                                        <span class="price-old">৳{{ number_format($product->productDetail->regular_price, 0) }}</span>
                                        @if($savePercent > 0)
                                            <span class="price-save">Save {{ $savePercent }}%</span>
                                        @endif
                                    @endif
                                </div>
                            </div>

                            {{-- Footer Button --}}
                            <div class="product-card-footer">
                                @if($inCart)
                                    <a href="{{ route('cart') }}" wire:navigate class="btn-add-to-cart in-cart">
                                        <i class="fas fa-check-circle"></i> Added to Cart
                                    </a>
                                @else
                                    {{-- data attributes দিয়ে shared modal fill হবে, কোনো per-product modal নেই --}}
                                    <button class="btn-add-to-cart open-cart-modal"
                                            data-product-id="{{ $product->id }}"
                                            data-product-name="{{ $product->name }}"
                                            data-product-img="{{ asset('storage/uploads/products/' . $product->image) }}"
                                            data-product-price="৳{{ number_format($currentPrice, 0) }}"
                                            data-product-old-price="{{ $hasDiscount ? '৳' . number_format($product->productDetail->regular_price, 0) : '' }}"
                                            data-product-desc="{{ strip_tags($product->productDetail->short_description ?? '') }}"
                                            data-product-material="{{ $product->productDetail->material ?? '' }}"
                                            data-product-category="{{ $product->category->name ?? '' }}"
                                            data-product-stock="{{ $product->stock_status }}"
                                            data-product-slug="{{ route('product.details', ['slug' => $product->slug]) }}">
                                        <i class="fas fa-shopping-bag"></i> Add to Cart
                                    </button>
                                @endif
                            </div>

                        </div>
                    @endif
                @empty
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <i class="fas fa-search"></i>
                        </div>
                        <h3>No Products Found</h3>
                        <p>Try adjusting your filters or browse all categories.</p>
                    </div>
                @endforelse
            </div>

            {{-- ===== PAGINATION ===== --}}
            <div class="shop-pagination">
                {{ $products->links('livewire::bootstrap') }}
            </div>

        </div>
    </section>

    {{-- ===== SINGLE SHARED MODAL =====
         wire:ignore.self দিয়ে Livewire re-render থেকে রক্ষা,
         Livewire এর root <div> এর ভেতরে আছে --}}
    <div wire:ignore.self class="modal fade shop-modal" id="sharedCartModal" tabindex="-1"
         aria-labelledby="sharedCartModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" wire:ignore>
                <div class="modal-header">
                    <h5 class="modal-title" id="sharedCartModalLabel">
                        <i class="fas fa-shopping-bag me-2" style="color:var(--shop-accent)"></i>
                        Quick Add to Cart
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-4">
                        <div class="col-md-5">
                            <img id="sharedModalImg" src="" class="modal-img" alt="Product"
                                 style="border-radius:14px;width:100%;height:280px;object-fit:cover;box-shadow:0 8px 24px rgba(0,0,0,0.1);">
                        </div>
                        <div class="col-md-7">
                            <span class="modal-premium-badge">
                                <i class="fas fa-crown me-1"></i> Premium Collection
                            </span>
                            <h4 id="sharedModalName"
                                style="font-weight:800;color:#2d3748;margin-bottom:10px;font-size:1.15rem;margin-top:8px;"></h4>
                            <div style="margin-bottom:14px;">
                                <span id="sharedModalPrice" class="modal-product-price"></span>
                                <span id="sharedModalOldPrice" class="modal-product-price-old" style="display:none;"></span>
                            </div>
                            <p id="sharedModalDesc"
                               style="color:#718096;font-size:0.875rem;line-height:1.6;margin-bottom:16px;display:none;"></p>
                            <div id="sharedModalMaterial" class="modal-meta-item" style="display:none;">
                                <span class="modal-meta-label">
                                    <i class="fas fa-cube me-2" style="color:#e67e22"></i>Material
                                </span>
                                <span id="sharedModalMaterialVal" class="modal-meta-value"></span>
                            </div>
                            <div id="sharedModalCategory" class="modal-meta-item" style="display:none;">
                                <span class="modal-meta-label">
                                    <i class="fas fa-tag me-2" style="color:#e67e22"></i>Category
                                </span>
                                <span id="sharedModalCategoryVal" class="modal-meta-value"></span>
                            </div>
                            <div class="modal-meta-item">
                                <span class="modal-meta-label">
                                    <i id="sharedModalStockIcon" class="fas fa-circle me-2"></i>Stock
                                </span>
                                <span id="sharedModalStockVal" class="modal-meta-value" style="font-weight:600;"></span>
                            </div>
                            <div style="margin-top:20px;">
                                <button id="sharedModalCartBtn" class="btn-modal-cart">
                                    <i class="fas fa-shopping-cart me-2"></i> Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a id="sharedModalDetailsLink" href="#"
                       class="btn btn-outline-secondary btn-sm" style="border-radius:8px;">
                        <i class="fas fa-external-link-alt me-1"></i> View Full Details
                    </a>
                    <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal"
                            style="border-radius:8px;">Close</button>
                </div>
            </div>
        </div>
    </div>

</div>


@push('scripts')
<script>
    // ===== Premium Dropdown Toggle =====
    function togglePremiumDropdown(id, toggleEl) {
        const allOptions = document.querySelectorAll('.premium-dropdown-options');
        allOptions.forEach(opt => {
            if (opt.id !== id) {
                opt.classList.remove('open');
                const parentToggle = opt.previousElementSibling;
                if (parentToggle) {
                    const icon = parentToggle.querySelector('.toggle-icon');
                    if (icon) icon.style.transform = '';
                }
            }
        });

        const target = document.getElementById(id);
        if (!target) return;
        target.classList.toggle('open');

        const icon = toggleEl.querySelector('.toggle-icon');
        if (icon) {
            icon.style.transform = target.classList.contains('open') ? 'rotate(180deg)' : '';
        }
    }

    // Close dropdowns on outside click
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.premium-dropdown')) {
            document.querySelectorAll('.premium-dropdown-options').forEach(opt => {
                opt.classList.remove('open');
            });
            document.querySelectorAll('.toggle-icon').forEach(icon => {
                icon.style.transform = '';
            });
        }
    });

    // ===== Wishlist Toggle =====
    axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    function initWishlistToggle() {
        document.querySelectorAll('.wishlist-toggle').forEach(function(btn) {
            btn.removeEventListener('click', handleWishlistClick);
            btn.addEventListener('click', handleWishlistClick);
        });
    }

    function handleWishlistClick(e) {
        e.preventDefault();

        let btn = this;
        let icon = btn.querySelector('i');
        let originalIconHTML = icon ? icon.outerHTML : '';

        if (icon) {
            icon.outerHTML = `<img src="https://api.iconify.design/codex:loader.svg" alt="Loading" style="width:16px;height:16px;" />`;
        }

        let productId = btn.getAttribute('data-id');
        let name = btn.getAttribute('data-name');
        let slug = btn.getAttribute('data-slug');
        let price = btn.getAttribute('data-price');
        let image = btn.getAttribute('data-image');
        let isInWishlist = originalIconHTML.includes('fa-solid');

        let url = isInWishlist ? `/wishlist/remove-by-id/${productId}` : `/wishlist/add/${productId}`;
        let payload = isInWishlist ? {} : { id: productId, name, slug, price, image };

        axios.post(url, payload)
            .then(function(response) {
                let newIcon = isInWishlist
                    ? '<i class="fa-regular fa-heart fa-lg"></i>'
                    : '<i class="fa-solid fa-heart fa-lg"></i>';
                btn.querySelector('img') ? btn.querySelector('img').outerHTML = newIcon : null;

                if (isInWishlist) {
                    btn.classList.remove('active-wishlist');
                } else {
                    btn.classList.add('active-wishlist');
                }

                Livewire.dispatch('alert-success', response.data.message || 'Wishlist updated.');
                document.querySelectorAll('.wishlist-count').forEach(el => {
                    el.textContent = response.data.wishlistCount;
                });
            })
            .catch(function(error) {
                console.error('Wishlist error:', error);
                let imgEl = btn.querySelector('img');
                if (imgEl) imgEl.outerHTML = originalIconHTML;
            });
    }

    document.addEventListener('DOMContentLoaded', function() {
        initWishlistToggle();
        initCartModal();
    });

    document.addEventListener("livewire:initialized", () => {
        Livewire.hook("element.init", ({ el, component }) => {
            initWishlistToggle();
            initCartModal();
        });
    });

    // ===== Shared Cart Modal =====
    // Product card এর data attributes পড়ে shared modal populate করে
    // Livewire re-render এ modal destroy হয় না কারণ modal card এর বাইরে
    function initCartModal() {
        document.querySelectorAll('.open-cart-modal').forEach(function(btn) {
            btn.removeEventListener('click', handleCartModalOpen);
            btn.addEventListener('click', handleCartModalOpen);
        });
    }

    function handleCartModalOpen() {
        const btn = this;
        const productId  = btn.dataset.productId;
        const name       = btn.dataset.productName;
        const img        = btn.dataset.productImg;
        const price      = btn.dataset.productPrice;
        const oldPrice   = btn.dataset.productOldPrice;
        const desc       = btn.dataset.productDesc;
        const material   = btn.dataset.productMaterial;
        const category   = btn.dataset.productCategory;
        const stock      = btn.dataset.productStock;
        const detailsUrl = btn.dataset.productSlug;

        // Modal fields populate করো
        document.getElementById('sharedModalImg').src = img;
        document.getElementById('sharedModalImg').alt = name;
        document.getElementById('sharedModalName').textContent = name;
        document.getElementById('sharedModalPrice').textContent = price;

        const oldPriceEl = document.getElementById('sharedModalOldPrice');
        oldPriceEl.textContent = oldPrice || '';
        oldPriceEl.style.display = oldPrice ? 'inline' : 'none';

        const descEl = document.getElementById('sharedModalDesc');
        descEl.textContent = desc || '';
        descEl.style.display = desc ? 'block' : 'none';

        const materialRow = document.getElementById('sharedModalMaterial');
        document.getElementById('sharedModalMaterialVal').textContent = material;
        materialRow.style.display = material ? 'flex' : 'none';

        const categoryRow = document.getElementById('sharedModalCategory');
        document.getElementById('sharedModalCategoryVal').textContent = category;
        categoryRow.style.display = category ? 'flex' : 'none';

        const inStock = stock === 'instock';
        const stockIcon = document.getElementById('sharedModalStockIcon');
        const stockVal  = document.getElementById('sharedModalStockVal');
        stockIcon.style.color = inStock ? '#38a169' : '#e53e3e';
        stockVal.textContent  = inStock ? 'In Stock' : 'Out of Stock';
        stockVal.style.color  = inStock ? '#38a169' : '#e53e3e';

        document.getElementById('sharedModalDetailsLink').href = detailsUrl;

        // Cart button: পুরনো listener clone করে সরাও, নতুন লাগাও
        const cartBtn = document.getElementById('sharedModalCartBtn');
        const newCartBtn = cartBtn.cloneNode(true);
        cartBtn.parentNode.replaceChild(newCartBtn, cartBtn);

        newCartBtn.addEventListener('click', function() {
            // Modal বন্ধ করো
            const modalEl = document.getElementById('sharedCartModal');
            const bsModal = bootstrap.Modal.getInstance(modalEl);
            if (bsModal) bsModal.hide();

            // Livewire component খুঁজে addToCart() call করো
            const wireEl = document.querySelector('[wire\\:id]');
            if (wireEl) {
                const wireId = wireEl.getAttribute('wire:id');
                Livewire.find(wireId).addToCart(parseInt(productId));
            }
        });

        // Modal খোলো — instance থাকলে আগেরটা destroy করো
        const modalEl = document.getElementById('sharedCartModal');
        let existing = bootstrap.Modal.getInstance(modalEl);
        if (existing) {
            existing.dispose();
        }
        const sharedModal = new bootstrap.Modal(modalEl, {
            keyboard: true,
            backdrop: true
        });
        sharedModal.show();
    }
</script>
@endpush
