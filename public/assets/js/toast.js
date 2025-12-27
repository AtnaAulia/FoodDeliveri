document.addEventListener("DOMContentLoaded", () => {
    const toast = document.querySelector(".toast");
    if (!toast) return;

    const iconBox = toast.querySelector(".toast-icon");
    const type = toast.classList.contains("success") ? "success"
               : toast.classList.contains("warning") ? "warning"
               : toast.classList.contains("error") ? "error"
               : "default";

    const icons = {
        success: `<svg fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                    <polyline points="20 6 9 17 4 12"></polyline>
                  </svg>`,
        warning: `<svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                  </svg>`,
        error: `<svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                  <path d="M6 18L18 6M6 6l12 12"></path>
                </svg>`,
        default: `<svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="16" x2="12" y2="12"></line>
                    <line x1="12" y1="8" x2="12.01" y2="8"></line>
                  </svg>`
    };

    iconBox.innerHTML = icons[type];

    setTimeout(() => toast.classList.add("show"), 50);

    setTimeout(() => {
        toast.classList.remove("show");
        toast.classList.add("hide");
    }, 3000);

    setTimeout(() => toast.remove(), 3500);
});
