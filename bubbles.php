<div class="bubbles">
  <div class="bubble"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>
</div>
<style>
    body {
        background-image: url(background.jpg);
  background-repeat: repeat-y;
  background-size: cover;
  background-position: center center;
margin-top: -60px;
}

.bubbles {
    position: absolute;
    z-index: -10;
display:none;
  width: 100%;
  height: 100vh;
  overflow: hidden;
}

.bubble {
  position: absolute;
  left: var(--bubble-left-offset);
  bottom: -75%;
  display: block;
  width: var(--bubble-radius);
  height: var(--bubble-radius);
  border-radius: 50%;
  animation: float-up var(--bubble-float-duration) var(--bubble-float-delay) ease-in infinite;
}
.bubble::before {
  position: absolute;
  content: "";
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: hsla(183deg, 94%, 76%, 0.3);
  border-radius: inherit;
  animation: var(--bubble-sway-type) var(--bubble-sway-duration) var(--bubble-sway-delay) ease-in-out alternate infinite;
}
.bubble:nth-child(0) {
  --bubble-left-offset: 8vw;
  --bubble-radius: 3vw;
  --bubble-float-duration: 7s;
  --bubble-sway-duration: 5s;
  --bubble-float-delay: 4s;
  --bubble-sway-delay: 0s;
  --bubble-sway-type: sway-right-to-left;
}
.bubble:nth-child(1) {
  --bubble-left-offset: 62vw;
  --bubble-radius: 6vw;
  --bubble-float-duration: 10s;
  --bubble-sway-duration: 6s;
  --bubble-float-delay: 1s;
  --bubble-sway-delay: 0s;
  --bubble-sway-type: sway-right-to-left;
}
.bubble:nth-child(2) {
  --bubble-left-offset: 11vw;
  --bubble-radius: 5vw;
  --bubble-float-duration: 9s;
  --bubble-sway-duration: 5s;
  --bubble-float-delay: 1s;
  --bubble-sway-delay: 1s;
  --bubble-sway-type: sway-left-to-right;
}
.bubble:nth-child(3) {
  --bubble-left-offset: 59vw;
  --bubble-radius: 4vw;
  --bubble-float-duration: 11s;
  --bubble-sway-duration: 6s;
  --bubble-float-delay: 0s;
  --bubble-sway-delay: 4s;
  --bubble-sway-type: sway-left-to-right;
}
.bubble:nth-child(4) {
  --bubble-left-offset: 95vw;
  --bubble-radius: 1vw;
  --bubble-float-duration: 11s;
  --bubble-sway-duration: 5s;
  --bubble-float-delay: 3s;
  --bubble-sway-delay: 0s;
  --bubble-sway-type: sway-left-to-right;
}
.bubble:nth-child(5) {
  --bubble-left-offset: 41vw;
  --bubble-radius: 7vw;
  --bubble-float-duration: 8s;
  --bubble-sway-duration: 6s;
  --bubble-float-delay: 0s;
  --bubble-sway-delay: 0s;
  --bubble-sway-type: sway-left-to-right;
}
.bubble:nth-child(6) {
  --bubble-left-offset: 46vw;
  --bubble-radius: 9vw;
  --bubble-float-duration: 11s;
  --bubble-sway-duration: 5s;
  --bubble-float-delay: 2s;
  --bubble-sway-delay: 2s;
  --bubble-sway-type: sway-right-to-left;
}
.bubble:nth-child(7) {
  --bubble-left-offset: 35vw;
  --bubble-radius: 2vw;
  --bubble-float-duration: 11s;
  --bubble-sway-duration: 5s;
  --bubble-float-delay: 0s;
  --bubble-sway-delay: 1s;
  --bubble-sway-type: sway-right-to-left;
}
.bubble:nth-child(8) {
  --bubble-left-offset: 29vw;
  --bubble-radius: 6vw;
  --bubble-float-duration: 9s;
  --bubble-sway-duration: 4s;
  --bubble-float-delay: 4s;
  --bubble-sway-delay: 1s;
  --bubble-sway-type: sway-left-to-right;
}
.bubble:nth-child(9) {
  --bubble-left-offset: 4vw;
  --bubble-radius: 5vw;
  --bubble-float-duration: 9s;
  --bubble-sway-duration: 6s;
  --bubble-float-delay: 1s;
  --bubble-sway-delay: 4s;
  --bubble-sway-type: sway-left-to-right;
}
.bubble:nth-child(10) {
  --bubble-left-offset: 25vw;
  --bubble-radius: 9vw;
  --bubble-float-duration: 11s;
  --bubble-sway-duration: 5s;
  --bubble-float-delay: 2s;
  --bubble-sway-delay: 3s;
  --bubble-sway-type: sway-left-to-right;
}
.bubble:nth-child(11) {
  --bubble-left-offset: 20vw;
  --bubble-radius: 4vw;
  --bubble-float-duration: 7s;
  --bubble-sway-duration: 4s;
  --bubble-float-delay: 1s;
  --bubble-sway-delay: 1s;
  --bubble-sway-type: sway-left-to-right;
}
.bubble:nth-child(12) {
  --bubble-left-offset: 86vw;
  --bubble-radius: 3vw;
  --bubble-float-duration: 8s;
  --bubble-sway-duration: 5s;
  --bubble-float-delay: 2s;
  --bubble-sway-delay: 4s;
  --bubble-sway-type: sway-left-to-right;
}
.bubble:nth-child(13) {
  --bubble-left-offset: 87vw;
  --bubble-radius: 10vw;
  --bubble-float-duration: 6s;
  --bubble-sway-duration: 5s;
  --bubble-float-delay: 2s;
  --bubble-sway-delay: 1s;
  --bubble-sway-type: sway-right-to-left;
}
.bubble:nth-child(14) {
  --bubble-left-offset: 100vw;
  --bubble-radius: 5vw;
  --bubble-float-duration: 8s;
  --bubble-sway-duration: 5s;
  --bubble-float-delay: 2s;
  --bubble-sway-delay: 4s;
  --bubble-sway-type: sway-right-to-left;
}
.bubble:nth-child(15) {
  --bubble-left-offset: 5vw;
  --bubble-radius: 2vw;
  --bubble-float-duration: 8s;
  --bubble-sway-duration: 6s;
  --bubble-float-delay: 4s;
  --bubble-sway-delay: 4s;
  --bubble-sway-type: sway-right-to-left;
}
.bubble:nth-child(16) {
  --bubble-left-offset: 27vw;
  --bubble-radius: 5vw;
  --bubble-float-duration: 7s;
  --bubble-sway-duration: 5s;
  --bubble-float-delay: 3s;
  --bubble-sway-delay: 1s;
  --bubble-sway-type: sway-left-to-right;
}
.bubble:nth-child(17) {
  --bubble-left-offset: 22vw;
  --bubble-radius: 8vw;
  --bubble-float-duration: 10s;
  --bubble-sway-duration: 5s;
  --bubble-float-delay: 1s;
  --bubble-sway-delay: 4s;
  --bubble-sway-type: sway-right-to-left;
}
.bubble:nth-child(18) {
  --bubble-left-offset: 68vw;
  --bubble-radius: 7vw;
  --bubble-float-duration: 6s;
  --bubble-sway-duration: 6s;
  --bubble-float-delay: 3s;
  --bubble-sway-delay: 0s;
  --bubble-sway-type: sway-right-to-left;
}
.bubble:nth-child(19) {
  --bubble-left-offset: 56vw;
  --bubble-radius: 8vw;
  --bubble-float-duration: 9s;
  --bubble-sway-duration: 5s;
  --bubble-float-delay: 4s;
  --bubble-sway-delay: 3s;
  --bubble-sway-type: sway-left-to-right;
}
.bubble:nth-child(20) {
  --bubble-left-offset: 31vw;
  --bubble-radius: 3vw;
  --bubble-float-duration: 11s;
  --bubble-sway-duration: 6s;
  --bubble-float-delay: 1s;
  --bubble-sway-delay: 1s;
  --bubble-sway-type: sway-left-to-right;
}
.bubble:nth-child(21) {
  --bubble-left-offset: 49vw;
  --bubble-radius: 2vw;
  --bubble-float-duration: 9s;
  --bubble-sway-duration: 6s;
  --bubble-float-delay: 2s;
  --bubble-sway-delay: 3s;
  --bubble-sway-type: sway-right-to-left;
}
.bubble:nth-child(22) {
  --bubble-left-offset: 59vw;
  --bubble-radius: 4vw;
  --bubble-float-duration: 8s;
  --bubble-sway-duration: 5s;
  --bubble-float-delay: 3s;
  --bubble-sway-delay: 0s;
  --bubble-sway-type: sway-right-to-left;
}
.bubble:nth-child(23) {
  --bubble-left-offset: 30vw;
  --bubble-radius: 3vw;
  --bubble-float-duration: 12s;
  --bubble-sway-duration: 6s;
  --bubble-float-delay: 3s;
  --bubble-sway-delay: 1s;
  --bubble-sway-type: sway-left-to-right;
}
.bubble:nth-child(24) {
  --bubble-left-offset: 32vw;
  --bubble-radius: 4vw;
  --bubble-float-duration: 10s;
  --bubble-sway-duration: 6s;
  --bubble-float-delay: 3s;
  --bubble-sway-delay: 4s;
  --bubble-sway-type: sway-right-to-left;
}
.bubble:nth-child(25) {
  --bubble-left-offset: 83vw;
  --bubble-radius: 4vw;
  --bubble-float-duration: 9s;
  --bubble-sway-duration: 6s;
  --bubble-float-delay: 0s;
  --bubble-sway-delay: 1s;
  --bubble-sway-type: sway-left-to-right;
}
.bubble:nth-child(26) {
  --bubble-left-offset: 4vw;
  --bubble-radius: 5vw;
  --bubble-float-duration: 8s;
  --bubble-sway-duration: 6s;
  --bubble-float-delay: 2s;
  --bubble-sway-delay: 0s;
  --bubble-sway-type: sway-right-to-left;
}
.bubble:nth-child(27) {
  --bubble-left-offset: 63vw;
  --bubble-radius: 4vw;
  --bubble-float-duration: 8s;
  --bubble-sway-duration: 5s;
  --bubble-float-delay: 2s;
  --bubble-sway-delay: 0s;
  --bubble-sway-type: sway-right-to-left;
}
.bubble:nth-child(28) {
  --bubble-left-offset: 92vw;
  --bubble-radius: 6vw;
  --bubble-float-duration: 7s;
  --bubble-sway-duration: 4s;
  --bubble-float-delay: 2s;
  --bubble-sway-delay: 0s;
  --bubble-sway-type: sway-right-to-left;
}
.bubble:nth-child(29) {
  --bubble-left-offset: 97vw;
  --bubble-radius: 6vw;
  --bubble-float-duration: 11s;
  --bubble-sway-duration: 6s;
  --bubble-float-delay: 4s;
  --bubble-sway-delay: 2s;
  --bubble-sway-type: sway-left-to-right;
}
.bubble:nth-child(30) {
  --bubble-left-offset: 94vw;
  --bubble-radius: 2vw;
  --bubble-float-duration: 10s;
  --bubble-sway-duration: 5s;
  --bubble-float-delay: 2s;
  --bubble-sway-delay: 1s;
  --bubble-sway-type: sway-left-to-right;
}
.bubble:nth-child(31) {
  --bubble-left-offset: 100vw;
  --bubble-radius: 9vw;
  --bubble-float-duration: 8s;
  --bubble-sway-duration: 4s;
  --bubble-float-delay: 1s;
  --bubble-sway-delay: 0s;
  --bubble-sway-type: sway-right-to-left;
}
.bubble:nth-child(32) {
  --bubble-left-offset: 77vw;
  --bubble-radius: 3vw;
  --bubble-float-duration: 9s;
  --bubble-sway-duration: 6s;
  --bubble-float-delay: 1s;
  --bubble-sway-delay: 1s;
  --bubble-sway-type: sway-left-to-right;
}
.bubble:nth-child(33) {
  --bubble-left-offset: 80vw;
  --bubble-radius: 8vw;
  --bubble-float-duration: 6s;
  --bubble-sway-duration: 5s;
  --bubble-float-delay: 0s;
  --bubble-sway-delay: 4s;
  --bubble-sway-type: sway-right-to-left;
}
.bubble:nth-child(34) {
  --bubble-left-offset: 11vw;
  --bubble-radius: 1vw;
  --bubble-float-duration: 9s;
  --bubble-sway-duration: 6s;
  --bubble-float-delay: 3s;
  --bubble-sway-delay: 0s;
  --bubble-sway-type: sway-right-to-left;
}
.bubble:nth-child(35) {
  --bubble-left-offset: 88vw;
  --bubble-radius: 9vw;
  --bubble-float-duration: 11s;
  --bubble-sway-duration: 6s;
  --bubble-float-delay: 3s;
  --bubble-sway-delay: 4s;
  --bubble-sway-type: sway-left-to-right;
}
.bubble:nth-child(36) {
  --bubble-left-offset: 58vw;
  --bubble-radius: 6vw;
  --bubble-float-duration: 10s;
  --bubble-sway-duration: 5s;
  --bubble-float-delay: 4s;
  --bubble-sway-delay: 0s;
  --bubble-sway-type: sway-right-to-left;
}
.bubble:nth-child(37) {
  --bubble-left-offset: 1vw;
  --bubble-radius: 8vw;
  --bubble-float-duration: 6s;
  --bubble-sway-duration: 5s;
  --bubble-float-delay: 4s;
  --bubble-sway-delay: 3s;
  --bubble-sway-type: sway-right-to-left;
}
.bubble:nth-child(38) {
  --bubble-left-offset: 39vw;
  --bubble-radius: 5vw;
  --bubble-float-duration: 9s;
  --bubble-sway-duration: 4s;
  --bubble-float-delay: 3s;
  --bubble-sway-delay: 3s;
  --bubble-sway-type: sway-left-to-right;
}
.bubble:nth-child(39) {
  --bubble-left-offset: 50vw;
  --bubble-radius: 5vw;
  --bubble-float-duration: 7s;
  --bubble-sway-duration: 5s;
  --bubble-float-delay: 4s;
  --bubble-sway-delay: 2s;
  --bubble-sway-type: sway-left-to-right;
}
.bubble:nth-child(40) {
  --bubble-left-offset: 31vw;
  --bubble-radius: 4vw;
  --bubble-float-duration: 10s;
  --bubble-sway-duration: 4s;
  --bubble-float-delay: 1s;
  --bubble-sway-delay: 4s;
  --bubble-sway-type: sway-right-to-left;
}
.bubble:nth-child(41) {
  --bubble-left-offset: 42vw;
  --bubble-radius: 5vw;
  --bubble-float-duration: 12s;
  --bubble-sway-duration: 5s;
  --bubble-float-delay: 0s;
  --bubble-sway-delay: 1s;
  --bubble-sway-type: sway-left-to-right;
}
.bubble:nth-child(42) {
  --bubble-left-offset: 68vw;
  --bubble-radius: 5vw;
  --bubble-float-duration: 9s;
  --bubble-sway-duration: 5s;
  --bubble-float-delay: 3s;
  --bubble-sway-delay: 4s;
  --bubble-sway-type: sway-left-to-right;
}
.bubble:nth-child(43) {
  --bubble-left-offset: 63vw;
  --bubble-radius: 3vw;
  --bubble-float-duration: 8s;
  --bubble-sway-duration: 6s;
  --bubble-float-delay: 3s;
  --bubble-sway-delay: 4s;
  --bubble-sway-type: sway-left-to-right;
}
.bubble:nth-child(44) {
  --bubble-left-offset: 90vw;
  --bubble-radius: 7vw;
  --bubble-float-duration: 12s;
  --bubble-sway-duration: 6s;
  --bubble-float-delay: 4s;
  --bubble-sway-delay: 0s;
  --bubble-sway-type: sway-left-to-right;
}
.bubble:nth-child(45) {
  --bubble-left-offset: 94vw;
  --bubble-radius: 9vw;
  --bubble-float-duration: 12s;
  --bubble-sway-duration: 4s;
  --bubble-float-delay: 0s;
  --bubble-sway-delay: 0s;
  --bubble-sway-type: sway-left-to-right;
}
.bubble:nth-child(46) {
  --bubble-left-offset: 79vw;
  --bubble-radius: 2vw;
  --bubble-float-duration: 6s;
  --bubble-sway-duration: 5s;
  --bubble-float-delay: 2s;
  --bubble-sway-delay: 3s;
  --bubble-sway-type: sway-right-to-left;
}
.bubble:nth-child(47) {
  --bubble-left-offset: 15vw;
  --bubble-radius: 2vw;
  --bubble-float-duration: 8s;
  --bubble-sway-duration: 5s;
  --bubble-float-delay: 2s;
  --bubble-sway-delay: 3s;
  --bubble-sway-type: sway-right-to-left;
}
.bubble:nth-child(48) {
  --bubble-left-offset: 70vw;
  --bubble-radius: 6vw;
  --bubble-float-duration: 11s;
  --bubble-sway-duration: 6s;
  --bubble-float-delay: 3s;
  --bubble-sway-delay: 4s;
  --bubble-sway-type: sway-right-to-left;
}
.bubble:nth-child(49) {
  --bubble-left-offset: 35vw;
  --bubble-radius: 3vw;
  --bubble-float-duration: 10s;
  --bubble-sway-duration: 4s;
  --bubble-float-delay: 3s;
  --bubble-sway-delay: 1s;
  --bubble-sway-type: sway-left-to-right;
}
.bubble:nth-child(50) {
  --bubble-left-offset: 97vw;
  --bubble-radius: 4vw;
  --bubble-float-duration: 8s;
  --bubble-sway-duration: 6s;
  --bubble-float-delay: 3s;
  --bubble-sway-delay: 0s;
  --bubble-sway-type: sway-left-to-right;
}

@keyframes float-up {
  to {
    transform: translateY(-175vh);
  }
}
@keyframes sway-left-to-right {
  from {
    transform: translateX(-100%);
  }
  to {
    transform: translateX(100%);
  }
}
@keyframes sway-right-to-left {
  from {
    transform: translateX(100%);
  }
  to {
    transform: translateX(-100%);
  }
}
</style>