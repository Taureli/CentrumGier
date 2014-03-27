<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!-- Modal -->
<div class="modal fade" id="registerForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <div class="col-md-offset-1"><h3 class="modal-title" id="myModalLabel">Rejestracja</h3></div>
            </div>
            <div class="modal-body">

                <form id='register' method="GET" action="service/register.php" class='form-horizontal'>
                    <fieldset>
                        <div class="col-sm-10 col-md-offset-1">
                            <div class='form-group'>
                                <label for="Email" class="col-sm-2 control-label"><h5>Email</h5></label>
                                <div class="col-sm-10">
                                    <input type='text' name="email" id="Email" placeholder='Email' class='form-control' maxlength="50">
                                </div>
                            </div>
                            <div class='form-group'>
                                <label for="Password" class="col-sm-2 control-label"><h5>Hasło</h5></label>
                                <div class="col-sm-10">
                                    <input type='password' name="password" id="Password" placeholder='Hasło' class='form-control' maxlength="50">
                                </div>
                                <div class="col-md-offset-5"><h6>Hasło musi składać się z min. 8 znaków</h6></div>
                            </div>
                            <div class='form-group'>
                                <label for="Name" class="col-sm-2 control-label"><h5>Imię</h5></label>
                                <div class="col-sm-10">
                                    <input type='text' name="name" id="Name" placeholder='Imię' class='form-control' maxlength="50">
                                </div>
                            </div>
                            <div class='form-group'>
                                <label for="Surname" class="col-sm-2 control-label"><h5>Nazwisko</h5></label>
                                <div class="col-sm-10">
                                    <input type='text' name="surname" id="Surname" placeholder='Nazwisko' class='form-control' maxlength="50">
                                </div>
                            </div>
                            <div class="col-md-offset-7"><h6>Wszystkie pola są wymagane</h6></div>
                            <input class='btn btn-success' value='Zarejestruj' type='submit'>
                        </div>
                    </fieldset>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
