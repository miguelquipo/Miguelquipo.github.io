<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>CRUD de Productos</title>
  <link rel="stylesheet" href="./CSS/stylesInsertPrd.css">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


</head>
<body>
    <header>
        <div class="logo">
          <!-- Aquí puede ir tu logo o nombre del sitio -->
          <!-- ... -->
        </div>
        <div class="menu-btn">
          <div class="menu-icon"></div>
        </div>
        <div class="menu">
          <!-- Opción de Menú -->
          <a href="#"><i class="fas fa-home"></i> Inicio</a>
          <a href="./insert.php"><i class="fas fa-shopping-cart"></i> Ingreso de Productos</a>
          <a href="./rendimientos.html"><i class="fa-solid fa-clipboard"></i> Rendimientos</a>
        </div>
        <div class="user-login">
          <!-- Icono de Inicio de Sesión -->
          <a href="./index.html"><i class="fas fa-user-circle"></i></a>
        </div>

      </header>
      <h1>CRUD de Productos</h1>

       <div class="container">
        <form id="crud-form" method="post" action="PHP/ingresoProd.php">
            <input type="text" id="product-name" name="product-name" placeholder="Nombre del Producto" requiered>
            <select id="product-type" name="product-type" requiered>
                <?php
                include './PHP/db.php';
                $sql = "SELECT id_tipo, nombre_tipo FROM tipos_producto";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['id_tipo'] . '">' . $row['nombre_tipo'] . '</option>';
                    }
                }
                $conn->close();
                ?>
            </select>
            <input name="qr-code" type="text" placeholder="Codigo Var" id="qr-code" >
            <input type="date" id="entry-date" name="fecha-creacion">
            
    
            <button type="submit">Agregar Producto</button>
        </form>
      </div>
    
        
  </div>
  <div class="table-container">
  <h2>Tabla de Productos</h2>
  <table id="product-table">
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Tipo</th>
        <th>Código QR</th>
        <th>Fecha de Ingreso</th>
      </tr>
    </thead>
    <tbody>
      <!-- Aquí se llenará la tabla con los datos -->
      
    </tbody>
    
  </table>
</div>


  <script src="./script.js"></script>
</body>
</html>
