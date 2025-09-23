class Footer {
    constructor () {
        this.footer = document.querySelectorAll("footer");
        this.linkSection = document.querySelector(".footer-section",".links");
        this.sections = Array.from(this.linkSection.querySelectorAll(".section"));
        this.sectionTitles = [];
        this.sectionIcons = [];
    }
}
