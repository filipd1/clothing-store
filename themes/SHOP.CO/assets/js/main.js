document.addEventListener("DOMContentLoaded", () => {

    // 1. Mobile Menu
    const toggle = document.querySelector(".mobile-menu-toggle")
    const nav = document.querySelector(".mobile-menu")

    if (toggle && nav) {
        toggle.addEventListener("click", (e) => {
            e.stopPropagation()
            nav.classList.toggle("active")
        })

        nav.addEventListener("click", (e) => {
            e.stopPropagation()
        })

        document.addEventListener("click", (e) => {
            if (!nav.contains(e.target) && !toggle.contains(e.target)) {
                nav.classList.remove("active")
            }
        })
    }


    // 2. Quantity Buttons (delegacja)
    document.addEventListener("click", function(e) {

        if (e.target.classList.contains("quantity-plus")) {

            let input = e.target.closest(".cart-quantity").querySelector(".qty")
            input.value = parseInt(input.value) + 1
            input.dispatchEvent(new Event("change", { bubbles: true }))
        }

        if (e.target.classList.contains("quantity-minus")) {

            let input = e.target.closest(".cart-quantity").querySelector(".qty")

            if (input.value > 1) {
                input.value = parseInt(input.value) - 1

                input.dispatchEvent(new Event("change", { bubbles: true }))
            }
        }

    });

    
    // 3. Cart update (delegacja)
    document.addEventListener("change", function(e) {
        if (e.target.classList.contains("qty")) {
            const form = e.target.closest(".woocommerce-cart-form");
            
            if (form) {
                form.submit(); 
            }
        }
    });


    // 4. Product Filters (delegacja)
    document.addEventListener('submit', function(e) {

        if (e.target && e.target.classList.contains('custom-filter-form')) {
            e.preventDefault();

            const formData = new FormData(e.target);
            const params = new URLSearchParams();

            if (formData.get('min_price')) params.set('min_price', formData.get('min_price'));
            if (formData.get('max_price')) params.set('max_price', formData.get('max_price'));

            const colors = formData.getAll('filter_color[]');
            if (colors.length > 0) {
                params.set('filter_color', colors.join(','));
                params.set('query_type_color', 'or');
            }

            const sizes = formData.getAll('filter_size[]');
            if (sizes.length > 0) {
                params.set('filter_size', sizes.join(','));
                params.set('query_type_size', 'or');
            }

            const newUrl = window.location.pathname + '?' + params.toString();
            window.location.href = newUrl;
        }
    });


    // 5. Zakładki na stronie produktu
    const tabs = document.querySelectorAll(".tab")
    const tabContents = document.querySelectorAll(".tab-content")

    tabs.forEach(tab => {
        tab.addEventListener("click", function() {
            const target = this.dataset.tab
            tabs.forEach(t => t.classList.remove("active"))
            tabContents.forEach(tC => tC.classList.remove("active"))

            this.classList.add("active")
            const targetContent = document.getElementById(target)
            if (targetContent) {
                targetContent.classList.add("active")
            }
        })
    })

});