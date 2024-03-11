

    <style>
      body{
        font-family: "Poppins", sans-serif;
      }
.custom-footer {
  background-color: #171717;
  color: #adb5bd !important;
  padding: 20px;
 
}

.social-media {
  display: flex;
  justify-content: space-between;
  border-bottom: 1px solid #495057;
  padding-bottom: 15px;
  margin-bottom: 20px;
  align-items: center;
}

.social-media-content {
  font-size: 16px;
}

.social-icons a {
  color: #adb5bd;
  font-size: 24px;
  margin-right: 10px;
}

.footer-links {
  display: flex;
  justify-content: space-around;
  margin-bottom: 20px;
}

.footer-links-container {
  display: flex;
  flex-wrap: wrap;
}

.footer-links-column {
  flex: 1;
  margin-right: 20px;
}

.footer-links h6 {
  font-size: 18px;
  font-weight: bold;
  margin-bottom: 10px;
}

.footer-links a, .footer-links p {
  text-decoration: none;
  color: #adb5bd;
  font-size: 16px;
}

.footer-links a:hover {
  color: #007bff;
}

.copyright {
  background-color: rgba(0, 0, 0, 0.05);
  padding: 15px;
  font-weight: bold;
  font-size: 16px;
  
}
footer i:hover{
  scale: 1.5;
  transition: 0.3s;
  color: cyan;
}
i{
  transition: 0.3s;
}
    </style>

<body>

    <footer class="custom-footer">
        <section class="social-media">
          <div class="social-media-content">
            <span>Свържете се с нас в социалните мрежи:</span>
          </div>
          <div class="social-icons">
            <a href="https://twitter.com/CinemaxSF" target="_blank"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-instagram"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
   
          </div>
        </section>
      
        <section class="footer-links">
          <div class="footer-links-container">
            <div class="footer-links-column">
              <h6>Cinemax</h6>
              <p>
               Кино сайтът за бързо и лесно гледане на програма и запазване на билети. За въпроси и проблеми, свържете се чрез контактите или вижте още информация.
              </p>
            </div>
      
            <!-- <div class="footer-links-column">
              <h6>Products</h6>
              <p><a href="#">Angular</a></p>
              <p><a href="#">React</a></p>
              <p><a href="#">Vue</a></p>
              <p><a href="#">Laravel</a></p>
            </div> -->
      
            <div class="footer-links-column">
              <h6>Още</h6>
              <p><a href="#">Общи правила</a></p>
              <p><a href="#">Въпроси</a></p>
              <p><a href="#">Работете с нас</a></p>
              <p><a href="#">Повече за нас</a></p>
            </div>
      
            <div class="footer-links-column">
              <h6>Контакти</h6>
              <p><i class="fa fa-home"></i> 1202 Център, София</p>
              <p><i class="fa fa-envelope"></i> cinemax@gmail.com</p>
              <p><i class="fa fa-phone"></i> + 359 88 550 3256</p>
              <!-- <p><i class="fa fa-print"></i> + 359 234 567 89</p> -->
            </div>
          </div>
        </section>
      
        <section class="copyright">
          <div class="copyright-content">
          ©
                      <?php echo date("Y") ?> Cinemax
          </div>
        </section>
      </footer>
    
</body>
