let header = null;

class Header {
    constructor() {
        this.header = document.querySelector("header");
        this.nav = this.header.querySelector("nav");
        this.container = this.nav.querySelector(".nav-container");
        this.navList = this.nav.querySelector(".nav-menu");
        this.navItems = Array.from(this.navList.querySelectorAll(".nav-item"));
    }

    init() {
        let windowWidth = window.innerWidth;
        
        if(windowWidth <= 600) {
            if(this.container.classList.contains("desktop")) {
                this.container.classList.remove("desktop");
            }
            this.container.classList.add("mobile")
        }
    }
}

window.addEventListener("load", function () {
    if (header == null) {
        header = new Header();
    }

    header.init();
})
