<h1>Form to Register</h1>
<hr/>
<form action="" method="post">
    <div>
        <label>Introduce your firstname</label>
        <input type="text" name="firstname" id="firstname" class="<?php echo $user->hasError('firstname') ? 'error' : '' ?>" value="<?php echo $user->firstname; ?>">
        <div class="invalid-feedback">
            <?php echo $user->getFirstError('firstname'); ?>
        </div>
    </div>
    <br/>
    <div>
        <label>Introduce your lastname</label>
        <input type="text" name="lastname" id="lastname">
    </div>
    <br/>
    <div>
        <label>Introduce your birthdate</label>
        <input type="date" name="birthdate" id="birthdate">
    </div>
    <br/>
    <div>
        <label>Introduce your email</label>
        <input type="email" name="email" id="email">
    </div>
    <br/>
    <div>
        <label>Introduce your password</label>
        <input type="password" name="password" id="password">
    </div>
    <br/>
    <div>
        <label>Confirm your password</label>
        <input type="password" name="passwordConfirm" id="passwordConfirm">
    </div>
    <br/>
    <div>
        <button type="submit">Login</button>
    </div>
</form>
