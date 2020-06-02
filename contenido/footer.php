<footer class="page-footer  bg-dark">             
        <div class=" row bg-dark text-white justify-content-end">
                    <div class="d-flex justify-content-end mt-2">
                        <nav class="navbar navbar-expand-md navbar-dark justify-content-end bg-dark">
                            <div class="collapse navbar-collapse" id="navbarText">
                                <ul class="navbar-nav mr-3">
                                <li class="nav-item">
                                    <a class="nav-link" href="contacto.php">Contactenos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="ubicacion.php">Ubicación</a>
                                </li>
                                </ul>
                            </div>                        
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                        </nav>
                    </div>
                </div>         
                
                <div class=" row text-center  bg-dark text-white ">
                    <div class="mx-auto mb-2">
                    <span>© 2020 Copyright:</span>    
                    <span>Andrés Delgado</span></div>
                </div> 
        </footer>
    </div>




    <article class="modal fade" id="login">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Inicia sesión</h5>
                    <span data-dismiss="modal" class="close">X</span>
                </div>
                <form method="post" class="form-signin" id="inicio">
                    <div class="modal-body">
                        <div class="form-label-group">
                            <label for="correo" class="col-form-label">Correo electrónico:</label>
                            <input type="email" id="correo_L" name="correo" class="form-control" placeholder="Correo electrónico" autofocus required>
                            <span class="text-danger ml-3  correo_vacio"></span>
                        </div>

                        <div class="form-label-group">
                            <label for="password" class="col-form-label">Contraseña:</label>
                            <input type="password" id="password_L" name="password" class="form-control" placeholder="Contraseña" required>
                        </div>
                        <div class="form-group">
                            <label for="remember" class="col-form-label">Recuerdame:</label>
                            <input type="checkbox" name="remember" id="remember">
                        </div>
                        <div class="d-flex justify-content-center">
                            <span class="text-danger login_mal"></span>
                        </div>
                    </div>
                    <div class="modal-footer">                          
                        <button type="button" name="entrar" id="b_login" class="btn btn-success b_login">Entrar</button>
                    </div>
                </form>
            </div>
        </div>
    </article>

        
    <article class="modal fade" id="registrar">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Registrarse</h5>
                    <span data-dismiss="modal" class="close">X</span>
                </div>

                <form method="post" class="form-signin ">
                    <div class="modal-body">
                        
                        <div class="form-label-group">
                            <label for="nombre" class="col-form-label">Nombre:</label>
                            <input type="text" id="Usuario_R" name="nombre" class="form-control" placeholder="Nombre" autofocus>
                        </div>

                        <div class="form-label-group">
                            <label for="mail" class="col-form-label">Correo electrónico:</label>
                            <input type="email" id="Mail_R" name="correo" class="form-control" placeholder="Dirección de correo electrónico" autofocus required>
                            <span class="text-danger ml-3  correo_repe"></span>
                        </div>

                        <div class="form-label-group">                            
                            <label for="psw1" class="col-form-label">Contraseña:</label>
                            <input type="password" id="Pass_R" name="password" class="form-control" placeholder="Contraseña">
                            <span class="text-danger ml-3 psw_corta"></span>
                        </div>

                        <div class="form-label-group">        
                            <label for="psw2" class="col-form-label">Repita Contraseña:</label>
                            <input type="password" id="Pass_R2" name="password" class="form-control" placeholder="Contraseña">
                            <span class="text-danger ml-3  psw_repe"></span>
                        </div>

                    </div>

                    <div class="modal-footer text-right">
                        <button type="button" name="entrar" id="b_registro" class="btn btn-primary b_registro">Registrarse</button>
                    </div>
                </form>
            </div>
        </div>
    </article>