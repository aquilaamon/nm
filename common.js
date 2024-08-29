document.addEventListener("DOMContentLoaded", () => {
    const headerHTML = `
        <header>
            <div class="logo">
                <a href="home.html"><img class="nav_logo" id="nav__logo" src="img/NshaMinistries1.png" alt="Logo"></a>
            </div>
            <nav class="nav">
                <ul>
                    <li><a href="home.html">Home</a></li>
                    <li class="dropdownbtn"><a href="#">About</a>
                        <div class="dropdown-content">
                            <a href="about.html">Nasha Team</a>
                            <a href="location.html">Location</a>
                            <a href="history.html">How We Started</a>
                            <a href="events.php">Events & News</a>
                        </div>
                    </li>
                   
                    <li class="dropdownbtn"><a href="#">Giving</a>
                        <div class="dropdown-content">
                            <a href="funding.html">Funding</a>
                            <a href="partnership.html">Partnership</a>
                        </div>
                    </li>
                    
                    <li class="dropdownbtn"><a href="#">Contact</a>
                        <div class="dropdown-content">
                            <a href="contactus.html">Mail Us</a>
            
                        </div>
                    </li>
                    <li><a href="login.php">Login</a></li>
                </ul>
            </nav>
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </header>
    `;


    const footerHTML = `
<footer>
        <div class="footer-content">
            <div class="logo">
                <img src="img/NshaMinistries1.png" alt="Logo">
            </div>
            <div class="address">
            <strong>Address:</strong><br>
            PO BOX 256-2500,
            <br>
            Narok, Bible College<br>
            Nasha Ministry<br>
            <strong>Phone:</strong><br>
            <a href="tel:+254703582784">+254703582784</a>
            <br>
            <a href="tel:+254721339231">+254721339231</a>
        </div>
            <div class="more_on_footer">
            <a href="#">Partnership</a><br>
            <a href="#">Goals</a><br>
            <a href="funding .html">Fundings</a><br>
            <a href="conactus.html">Contact</a>
        </div>
        <div class="social-icons">
            <a href="#">
                <i class="fab fa-facebook-f">
                    <span id="social-icons" rel="noopener" target="_blank" aria-label="Linkedin" title="Linkedin">
                        <svg version="1.0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" height="20" aria-hidden="true"><g id="Facebook F1_layer"><path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"></path></g></svg>
                    </span>
                </i>
            </a>
            <a href="#">
                <i class="fab fa-instagram">
                    <span id="social-icons" rel="noopener" target="_blank" aria-label="Linkedin" title="Linkedin">
                        <svg version="1.0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" height="20" aria-hidden="true"><g id="Instagram3_layer"><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"></path></g></svg>
                    </span>
                </i>
            </a>
            <a href="#">
                <i class="fab fa-twitter">
                    <span id="social-icons" rel="noopener" target="_blank" aria-label="Linkedin" title="Linkedin">
                        <svg version="1.0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="20" aria-hidden="true"><g id="X Twitter4_layer"><path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48z"></path></g></svg>
                    </span>
                </i>
            </a>
        </div>
    </div>
            <div class="more_on_footer">
                <p>More about our ministries and how you can help</p>
                <!--
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
                -->
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 NashaMinistry. All rights reserved.</p>
            <p>Created by  Aquila Amon. <a href="#">Read More About Aquila<a>
        </div>
    </footer>
    `;

    document.getElementById('header').innerHTML = headerHTML;
    document.getElementById('footer').innerHTML = footerHTML;

    // Toggle the navigation menu
    const hamburger = document.querySelector('.hamburger');
    const nav = document.querySelector('.nav');

    hamburger.addEventListener('click', () => {
        nav.classList.toggle('nav-active');
        hamburger.classList.toggle('toggle');
    });
});


document.addEventListener("DOMContentLoaded", () => {
    const hamburger = document.querySelector('.hamburger');
    const nav = document.querySelector('.nav');

    if (hamburger && nav) {
        console.log("Hamburger and nav found");

        hamburger.addEventListener('click', () => {
            console.log("Hamburger clicked");
            nav.classList.toggle('nav-active');
            hamburger.classList.toggle('toggle');
        });
    } else {
        console.log("Hamburger or nav not found");
    }
});

