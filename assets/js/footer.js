const WINDOWBREAKPOINT = 600;
let foo = [];
class FooterDropdown {
    constructor (section) {
        this.section = section;
        this.sectionTitle = this.section.querySelector(".section-title-container");
        this.sectionList = this.section.querySelector(".section-list");
        this.listItems = Array.from(this.sectionList.querySelectorAll("li"));

        this.onLoad = this.onLoad.bind(this);
        this.onChange = this.onChange.bind(this);

        window.addEventListener("load", this.onLoad);
    }

    onLoad(){
        if (this.checkSize()) {
            this.sectionTitles.forEach((section) => {
                section.addEventListener("click", this.onClick);
            })
        } else {
            this.sectionTitles.forEach((section) => {
                section.removeEventListener("click", this.onClick);
            })
        }
    }

    onChange() {

    }

    checkSize() {
        //returns a true or false value based on the size of the screen

        if(window.innerWidth <= WINDOWBREAKPOINT) {
            return true;
        } else if (window.innerWidth > WINDOWBREAKPOINT) {
            return false;
        }
    }

    onClick() {
        this.section.classList.toggle("active");
    }
}

window.addEventListener("load", function() {
    let dropdowns = Array.from(this.document.querySelectorAll(".section", ".dropdown"));

    dropdowns.forEach((dropdown) => {
        foo.push(new FooterDropdown(dropdown))
    })
})
