
    const modalDescripcion = document.querySelector('#staticBackdrop');
    
    modalDescripcion.addEventListener('show.bs.modal', function(event) {
       
        // nos dice a cual le hemos dado click
        const enlace = event.relatedTarget;

        const descripcion = enlace.getAttribute('data-bs-descripcion');
        //leemos nuestro atributo data-bs-descripcion y lo guardamos en descripcion
    
       // construimos el parrafo
        const imagen = document.createElement('p');
        imagen.innerHTML=descripcion;
        
          //indicamos donde queremos mostrarla (modal-body en este caso)
          const contenidoModal = document.querySelector('.modal-body');

          //insertamos la imagen como contenido del modal (es un elemento hijo)
          contenidoModal.appendChild(imagen);
    });
    
    //para cerrar el modal
    modalDescripcion.addEventListener('hidden.bs.modal', function() {
        const contenidoModal = document.querySelector('.modal-body');

        //necesario limpiar el modal-body para que las imÃ¡genes no se vayan acumulando
        contenidoModal.textContent = '';
    });

