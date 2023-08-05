
    <!-- Modal -->
    <div class="modal" id="login-modal">
    <div class="modal-content">
        <a onclick="HideModal();" class="modal-close" title="Close Modal">X</a>
        <h3>Infilearn</h3>
        <div class="modal-area">
            <div id class="modal-input">
                <form id="login_form" action="login_process.php" method="POST">
                    <label id="lable_a" for="username">EMAIL ADDRESS</label><br>
                    <input name="email" id="email" type="email" class="modal-input-box" required><br>
                    <label id="lable_b" for="password">PASSWORD</label><br>
                    <input name="password" id="password" type="password" class="modal-input-box" required><br>
                    <input type="checkbox" name="rememberme" style="height: 16px;width:16px;">
                    <span style="margin-left:5px;font-family:'Nunito';">Remember Me</span><br>
                    <div class="modal-submit-forgot">
                        <button class="login-modal-btn" name="loginSubmit" type="submit">Login</button>
                        <a href="forgetpassword.php">Forgot Password?</a>
                    </div>
                </form>
            </div>
            <hr class="login-modal-hr">
            <div class="modal-signup-page-link">
                <p>Don't have an account? <a href="signup.php">Sign up</a></p>
            </div>
        </div>
    </div>
  </div>

