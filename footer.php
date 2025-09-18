</div>

<footer>
    <div class="footer-container">
        <div class="footer-title">Highness Global Publishing House</div>
        <div class="footer-body">
            <div class="footer-section links">
                <div class="section contact">
                    <span class="section-title">Contact Info</span>
                    <ul class="section-list">
                        <li>
                            <span>
                                1-(234)567-8912
                            </span>
                        </li>
                        <li>1234 Spooner Street, Whoville, Where Province, Whenland</li>
                        <li>thisisanemail@email.com</li>
                    </ul>
                </div>
                <div class="section links">
                    <span class="section-title">Section Two</span>
                    <ul class="section-list">
                        <li>Link 1</li>
                        <li>Link 2</li>
                        <li>Link 3</li>
                        <li>Link 4</li>
                    </ul>
                </div>
                <div class="section links">
                    <span class="section-title">Section Two</span>
                    <ul class="section-list">
                        <li>Link 1</li>
                        <li>Link 2</li>
                        <li>Link 3</li>
                        <li>Link 4</li>
                    </ul>
                </div>
            </div>
            <div class="footer-section socials">
                <span class="socials-title">Follow Us</span>
                <div class="socials-icons">
                    <a href="#">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="currentColor"  class="icon icon-tabler icons-tabler-filled icon-tabler-brand-instagram"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16 3a5 5 0 0 1 5 5v8a5 5 0 0 1 -5 5h-8a5 5 0 0 1 -5 -5v-8a5 5 0 0 1 5 -5zm-4 5a4 4 0 0 0 -3.995 3.8l-.005 .2a4 4 0 1 0 4 -4m4.5 -1.5a1 1 0 0 0 -.993 .883l-.007 .127a1 1 0 0 0 1.993 .117l.007 -.127a1 1 0 0 0 -1 -1" /></svg>
                    </a>
                    <a href="#">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="currentColor"  class="icon icon-tabler icons-tabler-filled icon-tabler-brand-linkedin"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 2a5 5 0 0 1 5 5v10a5 5 0 0 1 -5 5h-10a5 5 0 0 1 -5 -5v-10a5 5 0 0 1 5 -5zm-9 8a1 1 0 0 0 -1 1v5a1 1 0 0 0 2 0v-5a1 1 0 0 0 -1 -1m6 0a3 3 0 0 0 -1.168 .236l-.125 .057a1 1 0 0 0 -1.707 .707v5a1 1 0 0 0 2 0v-3a1 1 0 0 1 2 0v3a1 1 0 0 0 2 0v-3a3 3 0 0 0 -3 -3m-6 -3a1 1 0 0 0 -.993 .883l-.007 .127a1 1 0 0 0 1.993 .117l.007 -.127a1 1 0 0 0 -1 -1" /></svg>
                    </a>
                </div>
            </div>
            <div class="footer-section logo">
                <?php
                    echo wp_get_attachment_image(
                        170,
                        "full",
                        "false",
                        array(
                            "class" => "logo footer",
                            "alt"=>"highness logo",
                        )
                    );
                ?>
            </div>
        </div>
        <div class="footer-end">
            <div class="footer-end-section links">
                <ul class="footer-nav">
                    <li>Home</li>
                    <li>Catalogue</li>
                    <li>Contact Us</li>
                    <li>About Us</li>
                    <li>Cart</li>
                </ul>
            </div>
            <div class="footer-end-section copyright">
                <span>Copyright Text</span>
            </div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>

</body>
</html>
