<section id="main-section">
    <div class="wrapper-50 margin-auto center">
    <h2>Login</h2>
    <form class="form" action="index.php?ctrl=UserController&action=doLogin" method="POST">
        <input type="email" name="email"placeholder="Mail" required/><br>
        <input type="password" name="password"placeholder="Password" required/><br>
        <p>
            <input type="submit" class="submit-btn" value="Connect">
        </p>
        <!-- <div class="error-message"><?php echo $erreurConn; ?></div> -->
        <div class="error-message"><p><?php if(isset($error)) echo $error; ?></p></div>
    </form>
    <p></p>

    <div class="create-account">You don't have an account ? <a href='index.php?ctrl=UserController&action=create'>Create one</a> !</div>
</div>
</section>