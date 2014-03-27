<div class='navbar navbar-inverse navbar-fixed-top' role='navigation'>
    <div class='container'>
        <div class='navbar-header'>
            <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-collapse'>
                <span class='sr-only'>Toggle navigation</span>
                <span class='icon-bar'></span>
                <span class='icon-bar'></span>
                <span class='icon-bar'></span>
            </button>
            <a class='navbar-brand' href='index.php'>Centrum Gier</a>
        </div>
        <div class='navbar-collapse collapse'>
            <form method="POST" action="service/login.php" class='navbar-form navbar-right'>
                <div class='form-group'>
                    <input type='text' name="email" placeholder='Email' class='form-control'>
                </div>
                <div class='form-group'>
                    <input type='password' name="haslo" placeholder='Hasło' class='form-control'>
                </div>
                <input class='btn btn-success' value='Zaloguj' type='submit'>
            </form>
        </div><!--/.navbar-collapse -->
    </div>
</div>
