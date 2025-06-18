<div class="widget glass-widget mb-4">
    <div class="widget-title">
        <h5 class="text-white">Search</h5>
    </div>
    <div class="widget-search glass-search">
        <form action="{{ route('frontend.search') }}" class="position-relative">
            <input type="search"
                   value="{{ request()->route()->getName() == 'frontend.search' ? request()->q : '' }}"
                   id="gsearch"
                   name="q"
                   placeholder="Search..."
                   class="glass-input">
            <button type="submit" class="glass-search-btn">
                <i class="las la-search"></i>
            </button>
        </form>
    </div>
</div>

<style>
    .glass-widget {
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        background: rgba(47, 25, 83, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.1);
    }

    .glass-search {
        position: relative;
        margin-top: 1rem;
    }

    .glass-input {
        width: 100%;
        padding: 0.75rem 1rem;
        padding-right: 3rem;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 8px;
        color: white;
        font-size: 0.9rem;
        backdrop-filter: blur(5px);
        transition: all 0.3s ease;
    }

    /* White placeholder text */
    .glass-input::placeholder {
        color: white;
        opacity: 0.8; /* Slightly transparent for better glass effect */
    }

    /* Placeholder text styling for different browsers */
    .glass-input::-webkit-input-placeholder {
        color: white;
        opacity: 0.8;
    }
    .glass-input::-moz-placeholder {
        color: white;
        opacity: 0.8;
    }
    .glass-input:-ms-input-placeholder {
        color: white;
        opacity: 0.8;
    }
    .glass-input:-moz-placeholder {
        color: white;
        opacity: 0.8;
    }

    .glass-input:focus {
        outline: none;
        background: rgba(255, 255, 255, 0.15);
        border-color: rgba(255, 255, 255, 0.3);
        box-shadow: 0 0 0 3px rgba(47, 25, 83, 0.3);
    }

    .glass-search-btn {
        position: absolute;
        right: 0;
        top: 0;
        height: 100%;
        width: 3rem;
        background: transparent;
        border: none;
        color: white;
        cursor: pointer;
        transition: all 0.3s ease;
        border-top-right-radius: 8px;
        border-bottom-right-radius: 8px;
    }

    .glass-search-btn:hover {
        color: rgba(255, 255, 255, 0.8);
        background: rgba(47, 25, 83, 0.3);
    }
</style>
