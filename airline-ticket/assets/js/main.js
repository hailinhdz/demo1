// Main JavaScript file

// Form validation
document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('.needs-validation');
    
    forms.forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        });
    });
});

// Flight search form
const initFlightSearch = () => {
    const departureDate = document.getElementById('departure_date');
    if (departureDate) {
        // Set min date to today
        const today = new Date().toISOString().split('T')[0];
        departureDate.min = today;
    }
};

// Initialize tooltips
const initTooltips = () => {
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
};

// Format currency
const formatCurrency = (amount) => {
    return new Intl.NumberFormat('vi-VN', {
        style: 'currency',
        currency: 'VND'
    }).format(amount);
};

// Initialize all components
document.addEventListener('DOMContentLoaded', function() {
    initFlightSearch();
    initTooltips();
});

// Back to top button
window.onscroll = function() {
    const backToTop = document.getElementById('back-to-top');
    if (backToTop) {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            backToTop.style.display = "block";
        } else {
            backToTop.style.display = "none";
        }
    }
};

// Open blank links in a new tab
document.querySelectorAll('a[target="_blank"]').forEach(link => {
    link.addEventListener('click', function(event) {
        event.preventDefault();
        window.open(this.href, '_blank');
        return false;
    }
    );
}
);

// Tự động ẩn thông báo sau 5 giây
document.addEventListener('DOMContentLoaded', function() {
    // Ẩn tất cả các alert sau 5 giây
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    });
});

// Xử lý xóa vé khỏi giỏ hàng
document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.delete-cart-item');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const flightId = this.dataset.flightId;
            const cartItem = document.getElementById('cart-item-' + flightId);
            const form = this.closest('form');
            
            if (confirm('Bạn có chắc muốn xóa vé này?')) {
                cartItem.classList.add('removing');
                
                setTimeout(() => {
                    form.submit();
                }, 300);
            }
        });
    });
});