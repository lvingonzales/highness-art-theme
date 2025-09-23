const WINDOWBREAKPOINT = 900;
let foo = [];
class FooterDropdown {
  constructor(section) {
    this.section = section;
    this.sectionTitle = this.section.querySelector(".section-title-container");
    this.sectionList = this.section.querySelector(".section-list");
    this.listItems = Array.from(this.sectionList.querySelectorAll("li"));

    this.onLoad = this.onLoad.bind(this);
    this.onClick = this.onClick.bind(this);

    window.addEventListener("resize", this.onLoad);
    this.throttled = false;
  }

  onLoad() {
    if (this.throttled == false) {
      this.throttled = true;
      if (this.checkSize()) {
        this.sectionTitle.addEventListener("click", this.onClick);
      } else {
        if (this.section.classList.contains("active")) {
          this.section.classList.toggle("active");
        }
        this.sectionTitle.removeEventListener("click", this.onClick);
      }

      setTimeout(() => {
        this.throttled = false;
      }, 100);
    }
  }

  checkSize() {
    //returns a true or false value based on the size of the screen

    if (window.innerWidth <= WINDOWBREAKPOINT) {
      return true;
    } else if (window.innerWidth > WINDOWBREAKPOINT) {
      return false;
    }
  }

  onClick() {
    this.section.classList.toggle("active");
  }
}

window.addEventListener("load", function () {
  let dropdowns = Array.from(
    this.document.querySelectorAll(".section.dropdown")
  );

  dropdowns.forEach((dropdown) => {
    foo.push(new FooterDropdown(dropdown));
  });

  foo.forEach((foo) => {
    foo.onLoad();
  });
});
