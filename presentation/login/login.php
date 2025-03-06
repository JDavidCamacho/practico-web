<?php
require_once '../../business/UsuarioService.php';
//permite iniciar sesion a nivel php
session_start();
//^^^^^session_start() inicia la varibale de sesion
$error = '';//variable almace error

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //hay una solicitud de tipo POST, el usuario esta enviando datos
    $email = trim($_POST['email']);//variables las cuales almacen los datos que envia el usuario
    $password = trim($_POST['password']);//$_POST[''];--->atrapa los datos que envia el usuario
    $userService = new UserService();
        //uso del authenticate para validar el login
        if ($userService->authenticate($email, $password)) {
            //$_SESSION crea una varibale de sesion asignando un valor al array $_SESSION
            $_SESSION['user'] = $email; //'user' es lo que guarda el valor, los nombres son separados por _
            /* $SESSION['nombre_usuario']="JESUS" */
            /* unset($_SESSION['']) --> SE USA PARA ELIMINAR VARIABLE DE SESION */
            /* unset() --> elimina todas las variables de sesion */
            /* Las variables de sesion usa cookis los cuales estan activas en los navegadores de no estarlo estas no funcionan */
            $_SESSION['nombre'] = 'Alex';
            
            header("Location: ../../presentation/dashboard/dashboard.php");
            exit();
        } else {
            $error = 'Usuario/Contraseña inválida.';
            /* session_destroy() cierra la session destruye la sesion activa */
            }
    }
?>
<?php include 'header.php'; ?>
    
<div class="container">
    <div class="row">
        <div class="col" >
            <div class="text-center">
                <a href="login.php">
                    <img src="../../public/img/logo.png" alt="logo" width="400" height="280" style="margin-top: 120px;" >
                </a>
            </div>
        </div>

        <div class="col">
            <div class="login-panel panel panel-default">
                <div class="formulario">
                        <h1>BIENVENIDO</h1>
                        <h4>INICIO DE SESION</h4>

                    <div class="panel-body">
                        <?php if ($error): ?>
                            <div class="alert alert-danger">
                                <?php echo htmlspecialchars($error); ?>
                            </div>
                        <?php endif; ?>
                        <form role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            
                                
                                 <input class="form-control" placeholder="Nombre de usuario" name="email" type="text" autofocus required>

                                 <input class="form-control" placeholder="Contraseña" name="password" type="password" value="" required>

                                 <div class="recuerdame">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me"> Recuerdame
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-lg btn-success btn-block">Ingresar</button>
                           
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php include 'footer.php'; ?>