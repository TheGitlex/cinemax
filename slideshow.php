<style> 
#slideshow {
  display: flex;
  justify-content: center;
}

.slider {
  text-align: center;
  width: 100vw;
  max-width: 100vw;
  height: 500px;

  position: relative;
  overflow: hidden;
  top: 0;
  margin-top: 70px;
  box-shadow: 0px 6px black;
}


.slider .list {
  position: absolute;
  width: max-content;
  height: 100%;
  left: 0;
  top: 0;
  display: flex;
  transition: 1s;
}

.slider .list img {
  max-width: 100vw;
  min-width: 100vw;
  height: 100%;
  object-fit: cover;
  border-radius: 0px;
  /* box-shadow: 1px +10px 1px 100px rgba(0, 227, 64, 0.75); */
}

.slider .buttons {
  position: absolute;
  top: 45%;
  left: 5%;
  width: 90%;
  display: flex;
  justify-content: space-between;
}

.slider .buttons button {
  width: 50px;
  height: 100px;
  border-radius: 50%;
  /* background-color: rgba(9, 186, 192, 0.975); */
  background: none;
  color: rgb(128, 251, 255);
  border: none;
  font-family: monospace;
  font-weight: bold;
  font-size: 80px;
  transition: 0.5s;
}

.slider .buttons button:hover {
  cursor: pointer;
  scale: 1.3;

  /* background-color: rgba(9, 186, 192, 0.404); */
}

.slider .dots {
  position: absolute;
  bottom: 10px;
  left: 0;
  color: #fff;
  width: 100%;
  margin: 0;
  padding: 0;
  display: flex;
  justify-content: center;
  
}


.slider .dots li:hover {
  cursor: pointer;
  scale: 1.5;
  opacity: 1;
}

.slider .list {
  transition: left 0.3s ease;
  /* Add a smooth transition to the left property */
}

.slider .dots li {
  list-style: none;
  width: 10px;
  height: 10px;
  background-color: #fff;
  margin: 10px;
  border-radius: 20px;
  transition: 0.5s;
  opacity: 0;
}

.slider .dots li.active {
  width: 30px;
}

@media screen and (max-width: 768px) {
  .slider {
    height: 400px;
  }
}


#carouselExampleIndicators{
  margin-top: 70px;
}
.carousel {
    cursor: grabbing; /* Change cursor to grabbing during swipe */
  }

  /* Change cursor to grabbing when hovering over carousel */
  .carousel:hover {
    cursor: grabbing;
  }
</style>
<div id="slideshow" style="height: 500px">
		<div class="slider">
			<div class="list">
				<div class="item">
					<img src="bigposters/avengers.jpg" alt="" />
				</div>
				<div class="item">
					<img src="bigposters/godzila.jpg" alt="" />
				</div>
				<div class="item">
					<img src="bigposters/batman.jpg" alt="" />
				</div>
				<div class="item">
					<img src="bigposters/menu.jpg" alt="" />
				</div>
			</div>
			<div class="buttons" style="pointer-events: none;">
				<button id="prev" style="pointer-events: auto;">
					< </button>
						<button id="next" style="pointer-events: auto;">></button>
			</div>
			<ul class="dots">
				<li class="active"></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
			</ul>
		</div>
	</div>





    <script>
      
          let slider = document.querySelector(".slider .list");
  let items = document.querySelectorAll(".slider .list .item");
  let next = document.getElementById("next");
  let prev = document.getElementById("prev");
  let dots = document.querySelectorAll(".slider .dots li");

  let lengthItems = items.length - 1;
  let active = 0;
  let itemWidth = items[0].offsetWidth;
  let startX = 0;
  let isDragging = false;
  let refreshInterval;

  next.onclick = function () {
    active = active + 1 <= lengthItems ? active + 1 : 0;
    reloadSlider();
    resetAutoSlideTimer();
  };

  prev.onclick = function () {
    active = active - 1 >= 0 ? active - 1 : lengthItems;
    reloadSlider();
    resetAutoSlideTimer();
  };

  function reloadSlider() {
    slider.style.left = -active * itemWidth + "px";

    let last_active_dot = document.querySelector(".slider .dots li.active");
    last_active_dot.classList.remove("active");
    dots[active].classList.add("active");
  }

  dots.forEach((li, key) => {
    li.addEventListener("click", () => {
      active = key;
      reloadSlider();
      resetAutoSlideTimer();
    });
  });

  slider.addEventListener("mousedown", (e) => {
    startX = e.clientX;
    isDragging = true;
    slider.style.transition = "none";
    document.body.style.cursor = "grabbing";
  });

  document.addEventListener("mouseup", (e) => {
    if (isDragging) {
      isDragging = false;
      slider.style.transition = "";
      document.body.style.cursor = "";
      let deltaX = e.clientX - startX;
      if (Math.abs(deltaX) > 50) {
        active =
          deltaX > 0
            ? active - 1 >= 0
              ? active - 1
              : lengthItems
            : active + 1 <= lengthItems
            ? active + 1
            : 0;
      }
      reloadSlider();
      resetAutoSlideTimer();
    }
  });

  document.addEventListener("mousemove", (e) => {
    if (isDragging) {
      let deltaX = e.clientX - startX;
      slider.style.left = -active * itemWidth + deltaX + "px";
    }
  });

  window.onresize = function (event) {
    itemWidth = items[0].offsetWidth;
    reloadSlider();
    resetAutoSlideTimer();
  };

  function resetAutoSlideTimer() {
    clearInterval(refreshInterval);
    refreshInterval = setInterval(() => {
      if (!isDragging) {
        next.click();
      }
    }, 7000);
  }

  // Initial auto slide switching
  resetAutoSlideTimer();




  
    </script>