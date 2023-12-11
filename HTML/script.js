document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('crud-form');
    const productList = document.getElementById('product-list');
  
    form.addEventListener('submit', function(event) {
      event.preventDefault();
  
      const productName = document.getElementById('product-name').value;
      const productType = document.getElementById('product-type').value;
      const qrCode = document.getElementById('qr-code').value; // No se puede acceder al QR directamente por cuestiones de seguridad
      const entryDate = document.getElementById('entry-date').value;
  
      if (productName.trim() !== '') {
        createProduct(productName, productType, entryDate);
        form.reset();
      } else {
        alert('Ingrese un nombre de producto válido');
      }
    });
  
    function createProduct(name, type, date) {
      const li = document.createElement('li');
      const productName = document.createElement('span');
      const productType = document.createElement('span');
      const entryDate = document.createElement('span');
      const deleteButton = document.createElement('button');
  
      productName.textContent = `Nombre: ${name}`;
      productType.textContent = `Tipo: ${type}`;
      entryDate.textContent = `Fecha de ingreso: ${date}`;
      deleteButton.textContent = 'Eliminar';
      deleteButton.classList.add('delete-btn');
  
      li.appendChild(productName);
      li.appendChild(productType);
      li.appendChild(entryDate);
      li.appendChild(deleteButton);
      productList.appendChild(li);
  
      deleteButton.addEventListener('click', function() {
        li.remove();
      });
    }
  });
  
  function createProduct(name, type, date) {
    const li = document.createElement('li');
    const productName = document.createElement('span');
    const productType = document.createElement('span');
    const entryDate = document.createElement('span');
    const deleteButton = document.createElement('button');
  
    productName.textContent = `Nombre: ${name}`;
    productType.textContent = `Tipo: ${type}`;
    entryDate.textContent = `Fecha de ingreso: ${date}`;
    deleteButton.textContent = 'Eliminar';
    deleteButton.classList.add('delete-btn');
  
    li.appendChild(productName);
    li.appendChild(productType);
    li.appendChild(entryDate);
    li.appendChild(deleteButton);
    productList.appendChild(li);
  
    deleteButton.addEventListener('click', function() {
      li.remove();
      updateTable(); // Actualizar la tabla al eliminar un producto
    });
  
    updateTable(); // Actualizar la tabla al agregar un producto
  }
  
  function updateTable() {
    const tableBody = document.querySelector('#product-table tbody');
    tableBody.innerHTML = '';
  
    const listItems = document.querySelectorAll('#product-list li');
  
    listItems.forEach(item => {
      const name = item.querySelector('span:nth-child(1)').textContent.split(': ')[1];
      const type = item.querySelector('span:nth-child(2)').textContent.split(': ')[1];
      const date = item.querySelector('span:nth-child(3)').textContent.split(': ')[1];
  
      const row = document.createElement('tr');
      const nameCell = document.createElement('td');
      const typeCell = document.createElement('td');
      const qrCell = document.createElement('td');
      const dateCell = document.createElement('td');
  
      nameCell.textContent = name;
      typeCell.textContent = type;
      // Agregar código QR (no se puede acceder directamente por cuestiones de seguridad)
      qrCell.textContent = 'Código QR';
      dateCell.textContent = date;
  
      row.appendChild(nameCell);
      row.appendChild(typeCell);
      row.appendChild(qrCell);
      row.appendChild(dateCell);
      tableBody.appendChild(row);
    });
  }
  
  /*BARRA MENU*/
  document.addEventListener('DOMContentLoaded', function() {
    const menuBtn = document.querySelector('.menu-btn');
    const menu = document.querySelector('.menu');
  
    menuBtn.addEventListener('click', function() {
      menu.classList.toggle('open');
    });
  });
   

  function searchProducts() {
    const searchCedula = document.getElementById('search-cedula').value;
    const searchProductType = document.getElementById('search-product-type').value;
  
    // Lógica de búsqueda: Aquí deberías buscar en tus datos o hacer una solicitud a una API con los valores de búsqueda
    
    // Ejemplo de búsqueda simulada
    const productList = [
      { nombre: 'Producto 1', tipo: 'Electrónica', codigoQR: 'ABC123', fechaIngreso: '2023-12-15T12:00' },
      { nombre: 'Producto 2', tipo: 'Ropa', codigoQR: 'DEF456', fechaIngreso: '2023-12-16T10:30' },
      { nombre: 'Producto 3', tipo: 'Comida', codigoQR: 'GHI789', fechaIngreso: '2023-12-17T15:45' },
      // ... Puedes tener más elementos aquí
    ];
  
    const filteredProducts = productList.filter(product => {
      return product.tipo === searchProductType && product.cedula === searchCedula;
    });
  
    displaySearchResults(filteredProducts);
  }
  
  function displaySearchResults(products) {
    const tableBody = document.querySelector('#product-table tbody');
    tableBody.innerHTML = '';
  
    products.forEach(product => {
      const row = `
        <tr>
          <td>${product.nombre}</td>
          <td>${product.tipo}</td>
          <td>${product.codigoQR}</td>
          <td>${product.fechaIngreso}</td>
        </tr>
      `;
      tableBody.innerHTML += row;
    });
  }
  
  function searchRendimientos() {
    const searchCedula = document.getElementById('search-cedula').value;
    const searchProductType = document.getElementById('search-product-type').value;
  
    // Aquí debes realizar la lógica de búsqueda de los rendimientos basándote en los valores ingresados
    
    // Ejemplo simulado de resultados
    const rendimientos = [
      { fecha: '2023-12-01', nombreProducto: 'Producto A', codigoBarras: 'ABC123', trabajador: '1234567890' },
      { fecha: '2023-12-05', nombreProducto: 'Producto B', codigoBarras: 'DEF456', trabajador: '0987654321' },
      // Más datos de rendimientos...
    ];
  
    const filteredRendimientos = rendimientos.filter(rendimiento => {
      return rendimiento.trabajador === searchCedula && rendimiento.nombreProducto === searchProductType;
    });
  
    displayRendimientos(filteredRendimientos);
  }
  
  function displayRendimientos(rendimientos) {
    const tableBody = document.querySelector('#rendimientos-table tbody');
    tableBody.innerHTML = '';
  
    rendimientos.forEach(rendimiento => {
      const row = `
        <tr>
          <td>${rendimiento.fecha}</td>
          <td>${rendimiento.nombreProducto}</td>
          <td>${rendimiento.codigoBarras}</td>
          <td>${rendimiento.trabajador}</td>
        </tr>
      `;
      tableBody.innerHTML += row;
    });
  }
  

  //MOSTRAR DATOS DE LA TABLA PRODUCTOS
  document.addEventListener('DOMContentLoaded', function() {
    fetch('obtenerProductos.php')
        .then(response => response.json())
        .then(data => {
            const tableBody = document.querySelector('#product-table tbody');
            tableBody.innerHTML = '';

            data.forEach(producto => {
                const row = `
                    <tr>
                        <td>${producto.nombre_producto}</td>
                        <td>${producto.tipo_producto}</td>
                        <td>${producto.codigoQR}</td>
                        <td>${producto.fecha_ingreso}</td>
                    </tr>
                `;
                tableBody.innerHTML += row;
            });
        })
        .catch(error => console.error('Error al obtener los productos:', error));
});

