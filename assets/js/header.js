let header = null;

class Header {
    constructor() {
        this.header = document.querySelector("header");
        this.nav = this.header.querySelector("nav");
        this.container = this.nav.querySelector(".nav-container");
        this.navList = this.nav.querySelector(".nav-menu");
        this.navItems = Array.from(this.navList.querySelectorAll(".nav-item"));
        this.navButton = null;
        this.overlay = null;
        this.onResize = this.onResize.bind(this);
        this.onClick = this.onClick.bind(this);
        this.throttled = false;

        window.addEventListener("resize", this.onResize);
    }

    init() {
        if(this.navButton == null) {
            this.navButton = document.createElement("button");
            this.navButton.classList.add("nav-button");
            this.navButton.addEventListener("click", this.onClick);
            this.container.addEventListener("click", this.onClick);
        }

        if(this.overlay == null) {
            this.overlay = document.createElement("div");
            this.overlay.classList.add("nav-overlay");
        }

        this.checkSize();
    }

    onClick() {
        this.container.classList.toggle("active");
    }

    checkSize() {
        let windowWidth = window.innerWidth;
        
        if(windowWidth <= 600) {
            if(this.container.classList.contains("desktop")) {
                this.container.classList.remove("desktop");
            }
            this.container.classList.add("mobile");
            this.nav.prepend(this.navButton);
            this.nav.prepend(this.overlay);
        } else {
            if(this.container.classList.contains("mobile")) {
                this.container.classList.remove("mobile");
            }
            this.container.classList.add("desktop");
            this.navButton.remove();
            this.overlay.remove();
        }
    }
    
    onResize() {
        if(this.throttled == false) {
            this.throttled = true;

            this.checkSize();
            
            setTimeout(() => {
                this.throttled = false;
            }, 100);
        }
        
    }
}

window.addEventListener("load", function () {
    if (header == null) {
        header = new Header();
    }

    header.init();
})
