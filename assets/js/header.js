let header = null;

class Header {
    constructor() {
        this.header = document.querySelector("header");
        this.nav = this.header.querySelector("nav");
        this.container = this.nav.querySelector(".nav-container");
        this.navList = this.nav.querySelector(".nav-menu");
        this.navItems = Array.from(this.navList.querySelectorAll(".nav-item"));
        this.onResize = this.onResize.bind(this);
        this.throttled = false;

        window.addEventListener("resize", this.onResize);
    }

    init() {
        this.checkSize();
    }

    checkSize() {
        let windowWidth = window.innerWidth;
        
        if(windowWidth <= 600) {
            if(this.container.classList.contains("desktop")) {
                this.container.classList.remove("desktop");
            }
            this.container.classList.add("mobile");
        } else {
            if(this.container.classList.contains("mobile")) {
                this.container.classList.remove("mobile");
            }
            this.container.classList.add("desktop");
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
