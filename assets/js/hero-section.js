let heroSection = null;

window.addEventListener("load", function () {
  if (heroSection == null) {
    heroSection = new HeroSection();
    heroSection.onLoad();
  }
});

class HeroSection {
  constructor() {
    this.section = document.querySelector("section.featured-hero");
    this.list = this.section.querySelector("ul.featured-list");
    this.items = Array.from(this.list.querySelectorAll("li.featured-item"));
    this.listLength = this.items.length;
    this.currentIndex = 0;
    this.activeItem = null;
    this.lastActive = null;
    this.onLoad = this.onLoad.bind(this);
    this.changeActive = this.changeActive.bind(this);
    this.handleTransition = this.handleTransition.bind(this);
  }

  onLoad() {
    this.activeItem = this.items[this.currentIndex];
    this.activeItem.classList.add("active");
    
    if(this.listLength > 1) {
        setInterval(this.changeActive, 5000);
    }
  }

  changeActive() {
    this.currentIndex++;
    console.log(this.currentIndex);

    if (this.currentIndex == this.listLength) {
      this.currentIndex = 0;
    }
    this.lastActive = this.activeItem;
    this.activeItem = this.items[this.currentIndex];

    this.lastActive.addEventListener("transitionend", this.handleTransition);
    this.lastActive.classList.remove("active");
  }

  handleTransition() {
    this.activeItem.classList.add("active");
    this.lastActive.removeEventListener("transitionend", this.handleTransition);
  }
}
