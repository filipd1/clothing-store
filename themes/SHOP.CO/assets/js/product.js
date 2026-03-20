document.addEventListener("DOMContentLoaded", function() {

    const buttons = document.querySelectorAll(".option-btn")

    buttons.forEach(btn => {

        btn.addEventListener("click",function() {

            const attribute = this.dataset.attribute
            const value = this.dataset.value
            const wrapper = this.closest(".product-option")

            wrapper.querySelectorAll(".option-btn").forEach(b => b.classList.remove("active"))
            this.classList.add("active")
            const select = document.querySelector('select[name="attribute_'+attribute.toLowerCase()+'"]')

            if (select) {
                select.value = value
                jQuery(select).trigger('change');
            }

        })
    })
})