
<style> 
.overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.778);
  opacity: 0;
  z-index: -1;
  transition: opacity 500ms ease-in-out;
}

#login-popup {
  /* margin-top: -63rem; */
  position: fixed;
  z-index: 1;
  justify-content: center;
  align-items: center;
  width: 100%;
  height: 100%;
  transition: all 500ms ease-in-out;
  display: none;
}

.comingsoonmovie {
  margin-top: 2rem;
  text-align: center;
  align-items: center;
  display: flex;
  flex-direction: column;
  justify-content: center;
  padding: 1rem;
}

.countdown{
  font-family: "Poppins", sans-serif;
  color: white; 
  font-size: 25px;
 
  background-color: #33333399;
  border-radius: 20px;
  border: 5px solid black;

}
.closeloginbutton {
  display: flex;
  margin-left: 300px;
  font-size: 30px;
  text-decoration: double;
  background: none;
  color: grey;
  border: none;
  cursor: pointer;
}

.closeloginbutton:hover {
  color: #05a1a4;
}


.cloader {
  width: 10em;
  height: 10em;
  border: 4px solid white;
  border-radius: 50%;
  margin: auto;
  position: relative;
  padding: 2rem;
}

.clface {
  position: relative;
  width: 100%;
  height: 100%;
  transform: translateY(-3px);
}

.top {
  height: 10px;
  width: 4px;
  content: "";
  background-color: white;
  border-radius: 5em;
  margin-top: -30px;
  margin-left: 42px;
}

.bottom {
  height: 10px;
  width: 4px;
  content: "";
  background-color: white;
  border-radius: 5em;
  margin-top: 135px;
  margin-left: 42px;
}

.left {
  height: 4px;
  width: 10px;
  content: "";
  background-color: white;
  border-radius: 5em;
  margin-top: -82px;
  margin-left: 112px;
}

.right {
  height: 4px;
  width: 10px;
  content: "";
  background-color: white;
  border-radius: 5em;
  margin-top: -4px;
  margin-left: -35px;
}

.clsface {
  position: absolute;
  width: 40px;
  height: 40px;
  margin-left: 24px;
  margin-top: 15px;
  border-radius: 6em;
  border: 2px solid #636363;
}

.hand {
  width: 65%;
  height: 4px;
  background-color: white;
  border-radius: 3em;
  border: none;
  position: absolute;
  top: 85%;
  left: -15%;
  transform-origin: 100%;
  transform: rotate(90deg);
}

.pin {
  width: 25%;
  height: 25%;
  border-radius: 50%;
  background: white;
  position: absolute;
  top: 86%;
  left: 50%;
  transform: translate(-50%, -50%);
}
#sub {
  width: 10%;
  height: 10%;
  border-radius: 50%;
  background: #636363;
  position: absolute;
  top: 40%;
  left: 50%;
  transform: translate(-50%, -50%);
}

#h1 {
  animation: rotate 4s linear infinite;
}

#h2 {
  width: 45%;
  left: 5%;
  top: 45%;
  background-color: #636363;
  animation: rotate 1s linear infinite;
}

@keyframes rotate {
  from {
    transform: rotate(90deg);
  }

  to {
    transform: rotate(450deg);
  }
}

</style>

<div id="login-popup" >
		<div class="overlay"  onclick="closelogin()"></div>
	<div style="background-color:rgb(7, 7, 7); border-radius:5px; padding:10px; border:5px solid rgb(12, 143, 179);">
    <button type="button" class="closeloginbutton" style="font-size: 3rem;" onclick="closelogin()">&times;</button>
	<!-- <p>noviniii</p>
	<img src="logo.png" alt=" "> -->
	<div class="comingsoonmovie">
		<div class="cloader">
			<div class="clface">
				<div class="clsface">
					<div id="h2" class="hand"></div>
				</div>
				<div class="top"></div>
				<div class="bottom"></div>
				<div class="left"></div>
				<div class="right"></div>
				<div id="sub" class="pin"></div>
				<div id="h1" class="hand"></div>
				<div id="main" class="pin"></div>
			</div>
		</div> <br>

			<div class="countdown" style="padding: 10px;" >
			<p> <b> Следваща премиера: </b> </p> 
		<label id="timer">00:00:00</label> <br> <br>
		</div>
	</div>
	
		</div>

	</div>

    <script>
        function updateTimer() {
        // Fetch the release date and title of the next movie
        fetch('get_next_movie.php')
            .then(response => response.json())
            .then(data => {
                if (data) {
                    const releaseDate = new Date(data.releaseDate).getTime();
                    const now = new Date().getTime();
                    const timeDifference = releaseDate - now;

                    if (timeDifference > 0) {
    const days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
    const hours = Math.floor((timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

    // Adjust the release date by adding one day
    const releaseDate = new Date(data.releaseDate);
    releaseDate.setDate(releaseDate.getDate() );

    // Display the countdown and movie title
    function formatDate(date) {
    const day = String(date.getDate()).padStart(2, '0');
    const month = String(date.getMonth() + 1).padStart(2, '0'); // Month starts from 0
    const year = date.getFullYear();
    return `${day}/${month}/${year}`;
}

document.getElementById('timer').innerHTML = `${days}d ${hours}h ${minutes}m ${seconds}s <br>${data.title}<br> <a href="movie.php?id=${data.id}"> <br> <img src="icons/${data.icon}" alt="" style="height: 200px;scale:1.2;border-radius:5px"> </a> <br> <br>${formatDate(releaseDate)}`;






                    } else {
                        // Movie has already been released
                        document.getElementById('timer').innerHTML = 'Излязъл!';
                    }
                } else {
                    // No upcoming movies
                    document.getElementById('timer').innerHTML = 'Няма ';
                }
            })
            .catch(error => console.error('Error:', error));
    }

    // Call the updateTimer function initially
    updateTimer();

    // Update the timer every second
    setInterval(updateTimer, 1000);
   
   
  




    </script>
